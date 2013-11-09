<?php
    echo $session->flash();
?>
<!-- div class="right" id="editAreaListView">
    &nbsp;
</div -->
<div id="sections" class="lfloat" style="padding-right:5px; width:140px">
<?php
    foreach ($section as $sect):
        echo '<h3 style="font-size:11px">'.$html->link($sect['Section']['name'],'#',array('escape'=>false)).'</h3>';

        echo '<ul>';
            echo '<li style="font-size:9px">'.$ajax->link($html->image('calendar.png',array('alt'=>__d('logged','schedule',true), 'title'=>__d('logged','schedule',true)),false ).__d('logged', 'schedule', true), array( 'controller' =>'schedules','action' =>'listview', $sect['Section']['id'] )
                         ,array('escape'=>false, 'update'=>'editAreaListView',
                                'after'=>"$('#editAreaListView').show('slow')",
                                'indicator' => 'LoadingDiv'
                                )).'</li>';
            if($extramodules){
                echo '<li style="font-size:9px">'.$ajax->link($html->image('attendance.png',array('alt'=>__d('logged','attendance',true), 'title'=>__d('logged','attendance', true)),false ).__d('logged', 'attendance', true), array( 'controller' =>'attendances','action' =>'viewsectionhistory', $sect['Section']['id'] )
                         ,array('escape'=>false, 'update'=>'editAreaListView',
                                'after'=>"$('#editAreaListView').show('slow')",
                                'indicator' => 'LoadingDiv'
                                )).'</li>';
            }
            
            if($gradebookenabled['School']['gradebook']==1){
            echo '<li style="font-size:9px">'.$ajax->link($html->image('attendance.png',array('alt'=>__d('logged','gradebook',true), 'title'=>__d('logged','gradebook', true)),false ).__d('logged','gradebook',true), array('controller' =>'gradebooks','action' =>'bygrade', $sect['Grade']['id'], $sect['Section']['id'])
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											)).'</li>';
            }
        echo '</ul>';
    endforeach;
    ?>
</div>
<?php
    echo $ajax->accordion('sections', array(
            'autoHeight' => false,
            'navigation' => true));
?>
<?php

echo $ajax->div('editAreaListView', array('class'=>'lfloat', 'style'=>'width:600px; min-height:300px; display:block;'));
echo "&nbsp";
echo $ajax->divEnd('editAreaListView');

echo $ajax->div('workAreaTeacher', array('style'=>'position:fixed; top: 0px; widht:100%'));
echo "&nbsp";
echo $ajax->divEnd('workAreaTeacher');

echo $ajax->div('workAreaPs', array('style'=>'position:fixed; top: 0px; widht:100%'));
echo "&nbsp";
echo $ajax->divEnd('workAreaPs');

?>
