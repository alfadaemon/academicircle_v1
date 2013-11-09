<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['fname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['sname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['flname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Slname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['slname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nickname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['nickname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Altemail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['altemail']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gender'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['gender']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Language'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['language']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Theme'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($user['Theme']['name'], array('controller' => 'themes', 'action' => 'view', $user['Theme']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['active']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions" id="actionsViewUser">
    <?php
        echo $ajax->link( __d('logged', 'edit', true).' '.__d('pages', 'user', true), array('action' => 'edit',$user['User']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'delete', true).' '.__d('pages', 'user', true), array('action' => 'delete', $user['User']['id']),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ),sprintf(__('Are you sure you want to delete # %s?', true),$user['User']['username']));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'user', true).'s', array('action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'user', true), array('action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'school', true).'s', array('controller' => 'schools', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('pages', 'parent', true).'s', array('controller'=>'ancestors', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('pages', 'parent', true), array('controller'=>'ancestors', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'section', true).'s', array('controller'=>'sections', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'section', true), array('controller'=>'sections', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'view', true).' '.__d('logged', 'task', true).'s', array('controller'=>'tasks', 'action' => 'index'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
        echo $ajax->link( __d('logged', 'add', true).' '.__d('logged', 'task', true), array('controller'=>'tasks', 'action' => 'add'),
            array('update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));

    ?>
</div>
<?php echo $ajax->buttonset('actionsViewUser');?>
<div class="related">
	<h3><?php __('Related Ancestors');?></h3>
	<?php if (!empty($user['Ancestor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Student Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Ancestor'] as $ancestor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $ancestor['id'];?></td>
			<td><?php echo $ancestor['user_id'];?></td>
			<td><?php echo $ancestor['student_id'];?></td>
			<td class="actions">
                <?php
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'ancestors', 'action' => 'view', $ancestor['id']),
                        array('id'=>'viewAncestor'.$ancestor['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'ancestors', 'action' => 'edit', $ancestor['id']),
                        array('id'=>'editAncestor'.$ancestor['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'ancestors', 'action' => 'delete', $ancestor['id']),
                        array('id'=>'deleteAncestor'.$ancestor['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $ancestor['id']));

                    echo $ajax->button('viewAncestor'.$ancestor['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                    echo $ajax->button('editAncestor'.$ancestor['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                    echo $ajax->button('deleteAncestor'.$ancestor['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'ancestors', 'action' => 'add'),
                    array('id'=>'addAncestor', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addAncestor', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Mylists');?></h3>
	<?php if (!empty($user['Mylist'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Mylist'] as $mylist):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $mylist['id'];?></td>
			<td><?php echo $mylist['name'];?></td>
			<td><?php echo $mylist['description'];?></td>
			<td><?php echo $mylist['user_id'];?></td>
			<td class="actions">
                <?php
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'mylists', 'action' => 'view', $mylist['id']),
                        array('id'=>'viewMyList'.$mylist['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'mylists', 'action' => 'edit', $mylist['id']),
                        array('id'=>'editMyList'.$mylist['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'mylists', 'action' => 'delete', $mylist['id']),
                        array('id'=>'deleteMyList'.$mylist['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $mylist['id']));

                    echo $ajax->button('viewMyList'.$mylist['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                    echo $ajax->button('editMyList'.$mylist['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                    echo $ajax->button('deleteMyList'.$mylist['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'mylists', 'action' => 'add'),
                    array('id'=>'addMyList', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addMyList', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Students');?></h3>
	<?php if (!empty($user['Student'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Section Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Student'] as $student):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $student['id'];?></td>
			<td><?php echo $student['user_id'];?></td>
			<td><?php echo $student['section_id'];?></td>
			<td class="actions">
                <?php
                    echo $ajax->link( __d('logged', 'view', true), array('controller' => 'students', 'action' => 'view', $student['id']),
                        array('id'=>'viewStudent'.$student['id'],  'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' =>  "$('#editAreaMyAdmin').slideDown()" ));
                    echo $ajax->link( __d('logged', 'edit', true), array('controller' => 'students', 'action' => 'edit', $student['id']),
                        array('id'=>'editStudent'.$student['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));
                    echo $ajax->link( __d('logged', 'delete', true), array('controller' => 'students', 'action' => 'delete', $student['id']),
                        array('id'=>'deleteStudent'.$student['id'], 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"),sprintf(__('Are you sure you want to delete # %s?', true), $student['id']));

                    echo $ajax->button('viewStudent'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-folder-open'), 'text'=>false));
                    echo $ajax->button('editStudent'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-pencil'), 'text'=>false));
                    echo $ajax->button('deleteStudent'.$student['id'], array('icons'=>array('secondary'=>'ui-icon-trash'), 'text'=>false));
                ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <?php
            echo $ajax->link( __d('logged', 'add', true), array('controller' => 'students', 'action' => 'add'),
                    array('id'=>'addStudent', 'update' => 'editAreaMyAdmin', 'indicator' => 'LoadingDiv', 'after' => "$('#editAreaMyAdmin').slideDown()"));

            echo $ajax->button('addStudent', array('icons'=>array('secondary'=>'ui-icon-plus'),));
        ?>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Groups');?></h3>
	<?php if (!empty($user['Group'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Group'] as $group):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $group['id'];?></td>
			<td><?php echo $group['name'];?></td>
			<td><?php echo $group['created'];?></td>
			<td><?php echo $group['modified'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
