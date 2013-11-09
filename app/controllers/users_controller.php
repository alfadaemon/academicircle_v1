<?php
class UsersController extends AppController {
	var $name = 'Users';
	var $uses = array('User', 'Post', 'Comment', 'Mylist', 'ListMember', 'Schedule', 'Student', 'Task', 'Ancestor', 'Section');
    var $helpers = array('Html', 'Form', 'Ajax', 'Js');
    var $components = array('RequestHandler', 'Email');
    var $layout = 'ajax';

    function beforeFilter() {
        parent::beforeFilter();
    }

	function login(){
		$this->layout = 'flash';
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash(__d('logged', 'alreadylog', true));
			//$this->redirect(array('controller'=>'users', 'action'=>'dash'), null, false);
            exit();
		}
	}

    //To allow first login trought email
    function firstlogin($username=null, $password=null){
        $this->layout = 'flash';
        if( ($username!=null) && ($password!=null) ){
            $this->data['User']['username']=$username;
            $this->data['User']['password']=$password;
            $this->User->recursive=0;
            $user=$this->User->find('first', array('conditions'=>array('username'=>$username, 'password'=>$password, 'User.active'=>1)
                                                  ,'fields'=>array('id','username','fname','sname','flname','slname','nickname',
                                                                    'altemail','gender','language','theme_id','created','modified','User.active') )) ;
            if(!empty($user)){
                $this->Session->write('Auth.User', $user['User']);
                $this->Session->setFlash('Welcome!');
                $this->redirect(array('controller'=>'users', 'action'=>'dash'), null, false);
            }
            else{
                $this->Session->setFlash(__d('logged', 'somethingwrong', true));
                $this->redirect(array('controller'=>'contacts', 'action'=>'index'), null, false);
            }
        }
        else{
            $this->Session->setFlash(__d('logged', 'somethingwrong', true));
                $this->redirect(array('controller'=>'pages', 'action'=>'login'), null, false);
        }
    }

    //To allow external login from joomla site
    function joomlalogin(){
        $this->layout = 'ajax';
        if(isset($this->data['User']['username']) && (isset($this->data['User']['password'])) ){
            if( (!empty($this->data['User']['username'])) && (!empty($this->data['User']['password'])) ){
                $username=$this->data['User']['username'];
                $password=$this->data['User']['password'];
                $this->User->recursive=0;
                $user=$this->User->find('first', array('conditions'=>array('username'=>$username, 'password'=>$password, 'User.active'=>1)
                                                      ,'fields'=>array('id','username','fname','sname','flname','slname','nickname',
                                                                        'altemail','gender','language','theme_id','created','modified','User.active') )) ;
                if(!empty($user)){
                    $this->Session->write('Auth.User', $user['User']);
                    $this->Session->setFlash('Welcome!');
                    $this->redirect(array('controller'=>'users', 'action'=>'dash'), null, false);
                    exit();
                }
                else{
                    $this->Session->setFlash(__d('logged', 'invaliduserorpass', true));
                    $this->redirect(array('controller'=>'users', 'action'=>'login'), null, false);
                }
            }
            else{
                $this->Session->setFlash(__d('logged', 'invaliduserorpass', true));
                    $this->redirect(array('controller'=>'users', 'action'=>'login'), null, false);
            }
        }
    }

    function recover(){
        $this->layout = 'default';
        if (!empty($this->data)) {
            $this->User->recursive = 0;
            $user = $this->User->findByUsername($this->data['User']['username']);
            if(!empty($user)){
                $this->_sendRecoveredPass($user);
            }
            else{
                $this->Session->setFlash( __d('logged', 'emailnotfound', true));
                $this->redirect(array('controller'=>'pages', 'action'=>'recover'), null, false);
            }
        }
        else{
            $this->Session->setFlash( __d('logged', 'invalidinfo', true));
            $this->redirect(array('controller'=>'pages', 'action'=>'recover'), null, false);
        }
    }
	
	function logout(){
		$this->layout = 'flash';
		$this->Session->setFlash(__d('logged', 'thankubye', true) );
		$this->redirect($this->Auth->logout());
	}

	function dash(){
		$this->layout = 'logged';
	}
	
	function home(){
        $this->layout = 'ajax';
        $mylists = $this->Mylist->find('list', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id') )));
        if(empty($mylists)){
            $this->set('redirect', true);
            $this->Session->setFlash(__d('logged', 'createonelist', true));
        }
        else {
            $this->set('mylists',$mylists);
        }

        $list = $this->ListMember->find('list', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')), 'fields'=>'mylist_id') );
        //Recoger los ultimos 15 mensajes posteados de mis companeros y sus comentarios
        $posts = $this->Post->find('all', array('fields'=>array('Post.id', 'Post.message', 'Post.postdate', 'Post.mylist_id', 'User.id', 'User.username', 'User.fname', 'User.flname'), 'conditions'=>array('OR'=>array('Post.mylist_id'=>$list, 'Post.user_id'=>$this->Session->read('Auth.User.id')) ), 'limit'=>15, 'order'=>'Post.id desc', 'recursive'=>2));
        $this->set(compact('posts'));
        //$this->set('user', $this->Session->read('Auth.User'));
        //$this->set('rolls', $this->rolls);
	}

    function mylists(){
        $mylists = $this->Mylist->find('list', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')) ));
        $lists = $this->Mylist->find('all', array('fields'=>array('Mylist.id', 'Mylist.name'), 'conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')) ));
        $this->set(compact('mylists', 'lists'));
    }

    function profile(){
        $this->User->recursive=-1;
        $userinfo=$this->User->find('first', array('User.id'=>$this->Session->read('Auth.User.id')));
        $this->set(compact('userinfo'));
    }

    function changepass(){
        $this->User->recursive=-1;
        if(isset($this->data) && !empty($this->data)){
            if($this->data['newpass']==$this->data['confirmpass']){
                $user = $this->Session->Read('User');
                if ($this->User->updateAll(array('password'=>'"'.$this->Auth->password($this->data['confirmpass']).'"'), array('User.id'=>$this->Session->read('Auth.User.id'))) ){
                    $this->Session->setFlash( __d('logged', 'passupdated', true));
                }
                else{
                    $this->Session->setFlash( __('Password could not been updated!!'));
                }
            } else {
                $this->Session->setFlash( __('Passwords do not match. Please, try again.'));
            }
        } else {
            $this->Session->setFlash( __('Please enter both fields.'));
        }
    }

    function changelang(){
        if(isset($this->data)){
            if($this->User->updateAll(array('language'=>"'".$this->data['lang']."'"), array('User.id'=>$this->Session->read('Auth.User.id')))){
                $this->Session->write('Auth.User.language', $this->data['lang']);
                $this->Session->setFlash( __d('logged', 'langupdated', true));
            }
        }
        else{
            $this->Session->setFlash( __d('logged', 'langnotupdated', true));
        }
    }

    function changenotification(){
        if(isset($this->data)){
            if($this->User->updateAll(array('notifyme'=>$this->data['notifyme'],'remindme'=>$this->data['remindme']), array('User.id'=>$this->Session->read('Auth.User.id')))){
                $userinfo['User']['remindme']=$this->data['remindme'];
                $userinfo['User']['notifyme']=$this->data['notifyme'];
                $this->set(compact('userinfo'));
                $this->Session->setFlash( __d('logged', 'langupdated', true));
            }
        }
        else{
            $this->Session->setFlash( __d('logged', 'langnotupdated', true));
        }
    }

    function myschedule($week=0){
        
        $this->Student->recursive=0;
        //TODO: Check this, is getting the max id for the section where the student is "subscribed",
        //      the right way would be to get the secction from the active year and school.
        $id = $this->Student->findByUserId($this->Session->read('Auth.User.id'), 'max(section_id) as id');
        $id=$id[0]['id'];
        if(!$id){
            $this->Session->setFlash(__('You are not registered as a student', true) );
        }
        else{
            $this->Schedule->recursive = 1;

            $section = $this->Schedule->findBySectionId($id, 'Section.name');

            $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));

            //Select the schedules by day of the week
            $sunday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'sunday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $monday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'monday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $tuesday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'tuesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $wednesday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'wednesday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $thursday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'thursday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $friday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'friday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));
            $saturday = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'section_id'=>$id, 'saturday'=>1), 'fields'=>array('Schedule.id', 'Subject.name','starts','ends'), 'order'=>'starts'));

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
            $start = date('y-m-d', strtotime(date('Y')."W".date('W')."0 +".$week." weeks"));
            $this->set('section', $id);
            $this->set('sectionName', $section['Section']['name']);
        }
    }

    function mychildren(){
            $this->Ancestor->recursive=0;
            $sucesors=$this->Ancestor->find('list', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('student_id')
                                                    ));
            
            $students = $this->Student->find('all', array('conditions'=>array('Student.id'=>$sucesors )
                                                ,'fields'=>array('Student.id', 'Section.id', 'User.fname', 'User.flname')
                                                ));
            $this->set(compact('students'));

            //TODO: Add component for dashboard for upcoming per child, pending per child, ¿assistance/discipline?
    }

    function mysections(){
        //Teacher's roll was transfered to the schedule table
        //so we only need to get the "sections" from the schedule for
        //the active year and school (or active schedule?)
        $this->Schedule->recursive=0;

        $sections = $this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'Schedule.teacher_id'=>$this->Session->read('Auth.User.id'))
                                                    ,'fields'=>array('Schedule.id', 'Subject.id', 'Subject.name', 'Section.id', 'Section.name')
                                                    ,'order'=>array('Section.name', 'Subject.name'), 'group'=>'Subject.id'));

        $this->set(compact('sections', 'extramodules'));

        //TODO: Add component for dashboard for upcoming per section, pending per student/section?

    }

    function myschool(){
        $this->Section->recursive=0;
        $section=$this->Section->find('all', array('conditions'=>array('Section.active'=>1, 'Section.school_id'=>$this->Session->read('Auth.User.school_id')
                                                                        ,'Year.active'=>1),
                                                   'fields'=>array('Section.id', 'Section.name','Grade.id'),
                                                   'order'=>'Section.order'
                                            )
            );
        $this->set(compact('section'));
    }

    function myteachers(){
        $teachers=$this->Schedule->find('all',array('conditions'=>array('Schedule.active'=>1, 'School.id'=>$this->Session->read('Auth.User.school_id')),
                                                    'fields'=>array('Schedule.id', 'User.id', 'User.username', 'User.fname', 'User.flname'),
                                                    'group'=>array('User.id'),
                                                    'order'=>'user_id'));
        $this->set(compact('teachers'));
    }

	function index() {
        $this->layout='ajax';
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
                $this->layout='ajax';
		if (!$id) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
        $this->layout='ajax';
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));

                $this->_sendEmailNotification($this->data);

				$this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$themes = $this->User->Theme->find('list');
        $schools = $this->User->School->find('list');
		$this->set(compact('groups', 'themes', 'schools'));
	}

    function _sendEmailNotification($info){
        //Send email to parents
        $this->Email->reset();
        $this->Email->sendAs = 'both'; // both = html + plain text
        $this->Email->from = 'Welcome to academicircle.com <notifications@academicircle.com>';
        $this->Email->bcc = array('"Welcome to academicircle.com" <notifications@academicircle.com>');
        $this->Email->replyTo = '<noreply@academicircle.com>';
        $this->Email->return = '<noreply@academicircle.com>';
        $this->Email->subject = 'Welcome to academicircle.com!';
        $this->Email->subject = 'Welcome to academicircle.com!';
        $this->Email->subject = 'Welcome to academicircle.com!';
        $this->Email->template = 'welcome';
        $this->Email->layout = 'welcome';

        $this->Email->to = $info['User']['username'];
        //$this->Email->cc = array($info['User']['altemail']);
        $this->set('username', $info['User']['username']);
        $this->set('password', $info['User']['password']);
        $this->set('name', $info['User']['fname'].' '.$info['User']['flname']);

        /* SMTP Options */
        $this->Email->smtpOptions = array(
            'port'=>'25',
            'timeout'=>'30',
            'host' => 'smtp.1and1.com',
            'username'=>'notifications@academicircle.com',
            'password'=>'myg00dp4$$'
            //,'client' => 'smtp_helo_hostname'
        );
        /* Set delivery method */
        $this->Email->delivery = 'mail';

        $this->Email->send();
        /*if( $this->Email->send() ){
            $this->Session->setFlash(__('The Task notification was sent.', true));
        }
        /* Check for SMTP errors. /
        else {
            $this->Session->setFlash(__('The Task notification could not be sent.', true));
            //$this->set('smtp_errors', $this->Email->smtpError);
        }
        */
        //End of sending email
    }

    function _sendRecoveredPass($info){
        //Send email to parents
        $this->Email->reset();
        $this->Email->sendAs = 'both'; // both = html + plain text
        $this->Email->from = 'Message from academicircle.com <notifications@academicircle.com>';
        $this->Email->bcc = array('"Message from academicircle.com" <notifications@academicircle.com>');
        $this->Email->replyTo = '<noreply@academicircle.com>';
        $this->Email->return = '<noreply@academicircle.com>';
        $this->Email->subject = "academicircle.com's recovery system!";
        $this->Email->template = 'recover';
        $this->Email->layout = 'welcome';

        $this->Email->to = $info['User']['username'];
        //$this->Email->cc = array($info['User']['altemail']);
        $this->set('username', $info['User']['username']);
        $this->set('password', $info['User']['password']);
        $this->set('name', $info['User']['fname'].' '.$info['User']['flname']);

        /* SMTP Options */
        $this->Email->smtpOptions = array(
            'port'=>'25',
            'timeout'=>'30',
            'host' => 'smtp.1and1.com',
            'username'=>'notifications@academicircle.com',
            'password'=>'myg00dp4$$'
            //,'client' => 'smtp_helo_hostname'
        );
        /* Set delivery method */
        $this->Email->delivery = 'mail';

        //$this->Email->send();
        if( $this->Email->send() ){
            $this->Session->setFlash(__d('pages', 'successResetPasswd', true));
        }
        /* Check for SMTP errors. */
        else {
            $this->Session->setFlash(__('The email notification could not be sent.', true));
            //$this->set('smtp_errors', $this->Email->smtpError);
        }
        //End of sending email
    }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$themes = $this->User->Theme->find('list');
        $schools = $this->User->School->find('list');
		$this->set(compact('groups','themes', 'schools'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The User could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

	function build_acl() {
		if (!Configure::read('debug')) {
			return $this->_stop();
		}
		$log = array();

		$aco =& $this->Acl->Aco;
		$root = $aco->node('controllers');
		if (!$root) {
			$aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
			$root = $aco->save();
			$root['Aco']['id'] = $aco->id; 
			$log[] = 'Created Aco node for controllers';
		} else {
			$root = $root[0];
		}   

		App::import('Core', 'File');
		$Controllers = Configure::listObjects('controller');
		$appIndex = array_search('App', $Controllers);
		if ($appIndex !== false ) {
			unset($Controllers[$appIndex]);
		}
		$baseMethods = get_class_methods('Controller');
		$baseMethods[] = 'buildAcl';

		$Plugins = $this->_getPluginControllerNames();
		$Controllers = array_merge($Controllers, $Plugins);

		// look at each controller in app/controllers
		foreach ($Controllers as $ctrlName) {
			$methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

			// Do all Plugins First
			if ($this->_isPlugin($ctrlName)){
				$pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
				if (!$pluginNode) {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
					$pluginNode = $aco->save();
					$pluginNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
				}
			}
			// find / make controller node
			$controllerNode = $aco->node('controllers/'.$ctrlName);
			if (!$controllerNode) {
				if ($this->_isPlugin($ctrlName)){
					$pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
					$aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
				} else {
					$aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
					$controllerNode = $aco->save();
					$controllerNode['Aco']['id'] = $aco->id;
					$log[] = 'Created Aco node for ' . $ctrlName;
				}
			} else {
				$controllerNode = $controllerNode[0];
			}

			//clean the methods. to remove those in Controller and private actions.
			foreach ($methods as $k => $method) {
				if (strpos($method, '_', 0) === 0) {
					unset($methods[$k]);
					continue;
				}
				if (in_array($method, $baseMethods)) {
					unset($methods[$k]);
					continue;
				}
				$methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
				if (!$methodNode) {
					$aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
					$methodNode = $aco->save();
					$log[] = 'Created Aco node for '. $method;
				}
			}
		}
		if(count($log)>0) {
			debug($log);
		}
	}

	function _getClassMethods($ctrlName = null) {
		App::import('Controller', $ctrlName);
		if (strlen(strstr($ctrlName, '.')) > 0) {
			// plugin's controller
			$num = strpos($ctrlName, '.');
			$ctrlName = substr($ctrlName, $num+1);
		}
		$ctrlclass = $ctrlName . 'Controller';
		$methods = get_class_methods($ctrlclass);

		// Add scaffold defaults if scaffolds are being used
		$properties = get_class_vars($ctrlclass);
		if (array_key_exists('scaffold',$properties)) {
			if($properties['scaffold'] == 'admin') {
				$methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
			} else {
				$methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
			}
		}
		return $methods;
	}

	function _isPlugin($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) > 1) {
			return true;
		} else {
			return false;
		}
	}

	function _getPluginControllerPath($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0] . '.' . $arr[1];
		} else {
			return $arr[0];
		}
	}

	function _getPluginName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[0];
		} else {
			return false;
		}
	}

	function _getPluginControllerName($ctrlName = null) {
		$arr = String::tokenize($ctrlName, '/');
		if (count($arr) == 2) {
			return $arr[1];
		} else {
			return false;
		}
	}

