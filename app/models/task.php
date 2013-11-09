<?php
class Task extends AppModel {

	var $name = 'Task';
	var $validate = array(
		'title' => array('notempty'),
		'description' => array('notempty'),
        //'duedate' => array('date'),
        'duedate' => array('rule' => 'date','message' => 'Enter a valid date', 'allowEmpty' => false),
		'user_id' => array('notempty'),
        'value' => array('numeric'),
        'period' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Schedule' => array(
			'className' => 'Schedule',
			'foreignKey' => 'schedule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>