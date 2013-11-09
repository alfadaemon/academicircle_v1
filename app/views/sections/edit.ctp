<div class="sections form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Section', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'sections', 'action'=>'edit') ) ));?>
	<fieldset>
 		<legend><?php __('Edit Section');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
        echo $form->input('school_id');
        echo $ajax->observeField( 'SectionSchoolId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'edit', $form->value('Section.id') )
                )
            );
		echo $form->input('grade_id');
        echo $ajax->observeField( 'SectionGradeId',
                array(
                    'update'=>'editAreaMyAdmin',
                    'indicator' => 'LoadingDiv',
                    'after' => "$('#editAreaMyAdmin').show('slow')",
                    'url' => array( 'action' => 'edit', $form->value('Section.id') )
                )
            );
		echo $form->input('year_id');
        echo $form->input('order');
        echo $form->input('active');
	?>
	</fieldset>
<?php echo $form->end(__d('logged', 'change', true));?>
</div>
<div class="actions" id="sectionEditActions">
    <?php
        echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete', $form->value('Section.id')),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Section.name')));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'add'),
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
<?php echo $ajax->buttonset('sectionEditActions'); ?>
