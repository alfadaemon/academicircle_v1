<div id="tabnav">
<ul>
<?php echo $html->image('logolog.gif', array('style'=>'padding: 2px 15px 0px 5px; float:left; width:24px; height:24px', 'alt'=>'logo'));?>
<div style="float:right">
	<?php 
		echo $html->link(__('LogOut', true), array('controller'=>'users', 'action'=>'logout'),array('id'=>'logout')); 
		echo $ajax->button('logout', array('icons'=>array('secondary'=>'ui-icon-circle-close')));
	?>
</div>
<div style="float:right">
<li><?php echo $session->read('Auth.User.username'); ?></li>
</div>
    <li>
            <?php echo $html->link(__d('logged', 'myhome', true), array('controller'=>'users', 'action'=>'home')); ?>
    </li>
<?php
	foreach($menuoptions as $menu){
		switch ($menu['GroupsUser']['group_id']){
			//Administrators
			case 1:
?>
    <li>
            <?php echo $html->link(__d('logged', 'myadmin', true), array('controller'=>'admins', 'action'=>'index')); ?>
    </li>
<?php
			break;
			case 2:
			//Principal/Director
?>
    <li>
		<?php echo $html->link(__d('logged', 'myschool', true), array('controller'=>'users', 'action'=>'myschool')); ?>
    </li>
    <li>
		<?php echo $html->link(__d('logged', 'myteachers', true), array('controller'=>'users', 'action'=>'myteachers')); ?>
    </li>
<?php
			break;
			case 3:
			//Teacher
?>
    <li>
		<?php echo $html->link(__d('logged', 'mysubjects', true), array('controller'=>'users', 'action'=>'mysections')); ?>
    </li>
<?php
			break;
			case 4:
			//Parent
?>
    <li>
		<?php echo $html->link(__d('logged', 'mychildren', true), array('controller'=>'users', 'action'=>'mychildren')); ?>
    </li>
<?php
			break;
			case 5:
			//Student
?>
    <li>
		<?php echo $html->link(__d('logged', 'myschedule', true), array('controller'=>'users', 'action'=>'myschedule')); ?>
    </li>
<?php
			break;
		}
	}
?>
<li>
		<?php echo $html->link(__d('logged', 'mylists', true), array('controller'=>'users', 'action'=>'mylists')); ?>
</li>
<li>
		<?php echo $html->link(__d('logged', 'mypreferences', true), array('controller'=>'users', 'action'=>'profile')); ?>
</li>
</ul>
</div><!-- tabnav -->
<?=$ajax->tabs('tabnav', array('indicator'=>'LoadingDiv'))?>
