<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

    <head>

        <!-- GENERAL HEADER -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

        <!-- THEME OPTIONS -->
        <?php $canon_options = get_option('canon_options'); ?>
        <?php $canon_options_homepage = get_option('canon_options_homepage'); ?>

        <!-- DYNAMIC HEADER -->
        <?php get_template_part('inc/templates/dynamic_header'); ?>

        <!-- WORDPRESS MAIN HEADER CALL -->
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(get_canon_theme_body_classes());?>>
    
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
        
        
        <!-- DYNAMIC CSS -->
        <?php get_template_part('inc/templates/dynamic_css'); ?>

        <!-- CONSTRUCTION MODE -->
        <?php 

            // DEFAULTS FAILSAFE
            if (!isset($canon_options['use_construction_mode'])) { $canon_options['use_construction_mode'] = "unchecked"; }
            if (!isset($canon_options['construction_msg'])) { $canon_options['construction_msg'] = "This site is under construction!"; }

            if ( ($canon_options['use_construction_mode'] == "checked") && (is_page_template('page-placeholder.php') === false) && (is_user_logged_in() === false) ) {
                exit("<div class='construction_msg'><h1>". $canon_options['construction_msg'] ."</h1></div>"); 
            }

        ?>

        <!-- HEADER -->
        <?php
            
            if ( (is_page_template('page-placeholder.php') === false) || (is_page_template('page-placeholder.php') === true && is_user_logged_in() === true) ) { 
            ?>

                <!-- sticky-header-wrapper -->
                <div class="sticky-header-wrapper">

                    <!-- Start Outter Wrapper -->
                    <div class="outter-wrapper header-container">
                        <!-- Start Main Navigation -->
                        <div class="wrapper">

                            <header class="clearfix">

                                <div id="header_logo">
                                    <?php 
                                        if (!empty($canon_options['logo_text'])) {
                                            echo '<a href="'. home_url() .'" class="logo-text">';
                                            echo $canon_options['logo_text'];
                                            echo '</a>';
                                        } elseif (!empty($canon_options['logo_url'])) {
                                            echo '<a href="'. home_url() .'" class="logo"><img src="'. $canon_options['logo_url'] .'" alt="Logo"></a>';
                                        } else {
                                            echo '<a href="'. home_url() .'" class="logo"><img src="'. get_template_directory_uri() .'/img/logo@2x.png" alt="Logo"></a>';
                                        }
                                    ?>
                                </div>

                                <!-- WORDPRESS GENERATED -->
                                <?php wp_nav_menu(array( 
                                    'theme_location'     => 'main_navigation_menu',
                                    'menu_id'           => 'nav',
                                    'menu_class'        => 'nav',
                                    'container'         => 'nav',
                                    'container_class'   => '',
                                    'container_id'      => 'nav-wrap',
                                    'show_home'         => '1'
                                    ));
                                ?>

                            </header>

                        </div>
                        <!-- End Main Navigation -->
                    </div>
                    <!-- End Outter Wrapper --> 

                </div>
                <!-- end sticky-header-wrapper -->


            <?php
            }
        
        ?>

