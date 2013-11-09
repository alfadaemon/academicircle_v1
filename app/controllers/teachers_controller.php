<?php
class TeachersController extends AppController {

	var $name = 'Teachers';
    var $uses = array('Schedule', 'Task', 'Attendance', 'Student', 'School', 'Year', 'Gradebook', 'Subject');
	var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('Email', 'RequestHandler');
	var $layout = 'ajax';

	/*function index() {
		$this->Teacher->recursive = 0;
		$this->set('teachers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Teacher', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('teacher', $this->Teacher->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Teacher->create();
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash(__('The Teacher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Teacher could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Teacher', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash(__('The Teacher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Teacher could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Teacher->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Teacher', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Teacher->delete($id)) {
			$this->Session->setFlash(__('Teacher deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Teacher could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}*/

    function notifyPrincipal($week=0) {
        //SELECT * FROM groups_users gu left join users u on u.id=gu.user_id
        //WHERE group_id=2 and u.school_id=3
        $school=$this->Session->read('Auth.User.school_id');

        $this->GroupUser->recursive=2;
        $principals=$this->GroupsUser->Query('SELECT username, fname, flname FROM groups_users gu left join users u on u.id=gu.user_id
        WHERE group_id=2 and u.school_id='.$school);

        $dest=array();
        foreach($principals as $principal){
             $dest[]=$principal['u']['username'];
        }

        $start = date('d-m-Y', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));

        $this->set(compact('principals', 'start'));

        $this->Email->reset();
        $this->Email->sendAs = 'both'; // both = html + plain text
        $this->Email->to=$dest;
        $this->Email->bcc = array('notifications@academicircle.com');
        $this->Email->cc = $this->Session->read('Auth.User.username');
        $this->Email->from = 'Notification from academicircle.com <notifications@academicircle.com>';
        $this->Email->replyTo = '<noreply@academicircle.com>';
        $this->Email->return = '<notifications@academicircle.com>';
        $this->Email->subject = 'academicircle.com - New Week Schedule needs revision!';
        $this->Email->template = 'notifyPrincipal';
        $this->Email->layout = 'default';

        /* Set delivery method */
        $this->Email->delivery = 'mail';// 'smtp';

        if( $this->Email->send() ){
            $message='The notification was sent for the week that starts on'.$start.' to:';
            $this->Session->setFlash(__($message, true));
        }
        else {
            $this->Session->setFlash(__('The notification could not be sent to:', true));
            //echo 'Error: <br /><br />';
//            echo print_r($this->Email);
//            echo '<br /><br />';
        }
	}

    function listview($section=null, $subject=0, $week=0, $view=0){
        if( ($section==null) || ($subject==0)) {
            $this->Session->setFlash('List view only available when you select a grade/class');
            $this->redirect(array('controller'=>'teachers', 'action' => 'mysections'));
        }
        else{
            $this->set(compact('section', 'subject', 'week', 'view'));
            $seccion = $this->Schedule->findBySectionId($section, 'Section.name');
            $this->set('sectionName', $seccion['Section']['name']);

            $teacher_id=$this->Session->read('Auth.User.id');

            $start = date('Y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
            $end = date('Y-m-d', strtotime($start.' +6 days'));

            $this->set(compact('start', 'end'));
            $this->Task->unbindModel(array('belongsTo' => array('User')),false);
            $this->Task->Schedule->unbindModel(array('hasMany'=>array('Task'), 'belongsTo' => array('User', 'School')),false);
            $this->Task->recursive = 2;
            if($view!=0){
                if($view==4)
                    $conditions=array('Schedule.section_id'=>$section, 'Task.type'=>$view);
                else
                    $conditions=array('Schedule.section_id'=>$section, 'Task.duedate >'=>$start, 'Task.duedate <'=>$end, 'Task.type'=>$view);
            }else{
                if($subject==0){
                    $conditions=array('Schedule.teacher_id'=>$teacher_id, 'Task.duedate >'=>$start, 'Task.duedate <'=>$end);//, 'Task.type <>'=>'4');
                }
                else{
                    $conditions=array('Schedule.teacher_id'=>$teacher_id, 'Schedule.subject_id'=>$subject, 'Schedule.section_id'=>$section, 'Task.duedate >'=>$start, 'Task.duedate <'=>$end);//, 'Task.type <>'=>'4');
                }
            }

            $fields=array('Task.*', 'Schedule.subject_id', 'Schedule.section_id');
            $order=array('Task.duedate Asc');
            $seccion = $this->Task->find('all', array('conditions'=>$conditions, 'fields'=>$fields, 'order'=>$order));//, 'group'=>$group, 'odrer'=>$order));

            $this->set(compact('seccion'));
        }
    }

    function mysections($section=0, $subject=0, $week=0){
        //Teacher's roll was transfered to the schedule table
        //so we only need to get the "sections" from the schedule for
        //the active year and school (or active schedule?)
        $this->Schedule->recursive=0;

        if(($section!=0) && ($subject!=0))
            $conditions=array('Schedule.section_id'=>$section, 'Schedule.subject_id'=>$subject );
        else
            $conditions='';
        
        //Select the schedules by day of the week
        $sunday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.sunday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $monday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.monday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $tuesday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.tuesday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $wednesday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.wednesday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $thursday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.thursday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $friday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.friday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $saturday = $this->Schedule->find('all',array('conditions'=>array($conditions, 'Schedule.active'=>1, 'Schedule.saturday'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Subject.id', 'Subject.name', 'Section.id', 'Section.name', 'School.name', 'Schedule.*')
                                                    ,'order'=>'starts'));

        $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));

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

        $this->set(compact('sunday','monday','tuesday','wednesday','thursday','friday','saturday', 'start', 'week', 'section', 'subject'));

    }

