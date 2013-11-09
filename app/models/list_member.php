<?php
class ListMember extends AppModel {

	var $name = 'ListMember';
	var $validate = array(
		'mylist_id' => array('notempty'),
		'user_id' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Mylist' => array(
			'className' => 'Mylist',
			'foreignKey' => 'mylist_id',
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