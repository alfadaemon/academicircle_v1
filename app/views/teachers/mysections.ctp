<?php
    echo $session->flash();
    echo $this->element("taskviews");
?>
<table class="calendar">
  <tr class="calendar-row">
    <th><?php echo date('M Y', strtotime($start));?></th>
    <th colspan="2">
        <div id="notifyPrincipal" style="float:right;">
            <?php
                echo $ajax->link(__d('logged', 'notify',true).' '.__d('logged', 'schedule',true), array('controller'=>'teachers', 'action'=>'notifyPrincipal', $week), array('id'=>'notifyPrincipal', 'indicator' => 'LoadingDiv', 'update'=>'editAreaListView'));//, 'after' =>"$('#editAreaListView').slideUp();"));
                echo $ajax->button('notifyPrincipal', array('icons'=>array('secondary'=>'ui-icon-mail-closed')));
            ?>
        </div>
    </th>
	<th colspan=2 style="text-align:right">
    <?php
        
        echo $ajax->link(__d('logged', 'previous', true).' '.__d('logged', 'week', true),
                array('controller'=>'teachers', 'action'=>'mysections', $section, $subject, $week-1),
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
                array('controller'=>'teachers', 'action'=>'mysections', $section, $subject, $week+1),
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
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start));?>
        </div>
        <?php
            echo __d('logged', 'sun', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +1 days'));?>
        </div>
        <?php
            echo __d('logged', 'mon', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +2 days'));?>
        </div>
        <?php
            echo __d('logged', 'tue', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +3 days'));?>
        </div>
        <?php
            echo __d('logged', 'wed', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +4 days'));?>
        </div>
        <?php
            echo __d('logged', 'thu', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
    <div class="days">
        <div class="day-number">
           <?php echo date('d', strtotime($start.' +5 days'));?>
        </div>
        <?php
            echo __d('logged', 'fri', true);
        ?>
    </div>
    </td>
	<td class="calendar-day-head">
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
            foreach($sunday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($monday as $day){
         ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($tuesday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($wednesday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($thursday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($friday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
            foreach($saturday as $day){
        ?>
            <div class="schedule">
                <div class="task">
                    <?php
                     echo $ajax->link($html->image('calendar_add.png',array('alt'=>__d('logged','add', true).' '.__d('logged','task',true), 'title'=>__d('logged','add', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'add',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     echo $ajax->link($html->image('calendar.png',array('alt'=>__d('logged','view', true).' '.__d('logged','task',true), 'title'=>__d('logged','view', true).' '.__d('logged','task',true)),false ), array('controller' =>'tasks','action' =>'viewall',$day['Schedule']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher'
                                            ,'after' => "$('#workAreaTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);

                     if($extramodules){
                     echo $ajax->link($html->image('attendance.png',array('alt'=>__d('logged', 'attendance', true), 'title'=>__d('logged', 'attendance', true)),false ), array('controller' =>'attendances','action' =>'viewsectionhistory',$day['Section']['id'], $week )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
                     }
                     ?>
                </div>
                <div class="hour">
                    <?php echo date('H:i', strtotime( $day['Schedule']['starts'])). '-'.date('H:i', strtotime($day['Schedule']['ends']));?>
                </div>
                <div class="hour">
                    <?php echo $day['Section']['name'];?>
                </div>
                <div class="task">
        <?php
                echo $day['Subject']['name'];
        ?>
                </div>
                <div class="clearfix">
                    <?php
                    foreach( $day['Task'] as $task){
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
