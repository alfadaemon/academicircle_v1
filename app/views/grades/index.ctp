<div class="grades index">
<h2><?php __('Grades');?></h2>
<p>
<?php
$paginator->options(array(
    'update' => '#editAreaMyAdmin',
    'evalScripts' => true
));

echo $form->input('schools',array('label'=>'', 'type'=>'select', 'options'=>$schools));
echo $ajax->observeField( 'schools',
    array(
        'update'=>'editAreaMyAdmin',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyAdmin').show('slow')",
        'url' => array( 'action' => 'index' )
    )
);

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('school_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($grades as $grade):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $grade['Grade']['id']; ?>
		</td>
		<td>
			<?php echo $grade['Grade']['name']; ?>
		</td>
		<td>
			<?php echo $grade['Grade']['description']; ?>
		</td>
		<td>
           <?php echo $ajax->link($grade['School']['name'], array('controller' => 'schools', 'action' => 'view', $grade['School']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
		<td class="actions">
            <?php 
                echo $ajax->link( __d('logged', 'view', true), array('action' => 'view', $grade['Grade']['id']),
                    array('id'=>'view'.$grade['Grade']['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('action' => 'edit', $grade['Grade']['id']),
                    array('id'=>'edit'.$grade['Grade']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete',$grade['Grade']['id']),
                    array('id'=>'delete'.$grade['Grade']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $grade['Grade']['name']));

                echo $ajax->button('view'.$grade['Grade']['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('edit'.$grade['Grade']['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('delete'.$grade['Grade']['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
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
<div class="actions" id="gradeactions">
    <?php
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller' => 'subjects', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller' => 'subjects', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller' => 'sections', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller' => 'sections', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php
    echo $ajax->buttonset('gradeactions');
    echo $js->writeBuffer();
?>
