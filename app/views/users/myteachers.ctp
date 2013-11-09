<div class="lfloat">
<?php
foreach ($teachers as $teacher):?>
<div style="clear:none; width:300px;" class="thread">
    <div style="width:80%; display:block; float:left">
    <?php
                echo $teacher['User']['fname'].' '.$teacher['User']['flname'].' - '.$teacher['User']['username'];
    ?>
    </div>
    <div id="remove" style="float:left; display:block; width:5%; padding-right:5px;">
    <?php
                echo $ajax->link($html->image("comment.png", array('title'=> __d('logged', 'view', true ).' '.__d('logged', 'comment', true) ) )
                                    , array('controller' =>'posts','action' =>'listview', $teacher['User']['id'] )
                                    ,array('escape'=>false, 'update'=>'editAreaMyTeachers'
											,'after' =>"$('#editAreaMyTeachers').slideDown()();" // ' Effect.SlideDown(\'editArea\')'
                                            ,'indicator' => 'LoadingDiv'),null, false);
    ?>
    </div>
    <div id="remove" style="float:left; display:block; width:5%; padding-right:5px;">
    <?php
                echo $ajax->link($html->image("tasks.png", array('title'=> __d('logged', 'view', true ).' '.__d('logged', 'task', true) ) )
                                    , array('controller' =>'tasks','action' =>'viewlist', $teacher['User']['id'] )
                                    ,array('escape'=>false, 'update'=>'editAreaMyTeachers'
											,'after' => "$('#editAreaMyTeachers').slideDown()();"
                                            ,'indicator' => 'LoadingDiv'),null, false);
    ?>
    </div>
</div>
<div style="clear:both;">
    
</div>
<?php endforeach; ?>
</div>
<?php
    echo $ajax->div('editAreaMyTeachers', array('class'=>'rfloat'));
    echo "&nbsp";
    echo $ajax->divEnd('editAreaMyTeachers');

    echo $ajax->div('OverlayMyTeacher', array('style'=>'clear:both; z-index:1010; position:fixed; top: 0px; widht:100%'));
    echo "&nbsp";
    echo $ajax->divEnd('OverlayMyTeacher');
?>