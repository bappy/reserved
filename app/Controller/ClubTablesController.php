<?php

class ClubTablesController extends AppController {

    var $name = 'ClubTables';
    public $helpers = array('Html', 'Form');
    var $uses = array("ClubTable", "Club", "User", "ClubType", "Category", "ClubException");

//    public function beforeFilter() {
//        $sessionData = $this->Auth->user();
//        $type = $sessionData['user_type'];
//        $this->set('type', $type);
//        $info = $this->Auth->user();
//        if ($info['created_by'] > 0) {
//            $user_id = $info["created_by"];
//        } else {
//            $user_id = $info["id"];
//        }
//        $this->set('user_id', $user_id);
//    }

    function index() {
        $this->layout = 'reserved';
        //$info = $this->Auth->user();
        //$user_id = $info["id"];
        $array = $this->params['pass'];
        $user_id = $this->viewVars['user_id'];
        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
        $this->ClubTable->recursive = 1;
        if (empty($array)) {
            $this->Paginator->settings = array(
                'conditions' => array('ClubTable.club_id' => $club_id),
                'order' => array('ClubTable.id' => 'ASC')
            );
        } else {
            $clubTableId = $array[0];
            $this->Paginator->settings = array(
                'conditions' => array('ClubTable.club_id' => $club_id, 'ClubTable.category_id' => $clubTableId),
                'order' => array('ClubTable.id' => 'DESC')
            );
        }
        $clubTables = $this->Paginator->paginate('ClubTable');
        $this->set('clubTables', $clubTables);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club table'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubTable', $this->ClubTable->read(null, $id));
    }

    function add() {
        $this->layout = false;
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubTable']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubTable']['status'] = 'approved';
            }
            $this->ClubTable->create();
            if ($this->ClubTable->save($this->request->data)) {
                $this->Session->setFlash(__('The club table has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club table could not be saved. Please, try again.'));
            }
        }

        $info = $this->Auth->user();
        $user_id = $this->User->fetch_user_id($info);

        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'table')));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('categories', 'user_id', 'club_id', 'club_name', 'left_categories'));
    }

    function edit($id = null) {
        $this->layout = false;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club table'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubTable']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubTable']['status'] = 'approved';
            }
            if ($this->ClubTable->save($this->request->data)) {
                $this->Session->setFlash(__('The club table has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club table could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubTable->read(null, $id);
        }

        $info = $this->Auth->user();
        $user_id = $this->User->fetch_user_id($info);

        $club_info = $this->Club->find('first', array('conditions' => array('Club.user_id' => $user_id)));
        $club_id = $club_info['Club']['id'];
        $club_name = $club_info['Club']['club_name'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'table')));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('categories', 'club_name', 'left_categories'));
    }

    function duplicate_table() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $table_name = $this->request->data['table_name'];
        $minimum_price = $this->request->data['minimum_price'];
        $category_id = $this->request->data['category_id'];
        $table_min_guy = $this->request->data['table_min_guy'];
        $table_min_girls = $this->request->data['table_min_girls'];
        $max_guys1 = $this->request->data['max_guys1'];
        $max_guys1_price = $this->request->data['max_guys1_price'];
        $max_guys2 = $this->request->data['max_guys2'];
        $max_guys2_price = $this->request->data['max_guys2_price'];
        $create_date = $this->request->data['create_date'];
        $status = $this->request->data['status'];
        $this->ClubTable->save($this->data);
        $lastId = $this->ClubTable->getLastInsertID();
        echo $lastId;
    }
    function admin_duplicate_table() {
        $this->layout = 'ajax';
        $this->beforeRender();
        $this->autoRender = false;
        $table_name = $this->request->data['table_name'];
        $minimum_price = $this->request->data['minimum_price'];
        $category_id = $this->request->data['category_id'];
        $table_min_guy = $this->request->data['table_min_guy'];
        $table_min_girls = $this->request->data['table_min_girls'];
        $max_guys1 = $this->request->data['max_guys1'];
        $max_guys1_price = $this->request->data['max_guys1_price'];
        $max_guys2 = $this->request->data['max_guys2'];
        $max_guys2_price = $this->request->data['max_guys2_price'];
        $create_date = $this->request->data['create_date'];
        $status = $this->request->data['status'];
        $this->ClubTable->save($this->data);
        $lastId = $this->ClubTable->getLastInsertID();
        echo $lastId;
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club table'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubTable->delete($id)) {
            $this->Session->setFlash(__('Club table deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club table was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function admin_index() {
        $this->layout = 'admin';
        $array = $this->params['pass'];
        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $club_lists = $this->viewVars['club_lists'];
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('user_id', 'club_id', 'club_name', 'left_categories'));
        $this->ClubTable->recursive = 1;
        if (empty($array)) {
            $this->Paginator->settings = array(
                'conditions' => array('ClubTable.club_id' => $club_id),
                'order' => array('ClubTable.id' => 'ASC')
            );
        } else {
            $clubTableId = $array[0];
            $this->Paginator->settings = array(
                'conditions' => array('ClubTable.club_id' => $club_id, 'ClubTable.category_id' => $clubTableId),
                'order' => array('ClubTable.id' => 'DESC')
            );
        }
        $clubTables = $this->Paginator->paginate('ClubTable');
        $this->set('clubTables', $clubTables);
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid club table'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('clubTable', $this->ClubTable->read(null, $id));
    }

    function admin_add() {
        $this->layout = false;
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubTable']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubTable']['status'] = 'approved';
            }
            $this->ClubTable->create();
            if ($this->ClubTable->save($this->request->data)) {
                $this->Session->setFlash(__('The club table has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club table could not be saved. Please, try again.'));
            }
        }

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
                
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'table')));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('categories', 'user_id', 'club_id', 'club_name', 'left_categories'));
    }

    function admin_edit($id = null) {
        $this->layout = false;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid club table'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if (isset($_POST['save'])) {
                $this->request->data['ClubTable']['status'] = 'pending';
            }
            if (isset($_POST['save_publish'])) {
                $this->request->data['ClubTable']['status'] = 'approved';
            }
            if ($this->ClubTable->save($this->request->data)) {
                $this->Session->setFlash(__('The club table has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The club table could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ClubTable->read(null, $id);
        }

        $club_id = CakeSession::read('admin_club_id');
        $club_name = CakeSession::read('admin_club_name');
        $club_info = $this->Club->find('first', array('conditions' => array('Club.id' => $club_id)));
        $user_id = $club_info['Club']['user_id'];
        $categories = $this->Category->find('list', array('conditions' => array('Category.category_type' => 'table')));
        $left_categories = $this->Category->find('all', array('conditions' => array('Category.category_type' => 'table')));
        $this->set(compact('categories', 'club_name', 'left_categories'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for club table'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ClubTable->delete($id)) {
            $this->Session->setFlash(__('Club table deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Club table was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}

?>