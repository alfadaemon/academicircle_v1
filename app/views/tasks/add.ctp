<div id="newTask" style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 10px; margin:auto 100px;">
<div id="closethisup" class="actions" style="float:right">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeaddtaskup', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeaddtaskup', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
</div>
<?php //echo $form->create('Task');?>
 		<H2><?php echo __d('logged', 'add', true).' '.__d('logged', 'task', true);?></H2>

        <?php

        echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Task', 'update'=>'workAreaTeacher', 'indicator' => 'LoadingDiv2', 'url'=>array('controller'=> 'tasks', 'action'=>'add') ) ));

        echo $form->input('Task.title', array('value'=>'', 'label'=>__d('logged', 'title', true).': ', 'type'=>'text'));
        echo '<br />';
        echo $form->input('Task.description', array('value'=>'', 'label'=>__d('logged', 'description', true).': ', 'type'=>'textarea', 'rows'=>2));
        //echo $form->input('Task.value', array('value'=>0, 'label'=>'Value', 'type'=>'text'));
        //echo $form->input('Task.period', array('value'=>0, 'label'=>'Period', 'type'=>'text'));
        echo '<br />';
        echo $form->input('Task.type', array('label'=>__d('logged', 'type', true).': ', 'options' => array(
                                                            1=>__d('logged', 'task', true),
                                                            2=>__d('logged', 'exam', true),
                                                            3=>__d('logged', 'info', true),
                                                            4=>__d('logged', 'link', true),
                                                            5=>__d('logged', 'event', true)
                                                         )));
        echo '<br />';
        echo $form->input('Task.duedate', array('id'=>'datepicker', 'value'=> date('Y-m-d'), 'type'=>'text',  'label'=>__d('logged', 'duedate', true).': '));
        echo '<br />';
        echo $form->hidden('Task.schedule_id', array('value'=>$schedule));
        echo '<div id="opciones" class="lfloat">';
        echo '<h3 style="font-size:11px">'.$html->link(__d('logged', 'options', true),'#',array('escape'=>false)).'</h3>';

        echo '<ul><li>'.$form->input('Task.notifynow', array('value'=>'0', 'label'=>__d('logged', 'notify', true).' '.__d('pages', 'parents', true).' '.__d('logged', 'now', true), 'type'=>'checkbox'));
        echo '</li><li>'.$form->input('Task.reminder', array('value'=>'0', 'label'=>__d('logged', 'program', true).' '.__d('logged', 'reminder', true), 'type'=>'checkbox'));
        
        echo '</li></ul></div>';
        echo $ajax->accordion('opciones', array(
            'autoHeight' => false,
            'navigation' => true,
            'active'=>false,
            'collapsible'=>true));
        echo $form->End(__d('logged', 'add', true));

        echo $ajax->datepicker('datepicker', array(
                                    'minDate' => 0,
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
    //echo $form->end('Submit');
?>
    <?php
        echo $ajax->div('LoadingDiv2', array('style'=>'display:none; position:fixed; top: 2px; left: 180px; z-index:1000; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
        echo __d('logged', 'loading', true).', '.__d('logged', 'dontclosewindow', true);
        echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
        echo $ajax->divEnd('LoadingDiv2');
    ?>
</div>