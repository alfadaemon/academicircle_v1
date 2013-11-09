<?php
class AttendancesController extends AppController {

	var $name = 'Attendances';
    var $uses = array('Attendance', 'Schedule', 'Student');
	var $helpers = array('Js', 'Ajax');
	var $components = array('RequestHandler');

	function index() {
		$this->Attendance->recursive = 0;
		$this->set('attendances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attendance', true));
			//$this->redirect(array('action' => 'index'));
		}
		$this->set('attendance', $this->Attendance->read(null, $id));
	}

	function add($schedule=0, $student=0) {
        if (!empty($this->data)) {
            $this->Attendance->create();
            $schedule=$this->data['Attendance']['schedule_id'];
            $student=$this->data['Attendance']['student_id'];
            if( ($student!=0) && ($schedule!=0) ){
                if ($this->Attendance->save($this->data)) {
                    $this->Session->setFlash(__('The attendance has been saved', true));
                    //$this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The attendance could not be saved. Please, try again.', true));
                }
            } else {
                $this->Session->setFlash(__('Invalid attendance, could not be saved. Please, try again.', true));
            }
        }
		$this->set(compact('schedules', 'students', 'schedule', 'student'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attendance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attendance->save($this->data)) {
				$this->Session->setFlash(__('The attendance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attendance->read(null, $id);
		}
		$schedules = $this->Attendance->Schedule->find('list');
		$students = $this->Attendance->Student->find('list');
		$this->set(compact('schedules', 'students'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attendance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attendance->delete($id)) {
			$this->Session->setFlash(__('Attendance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attendance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

    function viewstudenthistory($student){
        $this->Attendance->recursive = 0;
        if(!isset($this->data)){
            $startdate= date('Y-m-d', strtotime(date('Y')."W".date('W')));
            $enddate= date('Y-m-d', strtotime($startdate.' +6 days'));
        }
        else{
            $startdate=$this->data['startdate'];
            $enddate=$this->data['enddate'];
        }
        $this->paginate=array('conditions'=>array('student_id'=>$student, 'adate >='=>$startdate, 'adate <='=>$enddate));

        $this->set(compact('startdate','enddate', 'student'));

		$this->set('attendances', $this->paginate());
    }

    function viewsectionhistory($section=null, $week=0){
        $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
        if($section){
            $students=$this->Student->find('all', array('conditions'=>array('Student.section_id'=>$section)
                                                        , 'fields'=>array('User.id', 'User.username', 'Student.id', 'User.fname', 'User.sname', 'User.flname', 'User.slname') ));

            foreach($students as &$student){
                $this->Attendance->recursive=-1;
                $student['sun']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +0 days'))
                                                            )
                                                )
                                    );
                $student['mon']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +1 days'))
                                                            )
                                                )
                                    );
                $student['tue']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +2 days'))
                                                            )
                                                )
                                    );
                $student['wed']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +3 days'))
                                                            )
                                                )
                                    );
                $student['thu']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +4 days'))
                                                            )
                                                )
                                    );
                $student['fri']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +5 days'))
                                                            )
                                                )
                                    );
                $student['sat']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.student_id'=>$student['Student']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +6 days'))
                                                            )
                                                )
                                    );
            }
            $this->set(compact('students', 'section', 'week', 'start'));
        }
    }

    function viewstudent($student=null, $week=0){
        $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
        if($student){
            $this->Student->recursive=-1;
            $section=$this->Student->find('first', array('conditions'=>array('Student.id'=>$student), 'fields'=>array('Student.section_id')));
            $this->Schedule->recursive=0;
            $schedules=$this->Schedule->find('all', array('conditions'=>array('Schedule.section_id'=>$section['Student']['section_id'])
                //                                        , 'fields'=>array('S')
                                                          , 'group'=>array('Subject.id')
                ));

            foreach($schedules as &$schedule){
                //echo print_r($schedule['Subject']);
                $this->Attendance->recursive=-1;
                $schedule['sun']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +0 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['mon']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +1 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['tue']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +2 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['wed']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +3 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['thu']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +4 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['fri']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +5 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
                $schedule['sat']=$this->Attendance->find('all',
                                            array('conditions'=>
                                                        array('Attendance.schedule_id'=>$schedule['Schedule']['id']
                                                            , 'Attendance.adate'=>date('Y-m-d', strtotime($start.' +6 days'))
                                                            , 'Attendance.student_id'=>$student
                                                            )
                                                )
                                    );
            }
            $this->set(compact('schedules', 'student', 'week', 'start'));
        }
    }
}
?>