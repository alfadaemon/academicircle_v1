<div>
    <p>
        <?php echo __d('pages', 'recoverpassinfo', true);?>
    </p>
<?php
echo $session->flash('auth');
echo $form->create('User', array('controller'=>'users', 'action' => 'recover'));
echo $form->input('username',array('label'=>__d('pages', 'email', true).': '));
echo $form->end(__d('pages', 'recover', true));
?>
</div>