<div class="groupsUsers form">
<?php echo $form->create('GroupsUser');?>
	<fieldset>
 		<legend><?php __('Add GroupsUser');?></legend>
	<?php
		echo $form->input('group_id');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List GroupsUsers', true), array('action' => 'index'));?></li>
	</ul>
</div>
