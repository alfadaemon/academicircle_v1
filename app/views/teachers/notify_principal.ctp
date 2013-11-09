<?php
/**
 * File name: notify_principal.ctp
 * Project: academicircle
 * Creation: 09-20-2011
 *
 * @author lfaraya
 */
foreach($principals as $principal){
    echo $principal['u']['fname'].' ';
    echo $principal['u']['flname'].' - ';
    echo $principal['u']['username'].'<br />';
}
?>