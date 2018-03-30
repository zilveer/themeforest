<?php
	$favicon = get_option(THEME_NAME."_favicon");

	$bg_texture = get_option(THEME_NAME."_bg_texture");
	$bodyClass ='style="background-image: url('.THEME_IMAGE_URL.'background-'.$bg_texture.'.jpg); background-position: top center; background-repeat: repeat;"';

?>
<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<!-- BEGIN head -->
	<head>
		<!-- Title -->
		<title>
			<?php
				if ( is_single() ) { single_post_title(); print ' | '; bloginfo('name'); }      
				elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); }
				elseif ( is_page() ) { single_post_title(''); print ' | '; bloginfo('description'); }
				elseif ( is_search() ) { bloginfo('name'); print ' | Search results ' . esc_html($s); }
				elseif ( is_404() ) { bloginfo('name'); print ' | Page not found'; }
				else { bloginfo('name'); print ' | '; wp_title(''); }
			?>
		</title>

		<!-- Meta Tags -->
		<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		
		<!-- Favicon -->
		<?php 
			if($favicon) {
		?>
			<link rel="shortcut icon" href="<?php echo $favicon;?>" type="image/x-icon" />
		<?php } else { ?>
			<link rel="shortcut icon" href="<?php echo THEME_IMAGE_URL; ?>favicon.ico" type="image/x-icon" />
		<?php } ?>
		
		<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', THEME_NAME), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
		<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', THEME_NAME), esc_html( get_bloginfo('name'), 1 ) ); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- END head -->
	</head>
	
	<!-- BEGIN body -->
	<body <?php body_class();?> <?php echo $bodyClass; ?>>

		<?php get_template_part(THEME_INCLUDES."banners");?>