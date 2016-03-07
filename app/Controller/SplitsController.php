<?php
class SplitsController extends AppController {

	var $name = 'Splits';

	function index() {
		$this->Split->recursive = 0;
		$this->set('splits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid split'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('split', $this->Split->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Split->create();
			if ($this->Split->save($this->request->data)) {
				$this->Session->setFlash(__('The split has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The split could not be saved. Please, try again.'));
			}
		}
		$users = $this->Split->User->find('list');
		$bookings = $this->Split->Booking->find('list');
		$this->set(compact('users', 'bookings'));
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid split'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Split->save($this->request->data)) {
				$this->Session->setFlash(__('The split has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The split could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Split->read(null, $id);
		}
		$users = $this->Split->User->find('list');
		$bookings = $this->Split->Booking->find('list');
		$this->set(compact('users', 'bookings'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for split'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Split->delete($id)) {
			$this->Session->setFlash(__('Split deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Split was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Split->recursive = 0;
		$this->set('splits', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid split'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('split', $this->Split->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->Split->create();
			if ($this->Split->save($this->request->data)) {
				$this->Session->setFlash(__('The split has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The split could not be saved. Please, try again.'));
			}
		}
		$users = $this->Split->User->find('list');
		$bookings = $this->Split->Booking->find('list');
		$this->set(compact('users', 'bookings'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid split'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Split->save($this->request->data)) {
				$this->Session->setFlash(__('The split has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The split could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Split->read(null, $id);
		}
		$users = $this->Split->User->find('list');
		$bookings = $this->Split->Booking->find('list');
		$this->set(compact('users', 'bookings'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for split'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Split->delete($id)) {
			$this->Session->setFlash(__('Split deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Split was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>