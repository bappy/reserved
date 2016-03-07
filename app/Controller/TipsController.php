<?php
class TipsController extends AppController {

	var $name = 'Tips';

	function index() {
		$this->Tip->recursive = 0;
		$this->set('tips', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tip'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tip', $this->Tip->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Tip->create();
			if ($this->Tip->save($this->request->data)) {
				$this->Session->setFlash(__('The tip has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid tip'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Tip->save($this->request->data)) {
				$this->Session->setFlash(__('The tip has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Tip->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tip'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tip->delete($id)) {
			$this->Session->setFlash(__('Tip deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tip was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Tip->recursive = 0;
		$this->set('tips', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid tip'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tip', $this->Tip->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->Tip->create();
			if ($this->Tip->save($this->request->data)) {
				$this->Session->setFlash(__('The tip has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid tip'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Tip->save($this->request->data)) {
				$this->Session->setFlash(__('The tip has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tip could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Tip->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for tip'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tip->delete($id)) {
			$this->Session->setFlash(__('Tip deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tip was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>