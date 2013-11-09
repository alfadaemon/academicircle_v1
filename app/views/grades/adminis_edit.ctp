<div class="grades form">
<?php echo $form->create('Grade');?>
	<fieldset>
 		<legend><?php __('Edit Grade');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('school_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Grade.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Grade.id'))); ?></li>
		<li><?php echo $html->link(__('List Grades', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Matters', true), array('controller' => 'matters', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Matter', true), array('controller' => 'matters', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
