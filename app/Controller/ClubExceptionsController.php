<?php

class ClubExceptionsController extends AppController {

    var $name = 'ClubExceptions';
    public $components = array('RequestHandler');
    public $helpers = array('Utility');
    var $uses = array("ClubOpenDay", "Club", "User", "ClubType", "Photo", "ClubException");

    function index() {
        $this->ClubException->recursive = 0;
        $this->set('clubExceptions', $this->paginate());
    }

    public function beforeFilter() {
        parent::beforeFilter();
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club exception'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubException', $this->ClubException->read(null, $id));
    }

    function add() {

        if ($this->request->is('ajax')) {

            $this->layout = "ajax";
            $this->debug = false;
            //$this->autoRender=false;
            $info = $this->request->data;
            //print_r($info);

            $info["ClubException"]["club_id"] = $info["club_id"];
            $dateNew = date("Y-m-d", strtotime($info["exception_date"]));
            $info["ClubException"]["exception_date"] = $dateNew;
            
            $info["ClubException"]["exception_name"] = $info["exception_name"];
            $info["ClubException"]["open_time"] = $info["open_time"];
            $info["ClubException"]["close_time"] = $info["close_time"];
            $info["ClubException"]["status"] = $info["status"];


            $this->ClubException->create();
            if ($this->ClubException->save($info)) {
                // $info = $this->Auth->user();
                //$id = $info['id'];
                $clubExceptions = $this->ClubException->find("all", array('conditions' =>
                    array('ClubException.club_id' => $info["club_id"]),
                    'order' => array('ClubException.id DESC'),
                ));


                $this->set(compact('clubExceptions'));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club exception'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->ClubException->save($this->request->data)) {
                $this->Session->setFlash(__('The club exception has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club exception could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubException->read(null, $id);
        }
        $clubs = $this->ClubException->Club->find('list');
        $this->set(compact('clubs'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club exception'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubException->delete($id)) {
            $this->Session->setFlash(__('Club exception deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club exception was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->ClubException->recursive = 0;
        $this->set('clubExceptions', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club exception'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubException', $this->ClubException->read(null, $id));
    }

    function admin_add() {
       if ($this->request->is('ajax')) {
            $this->layout = "ajax";
            $this->debug = false;            
            $info = $this->request->data;            
            $info["ClubException"]["club_id"] = $info["club_id"];
            $dateNew = date("Y-m-d", strtotime($info["exception_date"]));
            $info["ClubException"]["exception_date"] = $dateNew;
            
            $info["ClubException"]["exception_name"] = $info["exception_name"];
            $info["ClubException"]["open_time"] = $info["open_time"];
            $info["ClubException"]["close_time"] = $info["close_time"];
            $info["ClubException"]["status"] = $info["status"];

            $this->ClubException->create();
            if ($this->ClubException->save($info)) {               
                $clubExceptions = $this->ClubException->find("all", array('conditions' =>
                    array('ClubException.club_id' => $info["club_id"]),
                    'order' => array('ClubException.id DESC'),
                ));


                $this->set(compact('clubExceptions'));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club exception'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->ClubException->save($this->request->data)) {
                $this->Session->setFlash(__('The club exception has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club exception could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubException->read(null, $id);
        }
        $clubs = $this->ClubException->Club->find('list');
        $this->set(compact('clubs'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club exception'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubException->delete($id)) {
            $this->Session->setFlash(__('Club exception deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club exception was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function ajaxdelete() {
        $exid = $this->request->data["exid"];
        $club_id = $this->request->data["club_id"];
        $this->ClubException->delete($exid);
        $clubExceptions = $this->ClubException->find("all", array('conditions' => array('ClubException.club_id' => $club_id)));
        // $this->ClubException->find("all",);
        $this->set(compact('clubExceptions'));
        //$this->render('index');
    }
    function admin_ajaxdelete() {
        $exid = $this->request->data["exid"];
        $club_id = $this->request->data["club_id"];
        $this->ClubException->delete($exid);
        $clubExceptions = $this->ClubException->find("all", array('conditions' => array('ClubException.club_id' => $club_id)));
        // $this->ClubException->find("all",);
        $this->set(compact('clubExceptions'));
        //$this->render('index');
    }

    function ajaxEdit() {
        if ($this->request->is('ajax')) {
            $this->layout = "ajax";
            $this->debug = false;
            $this->autoRender = false;
            $info = $this->request->data;
            
            $id = $info['id'];
            $targetDate = $this->request->data["exception_date_edit" . $id . ""];
            $dateNew = date("Y-m-d", strtotime($targetDate));
            $info["exception_date"] = $dateNew;
            $info["exception_name"] = $this->request->data["exception_name_edit" . $id . ""];
            $info["open_time"] = $this->request->data["open_time_edit" . $id . ""];
            $info["close_time"] = $this->request->data["close_time_edit" . $id . ""];
            $info["status"] = $this->request->data["status_time_edit" . $id . ""];

            $this->ClubException->id = $info['id'];
           
            $this->ClubException->save($info);
        }
    }
    
    function admin_ajaxEdit() {
        if ($this->request->is('ajax')) {
            $this->layout = "ajax";
            $this->debug = false;
            $this->autoRender = false;
            $info = $this->request->data;
            
            $id = $info['id'];
            $targetDate = $this->request->data["exception_date_edit" . $id . ""];
            $dateNew = date("Y-m-d", strtotime($targetDate));
            $info["exception_date"] = $dateNew;
            $info["exception_name"] = $this->request->data["exception_name_edit" . $id . ""];
            $info["open_time"] = $this->request->data["open_time_edit" . $id . ""];
            $info["close_time"] = $this->request->data["close_time_edit" . $id . ""];
            $info["status"] = $this->request->data["status_time_edit" . $id . ""];

            $this->ClubException->id = $info['id'];
           
            $this->ClubException->save($info);
        }
    }

}

?>
