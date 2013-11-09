<div class="schedules index">
<h2><?php __('Schedules');?></h2>
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
	<th><?php echo $paginator->sort('school_id');?></th>
	<th><?php echo $paginator->sort('subject_id');?></th>
	<th><?php echo $paginator->sort('section_id');?></th>
	<th><?php echo $paginator->sort('teacher_id');?></th>
    <th><?php echo $paginator->sort('active');?></th>
	<th><?php echo __d('logged', 'start', true); ?></th>
    <th><?php echo __d('logged', 'end', true);?></th>
    <th><?php echo __d('logged', 'mon', true); ?></th>
    <th><?php echo __d('logged', 'tue', true); ?></th>
    <th><?php echo __d('logged', 'wed', true); ?></th>
    <th><?php echo __d('logged', 'thu', true); ?></th>
    <th><?php echo __d('logged', 'fri', true); ?></th>
    <th><?php echo __d('logged', 'sat', true); ?></th>
    <th><?php echo __d('logged', 'sun', true); ?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($schedules as $schedule):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $schedule['Schedule']['id']; ?>
		</td>
		<td>
            <?php echo $ajax->link($schedule['School']['name'], array('controller' => 'schools', 'action' => 'view', $schedule['School']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
		<td>
            <?php echo $ajax->link($schedule['Subject']['name'], array('controller' => 'subjects', 'action' => 'view', $schedule['Subject']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
		<td>
            <?php echo $ajax->link($schedule['Section']['name'], array('controller' => 'sections', 'action' => 'view', $schedule['Section']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>

		</td>
		<td>
            <?php echo $ajax->link($schedule['User']['username'], array('controller' => 'users', 'action' => 'view', $schedule['User']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
        <td>
			<?php echo $schedule['Schedule']['active']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['starts']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['ends']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['monday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['tuesday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['wednesday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['thursday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['friday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['saturday']; ?>
		</td>
		<td>
			<?php echo $schedule['Schedule']['sunday']; ?>
		</td>
		<td class="actions">
            <?php
                echo $ajax->link( __d('logged', 'view', true), array('action' => 'view', $schedule['Schedule']['id']),
                    array('id'=>'view'.$schedule['Schedule']['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('action' => 'edit', $schedule['Schedule']['id']),
                    array('id'=>'edit'.$schedule['Schedule']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete',$schedule['Schedule']['id']),
                    array('id'=>'delete'.$schedule['Schedule']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $schedule['Schedule']['id']));

                echo $ajax->button('view'.$schedule['Schedule']['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('edit'.$schedule['Schedule']['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('delete'.$schedule['Schedule']['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
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
<div class="actions" id="scheduleactions">
    <?php
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('action' => 'add'),
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
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'teacher', true).'s', array('controller' => 'teachers', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'teacher', true), array('controller' => 'teachers', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'task', true).'s', array('controller' => 'tasks', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'task', true), array('controller' => 'tasks', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php
    echo $ajax->buttonset('scheduleactions');
    echo $js->writeBuffer();
?>