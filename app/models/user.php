<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'username' => array('email'),
		'group_id' => array('numeric'),
		'fname' => array('notempty'),
		'flname' => array('notempty'),
		'password' => array('notempty'),
		'nickname' => array('alphanumeric'),
		//'altemail' => array('email'),
		'language' => array('notempty'),
		'theme_id' => array('numeric')
	);
	var $displayField = 'username';

    //Added later
    var $actsAs = array( 'CustomAcl'=>'requester' );

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
        'Group' =>
            array(
                'className'             => 'Group',
                'joinTable'             => 'groups_users',
                'foreignKey'            => 'user_id',
                'associationForeignKey' => 'group_id',
                'uniq'                  => true,
            )
    	);

	var $belongsTo = array(
		'Theme' => array(
			'className' => 'Theme',
			'foreignKey' => 'theme_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'School' => array(
            'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
        )
	);

	var $hasMany = array(
		'Ancestor' => array(
			'className' => 'Ancestor',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ListMember' => array(
			'className' => 'ListMember',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Mylist' => array(
			'className' => 'Mylist',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Teacher' => array(
			'className' => 'Teacher',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	function checkUnique($data, $fieldName) {
	        $valid = false;
	        if(isset($fieldName) && $this->hasField($fieldName)){
	            $valid = $this->isUnique(array($fieldName => $data));
	        }
	        return $valid;
	}
 
	function parentNode() {
		if (!$this->id) {
        	    return null;
        	}
        	$data = $this->read();
        	$aroArray = array();
        	if (!$data['Group']){
        	    return null;
        	} else {
			foreach($data['Group'] as $key){
        	        	$aroArray[] = array('model' => 'Group', 'foreign_key' => $key['id']);
			}
			return $aroArray;
        	}
	}

	function validLogin($data){
		$user = $this->find(array('username' => $data['User']['username'], 'password' => ($data['User']['password']), 'active'=>1), array('id','username', 'password', 'school_id'));
        	if(!empty($user)){
            	$this->user = $user['User'];
            	return TRUE;
        	}
        	else{
                return FALSE;
        	}
    	}

}
?>
