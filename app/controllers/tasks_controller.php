<?php
class TasksController extends AppController {

	var $name = 'Tasks';
    var $uses = array('Task', 'Schedule', 'Student', 'Ancestor', 'Section');//, 'Gradebook');
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $layout = 'ajax';
    var $components = array('Email', 'RequestHandler');

	function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

    function updatetitle(){
        if ($this->RequestHandler->isAjax())
        {
            App::import('Core', 'sanitize');
            $name = Sanitize::clean($this->params['form']['value']);

            $this->Task->id = $this->params['form']['id'];;
            $this->Task->saveField('title', $name);

            Configure::write('debug', 0);

            $this->set('tasktitle', $name);
        }
    }

    function updatedescription(){
        if ($this->RequestHandler->isAjax())
        {
            App::import('Core', 'sanitize');
            $name = Sanitize::clean($this->params['form']['value']);

            $this->Task->id = $this->params['form']['id'];;
            $this->Task->saveField('description', $name);

            Configure::write('debug', 0);

            $this->set('taskdescription', $name);
        }
    }

	function view($id = null) {
        //TODO: Validate that the user have right to see this task (by $id)
		if (!$id) {
			//$this->Session->setFlash(__('Invalid Task', true));
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->set('task', $this->Task->read(null, $id));
	}

    function viewall($scheduleid = null) {
        //TODO: Validate that the user have right to see tasks (by $scheduleid)
		if (!$scheduleid) {
			$this->Session->setFlash(__('Invalid Schedule', true));
			return;
		}
        $this->Schedule->recursive = 0;
        $scheduleinfo = $this->Schedule->find('first', array('fields'=>array('Schedule.id'
                                                                            , 'User.id', 'Section.name', 'Subject.name')
                                                            , 'conditions'=>array('Schedule.id'=>$scheduleid)));
        $this->Task->recursive = -1;
        if(!isset($this->data)){
            $startdate= date('Y-m-d', strtotime(date('Y')."W".date('W')));
            $enddate= date('Y-m-d', strtotime($startdate.' +6 days'));
            
        }
        else{
            $startdate=$this->data['startdate'];
            $enddate=$this->data['enddate'];
        }
        $tasks = $this->Task->find('all', array('conditions'=>array('schedule_id'=>$scheduleid, 'duedate >='=>$startdate
                                                                       ,'duedate <='=>$enddate)));
        $this->set(compact('startdate','enddate'));
		$this->set(compact('tasks','scheduleinfo'));
        if(empty($tasks)){
            $this->Session->setFlash(__d('logged', 'sorryNoRecords', true));
        }
	}

    function viewlist($teacherid = null ){
        //TODO: Validate that the user have right to see this task (by $teacherid)
        if(!$teacherid){
            //$this->Session->setFlash(__('Invalid Task', true));
			$this->redirect(array('controller'=>'users', 'action' => 'dash'));
        }

        if(!isset($this->data)){
            $startdate= date('Y-m-d', strtotime(date('Y')."W".date('W')));
            $enddate= date('Y-m-d', strtotime($startdate.' +6 days'));
        }
        else{
            $startdate=$this->data['startdate'];
            $enddate=$this->data['enddate'];
        }

        $this->Schedule->bindModel(
            array('hasMany'=>array('Task'=>array(
                            'className' => 'Task',
                            'foreignKey' => 'schedule_id',
                            'dependent' => false,
                            'conditions' => array('Task.duedate >='=>$startdate, 'Task.duedate <='=>$enddate),
                            'fields' => '',
                            'order' => 'duedate ASC',
                //			'limit' => '',
                //			'offset' => '',
                //			'exclusive' => '',
                //			'finderQuery' => '',
                //			'counterQuery' => ''
                                    )
                             )
                )
            );
        $tasklist = $this->Schedule->find('all',array(//'fields'=>array('Schedule.id', 'Section.name', 'Subject.name')
                                                    'conditions'=>array('Schedule.active'=>1, 'Section.active'=>1, 'Schedule.teacher_id'=>$teacherid)//, 'Task.duedate >='=>$startdate, 'Task.duedate <='=>$enddate)
                                                    ));

        if(!empty($tasklist)){
            $this->set(compact('tasklist'));
        }
        else{
            $this->Session->setFlash(__d('logged', 'sorryNoRecords', true));
        }
        $this->set(compact('teacherid','startdate','enddate'));
    }

	function add($schedule = null) {
		if (!empty($this->data)) {
            //Validate that the schedule it is his/hers
            $this->data['Task']['user_id']=$this->Session->read('Auth.User.id');
            $this->Schedule->recursive=0;
            $validSchedule = $this->Schedule->find('first',array(
                                                            'conditions'=>array('Schedule.id'=>$this->data['Task']['schedule_id']
                                                                            , 'teacher_id'=>$this->data['Task']['user_id'])
                                                                )
                                                  );

            if(!empty($validSchedule)){
                $schedule=$this->data['Task']['schedule_id'];
                //TODO: Validate that the date is lined up with the weekdays on the schedule
                $this->Task->create();
                if($this->Task->validates($this->data)){
                    if ($this->Task->save($this->data)) {
                        $this->data['Task']['id'] = $this->Task->getLastInsertId();
                        
                        $this->Session->setFlash(__('The Task has been saved', true));
                        //Send the email notification to all involved
                        $this->_sendTaskNotification($this->data);

                        //$this->redirect(array('controller'=>'users', 'action' => 'mysections'));
                    }
                    else {
                        $this->Session->setFlash(__d('logged', 'taskNotSaved', true));
                    }
                }
                else {
                        $this->Session->setFlash(__d('logged', 'taskNotSaved', true));
                    }
            }
            else{
                $this->Session->setFlash(__d('logged', 'notAuthorized', true));
            }
		}
        if($schedule!=null){
            $this->set('schedule', $schedule);
        }
	}

    function _sendTaskReminder($task, $users){
        $this->set('username', $this->Session->read('Auth.User.username'));
        
        $this->Email->reset();
        $this->Email->sendAs = 'text'; // both = html + plain text
        $this->Email->from = 'Reminder <reminder@academicircle.com>';
        //$this->Email->to = 'deferred@deferredsender.com';
        $this->Email->to = 'me@lettermelater.com';
        $this->Email->subject = 'academicircle.com - Reminder!';
        $this->Email->template = 'reminder';
        $this->Email->layout = 'default';
        //set reminder date at 2pm the day before
        $fecha = strtotime($task['Task']['duedate'].' -1 days' );
        $date = date('M j Y 08:00', $fecha);
        $this->set('date', $date);
        $this->set('users', $users);

        /* SMTP Options
        $this->Email->smtpOptions = array(
            'port'=>'25',
            'timeout'=>'30',
            'host' => 'smtp.1and1.com',
            'username'=>'reminder@academicircle.com',
            'password'=>'myg00dp4$$'
            //,'client' => 'smtp_helo_hostname'
        );
        /* Set delivery method */
        $this->Email->delivery = 'mail';
        //$this->Email->send();
        if( !$this->Email->send() ){
            $this->Session->setFlash(__('The Task reminder could not be programmed.', true));
        }
    }

    function _sendTaskNotification($task){
        $this->set('task', $task);

        //Find the schedule information for the rest of the email
        $this->Schedule->recursive = 0;
        $schedule = $this->Schedule->find('first',
                                        array('conditions'=>array('Schedule.id'=>$task['Task']['schedule_id']),
                                              'fields'=>array('Subject.name', 'Section.id', 'Section.name', 'User.fname', 'User.flname', 'User.username')
                                            )
                                        );
        //TODO: get the parents and students in the section that will get notified
        $students= $this->Student->find('all', array('conditions'=>array('Section.id'=>$schedule['Section']['id']),
                                                    'fields'=>array('Student.id', 'User.username', 'User.fname', 'User.flname', 'User.altemail')
                                                  )
                                     );

        $this->set(compact('schedule'));//, 'students'));
        
        $usernames = array();
        $usrs = '';
        //Create array for sending emails to students
        //and create the array for parents' emails
        //TODO: create the gradebook entries
        foreach($students as $student){
            $parents = $this->Ancestor->find('all', array('conditions'=>array('Ancestor.student_id'=>$student['Student']['id']),
                                                            'fields'=>array('User.username', 'User.fname', 'User.flname', 'User.altemail')
                                                            )
                                                );

            //Used for the notifications
            $usernames[]=$student['User']['username'];
            //Used for the reminders
            $usrs .= $student['User']['username'].',';
            
            foreach($parents as $parent){
                    $usernames[]=$parent['User']['username'];
                    $usrs .= $parent['User']['username'].',';
            }

            //Create gradebook entries
            /*$gradebook['Gradebook']['task_id']=$task['Task']['id'];
            $gradebook['Gradebook']['student_id']=$student['Student']['id'];
            $gradebook['Gradebook']['score']=0;
            $gradebook['Gradebook']['user_id']=$this->Session->read('Auth.User.id');
            $gradebook['Gradebook']['updated']=date('Y-m-d H:i:s');
            $this->Gradebook->create();
            if($this->Gradebook->validates($gradebook)){
                $this->Gradebook->create();
                if($this->Gradebook->save($gradebook)){
                    $this->Session->setFlash(__('Notifications sent and gradebook entry created!', true));
                }
                else{
                    $this->Session->setFlash(__('Error creating gradebook entry. Please report this to support@academicircle.com.', true));
                }
            }*/
        }
        
        if($task['Task']['notifynow']){
            //Send emails to parents and students
            $this->Email->reset();
            $this->Email->sendAs = 'both'; // both = html + plain text
            $this->Email->to=$this->Session->read('Auth.User.username');
            $this->Email->cc = array('notifications@academicircle.com');
            $this->Email->bcc = $usernames;
            $this->Email->from = 'Notification from academicircle.com <notifications@academicircle.com>';
            $this->Email->replyTo = '<noreply@academicircle.com>';
            $this->Email->return = '<notifications@academicircle.com>';
            $this->Email->subject = 'academicircle.com - New Task added!';
            $this->Email->template = 'new_task';
            $this->Email->layout = 'default';

            /* SMTP Options
            $this->Email->smtpOptions = array(
                'port'=>'25',
                'timeout'=>'30',
                'host' => 'smtp.1and1.com',
                'username'=>'notifications@academicircle.com',
                'password'=>'myg00dp4$$'
                //,'client' => 'smtp_helo_hostname'
            );
            /* Set delivery method */
            $this->Email->delivery = 'mail';// 'smtp';

            //$this->Email->send();
            if( $this->Email->send() ){
                $this->Session->setFlash(__('The Task notification was sent.', true));
            }
            else {
                $this->Session->setFlash(__('The Task notification could not be sent.', true));
                //echo 'Error: <br /><br />';
                //echo print_r($this->Email);
                //echo '<br /><br />';
            }
        }
        else{
            $this->Session->setFlash(__('Only the reminder will be sent.', true));
        }

        if($task['Task']['reminder']){
            $this->_sendTaskReminder($task, $usrs);
        }
        else{
            $this->Session->setFlash(__('The reminder was not programmed.', true));
        }
    }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Task', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Task->save($this->data)) {
				$this->Session->setFlash(__('The Task has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Task could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}
	}

	function delete($id = null, $scheduleid=null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Task', true));
		}
		if ($this->Task->delete($id)) {
			$this->Session->setFlash(__d('logged', 'task', true).' '.__d('logged', 'delete', true));
		}
        else{
            $this->Session->setFlash(__('The Task could not be deleted. Please, try again.', true));
        }
		$this->redirect(array('action' => 'viewall',$scheduleid));
	}

    function deletep($id = null, $seccion=0, $week=0) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Task', true));
		}
		if ($this->Task->delete($id)) {
			$this->Session->setFlash(__d('logged', 'task', true).' '.__d('logged', 'delete', true));
		}
        else{
            $this->Session->setFlash(__('The Task could not be deleted. Please, try again.', true));
        }
        $this->redirect(array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 0));
	}
}
?>
