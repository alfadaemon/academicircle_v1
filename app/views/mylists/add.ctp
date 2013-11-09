<?php echo $session->flash(); ?>
<table style="border: 0px;">
    <tr valign="top">
        <td style="border: 0px;">
<div id="lists" style="float:left">
    <h4>1.- <?php echo __d('logged', 'create', true).' '.__d('logged','list',true);?></h4>
<?php

echo $ajax->div('newlist', array('class'=>'thread'));
echo $ajax->form( array('type'=>'post', 'options' => array('model'=>'Mylist', 'update'=>'editAreaMyLists', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'mylists', 'action'=>'add') ) ));
echo $form->input('name', array('label'=>false, 'size'=>'10'));
echo $form->end(__d('logged', 'create', true));
echo $ajax->divEnd('newlist');
?>
    <h4><?php echo __d('logged', 'list').'s';?></h4>
<?php
foreach($lists as $list){
    //echo print_r($list).'<br /><br />';
    ?>
    <div id="list<?php echo $list['Mylist']['id'];?>" class="thread">
        <div id="remove" style="float:left; display:block; width:5%">
        <?php
            echo $ajax->link($html->image("delete.png", array('title'=>__d('logged', 'delete', true).' '.__d('logged','list', true), 'alt'=>__d('logged', 'delete', true) ) ), array('controller'=>'mylists', 'action'=>'delete', $list['Mylist']['id']), array('escape'=>false, 'update' => 'editAreaMyLists', 'indicator' => 'LoadingDiv', /* 'complete' => 'Effect.Hide(\'list'.$list['Mylist']['id'].'\')', */'url'=>array('controller'=>'mylists', 'action'=>'delete', $list['Mylist']['id'])),__d('logged', 'delete', true).' '.$list['Mylist']['name'].'?', false);
        ?>
        </div>
        <div style="width:50%; display:block; float:left">
        <?php
            echo $list['Mylist']['name'];
        ?>
        </div>
    </div>
<?php
}
?>
</div>
        </td>
        <td style="border: 0px;">
<div id="listbox" style="float:left; padding-left: 10px;">
    <h4>2.- <?php echo __d('logged', 'manage',true).' '.__d('logged', 'member', true).'s'; ?></h4>
<?php
   //echo __('Select one list to manage:');
   echo $form->input('ListMembers.mylist_id', array('label'=>false, 'options'=>$mylists, 'empty'=>true) );
   $opciones = array (
        'update'=>'members',
        'indicator' => 'LoadingDiv',
        'after' => "$('#editAreaMyLists').show('slow')",
        'url' => array('controller'=>'list_members','action'=>'members')
    );
   print $ajax->observeField('ListMembersMylistId', $opciones);
?>
<div id="members">
&nbsp;
</div>
</div>
        </td>
    </tr>
</table>
