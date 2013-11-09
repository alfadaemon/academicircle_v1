<div class="matters form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Subject', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'subjects', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add Subject');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('school_id');
        echo $ajax->observeField( 'SubjectSchoolId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add')
                )
            );
        
		echo $form->input('grade_id');
	?>
	</fieldset>
<?php  echo $form->end(__d('logged', 'create', true));?>
</div>
<div class="actions" id="subjectAddActions">
    <?php
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('controller' => 'schools', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller' => 'schedules', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller' => 'schedules', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php echo $ajax->buttonset('subjectAddActions');?>