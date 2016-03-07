<?php

class NightDetailsController extends AppController {

    var $name = 'NightDetails';
    public $helpers = array('Html', 'Form');
    var $uses = array("ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable", "Category", "Event", "Booking");

    public function index() {
        $this->layout = 'reserved';
        $user_id  = $this->viewVars['user_id'];
        $this->Club->unbindModel(array("belongsTo"=>array("ClubType"),"hasMany" => array('Booking' ,'ClubException','ClubOpenDay','ClubTable','Deal','Event','Photo')));
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        //$this->Club->unbindModel(array("belongsTo"=>array("ClubType"),"hasMany" => array('Booking' ,'ClubException','ClubOpenDay','ClubTable','Deal','Event','Photo')));
        $this->Booking->recursive = 1;
        $this->Paginator->settings = array(
            'conditions'=>array('Booking.club_id'=>$club_id),
            'order' => array('Booking.id' => 'DESC')
        );
        $bookings = $this->Paginator->paginate('Booking');
        $this->set('bookings', $bookings);
    }
    public function admin_index() {
        $this->layout = 'admin';
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        
        //$club_lists = $this->Club->fetchClubList();
        $club_lists  = $this->viewVars['club_lists'];
        $this->Club->unbindModel(array("belongsTo"=>array("ClubType"),"hasMany" => array('Booking' ,'ClubException','ClubOpenDay','ClubTable','Deal','Event','Photo')));
        
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        //$this->Club->unbindModel(array("belongsTo"=>array("ClubType"),"hasMany" => array('Booking' ,'ClubException','ClubOpenDay','ClubTable','Deal','Event','Photo')));
        $this->Booking->recursive = 1;
        $this->Paginator->settings = array(
            'conditions'=>array('Booking.club_id'=>$club_id),
            'order' => array('Booking.id' => 'DESC')
        );
        $bookings = $this->Paginator->paginate('Booking');
        $this->set(compact('bookings', 'club_name', 'club_lists'));
    }

    function booking_edit($id = null) {
        $this->layout = 'reserved';
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club boking'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The club booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club booking could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Booking->read(null, $id);
        }
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
	$user_id  = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
    }
    function admin_booking_edit($id = null) {
        $this->layout = 'admin';
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club boking'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The club booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club booking could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Booking->read(null, $id);
        }
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));        
        $user_id  = $club_info['Club']['user_id'];
        $club_lists  = $this->viewVars['club_lists'];
        $this->set(compact('user_id', 'club_id', 'club_name', 'club_lists'));
    }

}

?>
