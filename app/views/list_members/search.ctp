<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ((isset($users)) && (!empty($users)) ) {
	foreach ($users as $user){
                echo $ajax->div('newmember'.$user['u']['id'], array('class'=>'thread'));
?>
<div id="add" style="float:left; display:block; width:5%">
<?php
    echo $ajax->link($html->image("add.png", array('title'=>__d('logged', 'add', true), 'alt'=> __d('logged', 'add', true) ) ), array('controller'=>'list_members', 'action'=>'add', $list_id, $user['u']['id']),
                                    array('escape'=>false, 'update' => 'members', 'indicator' => 'spinner','after' => "$('#newmember".$user['u']['id']."').toggle()", 'url'=>array('controller'=>'list_members', 'action'=>'add', $list_id, $user['u']['id'])),null, false);
?>
</div>
<div style="width:90%; display:block; float:left">
<?php
	echo $user['u']['fname'].' '.$user['u']['sname'].' '.$user['u']['flname'];//.' (' .$user['u']['username'].')';
?>
</div>
<?php
        echo $ajax->divEnd('newmember'.$user['u']['id']);
        }
}
else{
    echo __d('logged', 'noserultssearch', true);
}
?>
