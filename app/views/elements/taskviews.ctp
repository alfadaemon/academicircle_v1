<div id="views">
    <?php
        switch ($menuoptions[0]['GroupsUser']['group_id']){
        //Teachers
        case 3:
            echo __d('logged', 'change', true).' '.__d('logged', 'view', true).': ';
            echo $ajax->link(__d('logged', 'week',true), array('controller' =>'teachers','action' =>'mysections', $section, $subject, $week)
                                ,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
            echo $ajax->link(__d('logged', 'list',true), array('controller' =>'teachers','action' =>'listview', $section, $subject, $week)
                                ,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
        break;
        //Principal/Director
        case 2:
        //Parent
        case 4:
            echo __d('logged', 'change', true).' '.__d('logged', 'view', true).': ';
            echo $ajax->link(__d('logged', 'week',true), array('controller' =>'schedules','action' =>'usrview', $this->params['pass'][0] )
                                ,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
            echo $ajax->link(__d('logged', 'list',true), array('controller' =>'schedules','action' =>'listview', $this->params['pass'][0] )
                                ,array('update'=>'editAreaListView'
                                        ,'after'=>"$('#editAreaListView').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
        break;
        //Students
        case 5:
            echo __d('logged', 'change', true).' '.__d('logged', 'view', true).': ';
            echo $ajax->link(__d('logged', 'week',true), array( 'controller' =>'users','action' =>'myschedule')
                                ,array('update'=>'editAreaMySchool'
                                        ,'after'=>"$('#editAreaMySchool').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
//            echo $ajax->link(__d('logged', 'list',true), array( 'controller' =>'tasks','action' =>'listview')
//                                ,array('update'=>'editAreaMySchool'
//                                        ,'after'=>"$('#editAreaMySchool').show('slow')"
//                                        //,'complete'=> 'Element.hide(\'viewtask\')'
//                                        ,'indicator' => 'LoadingDiv'
//                                        ),null, false);
            if($gradebookenabled['School']['gradebook']==1){
            echo $ajax->link(__d('logged', 'gradebook',true), array( 'controller' =>'students','action' =>'gradebook')
                                ,array('update'=>'editAreaMySchool'
                                        ,'after'=>"$('#editAreaMySchool').show('slow')"
                                        //,'complete'=> 'Element.hide(\'viewtask\')'
                                        ,'indicator' => 'LoadingDiv'
                                        ),null, false);
            }
        break;
        default:
            echo "None";
        break;
        }
?>
</div>
<?php echo $ajax->buttonset('views');?>