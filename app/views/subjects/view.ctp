<div class="subjects view">
<h2><?php  __('Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $subject['Subject']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ajax->link($subject['Grade']['name'], array('controller' => 'grades', 'action' => 'view', $subject['Grade']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ajax->link($subject['School']['name'], array('controller' => 'schools', 'action' => 'view', $subject['School']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" )); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions" id="actionsViewSubject">
    <?php
        echo $ajax->link( __d('logged', 'edit', true).' '.__d('logged', 'subject', true), array('action' => 'edit',$subject['Subject']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'subject', true), array('action' => 'delete', $subject['Subject']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$subject['Subject']['name']));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller' => 'subjects', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller' => 'subjects', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller'=>'schedules', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller'=>'schedule', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'teacher', true).'s', array('controller'=>'teachers', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'teacher', true), array('controller'=>'teachers', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
    ?>
</div>
<?php echo $ajax->buttonset('actionsViewSubject');?>
<div class="related">
	<h3><?php __('Related Schedules');?></h3>
	<?php if (!empty($subject['Schedule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th><?php __('Teacher Id'); ?></th>
		<th><?php echo __d('logged','start',true); ?></th>
		<th><?php echo __d('logged','end',true); ?></th>
		<th><?php echo __d('logged','mon',true); ?></th>
		<th><?php echo __d('logged','tue',true); ?></th>
		<th><?php echo __d('logged','wed',true); ?></th>
		<th><?php echo __d('logged','thu',true); ?></th>
		<th><?php echo __d('logged','fri',true); ?></th>
		<th><?php echo __d('logged','sat',true); ?></th>
		<th><?php echo __d('logged','sun',true); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subject['Schedule'] as $schedule):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $schedule['id'];?></td>
			<td><?php echo $schedule['school_id'];?></td>
			<td><?php echo $schedule['subject_id'];?></td>
			<td><?php echo $schedule['section_id'];?></td>
			<td><?php echo $schedule['teacher_id'];?></td>
			<td><?php echo $schedule['starts'];?></td>
			<td><?php echo $schedule['ends'];?></td>
			<td><?php echo $schedule['monday'];?></td>
			<td><?php echo $schedule['tuesday'];?></td>
			<td><?php echo $schedule['wednesday'];?></td>
			<td><?php echo $schedule['thursday'];?></td>
			<td><?php echo $schedule['friday'];?></td>
			<td><?php echo $schedule['saturday'];?></td>
			<td><?php echo $schedule['sunday'];?></td>
			<td class="actions">
                <?php
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'schedules', 'action' => 'view', $schedule['id']),
                        array('id'=>'viewSchedule'.$schedule['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'subjects', 'action' => 'edit', $schedule['id']),
                        array('id'=>'editSchedule'.$schedule['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'subjects', 'action' => 'delete', $schedule['id']),
                        array('id'=>'deleteSchedule'.$schedule['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $schedule['id']));

                    echo $ajax->button('viewSchedule'.$schedule['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                    echo $ajax->button('editSchedule'.$schedule['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                    echo $ajax->button('deleteSchedule'.$schedule['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'schedules', 'action' => 'add'),
                    array('id'=>'addSchedule', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addSchedule', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Teachers');?></h3>
	<?php if (!empty($subject['Teacher'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($subject['Teacher'] as $teacher):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $teacher['id'];?></td>
			<td><?php echo $teacher['user_id'];?></td>
			<td><?php echo $teacher['Subject_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller' => 'teachers', 'action' => 'view', $teacher['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller' => 'teachers', 'action' => 'edit', $teacher['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller' => 'teachers', 'action' => 'delete', $teacher['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teacher['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Teacher', true), array('controller' => 'teachers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