    function gradebooks($section=0, $subject=0){
        $this->Schedule->recursive=-1;
        $schedule = $this->Schedule->find('count', array('conditions'=>array('section_id'=>$section,'subject_id'=>$subject, 'active'=>1)));
        if($section!=0 && $schedule>=1){
            $existsgradebook=$this->Gradebook->find('count', array('conditions'=>array('Gradebook.subject_id'=>$subject)));

            $students=$this->Student->find('all', array('conditions'=>array('Student.section_id'=>$section)
                                                        , 'fields'=>array('User.id', 'User.username', 'Student.id', 'User.fname', 'User.sname', 'User.flname', 'User.slname') ));

            $this->Year->recursive=-1;
            $periods=$this->Year->find('first', array('fields'=>array('periods'), 'conditions'=>array('active'=>1, 'school_id'=>$this->Session->read('Auth.User.school_id'))));

            $this->Subject->recursive=-1;
            $subjectname=$this->Subject->find('first', array('fields'=>array('name'), 'conditions'=>array('id'=>$subject)));
            
            if($existsgradebook==0){
                $this->Session->setFlash(__('Gradebook for this subject was generated.', true));
                foreach($students as $student){
                    for($x=1; $x<=$periods['Year']['periods']; $x++ ){
                        $this->Gradebook->recursive=-1;
                        $this->Gradebook->create();
                        $gradebook['student_id']=$student['Student']['id'];
                        $gradebook['section_id']=$section;
                        $gradebook['subject_id']=$subject;
                        $gradebook['period']=$x;
                        $gradebook['user_id']=$this->Session->read('Auth.User.id');
                        $this->Gradebook->save($gradebook);
                    }
                }
            }
            foreach($students as &$student){
                $this->Gradebook->recursive=-1;
                $student['grades']=$this->Gradebook->find('all',
                                            array('conditions'=>
                                                        array('Gradebook.student_id'=>$student['Student']['id']
                                                            , 'Gradebook.subject_id'=>$subject
                                                            )
                                                  ,'order'=>'period asc'
                                                  ,'fields'=>array('id', 'period', 'alphascore', 'score')
                                                )
                                    );
            }
            $this->set(compact('students', 'schedule', 'section','subject', 'periods', 'subjectname'));
        }
        else{
            $this->Session->setFlash(__('No registries to show, Grade/Subject combination not found.', true));
        }
        $this->set(compact('schedule'));
    }

    function attendances($schedule=0, $section=0, $week=0){
        $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
        if($section!=0){
            $students=$this->Student->find('all', array('conditions'=>array('Student.section_id'=>$section)
                                                        , 'fields'=>array('User.id', 'User.username', 'Student.id', 'User.fname', 'User.sname', 'User.flname', 'User.slname') ));

            foreach($students as &$student){
                $this->Attendance->recursive=-1;
                $student['sun']=$this->Attendance->find('all', 
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +0 days'))
                                                            )
                                                )
                                    );
                $student['mon']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +1 days'))
                                                            )
                                                )
                                    );
                $student['tue']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +2 days'))
                                                            )
                                                )
                                    );
                $student['wed']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +3 days'))
                                                            )
                                                )
                                    );
                $student['thu']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +4 days'))
                                                            )
                                                )
                                    );
                $student['fri']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +5 days'))
                                                            )
                                                )
                                    );
                $student['sat']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.schedule_id'=>$schedule
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +6 days'))
                                                            )
                                                )
                                    );
            }
            $this->set(compact('students', 'schedule', 'section', 'week', 'start'));
        }
    }
}
?>
