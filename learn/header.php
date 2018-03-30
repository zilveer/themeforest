<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

	<!-- Page Title 
	================================================== -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <?php if( function_exists('wp_site_icon') ) {
            if(learn_theme_option('favicon')) { ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(learn_theme_option('favicon')); ?>">
            <?php }
        }
    ?>

    <?php if(learn_theme_option('icon_ipad_retina')) { ?>
    <link rel="apple-touch-icon" href="<?php echo esc_url(learn_theme_option('icon_ipad_retina')); ?>">
    <?php }if(learn_theme_option('icon_ipad')) { ?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(learn_theme_option('icon_ipad')); ?>">
    <?php }if(learn_theme_option('icon_iphone_retina')) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(learn_theme_option('icon_iphone_retina')); ?>">
    <?php }if(learn_theme_option('icon_iphone')) { ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(learn_theme_option('icon_iphone')); ?>">
    <?php } ?>

<?php wp_head(); ?>

</head>

<?php if(learn_theme_option('boxed')) {} ?>

<body <?php if(learn_theme_option('boxed')) { body_class('boxed'); }else{ body_class(); } ?>>
    <div class="wrapper">
        <header class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-5">
                        <a href="<?php echo esc_url( home_url('/') ); ?>">
                            <?php if(learn_theme_option('logo')) { ?>
                            <img src="<?php echo esc_url(learn_theme_option('logo')); ?>" alt="">
                            <?php }else{ ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="">
                            <?php } ?>
                        </a>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-7">
                        <div class="btn-login pull-right">
                             <?php if ( is_user_logged_in() ) { ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','learn'); ?>"><?php _e('<i class="fa fa-user"></i> My Account','learn'); ?></a> / 
                                <a class="logout" href="<?php echo wp_logout_url( home_url() ); ?> " title="<?php _e('Logout','learn'); ?>"><?php _e('Logout','learn'); ?></a>
                             <?php } 
                             else { ?>
                                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','learn'); ?>"><?php _e('<i class="fa fa-user"></i> Login / Register','learn'); ?></a>
                             <?php } ?>
                        </div>
                        <?php echo wp_kses( learn_theme_option('head_text'), wp_kses_allowed_html('post') ); ?>
                    </div>
                </div>
            </div>
        </header><!-- End header -->
        <nav class="top-menu">
            <div class="nav-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="mobnav-btn"></div>
                            <?php
                                $primarymenu = array(
                                'theme_location'  => 'primary',
                                'menu'            => '',
                                'container'       => '',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'sf-menu',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                'walker'          => new learn_Walker_Mega_Menu(),
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                            );
                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( $primarymenu );
                            }
                            ?>
                            
                            <div class="col-md-3 pull-right hidden-sm hidden-xs">
                                <div id="sb-search" class="sb-search">
                                    <form action="<?php echo esc_url(home_url( '/' )); ?>">
                                        <input class="sb-search-input" placeholder="<?php esc_html_e('Enter your search term...', 'learn'); ?>" type="text" value="" name="s" id="search">
                                       
                                        <span class="sb-icon-search"></span>
                                    </form>
                                </div>
                            </div><!-- End search -->
                              
                        </div>
                    </div><!-- End row -->
                </div><!-- End container -->
            </div>
        </nav>
        <?php do_action( 'learn_after_header' ); ?>

