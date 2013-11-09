<div class="gradebooks view">
<h2><?php  __('Gradebook');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Task Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['task_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Student Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['student_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Score'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['score']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['updated']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gradebook['Gradebook']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Gradebook', true), array('action' => 'edit', $gradebook['Gradebook']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Gradebook', true), array('action' => 'delete', $gradebook['Gradebook']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gradebook['Gradebook']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Gradebooks', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Gradebook', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
