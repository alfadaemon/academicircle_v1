<div class="listMembers view">
<h2><?php  __('ListMember');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $listMember['ListMember']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mylist'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($listMember['Mylist']['name'], array('controller' => 'mylists', 'action' => 'view', $listMember['Mylist']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($listMember['User']['id'], array('controller' => 'users', 'action' => 'view', $listMember['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit ListMember', true), array('action' => 'edit', $listMember['ListMember']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete ListMember', true), array('action' => 'delete', $listMember['ListMember']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listMember['ListMember']['id'])); ?> </li>
		<li><?php echo $html->link(__('List ListMembers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New ListMember', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Mylists', true), array('controller' => 'mylists', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Mylist', true), array('controller' => 'mylists', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
