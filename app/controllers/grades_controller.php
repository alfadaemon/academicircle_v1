<?php
class GradesController extends AppController {

	var $name = 'Grades';
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
	var $uses = array('Grade', 'School');
	var $layout = 'ajax';

	function index() {
		$this->Grade->recursive = 0;
        if(isset($this->data)){
            $this->paginate=array('conditions'=>array('Grade.school_id'=>$this->data['schools']), 'order'=>array('Grade.school_id', 'Grade.id'));
        }
        else{
            $this->paginate=array('conditions'=>array('School.active'=>1), 'order'=>array('Grade.school_id', 'Grade.id'));
        }
		$this->set('grades', $this->paginate());
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('grade', $this->Grade->read(null, $id));
	}

	function add() {
        $schools = $this->School->find('list', array('conditions' => array('School.active' => 1)));
        $this->set(compact('schools'));
		if (!empty($this->data)) {
			$this->Grade->create();
			if ($this->Grade->save($this->data)) {
				$this->Session->setFlash(__('The Grade has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Grade could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
        $schools = $this->School->find('list', array('conditions' => array('School.active' => 1)));
        $this->set(compact('schools'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Grade->save($this->data)) {
				$this->Session->setFlash(__('The Grade has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Grade could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Grade->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Grade->del($id)) {
			$this->Session->setFlash(__('Grade deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Grade could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}


	function adminis_index() {
		$this->Grade->recursive = 0;
		$this->set('grades', $this->paginate());
	}

	function adminis_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('grade', $this->Grade->read(null, $id));
	}

	function adminis_add() {
		if (!empty($this->data)) {
			$this->Grade->create();
			if ($this->Grade->save($this->data)) {
				$this->Session->setFlash(__('The Grade has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Grade could not be saved. Please, try again.', true));
			}
		}
	}

	function adminis_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Grade->save($this->data)) {
				$this->Session->setFlash(__('The Grade has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Grade could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Grade->read(null, $id);
		}
	}

	function adminis_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Grade', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Grade->del($id)) {
			$this->Session->setFlash(__('Grade deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Grade could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>