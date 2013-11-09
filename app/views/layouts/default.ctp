<?php
/* SVN FILE: $Id$ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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

		echo $html->css('screen.css');

		echo $scripts_for_layout;
?>

</head>

<body>

<!--header -->
<div id="header-wrap">
    <div id="header">

      <a name="top"></a>

	  <div id="imglogo">
  	<div align="center">
        <?php echo $html->image('logo.gif', array('class'=>'logo', 'align'=>'middle', 'alt'=>'logo')); ?>
    </div>
	</div>
	<h1 id="logo-text"><a href="./" title="" id="logo">academi<span class="Estilo2">C</span>ircle.com</a></h1>
	  <p id="slogan"><?php echo __d('pages', 'slogan', true);?></p>

	<div  id="nav">
	  <ul>
	    <li <?php echo ( ($this->params['url']['url']=='pages/home') || ($this->params['url']['url']=='/') )?'id="current"':'';?> >
            <?php echo $html->link(__d('pages','start', true), array('controller'=>'pages', 'action'=>'home'));?>
        </li>
		<li <?php echo $this->params['url']['url']=='pages/parents'?'id="current"':'';?>>
            <?php echo $html->link(__d('pages','parents', true), array('controller'=>'pages', 'action'=>'parents')); ?>
        </li>
        <li <?php echo $this->params['url']['url']=='pages/students'?'id="current"':'';?>>
            <?php echo $html->link(__d('pages','students', true), array('controller'=>'pages', 'action'=>'students')); ?>
        </li>
        <li <?php echo $this->params['url']['url']=='pages/teachers'?'id="current"':'';?>>
            <?php echo $html->link(__d('pages','teachers', true), array('controller'=>'pages', 'action'=>'teachers')); ?>
        </li>
        <!-- li <?php echo $this->params['url']['url']=='pages/ourclients'?'id="current"':'';?>>
            <?php echo $html->link('Our Clients', array('controller'=>'pages', 'action'=>'ourclients')); ?>
        </li -->
        <li <?php echo $this->params['url']['url']=='pages/faq'?'id="current"':'';?>>
            <?php echo $html->link('FAQ', array('controller'=>'pages', 'action'=>'faq')); ?>
        </li>
        <li <?php echo ( ($this->params['url']['url']=='pages/login') || ($this->params['url']['url']=='users/login') )?'id="current"':'';?>>
            <?php echo $html->link(__d('pages','login', true), array('controller'=>'pages', 'action'=>'login')); ?>
        </li>
	  </ul>
	  </div>

    <!--/header-->
  </div>
</div>

<!-- content-outer -->
<div id="content-wrap" class="clear" >

	<!-- content -->
   <div id="content">

    <?php
        echo $session->flash('auth');
        echo $session->flash();
        echo $content_for_layout;
    ?>
	   <!-- sidebar -->
	   <!-- content -->
   </div>
   <!-- /content-out -->
</div>
<!-- footer-outer -->
<div id="footer-outer" class="clear"></div>
<!-- footer-bottom -->
<div id="footer-bottom">

	<p class="bottom-left">
		<strong>Copyright</strong> &copy; 2010&nbsp;<strong>academicircle.com</strong>&nbsp;&nbsp;template by <a href="http://www.styleshout.com/">styleshout</a>	</p>

	<p class="bottom-right">
		
   </p>

<!-- /footer-bottom-->
</div>
</body>
</html>
