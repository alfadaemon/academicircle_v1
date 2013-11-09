<?php
        echo $ajax->form( array('type'=>'post', 'options' => array('Model'=>'Task', 'update'=>'editAreaMyTeachers', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'tasks', 'action'=>'viewlist',$teacherid) ) ));
        echo $form->input('startdate', array('size'=>10, 'value'=>$startdate,'div'=>array('class'=>'lfloat'), 'label'=>__d('logged', 'start', true), 'id'=>'startdate'));
        echo $form->input('enddate', array('size'=>10, 'value'=>$enddate,'div'=>array('class'=>'lfloat'),  'label'=>__d('logged', 'end', true), 'id'=>'enddate'));
        echo $form->end(__d('logged', 'filter', true));

        echo $ajax->datepicker('startdate', array(
                                'maxDate' => '"+1M +2D"',
                                'dateFormat' => "yy-mm-dd",
                                'showButtonPanel' => true,
                                //'changeMonth' => true,
                                //'changeYear' => true,
                                'buttonImageOnly' => true,
                                'showOn' => 'button',
                                'buttonImage' => '../img/calendar.png'
                            ));
        echo $ajax->datepicker('enddate', array(
                                'maxDate' => '"+1M +2D"',
                                'dateFormat' => "yy-mm-dd",
                                'showButtonPanel' => true,
                                //'changeMonth' => true,
                                //'changeYear' => true,
                                'buttonImageOnly' => true,
                                'showOn' => 'button',
                                'buttonImage' => '../img/calendar.png'
                            ));
?>

<?php
foreach($tasklist as $task):
    ?>
<div style="clear:both; width:300px; float:left;" class="thread">
    <div>
        <?php
            echo '('.$task['Section']['name'].') '.$task['Subject']['name'];
        ?>
    </div>
    <?php
    foreach($task['Task'] as $tsk):
        ?>
        <div style="clear:both" class="comment">
        <?php
        switch ($tsk['type']){
            case 2:
                $image='script_edit.png';
                $title=__d('logged', 'exam',true);
                break;
            case 3:
                $image='exclamation.png';
                $title=__d('logged', 'info',true);
                break;
            case 4:
                $image='link.png';
                $title=__d('logged', 'link',true);
                break;
            default:
                $image='new.png';
                $title=__d('logged', 'task',true);
                break;
        }
        echo $ajax->link(substr($tsk['title'], 0, 30).'... '.$html->image($image,array('title'=>__d('logged', 'view', true).' '.$title),false ), array('controller' =>'tasks','action' =>'view',$tsk['id'] )
									,array('escape'=>false, 'update'=>'OverlayMyTeacher'
											,'after' =>"$('#OverlayMyTeacher').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
        ?>
            <div style="float:right">
        <?php
        echo __d('logged',strtolower( date('D', strtotime($tsk['duedate'])) ), true).'-';
        echo date('d/m/Y', strtotime($tsk['duedate']) );
        ?>
            </div>
    </div>
    <?php
    endforeach;
   ?>
</div>
<?php endforeach; ?>
