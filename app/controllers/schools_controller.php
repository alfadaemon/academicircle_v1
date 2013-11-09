<?php
class SchoolsController extends AppController {

	var $name = 'Schools';
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
	var $uses = array('School', 'User');
	var $layout = 'ajax';

	function index() {
		$this->School->recursive = 0;
        $this->set('schools', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid School', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('school', $this->School->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->School->create();
			if ($this->School->save($this->data)) {
				$this->Session->setFlash(__('The School has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The School could not be saved. Please, try again.', true));
			}
		}
        $this->set('users', $this->User->find('list', array('conditions'=>array('active'=>1))));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid School', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->School->save($this->data)) {
				$this->Session->setFlash(__('The School has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The School could not be saved. Please, try again.', true));
			}
		}
		else {
			$this->data = $this->School->read(null, $id);
            $this->set('users', $this->User->find('list', array('conditions'=>array('User.school_id'=>$id, 'active'=>1))));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for School', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->School->delete($id)) {
			$this->Session->setFlash(__('School deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The School could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
