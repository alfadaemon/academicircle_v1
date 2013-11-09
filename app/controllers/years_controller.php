<?php
class YearsController extends AppController {

	var $name = 'Years';
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
    var $uses = array('Year', 'School');
	var $layout = 'ajax';

	function index() {
		$this->Year->recursive = 0;
        if(isset($this->data)){
            $this->paginate=array('conditions'=>array('Year.school_id'=>$this->data['schools']), 'order'=>array('Year.school_id', 'Year.id'));
        }
        else{
            $this->paginate=array('conditions'=>array('Year.active'=>1), 'order'=>array('Year.school_id', 'Year.id'));
        }
        $this->set('years', $this->paginate());
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Year', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('year', $this->Year->read(null, $id));
	}

	function add() {
        $schools = $this->School->find('list', array('conditions' => array('School.active' => 1)));
        $this->set(compact('schools'));
		if (!empty($this->data)) {
			$this->Year->create();
			if ($this->Year->save($this->data)) {
				$this->Session->setFlash(__('The Year has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Year could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
        $schools = $this->School->find('list', array('conditions' => array('School.active' => 1)));
        $this->set(compact('schools'));
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Year', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Year->save($this->data)) {
				$this->Session->setFlash(__('The Year has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Year could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Year->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Year', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Year->delete($id)) {
			$this->Session->setFlash(__('Year deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Year could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
