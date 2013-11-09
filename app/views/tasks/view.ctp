<div style="border:1px solid #A2A2A2; background-color:#FFF; width:450px; padding: 10px; margin:auto 10px;">
     <?php
        echo $ajax->div('Working', array('style'=>'display:none; position:fixed; top: 2px; left: 180px; z-index:1; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
        echo __d('logged', 'loading', true);
        echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
        echo $ajax->divEnd('Working');
    ?>
<h2><?php  echo __d('logged', 'task', true);?></h2>
	<dl>
		<dt><strong><?php echo __d('logged', 'title', true); ?>:</strong></dt>
		<dd>
			<div  id="tasktitle<?php echo $task['Task']['id'];?>"><?php echo $task['Task']['title']; ?></div>
            <?php
                //If it is a principal or a teacher enable update options
            //echo $task['Task']['duedate']-date('Y-m-d');
                if($menuoptions[0]['GroupsUser']['group_id']==2 || $menuoptions[0]['GroupsUser']['group_id']==3){
                    echo $ajax->editor( "tasktitle".$task['Task']['id'],
                        array(
                            'controller' => 'tasks',
                            'action' => 'updatetitle'
                        ),
                        array(
                            'indicator' => '<img src="../img/loading.gif">',
                            'submit' => __d('logged', 'change',true),
                            'style' => 'inherit',
                            'submitdata' => array('id'=> $task['Task']['id']),
                            'tooltip'   => __d('logged', 'click2edit', true)
                            )
                    );
                }
            ?>
		</dd>
		<dt><strong><?php echo __d('logged', 'description', true); ?>:</strong></dt>
		<dd>
			<div  id="taskdescription<?php echo $task['Task']['id'];?>"><?php echo $task['Task']['description']; ?></div>
			&nbsp;
            <?php
                //If it is a principal or a teacher enable update options
                if($menuoptions[0]['GroupsUser']['group_id']==2 || $menuoptions[0]['GroupsUser']['group_id']==3){
                    echo $ajax->editor( "taskdescription".$task['Task']['id'],
                        array(
                            'controller' => 'tasks',
                            'action' => 'updatedescription'
                        ),
                        array(
                            'indicator' => '<img src="../img/loading.gif">',
                            'submit' => __d('logged', 'change',true),
                            'style' => 'inherit',
                            'submitdata' => array('id'=> $task['Task']['id']),
                            'tooltip'   => __d('logged', 'click2edit', true)
                            )
                    );
                }
            ?>
		</dd>
		<dt><strong><?php echo __d('logged', 'duedate', true); ?>:</strong></dt>
		<dd>
			<?php echo $task['Task']['duedate']; ?>
			&nbsp;
		</dd>
		<!--dt><?php __('Value'); ?></dt>
		<dd>
			<?php echo $task['Task']['value']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Schedule'); ?></dt>
		<dd>
			<?php echo $html->link($task['Schedule']['id'], array('controller' => 'schedules', 'action' => 'view', $task['Schedule']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php __('User'); ?></dt>
		<dd>
			<?php echo $html->link($task['User']['id'], array('controller' => 'users', 'action' => 'view', $task['User']['id'])); ?>
			&nbsp;
		</dd -->
	</dl>
<div>
        <?php //echo $html->link(__('Close', true), array('controller' => 'users', 'action' => 'myschedule'));
            echo $ajax->link(__d('logged', 'close',true), array( '#' ), array('id'=>'closeviewtask', 'indicator' => 'Working', 'after' =>"$('#workAreaPs').slideUp();" ,'before'=>"$('#OverlayMyTeacher').slideUp()"));
            echo $ajax->button('closeviewtask', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
        ?>
</div>
</div>
