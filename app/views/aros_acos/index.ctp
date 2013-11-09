<div class="arosAcos index">
<h2><?php __('ArosAcos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('aro_id');?></th>
	<th><?php echo $paginator->sort('aco_id');?></th>
	<th><?php echo $paginator->sort('_create');?></th>
	<th><?php echo $paginator->sort('_read');?></th>
	<th><?php echo $paginator->sort('_update');?></th>
	<th><?php echo $paginator->sort('_delete');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($arosAcos as $arosAco):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $arosAco['ArosAco']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($arosAco['Aro']['id'], array('controller' => 'aros', 'action' => 'view', $arosAco['Aro']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($arosAco['Aco']['id'], array('controller' => 'acos', 'action' => 'view', $arosAco['Aco']['id'])); ?>
		</td>
		<td>
			<?php echo $arosAco['ArosAco']['_create']; ?>
		</td>
		<td>
			<?php echo $arosAco['ArosAco']['_read']; ?>
		</td>
		<td>
			<?php echo $arosAco['ArosAco']['_update']; ?>
		</td>
		<td>
			<?php echo $arosAco['ArosAco']['_delete']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $arosAco['ArosAco']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $arosAco['ArosAco']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $arosAco['ArosAco']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $arosAco['ArosAco']['id'])); ?>
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
		<li><?php echo $html->link(__('New ArosAco', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Aros', true), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aro', true), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Acos', true), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aco', true), array('controller' => 'acos', 'action' => 'add')); ?> </li>
	</ul>
</div>
