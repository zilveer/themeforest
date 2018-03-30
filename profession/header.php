<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if ( opt('vertical_template') == 1 ) { ?> class="vertical" <?php }  ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title><?php bloginfo('name'); ?></title>
	
	<?php if(opt('favicon') != ""){ ?>
		<link rel="shortcut icon" href="<?php eopt('favicon'); ?>"  />
	<?php } else { ?>
		<link rel="shortcut icon" href="<?php echo THEME_IMAGES_URI ?>/favicon.png" />
	<?php } ?>
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!--[if lt IE 9]><script src="<?php echo THEME_JS_URI ?>/html5shiv.js"></script><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="<?php echo THEME_CSS_URI ?>/ie8.css" /><![endif]-->
	
	<!-- Theme Hook -->
	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?> >

	<?php theme_before_header(); ?>
	
	<?php if( opt('loader_display') == 1 ) { ?>
		<!-- loader -->
		<div class="start_loader"></div>
	<?php } ?>
	
	<!-- FullScreen Slider -->
	<?php 
		$imageCount = "";
		$imageNumber= "";
		for ($j = 1; $j <= 10; $j++) {if ( opt('background_gallery_'.$j) ) { $imageCount+=1; $imageNumber=$j;} }  if ( $imageCount > 1 ) { ?>
		<div class="fullScreenSlider visible-desktop">
			<div id="slides" class="flexslider">
				<div class="slides-container">
					<?php 
						for ($i = 1; $i <= 10; $i++) {
						if ( opt('background_gallery_'.$i) ) { ?>  
							<div class="header-slide" style="background-image: url(<?php eopt('background_gallery_'.$i); ?>);"></div>
					<?php } } ?>
				</div>
			</div>
		</div>
	<?php }  else if ($imageCount == 1) { ?> 	
		 <div class="fullScreenImage visible-desktop" style="background:url(<?php eopt('background_gallery_'.$imageNumber); ?>);" > </div>
	<?php } if ( opt('theme_texture') != 'texture1' ) { ?> 	
		<div class="<?php eopt('theme_texture'); ?>"></div>
	<?php }  if ( opt('HFColor') == 1 ) { ?> 
		<div class="darkHF">
	<?php } ?>