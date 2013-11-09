<div style="filter: alpha(opacity=100);opacity: 1; background-color:#FFF;padding:40px; margin:auto 100px;" class="tasks view">
<div class="gradebooks form">
<?php echo $form->create('Gradebook');?>
	<fieldset>
 		<legend><?php __('Add Gradebook');?></legend>
	<?php
		echo $form->input('task_id');
		echo $form->input('student_id');
		echo $form->input('score');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
    <ul>
        <li>
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__('Close',true), array( '#' ), array('id'=>'closeviewtask', 'complete' => 'Effect.BlindUp(\'Overlay\')'));
        ?>
        </li>
    </ul>
</div>
</div>