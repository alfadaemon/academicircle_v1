<div class="ancestors form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Ancestor', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'ancestors', 'action'=>'edit') ) ));?>
	<fieldset>
 		<legend><?php __('Edit Ancestor');?></legend>
	<?php
		echo $form->input('id');
        echo $form->select('schools',$schools);
        echo $ajax->observeField( 'AncestorSchools',
            array(
                'update'=>'editAreaMyAdmin',
                'indicator' => 'LoadingDiv',
                'after' => "$('#editAreaMyAdmin').show('slow')",
                'url' => array( 'action' => 'edit' )
            )
        );
		echo $form->input('user_id');
		echo $form->input('student_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions" id="actionsEditParent">
    <?php
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'parent', true), array('action' => 'delete', $form->value('Ancestor.id')),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$form->value('Ancestor.id')));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'parent', true).'s', array('action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
    ?>
</div>
<?php echo $ajax->buttonset('actionsEditParent');?>
