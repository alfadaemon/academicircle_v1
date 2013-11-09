<div class="groupsUsers index">
<h2><?php __('GroupsUsers');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('group_id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($groupsUsers as $groupsUser):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $groupsUser['GroupsUser']['id']; ?>
		</td>
		<td>
			<?php echo $groupsUser['GroupsUser']['group_id']; ?>
		</td>
		<td>
			<?php echo $groupsUser['GroupsUser']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $groupsUser['GroupsUser']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $groupsUser['GroupsUser']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $groupsUser['GroupsUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupsUser['GroupsUser']['id'])); ?>
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
		<li><?php echo $html->link(__('New GroupsUser', true), array('action' => 'add')); ?></li>
	</ul>
</div>
