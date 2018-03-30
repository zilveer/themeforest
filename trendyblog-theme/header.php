<?php
	$favicon = df_get_option(THEME_NAME."_favicon");
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--<![endif]-->
	<!-- BEGIN head -->
	<head>
		<!-- Title -->
		<title><?php wp_title(); ?></title>

		<!-- Meta Tags -->
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<!--[if lte IE 10]>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
		<![endif]-->
		<!-- Favicon -->
		<?php 
			if($favicon) {
		?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon" />
		<?php } else { ?>
			<link rel="shortcut icon" href="<?php echo esc_url(THEME_IMAGE_URL); ?>favicon.ico" type="image/x-icon" />
		<?php } ?>
		
		<link rel="alternate" type="application/rss+xml" href="<?php esc_url(bloginfo('rss2_url')); ?>" title="<?php printf( esc_attr__( '%s latest posts', THEME_NAME), esc_attr__( get_bloginfo('name'), 1 ) ); ?>" />
		<link rel="alternate" type="application/rss+xml" href="<?php esc_url(bloginfo('comments_rss2_url')); ?>" title="<?php printf( esc_attr__( '%s latest comments', THEME_NAME), esc_attr__( get_bloginfo('name'), 1 ) ); ?>" />
		<link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>" />

		<?php wp_head(); ?>	

	<!-- END head -->
	</head>
	
	<!-- BEGIN body -->
	<body <?php body_class();?>>
		<?php if(df_get_option(THEME_NAME."_body_image_url") && df_get_option ( THEME_NAME."_body_bg_type" ) == "image") { ?>
			<a href="<?php echo esc_url(df_get_option(THEME_NAME."_body_image_url"));?>" target="_blank" id="df_bglink">link</a>
		<?php } ?>
		<?php get_template_part(THEME_INCLUDES."banners");?>
			<?php get_template_part(THEME_INCLUDES."top"); ?>