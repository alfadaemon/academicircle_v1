<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
        $this->layout='ajax';
		if (!empty($this->data)) {
			$this->Comment->create();
            $this->data['Comment']['user_id']=$this->Session->read('Auth.User.id');
            $this->data['Comment']['posttime']=date('Y-m-d H:i:s');
            if($this->Comment->validates()){
                if ($this->Comment->save($this->data)) {
                    $lastId = $this->Comment->getLastInsertId();
                    //$this->Session->setFlash(__('The Comment has been saved', true));
                    $comment = $this->Comment->findById($lastId);
                    $this->set('comment', $comment);
                    //$post = $this->Post->find('all', array('recursive'=>2, 'conditions'=>array('Post.id'=>$this->Post->getLastInsertId(), 'Post.user_id'=>$this->Session->read('Auth.User.id')), 'order'=>'Post.id desc'));
                                    //$this->set('Post',$post);
                } else {
                    $this->Session->setFlash(__('The Comment could not be saved. Please try again.', true));
                }
            } else {
                $this->Session->setFlash(__('The comment could not be validated. Please try again'), true);
            }
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Comment->delete($id)) {
			//$this->Session->setFlash(__('Comment deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Comment could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
