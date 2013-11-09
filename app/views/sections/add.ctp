<div class="sections form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Section', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'sections', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add Section');?></legend>
	<?php
        echo $form->label(__d('logged', 'school', true)) ;
		echo $form->select('school_id', $schools, $selectedSchool);
        echo $ajax->observeField( 'SectionSchoolId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add')
                )
            );
		echo $form->input('grade_id');
        echo $ajax->observeField( 'SectionGradeId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'add')
                )
            );
		echo $form->input('year_id');
        echo $form->input('name');
        echo $form->input('order');
        echo $form->input('active');
	?>
	</fieldset>
<?php  echo $form->end(__d('logged', 'create', true));?>
</div>
<div class="actions" id="sectionAddActions">
    <?php
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true).'s', array('controller' => 'years', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'year', true), array('controller' => 'years', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('controller' => 'schools', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller' => 'schedules', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller' => 'schedules', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'student', true).'s', array('controller' => 'students', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'student', true), array('controller' => 'students', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php echo $ajax->buttonset('sectionAddActions');?>