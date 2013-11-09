<?php
/**
 * File name: joomlalogin.ctp
 * Project: academicircle
 * Creation: Jun 17, 2011
 *
 * @author lfaraya
 */
?>
<div style="width:100px; height:100px; color:#0B4F85; font:10px/1.8em Arial,Helvetica,sans-serif">
<?php
echo $session->flash('auth');
echo $form->create('User', array('controller'=>'users', 'action' => 'login', 'target'=>'_parent'));
echo $form->input('username',array('label'=>__d('pages', 'user', true).': '));
echo $form->input('password',array('label'=>__d('pages', 'password', true).': '));
echo $form->end(__d('pages', 'login', true), array('class'=>'button'));

echo $html->link(__d('pages', 'recoverpass', true), array('controller'=>'pages','action'=>'recover'), array( 'style'=>'color:#0B4F85; text-decoration: none;font:9px/1.8em Arial,Helvetica,sans-serif', 'target'=>'_parent'));
?>
</div>
