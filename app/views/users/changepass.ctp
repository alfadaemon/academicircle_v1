<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo $ajax->form(array('type'=>'post', 'options'=>array('update'=>'changepass', 'indicator' => 'LoadingDiv', 'after'=>"$('#changepass').show('slow')", 'url'=>array('controller'=>'Users', 'action'=>'changepass'))));
echo $form->input( __d('logged', 'new', true).': ', array('name'=>'data[newpass]', 'type'=>'password'));
echo $form->input( __d('logged', 'confirm', true).': ', array('name'=>'data[confirmpass]', 'type'=>'password'));
echo $form->End(__d('logged', 'change', true) );
?>
