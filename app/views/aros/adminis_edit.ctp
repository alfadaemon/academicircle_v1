<div class="aros form">
<?php echo $form->create('Aro');?>
	<fieldset>
 		<legend><?php __('Edit Aro');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('parent_id');
		echo $form->input('model');
		echo $form->input('foreign_key');
		echo $form->input('alias');
		echo $form->input('lft');
		echo $form->input('rght');
		echo $form->input('Aco');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Aro.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Aro.id'))); ?></li>
		<li><?php echo $html->link(__('List Aros', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Acos', true), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aco', true), array('controller' => 'acos', 'action' => 'add')); ?> </li>
	</ul>
</div>
