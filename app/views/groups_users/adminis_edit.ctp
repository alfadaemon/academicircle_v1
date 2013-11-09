<div class="groupsUsers form">
<?php echo $form->create('GroupsUser');?>
	<fieldset>
 		<legend><?php __('Edit GroupsUser');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('group_id');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('GroupsUser.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('GroupsUser.id'))); ?></li>
		<li><?php echo $html->link(__('List GroupsUsers', true), array('action' => 'index'));?></li>
	</ul>
</div>
