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


<?php
echo __d('logged', 'sun', true).' '.date('Y-m-d', strtotime($start.' +0 days'));
?>


<?php
foreach($sunday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>




<?php
        endforeach;
    }
endforeach;
?>



<?php
echo __d('logged', 'mon', true).' '.date('Y-m-d', strtotime($start.' +1 days'));
?>



<?php
foreach($monday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>




<?php
        endforeach;
    }
endforeach;
?>




<?php
echo __d('logged', 'tue', true).' '.date('Y-m-d', strtotime($start.' +2 days'));
?>


<?php
foreach($tuesday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>




<?php
        endforeach;
    }
endforeach;
?>




<?php
echo __d('logged', 'wed', true).' '.date('Y-m-d', strtotime($start.' +3 days'));
?>


<?php
foreach($wednesday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>


<?php
        endforeach;
    }
endforeach;
?>




<?php
echo __d('logged', 'thu', true).' '.date('Y-m-d', strtotime($start.' +4 days'));
?>


<?php
foreach($thursday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>




<?php
        endforeach;
    }
endforeach;
?>




<?php
echo __d('logged', 'fri', true).' '.date('Y-m-d', strtotime($start.' +5 days'));
?>


<?php
foreach($friday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>




<?php
        endforeach;
    }
endforeach;
?>




<?php
echo __d('logged', 'sat', true).' '.date('Y-m-d', strtotime($start.' +6 days'));
?>


<?php
foreach($saturday as $Day):
    if(!empty($Day['Task'])){
        echo $Day['Subject']['name'];
?>


<?php
        foreach($Day['Task'] as $day):
            echo __d('logged', 'title', true).':'.$day['Task']['title'];
?>


<?php
            echo __d('logged', 'description', true).':'.$day['Task']['description'];
?>


<?php
        endforeach;
    }
endforeach;
?>

