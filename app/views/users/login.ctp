<div>
<?php
echo $session->flash('auth');
echo $form->create('User', array('controller'=>'users', 'action' => 'login'));
echo $form->input('username',array('label'=>__d('pages', 'user', true).': '));
echo $form->input('password',array('label'=>__d('pages', 'password', true).': '));
echo $form->end(__d('pages', 'login', true));

echo $html->link(__d('pages', 'recoverpass', true), 'recover', array());
?>
</div>

