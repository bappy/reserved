<?php
class ClubOpenDaysController extends AppController {

	var $name = 'ClubOpenDays';

	function index() {
		$this->ClubOpenDay->recursive = 0;
		$this->set('clubOpenDays', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club open day'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubOpenDay', $this->ClubOpenDay->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->ClubOpenDay->create();
			if ($this->ClubOpenDay->save($this->request->data)) {
				$this->Session->setFlash(__('The club open day has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club open day could not be saved. Please, try again.'));
			}
		}
		$clubs = $this->ClubOpenDay->Club->find('list');
		$this->set(compact('clubs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid club open day'));
			$this->redirect(array('action' => 'index'));
			
		}
		if (!empty($this->request->data)) {
			if ($this->ClubOpenDay->save($this->request->data)) {
				$this->Session->setFlash(__('The club open day has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club open day could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ClubOpenDay->read(null, $id);
		}
		$clubs = $this->ClubOpenDay->Club->find('list');
		$this->set(compact('clubs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club open day'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubOpenDay->delete($id)) {
			$this->Session->setFlash(__('Club open day deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club open day was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->ClubOpenDay->recursive = 0;
		$this->set('clubOpenDays', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid club open day'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('clubOpenDay', $this->ClubOpenDay->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->ClubOpenDay->create();
			if ($this->ClubOpenDay->save($this->request->data)) {
				$this->Session->setFlash(__('The club open day has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club open day could not be saved. Please, try again.'));
			}
		}
		$clubs = $this->ClubOpenDay->Club->find('list');
		$this->set(compact('clubs'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid club open day'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->ClubOpenDay->save($this->request->data)) {
				$this->Session->setFlash(__('The club open day has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The club open day could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ClubOpenDay->read(null, $id);
		}
		$clubs = $this->ClubOpenDay->Club->find('list');
		$this->set(compact('clubs'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for club open day'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ClubOpenDay->delete($id)) {
			$this->Session->setFlash(__('Club open day deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Club open day was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>