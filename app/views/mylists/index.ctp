<div class="mylists index">
<h2><?php __('Mylists');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($mylists as $mylist):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $mylist['Mylist']['id']; ?>
		</td>
		<td>
			<?php echo $mylist['Mylist']['name']; ?>
		</td>
		<td>
			<?php echo $mylist['Mylist']['description']; ?>
		</td>
		<td>
			<?php echo $html->link($mylist['User']['id'], array('controller' => 'users', 'action' => 'view', $mylist['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $mylist['Mylist']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $mylist['Mylist']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $mylist['Mylist']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mylist['Mylist']['id'])); ?>
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
		<li><?php echo $html->link(__('New Mylist', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List List Members', true), array('controller' => 'list_members', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New List Member', true), array('controller' => 'list_members', 'action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
