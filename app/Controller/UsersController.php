<?php
	
	App::uses('CakeEmail', 'Network/Email');
	
	class UsersController extends AppController {
		
		var $name = 'Users';
		var $uses = array("User", "Question", "QuestionAnswer", 'Order', "UserRole", "Club");
		public $components = array('Check');
		
		public function beforeFilter() {
			$this->Auth->allow('admin_login', 'login', 'logout', 'admin_logout', 'forgot_password', 'admin_add', 'index', 'reset_password');
			$sessionData = $this->Auth->user();
			$type = $sessionData['user_type'];
			$this->set('type', $type);
		}
		
		public function login() {
			parent::beforecheck();
			$this->layout = "club";
			if ($this->request->is('post')) {
				//echo $this->request->is('post');
				if ($this->Auth->login()) {
					$dataArr = $this->Auth->user();
					$userType = $dataArr['user_type'];
					//pr($userType);die;
					if ($userType == "promoter") {
						$this->redirect(array("controller" => "Promoters", "action" => "profile"));
						} elseif ($userType == "master") {
						$this->redirect(array('admin' => true, "controller" => "Users", "action" => "masterprofile"));
						} else {
						return $this->redirect($this->Auth->redirect());
					}
				}
				
				$this->Session->setFlash('Invalid email address or password, try again', 'default', array('class' => 'errormsg'));
			}
		}
		
		public function admin_login() {
			//parent::beforecheck();
			$this->layout = "club";
			if ($this->request->is('post')) {
				
				if ($this->Auth->login()) {
					$dataArr = $this->Auth->user();
					$userType = $dataArr['user_type'];
					
					if ($userType == "promoter") {
						return $this->redirect(array("controller" => "Promoters", "action" => "profile"));
						exit;
						} elseif ($userType == "master") {
						return $this->redirect(array('admin' => true, "controller" => "Users", "action" => "masterprofile"));
						exit;
						} else {
						return $this->redirect($this->Auth->redirect());
					}
				}
				
				$this->Session->setFlash('Invalid email address or password, try again', 'default', array('class' => 'errormsg'));
			}
		}
		
		public function logout() {
			parent::beforecheck();
			$this->Session->delete('redirect.controller');
			return $this->redirect($this->Auth->logout());
		}
		
		public function admin_logout() {
			parent::beforecheck();
			$this->Session->delete('redirect.controller');
			CakeSession::delete('admin_club_name');
			CakeSession::delete('admin_club_id');
			CakeSession::delete('admin_promoter_code');
			CakeSession::delete('admin_promoter_id');
			return $this->redirect(array('admin' => false, "controller" => "Users", "action" => "login"));
		}
		
		function forgot_password($token = null, $user = null) {
			if (empty($token)) {
				$admin = false;
				if ($user) {
					$this->request->data = $user;
					$admin = true;
				}
				$this->_sendPasswordReset($admin);
				} else {
				$this->_resetPassword($token);
			}
		}
		
		public function admin_master_dashboard() {
			$this->layout = 'admin';
			$conditions = array("Order.status" => "completed", "Order.transactionid !=" => null, "Order.user_id >" => 0);
			$group = array("Order.user_id");
			$fields = array("Order.id, Order.user_id, count(Order.id) AS total");
			$this->Order->recursive = -1;
			
			$this->Paginator->settings = array(
            "conditions" => $conditions,
            "group" => $group,
            "fields" => $fields,
            'order' => array('total' => 'DESC')
			);
			$users = $this->Paginator->paginate('Order');
			
			$total_comission = $this->Order->master_user_total_order();
			
			foreach ($users as $key => $row) {
				
				$this->User->unbindModel(
				array('hasMany' => array('Booking', 'Card'))
				);
				
				$this->User->recursive = -2;
				$fields = array("User.id, User.first_name, User.last_name, User.email_address, UserInfo.phone_no");
				$users[$key]['UserInfo'] = $this->User->find("first", array(
                "conditions" => array("User.id" => $row['Order']['user_id']),
                "fields" => $fields
				));
				
				$conditions = array("Order.status" => "completed", "Order.transactionid !=" => null, "Order.user_id" => $row['Order']['user_id']);
				$fields = array("Order.id,Order.order_date, Club.club_name, UserP.first_name, UserP.last_name");
				$this->Order->recursive = -2;
				$group = array("Order.user_id");
				$users[$key]['UserVenue'] = $this->Order->find("all", array(
                "conditions" => $conditions,
                "fields" => $fields,
                "order" => array('Order.id DESC'),
                "group" => $group
				));
				$users[$key]['UserComission'] = $this->Order->master_user_total_order($row['Order']['user_id']);
			}
			
			$club_lists = $this->Club->fetchClubList();
			$this->loadModel("Setting");
			$settings = $this->Setting->find("first", array("conditions" => array("name" => "user_commission")));
			
			$this->set(compact("users", "club_lists", "total_comission", "settings"));
		}
		
		public function admin_set_users($id = null) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid User'));
				} else {
				$this->User->recursive = -1;
				$user = $this->User->find("first", array("conditions" => array("User.id" => $id), "fields" => array("User.id,User.promoter_code")));
				
				CakeSession::write("admin_user_id", $id);
			}
			$this->redirect(array('controller' => 'Users', 'action' => 'earnings', 'by-month', date("Y-m-d")));
		}
		
		public function admin_earnings() {
			$params = $this->params['pass'];
			$this->layout = 'admin';
			
			$user_id = CakeSession::read('admin_user_id');
			
			/*
				* Find all the order ID
			*/
			$order_lists = $this->Order->find('list', array('conditions' => array('Order.status' => 'completed', 'Order.user_id' => $user_id)));
			$this->User->unbindModel(array("hasMany" => array('Booking', 'Card', 'ClubBottle', 'ClubTable', 'Club', 'Order', 'Photo', 'QuestionAnswer', 'Split')));
			$data = $this->User->find("first", array("conditions" => array("User.id" => $user_id)));
			
			if (isset($this->request->data['User']['from'])) {
				$firstDay = $this->request->data['User']['from'];
				$this->by_day($firstDay, $data, $order_lists, $user_id);
				return;
			}
			
			if ($params[0] == "by-month")
            $this->by_month($params[1], $data, $order_lists, $user_id);
			elseif ($params[0] == "by-week")
            $this->by_week($params, $data, $order_lists, $user_id);
			else
            $this->by_day($params[1], $data, $order_lists, $user_id);
		}
		
		public function by_month($param_date, $data, $order_lists, $user_id = null) {
			$this->layout = 'reserved';
			$date = $this->Order->rangeMonth($param_date);
			
			$data_earnings = $this->Order->promoter_total_order($order_lists, $date['start'], $date['end']);
			
			$output = $this->Order->promoter_user_order_detail($order_lists, $date['start'], $date['end']);
			//pr($output);
			
			$active = "by_month";
			$details = $this->Order->admin_details_order($order_lists,$date);
			
			
			$this->set(compact('details', 'param_date', 'data', 'data_earnings', 'output', 'active', 'user_id'));
			$this->autoRender = 'earnings';
		}
		
		public function by_week($param_date, $data, $order_lists, $user_id = null) {
			$this->layout = 'reserved';
			$date = $this->Order->getStartAndEndDate($param_date[1], $param_date[2]);
			$year = $param_date[2]; // Retrieved from the DB
			$week = $param_date[1];
			
			$data_earnings = $this->Order->promoter_total_order($order_lists, $date['start'], $date['end']);
			
			$output = $this->Order->promoter_user_order_detail($order_lists, $date['start'], $date['end']);
			
			
			$active = "by_week";
			$details = $this->Order->admin_details_order($order_lists,$date);
			$this->set(compact('details',  'param_date', 'data', 'data_earnings', 'output', 'active', 'user_id'));
			$this->autoRender = 'earnings';
		}
		
		public function by_day($param_date, $data, $order_lists, $user_id = null) {
			$this->layout = 'reserved';
			//$date = $this->Order->rangeMonth($param_date);
			
			$data_earnings = $this->Order->promoter_total_order($order_lists, $param_date, $param_date);
			
			$output = $this->Order->promoter_user_order_detail($order_lists, $param_date, $param_date);
			
			/* Weekly data */
			//select count(*) as tweets, str_to_date(concat(yearweek(order_date), 'saturday'), '%X%V %W') as `date` from orders group by yearweek(order_date)                
			
			$active = "by_day";
			
			$details = $this->Order->admin_details_order_day($order_lists, $param_date);
			$this->set(compact('details', 'param_date', 'data', 'data_earnings', 'output', 'active', 'user_id'));
			$this->autoRender = 'earnings';
		}
		
		function view($id = null) {
			parent::beforecheck();
			if (!$id) {
				$this->Session->setFlash(__('Invalid user'));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('user', $this->User->read(null, $id));
		}
		
		function add() {
			//parent::beforecheck();
			if (!empty($this->request->data)) {
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$jobTitles = $this->User->JobTitle->find('list');
			$this->set(compact('jobTitles'));
		}
		
		function edit($id = null) {
			parent::beforecheck();
			$this->layout = "reserved";
			if (!$id && empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid user'));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->request->data)) {
				$UserRole = $this->request->data;
				$this->UserRole->deleteAll(array('UserRole.user_id' => $id), false);
				
				foreach ($UserRole['UserRole'] as $role) {
					if ($role['role_id'] <> "0") {
						$uRoles["UserRole"]["user_id"] = $id;
						$uRoles["UserRole"]["name"] = $role['role_id'];
						
						$this->UserRole->saveAll($uRoles);
					}
				}
				
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			if (empty($this->request->data)) {
				$this->request->data = $this->User->read(null, $id);
				$this->UserRole->recursive = -1;
				$UserRoles = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id)));
			}
			$jobTitles = $this->User->JobTitle->find('list');
			$this->set(compact('jobTitles', 'UserRoles'));
		}
		
		function delete($id = null) {
			parent::beforecheck();
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for user'));
				$this->redirect(array('action' => 'index'));
			}
			if ($this->User->delete($id)) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		
		function admin_index() {
			parent::beforecheck();
			$this->layout = "admin";
			
			$club_id = CakeSession::read('admin_club_id');
			$club_name = CakeSession::read('admin_club_name');
			$club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
			$user_id = $club_info['Club']['user_id'];
			
			$this->set("club_name", $club_info['Club']['club_name']);
			$this->set('users', $this->paginate(array('User.club_id' => $club_id)));
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
			$this->redirect(array('controller' => 'Clubs', 'action' => 'admin_earning', 'by-month', date("Y-m-d")));
		}
		
		function admin_masterprofile() {
			parent::beforecheck();
			$this->layout = "admin";
			$info = $this->Auth->user();
			$id = $info['id'];
			if (!empty($this->request->data)) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The profile has been saved.'));
					$this->redirect(array('action' => 'masterprofile'));
					} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			if (empty($this->request->data)) {
				$this->request->data = $this->User->read(null, $id);
			}
			$club_id = CakeSession::read('admin_club_id');
			
			$club_lists = $this->Club->fetchClubList();
			$this->set(compact('club_lists', 'club_id'));
		}
		
		public function GetClubId($id) {
			$options = array('conditions' => array('User.id' => $id));
			$UserInfo = $this->User->find('first', $options);
			$club_id = $UserInfo['User']['club_id'];
			return $club_id;
		}
		
		public function GetClubName($id) {
			$options = array('conditions' => array('Club.id' => $id));
			$UserInfo = $this->Club->find('first', $options);
			
			
			if (isset($UserInfo['Club']['club_name']))
            return $UserInfo['Club']['club_name'];
			else
            return 'No club created';
		}
		
		function index() {
			parent::beforecheck();
			$this->layout = "reserved";
			
			$this->User->recursive = 0;
			$info = $this->Auth->user();
			$id = $info['id'];
			$club_name = parent::UGetClubName(parent::UGetClubId($id));
			
			//if(parent::isSuper($id))
			//{
			$this->User->recursive = -1;
			$UserInfo = $this->User->find('first', array("User.id" => $id));
			$club_id = $UserInfo['User']['club_id'];
			$this->set("club_name", $club_name);
			$this->set('users', $this->paginate(array('User.created_by' => $id)));
			//}
			//else
			//$this->set('users', $this->paginate(array("User.id"=>$id)));
		}
		
		function admin_view($id = null) {
			parent::beforecheck();
			if (!$id) {
				$this->Session->setFlash(__('Invalid user'));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('user', $this->User->read(null, $id));
		}
		
		function admin_add() {
			parent::beforecheck();
			if (!empty($this->request->data)) {
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$jobTitles = $this->User->JobTitle->find('list');
			$this->set(compact('jobTitles'));
		}
		
		function admin_edit($id = null) {
			
			parent::beforecheck();
			$this->layout = "admin";
			if (!$id && empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid user'));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->request->data)) {
				$UserRole = $this->request->data;
				$this->UserRole->deleteAll(array('UserRole.user_id' => $id), false);
				
				foreach ($UserRole['UserRole'] as $role) {
					if ($role['role_id'] <> "0") {
						$uRoles["UserRole"]["user_id"] = $id;
						$uRoles["UserRole"]["name"] = $role['role_id'];
						
						$this->UserRole->saveAll($uRoles);
					}
				}
				
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			if (empty($this->request->data)) {
				$this->request->data = $this->User->read(null, $id);
				$this->UserRole->recursive = -1;
				$UserRoles = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id)));
			}
			$jobTitles = $this->User->JobTitle->find('list');
			$this->set(compact('jobTitles', 'UserRoles'));
		}
		
		function admin_delete($id = null) {
			parent::beforecheck();
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for user'));
				$this->redirect(array('action' => 'index'));
			}
			if ($this->User->delete($id)) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
		
		/**
			* Checks if the email is in the system and authenticated, if yes create the token
			* save it and send the user an email
			*
			* @param boolean $admin Admin boolean
			* @param array $options Options
			* @return void
		*/
		protected function _sendPasswordReset($admin = null, $options = array()) {
			$defaults = array(
            'from' => Configure::read('App.defaultEmail'),
            'subject' => __d('users', 'Password Reset'),
            'template' => 'password_reset_request',
            'emailFormat' => CakeEmail::MESSAGE_TEXT,
            'layout' => 'default'
			);
			
			$options = array_merge($defaults, $options);
			
			if (!empty($this->request->data)) {
				$user = $this->{$this->modelClass}->passwordReset($this->request->data);
				if (!empty($user)) {
					
					$Email = $this->_getMailInstance();
					//$Email->delivery = 'debug';
					echo $this->{$this->modelClass}->data[$this->modelClass]['password_token'];
					$Email->to($user[$this->modelClass]['email_address'])
					->from($options['from']);
					$Email->emailFormat($options['emailFormat'])
					->subject($options['subject'])
					->template($options['template'], $options['layout'])
					->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->{$this->modelClass}->data,
					'token' => $this->{$this->modelClass}->data[$this->modelClass]['password_token']))
					->send();
					
					if ($admin) {
						$this->Session->setFlash(sprintf(
						__d('users', '%s has been sent an email with instruction to reset their password.'), $user[$this->modelClass]['email']));
						$this->redirect(array('action' => 'index', 'admin' => true));
						} else {
						//$this->Session->setFlash(__d('users', 'You should receive an email with further instructions shortly'));
						//$this->redirect(array('action' => 'login'));
						$this->set('message', "Your email is on its way!<br>For your security, the reset email is only active for the next 24 hours. if you don't see the email in next 10 minutes, check your spam folder first then try <a href='javascript:history.go(-1);'>sending it again</a>. Still don't see it? Plese <a href=''>Contact Us</a>. ");
					}
					} else {
					//$this->Session->setFlash(__d('users', 'No user was found with that email.'));
					$this->set('message', "<b>We could't find this email in the system</b><br>Please <a href='javascript:history.go(-1)'>go back</a> and check the email you entered.");
					//$this->redirect($this->referer('/'));
					//$this->redirect(array('action' => "showmessage"));
				}
			}
			$this->render('request_password_change');
		}
		
		/**
			* This method allows the user to change his password if the reset token is correct
			*
			* @param string $token Token
			* @return void
		*/
		protected function _resetPassword($token) {
			$user = $this->{$this->modelClass}->checkPasswordToken($token);
			if (empty($user)) {
				$this->Session->setFlash(__d('users', 'Invalid password reset token, try again.'));
				$this->redirect(array('action' => 'forgot_password'));
			}
			//pr($this->request->data);
			if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Set::merge($user, $this->request->data))) {
				$this->Session->setFlash(__d('users', 'Password changed, you can now login with your new password.'));
				
				echo'sahabj';
				$this->redirect($this->Auth->loginAction);
			}
			$this->set('token', $token);
		}
		
		/**
			* Returns a CakeEmail object
			*
			* @return object CakeEmail instance
			* @link http://book.cakephp.org/2.0/en/core-utility-libraries/email.html
		*/
		protected function _getMailInstance() {
			$emailConfig = Configure::read('Users.emailConfig');
			if ($emailConfig) {
				return new CakeEmail($emailConfig);
				} else {
				return new CakeEmail('default');
			}
		}
		
		function Information() {
			$id = $this->request->params['requested'];
			
			$info = $this->User->findById($id);
			
			return($info['User']['email_address']);
		}
		
		//Controller for the account settings 
		function accounts_settings($id = null) {
			
			/* if (empty($this->request->data)) {
				$this->Session->setFlash(__('Invalid user'));
				$this->redirect(array('action' => 'index'));
				}
			*/
			
			
			if (!empty($this->request->data)) {
				
				$get_name = explode(" ", $this->data['User']['name']);
				//print_r($get_name);exit;
				$this->request->data['User']['first_name'] = $get_name[0];
				$this->request->data['User']['last_name'] = $get_name[1];
				
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					
					if ($this->data['User']['pwd'] != '') {
						$passwords = AuthComponent::password($this->data['User']['pwd']);
						
						$this->User->query("UPDATE users SET password = '" . $passwords . "' WHERE id = '" . $this->request->data['User']['id'] . "' ");
						$this->Session->setFlash(__('Password Saved Sucessfully'), 'success');
					}
					//$this->redirect(array('action' => 'index'));
					$questionAns = $this->QuestionAnswer->find('first', array(
                    'conditions' => array('QuestionAnswer.user_id' => $this->request->data['User']['user_id'])
					));
					
					$information['QuestionAnswer']['id'] = $questionAns['QuestionAnswer']['id'];
					$information['QuestionAnswer']['answer'] = $this->request->data['User']['answer'];
					$information['QuestionAnswer']['user_id'] = $this->request->data['User']['user_id'];
					$information['QuestionAnswer']['question_id'] = $this->request->data['User']['question_id'];
					
					$this->QuestionAnswer->save($information);
					
					$this->Session->setFlash(__('The question answer has been saved'));
					$this->redirect(array('action' => 'index'));
					} else {
					$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
				}
			}
			if (empty($this->request->data)) {
				$this->request->data = $this->User->read(null, $id);
			}
			
			$questions = $this->Question->find("list");
			$jobTitles = $this->User->JobTitle->find('list');
			$this->set(compact('jobTitles'));
			$this->set(compact('questions'));
			
			$user = $this->User->findById($id);
			$user['User']['name'] = $user['User']['first_name'] . ' ' . $user['User']['last_name'];
			$this->set('user', $user);
		}
		
		public function reset_password($token = null, $user = null) {
			if (empty($token)) {
				$admin = false;
				if ($user) {
					$this->request->data = $user;
					$admin = true;
				}
				$this->_sendPasswordReset($admin);
				} else {
				$this->_resetPassword($token);
			}
		}
		
	}
	
?>
