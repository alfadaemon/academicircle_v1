<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
</script>

<div style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 5px; margin:auto 100px;">
    <?
        echo $ajax->div('LoadingDiv2', array('style'=>'display:none; position:fixed; z-index:10001; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
        echo __d('logged', 'loading', true);
        echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
        echo $ajax->divEnd('LoadingDiv2');
    ?>
    <div id="closethis" class="rfloat">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewtasklist2', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeviewtasklist2', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
    </div>
    <?php
        echo $ajax->form( array('type'=>'post', 'options' => array('Model'=>'Task', 'update'=>'workAreaTeacher', 'indicator' => 'LoadingDiv2', 'url'=>array('controller'=> 'tasks', 'action'=>'viewall',$scheduleinfo['Schedule']['id']) ) ));
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
<h4><?php echo __d('logged', 'task', true).'s';?>: <?php echo $scheduleinfo['Section']['name'].' - '.$scheduleinfo['Subject']['name']; ?></h4>
<div class="scroll-pane">
<table cellpadding="0" cellspacing="0" style="width:100%; padding: 5px 5px 20px 5px">
<?php
$i = 0;
foreach ($tasks as $task):
?>
	<tr>
		<td class="calendar-day">
			<strong><?php echo __d('logged', 'title',true);?>: </strong><?php echo $task['Task']['title']; ?>
		</td>
		<td class="calendar-day">
            <?php
                echo $ajax->link($html->image("delete.png", array('style'=>'float:right;', 'title'=>__d('logged', 'delete', true), 'alt'=>__d('logged', 'delete', true)) ), array( 'controller' =>'tasks','action' =>'delete', $task['Task']['id'] )
									,array('escape'=>false, 'update'=>'workAreaTeacher', 'indicator' => 'LoadingDiv2','url'=>array('controller'=>'tasks', 'action'=>'delete', $task['Task']['id'],$scheduleinfo['Schedule']['id'])),__d('logged', 'delete', true).' '.__d('logged', 'task', true).'?', false);
            ?>
			<strong><?php echo __d('logged', 'duedate',true);?>: </strong><?php echo $task['Task']['duedate']; ?>
		</td>
    </tr>
    <tr>
		<td colspan="2" class="calendar-day" style="border-bottom: 2px solid #000">
			<?php echo $task['Task']['description']; ?>
		</td>
    </tr>
    <!--tr>
        <!--td>
			<?php //echo $task['Task']['value']; ?>
		</td>
        <td>
			<?php //echo $task['Task']['period']; ?>
		</td -->
		<!-- td class="actions">
            <?php
            if( ($task['Task']['period']!=0) && $task['Task']['value']!=0 )
                echo $ajax->link(__('Gradebook', true), array( 'controller' =>'gradebooks','action' =>'add', $task['Task']['schedule_id'], $task['Task']['id'] )
									,array('update'=>'Overlay'
											,'complete' => 'Effect.BlindDown(\'Overlay\')'
											//,'complete'=> 'Element.hide(\'viewtask\')'
                                            ,'indicator' => 'LoadingDiv'
											),null, false);
            ?>
		</td>
	</tr -->
<?php endforeach; ?>
</table>
</div>
<div id="closethis2" class="actions">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewtasklist', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeviewtasklist', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
</div>
</div>