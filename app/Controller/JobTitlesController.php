<?php
class JobTitlesController extends AppController {

	var $name = 'JobTitles';

	function index() {
		$this->JobTitle->recursive = 0;
		$this->set('jobTitles', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid job title'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('jobTitle', $this->JobTitle->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->JobTitle->create();
			if ($this->JobTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The job title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job title could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid job title'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->JobTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The job title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job title could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->JobTitle->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for job title'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JobTitle->delete($id)) {
			$this->Session->setFlash(__('Job title deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Job title was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->JobTitle->recursive = 0;
		$this->set('jobTitles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid job title'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('jobTitle', $this->JobTitle->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->JobTitle->create();
			if ($this->JobTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The job title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job title could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid job title'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->JobTitle->save($this->request->data)) {
				$this->Session->setFlash(__('The job title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job title could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->JobTitle->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for job title'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JobTitle->delete($id)) {
			$this->Session->setFlash(__('Job title deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Job title was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>