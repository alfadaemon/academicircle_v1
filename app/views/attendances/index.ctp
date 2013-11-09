<div class="attendances index">
	<h2><?php __('Attendances');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('schedule_id');?></th>
			<th><?php echo $this->Paginator->sort('student_id');?></th>
			<th><?php echo $this->Paginator->sort('adate');?></th>
			<th><?php echo $this->Paginator->sort('comment');?></th>
			<th><?php echo $this->Paginator->sort('approved');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attendances as $attendance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attendance['Attendance']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($attendance['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $attendance['Schedule']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attendance['Student']['id'], array('controller' => 'students', 'action' => 'view', $attendance['Student']['id'])); ?>
		</td>
		<td><?php echo $attendance['Attendance']['adate']; ?>&nbsp;</td>
		<td><?php echo $attendance['Attendance']['comment']; ?>&nbsp;</td>
		<td><?php echo $attendance['Attendance']['approved']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $attendance['Attendance']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $attendance['Attendance']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $attendance['Attendance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attendance['Attendance']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Attendance', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Schedules', true), array('controller' => 'schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Schedule', true), array('controller' => 'schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Students', true), array('controller' => 'students', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Student', true), array('controller' => 'students', 'action' => 'add')); ?> </li>
	</ul>
</div>