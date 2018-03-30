<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_title("|",true,"right");?>
<?php do_action('awe_keywords_meta');?>
<?php do_action('awe_description_meta');?>
<?php do_action('awe_robots_meta');?>
<!-- wordpress head functions -->
<!-- end of wordpress head -->
<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> <![endif]-->
<?php wp_head();?>
</head>
<?php $is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false; 
	$class_customize = '';
	if($is_customize_mode){
		$class_customize = 'class_customize';
	}
?>
<body <?php body_class($class_customize); ?> >
<!-- Page wrap -->
    <div id="page-wrap">