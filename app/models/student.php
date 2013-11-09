<?php
class Student extends AppModel {

	var $name = 'Student';
	var $validate = array(
		'user_id' => array('numeric'),
		'section_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => array('id', 'username', 'fname', 'sname', 'flname', 'slname', 'school_id'),
			'order' => '',
            'displayField'=>'username'
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    var $hasMany = array(
		'Gradebook' => array(
			'className' => 'Gradebook',
			'foreignKey' => 'student_id',
			'dependent' => false,
			'conditions' =>'',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
?>