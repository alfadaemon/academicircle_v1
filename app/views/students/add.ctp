<div class="students form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Student', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'students', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add Student');?></legend>
	<?php
        echo $form->label(__d('logged','school',true));
		echo $form->select('school_id',$schools, $selectedSchool);
        echo $ajax->observeField( 'StudentSchoolId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add', $form->value('Schedule.id') )
                )
            );
		echo $form->input('section_id');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end(__d('logged','change', true));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Students', true), array('action' => 'index'));?></li>
	</ul>
</div>
