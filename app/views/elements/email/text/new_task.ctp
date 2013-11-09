We like you to know that a new task has been added, following is the detailed information:
<?php
    echo '\n Title: '.$task['Task']['title'];
    echo '\n Description: '.$task['Task']['description'];
    echo '\n Due date: '.$task['Task']['duedate'];
    echo '\n Subject: '.$schedule['Subject']['name'];
    echo '\n Grade: '.$schedule['Section']['name'];
    echo '\n Teacher: '.$schedule['User']['fname'].' '.$schedule['User']['flname'].' - '.$schedule['User']['username'];
?>