<div class="grades view">
<h2><?php  __('Grade');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $grade['Grade']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php
                echo $ajax->link($grade['School']['name'], array('controller' => 'schools', 'action' => 'view', $grade['School']['id']),
                            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
            ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions" id="actionsViewGrade">
    <?php
        echo $ajax->link( __d('logged', 'edit', true).' '.__d('logged', 'grade', true), array('action' => 'edit',$grade['Grade']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('logged', 'grade', true), array('action' => 'delete', $grade['Grade']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$grade['Grade']['name']));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'subject', true).'s', array('controller'=>'subjects', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'subject', true), array('controller'=>'subjects', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller'=>'sections', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller'=>'sections', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
    ?>
</div>
<?php echo $ajax->buttonset('actionsViewGrade');?>
<div class="related">
	<h3><?php __('Related Subjects');?></h3>
	<?php if (!empty($grade['Subject'])):?>
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
		foreach ($grade['Subject'] as $subject):
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
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'subjects', 'action' => 'view', $subject['id']),
                        array('id'=>'viewSubject'.$subject['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'subjects', 'action' => 'edit', $subject['id']),
                        array('id'=>'editSubject'.$subject['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'subjects', 'action' => 'delete', $subject['id']),
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
        <?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'subjects', 'action' => 'add'),
                    array('id'=>'addSubject', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addSubject', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Sections');?></h3>
	<?php if (!empty($grade['Section'])):?>
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
		foreach ($grade['Section'] as $section):
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
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'sections', 'action' => 'view', $section['id']),
                        array('id'=>'viewSection'.$section['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'sections', 'action' => 'edit', $section['id']),
                        array('id'=>'editSection'.$section['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'sections', 'action' => 'delete', $section['id']),
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
		<?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'sections', 'action' => 'add'),
                array('id'=>'addSection', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addSection', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
