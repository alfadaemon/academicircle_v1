<?php
class AppController extends Controller{
	var $view = 'Theme';
	var $uses = array('GroupsUser', 'Theme', 'School');
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Session');
	var $components = array('Auth', 'Acl', 'Session');
 
	function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
                
        //Allow Access to the pages controllers (public Access)
        $this->Auth->allowedActions = array('display', 'firstlogin', 'recover', 'joomlalogin');

        //Allow unrestricted access
        //$this->Auth->allow("*");

        $this->Auth->userScope = array('User.active'=> 1);
        $this->Auth->loginError = __d('logged', 'invaliduserorpass', true);
        $this->Auth->authError = __d('logged', 'prohibitexpired', true);

        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dash');

        if ($this->Session->read('Auth.User')) {
            $this->set('menuoptions', $this->GroupsUser->findAllByUserId($this->Session->read('Auth.User.id'), array('fields'=>'group_id')));
            Configure::write('Config.language', $this->Session->read('Auth.User.language'));
            //Extract theme
            $this->Theme->recursive=0;
            $skin = $this->Theme->find('first', array('fields'=>'name', 'conditions'=>array('id'=>($this->Session->read('Auth.User.theme_id')) ) ));
            $this->theme = $skin['Theme']['name'];
        }
        //Flag for the extra modules for each school
        $extramodules=false;

        //Flag to enable gradebooks
        //Get the information from the schools if there is an extra module for gradebooks enabled
        $this->School->recursive=-1;
        $gradebookenabled=$this->School->find('first', array('fields'=>'gradebook', 'conditions'=>array('active'=>1, 'School.id'=>$this->Session->read('Auth.User.school_id'))));

        $this->set(compact('extramodules', 'gradebookenabled'));
	}

    function setLanguage() {
        if ($this->Session->read('Auth.User')){
            $this->params['lang'] = $this->Session->read('Auth.User.language');
        }
        else{
            $this->params['lang'] = 'en';
        }
        $lang = $this->params['lang'];
        App::import('Core', 'i18n');

        $I18n =& I18n::getInstance();
        $I18n->l10n->get($lang);
        foreach (Configure::read('Config.languages') as $lang => $locale) {
            if($lang == $this->params['lang'])
            $this->params['locale'] = $locale['locale'];
        }
    }
}
?>
