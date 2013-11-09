<div class="grades view">
<h2><?php  __('Grade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($grade['School']['name'], array('controller' => 'schools', 'action' => 'view', $grade['School']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Grade', true), array('action' => 'edit', $grade['Grade']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Grade', true), array('action' => 'delete', $grade['Grade']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $grade['Grade']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Grades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Grade', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Matters', true), array('controller' => 'matters', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Matter', true), array('controller' => 'matters', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Sections', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Matters');?></h3>
	<?php if (!empty($grade['Matter'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Grade Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grade['Matter'] as $matter):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $matter['id'];?></td>
			<td><?php echo $matter['name'];?></td>
			<td><?php echo $matter['grade_id'];?></td>
			<td><?php echo $matter['school_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'matters', 'action' => 'view', $matter['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'matters', 'action' => 'edit', $matter['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'matters', 'action' => 'delete', $matter['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matter['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Matter', true), array('controller' => 'matters', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Sections');?></h3>
	<?php if (!empty($grade['Section'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Grade Id'); ?></th>
		<th><?php __('Year Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($grade['Section'] as $section):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $section['id'];?></td>
			<td><?php echo $section['name'];?></td>
			<td><?php echo $section['grade_id'];?></td>
			<td><?php echo $section['year_id'];?></td>
			<td><?php echo $section['school_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'sections', 'action' => 'view', $section['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'sections', 'action' => 'edit', $section['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'sections', 'action' => 'delete', $section['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $section['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Section', true), array('controller' => 'sections', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
