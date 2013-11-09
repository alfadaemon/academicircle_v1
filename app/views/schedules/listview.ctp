<div id="workAreaListView">
<div>
<h3><?php
    echo __d('logged', 'schedule', true).': '.$sectionName;
?></h3>
<?php
echo $this->element("taskviews");
?>
<div class="lfloat">
<table style="clear: both; border: solid 1px #a2a2a2; max-width:400px">
    <tr>
        <th colspan="3">
        <?php
            echo __d('logged', 'week', true).': '.date('d/m/Y', strtotime($start)).' - '.date('d/m/Y', strtotime($end));
//            echo $html->link(__d('logged', 'print', true), array('controller'=>'schedules', 'view'=>'print'),array('id'=>'printlistview', 'target'=>'_blank'));
//            echo $ajax->button('printlistview', array(
//            'icons' => array(
//                'primary' => 'ui-icon-print'
//                ),
//                'text'=>false
//            ));
        ?>
        </th>
    </tr>
  <tr>
	<th>
    <?php
        echo $ajax->link(__d('logged', 'previous', true).' '.__d('logged', 'week', true),
                array('controller'=>'schedules', 'action'=>'listview', $seccion, $week-1, $view),
                array('id'=>'previous', 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"));
        echo $ajax->button('previous', array(
            'icons' => array(
                'primary' => 'ui-icon-seek-prev'
                )
            ));
    ?>
    </th>
    <th>
    <?php
        echo $ajax->link(__d('logged', 'next', true).' '.__d('logged', 'week', true),
                array('controller'=>'schedules', 'action'=>'listview', $seccion, $week+1, $view),
                array('id'=>'next', 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"));
        echo $ajax->button('next', array(
            'icons' => array(
                'secondary' => 'ui-icon-seek-next'
                )
            ));
    ?>
    </th>
	<th>
    <?php
        $selected = ($view==1 ?'selected':'view1');
        echo $ajax->link($html->image('new.png',array('title'=>__d('logged','task', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 1),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);
        $selected = ($view==2 ?'selected':'view2');
        echo $ajax->link($html->image('script_edit.png',array('title'=>__d('logged','exam', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 2),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);
        $selected = ($view==3 ?'selected':'view3');
        echo $ajax->link($html->image('exclamation.png',array('title'=>__d('logged','info', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 3),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);
        $selected = ($view==4 ?'selected':'view4');
        echo $ajax->link($html->image('link.png',array('title'=>__d('logged','link', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 4),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);

        $selected = ($view==5 ?'selected':'view5');
        echo $ajax->link($html->image('pictures.png',array('title'=>__d('logged','event', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 5),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);

        $selected = ($view==0 ?'selected':'view0');
        echo $ajax->link($html->image('star.png',array('title'=>__d('logged','all', true),false )), array('controller'=>'schedules', 'action'=>'listview', $seccion, $week, 0),
                array('escape'=>false, 'id'=>$selected, 'update' => 'editAreaListView', 'indicator' => 'LoadingDiv', 'after'=>"$('#editAreaListView').show('slow')"),null, false);
    ?>
    </th>
  </tr>
    <?php
        if(empty($section)){
    ?>
    <tr style="background-color: #FFF; border: 1px solid #AAA; color: #33557B;">
      <td colspan=3 >
          <div class="schedule">
              <div class="task">
                  <?php echo __d('logged', 'hurrayNoTaskHere', true); ?>
              </div>
          </div>
      </td>
    </tr>
	<?php
        }
        else{
            ?>
    <tr style="background-color: #FFF; border: 1px solid #AAA; color: #33557B;">
              <td colspan=3 >
                  <div id="tasklist">
                  <?php
                    foreach($section as $task):
                  ?>
                  
                              <h3>
                                  <?php
                                    //echo $html->link($task['Schedule']['Subject']['name'],'#'.$task['Task']['id']);
                                  
                                    switch($task['Task']['type']){
                                        case 1:
                                            echo $html->link($html->image('new.png',array('align'=>'top', 'title'=>__d('logged','task', true),false )).' <strong>'.$task['Schedule']['Subject']['name'].'</strong>  '.$task['Task']['duedate'],'#',array('escape'=>false));
                                        break;
                                        case 2:
                                            echo $html->link($html->image('script_edit.png',array('align'=>'top','title'=>__d('logged','exam', true),false )).' <strong>'.$task['Schedule']['Subject']['name'].'</strong>  '.$task['Task']['duedate'],'#',array('escape'=>false));
                                        break;
                                        case 3:
                                            echo $html->link($html->image('exclamation.png',array('align'=>'top','title'=>__d('logged','info', true),false )).' <strong>'.$task['Schedule']['Subject']['name'].'</strong>  '.$task['Task']['duedate'],'#',array('escape'=>false));
                                        break;
                                        case 4:
                                            echo $html->link($html->image('star.png',array('align'=>'top','title'=>__d('logged','link', true),false )).' <strong>'.$task['Schedule']['Subject']['name'].'</strong>  '.$task['Task']['duedate'],'#',array('escape'=>false));
                                        break;
                                        case 5:
                                            echo $html->link($html->image('pictures.png',array('align'=>'top','title'=>__d('logged','event', true),false )).' <strong>'.$task['Schedule']['Subject']['name'].'</strong>  '.$task['Task']['duedate'],'#',array('escape'=>false));
                                        break;
                                    }
                                  ?>
                              </h3>
                              <div>
                                  <?php
                                  if($menuoptions[0]['GroupsUser']['group_id']==2 || $menuoptions[0]['GroupsUser']['group_id']==3){

                                  ?>
                                  <div style="float: right; padding:0px; margin:0px; align:top;">
                                      <?php
                                        if($task['Task']['sent']){
                                            echo $html->link($html->image('email_go.png',array('align'=>'top','title'=>__d('logged','sent', true),false )),'#',array('escape'=>false));
                                        }
                                        else{
                                            echo $html->link($html->image('email_add.png',array('align'=>'top','title'=>__d('logged','notify', true),false )),'#',array('escape'=>false));
                                        }
                                      ?>
                                  </div>
                                  <div style="float: right; padding:0px; margin:0px; align:top;">
                                      <?php
                                        if($task['Task']['reminded']){
                                            echo $html->link($html->image('date_go.png',array('align'=>'top','title'=>__d('logged','reminded', true),false )),'#',array('escape'=>false));
                                        }
                                        else{
                                            echo $html->link($html->image('date_add.png',array('align'=>'top','title'=>__d('logged','remind', true),false )),'#',array('escape'=>false));
                                        }
                                      ?>
                                  </div>
                                  <div style="float: right; padding:0px; margin:0px; align:top;">
                                      <?php
                                      if($week>=0)
                                        echo $ajax->link($html->image("delete.png", array('style'=>'float:right;', 'title'=>__d('logged', 'delete', true), 'alt'=>__d('logged', 'delete', true)) ), array( 'controller' =>'tasks','action' =>'delete', $task['Task']['id'] )
                                                            ,array('escape'=>false, 'update'=>'editAreaListView', 'indicator' => 'LoadingDiv2','url'=>array('controller'=>'tasks', 'action'=>'deletep', $task['Task']['id'],$seccion, $week)),__d('logged', 'delete', true).' '.__d('logged', 'task', true).'?', false);
                                        ?>
                                  </div>
                                  <?php } ?>
                                <?php
                                    if($view==4){
                                        $url = '';
                                        $url = (stripos($url,"http")===0) ? "http://".$task['Task']['title'] : $task['Task']['title'];
                                        echo $html->link($task['Task']['title'], $url,array('class'=>'button','target'=>'_blank'));
                                    }
                                    else{
                                        echo '<strong>'.__d('logged', 'duedate', true).':</strong> '.$task['Task']['duedate'];
                                        echo '<br /><strong>'.__d('logged', 'title', true).':</strong> '
                                        ?>
                                        <div style="max-width:200px" id="tasktitle<?php echo $task['Task']['id'];?>"><?php echo $task['Task']['title']; ?></div>
                                        <?php
                                        if($menuoptions[0]['GroupsUser']['group_id']==2 || $menuoptions[0]['GroupsUser']['group_id']==3){
                                            echo $ajax->editor( "tasktitle".$task['Task']['id'],
                                                array(
                                                    'controller' => 'tasks',
                                                    'action' => 'updatetitle'
                                                ),
                                                array(
                                                    'indicator' => '<img src="../img/loading.gif">',
                                                    'submit' => __d('logged', 'change',true),
                                                    'style' => 'inherit',
                                                    'submitdata' => array('id'=> $task['Task']['id']),
                                                    'tooltip'   => __d('logged', 'click2edit', true)
                                                    )
                                                );
                                        }
                                    }
                                    echo '<br /><strong>'.__d('logged', 'description', true).':</strong> ';
                                    ?>
                                    <div style="max-width:200px" id="taskdescrip<?php echo $task['Task']['id'];?>"><?php echo $task['Task']['description']; ?></div>
                                    <?php
                                    if($menuoptions[0]['GroupsUser']['group_id']==2 || $menuoptions[0]['GroupsUser']['group_id']==3){
                                            echo $ajax->editor( "taskdescrip".$task['Task']['id'],
                                                array(
                                                    'controller' => 'tasks',
                                                    'action' => 'updatedescription'
                                                ),
                                                array(
                                                    'indicator' => '<img src="../img/loading.gif">',
                                                    'submit' => __d('logged', 'change',true),
                                                    'style' => 'inherit',
                                                    'submitdata' => array('id'=> $task['Task']['id']),
                                                    'tooltip'   => __d('logged', 'click2edit', true)
                                                    )
                                                );
                                        }

                                ?>
                              </div>
                    <?php endforeach;
        }
    ?>
                  </div>
                  <?php
                     if($view!=4)
                        echo $ajax->accordion('tasklist', array(
                                    'autoHeight' => false,
                                    'navigation' => true));
                  ?>
            </td>
    </tr>
 </table>
</div>
</div>
</div>
<br /><br />
<div style="text-transform:capitalize;clear:both;">
<?php
if(!empty($section)){
    if( ($menuoptions[0]['GroupsUser']['group_id']==2) ){
        if(!$enviado){
            if($week>=0){
                    echo $ajax->form( array('type'=>'post', 'options' => array('Model'=>'Schedule', 'update'=>'editAreaListView', 'indicator' => 'LoadingDiv', 'url'=>array('controller'=> 'schedules', 'action'=>'notifyParents', $seccion, $week) ) ));
                    echo $form->input('Task.reminder', array( 'id'=>'reminder', 'value'=>'', 'label'=>__d('logged', 'reminder', true), 'type'=>'checkbox'));
                    echo $form->button(__d('logged', 'send', true).' '.__d('logged', 'summary', true).' '.__d('pages', 'parents', true), array('id'=>'notify'));

                    echo $ajax->button('notify', array(
                        'icons' => array(
                            'secondary' => 'ui-icon-mail-closed'
                            )
                        ));
                    echo $form->End();
            }
        }
    }
}
?>    
</div>