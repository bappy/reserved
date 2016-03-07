<?php

class DealsController extends AppController {

    var $name = 'Deals';
    public $helpers = array('Html', 'Form');
    var $uses = array("Club", "ClubTable", "Category", "Deal");

    function index() {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //pr($info);
        //$user_id = $info["id"];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        if ($club_info) {

            $club_id = $club_info['Club']['id'];
            $club_name = $club_info['Club']['club_name'];
            $this->set(compact('user_id', 'club_id', 'club_name'));
            $this->Deal->recursive = 2;
            $this->Deal->unbindModel(array("belongsTo" => array('Club')));
            $this->Paginator->settings = array(
                'conditions' => array('Deal.club_id' => $club_id),
                'order' => array('Deal.status' => 'desc', 'Deal.deal_date' => 'desc'),
            );
            $clubTables = $this->Paginator->paginate('Deal');
            $this->set('clubTables', $clubTables);
        } else {
            $this->set('clubTables', false);
        }
    }

    function getPrice() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $table = $this->request->data['table'];
        $this->ClubTable->unbindModel(array("hasMany" => array('Booking', 'Deal')));
        $data = $this->ClubTable->find('first', array('fields' => array('ClubTable.minimum_price'), 'conditions' => array('ClubTable.id' => $table)));
        echo $data['ClubTable']['minimum_price'];
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid deal'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('deal', $this->Deal->read(null, $id));
    }

    function add() { //Not in use
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $user_id = $this->viewVars['user_id'];
        $club_table_info = $this->ClubTable->find('first', array('conditions' => array('ClubTable.user_id' => $user_id)));
        $this->set(compact('club_table_info'));

        if (!empty($this->request->data)) {
            $this->Deal->create();
            if ($this->Deal->save($this->request->data)) {
                $this->Session->setFlash(__('The deal has been saved'));
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
            }
        }
    }

    //Not in use

    function edit($id = null) {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid deal'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            $this->Deal->id = $id;
            if ($this->Deal->save($this->request->data)) {
                $this->Session->setFlash(__('The deal has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
            }
        }
        $club_table_info = $this->Deal->read(null, $id);
        $this->set(compact('club_table_info'));
    }

    function make_deal() {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        //$this->ClubTable->unBindModel(array('hasMany' => array('Booking', 'Deal')));
        //$club_table_info = $this->ClubTable->find('first', array('fields' => 'ClubTable.id,ClubTable.club_id,ClubTable.minimum_price', 'conditions' => array('ClubTable.id' => $id)));
        //pr($club_table_info);
        $this->set(compact('user_id', 'club_id', 'club_name'));

        $tables = $this->ClubTable->find('list', array('conditions' => array('ClubTable.user_id' => $user_id, 'ClubTable.club_id' => $club_id, 'NOT' => array('ClubTable.status' => 'pending'))));
        $this->set(compact('tables'));
        if (!empty($this->request->data)) {
            $records = array();
            foreach ($this->request->data['Deal']['deal_date'] as $key => $data) {
                $record = $this->request->data;
                $checkQuery = $this->Deal->find('all', array('conditions' => array('Deal.deal_date' => $data, 'Deal.status' => '1')));
                $this->set($checkQuery, 'checkQuery');
                if (!empty($checkQuery)) {
                    $this->Deal->query("DELETE FROM `deals` WHERE deal_date IN ('" . $data . "')");
                }
                $record['Deal']['deal_date'] = $data;
                $record['Deal']['recur'] = $this->request->data['Deal']['recur'][$key];
                $records[] = $record;
            }
            //pr($records);
            $this->Deal->saveMany($records);
            $this->Session->setFlash(__('The deal has been saved'));
            $this->redirect(array('action' => 'index'));
        }
    }
    function admin_make_deal() {
        $this->layout = 'admin';
        
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        
        $this->set(compact('user_id', 'club_id', 'club_name'));

        $tables = $this->ClubTable->find('list', array('conditions' => array('ClubTable.user_id' => $user_id, 'ClubTable.club_id' => $club_id, 'NOT' => array('ClubTable.status' => 'pending'))));
        $this->set(compact('tables'));
        if (!empty($this->request->data)) {
            $records = array();
            foreach ($this->request->data['Deal']['deal_date'] as $key => $data) {
                $record = $this->request->data;
                $checkQuery = $this->Deal->find('all', array('conditions' => array('Deal.deal_date' => $data, 'Deal.status' => '1')));
                $this->set($checkQuery, 'checkQuery');
                if (!empty($checkQuery)) {
                    $this->Deal->query("DELETE FROM `deals` WHERE deal_date IN ('" . $data . "')");
                }
                $record['Deal']['deal_date'] = $data;
                $record['Deal']['recur'] = $this->request->data['Deal']['recur'][$key];
                $records[] = $record;
            }
           
            $this->Deal->saveMany($records);
            $this->Session->setFlash(__('The deal has been saved'));
            $this->redirect(array('action' => 'index'));
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for deal'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Deal->delete($id)) {
            $this->Session->setFlash(__('Deal deleted'));
        }
        $this->Session->setFlash(__('Deal was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->layout = 'admin';
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];

        if ($club_info) {

            $club_id = $club_info['Club']['id'];
            $club_name = $club_info['Club']['club_name'];
            $this->set(compact('user_id', 'club_id', 'club_name'));
            $this->Deal->recursive = 2;
            $this->Deal->unbindModel(array("belongsTo" => array('Club')));
            $this->Paginator->settings = array(
                'conditions' => array('Deal.club_id' => $club_id),
                'order' => array('Deal.status' => 'desc', 'Deal.deal_date' => 'desc'),
            );
            $clubTables = $this->Paginator->paginate('Deal');
            $this->set(compact('clubTables', 'club_name'));
        } else {
            $this->set('clubTables', false);
        }
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid deal'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('deal', $this->Deal->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Deal->create();
            if ($this->Deal->save($this->request->data)) {
                $this->Session->setFlash(__('The deal has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
            }
        }
        $clubs = $this->Deal->Club->find('list');
        $clubTables = $this->Deal->ClubTable->find('list');
        $this->set(compact('clubs', 'clubTables'));
    }

    function admin_edit($id = null) {
        $this->layout = 'admin';
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];

        $this->set(compact('user_id', 'club_id', 'club_name'));
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid deal'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            $this->Deal->id = $id;
            if ($this->Deal->save($this->request->data)) {
                $this->Session->setFlash(__('The deal has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
            }
        }
        $club_table_info = $this->Deal->read(null, $id);
        $this->set(compact('club_table_info'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for deal'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Deal->delete($id)) {
            $this->Session->setFlash(__('Deal deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Deal was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

?>