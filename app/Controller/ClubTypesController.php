<?php
class ClubTypesController extends AppController {

	var $name = 'ClubTypes';

	function index() {
		$this->ClubType->recursive = 0;
		$this->set('clubTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubType', $this->ClubType->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->ClubType->create();
			if ($this->ClubType->save($this->request->data)) {
				$this->Session->setFlash(__('The club type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club type could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid club type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->ClubType->save($this->request->data)) {
				$this->Session->setFlash(__('The club type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club type could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ClubType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubType->delete($id)) {
			$this->Session->setFlash(__('Club type deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->ClubType->recursive = 0;
		$this->set('clubTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club type'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubType', $this->ClubType->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->ClubType->create();
			if ($this->ClubType->save($this->request->data)) {
				$this->Session->setFlash(__('The club type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club type could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid club type'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->ClubType->save($this->request->data)) {
				$this->Session->setFlash(__('The club type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club type could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ClubType->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club type'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubType->delete($id)) {
			$this->Session->setFlash(__('Club type deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function Information()
    {
	$id=$this->request->params['requested'];
	
	$info=$this->ClubType->findById($id);
	$information["id"]=$info["ClubType"]["id"];
	$information["type_name"]=$info['ClubType']['type_name'];
	return $information;
	}
}
?>
