<div class="themes form">
<?php echo $form->create('Theme');?>
	<fieldset>
 		<legend><?php __('Edit Theme');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Theme.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Theme.id'))); ?></li>
		<li><?php echo $html->link(__('List Themes', true), array('action' => 'index'));?></li>
	</ul>
</div>
