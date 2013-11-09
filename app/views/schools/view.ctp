<?php echo $session->flash(); ?>
<div class="schools view">
<h2><?php  __('School');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['phone']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gradebook'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['gradebook']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Logo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['logo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php
                echo $ajax->link( $school['User']['username'], array('controller' => 'users', 'action' => 'view', $school['User']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['active']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions" id="schoolactions">
            <?php
            echo $ajax->link( __d('logged', 'edit', true).' '.__d('logged', 'school', true), array('action' => 'edit', $school['School']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'school', true), array('action' => 'delete', $school['School']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true), $school['School']['name']));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'user', true).'s', array('controller'=>'users', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'user', true), array('controller'=>'users', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller'=>'grades', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller'=>'grades', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller'=>'subjects', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller'=>'subjects', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller'=>'schedules', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true), array('controller'=>'schedules', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller'=>'sections', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller'=>'sections', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true).'s', array('controller'=>'years', 'action' => 'index'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true), array('controller'=>'schedule', 'action' => 'add'),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
</div>
<div class="clearfix">&nbsp;</div>
<?php echo $ajax->buttonset('schoolactions');?>
<div class="related">
	<h3><?php __('Related Grades');?></h3>
	<?php if (!empty($school['Grade'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Grade'] as $grade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $grade['id'];?></td>
			<td><?php echo $grade['name'];?></td>
			<td><?php echo $grade['description'];?></td>
			<td><?php echo $grade['school_id'];?></td>
			<td class="actions">
            <?php 
                echo $ajax->link( __d('logged', 'view', true), array('controller' => 'grades', 'action' => 'view', $grade['id']),
                    array('id'=>'viewGrade'.$grade['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'grades', 'action' => 'edit', $grade['id']),
                    array('id'=>'editGrade'.$grade['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'grades', 'action' => 'delete', $grade['id']),
                    array('id'=>'deleteGrade'.$grade['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $grade['name']));

                echo $ajax->button('viewGrade'.$grade['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('editGrade'.$grade['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('deleteGrade'.$grade['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
            ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li>
                <?php 
                echo $ajax->link( __d('logged', 'add', true), array('controller' => 'grades', 'action' => 'add'),
                    array('id'=>'addGrade', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

                echo $ajax->button('addGrade', array('icons'=>array('secondary'=>'ui-icon-plus'),));
                ?>
            </li>
		</ul>
	</div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="related">
	<h3><?php __('Related Subjects');?></h3>
	<?php if (!empty($school['Subject'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Grade Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Subject'] as $subject):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $subject['id'];?></td>
			<td><?php echo $subject['name'];?></td>
			<td><?php echo $subject['grade_id'];?></td>
			<td><?php echo $subject['school_id'];?></td>
			<td class="actions">
                <?php
                echo $ajax->link( __d('logged', 'view', true), array('controller' => 'grades', 'action' => 'view', $subject['id']),
                    array('id'=>'viewSubject'.$subject['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'grades', 'action' => 'edit', $subject['id']),
                    array('id'=>'editSubject'.$subject['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'grades', 'action' => 'delete', $subject['id']),
                    array('id'=>'deleteSubject'.$subject['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $subject['name']));

                echo $ajax->button('viewSubject'.$subject['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('editSubject'.$subject['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('deleteSubject'.$subject['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li>
                <?php
                echo $ajax->link( __d('logged', 'add', true), array('controller' => 'subjects', 'action' => 'add'),
                    array('id'=>'addSubject', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

                echo $ajax->button('addSubject', array('icons'=>array('secondary'=>'ui-icon-plus'),));
                ?>
            </li>
		</ul>
	</div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="related">
	<h3><?php __('Related Schedules');?></h3>
	<?php if (!empty($school['Schedule'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Subject Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th><?php __('Teacher Id'); ?></th>
		<th><?php __('Starts'); ?></th>
		<th><?php __('Ends'); ?></th>
		<th><?php __('Monday'); ?></th>
		<th><?php __('Tuesday'); ?></th>
		<th><?php __('Wednesday'); ?></th>
		<th><?php __('Thursday'); ?></th>
		<th><?php __('Friday'); ?></th>
		<th><?php __('Saturday'); ?></th>
		<th><?php __('Sunday'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Schedule'] as $schedule):
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
                echo $ajax->link( __d('logged', 'view', true), array('controller' => 'grades', 'action' => 'view', $schedule['id']),
                    array('id'=>'viewSchedule'.$schedule['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'grades', 'action' => 'edit', $schedule['id']),
                    array('id'=>'editSchedule'.$schedule['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'grades', 'action' => 'delete', $schedule['id']),
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
		<ul>
			<li><?php 
                    echo $ajax->link( __d('logged', 'add', true), array('controller' => 'schedules', 'action' => 'add'),
                    array('id'=>'addSchedule', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

                echo $ajax->button('addSchedule', array('icons'=>array('secondary'=>'ui-icon-plus'),));
            ?>
            </li>
		</ul>
	</div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="related">
	<h3><?php __('Related Sections');?></h3>
	<?php if (!empty($school['Section'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Grade Id'); ?></th>
		<th><?php __('Year Id'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Section'] as $section):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $section['id'];?></td>
			<td><?php echo $section['name'];?></td>
			<td><?php echo $section['grade_id'];?></td>
			<td><?php echo $section['year_id'];?></td>
			<td><?php echo $section['school_id'];?></td>
			<td class="actions">
                <?php 
                echo $ajax->link( __d('logged', 'view', true), array('controller' => 'grades', 'action' => 'view', $section['id']),
                    array('id'=>'viewSection'.$section['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'grades', 'action' => 'edit', $section['id']),
                    array('id'=>'editSection'.$section['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'grades', 'action' => 'delete', $section['id']),
                    array('id'=>'deleteSection'.$section['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $section['name']));

                echo $ajax->button('viewSection'.$section['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('editSection'.$section['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('deleteSection'.$section['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php
                    echo $ajax->link( __d('logged', 'add', true), array('controller' => 'sections', 'action' => 'add'),
                    array('id'=>'addSection', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));


                echo $ajax->button('addSection', array('icons'=>array('secondary'=>'ui-icon-plus'),));
            ?>
            </li>
		</ul>
	</div>
</div>

<div class="clearfix">&nbsp;</div>

<div class="related">
	<h3><?php __('Related Years');?></h3>
	<?php if (!empty($school['Year'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Year'] as $year):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $year['id'];?></td>
			<td><?php echo $year['name'];?></td>
			<td><?php echo $year['active'];?></td>
			<td><?php echo $year['school_id'];?></td>
			<td class="actions">
                <?php 
                echo $ajax->link( __d('logged', 'view', true), array('controller' => 'grades', 'action' => 'view', $year['id']),
                    array('id'=>'viewYear'.$year['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'grades', 'action' => 'edit', $year['id']),
                    array('id'=>'editYear'.$year['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'grades', 'action' => 'delete', $year['id']),
                    array('id'=>'deleteYear'.$year['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $year['name']));

                echo $ajax->button('viewYear'.$year['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('editYear'.$year['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('deleteYear'.$year['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li>
                <?php
                echo $ajax->link( __d('logged', 'add', true), array('controller' => 'years', 'action' => 'add'),
                    array('id'=>'addYear', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));


                echo $ajax->button('addYear', array('icons'=>array('secondary'=>'ui-icon-plus'),));
                ?>
            </li>
		</ul>
	</div>
</div>
