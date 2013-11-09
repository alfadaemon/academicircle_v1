<div class="students form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Student', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'students', 'action'=>'edit') ) ));?>
	<fieldset>
 		<legend><?php __('Edit Student');?></legend>
	<?php
		echo $form->input('id');
//        echo $form->select('schools',$schools);
//        echo $ajax->observeField( 'StudentSchools',
//            array(
//                'update'=>'editAreaMyAdmin',
//                'indicator' => 'LoadingDiv',
//                'after' => "$('#editAreaMyAdmin').show('slow')",
//                'url' => array( 'action' => 'edit' )
//            )
//        );
		echo $form->input('user_id');
		echo $form->input('section_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions" id="actionsEditStudent">
    <?php
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'student', true), array('action' => 'delete', $form->value('Student.id')),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$form->value('Student.id')));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'student', true).'s', array('action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'student', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
    ?>
</div>
<?php echo $ajax->buttonset('actionsEditStudent');?>
