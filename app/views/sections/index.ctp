<div class="sections index">
<h2><?php __('Sections');?></h2>
<p>
<?php
$paginator->options(array(
    'update' => '#editAreaMyAdmin',
    'indicator'=> 'LoadingDiv',
    'evalScripts' => true
));

echo $form->select('schools',$schools);
echo $ajax->observeField( 'schools',
    array(
        'update'=>'editAreaMyAdmin',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyAdmin').show('slow')",
        'url' => array( 'action' => 'index' )
    )
);

echo $form->select('grades', $grades);
echo $ajax->observeField( 'grades',
    array(
        'update'=>'editAreaMyAdmin',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyAdmin').show('slow')",
        'url' => array( 'action' => 'index' )
    )
);

echo $form->select('years',$years);
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
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('grade_id');?></th>
	<th><?php echo $paginator->sort('year_id');?></th>
	<th><?php echo $paginator->sort('school_id');?></th>
    <th><?php echo $paginator->sort('active');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($sections as $section):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $section['Section']['id']; ?>
		</td>
		<td>
			<?php echo $section['Section']['name']; ?>
		</td>
		<td>
            <?php echo $ajax->link($section['Grade']['name'], array('controller' => 'grades', 'action' => 'view', $section['Grade']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
		<td>
            <?php echo $ajax->link($section['Year']['name'], array('controller' => 'years', 'action' => 'view', $section['Year']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
		<td>
            <?php echo $ajax->link($section['School']['name'], array('controller' => 'schools', 'action' => 'view', $section['School']['id']),
                array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));?>
		</td>
        <td>
            <?php echo $section['Section']['active'];?>
		</td>
		<td class="actions">
            <?php
                echo $ajax->link( __d('logged', 'view', true), array('action' => 'view', $section['Section']['id']),
                    array('id'=>'view'.$section['Section']['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                echo $ajax->link( __d('logged', 'edit', true), array('action' => 'edit', $section['Section']['id']),
                    array('id'=>'edit'.$section['Section']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                echo $ajax->link( __d('logged', 'delete', true), array('action' => 'delete',$section['Section']['id']),
                    array('id'=>'delete'.$section['Section']['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $section['Section']['name']));

                echo $ajax->button('view'.$section['Section']['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                echo $ajax->button('edit'.$section['Section']['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                echo $ajax->button('delete'.$section['Section']['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
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
<div class="actions" id="subjectactions">
    <?php
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'grade', true).'s', array('controller' => 'grades', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'grade', true), array('controller' => 'grades', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'year', true).'s', array('controller' => 'years', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'year', true), array('controller' => 'years', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true), array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'schedule', true).'s', array('controller' => 'schedules', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'schedule', true), array('controller' => 'schedules', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'student', true).'s', array('controller' => 'students', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'student', true), array('controller' => 'students', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
    ?>
</div>
<?php
    echo $ajax->buttonset('subjectactions');
    echo $js->writeBuffer();
?>