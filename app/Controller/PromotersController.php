<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class PromotersController extends AppController {

    var $name = 'Promoters';
    var $uses = array("User", "UserInfo", "Country", 'Club', 'Order', 'Booking');

    public function beforeFilter() {
        $this->Auth->allow('login', 'logout', 'forgot_password', 'index', 'registration');
        $sessionData = $this->Auth->user();
        $type = $sessionData['user_type'];
        $this->set('type', $type);
    }

    public function login() {
        $this->layout = "promoters";
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid email address or password, try again'));
        }
    }

    public function logout() {
        $this->Session->delete('redirect.controller');
        return $this->redirect($this->Auth->logout());
    }

    public function admin_master_dashboard() {
        $this->layout = 'admin';
        $conditions = array("Order.status" => "completed", "Order.transactionid !=" => null, "Order.promoter_id >" => 0);
        $group = array("Order.promoter_id");
        $fields = array("Order.id, Order.promoter_id, count(Order.id) AS total");
        $this->Order->recursive = -1;

        $this->Paginator->settings = array(
            "conditions" => $conditions,
            "group" => $group,
            "fields" => $fields,
            'order' => array('total' => 'DESC')
        );
        $promoters = $this->Paginator->paginate('Order');

        $total_comission = $this->Order->master_promoter_total_order();

        foreach ($promoters as $key => $row) {
            $this->User->unbindModel(
                    array('hasMany' => array('Booking', 'Card'))
            );
            $this->User->recursive = -2;
            $fields = array("User.id, User.first_name, User.last_name, User.email_address, UserInfo.phone_no, UserInfo.state, UserInfo.city");
            $promoters[$key]['PromoterInfo'] = $this->User->find("first", array(
                "conditions" => array("User.id" => $row['Order']['promoter_id']),
                "fields" => $fields
            ));

            $conditions = array("Order.status" => "completed", "Order.transactionid !=" => null, "Order.promoter_id" => $row['Order']['promoter_id']);
            $fields = array("Order.id, Club.club_name");
            $this->Order->recursive = -2;
            $group = array("Order.promoter_id");
            $promoters[$key]['PromoterVenue'] = $this->Order->find("all", array(
                "conditions" => $conditions,
                "fields" => $fields,
                "order" => array('Order.id desc'),
                "group" => $group
            ));
            $promoters[$key]['PromoterComission'] = $this->Order->master_promoter_total_order($row['Order']['promoter_id']);
        }
        $club_lists = $this->Club->fetchClubList();
        $this->loadModel("Setting");
        $settings = $this->Setting->find("first", array("conditions" => array("name" => "promoter_commission")));

        $this->set(compact("promoters", "club_lists", "total_comission", "settings"));
    }

    public function admin_set_promoters($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Promoter'));
        } else {
            $this->User->recursive = -1;
            $user = $this->User->find("first", array("conditions" => array("User.id" => $id), "fields" => array("User.id,User.promoter_code")));

            CakeSession::write("admin_promoter_code", $user['User']['promoter_code']);
            CakeSession::write("admin_promoter_id", $id);
        }
        $this->redirect(array('controller' => 'Promoters', 'action' => 'earnings', 'by-month', date("Y-m-d")));
    }

    public function index() {
        $this->redirect(array('action' => 'profile'));
    }

    public function registration() {
        $this->layout = "reserved";
        $country = $this->Country->find('list');
        $this->set('country', $country);
        if (!empty($this->request->data)) {
            $this->User->create();

            if ($this->User->save($this->request->data['User'])) {
                $lastId = $this->User->getLastInsertID();
                $this->request->data['UserInfo']['user_id'] = $lastId;
                $this->UserInfo->create();
                if ($this->UserInfo->save($this->request->data['UserInfo']))
                    $this->Session->setFlash(__('Promoter registration has been saved successfully!'));
                else
                    $this->Session->setFlash(__('Something wrong! Promoter registration has not been saved. Please check all the required field.'));
            } else
                $this->Session->setFlash(__('Something wrong! Promoter registration has not been saved. Please check all the required field.'));
        }
    }

    public function profile() {
        $this->layout = "reserved";
        $country = $this->Country->find('list');
        $this->set('country', $country);
        $info = $this->Auth->user();
        $id = $info['id'];
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $id)));
        $this->set('data', $data);
    }

    public function admin_profile() {
        $this->layout = "admin";
        $country = $this->Country->find('list');
        $this->set('country', $country);
        $promoter_id = CakeSession::read('admin_promoter_id');
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $promoter_id)));
        $promoter_code = CakeSession::read('admin_promoter_code');
        $this->set(compact('data', 'promoter_id', 'promoter_code'));
    }

    public function edit($id = NULL) {
        $this->layout = "reserved";
        //$country = $this->Country->find('list');
        //$this->set('country',$country);
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $id)));
        $this->set('data', $data);
        $this->User->id = $id;
        $this->UserInfo->id = $data[0]['UserInfo']['id'];
        if ($this->User->save($this->request->data)) {
            $this->UserInfo->save($this->request->data);
            $this->Session->setFlash(__('The Promoter has been edited'));
            $this->redirect('profile');
        }
    }

    public function change_password($id = NULL) {
        $this->layout = "reserved";
        if (!empty($this->request->data)) {
            $old_password = $this->request->data['User']['old_pass'];
            $passwordHasher = new SimplePasswordHasher();
            $match_password = $passwordHasher->hash($old_password);
            $check = $this->User->find("first", array("conditions" => array("User.password" => $match_password)));
            if ($check) {
                $this->User->id = $id;
                $this->User->save($this->request->data);
                $this->Session->setFlash(__('The Promoter\'s has been changed successfully!'));
                $this->redirect('profile');
            } else {
                $this->Session->setFlash(__('Password doesn\'t matched with old password!'));
            }
        }
    }
    public function admin_change_password($id = NULL) {
       $this->layout = "admin";
        if (!empty($this->request->data)) {
            $old_password = $this->request->data['User']['old_pass'];
            $passwordHasher = new SimplePasswordHasher();
            $match_password = $passwordHasher->hash($old_password);
            $check = $this->User->find("first", array("conditions" => array("User.password" => $match_password)));
            if ($check) {
                $this->User->id = $id;
                $this->User->save($this->request->data);
                $this->Session->setFlash(__('The Promoter\'s has been changed successfully!'));
                $this->redirect('profile');
            } else {
                $this->Session->setFlash(__('Password doesn\'t matched with old password!'));
            }
        }
    }

    public function promoting_tools() {
        $this->layout = "reserved";
        $info = $this->Auth->user();
        $id = $info['id'];
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $id)));
        $this->set('data', $data);
    }

    public function admin_promoting_tools() {
        $this->layout = "admin";
        $promoter_id = CakeSession::read('admin_promoter_id');
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $promoter_id)));
        $promoter_code = CakeSession::read('admin_promoter_code');
        $this->set(compact('data', 'promoter_id', 'promoter_code'));
    }

    public function earnings() {
        $params = $this->params['pass'];
        // pr($params);
        $this->layout = 'reserved';
        $info = $this->Auth->user();
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $info['id'])));

        /*
         * Find all the order ID
         */
        $order_lists = $this->Order->find('list', array('conditions' => array('Order.status' => 'completed', 'Order.promoter_id' => $info['id'])));

        $this->loadModel('Setting');
        $settings = $this->Setting->find("first", array("conditions" => array("name" => "promoter_commission")));
        
        if (isset($this->request->data['Promoter']['from'])) {
            $firstDay = $this->request->data['Promoter']['from'];
            $this->by_day($firstDay, $data, $order_lists, $settings, null);
            return;
        }
        if ($params[0] == "by-month")
            $this->by_month($params[1], $data, $order_lists, $settings, null);
        elseif ($params[0] == "by-week")
            $this->by_week($params, $data, $order_lists, $settings, null);
        else
            $this->by_day($params[1], $data, $order_lists, $settings, null);
    }

    public function admin_earnings() {
        $params = $this->params['pass'];
        $this->layout = 'admin';
        $promoter_id = CakeSession::read('admin_promoter_id');

        /*
         * Find all the order ID
         */
        $order_lists = $this->Order->find('list', array('conditions' => array('Order.status' => 'completed', 'Order.promoter_id' => $promoter_id)));
        $data = $this->UserInfo->find("all", array("conditions" => array("UserInfo.user_id" => $promoter_id)));

        if (isset($this->request->data['Promoter']['from'])) {
            $firstDay = $this->request->data['Promoter']['from'];
            $this->by_day($firstDay, $data, $order_lists, $settings, $promoter_id);
            return;
        }
        $this->loadModel('Setting');
        $settings = $this->Setting->find("first", array("conditions" => array("name" => "promoter_commission")));
        
        if ($params[0] == "by-month")
            $this->by_month($params[1], $data, $order_lists, $settings, $promoter_id);
        elseif ($params[0] == "by-week")
            $this->by_week($params, $data, $order_lists, $settings, $promoter_id);
        else
            $this->by_day($params[1], $data, $order_lists, $settings, $promoter_id);
    }

    public function by_month($param_date, $data, $order_lists, $settings, $promoter_id = null) {
        $this->layout = 'reserved';
        $date = $this->Order->rangeMonth($param_date);

        $data_earnings = $this->Order->promoter_total_order($order_lists, $date['start'], $date['end']);

        $output = $this->Order->promoter_user_order_detail($order_lists, $date['start'], $date['end']);

        /* Weekly data */
        //select count(*) as tweets, str_to_date(concat(yearweek(order_date), 'saturday'), '%X%V %W') as `date` from orders group by yearweek(order_date)                
        $weekly_data = $this->Order->weekly_data($order_lists, $date['start'], $date['end']);
        foreach ($weekly_data as $key => $val) {
            $date = $this->Order->rangeWeek($val[0]['date']);
            $ps = $this->Order->promoter_weekly_order_detail($order_lists, $date['start'], $date['end']);
            $weekly_data[$key][0]['commissions'] = $ps * ($settings['Setting']['value'] / 100);
        }
        $active = "by_month";
        $promoter_code = CakeSession::read('admin_promoter_code');

        $this->set(compact('settings', 'promoter_code', 'param_date', 'data', 'data_earnings', 'output', 'weekly_data', 'active', 'promoter_id'));
        $this->autoRender = 'earnings';
    }

    public function by_week($param_date, $data, $order_lists, $settings, $promoter_id = null) {
        $this->layout = 'reserved';
        $date = $this->Order->getStartAndEndDate($param_date[1], $param_date[2]);
        $year = $param_date[2]; // Retrieved from the DB
        $week = $param_date[1];

        $data_earnings = $this->Order->promoter_total_order($order_lists, $date['start'], $date['end']);

        $output = $this->Order->promoter_user_order_detail($order_lists, $date['start'], $date['end']);

        /* Weekly data */
        //select count(*) as tweets, str_to_date(concat(yearweek(order_date), 'saturday'), '%X%V %W') as `date` from orders group by yearweek(order_date)                
        $weekly_data = $this->Order->weekly_data($order_lists, $date['start'], $date['end']);
        foreach ($weekly_data as $key => $val) {
            $date = $this->Order->rangeWeek($val[0]['date']);
            $ps = $this->Order->promoter_weekly_order_detail($order_lists, $date['start'], $date['end']);
            $weekly_data[$key][0]['commissions'] = ($ps * ($settings['Setting']['value'] / 100));
        }
        $active = "by_week";
        $promoter_code = CakeSession::read('admin_promoter_code');

        $this->set(compact('settings', 'promoter_code', 'param_date', 'data', 'data_earnings', 'output', 'weekly_data', 'active', 'promoter_id'));
        $this->autoRender = 'earnings';
    }

    public function by_day($param_date, $data, $order_lists, $settings, $promoter_id = null) {
        $this->layout = 'reserved';
        $date = $this->Order->rangeMonth($param_date);

        $data_earnings = $this->Order->promoter_total_order($order_lists, $param_date, $param_date);

        $output = $this->Order->promoter_user_order_detail($order_lists, $param_date, $param_date);

        /* Weekly data */
        //select count(*) as tweets, str_to_date(concat(yearweek(order_date), 'saturday'), '%X%V %W') as `date` from orders group by yearweek(order_date)                
        $weekly_data = $this->Order->weekly_data($order_lists, $param_date, $param_date);
        foreach ($weekly_data as $key => $val) {
            $date = $this->Order->rangeWeek($val[0]['date']);
            $ps = $this->Order->promoter_weekly_order_detail($order_lists, $date['start'], $date['end']);
            $weekly_data[$key][0]['commissions'] = $ps * ($settings['Setting']['value'] / 100);
        }
        $active = "by_day";
        $promoter_code = CakeSession::read('admin_promoter_code');
        $settings = $this->Setting->find("first", array("conditions" => array("name" => "promoter_commission")));
        $this->set(compact('settings', 'promoter_code', 'param_date', 'data', 'data_earnings', 'output', 'weekly_data', 'active', 'promoter_id'));
        $this->autoRender = 'earnings';
    }

}

?>