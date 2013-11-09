<div class="students index">
<h2><?php __('Students');?></h2>
<p>
<?php
$paginator->options(array(
    'update' => '#editAreaMyAdmin',
    'indicator'=> 'LoadingDiv',
    'evalScripts' => true
));

echo $form->select('schools',$schools, $selectedSchool);
echo $ajax->observeField( 'schools',
    array(
        'update'=>'editAreaMyAdmin',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyAdmin').show('slow')",
        'url' => array( 'action' => 'index' )
    )
);

echo $form->select('sections', $sections);
echo $ajax->observeField( 'sections',
    array(
        'update'=>'editAreaMyAdmin',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyAdmin').show('slow')",
        'url' => array( 'action' => 'index' )
    )
);
?>
    <br />
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
    <th><?php echo __d('logged', 'name', true); ?></th>
	<th><?php echo $paginator->sort('section_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($students as $student):
    //echo '<span>'.print_r($student).'</span>';
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $student['Student']['id']; ?>
		</td>
		<td>
			<?php
                echo $ajax->link($student['User']['username'], array('controller' => 'users', 'action' => 'view', $student['User']['id']),
                    array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
		</td>
        <td>
			<?php
                echo $student['User']['fname'].' '.$student['User']['sname'].' '.$student['User']['flname'].' '.$student['User']['slname'];
            ?>
		</td>
		<td>
			<?php
                echo $ajax->link($student['Section']['name'], array('controller' => 'sections', 'action' => 'view', $student['Section']['id']),
                    array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
		</td>
		<td class="actions">
			<?php
            echo $ajax->link( __d('logged', 'view', true), array('action' => 'view', $student['Student']['id']),
                array('id'=>'view'.$student['Student']['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'edit', true), array('action' => 'edit', $student['Student']['id']),
                array('id'=>'edit'.$student['Student']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
            echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete',$student['Student']['id']),
                array('id'=>'delete'.$student['Student']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $student['Student']['id']));

            echo $ajax->button('view'.$student['Student']['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
            echo $ajax->button('edit'.$student['Student']['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
            echo $ajax->button('delete'.$student['Student']['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
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
<div class="actions" id="studenteactions">
    <?php
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'student', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php
    echo $ajax->buttonset('studenteactions');
    echo $js->writeBuffer();
?>
