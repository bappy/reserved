<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * @ package Controller
 * @name Reservations
 */
App::uses('CakeEmail', 'Network/Email');
?>
<?php

class ReservationsController extends AppController {

    var $name = 'Reservations';
    public $helpers = array('Html', 'Form');
    var $uses = array("Booking", "ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable", "Photo");

    public function reservation()
    {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $user_id  = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['user_id'];
        $this->set(compact('user_id', 'club_id'));

        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The club booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club booking could not be saved. Please, try again.'));
            }
        }
    }
    public function admin_reservation()
    {
        $this->layout = 'admin';        
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        
        $club_lists  = $this->viewVars['club_lists'];
        $this->set(compact('club_id','club_name','club_lists'));

        if (!empty($this->request->data)) {
            if ($this->Booking->save($this->request->data)) {
                $this->Session->setFlash(__('The club booking has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club booking could not be saved. Please, try again.'));
            }
        }
    }
    public function index() {
        $this->layout = 'reserved';        
	$user_id  = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        $this->Booking->recursive = 0;
        $reservations = $this->Booking->find('all', array('conditions' => array('Booking.club_id' => $club_id,array('NOT' => array('Booking.status' => 'cancelled')))));
        $this->set('reservations', $reservations);
	//pr($reservations);
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
        $this->redirect(array('action' => 'admin_index'));
    }
    
    public function admin_index() {
        $this->layout = 'admin';        
	$club_id = CakeSession::read('admin_club_id');
	$club_name = CakeSession::read('admin_club_name');
        
        //$club_lists = $this->Club->fetchClubList();
        $club_lists  = $this->viewVars['club_lists'];
        
        if($club_id){
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $this->set(compact('user_id', 'club_id', 'club_name'));
        $this->Booking->recursive = 0;
        $reservations = $this->Booking->find('all', array('conditions' => array('Booking.club_id' => $club_id, array('NOT' => array('Booking.status' => 'cancelled')))));
         $no_club = "No";
        $this->set(compact('club_name','no_club','reservations','club_lists'));
        }else{
             $no_club = "Yes";
             $this->set(compact('no_club','club_lists'));
        }
	
    }

    public function reservation_details() {
        $this->layout = 'ajax';
        $id = $_POST['id'];
        $this->Booking->recursive = 1;
        $reservation = $this->Booking->read(null, $id);
        $profile_image = $this->Photo->find('first', array('conditions' => array('Photo.user_id' => $reservation['Booking']['user_id'], 'Photo.profile_picture' => 'yes')));
        $this->set(compact('reservation', 'profile_image'));
    }
    
    public function admin_reservation_details() {
        $this->layout = 'ajax';
        $id = $_POST['id'];
        $this->Booking->recursive = 1;
        $reservation = $this->Booking->read(null, $id);
        $profile_image = $this->Photo->find('first', array('conditions' => array('Photo.user_id' => $reservation['Booking']['user_id'], 'Photo.profile_picture' => 'yes')));
        $this->set(compact('reservation', 'profile_image'));
    }
	
    public function ajaxAccept()
	{
		$this->layout = 'ajax';
		$this->autoRender=false;
		$data = $this->request->data;
                $this->Booking->id=$data['id'];
		if($data['type']=='accept')
		{
			$this->Booking->saveField('status', 'reserved');
			echo "load";
		}
		if($data['type']=='deny')
		{
			$this->Booking->saveField('status', 'cancelled');
			echo "hide";
		}
		if($data['type']=='arrived')
		{
			$this->Booking->saveField('status', 'taken');
			echo "hide";
		}
                $clubArray = $this->Booking->find('first', array('fields'=>('Booking.user_id'),'conditions' => array('Booking.id' => $data['id'])));
                $userArray = $this->Booking->find('first', array('fields'=>('User.email_address'),'conditions' => array('User.id' => $clubArray['Booking']['user_id'])));
                $clubArray['Booking']['user_id'];
                $toEmail = $userArray['User']['email_address'];
                $arr = $this->Auth->user();
                
                $fromEmail = $arr['email_address'];
                $options =  array();
                $defaults = array(
                    'from' => Configure::read('App.defaultEmail'),
                    'subject' => __d('User', 'Order Confirmation'),
                    'template' => 'order_confirmation',
                    'emailFormat' => CakeEmail::MESSAGE_TEXT,
                    'layout' => 'default'
                );
                
                $options = array_merge($defaults, $options);
                $Email = $this->_getMailInstance();
                $Email->to($toEmail)
                        ->from($fromEmail);
                $Email->emailFormat($options['emailFormat'])
                ->subject($options['subject'])
                ->template($options['template'], $options['layout'])
                ->send();
    }
    public function admin_ajaxAccept()
	{
		$this->layout = 'ajax';
		$this->autoRender=false;
		$data = $this->request->data;
                $this->Booking->id=$data['id'];
		if($data['type']=='accept')
		{
			$this->Booking->saveField('status', 'reserved');
			echo "load";
		}
		if($data['type']=='deny')
		{
			$this->Booking->saveField('status', 'cancelled');
			echo "hide";
		}
		if($data['type']=='arrived')
		{
			$this->Booking->saveField('status', 'taken');
			echo "hide";
		}
                $clubArray = $this->Booking->find('first', array('fields'=>('Booking.user_id'),'conditions' => array('Booking.id' => $data['id'])));
                $userArray = $this->Booking->find('first', array('fields'=>('User.email_address'),'conditions' => array('User.id' => $clubArray['Booking']['user_id'])));
                $clubArray['Booking']['user_id'];
                $toEmail = $userArray['User']['email_address'];
                $arr = $this->Auth->user();
                
                $fromEmail = $arr['email_address'];
                $options =  array();
                $defaults = array(
                    'from' => Configure::read('App.defaultEmail'),
                    'subject' => __d('User', 'Order Confirmation'),
                    'template' => 'order_confirmation',
                    'emailFormat' => CakeEmail::MESSAGE_TEXT,
                    'layout' => 'default'
                );
                
                $options = array_merge($defaults, $options);
                $Email = $this->_getMailInstance();
                $Email->to($toEmail)
                       ->from($fromEmail);
                $Email->emailFormat($options['emailFormat'])
                ->subject($options['subject'])
                ->template($options['template'], $options['layout'])
                ->send();
    }
        
        protected function _getMailInstance() {
            $emailConfig = Configure::read('Reservations.emailConfig');
            if ($emailConfig) {
                return new CakeEmail($emailConfig);
            } else {
                return new CakeEmail('default');
            }
        }

}
?>