<?php
	
	class EventsController extends AppController {
		
		var $name = 'Events';
		public $helpers = array('Html', 'Form');
		var $uses = array("Event", "ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable", "Category", "Event", "Booking");
		
		function index() {
			$this->layout = 'reserved';
			//$info = $this->Auth->user();
			//$user_id = $info["id"];
			$user_id  = $this->viewVars['user_id'];
			$club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
			$club_id = $club_info['Club']['id'];
			$club_name = $club_info['Club']['club_name'];
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
			$this->Event->recursive = 1;
			$this->Paginator->settings = array(
            'conditions' => array('Event.club_id' => $club_id),
            'order' => array('Event.event_date' => 'DESC')
			);
			$events = $this->Paginator->paginate('Event');
			$this->set('events', $events);
		}
		
		function view($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid event'));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('event', $this->Event->read(null, $id));
		}
		
		public function add_events_category() {
			$this->layout = 'reserved';
			$info = $this->Auth->user();
			$user_id = $info["id"];
			$user_id  = $this->viewVars['user_id'];
			$club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
			
			$club_id = $club_info['Club']['id'];
			$club_name = $club_info['Club']['club_name'];
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
			if (!empty($this->request->data)) {
				$this->Category->create();
				if ($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('The club bottle category has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The club bottle category could not be saved. Please, try again.'));
				}
			}
		}
		
		public function edit_events_category($id = null) {
			$this->layout = 'reserved';
			//$info = $this->Auth->user();
			//$user_id = $info["id"];
			$user_id  = $this->viewVars['user_id'];
			$club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
			$club_id = $club_info['Club']['id'];
			$club_name = $club_info['Club']['club_name'];
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
			$this->Event->recursive = 1;
			$this->Paginator->settings = array(
            'conditions' => array('Event.category_id' => $id),
            'order' => array('Event.event_date' => 'DESC')
			);
			$events = $this->Paginator->paginate('Event');
			$this->set('events', $events);
			if (!$id && empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid club bottle'));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->request->data)) {
				if ($this->Category->save($this->request->data)) {
					$this->Session->setFlash(__('The club events category has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The club events category could not be saved. Please, try again.'));
				}
			}
			if (empty($this->request->data)) {
				$this->request->data = $this->Category->read(null, $id);
			}
		}
		
		
		public function delete_events_category($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for club events category'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Category->id = $id;
			$this->request->data['Category']['status'] = 'inactive';
			$this->Category->save($this->request->data);
			$this->redirect(array('action' => 'index'));
		}
		
		public function admin_delete_events_category($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for club events category'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Category->id = $id;
			$this->request->data['Category']['status'] = 'inactive';
			$this->Category->save($this->request->data);
			$this->redirect(array('action' => 'index'));
		}
		function add() {
			$this->layout = false;
			$info = $this->Auth->user();
			$user_id = $info["id"];
			$club_id = $info["club_id"];
			
			//$user_id  = $this->viewVars['user_id'];
			$club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
			//pr($club_info);
			if(!empty($club_info)){
				$club_id = $club_info['Club']['id'];
				$club_name = $club_info['Club']['club_name'];
			}
			//        $this->set('club_info',$club_info);
			
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			if (!empty($this->request->data)) {
				$this->Event->create();
				if ($this->Event->save($this->request->data)) {
					$this->Session->setFlash(__('The event has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
				}
			}
			
			$categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'events','Category.status' => 'active')));
			$this->set(compact('categories','club_id','club_name'));
		}
		
		function edit($id = null) {
			$this->layout = false;
			$info = $this->Auth->user();
			$user_id = $info["id"];
			$club_id = $info['club_id'];
			//$club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
			//$club_name = $club_info['Club']['club_name'];
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
			if (!$id && empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid event'));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->request->data)) {
				if ($this->Event->save($this->request->data)) {
					$this->Session->setFlash(__('The event has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
				}
			}
			$this->Event->unbindModel(array("belongsTo" => array('Club')));
			if (empty($this->request->data)) {
				$this->request->data = $this->Event->read(null, $id);
			}
			//pr($this->request->data);
			$this->set('data',$this->request->data);
			$categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'events','Category.status' => 'active')));
			$this->set(compact('categories'));
		}
		
		function delete($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for event'));
				$this->redirect(array('action' => 'index'));
			}
			if ($this->Event->delete($id)) {
				$this->Session->setFlash(__('Event deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Event was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		
		function admin_index() {
			$this->layout = 'admin';
			$club_id = CakeSession::read('admin_club_id');
			$club_name = CakeSession::read('admin_club_name');
			$club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
			
			$user_id  = $club_info['Club']['user_id'];        
			
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			$club_lists  = $this->viewVars['club_lists'];
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories', 'club_lists'));
			$this->Event->recursive = 1;
			$this->Paginator->settings = array(
            'conditions' => array('Event.club_id' => $club_id),
            'order' => array('Event.event_date' => 'DESC')
			);
			$events = $this->Paginator->paginate('Event');
			$this->set('events', $events);
		}
		
		function admin_view($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid event'));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('event', $this->Event->read(null, $id));
		}
		
		function admin_add() {
			$this->layout = false;
			$club_id = CakeSession::read('admin_club_id');
			$club_name = CakeSession::read('admin_club_name');
			$club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));        
			$user_id  = $club_info['Club']['user_id'];
			//$club_lists  = $this->viewVars['club_lists'];
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			if (!empty($this->request->data)) {
				$this->Event->create();
				if ($this->Event->save($this->request->data)) {
					$this->Session->setFlash(__('The event has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
				}
			}
			
			$categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'events','Category.status' => 'active')));
			$this->set(compact('categories','club_id','club_name','club_lists'));
		}
		
		function admin_edit($id = null) {
			$this->layout = false;
			$club_id = CakeSession::read('admin_club_id');
			$club_name = CakeSession::read('admin_club_name');
			$club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));        
			$user_id  = $club_info['Club']['user_id'];
			//$club_lists  = $this->viewVars['club_lists'];
			
			$left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'events', 'Category.status' => 'active')));
			$this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
			if (!$id && empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid event'));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->request->data)) {
				if ($this->Event->save($this->request->data)) {
					$this->Session->setFlash(__('The event has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
				}
			}
			$this->Event->unbindModel(array("belongsTo" => array('Club')));
			if (empty($this->request->data)) {
				$this->request->data = $this->Event->read(null, $id);
			}
			//pr($this->request->data);
			$this->set('data',$this->request->data);
			$categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'events','Category.status' => 'active')));
			$this->set(compact('categories'));
		}
		
		function admin_delete($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for event'));
				$this->redirect(array('action' => 'index'));
			}
			if ($this->Event->delete($id)) {
				$this->Session->setFlash(__('Event deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Event was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		
	}
	
?>