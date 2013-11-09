<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <?php echo $html->charset(); ?>
	<title>
		<?php
            echo 'academiCircle.com&copy;: Connecting Parents, Students & Teachers :: ';
            echo $title_for_layout;
        ?>
	</title>

<meta name="author" content="Luis Francisco Araya- tipymehn.com" />
<meta name="description" content="academicircle.com - Connecting parents, students and teachers" />
<meta name="keywords" content="academic, study, parents, student, teacher, task, reminder" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />
<?php
	echo $html->meta('icon');
	echo $html->css('jquery-ui-1.8.9.custom');
	echo $html->css('layout');
    echo $html->css('jquery.jscrollpane');
	echo $javascript->link('jquery-1.4.4.min');
	echo $javascript->link('jquery-ui-1.8.9.custom.min');
    echo $javascript->link('jquery.jscrollpane.min');
    echo $javascript->link('jquery.jeditable');
	echo $scripts_for_layout;
?>
<script>
$(document).ready(function() {
    //This works.
    //TODO Change to a nicer jquery plugin over the page
    if ( $('#flashMessage').text() != '') {
      setTimeout(function() {
         $('#flashMessage').slideUp(300);
     }, 3000);};
     //TODO this needs to be designed to be more specific, its too general purpose now.
     $('tr:odd,dt:odd').addClass('altrow');
 });

</script>
</head>

<body>
<div id="pagewidth" >
<?
echo $ajax->div('LoadingDiv', array('style'=>'display:none; position:fixed; top: 2px; left: 180px; z-index:1; padding: 5px', 'class'=>'ui-state-highlight ui-corner-all'));
echo __d('logged', 'loading', true);
echo $html->image('loading.gif', array('align'=>'middle', 'alt'=>__d('logged', 'loading', true)));
echo $ajax->divEnd('LoadingDiv');
?>
	<div id="maincol">
		<?php 
	        	echo $this->element("navigation");
            		echo $content_for_layout;
		?>
    </div>
	<footer id="footer">
	<div class="lfloat">
			<strong>Copyright</strong> &copy; <?php echo date('Y');?>&nbsp;<strong>academicircle.com</strong>
	</div>
	<div class="rfloat">
			<?php echo $html->link(__('Questions & Sugestions', true), array('controller'=>'contacts', 'action'=>'qanda')); ?>
	</div>
	</footer>
</div>
<div id="Overlay" style="display:none;
		position: fixed;
        top: 0px;
        text-align:left;
        left: 0px;
        width: 100%;
        height: 100%;
        background: #000;
        z-index:2999">
</div><!-- Overlay -->

<div style="margin: 0pt; padding: 0pt; border: 0pt none; background: none repeat scroll 0% 0% transparent; overflow: hidden; position: fixed; z-index: 10000002; height: 70px; width: 300px; right: 100px; bottom: 0px;">
    <iframe 
        style="background-color: transparent; vertical-align: text-bottom; overflow: hidden; position: relative; width: 100%; height: 100%; margin: 0pt; z-index: 999999;"
        src="http://www.google.com/talk/service/badge/Show?tk=z01q6amlqmap74dpke5k2iqpc2uljaks0fmigjb9nnb623iur87a477o11bpo1tjjbir3juiuv6mvpr4hacssk20mdq9vv1dmlbokquk4e00mtmijruhqrff10205fbv8n3d0tkban36fitcnbivufqd709ph0n97m3nj8d17&amp;w=300&amp;h=18"
        allowtransparency="true" width="300" frameborder="0" height="18"></iframe>
</div>

</body>
</html>
