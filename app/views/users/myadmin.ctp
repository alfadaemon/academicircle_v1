<?php
App::import('Vendor', 'Humantime', array('file'=>'humantime'.DS.'humantime.php'));
$humantime = new humantime();

echo $ajax->div('editArea', array('class'=>'workarea', 'style'=>'margin: auto 10%; min-height:300px; display:block; clear:both;'));
echo $ajax->divEnd('editArea');

echo $ajax->div('workArea', array('class'=>'workarea', 'style'=>'margin: auto 10%; min-height:300px; display:block; clear:both;'));
?>
<div id="actions">
    <?php echo '<h2>'.__('My Admin', true).'</h2>';?>
    <?php echo $ajax->link( __('Years', true), array('controller'=>'years', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').show()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Schools', true), array('controller'=>'schools', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').show()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Grades', true), array('controller'=>'grades', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').show()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Matters', true), array('controller'=>'matters', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Sections', true), array('controller'=>'sections', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Schedules', true), array('controller'=>'schedules', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Tasks', true), array('controller'=>'tasks', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Users', true), array('controller'=>'users', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Groups', true), array('controller'=>'groups', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Students', true), array('controller'=>'students', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Teachers', true), array('controller'=>'teachers', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
    <?php echo $ajax->link( __('Parents', true), array('controller'=>'ancestors', 'action'=>'index'),
                array('update' => 'editArea', 'indicator' => 'LoadingDiv', 'after' => "$('#editArea').fadeToggle()", 'escape'=>false));?>
</div>
<?php 
	echo $ajax->buttonset('actions');

	echo $ajax->divEnd('workArea');
?>
