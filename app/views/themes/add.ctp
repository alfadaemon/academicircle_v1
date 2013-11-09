<div class="themes form">
<?php echo $form->create('Theme');?>
	<fieldset>
 		<legend><?php __('Add Theme');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Themes', true), array('action' => 'index'));?></li>
	</ul>
</div>
