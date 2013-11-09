<?php
class AncestorsController extends AppController {

	var $name = 'Ancestors';
    var $uses = array('Ancestor', 'User', 'School', 'Student');
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler');
	var $layout = 'ajax';

	function index() {
		$this->Ancestor->recursive = 0;
		$this->set('ancestors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Ancestor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ancestor', $this->Ancestor->read(null, $id));
	}

	function add() {
		if (!empty($this->data['Ancestor']['student_id']) && isset($this->data['Ancestor']['student_id']) ) {
			$this->Ancestor->create();
			if ($this->Ancestor->save($this->data)) {
				$this->Session->setFlash(__('The Ancestor has been saved', true));
				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The Ancestor could not be saved. Please, try again.', true));
			}
		}
        
        //Search all users with the parent roll
        $inParentsGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>4), 'fields'=>array('user_id')));
        //Search all users with the student roll
        $inStudentsGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>5), 'fields'=>array('user_id')));
        $this->Student->recursive=1;
        if(isset($this->data['Ancestor']['schools']) && !empty($this->data['Ancestor']['schools'])){
            //Search all users with the student roll
            $studentstmp=$this->Student->find('all',array('conditions'=>array('Student.user_id'=>$inStudentsGroup, 'User.school_id'=>$this->data['Ancestor']['schools']),
                                                'fields'=>array('Student.id', 'User.username', 'User.fname', 'User.flname')));
            foreach($studentstmp as $tmp){
                $students[$tmp['Student']['id']]=$tmp['User']['username'].' - '.$tmp['User']['fname'].' '.$tmp['User']['flname'];
            }
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inParentsGroup, 'User.school_id'=>$this->data['Ancestor']['schools'])));
        }
        else{
            //Search all users with the student roll
            $studentstmp=$this->Student->find('all', array('conditions'=>array('Student.user_id'=>$inStudentsGroup),
                                                'fields'=>array('Student.id', 'User.username', 'User.fname', 'User.flname')));
            foreach($studentstmp as $tmp){
                $students[$tmp['Student']['id']]=$tmp['User']['username'].' - '.$tmp['User']['fname'].' '.$tmp['User']['flname'];
            }
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inParentsGroup)));
        }
        //echo '<span>'.print_r($students).'</span>';
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('users', 'schools', 'students'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ancestor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data['Ancestor']['student_id']) && isset($this->data['Ancestor']['student_id']) ) {
			if ($this->Ancestor->save($this->data)) {
				$this->Session->setFlash(__('The Ancestor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Ancestor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ancestor->read(null, $id);
		}

        //Search all users with the parent roll
        $inParentsGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>4), 'fields'=>array('user_id')));
        //Search all users with the student roll
        $inStudentsGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>5), 'fields'=>array('user_id')));
        $this->Student->recursive=1;
        if(isset($this->data['Ancestor']['schools']) && !empty($this->data['Ancestor']['schools'])){
            //Search all users with the student roll
            $studentstmp=$this->Student->find('all',array('conditions'=>array('Student.user_id'=>$inStudentsGroup, 'User.school_id'=>$this->data['Ancestor']['schools']),
                                                'fields'=>array('Student.id', 'User.username', 'User.fname', 'User.flname')));
            foreach($studentstmp as $tmp){
                $students[$tmp['Student']['id']]=$tmp['User']['username'].' - '.$tmp['User']['fname'].' '.$tmp['User']['flname'];
            }
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inParentsGroup, 'User.school_id'=>$this->data['Ancestor']['schools'])));
        }
        else{
            //Search all users with the student roll
            $studentstmp=$this->Student->find('all', array('conditions'=>array('Student.user_id'=>$inStudentsGroup),
                                                'fields'=>array('Student.id', 'User.username', 'User.fname', 'User.flname')));
            foreach($studentstmp as $tmp){
                $students[$tmp['Student']['id']]=$tmp['User']['username'].' - '.$tmp['User']['fname'].' '.$tmp['User']['flname'];
            }
            $users=$this->User->find('list', array('conditions'=>array('active'=>1, 'User.id'=>$inParentsGroup)));
        }
        //echo '<span>'.print_r($students).'</span>';
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('users', 'schools', 'students'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Ancestor', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Ancestor->delete($id)) {
			$this->Session->setFlash(__('Ancestor deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Ancestor could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
