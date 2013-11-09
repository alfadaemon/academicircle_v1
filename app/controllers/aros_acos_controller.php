<?php
class ArosAcosController extends AppController {

	var $name = 'ArosAcos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	//var $components = array('Acl', 'Auth');

	function index() {
		$this->ArosAco->recursive = 0;
		$this->set('arosAcos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ArosAco', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('arosAco', $this->ArosAco->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ArosAco->create();
			if ($this->ArosAco->save($this->data)) {
				$this->Session->setFlash(__('The ArosAco has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ArosAco could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ArosAco', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ArosAco->save($this->data)) {
				$this->Session->setFlash(__('The ArosAco has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ArosAco could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ArosAco->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ArosAco', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->ArosAco->del($id)) {
			$this->Session->setFlash(__('ArosAco deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The ArosAco could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
