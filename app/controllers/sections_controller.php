<?php
class SectionsController extends AppController {

	var $name = 'Sections';
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
    var $uses = array('Section', 'Grade', 'School', 'Year');
	var $layout = 'ajax';

	function index() {
		$this->Section->recursive = 0;
        if(isset($this->data['schools'])){
            $this->paginate=array('conditions'=>array('Section.school_id'=>$this->data['schools']), 'order'=>array('Section.school_id', 'Section.grade_id', 'Section.id'));
            $grades=$this->Grade->find('list',array('conditions'=>array('Grade.school_id'=>$this->data['schools'])));
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'Year.school_id'=>$this->data['schools'])));
        }
        elseif(isset($this->data['grades'])){
            $this->paginate=array('conditions'=>array('Section.grade_id'=>$this->data['grades']), 'order'=>array('Section.school_id', 'Section.grade_id', 'Section.id'));
            $grades=$this->Grade->find('list',array('conditions'=>array('Grade.id'=>$this->data['grades'])));
            $school=$this->Section->find('first',array('conditions'=>array('Section.grade_id'=>$this->data['grades']),'fields'=>array('Section.school_id')));
            
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'school_id'=>$school['Section']['school_id'])));
        }
        else{
            $this->paginate=array('order'=>array('Section.school_id', 'Section.grade_id', 'Section.id'));
            $grades=$this->Grade->find('list');
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1)));
        }
		$this->set('sections', $this->paginate());
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'grades', 'years'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Section', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('section', $this->Section->read(null, $id));
	}

	function add() {
		if (!empty($this->data['Section']['year_id'])) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The Section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Section could not be saved. Please, try again.', true));
			}
		}
        $this->Grade->recursive=0;
        $this->Year->recursive=0;
        $this->School->recursive=0;
        $selectedSchool=null;
        if(isset($this->data['Section']['school_id'])){
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.school_id'=>$this->data['Section']['school_id'])));
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'Year.school_id'=>$this->data['Section']['school_id'])));
            $selectedSchool = $this->data['Section']['school_id'];
        }elseif(isset($this->data['Section']['grade_id'])){
            $selectedSchool=$this->Grade->find('first', array('conditions'=>array('Grade.id'=>$this->data['Section']['grade_id']), 'fields'=>array('Grade.school_id')));
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.school_id',$selectedSchool['Grade']['school_id'])));
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'Year.school_id'=>$selectedSchool['Grade']['school_id'])));
            $selectedSchool = $selectedSchool['Grade']['school_id'];
        }else{
            $grades=$this->Grade->find('list');
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1)));
        }
        $this->set('selectedSchool', $selectedSchool);
        $schools=$this->School->find('list');
        $this->set(compact('schools', 'grades', 'years'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Section', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data['Section']['year_id'])) {
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('The Section has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Section could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
        if(isset($this->data['Section']['school_id'])){
            $temp = $this->data['Section']['school_id'];
            $this->data = $this->Section->read(null, $id);
            $this->data['Section']['school_id']=$temp;
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.school_id'=>$temp)));
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'Year.school_id'=>$this->data['Section']['school_id'])));
        }elseif(isset($this->data['Section']['grade_id'])){
            $temp = $this->data['Section']['grade_id'];
            $this->data = $this->Section->read(null, $id);
            $this->data['Section']['grade_id']=$temp;

            $grade=$this->Grade->find('first', array('conditions'=>array('Grade.id'=>$temp)));
            $this->data['Section']['school_id']=$grade['Grade']['school_id'];
            $grades=$this->Grade->find('list', array('conditions'=>array('Grade.id'=>$temp)));
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1, 'Year.school_id'=>$this->data['Section']['school_id'])));
        }else{
            $grades=$this->Grade->find('list');
            $years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1)));
        }
        $schools=$this->School->find('list', array('conditions'=>array('School.active'=>1)));
        $this->set(compact('schools', 'grades', 'years'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Section', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Section->delete($id)) {
			$this->Session->setFlash(__('Section deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Section could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
