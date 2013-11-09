<div class="teachers form">
<?php echo $form->create('Teacher');?>
	<fieldset>
 		<legend><?php __('Add Teacher');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('matter_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Teachers', true), array('action' => 'index'));?></li>
	</ul>
</div>
