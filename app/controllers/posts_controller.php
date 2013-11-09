<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
    var $uses = array('Post', 'ListMember', 'User');
	var $layout = 'logged';
    var $components = array('Email');

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

    function listview($uid = null){
        $this->layout='ajax';
        if (!$uid) {
			$this->Session->setFlash(__('Invalid Post', true));
		}
        $posts = $this->Post->find('all', array('fields'=>array('Post.id', 'Post.message', 'Post.postdate', 'User.id', 'User.username', 'User.fname', 'User.flname'), 
                                                'conditions'=>array('Post.user_id'=>$uid),
                                                'limit'=>15, 'order'=>'Post.id desc', 'recursive'=>2));
        //Validate when no posts
        $this->set(compact('posts'));
        if(empty($posts)){
            $this->Session->setFlash(__d('logged', 'sorryNoRecords', true));
        }
    }

	function add() {
        $this->layout='ajax';
		if (!empty($this->data)) {
                        $this->data['Post']['user_id']=$this->Session->read('Auth.User.id');
                        $this->data['Post']['postdate']=date('Y-m-d H:i:s');
			$this->Post->create();
			if ($this->Post->save($this->data)) {
                //$this->Session->setFlash(__('The Post has been saved', true));
                $postID=$this->Post->getLastInsertId();
                $post = $this->Post->find('all', array('recursive'=>2, 'conditions'=>array('Post.id'=>$postID, 'Post.user_id'=>$this->Session->read('Auth.User.id')), 'order'=>'Post.id desc'));
                $this->set('Post',$post);
                $this->_sendPostNotification($this->data);
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
	}

    function _sendPostNotification($post){
        $this->layout='ajax';
        $this->set('post', $post);

        //Find the users information (email) to notify
        $this->MyList->recursive = 0;
        $listmembers = $this->ListMember->find('list',
                                        array('conditions'=>array('ListMember.mylist_id'=>$post['Post']['mylist_id'])
                                              ,'fields'=>array('user_id')
                                            )
                                        );

        $this->User->recursive = 0;
        $members = $this->User->find('all',
                                        array('conditions'=>array('User.id'=>$listmembers),
                                              'fields'=>array('username')
                                            )
                                        );
        $to=array();
        foreach($members as $member){
            $to[]=$member['User']['username'];
        }

        //Send emails to parents and students
        $this->Email->reset();
        $this->Email->sendAs = 'both'; // both = html + plain text
        $this->Email->to=$this->Session->read('Auth.User.username');
        $this->Email->bcc=$to;
        $this->Email->cc = array('notifications@academicircle.com');
        $this->Email->from = 'Notification from academicircle.com <notifications@academicircle.com>';
        $this->Email->replyTo = '<noreply@academicircle.com>';
        $this->Email->return = '<notifications@academicircle.com>';
        $this->Email->subject = 'academicircle.com - New Post added!';
        $this->Email->template = 'new_post';
        $this->Email->layout = 'default';

        $this->Email->delivery = 'mail';// 'smtp';

        if( $this->Email->send() ){
            $this->Session->setFlash(__('A notification was sent.', true));
        }
        else {
            $this->Session->setFlash(__('The notification could not be sent.', true));
            //echo 'Error: <br /><br />';
		    //echo print_r($this->Email);
		    //echo '<br /><br />';
        }
    }

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Post could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
