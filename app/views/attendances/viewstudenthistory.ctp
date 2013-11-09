<?php
/**
 * File name: viewstudenthistory.ctp
 * Project: academicircle
 * Creation: Mar 20, 2011
 *
 * @author lfaraya
 */

$paginator->options(array(
    'update' => '#workAreaTeacher',
    'indicator'=> 'LoadingDiv',
    'evalScripts' => true
));
?>
<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
</script>
<div id="newTask" style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 10px; margin:auto 100px;">
    <?
        echo $ajax->div('LoadingDiv2', array('style'=>'display:none; position:fixed; z-index:10001; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
        echo __d('logged', 'loading', true);
        echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
        echo $ajax->divEnd('LoadingDiv2');
    ?>
    <div id="closethis" class="rfloat">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewatt2', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeviewatt2', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
    </div>
    <?php
        echo $ajax->form( array('type'=>'post', 'options' => array('Model'=>'Attendance', 'update'=>'workAreaTeacher', 'indicator' => 'LoadingDiv2', 'url'=>array('controller'=> 'attendances', 'action'=>'viewstudenthistory',$student) ) ));
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
    <div class="attendances index">
	<h2><?php echo __d('logged', 'attendance', true);?></h2>
    <div class="scroll-pane">
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort(__d('logged', 'date', true), 'adate');?></th>
			<th><?php echo $this->Paginator->sort(__d('logged', 'comment', true),'comment');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($attendances as $attendance):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $attendance['Attendance']['adate']; ?>&nbsp;</td>
		<td><?php echo $attendance['Attendance']['comment']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
    </div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __d('logged', 'previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__d('logged', 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
    <div id="closethis" class="actions">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewatt', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeviewatt', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
    </div>
</div>
<?php echo $js->writeBuffer(); ?>