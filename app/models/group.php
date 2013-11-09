<?php
class Group extends AppModel {

	var $name = 'Group';
	var $validate = array(
		'name' => array('notempty')
	);
	var $displayField = 'name';
	
	var $actsAs = array( 'CustomAcl'=>'requester','Acl' => 'requester' );

    	var $hasAndBelongsToMany = array(
        	'User' => array(
        	    'className'             => 'User',
        	    'joinTable'             => 'groups_users',
        	    'foreignKey'            => 'group_id',
        	    'associationForeignKey' => 'user_id',
        	    'uniq'                  => true,
        	)
    	);
 
	function parentNode() {
    		return null;
	}

}
?>
