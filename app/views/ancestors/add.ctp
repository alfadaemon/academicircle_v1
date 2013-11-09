<div class="ancestors form">
<?php echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Ancestor', 'update'=>'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'ancestors', 'action'=>'add') ) ));?>
	<fieldset>
 		<legend><?php __('Add Ancestor');?></legend>
	<?php
        echo $form->select('schools',$schools);
        echo $ajax->observeField( 'AncestorSchools',
            array(
                'update'=>'editAreaMyAdmin',
                'indicator' => 'LoadingDiv',
                'after' => "$('#editAreaMyAdmin').show('slow')",
                'url' => array( 'action' => 'add' )
            )
        );
        
		echo $form->input('user_id');
		echo $form->input('student_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Ancestors', true), array('action' => 'index'));?></li>
	</ul>
</div>
