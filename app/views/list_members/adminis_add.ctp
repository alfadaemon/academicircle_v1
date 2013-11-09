<div class="listMembers form">
<?php echo $form->create('ListMember');?>
	<fieldset>
 		<legend><?php __('Add ListMember');?></legend>
	<?php
		echo $form->input('mylist_id');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List ListMembers', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Mylists', true), array('controller' => 'mylists', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Mylist', true), array('controller' => 'mylists', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
