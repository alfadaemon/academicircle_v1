<?php
class GroupsUsersController extends AppController {

	var $name = 'GroupsUsers';
	var $helpers = array('Html', 'Form');
	var $layout = 'ajax';

	function beforeFilter() {
                parent::beforeFilter();
                //$this->Auth->allowedActions = array('*');
        }

	function index() {
		$this->GroupsUser->recursive = 0;
		$this->set('groupsUsers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid GroupsUser', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('groupsUser', $this->GroupsUser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->GroupsUser->create();
			if ($this->GroupsUser->save($this->data)) {
				$this->Session->setFlash(__('The GroupsUser has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GroupsUser could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid GroupsUser', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->GroupsUser->save($this->data)) {
				$this->Session->setFlash(__('The GroupsUser has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The GroupsUser could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->GroupsUser->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for GroupsUser', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->GroupsUser->delete($id)) {
			$this->Session->setFlash(__('GroupsUser deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The GroupsUser could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
