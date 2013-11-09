to: <?php echo $username; ?>

bcc: <?php echo $users; ?>

when: <?php echo $date?>


<p>We want to remind you about a task, following is the detailed information:
<br />
<?php
    echo 'Title: '.$task['Task']['title'];
    echo '<br />Description: '.$task['Task']['description'];
    echo '<br />Due date: '.$task['Task']['duedate'];
    echo '<br />Subject: '.$schedule['Subject']['name'];
    echo '<br />Grade: '.$schedule['Section']['name'];
    echo '<br />Teacher: '.$schedule['User']['fname'].' '.$schedule['User']['flname'].' - '.$schedule['User']['username'];
?>
</p>