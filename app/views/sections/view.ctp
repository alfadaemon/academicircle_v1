<div class="sections view">
<h2><?php  __('Section');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $section['Section']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $section['Section']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grade'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $ajax->link($section['Grade']['name'], array('controller' => 'grades', 'action' => 'view', $section['Grade']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $ajax->link($section['Year']['name'], array('controller' => 'years', 'action' => 'view', $section['Year']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $ajax->link($section['School']['name'], array('controller' => 'schools', 'action' => 'view', $section['School']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $section['Section']['active'];?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions" id="actionsViewSection">
    <?php
        echo $ajax->link( __d('logged', 'edit', true).' '.__d('logged', 'section', true), array('action' => 'edit',$section['Section']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'section', true), array('action' => 'delete', $section['Section']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$section['Section']['name']));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true).'s', array('controller' => 'years', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'year', true).'s', array('controller' => 'years', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller'=>'schedules', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller'=>'schedule', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'student', true).'s', array('controller'=>'students', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'student', true), array('controller'=>'students', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
    ?>
</div>
<?php echo $ajax->buttonset('actionsViewSection');?>
<div class="related">
	<h3><?php __('Related Schedules');?></h3>
	<?php if (!empty($section['Schedule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th><?php __('Teacher Id'); ?></th>
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
		foreach ($section['Schedule'] as $schedule):
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
	<h3><?php __('Related Students');?></h3>
	<?php if (!empty($section['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($section['Student'] as $student):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $student['id'];?></td>
			<td>
                <?php echo $ajax->link( $student['user_id'], array('controller' => 'users', 'action' => 'view',  $student['user_id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
            </td>
			<td><?php echo $student['section_id'];?></td>
			<td class="actions">
                <?php
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'students', 'action' => 'view', $student['id']),
                        array('id'=>'view'.$student['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'students', 'action' => 'edit', $student['id']),
                        array('id'=>'edit'.$student['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'students', 'action' => 'delete', $student['id']),
                        array('id'=>'delete'.$student['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $student['id']));

                    echo $ajax->button('view'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                    echo $ajax->button('edit'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                    echo $ajax->button('delete'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'students', 'action' => 'add'),
                    array('id'=>'addStudent', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addStudent', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