/**
 * Get the names of the plugin controllers ...
 * 
 * This function will get an array of the plugin controller names, and
 * also makes sure the controllers are available for us to get the 
 * method names by doing an App::import for each plugin controller.
 *
 * @return array of plugin names.
 *
 */
	function _getPluginControllerNames() {
		App::import('Core', 'File', 'Folder');
		$paths = Configure::getInstance();
		$folder =& new Folder();
		$folder->cd(APP . 'plugins');

		// Get the list of plugins
		$Plugins = $folder->read();
		$Plugins = $Plugins[0];
		$arr = array();

		// Loop through the plugins
		foreach($Plugins as $pluginName) {
			// Change directory to the plugin
			$didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
			// Get a list of the files that have a file name that ends
			// with controller.php
			$files = $folder->findRecursive('.*_controller\.php');

			// Loop through the controllers we found in the plugins directory
			foreach($files as $fileName) {
				// Get the base file name
				$file = basename($fileName);

				// Get the controller name
				$file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
				if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
					if (!App::import('Controller', $pluginName.'.'.$file)) {
						debug('Error importing '.$file.' for plugin '.$pluginName);
					} else {
						/// Now prepend the Plugin name ...
						// This is required to allow us to fetch the method names.
						$arr[] = Inflector::humanize($pluginName) . "/" . $file;
					}
				}
			}
		}
		return $arr;
	}


	function initDB() {
    	$group =& $this->User->Group;
                
        //Allow admins to everything
    	$group->id = 1;
		$this->Acl->allow($group, 'controllers');

        //allow principals
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Pages');
        $this->Acl->allow($group, 'controllers/Schools/index');
		$this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Posts/listview');
        $this->Acl->allow($group, 'controllers/Comments/add');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/home');
		$this->Acl->allow($group, 'controllers/Users/profile');
		$this->Acl->allow($group, 'controllers/Users/mylists');
		$this->Acl->allow($group, 'controllers/Users/dash');
        $this->Acl->allow($group, 'controllers/Users/mysections');
        $this->Acl->allow($group, 'controllers/Users/myschool');
        $this->Acl->allow($group, 'controllers/Users/myteachers');
        $this->Acl->allow($group, 'controllers/Users/changepass');
        $this->Acl->allow($group, 'controllers/Users/changelang');
        $this->Acl->allow($group, 'controllers/Users/changenotification');
        $this->Acl->allow($group, 'controllers/Schedules/usrview');
        $this->Acl->allow($group, 'controllers/Schedules/listview');
        $this->Acl->allow($group, 'controllers/Schedules/notifyParents');
		$this->Acl->allow($group, 'controllers/ListMembers/members');
        $this->Acl->allow($group, 'controllers/ListMembers/inlist');
        $this->Acl->allow($group, 'controllers/ListMembers/search');
        $this->Acl->allow($group, 'controllers/ListMembers/add');
        $this->Acl->allow($group, 'controllers/ListMembers/delete');
        $this->Acl->allow($group, 'controllers/Mylists/add');
        $this->Acl->allow($group, 'controllers/Mylists/delete');
        $this->Acl->allow($group, 'controllers/Mylists/updatelistname');
        $this->Acl->allow($group, 'controllers/Sections');
        $this->Acl->allow($group, 'controllers/Sections/gradebooks');
        $this->Acl->allow($group, 'controllers/Tasks/view');
        $this->Acl->allow($group, 'controllers/Tasks/viewall');
        $this->Acl->allow($group, 'controllers/Tasks/viewlist');
        $this->Acl->allow($group, 'controllers/Tasks/add');
        $this->Acl->allow($group, 'controllers/Tasks/edit');
        $this->Acl->allow($group, 'controllers/Tasks/deletep');
        $this->Acl->allow($group, 'controllers/Tasks/updatetitle');
        $this->Acl->allow($group, 'controllers/Tasks/updatedescription');
        $this->Acl->allow($group, 'controllers/Gradebooks/add');
        $this->Acl->allow($group, 'controllers/Gradebooks/edit');
        $this->Acl->allow($group, 'controllers/Gradebooks/view');
        $this->Acl->allow($group, 'controllers/Gradebooks/updatescore');
        $this->Acl->allow($group, 'controllers/Gradebooks/bygrade');
        $this->Acl->allow($group, 'controllers/Gradebooks/bysubject');
        $this->Acl->allow($group, 'controllers/Gradebooks/bystudent');
        $this->Acl->allow($group, 'controllers/Teachers/gradebooks');
        $this->Acl->allow($group, 'controllers/Attendances/add');
        $this->Acl->allow($group, 'controllers/Attendances/view');
        $this->Acl->allow($group, 'controllers/Attendances/viewstudenthistory');
        $this->Acl->allow($group, 'controllers/Attendances/viewsectionhistory');

		//allow teachers
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Pages');
		$this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Comments/add');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/home');
		$this->Acl->allow($group, 'controllers/Users/profile');
		$this->Acl->allow($group, 'controllers/Users/mylists');
		$this->Acl->allow($group, 'controllers/Users/dash');
        $this->Acl->allow($group, 'controllers/Users/mysections');
        $this->Acl->allow($group, 'controllers/Users/changepass');
        $this->Acl->allow($group, 'controllers/Users/changelang');
        $this->Acl->allow($group, 'controllers/Users/changenotification');
		$this->Acl->allow($group, 'controllers/ListMembers/members');
        $this->Acl->allow($group, 'controllers/ListMembers/inlist');
        $this->Acl->allow($group, 'controllers/ListMembers/search');
        $this->Acl->allow($group, 'controllers/ListMembers/add');
        $this->Acl->allow($group, 'controllers/ListMembers/delete');
        $this->Acl->allow($group, 'controllers/Mylists/add');
        $this->Acl->allow($group, 'controllers/Mylists/delete');
        $this->Acl->allow($group, 'controllers/Mylists/updatelistname');
        $this->Acl->allow($group, 'controllers/Sections');
        $this->Acl->allow($group, 'controllers/Tasks/view');
        $this->Acl->allow($group, 'controllers/Tasks/viewall');
        $this->Acl->allow($group, 'controllers/Tasks/add');
        $this->Acl->allow($group, 'controllers/Tasks/edit');
        $this->Acl->allow($group, 'controllers/Tasks/delete');
        $this->Acl->allow($group, 'controllers/Tasks/updatetitle');
        $this->Acl->allow($group, 'controllers/Tasks/updatedescription');
        $this->Acl->allow($group, 'controllers/Gradebooks/add');
        $this->Acl->allow($group, 'controllers/Gradebooks/edit');
        $this->Acl->allow($group, 'controllers/Gradebooks/view');
        $this->Acl->allow($group, 'controllers/Gradebooks/updatescore');
        $this->Acl->allow($group, 'controllers/Teachers/mysections');
        $this->Acl->allow($group, 'controllers/Teachers/attendances');
        $this->Acl->allow($group, 'controllers/Teachers/notifyPrincipal');
        $this->Acl->allow($group, 'controllers/Teachers/listview');
        $this->Acl->allow($group, 'controllers/Teachers/gradebooks');
        $this->Acl->allow($group, 'controllers/Attendances/add');
        $this->Acl->allow($group, 'controllers/Attendances/view');
        $this->Acl->allow($group, 'controllers/Attendances/viewstudenthistory');
        $this->Acl->allow($group, 'controllers/Attendances/viewsectionhistory');
                
        //allow parents
        $group->id = 4;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Pages');
		$this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Comments/add');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/dash');
		$this->Acl->allow($group, 'controllers/Users/home');
		$this->Acl->allow($group, 'controllers/Users/profile');
		$this->Acl->allow($group, 'controllers/Users/mylists');
		$this->Acl->allow($group, 'controllers/Users/mychildren');
        $this->Acl->allow($group, 'controllers/Users/changepass');
        $this->Acl->allow($group, 'controllers/Users/changelang');
        $this->Acl->allow($group, 'controllers/Users/changenotification');
		$this->Acl->allow($group, 'controllers/ListMembers/members');
        $this->Acl->allow($group, 'controllers/ListMembers/inlist');
        $this->Acl->allow($group, 'controllers/ListMembers/search');
        $this->Acl->allow($group, 'controllers/ListMembers/add');
        $this->Acl->allow($group, 'controllers/ListMembers/delete');
        $this->Acl->allow($group, 'controllers/Mylists/add');
        $this->Acl->allow($group, 'controllers/Mylists/delete');
        $this->Acl->allow($group, 'controllers/Mylists/updatelistname');
        $this->Acl->allow($group, 'controllers/Tasks/view');
        $this->Acl->allow($group, 'controllers/Schedules/usrview');
        $this->Acl->allow($group, 'controllers/Schedules/listview');
        $this->Acl->allow($group, 'controllers/Gradebooks/view');
        $this->Acl->allow($group, 'controllers/Attendances/view');
        $this->Acl->allow($group, 'controllers/Attendances/viewstudent');
        $this->Acl->allow($group, 'controllers/Attendances/viewstudenthistory');

		//allow students
		$group->id = 5;
		$this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Pages');
        $this->Acl->allow($group, 'controllers/Posts/add');
        $this->Acl->allow($group, 'controllers/Comments/add');
        $this->Acl->allow($group, 'controllers/Users/login');
        $this->Acl->allow($group, 'controllers/Users/logout');
		$this->Acl->allow($group, 'controllers/Users/home');
		$this->Acl->allow($group, 'controllers/Users/dash');
		$this->Acl->allow($group, 'controllers/Users/profile');
		$this->Acl->allow($group, 'controllers/Users/mylists');
        $this->Acl->allow($group, 'controllers/Users/changepass');
        $this->Acl->allow($group, 'controllers/Users/changelang');
        $this->Acl->allow($group, 'controllers/Users/changenotification');
        $this->Acl->allow($group, 'controllers/Users/myschedule');
        $this->Acl->allow($group, 'controllers/ListMembers/members');
        $this->Acl->allow($group, 'controllers/ListMembers/inlist');
        $this->Acl->allow($group, 'controllers/ListMembers/search');
        $this->Acl->allow($group, 'controllers/ListMembers/add');
        $this->Acl->allow($group, 'controllers/ListMembers/delete');
        $this->Acl->allow($group, 'controllers/Mylists/add');
        $this->Acl->allow($group, 'controllers/Mylists/delete');
        $this->Acl->allow($group, 'controllers/Mylists/updatelistname');
        $this->Acl->allow($group, 'controllers/Tasks/view');
        $this->Acl->allow($group, 'controllers/Gradebooks/view');
                //exit();
	}

}
?>
