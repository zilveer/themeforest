<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<?php global $smof_data; ?>
<html <?php language_attributes(); ?> <?php if($smof_data['rnr_enable_rtl_layout'] == true) { echo 'dir="rtl"'; } ?>> <!--<![endif]-->
<!--
===========================================================================
 Jarvis Onepage Parallax WordPress Theme by rocknrolladesigns.com (http://www.rocknrolladesigns.com) 
===========================================================================
-->
<head>
<meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="IE=edge" />
<!-- PAGE TITLE -->

<?php if (defined('WPSEO_VERSION')) { ?>
           <title><?php wp_title(); ?></title>	 
<?php }else {
	      $rnr_description =  get_bloginfo('description'); ?>
          <title><?php wp_title(' &raquo; ', true, 'right'); ?><?php bloginfo('name'); ?> &raquo; <?php echo $rnr_description; ?></title>
         <meta name="description" content="<?php  echo $rnr_description; ?>">  
         <?php    } ?>
</title>





<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



<!-- Mobile Specific Metas & Favicons
========================================================= -->

<?php if($smof_data['rnr_favicon_url'] != "") { ?><link rel="shortcut icon" href="<?php echo $smof_data['rnr_favicon_url']; ?>"><?php } ?>


<!-- WordPress Stuff
========================================================= -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!-- Google Web Fonts -->

 <?php get_template_part( 'includes/googlefonts'); ?>

<?php wp_head(); ?>

</head>

<body <?php body_class('onepage'); ?> data-spy="scroll" data-target=".navigation" data-offset="82" data-preoload="<?php echo $smof_data['rnr_disable_preloader'];?>">
<div id="load"></div>

 
 
     <!-- START PAGE WRAP -->    
    <div class="page-wrap <?php if($smof_data['rnr_enable_dark_skin'] == true) { echo 'dark-skin'; } ?>">
    
  <!-- HEADER SECTION -->	
 

