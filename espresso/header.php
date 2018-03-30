<!DOCTYPE HTML>

<html <?php language_attributes(); ?>>

<head>

	<?php global $template_dir;
	$template_dir = get_template_directory_uri(); ?>	

	<title><?php wp_title('&mdash;', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php $disable_responsive = ot_get_option('disable_responsive',false);
  	if (!$disable_responsive) :
		echo '<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />';
	else :
		echo '<meta name="viewport" content="width=1050" />';
	endif;
	?>
	
	<link rel="shortcut icon" href="<?php echo ot_get_option('espresso_favicon',$template_dir.'/images/favicon.ico'); ?>" />
	<?php if (is_singular()): wp_enqueue_script( 'comment-reply' ); endif; wp_head(); ?>
	
	<?php
	
	// Custom CSS and Logo Height
	$custom_css = ot_get_option('espresso_custom_css');
	$logo_height = ot_get_option('logo_height');
	
	// CSS Color Overrides
	$color_overrides = array();
	
	// Logo Settings / Custom CSS
	if ($custom_css || $logo_height) {
		echo '<style type="text/css">';
			echo $custom_css.' ';
			echo ($logo_height ? 'header#header { height:'.str_replace('px','',$logo_height).'px; }' : '');
		echo '</style>';
	}
	
	$woo_circle_style = ot_get_option('woo_circle_style','circles');
	
	if ($woo_circle_style != 'circles'):
	
		if ($woo_circle_style == 'roundedSquares'): $pixel_size = '5px'; else : $pixel_size = '0'; endif;
		
		 ?><style type="text/css">
		 
		 	.woocommerce ul.products li.product a img,
			.woocommerce-page ul.products li.product a img,
			.woocommerce div.product div.images img,
			.woocommerce #content div.product div.images img,
			.woocommerce-page div.product div.images img,
			.woocommerce-page #content div.product div.images img {
		 		-moz-border-radius:<?php echo $pixel_size; ?>; -webkit-border-radius:<?php echo $pixel_size; ?>; border-radius:<?php echo $pixel_size; ?>; }
		
		</style><?php
	endif;
	
	?><!--[if !IE]><!--><script>  
	if (/*@cc_on!@*/false) {  
	    // Do nothing
	} else {
		document.documentElement.className+=' not-ie10';
	}
	</script><!--<![endif]--><?php
	
	$disable_fb_overlap = ot_get_option('features_no_overlap',false);
	
	if ($disable_fb_overlap):
	
		 ?><style type="text/css">
		 	#ctas { padding:30px 0; }
		 	#ctas article { top:0; }
		</style><?php
		
	endif; ?>
	
	<!--[if gte IE 9]>
	<style>
	.video-js video { display:none; }
	.video-js .vjs-poster { display:block !important; }
	</style>
	<![endif]-->

</head>

<?php if (is_admin_bar_showing()) : $extra_class = 'admin-bar'; else : $extra_class = ''; endif; ?>

<body <?php body_class($extra_class); ?>><?php
	
	$google_analytics = ot_get_option('espresso_google_analytics');
	if ($google_analytics) {
		echo $google_analytics;
	}
	
	if (has_nav_menu('mobile-menu')){
    	wp_nav_menu(array('container' => false, 'menu_id' => 'mobileNav', 'fallback_cb' => false, 'theme_location' => 'mobile-menu'));
	} else {
		wp_nav_menu(array('container' => false, 'menu_id' => 'mobileNav', 'fallback_cb' => false, 'theme_location' => 'main-menu'));
	}

	global $boxed_style;
	$boxed_style = ot_get_option('boxed_style');
	$background_image = ot_get_option('background_image');
	$background_color = ot_get_option('background_color');
	
	if ($boxed_style): echo '<div class="boxed">'; endif;
	
	$header_style = ot_get_option('header_style');
	if ( $header_style ) {
		get_template_part('headers/header',$header_style);
	}