<?php echo $session->flash(); ?>
<div class="schools form">
<?php
    echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'School', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'schools', 'action'=>'edit') ) ));
?>
	<fieldset>
 		<legend><?php __('Edit School');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('address');
		echo $form->input('phone');
		echo $form->input('logo');
        echo $form->input('gradebook');
		echo $form->input('user_id');
		echo $form->input('active');
	?>
	</fieldset>
<?php 
    echo $form->end(__d('logged', 'change', true));
?>
</div>
<div class="actions" id="adminEditActions">
		<?php
            echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete', $form->value('School.id')),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $form->value('School.id')));
             echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true).'s', array('controller' => 'years', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'year', true), array('controller' => 'years', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'user', true).'s', array('controller' => 'users', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'user', true), array('controller' => 'users', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller' => 'subjects', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller' => 'subjects', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller' => 'sections', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller' => 'sections', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller' => 'schedules', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller' => 'schedules', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        ?>
</div>
<?php echo $ajax->buttonset('adminEditActions'); ?>
