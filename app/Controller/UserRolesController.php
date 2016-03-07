<?php

App::uses('AppController', 'Controller');

/**
 * UserRoles Controller
 *
 * @property UserRole $UserRole
 * @property PaginatorComponent $Paginator
 */
class UserRolesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Check');
    var $uses = array('UserRole', 'Role', 'User', 'Club', 'JobTitle');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        //parent::beforecheck();
        $this->UserRole->recursive = 0;
        $this->set('userRoles', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UserRole->exists($id)) {
            throw new NotFoundException(__('Invalid user role'));
        }
        $options = array('conditions' => array('UserRole.' . $this->UserRole->primaryKey => $id));
        $this->set('userRole', $this->UserRole->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function GetClubId($id) {
        $options = array('conditions' => array('Club.user_id' => $id));
        $UserInfo = $this->Club->find('first', $options);
        $club_id = $UserInfo['Club']['id'];
        if ($club_id)
            return $club_id;
        return false;
    }

    public function GetClubName($id) {
        $options = array('conditions' => array('Club.user_id' => $id));
        $UserInfo = $this->Club->find('first', $options);

        $name = $UserInfo['Club']['club_name'];
        return $name;
    }

    public function add() {
        parent::beforecheck();
        $this->layout = 'club';

        $info = $this->Auth->user();
        if ($info['created_by'] > 0) {
            $id = $info["created_by"];
        } else {
            $id = $info["id"];
        }
        if (!$this->GetClubId($id)) {
            //$this->Session->setFlash('Please create a club before assiging roles!!!',array(),'failue');	
            $this->Session->setFlash('Please create a club before assiging roles!!!', 'default', array(), 'failue');
            return $this->redirect(
                            array('controller' => 'Clubs', 'action' => 'add')
            );
        }


        $this->Club->recursive = -1;
        $options = array('conditions' => array('Club.user_id' => $id));
        $info = $this->Club->find("first", $options);

        if ($this->request->is('post')) {
            // pr($this->request->data);exit;
            $email_address = $this->request->data['User']['email_address'];
            $count = $this->User->find('count', array(
                'conditions' => array('User.email_address' => $email_address)
            ));
            if ($count > 0) {
                $this->Session->setFlash('User Exists By this name!!!', 'default', array(), 'failue');
                return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            }

            $info = $this->Auth->user();
            $id = $info['id'];
            $this->User->create();
            $this->request->data['User']['club_id'] = $this->GetClubId($id);
            $password = $this->User->generatePassword();
            $this->request->data['User']['user_type'] = 'club_member';
            $this->request->data['User']['password'] = $password;
            $this->request->data['User']['created_by'] = $id;
            $pincode = 0;
            if ($this->request->data['UserRole'][6]['role_id'] == 'Waitress') {
                $pincode = $this->User->generatePassword(4);
            }
            $this->request->data['User']['pincode'] = $pincode;
            //pr($this->request->data);exit();
            if ($this->User->save($this->request->data)) {
                $id = $this->User->getLastInsertID();
                $UserRole = $this->request->data;
                foreach ($UserRole['UserRole'] as $key => $uRole) {
                    if (isset($uRole["role_id"]) && ($uRole["role_id"] != '0')) {
                        $Roless[$key]['name'] = $uRole["role_id"];
                        $Roless[$key]['user_id'] = $id;
                    }
                }

                $this->UserRole->saveAll($Roless);
                $this->User->send_user_access($this->request->data['User']['email_address'], $password, $pincode);
            }
            $this->Session->setFlash(__('The user role has been saved.'));
            return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        } else {
            $this->Session->setFlash(__('The user role could not be saved. Please, try again.'));
        }


        //$roles = $this->UserRole->Role->find('list');
        $users = $this->UserRole->User->find("list");
        $club_name = parent::UGetClubName(parent::UGetClubId($id));
        $job_title_lists = $this->JobTitle->find('list', array('fields' => array('JobTitle.id', 'JobTitle.job_title'), 'conditions' => array()));

        $this->set(compact('roles', 'users', 'club_name', 'job_title_lists'));
    }

    public function admin_add() {
        parent::beforecheck();
        $this->layout = 'club';

        $club_id = CakeSession::read('admin_club_id');
        
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_name = $club_info['Club']['club_name'];

        $this->Club->recursive = -1;
        $options = array('conditions' => array('Club.user_id' => $user_id));
        $info = $this->Club->find("first", $options);

        if ($this->request->is('post')) {
            // pr($this->request->data);exit;
            $email_address = $this->request->data['User']['email_address'];
            $count = $this->User->find('count', array(
                'conditions' => array('User.email_address' => $email_address)
            ));
            if ($count > 0) {
                $this->Session->setFlash('User Exists By this name!!!', 'default', array(), 'failue');
                return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
            }

          
            $this->User->create();
            $this->request->data['User']['club_id'] = $this->GetClubId($user_id);
            $password = $this->User->generatePassword();
            $this->request->data['User']['user_type'] = 'club_member';
            $this->request->data['User']['password'] = $password;
            $this->request->data['User']['created_by'] = $user_id;
            $pincode = 0;
            if ($this->request->data['UserRole'][6]['role_id'] == 'Waitress') {
                $pincode = $this->User->generatePassword(4);
            }
            $this->request->data['User']['pincode'] = $pincode;
           
            if ($this->User->save($this->request->data)) {
                $id = $this->User->getLastInsertID();
                $UserRole = $this->request->data;
                foreach ($UserRole['UserRole'] as $key => $uRole) {
                    if (isset($uRole["role_id"]) && ($uRole["role_id"] != '0')) {
                        $Roless[$key]['name'] = $uRole["role_id"];
                        $Roless[$key]['user_id'] = $id;
                    }
                }

                $this->UserRole->saveAll($Roless);
                $this->User->send_user_access($this->request->data['User']['email_address'], $password, $pincode);
            }
            $this->Session->setFlash(__('The user role has been saved.'));
            return $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        } else {
            $this->Session->setFlash(__('The user role could not be saved. Please, try again.'));
        }


        //$roles = $this->UserRole->Role->find('list');
        $users = $this->UserRole->User->find("list");
        
        $job_title_lists = $this->JobTitle->find('list', array('fields' => array('JobTitle.id', 'JobTitle.job_title'), 'conditions' => array()));

        $this->set(compact('roles', 'users', 'club_name', 'job_title_lists'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->UserRole->exists($id)) {
            throw new NotFoundException(__('Invalid user role'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UserRole->save($this->request->data)) {
                $this->Session->setFlash(__('The user role has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user role could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UserRole.' . $this->UserRole->primaryKey => $id));
            $this->request->data = $this->UserRole->find('first', $options);
        }
        $roles = $this->UserRole->Role->find('list');
        $this->set(compact('roles'));
    }

    public function admin_edit($id = null) {
        if (!$this->UserRole->exists($id)) {
            throw new NotFoundException(__('Invalid user role'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UserRole->save($this->request->data)) {
                $this->Session->setFlash(__('The user role has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user role could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UserRole.' . $this->UserRole->primaryKey => $id));
            $this->request->data = $this->UserRole->find('first', $options);
        }
        $roles = $this->UserRole->Role->find('list');
        $this->set(compact('roles'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->UserRole->id = $id;
        if (!$this->UserRole->exists()) {
            throw new NotFoundException(__('Invalid user role'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->UserRole->delete()) {
            $this->Session->setFlash(__('The user role has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user role could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function userpermission() {
        $id = $this->request->params['pass'][0];
        $this->UserRole->recursive = 0;
        $permission = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id)));
        return $permission;
    }

    public function admin_userpermission() {
        $id = $this->request->params['pass'][0];
        $this->UserRole->recursive = 0;
        $permission = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id)));
        return $permission;
    }

}
