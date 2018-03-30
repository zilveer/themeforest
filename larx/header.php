<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?><?php if(th_theme_data('enable_rtl_layout') == true) { echo 'dir="rtl"'; } ?> > <!--<![endif]-->
    <head>
        <!-- Meta Tags -->        
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
		// If before WP4.4 - show old wp_title() function
		if ( ! function_exists( '_wp_render_title_tag' ) ) :
			function woss_render_title() {
		?>
				<title><?php wp_title('-', true, 'right'); ?></title>
		<?php
			}
			add_action( 'wp_head', 'woss_render_title' );
		endif;
		?>
		
		<?php
		// If WP4.3+ and no site_icon is set - show custom
		if ( function_exists( 'has_site_icon' ) && !has_site_icon() ) { ?>
			<link rel="shortcut icon" href="<?php $favicon=th_theme_data('favicon'); echo esc_url($favicon['url']); ?>" type="image/x-icon">
		<?php }
		// If before WP4.3 - show custom
		if ( ! function_exists( 'wp_site_icon' ) ) { ?>
			<link rel="shortcut icon" href="<?php $favicon=th_theme_data('favicon'); echo esc_url($favicon['url']); ?>" type="image/x-icon">
		<?php } ?>
		
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        

        <?php wp_head() ?>
    </head>
    <body <?php body_class() ?>>

        <?php if(th_theme_data('preloader') == 1): ?>
            <!--Start Preloader-->
            <div id="preloader">
                <div class="preloader-container">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>
            </div>
            <!-- End Preloader-->
        <?php endif;?>

        <?php th_theme_nav() ?>