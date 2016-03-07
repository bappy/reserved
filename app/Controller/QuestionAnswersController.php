<?php
class QuestionAnswersController extends AppController {

	var $name = 'QuestionAnswers';

	function index() {
		$this->QuestionAnswer->recursive = 0;
		$this->set('questionAnswers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid question answer'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('questionAnswer', $this->QuestionAnswer->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->QuestionAnswer->create();
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		$users = $this->QuestionAnswer->User->find('list');
		$questions = $this->QuestionAnswer->Question->find('list');
		$this->set(compact('users', 'questions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid question answer'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->QuestionAnswer->read(null, $id);
		}
		$users = $this->QuestionAnswer->User->find('list');
		$questions = $this->QuestionAnswer->Question->find('list');
		$this->set(compact('users', 'questions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for question answer'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->QuestionAnswer->delete($id)) {
			$this->Session->setFlash(__('Question answer deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Question answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->QuestionAnswer->recursive = 0;
		$this->set('questionAnswers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid question answer'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('questionAnswer', $this->QuestionAnswer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->QuestionAnswer->create();
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		$users = $this->QuestionAnswer->User->find('list');
		$questions = $this->QuestionAnswer->Question->find('list');
		$this->set(compact('users', 'questions'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid question answer'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->QuestionAnswer->save($this->request->data)) {
				$this->Session->setFlash(__('The question answer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question answer could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->QuestionAnswer->read(null, $id);
		}
		$users = $this->QuestionAnswer->User->find('list');
		$questions = $this->QuestionAnswer->Question->find('list');
		$this->set(compact('users', 'questions'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for question answer'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->QuestionAnswer->delete($id)) {
			$this->Session->setFlash(__('Question answer deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Question answer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>