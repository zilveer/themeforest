<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

	<title>
		<?php if ( is_home() || is_front_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>
		<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Search Results<?php } ?>
		<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Author Archives<?php } ?>
		<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>
		<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>
		<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>
		<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>
		<?php if ( is_404() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Couldnt find what your looking for<?php } ?>
		<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>
	</title> <!-- The websites title. You can change this to whatever you want. -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Language" content="en" /> 
	<meta http-equiv="Cache-control" content="no-cache" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="Keywords" content="<? echo get_option('cs_seo_keywords'); ?>" /> <!-- Key words for the search engines. Change this to whatever you want.  -->
	<meta name="Description" content="<? echo get_option('cs_seo_desc'); ?>" /> <!-- Website description. Change this to whatever you want.  -->

	<link type="text/css" rel="stylesheet" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" /> <!-- The Websites CSS file. Keep in mind that you have to change this line if you rename or move the CSS file.  -->
	<?php $cs_style = (get_option('cs_style')) ? get_option('cs_style') : 'blue';?>
	<link type="text/css" rel="stylesheet" media="screen" href="<?php bloginfo('template_url'); ?>/<?php echo $cs_style; ?>.css" /> <!-- The Lightboxs CSS file. Keep in mind that you have to change this line if you rename or move the CSS file.  -->
	<link type="text/css" rel="stylesheet" media="screen" href="<?php bloginfo('template_url'); ?>/slimbox/css/slimbox.css" /> <!-- The Lightboxs CSS file. Keep in mind that you have to change this line if you rename or move the CSS file.  -->
	<?php $cs_favicon = (get_option('cs_favicon')) ? get_option('cs_favicon') : get_bloginfo('template_url').'/favicon.ico';?>
	<link rel="shortcut icon" href="<?php echo $cs_favicon; ?>" title="Favicon" /> <!-- The websites Fav-icon. -->

	<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/slider/js/jquery.js"></script> <!-- The Slider script. Keep in mind that you have to change this line if you rename it. -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/slider/js/easySlider1.5.js"></script> <!-- The Slider script. Keep in mind that you have to change this line if you rename it. -->
	<script src="<?php bloginfo('template_url'); ?>/slimbox/js/slimbox.js" type="text/javascript"></script> <!-- The Lightbox script. Keep in mind that you have to change this line if you rename it. -->
	<script src="<?php bloginfo('template_url'); ?>/hover.js" type="text/javascript"></script> <!-- The Hover script. Keep in mind that you have to change this line if you rename it. -->
	<script src="<?php bloginfo('template_url'); ?>/cufon/cufon-yui.js" type="text/javascript"></script> <!-- The Text Replacement script. Keep in mind that you have to change this line if you rename it. -->
	<script src="<?php bloginfo('template_url'); ?>/cufon/Lacuna_Regular_400.font.js" type="text/javascript"></script> <!-- The Text Replacement script. Keep in mind that you have to change this line if you rename it. -->
	<script src="<?php bloginfo('template_url'); ?>/cufon/Aller_400.font.js" type="text/javascript"></script> <!-- The Text Replacement script. Keep in mind that you have to change this line if you rename it. -->
	<script type="text/javascript">
		Cufon.replace('h1', { fontFamily: 'Lacuna Regular' });
		Cufon.replace('h2', { fontFamily: 'Aller' });
		Cufon.replace('h3', { fontFamily: 'Lacuna Regular' });
	</script>

	<script type="text/javascript">
	<!--
		$(document).ready(function(){	
			// Some basic Javascript to hide some elements
				$(".content_portfolio_sep:last").hide();
				$("#navigation ul li:last").css("background", "none");
				$("#navigation ul li:last").css("padding-right", "0");
			// Slider Javascript
				$("#slider").easySlider({
					auto: true, 
					continuous: true
				});
		});
	//-->
	</script>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if (is_singular()) { wp_enqueue_script( 'comment-reply' ); } ?>
	<?php wp_head(); ?>
</head>
<body>

<!-- Start Wrapper -->
<div id="wrapper">

	<!-- Start Header -->
	<div id="header">
	
		<!-- Start Logo -->
		<div id="logo">
		<?php $cs_logo = (get_option('cs_logo')) ? get_option('cs_logo') : get_bloginfo('template_url').'/graphic/logo-trans.png';?>
		<a href="<?php bloginfo('home'); ?>/"><img src="<?php echo $cs_logo; ?>" alt="<? bloginfo('name'); ?>" /></a>
		</div>
		<!-- End Logo -->
		
		<!-- Start Navigation -->
		<div id="navigation">
		
		<ul>
			<?php wp_list_pages('title_li='); ?>
		</ul>
		
		</div>
		<!-- End Navigation -->
		
	</div>
	<!-- End Header -->