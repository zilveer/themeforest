<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="format-detection" content="telephone=no">

    <?php
    if ( !function_exists( 'has_site_icon' ) || !has_site_icon() ) {
	    $favicon = get_option( 'theme_favicon' );
	    if ( ! empty( $favicon ) ) {
		    ?><link rel="shortcut icon" href="<?php echo $favicon; ?>" /><?php
	    }
    }

    if ( is_singular() && pings_open( get_queried_object() ) ) {
	    ?><link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php
    }

    wp_head();
    ?>
</head>
<body <?php body_class(); ?>>

        <!-- Start Header -->
        <div class="header-wrapper">

            <div class="container"><!-- Start Header Container -->

                <header id="header" class="clearfix">

                    <div id="header-top" class="clearfix">
                        <?php
                        /* WPML Language Switcher */
                        if(function_exists('icl_get_languages')){
                            $wpml_lang_switcher = get_option('theme_wpml_lang_switcher');
                            if($wpml_lang_switcher == 'true'){
                                do_action('icl_language_selector');
                            }
                        }


                        // Currency Switcher
                        get_template_part( 'template-parts/header-currency-switcher' );


                        // header email
                        $header_email = get_option('theme_header_email');
                        if(!empty($header_email)){
                            ?>
                            <h2 id="contact-email">
                                <?php
                                include( get_template_directory() . '/images/icon-mail.svg' );
                                _e('Email us at', 'framework'); ?> : <a href="mailto:<?php echo antispambot($header_email); ?>"><?php echo antispambot($header_email); ?></a>
                            </h2>
                            <?php
                        }
                        ?>

                        <!-- Social Navigation -->
                        <?php  get_template_part('template-parts/social-nav') ;    ?>


                        <?php
                        $enable_user_nav = get_option('theme_enable_user_nav');
                        if( $enable_user_nav == "true" ){
                            ?>
                            <div class="user-nav clearfix">
                                <?php
                                if(is_user_logged_in()){

                                    $profile_url = get_option('theme_profile_url');
                                    $submit_url = get_option('theme_submit_url');
                                    $my_properties_url = get_option('theme_my_properties_url');
                                    $favorites_url = get_option('theme_favorites_url');

                                    if( !empty( $favorites_url ) ) {
                                        ?><a href="<?php echo $favorites_url; ?>"><i class="fa fa-star"></i><?php _e('Favorites','framework'); ?></a><?php
                                    }

                                    if( !empty( $submit_url ) ) {
                                        ?><a href="<?php echo $submit_url; ?>"><i class="fa fa-plus-circle"></i><?php _e('Submit','framework'); ?></a><?php
                                    }

                                    if( !empty( $my_properties_url ) ) {
                                        ?><a href="<?php echo $my_properties_url; ?>"><i class="fa fa-th-list"></i><?php _e('My Properties','framework'); ?></a><?php
                                    }

                                    if( !empty( $profile_url ) ) {
                                        ?><a href="<?php echo $profile_url; ?>"><i class="fa fa-user"></i><?php _e('Profile','framework'); ?></a><?php
                                    } else {
                                        ?><a href="<?php echo network_admin_url( 'profile.php' ); ?>"><i class="fa fa-user"></i><?php _e('Profile','framework'); ?></a><?php
                                    }

                                    ?><a class="last" href="<?php echo wp_logout_url( home_url() ); ?>"><i class="fa fa-sign-out"></i><?php _e('Logout','framework'); ?></a><?php

                                }else{
                                    $theme_login_url = get_option('theme_login_url');
                                    if(!empty($theme_login_url)){
                                        ?>
                                        <a class="last" href="<?php echo $theme_login_url; ?>"><i class="fa fa-sign-in"></i><?php _e('Login / Register','framework'); ?></a>
                                        <?php
                                    }else{
                                        ?>
                                        <a class="last" href="#login-modal" data-toggle="modal"><i class="fa fa-sign-in"></i><?php _e('Login / Register','framework'); ?></a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                    <!-- Logo -->
                    <div id="logo">

                        <?php
                        $logo_path = get_option('theme_sitelogo');
                        if(!empty($logo_path)){
                            ?>
                            <a title="<?php  bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>">
                                <img src="<?php echo $logo_path; ?>" alt="<?php  bloginfo( 'name' ); ?>">
                            </a>
                            <h2 class="logo-heading only-for-print">
                                <a href="<?php echo home_url(); ?>"  title="<?php bloginfo( 'name' ); ?>">
                                    <?php  bloginfo( 'name' ); ?>
                                </a>
                            </h2>
                            <?php
                        }else{
                            ?>
                            <h2 class="logo-heading">
                                <a href="<?php echo home_url(); ?>"  title="<?php bloginfo( 'name' ); ?>">
                                    <?php  bloginfo( 'name' ); ?>
                                </a>
                            </h2>
                            <?php
                        }

                        $description = get_bloginfo ( 'description' );
                        if($description){
                            echo '<div class="tag-line"><span>';
                            echo $description;
                            echo '</span></div>';
                        }
                        ?>
                    </div>


                    <div class="menu-and-contact-wrap">
                        <?php
                        $header_phone = get_option('theme_header_phone');
                        if( !empty($header_phone) ){
						
						    $desktop_version = '<span class="desktop-version">' . $header_phone . '</span>';
                            $mobile_version =  '<a class="mobile-version" href="tel://'.$header_phone.'" title="Make a Call">' .$header_phone. '</a>';

                            echo '<h2  class="contact-number "><i class="fa fa-phone"></i>'.  $desktop_version . $mobile_version .  '<span class="outer-strip"></span></h2>';
						}
                        ?>

                        <!-- Start Main Menu-->
                        <nav class="main-menu">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'main-menu',
                                'menu_class' => 'clearfix'
                            ));
                            ?>
                        </nav>
                        <!-- End Main Menu -->
                    </div>

                </header>

            </div> <!-- End Header Container -->

        </div><!-- End Header -->
