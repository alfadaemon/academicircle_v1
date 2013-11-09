<?php
class ArosController extends AppController {

	var $name = 'Aros';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	//var $components = array('Acl', 'Auth');

	function index() {
		$this->Aro->recursive = 0;
		$this->set('aros', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Aro', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('aro', $this->Aro->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Aro->create();
			if ($this->Aro->save($this->data)) {
				$this->Session->setFlash(__('The Aro has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Aro could not be saved. Please, try again.', true));
			}
		}
		$acos = $this->Aro->Aco->find('list');
		$this->set(compact('acos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Aro', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Aro->save($this->data)) {
				$this->Session->setFlash(__('The Aro has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Aro could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Aro->read(null, $id);
		}
		$acos = $this->Aro->Aco->find('list');
		$this->set(compact('acos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Aro', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Aro->del($id)) {
			$this->Session->setFlash(__('Aro deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Aro could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
