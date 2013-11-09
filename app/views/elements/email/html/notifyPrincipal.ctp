<?php
/**
 * File name: notifyPrincipal.ctp
 * Project: academicircle
 * Creation: 09-20-2011
 *
 * @author lfaraya
 */
?>
Hello, your teacher <?php echo $this->Session->read('Auth.User.fname').' '.$this->Session->read('Auth.User.flname'); ?> wants you to know that has finished his/her schedule for the week that starts on <?php echo $start; ?> and needs your revision.