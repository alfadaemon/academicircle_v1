<?php
class MattersController extends AppController {

	var $name = 'Matters';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $layout = 'ajax';

	function index() {
		$this->Matter->recursive = 0;
		$this->set('matters', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('matter', $this->Matter->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Matter->create();
			if ($this->Matter->save($this->data)) {
				$this->Session->setFlash(__('The Matter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Matter could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Matter->save($this->data)) {
				$this->Session->setFlash(__('The Matter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Matter could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Matter->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Matter->del($id)) {
			$this->Session->setFlash(__('Matter deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Matter could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}


	function adminis_index() {
		$this->Matter->recursive = 0;
		$this->set('matters', $this->paginate());
	}

	function adminis_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('matter', $this->Matter->read(null, $id));
	}

	function adminis_add() {
		if (!empty($this->data)) {
			$this->Matter->create();
			if ($this->Matter->save($this->data)) {
				$this->Session->setFlash(__('The Matter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Matter could not be saved. Please, try again.', true));
			}
		}
	}

	function adminis_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Matter->save($this->data)) {
				$this->Session->setFlash(__('The Matter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Matter could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Matter->read(null, $id);
		}
	}

	function adminis_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Matter', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Matter->del($id)) {
			$this->Session->setFlash(__('Matter deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Matter could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>