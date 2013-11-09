<div class="gradebooks form">
<?php echo $form->create('Gradebook');?>
	<fieldset>
 		<legend><?php __('Edit Gradebook');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('task_id');
		echo $form->input('student_id');
		echo $form->input('score');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Gradebook.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Gradebook.id'))); ?></li>
		<li><?php echo $html->link(__('List Gradebooks', true), array('action' => 'index'));?></li>
	</ul>
</div>
