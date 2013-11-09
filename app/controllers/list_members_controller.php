<?php
class ListMembersController extends AppController {

	var $name = 'ListMembers';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $layout = 'ajax';

	function index() {
		$this->ListMember->recursive = 0;
		$this->set('listMembers', $this->paginate());
	}

    function inlist($list=0){
        $members=$this->ListMember->find('all', array('fields'=>array('Mylist.*', 'User.username', 'User.fname', 'User.flname'), 'conditions'=>array('ListMember.mylist_id'=>$list ) ) );
        $this->set(compact('members'));
    }

    function members(){
        if(isset($this->data)){
			$this->set('members', $this->ListMember->find('all', array('conditions'=>array('ListMember.mylist_id'=>$this->data['ListMembers']['mylist_id'] ) ) ));
                        $this->set('list_id', $this->data['ListMembers']['mylist_id']);
		}
	}

    function search($list_id=null){
        //echo print_r($this->params);exit();
        if((!empty($this->params['data']['ListMember']['query'])) && (strlen($this->params['data']['ListMember']['query']) > 0)){
            $id=$this->Session->read('Auth.User.id');
            $searchTxt=$this->params['data']['ListMember']['query'];
            //TODO: list only users that are not already on the list
            $users = $this->ListMember->query("select u.id, u.fname, u.sname, u.flname, u.username from users u
                                                    where u.active=1 AND u.school_id=".$this->Session->read('Auth.User.school_id').
                                                    " AND (u.username like '%".$searchTxt."%'
                                                    OR u.fname like '%".$searchTxt."%'
                                                    OR u.sname like '%".$searchTxt."%'
                                                    OR u.flname like '%".$searchTxt."%' 
                                                    OR u.slname like '%".$searchTxt."%' )");
            $this->set(compact('users'));
            $this->set('list_id', $list_id);
        }
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ListMember', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('listMember', $this->ListMember->read(null, $id));
	}

	function add($list_id=null, $user_id=null) {
		if (!empty($list_id) && !empty($user_id) && $list_id!='') {
			$this->ListMember->create();
            $this->data['ListMember']['mylist_id']=$list_id;
            //Validate that the user can add only users from the user's school
            //The above is done on the search function (it is not the right way)
            $this->data['ListMember']['user_id']=$user_id;
                        
			if ($this->ListMember->save($this->data)) {
				$this->Session->setFlash(__d('logged', 'memberAdded', true));
				//$this->redirect(array('action' => 'members'));
			} else {
				$this->Session->setFlash(__d('logged', 'memberNotAdded', true));
			}
		} else{
                    $this->Session->setFlash(__d('logged', 'memberNotAdded', true));
        }
        $this->set('members', $this->ListMember->find('all', array('conditions'=>array('ListMember.mylist_id'=>$list_id) ) ));
        $this->set('list_id', $list_id);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ListMember', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ListMember->save($this->data)) {
				$this->Session->setFlash(__('The ListMember has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ListMember could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ListMember->read(null, $id);
		}
	}

	function delete($id = null) {
        $success=1;
        if (!$id) {;
			$this->Session->setFlash(__('Invalid id for ListMember', true));
            return;
		}

        //Check that the $id is a member of the user's list.
        //For this you need to get the mylist_id and verify that the owner on mylist
        //is the same user that is trying to delete this member from the list.
        $mylist_id=$this->ListMember->find('first', array('conditions'=>array('ListMember.id'=>$id), 'fields'=>array('mylist_id') ) );
        if($this->ListMember->find('first', array('conditions'=>
                                                          array('ListMember.id'=>$id,
                                                                'ListMember.mylist_id'=>$mylist_id['ListMember']['mylist_id'],
                                                                'Mylist.user_id'=>$this->Session->read('Auth.User.id')
                                                               )
                                                 )
                                   )
                                                              ){
            if ($this->ListMember->delete($id)) {
                $this->Session->setFlash(__d('logged', 'memberDeleted', true));
            }
            else{
                $this->Session->setFlash(__d('logged', 'memberNotDeleted', true));
            }
        }
        else{;
            $this->Session->setFlash(__('You are trying to delete a non-valid member.', true));
        }
	}
}
?>
