<p> The user <?php echo $session->read('Auth.User.fname').' '.$session->read('Auth.User.flname'); ?> has post something for you:</p>

<?php
    echo '<br /> Description: '.$post['Post']['message'];
    echo '<br /> Date:'.$post['Post']['postdate'];
?>
<br />
You can reply back by visiting www.academicircle.com
<br />