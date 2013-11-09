<?php
class StudentsController extends AppController {

	var $name = 'Students';
    var $uses = array('Student', 'User', 'School', 'Section', 'Gradebook', 'Year');
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
	var $layout = 'ajax';

	function index() {
        $this->layout='ajax';
		$this->Student->recursive = 0;
        $selectedSchool=null;
        $order=array('Student.id', 'section_id');
        if(isset($this->data['schools']) && !empty($this->data['schools'])){
            $this->paginate=array('conditions'=>array('Section.school_id'=>$this->data['schools'], 'Section.active'=>1), 'order'=>$order);
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->data['schools'])));
        }
        elseif(isset($this->data['sections'])&& !empty($this->data['sections'])){
            $this->paginate=array('conditions'=>array('Student.section_id'=>$this->data['sections'],'Section.active'=>1), 'order'=>$order);
            $temp=$this->Section->find('first',array('conditions'=>array('Section.id'=>$this->data['sections']), 'fields'=>'Section.school_id'));
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$temp['Section']['school_id'])));
            $selectedSchool=$temp['Section']['school_id'];
        }
        else{
            $this->paginate=array('order'=>$order);
            $sections=$this->Section->find('list', array('conditions'=>array('Section.active'=>1)) );
        }
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'sections','selectedSchool'));
		$this->set('students', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Student', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('student', $this->Student->read(null, $id));
	}

	function add() {
        $selectedSchool=null;
        $selectedSection=null;
		if (!empty($this->data['Student']['section_id']) && isset($this->data['Student']['section_id']) ) {
			$this->Student->create();
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash(__('The Student has been saved', true));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Student could not be saved. Please, try again.', true));
			}
		}

        //Search all users with the student roll
        $inGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>5), 'fields'=>array('user_id')));
        if(isset($this->data['Student']['school_id']) && !empty($this->data['Student']['school_id'])){
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->data['Student']['school_id'])));
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inGroup, 'User.school_id'=>$this->data['Student']['school_id'])));
        }
        else{
            $sections=$this->Section->find('list', array('conditions'=>array('Section.active'=>1)) );
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inGroup)));
        }
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('sections', 'users', 'schools', 'selectedSchool', 'selectedSection'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Student', true));
			$this->redirect(array('action' => 'index'));
		}

        if (!empty($this->data['Student']['section_id']) && isset($this->data['Student']['section_id']) ) {
            //$this->data['Student']['id']=$this->data['Student']['id'];
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash(__('The Student has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Student could not be saved. Please, try again.', true));
                $this->redirect(array('action' => 'edit', $id));
			}
		}

        $this->data['Student']['id']=$id;
        $usr = $this->Student->read(null, $id);
        $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$usr['User']['school_id'])));
        $users=$this->User->find('list', array('conditions'=>array('User.active'=>1, 'User.id'=>$usr['Student']['user_id']) ));
        $this->set(compact('sections', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Student', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Student->delete($id)) {
			$this->Session->setFlash(__('Student deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Student could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
        
        function gradebook() {
            $this->Student->recursive=0;
            
            $this->Year->recursive=-1;
            $periods=$this->Year->find('first', array('fields'=>array('periods'), 'conditions'=>array('active'=>1, 'school_id'=>$this->Session->read('Auth.User.school_id'))));
            
            //TODO: Check this, is getting the max id for the section where the student is "subscribed",
            //      the right way would be to get the secction from the active year and school.
            $id = $this->Student->findByUserId($this->Session->read('Auth.User.id'), array('id','max(section_id) as sid'));
            
            $sid=$id['Student'];
            $t=$id[0];
            $id=$t['sid'];
            if(!$id){
                $this->Session->setFlash(__('You are not registered as a student', true) );
            }
            else
            {
                $this->Section->recursive=0;
                $subjects= $this->Section->query('select m.id, m.name, s.name from sections s '
                                      .'    left join subjects m on s.grade_id=m.grade_id '
                                      .'where s.active=1 and s.id='.$id,false);
                $section = $subjects[0]['s'];
                
                foreach($subjects as &$subject)
                {
                    $this->Gradebook->recursive=-1;
                    $conditions = array('section_id'=>$id, 'subject_id'=>$subject['m']['id'], 'student_id'=>$sid['id']);
                    $subject['Gradebook']=$this->Gradebook->find('all', array('conditions'=>$conditions));
                }
                //$this->set('section', $id);
                $this->set('sectionName', $section['name']);
                $this->set(compact('subjects'));
                $this->set(compact('periods'));
            }
	}
}
?>
