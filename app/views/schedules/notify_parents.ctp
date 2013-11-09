to <?php echo $username; ?>

bcc <?php echo $users; ?>

<?php echo $date;?>



Dear <?php echo $name; ?>, we like to remind you about a task, following is the detailed information:


<?php
    echo 'Title: '.$task['Task']['title'];
?>


<?php
    echo 'Description: '.$task['Task']['description'];
?>


<?php
    echo 'Due date: '.$task['Task']['duedate'];
?>


<?php
    echo 'Subject: '.$schedule['Subject']['name'];
?>


<?php
    echo 'Grade: '.$schedule['Section']['name'];
?>


<?php
    echo 'Teacher: '.$schedule['User']['fname'].' '.$schedule['User']['flname'].' - '.$schedule['User']['username'];
?>
