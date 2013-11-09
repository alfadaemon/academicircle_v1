<div class="arosAcos form">
<?php echo $form->create('ArosAco');?>
	<fieldset>
 		<legend><?php __('Edit ArosAco');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('aro_id');
		echo $form->input('aco_id');
		echo $form->input('_create');
		echo $form->input('_read');
		echo $form->input('_update');
		echo $form->input('_delete');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('ArosAco.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('ArosAco.id'))); ?></li>
		<li><?php echo $html->link(__('List ArosAcos', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Aros', true), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aro', true), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Acos', true), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aco', true), array('controller' => 'acos', 'action' => 'add')); ?> </li>
	</ul>
</div>
