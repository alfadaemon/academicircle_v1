<?php
class SchedulesController extends AppController {

	var $name = 'Schedules';
    var $uses = array('Schedule', 'Section', 'Task', 'Grade', 'School', 'User', 'Subject', 'Student', 'Ancestor');
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler','Email');
	var $layout = 'ajax';
    
	function index() {
        $selectedSchool=null;
		$this->Schedule->recursive = 0;
        $order=array('Section.school_id', 'Section.id', 'Schedule.starts');
        if(isset($this->data['schools']) && !empty($this->data['schools'])){
            $this->paginate=array('conditions'=>array('Schedule.school_id'=>$this->data['schools'], 'Section.active'=>1), 'order'=>$order);
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->data['schools'])));
        }
        elseif(isset($this->data['sections'])&& !empty($this->data['sections'])){
            $this->paginate=array('conditions'=>array('Schedule.section_id'=>$this->data['sections'],'Section.active'=>1), 'order'=>$order);
            $temp=$this->Section->find('first',array('conditions'=>array('Section.id'=>$this->data['sections']), 'fields'=>'Section.school_id'));
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$temp['Section']['school_id'])));
            $selectedSchool=$temp['Section']['school_id'];
        }
        else{
            $this->paginate=array('order'=>$order);
            $sections=$this->Section->find('list', array('conditions'=>array('Section.active'=>1)) );
            //$years=$this->Year->find('list',array('conditions'=>array('Year.active'=>1)));
        }
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'sections','selectedSchool'));
		$this->set('schedules', $this->paginate());
	}

    function notifyParents($id = null, $week=0){
        if(!$id){
            $this->Session->setFlash(__('No section selected.'));
        }
        else{
            $this->Schedule->recursive = 0;
            $schedule = $this->Schedule->find('first',
                                        array('conditions'=>array('Schedule.section_id'=>$id),
                                              'fields'=>array('Subject.name', 'Section.id', 'Section.name', 'User.fname', 'User.flname', 'User.username')
                                            )
                                        );

            $this->set(compact('schedule'));

            //$section = $this->Schedule->findBySectionId($id, 'Section.name');

            $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
            $ends = date('y-m-d', strtotime(date('Y')."W".date('W')."6 +".$week." weeks"));

            //Select the schedules by day of the week
            $sunday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'sunday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $monday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'monday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $tuesday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'tuesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $wednesday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'wednesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $thursday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'thursday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $friday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'friday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));
            $saturday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'saturday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts'), 'order'=>'starts'));

            $schedule_ids=array();
            //Select the tasks by schedules
            foreach($sunday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +0 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($monday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +1 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($tuesday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +2 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($wednesday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +3 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($thursday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +4 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($friday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +5 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            foreach($saturday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +6 days')) ), 'fields'=>array('Task.*')) );
                $schedule_ids[]=$task['Schedule']['id'];
            }

            //Update the status for al the task (sent==1)
            //This can be done to all the task within one query, the only condition
            //is the date range :D
            $this->Task->unBindModel(array('belongsTo'=>array('Schedule', 'User')));
            $this->Task->updateAll(array('sent'=>1), array('schedule_id'=>$schedule_ids, 'duedate >='=>$start, 'duedate <='=>$ends));

            $this->set(compact('sunday','monday','tuesday','wednesday','thursday','friday','saturday', 'start', 'week'));
            $this->set('seccion', $id);
            $this->set('sectionName', $schedule['Section']['name']);

            //Prepare the summary email
            //Get all the students in the section that will get notified
            $students= $this->Student->find('all', array('conditions'=>array('Section.id'=>$id),
                                                    'fields'=>array('Student.id', 'User.username')//, 'User.fname', 'User.flname', 'User.altemail')
                                                  )
                                     );

            $usernames = array();
            $usrs = '';
            //Create array for sending emails to students
            //and create the array for parents' emails
            //TODO: create the gradebook entries
            foreach($students as $student){
                $parents = $this->Ancestor->find('all', array('conditions'=>array('Ancestor.student_id'=>$student['Student']['id']),
                                                                'fields'=>array('User.username')
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
            }

            //Send emails to parents and students
            $this->Email->reset();
            $this->Email->sendAs = 'html'; // both = html + plain text
            $this->Email->to=$this->Session->read('Auth.User.username');
            $this->Email->cc = array('notifications@academicircle.com');
            $this->Email->bcc = $usernames;
            $this->Email->from = 'Notification from academicircle.com <notifications@academicircle.com>';
            $this->Email->replyTo = '<noreply@academicircle.com>';
            $this->Email->return = '<notifications@academicircle.com>';
            $this->Email->subject = 'academicircle.com - Week summary notification for:'.$schedule['Section']['name'];
            $this->Email->template = 'summary';
            $this->Email->layout = 'default';

            /* Set delivery method */
            $this->Email->delivery = 'mail';// 'smtp';

            if( $this->Email->send() ){
                $this->Session->setFlash(__('The summary notification was sent.', true));
            }
            else {
                $this->Session->setFlash(__('The summary notification could not be sent.', true));
            }

        }

        if(isset($this->data['Task']['reminder']) && $this->data['Task']['reminder']==1){

            //Update the status for al the task (reminded==1) inside each loop
            //This can be done to all the task within one query, the only condition
            //is the date range :D
            $this->Task->unBindModel(array('belongsTo'=>array('Schedule', 'User')));
            $this->Task->updateAll(array('reminded'=>1), array('schedule_id'=>$schedule_ids, 'duedate >='=>$start, 'duedate <='=>$ends));

            //Program reminders
            foreach($sunday as $day):
              foreach($day['Task'] as $tsk0):
                  if(!empty($tsk0))
                      $this->_sendReminder($tsk0, $usrs);
              endforeach;
            endforeach;
            foreach($monday as $day):
              foreach($day['Task'] as $tsk1):
                  if(!empty($tsk1))
                      $this->_sendReminder($tsk1, $usrs);
              endforeach;
            endforeach;
            foreach($tuesday as $day):
              foreach($day['Task'] as $tsk2):
                  if(!empty($tsk2))
                      $this->_sendReminder($tsk2, $usrs);
              endforeach;
            endforeach;
            foreach($wednesday as $day):
              foreach($day['Task'] as $tsk3):
                  //echo '<span>'.print_r($tsk3).'</span><br /><br />';
                  if(!empty($tsk3))
                      $this->_sendReminder($tsk3, $usrs);
              endforeach;
            endforeach;
            foreach($thursday as $day):
              foreach($day['Task'] as $tsk4):
                  if(!empty($tsk4))
                      $this->_sendReminder($tsk4, $usrs);
              endforeach;
            endforeach;
            foreach($friday as $day):
              foreach($day['Task'] as $tsk5):
                  if(!empty($tsk5))
                      $this->_sendReminder($tsk5, $usrs);
              endforeach;
            endforeach;
            foreach($saturday as $day):
              foreach($day['Task'] as $tsk6):
                  if(!empty($tsk6))
                      $this->_sendReminder($tsk6, $usrs);
              endforeach;
            endforeach;
        }
        
        $this->redirect(array('action' => 'listview', $id, $week));
    }

    function _sendReminder($tsk, $users){
        if(!empty($tsk)){
            $this->set('username', $this->Session->read('Auth.User.username'));

            //echo '<span>'.print_r($task['Task']).'</span><br />';
            $this->Email->reset();
            $this->Email->sendAs = 'text'; // both = html + plain text
            $this->Email->from = 'Reminder <reminder@academicircle.com>';
            $this->Email->to = 'me@lettermelater.com';
            $this->Email->subject = 'academicircle.com - Reminder!';
            $this->Email->template = 'reminder';
            $this->Email->layout = 'default';

            /* Set delivery method */
            $this->Email->delivery = 'mail';
            //$this->Email->send();
            $fecha = $tsk['Task']['duedate']. ' -1 day';
            //set reminder date at 2pm the day before
            $date = date('M j Y 14:00',strtotime($fecha));
            //$date = date('M j Y 14:00', $fecha);
            $this->set('date', $date);
            $this->set('users', $users);
            $this->set('task', $tsk);
            if( !$this->Email->send() ){
                $this->Session->setFlash(__('The Tasks reminder could not be programmed.', true));
            }else{
                $this->Session->setFlash(__('Tasks reminder succesfully programmed.', true));
            }
        }
    }

    function usrview($id = null, $week=0){
        if(!$id){
            $this->flash('No section selected.');
        }
        else{
            $this->Schedule->recursive = 1;

            $section = $this->Schedule->findBySectionId($id, 'Section.name');

            $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));

            //Select the schedules by day of the week
            $sunday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'sunday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $monday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'monday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $tuesday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'tuesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $wednesday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'wednesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $thursday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'thursday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $friday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'friday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $saturday = $this->Schedule->find('all',array('conditions'=>array('section_id'=>$id, 'Schedule.active'=>1, 'saturday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));

            //Select the tasks by schedules
            foreach($sunday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +0 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($monday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +1 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($tuesday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +2 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($wednesday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +3 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($thursday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +4 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($friday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +5 days')) ), 'fields'=>array('Task.*')) );
            }

            foreach($saturday as &$task){
                $this->Task->recursive = 0;
                $task['Task'] = $this->Task->find('all',array('conditions'=>array('schedule_id'=>$task['Schedule']['id'],'duedate'=>date('Y-m-d', strtotime($start.' +6 days')) ), 'fields'=>array('Task.*')) );
            }

            $this->set(compact('sunday','monday','tuesday','wednesday','thursday','friday','saturday', 'start', 'week'));
            $this->set('seccion', $id);
            $this->set('sectionName', $section['Section']['name']);

            //------------------------ Para la vista
            $end = date('Y-m-d', strtotime($start.' +6 days'));
            $this->Task->unbindModel(array('belongsTo' => array('User')),false);
            $this->Task->Schedule->unbindModel(array('hasMany'=>array('Task'), 'belongsTo' => array('User', 'School')),false);
            $this->Task->recursive = 2;
            $conditions=array('Schedule.section_id'=>$id, 'Task.sent'=>0 , 'Task.duedate >'=>$start, 'Task.duedate <'=>$end);

            $enviado = $this->Task->find('count', array('conditions'=>$conditions));//, 'group'=>$group, 'odrer'=>$order));

            $this->set(compact('enviado'));
        }
    }

    function listview($id=null, $week=0, $view=0){
        $enviado=0;
        if(!$id){
            $this->flash('No section selected.');
        }
        else{
            $this->set(compact('week', 'view'));
            $this->set('seccion', $id);
            $seccion = $this->Schedule->findBySectionId($id, 'Section.name');
            $this->set('sectionName', $seccion['Section']['name']);
            
            $start = date('Y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
            $end = date('Y-m-d', strtotime($start.' +6 days'));

            $this->set(compact('start', 'end'));
            $this->Task->unbindModel(array('belongsTo' => array('User')),false);
            $this->Task->Schedule->unbindModel(array('hasMany'=>array('Task'), 'belongsTo' => array('User', 'School')),false);
            $this->Task->recursive = 2;
            if($view!=0){
                if($view==4)
                    $conditions=array('Schedule.section_id'=>$id, 'Task.type'=>$view);
                else
                    $conditions=array('Schedule.section_id'=>$id, 'Task.duedate >'=>$start, 'Task.duedate <'=>$end, 'Task.type'=>$view);
            }else{
                $conditions=array('Schedule.section_id'=>$id, 'Task.duedate >'=>$start, 'Task.duedate <'=>$end);//, 'Task.type <>'=>'4');
            }

            $fields=array('Task.*', 'Schedule.subject_id', 'Schedule.section_id');
            $order=array('Task.duedate Asc');
            $section = $this->Task->find('all', array('conditions'=>$conditions, 'fields'=>$fields, 'order'=>$order));//, 'group'=>$group, 'odrer'=>$order));

            if(!empty($section) ) {
                if($section[0]['Task']['sent']==1){
                    $enviado = 1;
                }
            }

            $this->set(compact('section', 'enviado'));
        }
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('schedule', $this->Schedule->read(null, $id));
	}

	function add() {
        $this->Schedule->recursive = 0;
        $this->User->recursive = 0;
        $this->User->recursive = 0;
        $this->Subject->recursive = 0;
        $this->Section->recursive = 0;
        $selectedSchool=null;
        $selectedSection=null;
		if (!empty($this->data['Schedule']['teacher_id']) && isset($this->data['Schedule']['teacher_id']) ) {
			$this->Schedule->create();
			if ($this->Schedule->save($this->data)) {
				$this->Session->setFlash(__('The Schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Schedule could not be saved. Please, try again.', true));
			}
		}

        //Find al teachers in the school
        $inGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>3), 'fields'=>array('user_id')));
        //Filter the section by schools
        if(isset($this->data['Schedule']['school_id']) && !empty($this->data['Schedule']['school_id'])){
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->data['Schedule']['school_id'])));
            $teachers=$this->User->find('list',array('conditions'=>array('User.active'=>1, 'User.id'=>$inGroup, 'User.school_id'=>$this->data['Schedule']['school_id'])));
            $subjects=$this->Subject->find('list', array('conditions'=>array('Subject.school_id'=>$this->data['Schedule']['school_id'])));
            $selectedSchool=$this->data['Schedule']['school_id'];
        //Filter the subjects by sections
        }elseif(isset($this->data['Schedule']['section_id']) && !empty($this->data['Schedule']['section_id'])){
            $section=$this->Section->find('first',array('conditions'=>array('Section.id'=>$this->data['Schedule']['section_id']), 'fields'=>'school_id'));
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$section['Section']['school_id'])));
            $selectedSchool=$section['Section']['school_id'];
            $grade=$this->Section->find('first',array('conditions'=>array('Section.id'=>$this->data['Schedule']['section_id']),'fields'=>'Section.grade_id'));
            if(empty($grade)){
                $this->Session->setFlash(__('The Section does not have an assigned grade', true));
                $this->redirect(array('action' => 'index'));
            }else{
                $subjects=$this->Subject->find('list', array('conditions'=>array('Subject.grade_id'=>$grade['Section']['grade_id'])));
                $teachers=$this->User->find('list',array('conditions'=>array('User.active'=>1, 'User.id'=>$inGroup, 'User.school_id'=>$selectedSchool)));
                $selectedSection=$this->data['Schedule']['section_id'];
            }
        }else{
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1)));
            $teachers=$this->User->find('list',array('conditions'=>array('User.active'=>1, 'User.id'=>$inGroup)));
            $subjects=$this->Subject->find('list');
        }
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'sections','selectedSchool', 'selectedSection', 'teachers', 'subjects'));
	}

	function edit($id = null) {
        $this->Schedule->recursive = 0;
        $this->User->recursive = 0;
        $this->User->recursive = 0;
        $this->Subject->recursive = 0;
        $this->Section->recursive = 0;
        $selectedSchool=null;
        $selectedSection=null;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data['Schedule']['teacher_id']) && isset($this->data['Schedule']['teacher_id']) ) {
			if ($this->Schedule->save($this->data)) {
				$this->Session->setFlash(__('The Schedule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Schedule could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Schedule->read(null, $id);
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1)));
		}
        //Find al teachers in the school
        $inGroup=$this->GroupsUser->find('list',array('conditions'=>array('group_id'=>3), 'fields'=>array('user_id')));
        //Filter the section by schools
        if(isset($this->data['Schedule']['school_id']) && !empty($this->data['Schedule']['school_id'])){
            $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->data['Schedule']['school_id'])));
            $teachers=$this->User->find('list',array('conditions'=>array('User.active'=>1, 'User.id'=>$inGroup, 'User.school_id'=>$this->data['Schedule']['school_id'])));
            $subjects=$this->Subject->find('list', array('conditions'=>array('Subject.school_id'=>$this->data['Schedule']['school_id'])));
            $selectedSchool=$this->data['Schedule']['school_id'];
        //Filter the subjects by sections
        }elseif(isset($this->data['Schedule']['section_id']) && !empty($this->data['Schedule']['section_id'])){
            $school=$this->Schedule->find('first', array('conditions'=>array('Schedule.section_id'=>$this->data['Schedule']['section_id']), 'fields'=>'Schedule.school_id'));
            if(empty($school)){
                $this->Session->setFlash(__('The Section does not have an assigned schedule', true));
                $this->redirect(array('action' => 'index'));
            }else{
                $sections=$this->Section->find('list',array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$school['Schedule']['school_id'])));
                $grade=$this->Section->find('first',array('conditions'=>array('Section.id'=>$this->data['Schedule']['section_id']),'fields'=>'Section.grade_id'));
                if(empty($grade)){
                    $this->Session->setFlash(__('The Grade does not have an assigned subject', true));
                    $this->redirect(array('action' => 'index'));
                }else{
                    $subjects=$this->Subject->find('list', array('conditions'=>array('Subject.grade_id'=>$grade['Section']['grade_id'])));
                    $teachers=$this->User->find('list',array('conditions'=>array('User.active'=>1, 'User.id'=>$inGroup, 'User.school_id'=>$school['Schedule']['school_id'])));
                    $selectedSchool=$school['Schedule']['school_id'];
                    $selectedSection=$this->data['Schedule']['section_id'];
                }
            }
        }
        $schools=$this->School->find('list', array('conditions'=>array('active'=>1)));
        $this->set(compact('schools', 'sections','selectedSchool', 'selectedSection', 'teachers', 'subjects'));
		$this->set('schedules', $this->paginate());
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Schedule', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Schedule->delete($id)) {
			$this->Session->setFlash(__('Schedule deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Schedule could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
