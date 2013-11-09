<?php
class GradebooksController extends AppController {

	var $name = 'Gradebooks';
    var $uses = array('Schedule', 'Student', 'User', 'Section', 'Subject', 'Gradebook');
	var $helpers = array('Html', 'Form');
    var $layout = 'ajax';
    var $components = array('RequestHandler');

	function index() {
		$this->Gradebook->recursive = 0;
		$this->set('gradebooks', $this->paginate());
	}

    function updatescore(){
        if ($this->RequestHandler->isAjax())
        {
            App::import('Core', 'sanitize');
            $name = Sanitize::clean($this->params['form']['value']);

            $this->Gradebook->id = $this->params['form']['id'];;
            $this->Gradebook->saveField('score', $name);

            Configure::write('debug', 0);

            $this->set('newscore', $name);
        }
    }

    function bygrade($grade=0, $section=0){
        $this->Subject->recursive=-1;
        $subjects=$this->Subject->find('all', array('fields'=>array('Subject.*')
                                                     ,'conditions'=>array('Subject.grade_id'=>$grade)
                                                )
                                    );
        $this->set(compact('grade', 'subjects','section'));
    }

    function bysubject($subject=0, $section=0){
        $this->redirect(array('controller' =>'teachers','action' =>'gradebooks', $section, $subject));
    }

    function bystudent($student=0){
        echo 'Lista de clases';
    }
    
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Gradebook', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gradebook', $this->Gradebook->read(null, $id));
	}

	function add($schedule = null) {
		if (!empty($this->data)) {
			$this->Gradebook->create();
			if ($this->Gradebook->save($this->data)) {
				$this->Session->setFlash(__('The Gradebook has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gradebook could not be saved. Please, try again.', true));
			}
		}
        $this->Student->find('all');
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Gradebook', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gradebook->save($this->data)) {
				$this->Session->setFlash(__('The Gradebook has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gradebook could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gradebook->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Gradebook', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Gradebook->del($id)) {
			$this->Session->setFlash(__('Gradebook deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Gradebook could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>