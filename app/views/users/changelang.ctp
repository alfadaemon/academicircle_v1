<h4><?php echo __d('logged', 'change', true).' '.__d('logged', 'language', true); ?></h4>
<?php
    echo $session->flash();
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