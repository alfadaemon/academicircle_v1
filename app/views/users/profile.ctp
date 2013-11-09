<div class="lfloat">
<div id="lists" class="thread" style="padding-bottom:10px;">
    <h4><?php echo __d('logged', 'change', true).' '.__d('pages', 'password', true); ?></h4>
    <div id="changepass">
<?php
    //echo $session->flash();
    echo $ajax->form(array('type'=>'post', 'options'=>array('update'=>'changepass', 'indicator' => 'LoadingDiv', 'after'=>"$('#changepass').show('slow')", 'url'=>array('controller'=>'Users', 'action'=>'changepass'))));
    echo $form->input( __d('logged', 'new', true).': ', array('name'=>'data[newpass]', 'type'=>'password'));
    echo $form->input( __d('logged', 'confirm', true).': ', array('name'=>'data[confirmpass]', 'type'=>'password'));
    echo $form->End(__d('logged', 'change', true) );
?>
    </div>
</div>
</div>
<div class="rfloat">
<div id="lists" class="thread" style="padding-bottom:10px;">
    <div id="changelang">
    <h4><?php echo __d('logged', 'change', true).' '.__d('logged', 'language', true); ?></h4>
<?php
    echo $ajax->form(array('type'=>'post','options'=>array('update'=>'changelang', 'indicator' => 'LoadingDiv', 'after'=>"$('#changelang').show('slow')", 'style'=>'float:left',  'url'=>array('controller'=>'Users', 'action'=>'changelang'))));
    echo $form->input('lang', array('options' => array(
                                                    'en'=>'English',
                                                    'es'=>'Español'
                                                    ),
                                     'label' => __d('logged', 'language', true).': '
                                    )
                    );
    echo $form->End(__d('logged', 'change', true));
?>
    </div>
</div>
</div>
