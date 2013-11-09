<div class="gradebooks index">
<h2><?php __('Gradebooks');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('task_id');?></th>
	<th><?php echo $paginator->sort('student_id');?></th>
	<th><?php echo $paginator->sort('score');?></th>
	<th><?php echo $paginator->sort('updated');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($gradebooks as $gradebook):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $gradebook['Gradebook']['id']; ?>
		</td>
		<td>
			<?php echo $gradebook['Gradebook']['task_id']; ?>
		</td>
		<td>
			<?php echo $gradebook['Gradebook']['student_id']; ?>
		</td>
		<td>
			<?php echo $gradebook['Gradebook']['score']; ?>
		</td>
		<td>
			<?php echo $gradebook['Gradebook']['updated']; ?>
		</td>
		<td>
			<?php echo $gradebook['Gradebook']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $gradebook['Gradebook']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $gradebook['Gradebook']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $gradebook['Gradebook']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gradebook['Gradebook']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Gradebook', true), array('action' => 'add')); ?></li>
	</ul>
</div>
