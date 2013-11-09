<?php
/**
 * File name: summary.ctp
 * Project: academicircle
 * Creation: 08-08-2011
 *
 * @author lfaraya
 */
?>
We like to inform you about your task for the week that starts on <?php echo date('Y-m-d', strtotime($start.' +0 days')) ?>  , following is the detailed information:
<br /><br />

<?php
echo __d('logged', 'sun', true).' '.date('Y-m-d', strtotime($start.' +0 days')).'<br />';
foreach($sunday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;

echo '<br /><br />'.__d('logged', 'mon', true).' '.date('Y-m-d', strtotime($start.' +1 days')).'<br />';
foreach($monday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;

echo '<br /><br />'.__d('logged', 'tue', true).' '.date('Y-m-d', strtotime($start.' +2 days')).'<br />';
foreach($tuesday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;


echo '<br /><br />'.__d('logged', 'wed', true).' '.date('Y-m-d', strtotime($start.' +3 days')).'<br />';
foreach($wednesday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;

echo '<br /><br />'.__d('logged', 'thu', true).' '.date('Y-m-d', strtotime($start.' +4 days')).'<br />';
foreach($thursday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;

echo '<br /><br />'.__d('logged', 'fri', true).' '.date('Y-m-d', strtotime($start.' +5 days')).'<br />';
foreach($friday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br /><br />';
        endforeach;
    }
endforeach;

echo '<br /><br />'.__d('logged', 'sat', true).' '.date('Y-m-d', strtotime($start.' +6 days')).'<br />';
foreach($saturday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'].'<br />';
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'].'<br />';
            echo __d('logged', 'description', true).':'.$day['Task']['description'].'<br />';
        endforeach;
    }
endforeach;
?>


