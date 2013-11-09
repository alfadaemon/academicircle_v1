<?php
/**
 * File name: bysection.ctp
 * Project: academicircle
 * Creation: 10-13-2011
 *
 * @author lfaraya
 */

echo $session->flash();
?>
<div id="gradebookview">
    <?php
    $ajax->link(__d('logged','gradebook',true), array('controller' =>'gradebooks','action' =>'bygrade', $grade, $section)
									,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
    $ajax->link(__d('logged','gradebook',true), array('controller' =>'gradebooks','action' =>'bygrade', $grade, $section)
									,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
    ?>
</div>
<?php echo $ajax->buttonset('gradebookview');?>
<div style="width:110px">
<?
foreach($subjects as $subject):
    echo $ajax->link($subject['Subject']['name'], array('controller' =>'gradebooks','action' =>'bysubject', $subject['Subject']['id'], $section)
									,array('escape'=>false, 'update'=>'studentsDiv'
                                            ,'before' => "$('#studentsDiv').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ,'id'=>'update'.$subject['Subject']['id']
                                            ,'style'=>'width:100%; float:left'
											));
          echo $ajax->button('update'.$subject['Subject']['id'], array(
            'icons' => array(
                'primary' => 'ui-icon-triangle-1-e'
                )
            ));

endforeach;
?>
</div>
<?php
echo $ajax->div('studentsDiv');
echo $ajax->divEnd('studentsDiv')
?>