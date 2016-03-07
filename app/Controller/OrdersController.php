<?php

class OrdersController extends AppController {

    var $name = 'Orders';
    public $helpers = array('Html', 'Form');
    var $uses = array("Order", "Booking", "ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable");

    function index() {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));


        $this->Order->Behaviors->load('Containable');
        $contain = array(            
            'OrderItem' => array(
                'ClubBottle' => array(
                    'fields' => array('category_id', 'bottle_name'),
                    'Category' => array('category_name')
                )
            ),
            'User' => array(
                'fields' => array('id', 'name')
            )
        );

        $this->Paginator->settings = array(
            'contain' => $contain,
            'conditions' => array('Order.club_id' => $club_id,'Order.status' => 'pending'),
            'order' => array('Order.order_time' => 'DESC')
        );
        $bookings = $this->Paginator->paginate('Order');
        $this->set('bookings', $bookings);
        
    }
    
    function admin_index() {
        $this->layout = 'reserved';
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        $this->set(compact('user_id', 'club_id', 'club_name'));

        $this->Order->Behaviors->load('Containable');
        $contain = array(            
            'OrderItem' => array(
                'ClubBottle' => array(
                    'fields' => array('category_id', 'bottle_name'),
                    'Category' => array('category_name')
                )
            ),
            'User' => array(
                'fields' => array('id', 'name')
            )
        );

        $this->Paginator->settings = array(
            'contain' => $contain,
            'conditions' => array('Order.club_id' => $club_id,'Order.status' => 'pending'),
            'order' => array('Order.order_time' => 'DESC')
        );
        $bookings = $this->Paginator->paginate('Order');
        $this->set('bookings', $bookings);
        
    }

    function fulfilled() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $status = $this->request->data['status'];
        $this->Order->id = $id;
        if($status == 1)
        $this->Order->saveField('status', 'completed');
        else
        $this->Order->saveField('status', 'pending');
        
        echo "Successfully fulfilled order!";
    }
    
    function admin_fulfilled() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $status = $this->request->data['status'];
        $this->Order->id = $id;
        if($status == 1)
        $this->Order->saveField('status', 'completed');
        else
        $this->Order->saveField('status', 'pending');
        
        echo "Successfully fulfilled order!";
    }

    function cancel() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $this->Order->id = $id;
        $this->Order->saveField('status', 'calcelled');
        echo "Successfully Cancelled order!";
    }
    function admin_cancel() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $this->Order->id = $id;
        $this->Order->saveField('status', 'calcelled');
        echo "Successfully Cancelled order!";
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

}

?>