<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Contact extends AppModel {
    var $name = 'Contact';

    var $validate = array(
    'name' => 'notempty',
    'email' => array(
        'rule'=>'email',
        'message'=>'Must be a valid email address' ),
    'details' => 'notempty'
    );
}
?>
