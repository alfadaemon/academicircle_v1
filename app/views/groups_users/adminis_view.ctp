<div class="groupsUsers view">
<h2><?php  __('GroupsUser');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupsUser['GroupsUser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupsUser['GroupsUser']['group_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupsUser['GroupsUser']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit GroupsUser', true), array('action' => 'edit', $groupsUser['GroupsUser']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete GroupsUser', true), array('action' => 'delete', $groupsUser['GroupsUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupsUser['GroupsUser']['id'])); ?> </li>
		<li><?php echo $html->link(__('List GroupsUsers', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New GroupsUser', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
