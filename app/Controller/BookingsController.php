<?php

class BookingsController extends AppController {

    var $name = 'Bookings';
    public $helpers = array('Html', 'Form');
    var $uses = array("Booking", "ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable");

    
    function index() {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
		$user_id  = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        $this->Booking->recursive = 2;
         $this->Paginator->settings = array(
            'conditions' => array('Booking.club_id' => $club_id),
            'order' => array('Booking.id' => 'DESC')
        );
        $bookings = $this->Paginator->paginate('Booking');
        $this->set('bookings', $bookings);
	   //pr($bookings);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid booking'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('booking', $this->Booking->read(null, $id));
    }

    function add() {
        if (!empty($this->request->data)) {
            $this->Booking->create();
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
            }
        }
        $users = $this->Booking->User->find('list');
        $clubs = $this->Booking->Club->find('list');
        $clubTables = $this->Booking->ClubTable->find('list');
        $this->set(compact('users', 'clubs', 'clubTables'));
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid booking'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Booking->read(null, $id);
        }
        $users = $this->Booking->User->find('list');
        $clubs = $this->Booking->Club->find('list');
        $clubTables = $this->Booking->ClubTable->find('list');
        $this->set(compact('users', 'clubs', 'clubTables'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for booking'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Booking->delete($id)) {
            $this->Session->setFlash(__('Booking deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Booking was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->Booking->recursive = 0;
        $this->set('bookings', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid booking'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('booking', $this->Booking->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Booking->create();
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
            }
        }
        $users = $this->Booking->User->find('list');
        $clubs = $this->Booking->Club->find('list');
        $clubTables = $this->Booking->ClubTable->find('list');
        $this->set(compact('users', 'clubs', 'clubTables'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid booking'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The booking could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Booking->read(null, $id);
        }
        $users = $this->Booking->User->find('list');
        $clubs = $this->Booking->Club->find('list');
        $clubTables = $this->Booking->ClubTable->find('list');
        $this->set(compact('users', 'clubs', 'clubTables'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for booking'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Booking->delete($id)) {
            $this->Session->setFlash(__('Booking deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Booking was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    function fulfilled()
    {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $this->Booking->id=$id;
        $this->Booking->saveField('status', 'fulfilled');
        echo "Successfully fulfilled order!";
    }
    
    function cancel()
    {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $this->Booking->id=$id;
        $this->Booking->saveField('status', 'calcelled');
        echo "Successfully Cancelled order!";
    }

}

?>