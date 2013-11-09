<div class="schedules form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Schedule', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'schedules', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add Schedule');?></legend>
	<?php
		echo $form->label(__d('logged','school',true));
		echo $form->select('school_id',$schools, $selectedSchool);
        echo $ajax->observeField( 'ScheduleSchoolId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add', $form->value('Schedule.id') )
                )
            );
        echo $form->label(__d('logged','section',true));
		echo $form->select('section_id',$sections, $selectedSection);
        echo $ajax->observeField( 'ScheduleSectionId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add', $form->value('Schedule.id') )
                )
            );
		echo $form->input('subject_id');
		echo $form->input('teacher_id');
		echo $form->input('starts');
		echo $form->input('ends');
		echo $form->input('monday');
		echo $form->input('tuesday');
		echo $form->input('wednesday');
		echo $form->input('thursday');
		echo $form->input('friday');
		echo $form->input('saturday');
		echo $form->input('sunday');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions" id="scheduleAddActions">
    <?php
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('controller' => 'schools', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller' => 'subjects', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller' => 'subjects', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller' => 'sections', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller' => 'sections', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'teacher', true).'s', array('controller' => 'teachers', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'teacher', true), array('controller' => 'teachers', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php echo $ajax->buttonset('scheduleAddActions');?>