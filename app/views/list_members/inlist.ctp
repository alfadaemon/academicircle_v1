<?php
/**
 * File name: inlist.ctp
 * Project: academicircle
 * Creation: 09-24-2011
 *
 * @author lfaraya
 */

echo '<a style="text-decoration:underline;">'.$members[0]['Mylist']['name'].'<br /></a>';
foreach($members as $member){
    echo $member['User']['fname'].' ';
    echo $member['User']['flname'].'<br />';
    //echo $member['User']['username'];
}
?>
