<?php
echo $session->flash();
?>
<div id="sections" class="lfloat" style="padding-right:5px; width:155px">
    <?php
        echo '<h3 style="font-size:11px">'.$html->link(__d('logged', 'all', true),'#',array('escape'=>false)).'</h3>';
        echo '<ul><li style="font-size:9px">'.$ajax->link($html->image('calendar.png',array('alt'=>__d('logged','schedule',true), 'title'=>__d('logged','schedule',true)),false ).__d('logged','schedule',true).'s', array('controller' =>'teachers','action' =>'mysections' )
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											)).'</li></ul>';

        foreach($sections as $section){
            echo '<h3 style="font-size:11px">'.$html->link($section['Section']['name'].' - '.$section['Subject']['name'],'#',array('escape'=>false)).'</h3>';
            echo '<ul>';
            echo '<li style="font-size:9px">'.$ajax->link($html->image('calendar.png',array('alt'=>__d('logged','schedule',true), 'title'=>__d('logged','schedule',true)),false ).__d('logged','schedule',true).'s', array('controller' =>'teachers','action' =>'mysections',$section['Section']['id'],$section['Subject']['id'])
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ,'style'=>array('font-size'=>'1em','text-decoration'=>'none')
											));

            if($extramodules){
            echo '<li style="font-size:9px">'.$ajax->link($html->image('attendance.png',array('alt'=>__d('logged','attendance',true), 'title'=>__d('logged','attendance', true)),false ).__d('logged','attendance',true), array('controller' =>'teachers','action' =>'attendances', $section['Schedule']['id'], $section['Section']['id'])
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											)).'</li>';

//            echo '<li>'.$ajax->link($html->image('discipline.png',array('alt'=>__d('logged','attendance',true), 'title'=>__d('logged','discipline', true)),false ).__d('logged','discipline',true), array('controller' =>'attendances','action' =>'add', $section['Section']['id'])
//									,array('escape'=>false, 'update'=>'editAreaListView'
//                                            ,'after' => "$('#editAreaListView').slideDown()"
//                                            ,'indicator' => 'LoadingDiv'
//											),null, false).'</li></ul>';
            }
            
            if($gradebookenabled['School']['gradebook']==1){
            echo '<li style="font-size:9px">'.$ajax->link($html->image('attendance.png',array('alt'=>__d('logged','gradebook',true), 'title'=>__d('logged','gradebook', true)),false ).__d('logged','gradebook',true), array('controller' =>'teachers','action' =>'gradebooks', $section['Section']['id'], $section['Subject']['id'])
									,array('escape'=>false, 'update'=>'editAreaListView'
                                            ,'after' => "$('#editAreaListView').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
											)).'</li>';

//            echo '<li>'.$ajax->link($html->image('discipline.png',array('alt'=>__d('logged','attendance',true), 'title'=>__d('logged','discipline', true)),false ).__d('logged','discipline',true), array('controller' =>'attendances','action' =>'add', $section['Section']['id'])
//									,array('escape'=>false, 'update'=>'editAreaListView'
//                                            ,'after' => "$('#editAreaListView').slideDown()"
//                                            ,'indicator' => 'LoadingDiv'
//											),null, false).'</li></ul>';
            }
            echo '</ul>';
        }
    ?>
</div>
<?php
echo $ajax->accordion('sections', array(
            'autoHeight' => false,
            'navigation' => true));

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