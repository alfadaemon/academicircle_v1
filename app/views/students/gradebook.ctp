<div id="editAreaMySchool">
<div class="schedules index">
<h3><?php
    echo __d('logged', 'schedule', true).': '.$sectionName;
?></h3>
<?php
echo $this->element("taskviews");
?>
<p>
</p>
<div class="lfloat">
    <table class="calendar">
        <tr class="calendar-row">
            <td  class="calendar-day-head">
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
        foreach($subjects as $subject) { 
            $avg=0;
    ?>
        <tr class="calendar-row">
            <td class="calendar-day-head"><?php echo $subject['m']['name'];?></td>
        <? foreach($subject['Gradebook'] as $gradebook) { ?>
            <td>
                <?php 
                    $avg+=$gradebook['Gradebook']['score']; 
                    echo $gradebook['Gradebook']['score']; 
                ?>
            </td>
        <?php } ?>
            <td>
                <div style="width:15px;float:right;">
                    <?php echo round($avg/$periods['Year']['periods'],0); ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>
</div>
</div>
<?php
    echo $ajax->div('workAreaPs', array('style'=>'z-index:1000px; position:fixed; top: 0px; width:100%'));
    echo "&nbsp";
    echo $ajax->divEnd('workAreaPs');
?>

<?php //echo $this->element('sql_dump'); ?>