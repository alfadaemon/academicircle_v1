<?php
class MylistsController extends AppController {

	var $name = 'Mylists';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
    var $components = array('RequestHandler');
	var $layout = 'ajax';

    function beforeFilter() {
        parent::beforeFilter();
    }

	function index() {
		$this->Mylist->recursive = 0;
		$this->set('mylists', $this->paginate());
	}

    function updatelistname(){
        /*
            echo $this->params['form']['id'];
            echo $this->params['form']['value'];
        */
        if ($this->RequestHandler->isAjax())
        {
            App::import('Core', 'sanitize');
            $name = Sanitize::clean($this->params['form']['value']);

            $this->Mylist->id = $this->params['form']['id'];;
            $this->Mylist->saveField('name', $name);

            Configure::write('debug', 0);

            $this->set('mylistname', $name);
        }
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('logged', 'invalidList', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mylist', $this->Mylist->read(null, $id));
	}

    function add() {
        $this->layout='ajax';
        if (!empty($this->data)) {
            $this->data['Mylist']['user_id']=$this->Session->read('Auth.User.id');
            $this->Mylist->create();
            if ($this->Mylist->save($this->data)) {
                $this->Session->setFlash(__d('logged', 'newListSaved', true));
                //$this->redirect(array('controller'=>'users', 'action' => 'mylists'));
            } else {
                $this->Session->setFlash(__d('logged', 'listNotSaved', true));
            }
        }
        $mylists = $this->Mylist->find('list', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')) ));
        $lists = $this->Mylist->find('all', array('fields'=>array('Mylist.id', 'Mylist.name'), 'conditions'=>array('user_id'=>$this->Session->read('Auth.User.id')) ));
        $this->set(compact('mylists', 'lists'));
    }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid list', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mylist->save($this->data)) {
				//$this->Session->setFlash(__('The list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The list could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mylist->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('logged', 'invalidIdList', true));
		}
        //Validate that the user only can delete lists that belong to him/her
        if($this->Mylist->find('first', array('conditions'=>array('Mylist.id'=>$id,'Mylist.user_id'=>$this->Session->read('Auth.User.id') )) )){
            if ($this->Mylist->delete($id)) {
                //TODO: Delete all list's members
                $this->Session->setFlash(__d('logged', 'listDeleted', true));
                }
                else{
                    $this->Session->setFlash(__d('logged', 'listNotDeleted', true));
                }
        }
        else{
            $this->Session->setFlash(__('Your are trying to delete a non-valid list.', true));
        }
        $this->redirect(array('action' => 'add'));
	}
}
?>
