<!doctype html>
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php is_dt_theme_moible_view(); ?>

	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="designthemes">
	<title><?php dt_theme_public_title(); ?></title>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php
	#Load Theme Styles...
	if(dt_theme_option('integration', 'enable-header-code') != '') echo stripslashes(dt_theme_option('integration', 'header-code'));
	wp_head(); ?>
</head>

<body <?php if(dt_theme_option("appearance","layout") == "boxed") body_class('boxed'); else body_class(); ?>>
	<?php if(dt_theme_option('general','loading-bar') != "true") echo '<div id="loader-wrapper"><div class="loader"><span class="fa fa-spinner fa-spin"></span></div></div>'; ?>
	<!-- **Wrapper** -->
	<div class="wrapper">
    	<div class="inner-wrapper">
        	<!-- header-wrapper starts here -->
        	<div id="header-wrapper" class="<?php if(dt_theme_option('general','header-top-bar') == "true") echo esc_attr('notop-bar'); ?>">
            	<header id="header" class="header2">
				<?php if(dt_theme_option('general','header-top-bar') != "true"): ?>
                    <!-- Top bar starts here -->
                    <div class="top-bar">
                        <div class="container">
							<?php if(dt_theme_option('general', 'top-bar-left-content') != NULL):
								global $dt_allowed_html_tags; ?>
                                <div class="dt-sc-contact-info">
                                    <p><?php echo wp_kses(do_shortcode(stripslashes(dt_theme_option('general', 'top-bar-left-content'))), $dt_allowed_html_tags); ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="top-right">
                                <ul><?php
								if(function_exists("is_woocommerce")): ?>
									<li><a href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View Shopping Cart', 'iamd_text_domain' ); ?>"><span class="fa fa-shopping-cart"></span><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a></li><?php
								endif;
								if(!is_user_logged_in()):
									$loginurl = ( class_exists('c_ws_plugin__s2member_check_activation') ) ? wp_login_url() : wp_login_url(get_permalink()); ?>
									<li><a title="<?php _e('Login', 'iamd_text_domain'); ?>" href="<?php echo $loginurl; ?>"><span class="fa fa-sign-in"></span><?php _e('Member Login', 'iamd_text_domain'); ?></a></li>
									<li><a title="<?php _e('Register Now', 'iamd_text_domain'); ?>" href="<?php echo wp_registration_url(); ?>"><span class="fa fa-user"></span><?php _e('Register', 'iamd_text_domain'); ?></a></li><?php
								else: ?>
									<li><a title="<?php _e('Logout', 'iamd_text_domain'); ?>" href="<?php echo wp_logout_url(get_permalink()); ?>"><span class="fa fa-sign-out"></span><?php _e('Logout', 'iamd_text_domain'); ?></a></li>
									<li><a title="<?php _e('My Profile', 'iamd_text_domain'); ?>" href="<?php 
										$current_user = wp_get_current_user();
										echo get_edit_user_link($current_user->ID); ?>"><span class="fa fa-dashboard"></span><?php _e('My Profile', 'iamd_text_domain'); ?></a></li><?php
								endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Top bar ends here -->
                <?php endif; ?>    
                    <div class="main-menu-container">
                    	<div class="main-menu">
                            <div id="logo"><?php
                                if( dt_theme_option('general', 'logo') ):
                                    $template_uri = get_template_directory_uri();
                                    $url = dt_theme_option('general', 'logo-url');
                                    $url = !empty( $url ) ? $url : $template_uri."/images/logo.png";
    
                                    $retina_url = dt_theme_option('general','retina-logo-url');
                                    $retina_url = !empty($retina_url) ? $retina_url : $template_uri."/images/logo@2x.png";
    
                                    $width = dt_theme_option('general','retina-logo-width');
                                    $width = !empty($width) ? $width."px;" : "187px";
    
                                    $height = dt_theme_option('general','retina-logo-height');
                                    $height = !empty($height) ? $height."px;" : "49px";?>
                                    <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('title'); ?>">
                                        <img class="normal_logo" src="<?php echo esc_url($url);?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" />
                                        <img class="retina_logo" src="<?php echo esc_url($retina_url);?>" alt="<?php bloginfo('title'); ?>" title="<?php bloginfo('title'); ?>" style="width:<?php echo esc_attr($width);?>; height:<?php echo esc_attr($height);?>;"/>
                                    </a><?php
                                else: ?>
                                    <div class="logo-title">
                                        <h1 id="site-title"><a href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
                                        <h2 id="site-description"><?php bloginfo('description'); ?></h2>
                                    </div><?php
                                endif; ?>                                 
                            </div>
                            <div id="primary-menu">
                                <div class="dt-menu-toggle" id="dt-menu-toggle"><?php _e('Menu','iamd_text_domain'); ?><span class="dt-menu-toggle-icon"></span></div>
                                <nav id="main-menu">
                                    <?php wp_nav_menu( array('theme_location' => 'primary-menu', 'container'  => false, 'menu_id' => 'menu-main-menu', 'menu_class' => 'menu', 'fallback_cb' => 'dt_theme_default_navigation', 'walker' => new DTFrontEndMenuWalker())); ?>
                                </nav>
                            </div>
                        </div>
                    </div>
				</header>
			</div>