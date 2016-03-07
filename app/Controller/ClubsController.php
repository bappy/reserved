<?php

class ClubsController extends AppController {

    var $name = 'Clubs';
    var $components = array('Geocoding', 'Email', 'RequestHandler', 'Check');
    var $uses = array("ClubOpenDay", "Club", "User", "ClubType", "Photo", "ClubException", "Order", "Booking", "ClubBottle");
    public $helpers = array('Utility');
    public $paginate = array(
        'limit' => 25,
        'contain' => array('User')
    );

    public function beforeFilter() {
        //parent::beforeFilter();
        $this->Auth->allow('add_reserved_club');
        //parent::beforecheck();
        $sessionData = $this->Auth->user();
        $type = $sessionData['user_type'];
        $this->set('type', $type);
    }

    function index() {
        parent::beforecheck();
        $this->layout = "reserved";
        $this->Club->recursive = 3;
        $this->set('clubs', $this->paginate());
    }

    function view($id = null) {
        parent::beforecheck();
        if (!$id) {
            $this->Session->setFlash(__('Invalid club'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('club', $this->Club->read(null, $id));
    }

    function add_reserved_club() {
        if (!empty($this->request->data)) {
            $this->User->create();
            $password = $this->User->generatePassword();
            $this->request->data['User']['user_type'] = 'club_member';
            $this->request->data['User']['password'] = $password;
            $user = $this->User->save($this->request->data['User'], array('validate' => 'only'));
            if (!empty($user)) {
                $lat_lng = $this->Geocoding->get_lat_lng($this->request->data['Club']['address']);
                $this->request->data['Club']['user_id'] = $this->User->id;
                $this->request->data['Club']['latitude'] = $lat_lng["lat"];
                $this->request->data['Club']['longitude'] = $lat_lng["lng"];
                $this->request->data['Club']['status'] = "approved";

                $this->User->Club->create();
                if ($this->User->Club->save($this->request->data)) {
                    $this->Session->setFlash(__('The user and club has been saved'));

                    $this->request->data['UserRole']['user_id'] = $this->User->getLastInsertId();
                    $this->request->data['UserRole']['name'] = "*";
                    $this->request->data['UserRole']['role_iud'] = "0";
                    $this->UserRole->save($this->request->data['UserRole']);
                    $this->User->send_user_access($this->request->data['User']['email_address'], $password);
                    $this->redirect(array('action' => 'add_reserved_club'));
                } else {
                    $this->Session->setFlash(__('The club could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    function add() {
        parent::beforecheck();
        $this->layout = 'club';

        if (!empty($this->request->data)) {
            $this->Club->create();
            $data = $this->request->data;
            //$info = $this->Auth->user();
            $data = $this->request->data;
            $data["Club"]["user_id"] = $info["id"];
            $ClubOpenDay = $this->request->data["ClubOpenDay"];


            $this->Club->id = $data["Club"]["id"];
            if ($this->Club->save($data)) {
                $id = $data["Club"]["id"];
                $ClubOpenDay[0]['club_id'] = $id;
                $ClubOpenDay[1]['club_id'] = $id;
                $ClubOpenDay[2]['club_id'] = $id;
                $ClubOpenDay[3]['club_id'] = $id;
                $ClubOpenDay[4]['club_id'] = $id;
                $ClubOpenDay[5]['club_id'] = $id;
                $ClubOpenDay[6]['club_id'] = $id;
            }

            if ($this->ClubOpenDay->saveAll($ClubOpenDay)) {
                $this->Session->setFlash(__('The club has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club could not be saved. Please, try again.'));
            }
        }

        $info = $this->Auth->user();

        if ($info['created_by'] > 0) {
            $user_id = $info["created_by"];
        } else {
            $user_id = $info["id"];
        }
        $options = array('conditions' => array('User.id' => $user_id), 'limit' => 1);

        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException')));
        $clubs = $this->Club->find("all", $options);

        if (isset($clubs[0]['ClubOpenDay']))
            $daysArr = $clubs[0]['ClubOpenDay'];
        else
            $daysArr = "";

//        if (isset($clubs[0]['ClubException']))
//            $daysArr = $clubs[0]['ClubException'];
//        else
//            $daysArr = "";

        $event_id = 0;
        if (isset($clubs[0]['Event'])) {
            foreach ($clubs[0]['Event'] as $event) {
                if ($event['recur_week'] == "no" && ($event['event_date'] == date("Y-m-d"))) {
                    $event_id = $event['id'];
                }
                if ($event['recur_week'] == "yes" && ( date("D", strtotime($event['event_date'])) == date("D") )) {
                    $event_id = $event['id'];
                }
            }
        }

        if ($event_id > 0) {
            $this->loadModel("Event");
            $conditions = array('Event.club_id' => $clubs[0]['Club']['id'], 'Event.event_date' => date("Y-m-d"));
            $events = $this->Event->findById($event_id);
        }

        $this->ClubException->recursive = -1;
        $clubExceptions = $this->ClubException->find("all", array('conditions' =>
            array('ClubException.club_id' => $clubs[0]['Club']['id']),
            'order' => array('ClubException.id DESC'),
        ));

        $club_name = $clubs[0]['Club']['club_name'];

        $this->Photo->recursive = -1;
        $profile_photo = $this->Photo->find("first", array("conditions" => array("Photo.club_id" => $clubs[0]['Club']['id'], 'Photo.profile_picture' => 'yes')));
        
        if(isset($profile_photo) && count($profile_photo)>0)
            $profile_photo = $profile_photo['Photo'];
        elseif (empty($profile_photo['Photo']) && isset($clubs[0]['Photo'][0]))
            $profile_photo = $clubs[0]['Photo'][0];
        else
            $profile_photo = "";
            
        
        $this->set(compact('events', 'user_id', 'users', 'clubs', 'clubExceptions', 'photos', 'profile_photo', 'club_name', 'clubArray', 'daysArr'));
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Club->save($this->request->data)) {
                $this->Session->setFlash(__('The club has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Club->read(null, $id);
        }
        $users = $this->Club->User->find('list');
        $clubTypes = $this->Club->ClubType->find('list');
        $this->set(compact('users', 'clubTypes'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Club->delete($id)) {
            $this->Session->setFlash(__('Club deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->Club->recursive = 1;
        $this->set('clubs', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('club', $this->Club->read(null, $id));
    }

    function admin_add() {
        parent::beforecheck();
        $this->layout = 'club';

        if (!empty($this->request->data)) {
            $this->Club->create();
            $data = $this->request->data;
            //$info = $this->Auth->user();
            $data = $this->request->data;
            $data["Club"]["user_id"] = $info["id"];
            $ClubOpenDay = $this->request->data["ClubOpenDay"];


            $this->Club->id = $data["Club"]["id"];
            if ($this->Club->save($data)) {
                $id = $data["Club"]["id"];
                $ClubOpenDay[0]['club_id'] = $id;
                $ClubOpenDay[1]['club_id'] = $id;
                $ClubOpenDay[2]['club_id'] = $id;
                $ClubOpenDay[3]['club_id'] = $id;
                $ClubOpenDay[4]['club_id'] = $id;
                $ClubOpenDay[5]['club_id'] = $id;
                $ClubOpenDay[6]['club_id'] = $id;
            }

            if ($this->ClubOpenDay->saveAll($ClubOpenDay)) {
                $this->Session->setFlash(__('The club has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club could not be saved. Please, try again.'));
            }
        }

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        //$club_lists  = $this->viewVars['club_lists'];
        
        $options = array('conditions' => array('User.id' => $user_id), 'limit' => 1);

        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException')));
        $clubs = $this->Club->find("all", $options);

        if (isset($clubs[0]['ClubOpenDay']))
            $daysArr = $clubs[0]['ClubOpenDay'];
        else
            $daysArr = "";

        if (isset($clubs[0]['ClubException']))
            $daysArr = $clubs[0]['ClubException'];
        else
            $daysArr = "";

        $event_id = 0;
        if (isset($clubs[0]['Event'])) {
            foreach ($clubs[0]['Event'] as $event) {
                if ($event['recur_week'] == "no" && ($event['event_date'] == date("Y-m-d"))) {
                    $event_id = $event['id'];
                }
                if ($event['recur_week'] == "yes" && ( date("D", strtotime($event['event_date'])) == date("D") )) {
                    $event_id = $event['id'];
                }
            }
        }

        if ($event_id > 0) {
            $this->loadModel("Event");
            $conditions = array('Event.club_id' => $clubs[0]['Club']['id'], 'Event.event_date' => date("Y-m-d"));
            $events = $this->Event->findById($event_id);
        }

        $this->ClubException->recursive = -1;
        $clubExceptions = $this->ClubException->find("all", array('conditions' =>
            array('ClubException.club_id' => $clubs[0]['Club']['id']),
            'order' => array('ClubException.id DESC'),
        ));

        $club_name = $clubs[0]['Club']['club_name'];

        $this->Photo->recursive = -1;
        $profile_photo = $this->Photo->find("first", array("conditions" => array("Photo.club_id" => $clubs[0]['Club']['id'], 'Photo.profile_picture' => 'yes')));
        if (empty($profile_photo))
            $profile_photo = $clubs[0]['Photo'][0];
        else
            $profile_photo = $profile_photo['Photo'];

        $this->set(compact('events', 'user_id', 'users', 'clubs', 'clubExceptions', 'photos', 'profile_photo', 'club_name', 'clubArray', 'daysArr'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Club->save($this->request->data)) {
                $this->Session->setFlash(__('The club has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Club->read(null, $id);
        }
        $users = $this->Club->User->find('list');
        $clubTypes = $this->Club->ClubType->find('list');
        $this->set(compact('users', 'clubTypes'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Club->delete($id)) {
            $this->Session->setFlash(__('Club deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function ajaxadd() {
        $this->layout = "ajax";
        $info = $this->Auth->user();
        if ($info['created_by'] > 0) {
            $user_id = $info["created_by"];
        } else {
            $user_id = $info["id"];
        }
        $data = $this->request->data;
        $information["Club"]["user_id"] = $user_id;
        $this->Club->id = $data["id"];
        $information["Club"]["short_description"] = $data["description"];
        $information["Club"]["club_name"] = $data["name"];
        $information["Club"]["club_type_id"] = $data["clubtype"];
        $information["Club"]["approve_auto_purchase"] = $data["club_auto_approve"];
        $information["Club"]["tip_service_fee"] = $data["club_tip"];
        $this->Club->save($information);


        $club_open = (array) json_decode($data["club_open"]);
        $club_open_time = (array) json_decode($data["club_open_time"]);
        $club_close_time = (array) json_decode($data["club_close_time"]);
        //pr($club_close_time);
        $club_status = (array) json_decode($data["club_status"]);
        $club_id = $data["id"];
        $alpha = array("a", "b", "c", "d", "e", "f", "g");

        $options = array('conditions' => array('ClubOpenDay.club_id' => $club_id));
        $clubs = $this->ClubOpenDay->find("all", $options);
        if (empty($clubs)) {
            for ($i = 0; $i < count($club_open); $i++) {
                $infomation["ClubOpenDay"]["club_id"] = $club_id;
                $infomation["ClubOpenDay"]["days"] = $club_open[$alpha[$i]];
                $infomation["ClubOpenDay"]["open_time"] = $club_open_time[$alpha[$i]];
                $infomation["ClubOpenDay"]["close_time"] = $club_close_time[$alpha[$i]];
                $infomation["ClubOpenDay"]["status"] = $club_status[$alpha[$i]];
                $this->ClubOpenDay->saveAll($infomation);
            }
        } else {
            for ($i = 0; $i < count($club_open); $i++) {
                $id = $clubs[$i]['ClubOpenDay']['id'];
                $infomation["ClubOpenDay"]["club_id"] = $club_id;
                $infomation["ClubOpenDay"]["days"] = $club_open[$alpha[$i]];
                $infomation["ClubOpenDay"]["open_time"] = $club_open_time[$alpha[$i]];
                $infomation["ClubOpenDay"]["close_time"] = $club_close_time[$alpha[$i]];
                $infomation["ClubOpenDay"]["status"] = $club_status[$alpha[$i]];
                $this->ClubOpenDay->updateAll(
                        array('ClubOpenDay.days' => "'" . $club_open[$alpha[$i]] . "'", 'ClubOpenDay.open_time' => "'" . $club_open_time[$alpha[$i]] . "'", 'ClubOpenDay.close_time' => "'" . $club_close_time[$alpha[$i]] . "'", 'ClubOpenDay.status' => "'" . $club_status[$alpha[$i]] . "'"), array('ClubOpenDay.id' => $id)
                );
            }
        }
    }

    public function earning() {
        $params = $this->params['pass'];
        $this->layout = 'reserved';
        $info = $this->Auth->user();
        if ($info['created_by'] > 0) {
            $user_id = $info["created_by"];
        } else {
            $user_id = $info["id"];
        }
        $this->set('user_id', $user_id);
        $user_id = $this->viewVars['user_id'];
        $this->Club->unbindModel(array("belongsTo" => array("ClubType"), "hasMany" => array('Booking', 'ClubException', 'ClubOpenDay', 'ClubTable', 'Deal', 'Event', 'Photo')));
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));

        if (isset($this->request->data['Club']['from'])) {
            $firstDay = $this->request->data['Club']['from'];
            $this->by_day($club_info, $firstDay);
            return;
        }

        if ($params[0] == "by-month")
            $this->by_month($club_info, $params[1]);
        elseif ($params[0] == "by-week")
            $this->by_week($club_info, $params);
        else
            $this->by_day($club_info, $params[1]);
    }

    public function admin_set_club($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club'));
        } else {
            $this->Club->recursive = -1;
            $club = $this->Club->find("first", array("conditions" => array("Club.id" => $id), "fields" => array("Club.id", "Club.club_name")));

            CakeSession::write("admin_club_name", $club['Club']['club_name']);
            CakeSession::write("admin_club_id", $id);
        }
        $this->redirect(array('action' => 'admin_earning', 'by-month', date("Y-m-d")));
    }

    public function admin_earning() {
        $params = $this->params['pass'];
        $this->layout = 'admin';
        
        $admin_club_id = CakeSession::read('admin_club_id');
        $club_lists = $this->Club->fetchClubList();
        
        if ($admin_club_id) {
            $this->Club->unbindModel(array("belongsTo" => array("ClubType"), "hasMany" => array('Booking', 'ClubException', 'ClubOpenDay', 'ClubTable', 'Deal', 'Event', 'Photo')));
            $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $admin_club_id)));

            if (isset($this->request->data['Club']['from'])) {
                $firstDay = $this->request->data['Club']['from'];
                $this->by_day($club_info, $firstDay);
                return;
            }

            if ($params[0] == "by-month")
                $this->by_month($club_info, $params[1], $club_lists);
            elseif ($params[0] == "by-week")
                $this->by_week($club_info, $params, $club_lists);
            else
                $this->by_day($club_info, $params[1], $club_lists);
        }else {            
            $active = "by_month";
            $no_club = "Yes";
            $this->set(compact('club_lists', 'active', 'no_club'));
        }
    }

    public function by_month($club_info, $param_date, $club_lists = null) {
        $this->layout = 'reserved';

        $date = $this->Order->rangeMonth($param_date);

        $data_earnings = $this->Order->total_order($club_info['Club']['id'], $date['start'], $date['end']);
        
        $active = "by_month";
        $no_club = "No";
        $club_name = $club_info['Club']['club_name'];
        
        $this->set(compact('club_name', 'param_date', 'no_club', 'club_lists', 'data_earnings', 'active', 'firstDay', 'lastDay'));
        $this->autoRender = 'earning';
    }

    public function by_week($club_info, $param_date, $club_lists = null) {
        $this->layout = 'reserved';
        $date = $this->Order->getStartAndEndDate($param_date[1], $param_date[2]);
        $year = $param_date[2]; // Retrieved from the DB
        $week = $param_date[1];

        $data_earnings = $this->Order->total_order($club_info['Club']['id'], $date['start'], $date['end']);

        $no_club = "No";
        $active = "by_week";
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('club_name', 'param_date', 'no_club', 'club_lists', 'param_date', 'data_earnings', 'active', 'firstDay', 'lastDay'));
        $this->autoRender = 'earning';
    }

    public function by_day($club_info, $param_date, $club_lists = null) {
        $this->layout = 'reserved';
        $data_earnings = $this->Order->total_order($club_info['Club']['id'], $param_date, $param_date);
        $day1 = date('Y-m-d', strtotime('-1 day', strtotime($param_date)));
        $day2 = $param_date;

        $netTotalUp = $this->Order->total_order($club_info['Club']['id'], $day2);
        $netTotalDown = $this->Order->total_order($club_info['Club']['id'], $day1);
        $userDataUp = $this->Order->user_order_detail($club_info['Club']['id'], $day2);
        $userDataDown = $this->Order->user_order_detail($club_info['Club']['id'], $day1);
        $active = "by_day";
        $no_club = "No";
       
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('club_name', 'param_date', 'no_club', 'club_lists', 'active', 'param_date', 'data_earnings', 'firstDay', 'lastDay', 'netTotalUp', 'userDataUp', 'netTotalDown', 'userDataDown'));
        $this->autoRender = 'earning';
    }

}

?>