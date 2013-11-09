<div class="ancestors index">
<h2><?php __('Ancestors');?></h2>
<p>
<?php
$paginator->options(array(
    'update' => '#editAreaMyAdmin',
    'indicator'=> 'LoadingDiv',
    'evalScripts' => true
));

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('student_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($ancestors as $ancestor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ancestor['Ancestor']['id']; ?>
		</td>
		<td>
            <?php
                echo $ajax->link($ancestor['User']['username'], array('controller' => 'users', 'action' => 'view', $ancestor['User']['id']),
                    array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
		</td>
		<td>
            <?php
                echo $ajax->link($ancestor['Student']['id'], array('controller' => 'users', 'action' => 'view', $ancestor['Student']['user_id']),
                    array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
		</td>
		<td class="actions">
			<?php
                echo $ajax->link( __d('logged', 'view', true), array('action' => 'view', $ancestor['Ancestor']['id']),
                    array('id'=>'view'.$ancestor['Ancestor']['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('action' => 'edit', $ancestor['Ancestor']['id']),
                    array('id'=>'edit'.$ancestor['Ancestor']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete',$ancestor['Ancestor']['id']),
                    array('id'=>'delete'.$ancestor['Ancestor']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $ancestor['Ancestor']['id']));

                echo $ajax->button('view'.$ancestor['Ancestor']['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('edit'.$ancestor['Ancestor']['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('delete'.$ancestor['Ancestor']['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
            ?>
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
<div class="actions" id="ancestoractions">
    <?php
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'parent', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php
    echo $ajax->buttonset('ancestoractions');
    echo $js->writeBuffer();
?>
