<div class="listMembers index">
<h2><?php __('ListMembers');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('mylist_id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($listMembers as $listMember):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $listMember['ListMember']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($listMember['Mylist']['name'], array('controller' => 'mylists', 'action' => 'view', $listMember['Mylist']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($listMember['User']['id'], array('controller' => 'users', 'action' => 'view', $listMember['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $listMember['ListMember']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $listMember['ListMember']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $listMember['ListMember']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listMember['ListMember']['id'])); ?>
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
		<li><?php echo $html->link(__('New ListMember', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Mylists', true), array('controller' => 'mylists', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Mylist', true), array('controller' => 'mylists', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
