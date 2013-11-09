<?php
/**
 * File name: gradebooks.ctp
 * Project: academicircle
 * Creation: 10-11-2011
 *
 * @author lfaraya
 */

echo $session->flash();

if($schedule>=1){
if($gradebookenabled['School']['gradebook']==1){
    echo $ajax->div('studentstable');
?>
<table class="calendar">
  <tr  class="calendar-row">
      <td colspan="2">
          <?php echo '<strong>'.$subjectname['Subject']['name'].'</strong>'; ?>
      </td>
      <td class="calendar-day-head" colspan="<?php echo $periods['Year']['periods']; ?>">
          <?php echo __d('logged', 'periods', true); ?>
      </td>
      <td>
      <?php
          echo $ajax->link(__d('logged','update',true), array('controller' =>'teachers','action' =>'gradebooks', $section, $subject)
									,array('escape'=>false, 'update'=>'studentstable'
                                            ,'after' => "$('#studentstable').slideDown()"
                                            ,'indicator' => 'LoadingDiv'
                                            ,'id'=>'updateavg'
											));
          echo $ajax->button('updateavg', array(
            'icons' => array(
                'primary' => 'ui-icon-refresh'
                )
            ));
      ?>
      </td>
  </tr>
  <tr class="calendar-row">
      <td  class="calendar-day-head" colspan="2">
          <?php echo __d('pages', 'students',true);?>
      </td>
      <?php for($x=1; $x<=$periods['Year']['periods']; $x++){ ?>
      <td class="calendar-day-head" style="min-width:25px">
          <?php echo $x ?>
      </td>
      <?php } ?>
      <td class="calendar-day-head">
          <?php echo __d('logged', 'avg',true);?>
      </td>
  </tr>
  <?php
  $i = 0;
  foreach($students as $student):
    $class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
  ?>
  <tr<?php echo $class;?>>
      <td colspan="2">
          <?php
            echo $student['User']['fname'].' '.$student['User']['flname'];

          ?>
		</td>
        <?php 
            $avg=0;
            foreach($student['grades'] as $grades){
        ?>
        <td>
            <div style="width:15px;float:right;"  id="editscore<?php echo $grades['Gradebook']['id'];?>"><?php echo $grades['Gradebook']['score'];//.' - '.$grades['Gradebook']['alphascore'];?></div>
            <?php
                echo $ajax->editor( "editscore".$grades['Gradebook']['id'],
                                                array(
                                                    'controller' => 'gradebooks',
                                                    'action' => 'updatescore'
                                                ),
                                                array(
                                                    'indicator' => '<img src="../img/loading.gif">',
                                                    //'submit' => __d('logged', 'change',true),
                                                    'style' => 'inherit',
                                                    'submitdata' => array('id'=> $grades['Gradebook']['id']),
                                                    'tooltip'   => __d('logged', 'click2edit', true)
                                                    )
                                                );
                $avg+=$grades['Gradebook']['score']
            ?>
        </td>
        <? } ?>
        <td>
            <div style="width:15px;float:right;">
            <?php echo round($avg/$periods['Year']['periods'],0); ?>
            </div>
        </td>
  </tr>
  <?php endforeach; ?>
</table>
<?php
        echo $ajax->divEnd('studentstable');
    }
}
?>