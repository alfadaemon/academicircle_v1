<div class="mylists form">
<?php echo $form->create('Mylist');?>
	<fieldset>
 		<legend><?php __('Edit Mylist');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Mylist.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Mylist.id'))); ?></li>
		<li><?php echo $html->link(__('List Mylists', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List List Members', true), array('controller' => 'list_members', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New List Member', true), array('controller' => 'list_members', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
