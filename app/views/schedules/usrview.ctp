<?php
    echo $ajax->div('workAreaPs', array('style'=>'z-index:1000; position:fixed; top: 0px; widht:100%'));
    echo "&nbsp";
    echo $ajax->divEnd('workAreaPs');
?>
<div id="workArea">
<div class="schedules index">
<h3><?php
    echo __d('logged', 'schedule', true).': '.$sectionName;
?></h3>
<?php
echo $this->element("taskviews");
?>
<div class="lfloat" style="width:600px">
<table class="calendar">
  <tr class="calendar-row">
    <th colspan=3><?php echo date('M Y', strtotime($start));?></th>
	<th colspan=2>
    <?php
        echo $ajax->link(__d('logged', 'previous', true).' '.__d('logged', 'week', true),
                array('controller'=>'schedules', 'action'=>'usrview', $seccion, $week-1),
                array('id'=>'previous2', 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"));
        echo $ajax->button('previous2', array(
            'icons' => array(
                'primary' => 'ui-icon-seek-prev'
                )
            ));
    ?>
    </th>
    <th colspan=2>
    <?php
        echo $ajax->link(__d('logged', 'next', true).' '.__d('logged', 'week', true),
                array('controller'=>'schedules', 'action'=>'usrview', $seccion, $week+1),
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
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start));?>
        </div>
        <?php
            echo __d('logged', 'sun', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +1 days'));?>
        </div>
        <?php
            echo __d('logged', 'mon', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +2 days'));?>
        </div>
        <?php
            echo __d('logged', 'tue', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +3 days'));?>
        </div>
        <?php
            echo __d('logged', 'wed', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +4 days'));?>
        </div>
        <?php
            echo __d('logged', 'thu', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +5 days'));?>
        </div>
        <?php
            echo __d('logged', 'fri', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head" style="width:52px">
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
  <tr class="calendar-row">
  <td class="calendar-day">
  <?php
    foreach($sunday as $schedule){
  ?>
    
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>

  <td class="calendar-day">
  <?php
    foreach($monday as $schedule){
  ?>
    
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>
  <td class="calendar-day">
  <?php
    foreach($tuesday as $schedule){
  ?>
     
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>    
  <?php
    }
  ?>
  </td>

  <td class="calendar-day">
  <?php
    foreach($wednesday as $schedule){
  ?>
    
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>

  <td class="calendar-day">
  <?php
    foreach($thursday as $schedule){
  ?>
    
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>

  <td class="calendar-day">
  <?php
    foreach($friday as $schedule){
  ?>
    
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>

  <td class="calendar-day">
  <?php
    foreach($saturday as $schedule){
  ?>
    <div class="schedule">
        <div class="hour">
  <?php
        echo date('H:i', strtotime( $schedule['Schedule']['starts'])). '-'.date('H:i', strtotime($schedule['Schedule']['ends']));
  ?>
        </div>
        <div class="task">
  <?
        echo $schedule['Subject']['name'];
  ?>
        </div>
        <div class="clearfix">
        <?php
        foreach( $schedule['Task'] as $task){
            switch ($task['Task']['type']){
                case 2:
                    $image='script_edit.png';
                    break;
                case 3:
                    $image='exclamation.png';
                    break;
                case 4:
                    $image='link.png';
                    break;
                case 5:
                    $image='pictures.png';
                    break;
                default:
                    $image='new.png';
                    break;
            }
            echo $ajax->link($html->image($image,array('title'=>$task['Task']['title'],false )), array('controller' =>'tasks','action' =>'view',$task['Task']['id'] )
                                    ,array('escape'=>false, 'update'=>'workAreaPs'
                                            ,'after' => "$('#workAreaPs').slideDown()"
                                            //,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
                                            ),null, false);
        }
        ?>
        </div>
    </div>
  <?php
    }
  ?>
  </td>

  </tr>
 </table>
</div>
</div>
</div>
<div style="text-transform:capitalize;">
<?php
    if($menuoptions[0]['GroupsUser']['group_id']==2){
        if($enviado!=0){
            if($week>=0){
            echo $ajax->form( array('type'=>'post', 'options' => array('Model'=>'Schedule', 'update'=>'editAreaListView', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'schedules', 'action'=>'notifyParents', $seccion, $week) ) ));
            echo $form->input('Task.reminder', array('id'=>'reminder', 'value'=>'', 'label'=>__d('logged', 'reminder', true), 'type'=>'checkbox'));
            echo $form->button(__d('logged', 'send', true).' '.__d('logged', 'summary', true).' '.__d('pages', 'parents', true), array('id'=>'notify'));

            echo $ajax->button('notify', array(
                'icons' => array(
                    'secondary' => 'ui-icon-mail-closed'
                    )
                ));
    //        echo $ajax->button('reminder', array(
    //            'icons' => array(
    //                'secondary' => 'ui-icon-circle-check'
    //                )
    //            ));
            }
        }
    }
?>
</div>