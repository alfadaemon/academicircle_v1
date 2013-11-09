<?php
echo $session->flash();

App::import('Vendor', 'Humantime', array('file'=>'humantime'.DS.'humantime.php'));
$humantime = new humantime();
?>
<div class="post">
    <div id="adminActions">
       <?php
       echo $ajax->link( __('Schools', true), array('controller'=>'schools', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'before' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Years', true), array('controller'=>'years', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'before' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Grades', true), array('controller'=>'grades', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Subjects', true), array('controller'=>'subjects', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Sections', true), array('controller'=>'sections', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Schedules', true), array('controller'=>'schedules', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Tasks', true), array('controller'=>'tasks', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Users', true), array('controller'=>'users', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Students', true), array('controller'=>'students', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       ////echo $ajax->link( __('Teachers', true), array('controller'=>'teachers', 'action'=>'index'),
             //    array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));
       echo $ajax->link( __('Parents', true), array('controller'=>'ancestors', 'action'=>'index'),
                 array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').show()", 'escape'=>false));?>
    </div>
<?php echo $ajax->buttonset('adminActions'); ?>
<!-- post -->
</div>
<div>
	<?php
    	echo $ajax->div('editAreaMyAdmin', array('class'=>'workarea'));
    	echo $ajax->divEnd('editAreaMyAdmin');
	?>
    <!-- right -->
</div>
