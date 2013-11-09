<div class="users form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'User', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'users', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
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
<div class="actions" id="actionsAddUser">
    <?php
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'user', true).'s', array('action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'user', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'parent', true).'s', array('controller'=>'ancestors', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'parent', true), array('controller'=>'ancestors', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller'=>'sections', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller'=>'sections', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'task', true).'s', array('controller'=>'tasks', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'task', true), array('controller'=>'tasks', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));

    ?>
</div>
<?php echo $ajax->buttonset('actionsAddUser');?>
