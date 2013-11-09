<div class="users form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'User', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'users', 'action'=>'edit') ) ));?>
	<fieldset>
 		<legend><?php __('Edit User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('username');
		echo $form->input('fname');
		echo $form->input('sname');
		echo $form->input('flname');
		echo $form->input('slname');
		echo $form->input('password');
		echo $form->input('nickname');
		echo $form->input('altemail');
		echo $form->input('gender');
		echo $form->input('language');
		echo $form->input('theme_id');
        echo $form->input('school_id');
		echo $form->input('active');
		echo $form->input('Group');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions" id="userEditActions">
    <?php
        echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete', $form->value('User.id')),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.username')));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'user', true).'s', array('action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'parent', true).'s', array('controller' => 'ancestors', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'parent', true), array('controller' => 'ancestors', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'student', true).'s', array('controller' => 'students', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'student', true), array('controller' => 'students', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php echo $ajax->buttonset('userEditActions'); ?>