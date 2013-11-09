<?php
class SubjectsController extends AppController {

	var $name = 'Subjects';
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
    var $uses = array('Subject', 'Grade', 'School');
	var $layout = 'ajax';

	function index() {
		$this->Subject->recursive = 0;
        if(isset($this->data['schools'])){
            $this->paginate=array('conditions'=>array('Subject.school_id'=>$this->data['schools']), 'order'=>array('Subject.school_id', 'Subject.grade_id', 'Subject.id'));
            $grades=$this->Grade->find('list',array('conditions'=>array('Grade.school_id'=>$this->data['schools'])));
        }
        elseif(isset($this->data['grades'])){
            $this->paginate=array('conditions'=>array('Subject.grade_id'=>$this->data['grades']), 'order'=>array('Subject.school_id', 'Subject.grade_id', 'Subject.id'));
            $grades=$this->Grade->find('list',array('conditions'=>array('Grade.id'=>$this->data['grades'])));
        }
        else{
            $this->paginate=array('order'=>array('Subject.school_id', 'Subject.grade_id', 'Subject.id'));
            $grades=$this->Grade->find('list');
        }
		$this->set('subjects', $this->paginate());
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'grades'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Subject', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subject', $this->Subject->read(null, $id));
	}

	function add() {
		if (!empty($this->data['Subject']['grade_id'])) {
			$this->Subject->create();
			if ($this->Subject->save($this->data)) {
				$this->Session->setFlash(__('The Subject has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Subject could not be saved. Please, try again.', true));
			}
		}
        if(isset($this->data['Subject']['school_id'])){
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.school_id'=>$this->data['Subject']['school_id'])));
        }else{
            $grades=$this->Grade->find('list');
        }
        $schools=$this->School->find('list');
        $this->set(compact('schools', 'grades'));
	}

	function edit($id = null) {
//        echo '<span>'.print_r($this->data).'</span>';
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Subject', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data['Subject']['grade_id'])) {
            if ($this->Subject->save($this->data)) {
                $this->Session->setFlash(__('The Subject has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Subject could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Subject->read(null, $id);
        }
        if(isset($this->data['Subject']['school_id'])){
            $temp = $this->data['Subject']['school_id'];
            $this->data = $this->Subject->read(null, $id);
            $this->data['Subject']['school_id']=$temp;
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.school_id'=>$temp)));
        }else{
            $grades=$this->Grade->find('list');
        }
        
        $schools=$this->School->find('list');
        $this->set(compact('schools', 'grades'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Subject', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Subject->delete($id)) {
			$this->Session->setFlash(__('Subject deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Subject could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
