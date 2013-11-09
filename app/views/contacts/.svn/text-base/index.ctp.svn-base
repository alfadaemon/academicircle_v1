<?php
    echo $form->create('Contact', array('url' => array('controller'=>'contacts', 'action'=>'index')));
    echo $form->input('name',array('label'=>__('Name: ', true)));
    echo $form->input('email',array('label'=>__('Email: ', true)));
    echo $form->input('phone',array('label'=>__('Phone: ', true)));
    echo $form->input('details',array('label'=>__('Details: ', true)));
    echo $form->input('security_code', array('label' =>__('Please Enter the Result of: ') . $mathCaptcha));
    echo $form->end(array('name' => 'Send', 'class' => 'input_btn'));
?>
