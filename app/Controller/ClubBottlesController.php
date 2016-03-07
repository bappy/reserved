<?php

class ClubBottlesController extends AppController {

    var $name = 'ClubBottles';
    public $helpers = array('Html', 'Form');
    var $uses = array("ClubBottle", "Club", "User", "ClubType", "Category", "ClubTable", "Category");

    public function index() {
        $this->layout = 'reserved';
        $array = $this->params['pass'];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
        $this->ClubBottle->recursive = 1;

        if (empty($array)) {
            $this->Paginator->settings = array(
                'conditions' => array('ClubBottle.club_id' => $club_id),
                'order' => array('ClubBottle.id' => 'DESC')
            );
        } else {
            $clubTableId = $array[0];
            $this->Paginator->settings = array(
                'conditions' => array('ClubBottle.club_id' => $club_id, 'ClubBottle.category_id' => $clubTableId),
                'order' => array('ClubBottle.id' => 'ASC')
            );
        }

        $ClubBottle = $this->Paginator->paginate('ClubBottle');
        $this->set('clubBottles', $ClubBottle);
    }

    public function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubBottle', $this->ClubBottle->read(null, $id));
    }

    public function add_bottles_category() {
        $this->layout = 'reserved';

        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        if (!empty($this->request->data)) {

            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle category could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function admin_add_bottles_category() {
        $this->layout = 'admin';

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        if (!empty($this->request->data)) {

            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle category could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function edit_bottles_category($id = null) {
        $this->layout = 'reserved';
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle category could not be saved. Please, try again.'));
            }
        }
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle')));
        //$club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'left_categories'));

        $this->ClubBottle->recursive = 1;
        $this->Paginator->settings = array(
            'conditions' => array('ClubBottle.club_id' => $club_id, 'ClubBottle.category_id' => $id),
            'order' => array('ClubBottle.id' => 'DESC')
        );
        $clubBottles = $this->Paginator->paginate('ClubBottle');
        $this->set('clubBottles', $clubBottles);
    }

    public function admin_edit_bottles_category($id = null) {
        $this->layout = 'admin';
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle category has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle category could not be saved. Please, try again.'));
            }
        }
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle')));
        //$club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'left_categories'));

        $this->ClubBottle->recursive = 1;
        $this->Paginator->settings = array(
            'conditions' => array('ClubBottle.club_id' => $club_id, 'ClubBottle.category_id' => $id),
            'order' => array('ClubBottle.id' => 'DESC')
        );
        $clubBottles = $this->Paginator->paginate('ClubBottle');
        $this->set('clubBottles', $clubBottles);
    }

    public function delete_bottles_category($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club bottle category'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Category->id = $id;
        $this->request->data['Category']['status'] = 'inactive';
        $this->Category->save($this->request->data);

        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_delete_bottles_category($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club bottle category'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Category->id = $id;
        $this->request->data['Category']['status'] = 'inactive';
        $this->Category->save($this->request->data);

        $this->redirect(array('action' => 'index'));
    }

    public function add() {
        $this->layout = false;

        $info = $this->Auth->user();
        $user_id = $this->User->fetch_user_id($info);

        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubBottle']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubBottle']['status'] = 'approved';
            }
            $this->ClubBottle->create();
            if ($this->ClubBottle->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function edit($id = null) {
        $this->layout = false;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubBottle']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubBottle']['status'] = 'approved';
            }
            if ($this->ClubBottle->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubBottle->read(null, $id);
        }

        $info = $this->Auth->user();
        $user_id = $this->User->fetch_user_id($info);

        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function duplicate_bottle() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $this->ClubBottle->save($this->data);
        $lastId = $this->ClubBottle->getLastInsertID();
        echo $lastId;
    }

    public function admin_duplicate_bottle() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $this->ClubBottle->save($this->data);
        $lastId = $this->ClubBottle->getLastInsertID();
        echo $lastId;
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubBottle->delete($id)) {
            $this->Session->setFlash(__('Club bottle deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club bottle was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_index() {
        $this->layout = 'admin';
        $array = $this->params['pass'];

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
        $this->ClubBottle->recursive = 1;

        if (empty($array)) {
            $this->Paginator->settings = array(
                'conditions' => array('ClubBottle.club_id' => $club_id),
                'order' => array('ClubBottle.id' => 'DESC')
            );
        } else {
            $clubTableId = $array[0];
            $this->Paginator->settings = array(
                'conditions' => array('ClubBottle.club_id' => $club_id, 'ClubBottle.category_id' => $clubTableId),
                'order' => array('ClubBottle.id' => 'ASC')
            );
        }

        $ClubBottle = $this->Paginator->paginate('ClubBottle');
        $this->set('clubBottles', $ClubBottle);
    }

    public function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubBottle', $this->ClubBottle->read(null, $id));
    }

    public function admin_add() {
        $this->layout = false;

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];

        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubBottle']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubBottle']['status'] = 'approved';
            }
            $this->ClubBottle->create();
            if ($this->ClubBottle->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function admin_edit($id = null) {
        $this->layout = false;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubBottle']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubBottle']['status'] = 'approved';
            }
            if ($this->ClubBottle->save($this->request->data)) {
                $this->Session->setFlash(__('The club bottle has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club bottle could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubBottle->read(null, $id);
        }

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $club_bottle_lists = $this->ClubBottle->find('list', array('fields' => array('ClubBottle.id', 'ClubBottle.bottle_name'), 'conditions' => array('ClubBottle.status' => 'approved', 'ClubBottle.club_id' => $club_id)));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'bottle', 'Category.status' => 'active')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'categories', 'club_bottle_lists', 'left_categories'));
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club bottle'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubBottle->delete($id)) {
            $this->Session->setFlash(__('Club bottle deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club bottle was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

?>