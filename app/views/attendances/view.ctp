<div id="newTask" style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 10px; margin:auto 100px;">
<div class="attendances view">
<h2><?php  echo __d('logged', 'attendance', true);?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('logged', 'date', true); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attendance['Attendance']['adate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __d('logged', 'comment', true); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attendance['Attendance']['comment']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
    <div id="closethis" class="actions">
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewatt', 'indicator' => 'LoadingDiv', 'after' =>"$('#workAreaTeacher').slideUp()"));
            echo $ajax->button('closeviewatt', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
    </div>
</div>
