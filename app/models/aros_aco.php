<?php
class ArosAco extends AppModel {

	var $name = 'ArosAco';
	var $validate = array(
		'aro_id' => array('numeric'),
		'aco_id' => array('numeric'),
		'_create' => array('notempty'),
		'_read' => array('notempty'),
		'_update' => array('notempty'),
		'_delete' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Aro' => array(
			'className' => 'Aro',
			'foreignKey' => 'aro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Aco' => array(
			'className' => 'Aco',
			'foreignKey' => 'aco_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>