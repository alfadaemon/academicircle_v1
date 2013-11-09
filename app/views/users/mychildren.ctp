<?php
echo $ajax->div('workArea', array('class'=>'lfloat', 'style'=>'min-height:300px;'));
?>
<div id="children" class="lfloat" style="padding-right:10px;width:150px">
        <?php 
        foreach($students as $student){
            ?>
            <h3 style="font-size:11px">
            <?php
                echo $html->link($student['User']['fname'].' '.$student['User']['flname'],'#',array('escape'=>false));
            ?>
            </h3>
    <ul>
            <?php
            echo '<li style="font-size:9px">'.$html->image('calendar.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ).
                $ajax->link(__d('logged', 'schedule',true), array('controller'=>'schedules', 'action'=>'usrview', $student['Section']['id']),
                  array('update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaListView').slideDown()" )).'</li>';
            if($extramodules){
                echo '<li style="font-size:9px">'.$html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ).
                    $ajax->link(__d('logged', 'attendance',true), array('controller'=>'attendances', 'action'=>'viewstudent', $student['Student']['id']),
                      array('update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaListView').slideDown()" )).'</li>';
            }
            ?>
    </ul>
        <?php
        };//foreach
        ?>
</div>
<?php
echo $ajax->accordion('children', array(
            'autoHeight' => false,
            'navigation' => true));

echo $ajax->divEnd('workArea');

echo $ajax->div('editAreaListView', array('class'=>'lfloat', 'style'=>'width:350px; min-height:300px; display:block;'));
echo "&nbsp";
echo $ajax->divEnd('editAreaListView');

echo $ajax->div('workAreaTeacher', array('style'=>'position:fixed; top: 0px; widht:100%'));
echo "&nbsp";
echo $ajax->divEnd('workAreaTeacher');
?>
