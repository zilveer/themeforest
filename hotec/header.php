<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <?php if(''!=st_get_setting('site_favicon','')): ?>
    <link rel="shortcut icon" href="<?php echo esc_attr(st_get_setting('site_favicon')); ?>" />
    <?php endif; ?>
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
    <!-- Browser Specical Files -->
     <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

   <div class="body-outer-wrapper">
    <div class="body-wrapper <?php echo st_boxed_class(); ?>">
        
        <header id="header" class="header-container-wrapper">

            <div class="top-bar-outer-wrapper">
                <div class="top-bar-wrapper container">
                    <div class="row">
                        <div class="top-bar-left left">
                             <a href="#" id="top-nav-mobile-a" class="top-nav-close">
                                <span></span>
                            </a>
                            <nav id="top-nav-mobile"></nav>
                            
                            <nav id="top-nav-id" class="top-nav slideMenu">
                                <ul>
                                <?php
                                    $defaults = array(
                                            'theme_location'  => 'Topbar_Navigation',
                                            'container'       => false,
                                            'menu_class'      => 'menu',
                                            'echo'            => true,
                                            'items_wrap'=>'%3$s',
                                         );
                                    wp_nav_menu( $defaults );
                                ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="top-bar-right right">
                          <?php dynamic_sidebar('top_bar_right'); ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .top-bar-wrapper -->
            </div> <!-- END .top-bar-outer-wrapper -->
            <div class="header-outer-wrapper">
                <div class="header-wrapper container">
                    <div class="row">
                        <div class="twelve columns b0">
                            <div class="header-left left">
                                <div class="logo-wrapper">
                                    <h1><a href="<?php echo home_url(); ?>">
                                    <?php if(st_get_setting("site_logo")!=''): ?>
                                    <img src="<?php echo esc_attr(st_get_setting("site_logo")); ?>" alt="<?php  bloginfo('name'); ?>"/></a>
                                    <?php else: ?>
                                     <span class="no-logo"><?php bloginfo('name'); ?></span>
                                    <?php  endif; ?>
                                    </h1>
                                </div>
                            </div>
                            <div class="header-right right">
                                <a href="#" id="primary-nav-mobile-a" class="primary-nav-close">
                                    <span></span>
                                    <?php _e('Main Navigation','smooththemes'); ?>
                                </a>
                                <nav id="primary-nav-mobile"></nav>
                            
                                 <?php st_head_reservation_btn(); ?>
                                <nav id="primary-nav-id" class="primary-nav slideMenu">
                                    <ul>
                                     <?php 
                                        $defaults = array(
                                        	'theme_location'  => 'Primary_Navigation',
                                        	'container'       => false,
                                            'container_class' => false,
                                            'items_wrap'=>'%3$s',
                                        	'echo'            => true
                                        );
                                       wp_nav_menu( $defaults );
                                        ?>
                                       </ul>
                                </nav>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div><!-- END .header-wrapper -->
            </div><!-- END .header-outer-wrapper -->
        </header> <!-- END .header-container-wrapper -->
