<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {

    //var $actsAs = array('Containable');
    var $uses = array('UserRole', 'Role', 'User', 'Club');
    public $components = array(
        'Session',
        'Paginator',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'Clubs',
                'action' => 'add'
            ),
            'logoutRedirect' => array(
                'controller' => 'Users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email_address')
                )
            )
        ),
    );

    public function check_controller($contorller) {

        if (empty($contorller))
            return true;
        else if ($contorller <> strtolower($this->request->params["controller"]))
            return true;
        return false;
    }

    public function isSuper($id) {
        if (empty($id))
            return false;

        $role = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id, "UserRole.name" => "*")));

        if (count($role) > 0)
            return true;
        return false;
    }

    public function beforeFilter() {
        if ($this->request->is('ajax')) {
            return true;
        }
        $sessionData = $this->Auth->user();
        $type = $sessionData['user_type'];
        $this->set('type', $type);
        $info = $this->Auth->user();
        if ($info['created_by'] > 0) {
            $user_id = $info["created_by"];
        } else {
            $user_id = $info["id"];
        }
        $club_lists = $this->Club->fetchClubList();
        $this->set(compact('user_id', "club_lists"));
    }

    
    public function GetClubName($id) {
        $opt = array('conditions' => array('User.id' => $id));
        $inf = $this->User->find("first", $opt);

        if ($inf['User']['created_by'] == 0) { //not admin
            $opt = array('conditions' => array('User.id' => $inf['User']['created_by']));
            $inf = $this->User->find("first", $opt);
            $opt = array('conditions' => array('Club.user_id' => $inf['User']['id']));
            $UserInfo = $this->Club->find('first', $opt);
            $name = $UserInfo['Club']['club_name'];
            return $name;
        } else {
            $clubId = $this->Get_Club_by_ID($id);
            echo $clubId;
            $cname = $this->Club->findById($clubId);
            debug($cname);
            return($cname['Club']['club_name']);
        }
    }

    public function Get_Club_by_ID($id) {

        $options = array('conditions' => array('User.id' => $id));
        $UserInfo = $this->User->find('first', $options);
        $id = $UserInfo['User']['club_id'];
        return $id;
    }

    public function Get_ClubID($id) {

        $options = array('conditions' => array('User.created_by' => $id));
        $UserInfo = $this->User->find('first', $options);

        $id = $UserInfo['User']['id'];
        return $id;
    }

    public function global_redirect() {
        $this->Session->write('redirect.controller', "*");
        return $this->redirect(
                        array('controller' => 'Users', 'action' => 'index'));
    }

    public function check_global_redirect() {
        $redirect = $this->Session->read('redirect.controller');
        $id = $this->Auth->user();
        if (($redirect == "*") && ($id))
            return true;
    }

    public function beforecheck() {

        if ($this->request->is('ajax')) {
            return true;
        }
        $array = array('login', 'logout', 'forgot_password', 'admin_add', 'index', 'edit');
        $info = $this->Auth->user();
        if ($info['created_by'] > 0) {
            $id = $info["created_by"];
        } else {
            $id = $info["id"];
        }
        $returnArray = $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id)));
        if ($this->isSuper($id))
            return true;

        if ((!(in_array($this->request->params['action'], $array)) && (strtolower($this->request->params['controller'])) == "users")) {


            if (!$this->Check->checkACl($this->Auth->user(), $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id, "UserRole.name" => strtolower($this->request->params["controller"]))))))
                return $this->redirect(
                                array('controller' => 'Errors', 'action' => 'index'));
        }
        else if (strtolower($this->request->params['controller']) <> "users") {

            if (!$this->Check->checkACl($this->Auth->user(), $this->UserRole->find("all", array("conditions" => array("UserRole.user_id" => $id, "UserRole.name" => strtolower($this->request->params["controller"]))))))
                return $this->redirect(
                                array('controller' => 'Errors', 'action' => 'index'));
        }
    }

    public function GetClubId($id) {
        $options = array('conditions' => array('Club.user_id' => $id));
        $UserInfo = $this->Club->find('first', $options);
        $club_id = $UserInfo['Club']['id'];
        if ($club_id)
            return $club_id;
        return false;
    }

    public function UGetClubId($userID) {

        $options = array('conditions' => array('Club.user_id' => $userID));
        $UserInfo = $this->Club->find('first', $options);
        if ($UserInfo) { //Admin
            $club_id = $UserInfo['Club']['id'];
            return $club_id;
        } else {

            $options = array('conditions' => array('User.id' => $userID));
            $UserInfo = $this->User->find('first', $options);
            $userID = $UserInfo['User']['created_by'];
            $options = array('conditions' => array('Club.user_id' => $userID));
            $UserInfo = $this->Club->find('first', $options);
            $club_id = $UserInfo['Club']['id'];
            return $club_id;
        }
    }

    public function UGetClubName($clubId) {

        $options = array('conditions' => array('Club.id' => $clubId));
        $UserInfo = $this->Club->find('first', $options);
        return $UserInfo['Club']['club_name'];
    }

}
