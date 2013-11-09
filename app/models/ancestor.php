<?php
class Ancestor extends AppModel {

	var $name = 'Ancestor';
	var $validate = array(
		'user_id' => array('numeric'),
		'student_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => array('id', 'username', 'fname', 'sname', 'flname', 'slname'),
			'order' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);
}
?>