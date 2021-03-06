<div id="spinner" style="display: none; float: right;">
    <?php echo $html->image('/img/loading.gif'); ?>
</div>
<div style="clear:both;">
    <h4>3.- <?php echo __d('logged', 'add',true).' '.__d('logged', 'member', true); ?></h4>
    <?php
        echo $form->input('ListMember.query', array('label'=>false, 'type'=>'text'));
    ?>
</div>
<div id="searchbox">
    <?php echo __d('logged', 'enternametosearch', true); ?>
</div>
<?php
if(!empty($members)){
?>
<h4><?php echo __d('logged', 'membersinlist', true); ?></h4>
<?php
foreach($members as $member){
    echo $ajax->div('member'.$member['User']['id'], array('class'=>'thread'));
?>
    <div id="remove" style="float:left; display:block; width:5%">
    <?php
        echo $ajax->link($html->image("delete.png", array('title'=>__d('logged', 'delete', true), 'alt'=>__d('logged', 'delete', true)) ), array('controller'=>'list_members', 'action'=>'delete', $member['ListMember']['id']),
                                        array('escape'=>false, 'update' => 'member'.$member['User']['id'], 'indicator' => 'LoadingDiv', /*'after' => "$('#member".$member['User']['id']."').toggle()",*/'url'=>array('controller'=>'list_members', 'action'=>'delete', $member['ListMember']['id'])),__d('logged', 'delete', true).'?', false);
    ?>
    </div>
    <div style="width:90%; display:block; float:left">
    <?php
        echo $member['User']['fname'].' '.$member['User']['sname'].' '.$member['User']['flname']; //.' (' .$member['User']['username'].')';
    ?>
    </div>
    <?php
        echo $ajax->divEnd('member'.$member['User']['id']);
    }
}

$options = array(
	'update' => 'searchbox',
	//'url'    => '/list_members/search/'.$list_id,
     'url' => array('controller'=>'list_members','action'=>'search',$list_id),
	//'frequency' => 2,
        //'loading' => "Element.hide('searchbox');Element.show('spinner')",
	//'complete' => "Element.hide('spinner');Effect.Appear('searchbox')"
	'indicator' => 'spinner',
	'after' => "$('#searchbox').show('slow')",
);

echo $ajax->observeField('ListMemberQuery', $options);
?>