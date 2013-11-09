<div id="newTask" style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 10px; margin:auto 100px;">
<div class="attendances form">
    <H2><?php echo __d('logged', 'add', true);?></H2>
<?php 
    echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Attendance', 'update'=>'workAreaTeacher', 'indicator' => 'LoadingDiv2', 'url'=>array('controller'=> 'attendances', 'action'=>'add') ) ));

    echo $this->Form->hidden('schedule_id', array('value'=>$schedule));
    echo $this->Form->hidden('student_id', array('value'=>$student));
    echo $form->input('Attendance.adate', array('id'=>'adatepicker', 'value'=> date('Y-m-d'), 'type'=>'text',  'label'=>__d('logged', 'date', true)));
    //echo $this->Form->input('comment');
    echo $form->input('Attendance.comment', array('value'=>'', 'label'=>__d('logged', 'comment', true), 'type'=>'text'));
    //echo $this->Form->input('approved');

    echo $this->Form->end(__d('logged', 'add', true));
    echo $ajax->datepicker('adatepicker', array(
                                    //'minDate' => 0,
                                    //'maxDate' => '"+1M +2D"',
                                    'dateFormat' => "yy-mm-dd",
                                    'showButtonPanel' => true,
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'buttonImageOnly' => true,
                                    'showOn' => 'button',
                                    'buttonImage' => '../img/calendar.png',
                                ));
?>
<?php
        echo $ajax->div('LoadingDiv2', array('style'=>'display:none; position:fixed; top: 2px; left: 180px; z-index:1000; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
        echo __d('logged', 'loading', true).', '.__d('logged', 'dontclosewindow', true);
        echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
        echo $ajax->divEnd('LoadingDiv2');
    ?>
    <br />
    <div id="closethis" class="actions">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeaddatt', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeaddatt', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
    </div>
</div>
</div>