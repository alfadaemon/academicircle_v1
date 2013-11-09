The user <?php echo $session->read('Auth.User.fname').' '.$session->read('Auth.User.flname'); ?> has post something for you:

<?php
    echo '\n Description: '.$post['Post']['message'];
    echo '\n Date:'.$post['Post']['postdate'];
?>

You can reply back by visiting www.academicircle.com