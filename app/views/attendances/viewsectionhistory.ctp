<?php
/**
 * File name: viewsectionhistory.ctp
 * Project: academicircle
 * Creation: Mar 18, 2011
 *
 * @author lfaraya
 */

echo $session->flash();
?>
<table class="calendar">
  <tr  class="calendar-row">
      <th colspan=2><?php echo date('M Y', strtotime($start));?></th>
      <th colspan="3">
      <?php
        echo $ajax->link(__d('logged', 'previous', true).' '.__d('logged', 'week', true),
                array('controller'=>'attendances', 'action'=>'viewsectionhistory', $section, $week-1),
                array('id'=>'previous2', 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"));
        echo $ajax->button('previous2', array(
            'icons' => array(
                'primary' => 'ui-icon-seek-prev'
                )
            ));
    ?>
    </th>
    <th colspan="3">
    <?php
        echo $ajax->link(__d('logged', 'next', true).' '.__d('logged', 'week', true),
                array('controller'=>'attendances', 'action'=>'viewsectionhistory', $section, $week+1),
                array('id'=>'next2', 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"));
        echo $ajax->button('next2', array(
            'icons' => array(
                'secondary' => 'ui-icon-seek-next'
                )
            ));
    ?>
    </th>
  </tr>
  <tr class="calendar-row">
    <td class="calendar-day-head" style="min-width:150px">
        <?php echo __d('pages', 'students',true);?>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start));?>
        </div>
        <?php
            echo __d('logged', 'sun', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +1 days'));?>
        </div>
        <?php
            echo __d('logged', 'mon', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +2 days'));?>
        </div>
        <?php
            echo __d('logged', 'tue', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +3 days'));?>
        </div>
        <?php
            echo __d('logged', 'wed', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +4 days'));?>
        </div>
        <?php
            echo __d('logged', 'thu', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +5 days'));?>
        </div>
        <?php
            echo __d('logged', 'fri', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="min-width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +6 days'));?>
        </div>
        <?php
            echo __d('logged', 'sat', true);
        ?>
    </div>
    </td>
  </tr>
  <?php
  $i = 0;
  foreach($students as $student):
    $class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
  ?>
  <tr<?php echo $class;?>>
      <td>
          <?php
            echo $student['User']['fname'].' '.$student['User']['flname'];

          ?>
          <div class="rfloat">
          <?php
            echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'history', true), array('controller'=>'attendances', 'action' => 'viewstudenthistory', $student['Student']['id']),
                    array('id'=>'edit'.$student['Student']['id'], 'update' => 'workAreaTeacher', 'indicator' => 'LoadingDiv', 'after' => "$('#workAreaTeacher').slideDown()"));

            echo $ajax->button('edit'.$student['Student']['id'], array('icons'=>array('secondary'=>'ui-icon-circle-zoomin'), 'text'=>false));
            ?>
          </div>
		</td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['sun'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['mon'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['tue'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['wed'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['thu'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['fri'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>
        <td>
            <?php
                if($extramodules){
                 foreach($student['sat'] as $st){
                     echo $ajax->link($html->image('attendance_fail.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>$st['Attendance']['comment']),false ), array('controller' =>'attendances','action' =>'view',$st['Attendance']['id'])
                                    ,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
                     }
                 }
            ?>
        </td>

  </tr>
  <?php endforeach; ?>
</table>
