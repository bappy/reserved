<?php

class PhotosController extends AppController {

    var $name = 'Photos';
    public $helpers = array('Utility');

    function index() {
        $this->Photo->recursive = 0;
        $this->set('photos', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid photo'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('photo', $this->Photo->read(null, $id));
    }

    function add() {
        if (!empty($this->request->data)) {
            $this->Photo->create();
            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash(__('The photo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
            }
        }
        $users = $this->Photo->User->find('list');
        $clubs = $this->Photo->Club->find('list');
        $this->set(compact('users', 'clubs'));
    }

    function edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid photo'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash(__('The photo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Photo->read(null, $id);
        }
        $users = $this->Photo->User->find('list');
        $clubs = $this->Photo->Club->find('list');
        $this->set(compact('users', 'clubs'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for photo'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Photo->delete($id)) {
            $this->Session->setFlash(__('Photo deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Photo was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->Photo->recursive = 0;
        $this->set('photos', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid photo'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('photo', $this->Photo->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->request->data)) {
            $this->Photo->create();
            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash(__('The photo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
            }
        }
        $users = $this->Photo->User->find('list');
        $clubs = $this->Photo->Club->find('list');
        $this->set(compact('users', 'clubs'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid photo'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Photo->save($this->request->data)) {
                $this->Session->setFlash(__('The photo has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Photo->read(null, $id);
        }
        $users = $this->Photo->User->find('list');
        $clubs = $this->Photo->Club->find('list');
        $this->set(compact('users', 'clubs'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for photo'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Photo->delete($id)) {
            $this->Session->setFlash(__('Photo deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Photo was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function makeprofile() {
        $this->layout = "ajax";
        //$this->autoRender = false;

        $club_id = $this->request->data['clubid'];
        $counter = $this->Photo->find("count", array('conditions' => array('Photo.profile_picture' => 'yes', "Photo.club_id" => $club_id, "Photo.photo_type" => "club")));


        $id = $this->Auth->user();
        $user_id = $id["id"];
        $imageid = $this->request->data['imageid'];

        if ($counter == 0) {
            $this->Photo->id = $imageid;
            $this->Photo->set(array("profile_picture" => "yes"));
            $this->Photo->save();
        } else {
            $this->Photo->updateAll(array("Photo.profile_picture" => '"no"', 'Photo.club_id' => $club_id));
            $this->Photo->id = $imageid;
            $this->Photo->set(array("profile_picture" => "yes"));
            $this->Photo->save();
        }

        $this->loadModel("Club");

        $options = array('conditions' => array('Club.id' => $club_id), 'limit' => 1);

        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException', 'ClubOpenDay', 'Deal', 'Event')));
        $clubs = $this->Club->find("all", $options);

        $this->Photo->recursive = -1;
        $profile_photo = $this->Photo->find("first", array("conditions" => array("Photo.club_id" => $club_id, 'Photo.profile_picture' => 'yes')));
        if (empty($profile_photo))
            $profile_photo = $clubs[0]['Photo'][0];
        else
            $profile_photo = $profile_photo['Photo'];
        $this->set(compact('clubs', 'profile_photo'));
    }

    public function ajaxdelete() {
        $this->layout = "ajax";
        $pid = $this->request->data['picID'];
        $club_id = $this->request->data['club_id'];

        $in = $this->Photo->findById($pid);
        $physicalImage = $in['Photo']['photos'];

        if (unlink(APP . 'webroot' . DS . 'img' . DS . 'profile' . DS . $physicalImage)) {
            $this->Photo->delete($pid);
        }
        $this->loadModel("Club");

        $options = array('conditions' => array('Club.id' => $club_id), 'limit' => 1);

        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException', 'ClubOpenDay', 'Deal', 'Event')));
        $clubs = $this->Club->find("all", $options);

        $this->Photo->recursive = -1;
        $profile_photo = $this->Photo->find("first", array("conditions" => array("Photo.club_id" => $club_id, 'Photo.profile_picture' => 'yes')));
        if (empty($profile_photo))
            $profile_photo = $clubs[0]['Photo'][0];
        else
            $profile_photo = $profile_photo['Photo'];
        $this->set(compact('clubs', 'profile_photo'));
    }
    public function admin_ajaxdelete() {
        $this->layout = "ajax";
        $pid = $this->request->data['picID'];
        $club_id = $this->request->data['club_id'];

        $in = $this->Photo->findById($pid);
        $physicalImage = $in['Photo']['photos'];

        if (unlink(APP . 'webroot' . DS . 'img' . DS . 'profile' . DS . $physicalImage)) {
            $this->Photo->delete($pid);
        }
        $this->loadModel("Club");

        $options = array('conditions' => array('Club.id' => $club_id), 'limit' => 1);

        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException', 'ClubOpenDay', 'Deal', 'Event')));
        $clubs = $this->Club->find("all", $options);

        $this->Photo->recursive = -1;
        $profile_photo = $this->Photo->find("first", array("conditions" => array("Photo.club_id" => $club_id, 'Photo.profile_picture' => 'yes')));
        if (empty($profile_photo))
            $profile_photo = $clubs[0]['Photo'][0];
        else
            $profile_photo = $profile_photo['Photo'];
        $this->set(compact('clubs', 'profile_photo'));
    }

    function uploaderNew() {

        $this->layout = "ajax";
        $time = time();
        $this->autoRender = false;
        $name = $this->request->data['Photo']['photos']["name"];
        $tmp_name = $this->request->data['Photo']['photos']["tmp_name"];
        $ext = $this->request->data['Photo']['photos']["type"];
        $destination = APP . 'webroot' . DS . 'img' . DS . 'profile' . DS . $time . $name;
        $tmp_name = $this->Photo->make_thumb($tmp_name, $destination, 320, $ext);
        $club_id = $this->request->data['Photo']['club_id'];
        $id = $this->Auth->user();
        $this->request->data['Photo']['user_id'] = $id["id"];
        $this->request->data['Photo']['club_id'] = $club_id;
        $this->request->data['Photo']['photos'] = $time . $name;
        $this->request->data['Photo']['photo_type'] = "club";
        $this->request->data['Photo']['profile_picture'] = "no";
        $this->Photo->save($this->request->data);

        $photos = $this->Photo->find("all", array("conditions" => array("Photo.user_id" => $id["id"])));
        $profile_photo = $this->Photo->find("all", array("conditions" => array("Photo.user_id" => $id["id"], 'Photo.profile_picture' => 'yes')));
        
        $options = array('conditions' => array('User.id' => $id["id"]), 'limit' => 1);
        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException')));
        $clubs = $this->Club->find("all", $options);
        
        $this->set(compact('clubs', 'profile_photo'));
        $this->render('ajaxdelete');
        return false;
    }
    
    function admin_uploaderNew() {
        $this->layout = "ajax";
        $time = time();
        $this->autoRender = false;
        $name = $this->request->data['Photo']['photos']["name"];
        $tmp_name = $this->request->data['Photo']['photos']["tmp_name"];
        $ext = $this->request->data['Photo']['photos']["type"];
        $destination = APP . 'webroot' . DS . 'img' . DS . 'profile' . DS . $time . $name;
        $tmp_name = $this->Photo->make_thumb($tmp_name, $destination, 320, $ext);
        
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
                
        $this->request->data['Photo']['user_id'] = $user_id;
        $this->request->data['Photo']['club_id'] = $club_id;
        $this->request->data['Photo']['photos'] = $time . $name;
        $this->request->data['Photo']['photo_type'] = "club";
        $this->request->data['Photo']['profile_picture'] = "no";
        $this->Photo->save($this->request->data);

        //$photos = $this->Photo->find("all", array("conditions" => array("Photo.user_id" => $user_id)));
        
        $options = array('conditions' => array('User.id' => $user_id), 'limit' => 1);
        $this->Club->unbindModel(array('hasMany' => array('ClubBottle', 'ClubTable', 'Booking', 'ClubException')));
        $clubs = $this->Club->find("all", $options);
        
        
        $profile_photo = $this->Photo->find("all", array("conditions" => array("Photo.user_id" => $user_id, 'Photo.profile_picture' => 'yes')));
        $this->set(compact('clubs', 'profile_photo'));
        $this->render('admin_ajaxdelete');
        return false;
    }

}

?>