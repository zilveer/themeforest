<?php
/*
 * Peekaboo Header
 */
global $smof_data;
?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->

<!-- Head begin -->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title(); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width" />

	<!-- Feed -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<!--  iPhone Web App Home Screen Icon -->
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/devices/icon-ipad.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/devices/icon-retina.png"/>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/devices/icon.png"/>

<?php wp_head(); ?>

</head>

<body <?php body_class('antialiased'); ?>>

<!-- Content Wrapper begin -->
<div id="content-wrapper">

    <!-- Container begin -->
    <div id="container" class="container">

        <!-- Header begin -->
        <div id="header" class=" ">
            <div class="row">

                <div class="large-3 small-12 columns">

                    <!-- Logo begin -->
                    <div id="logo">
                        <a href="<?php echo home_url('/'); ?>"
                           title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                            <img src="<?php /* Use the default logo (logo.png) if custom logo does not exist */
                            if ($smof_data['pkb_custom_logo']) : echo $smof_data['pkb_custom_logo']; else: echo get_template_directory_uri();?>/img/logo.png<?php endif; ?>"
                                 alt=" logo"/>
                        </a>
                    </div>
                    <!-- Logo end -->
                </div>
                <div class="large-8 large-offset-1 small-12 columns main-nav">

                    <!-- Navigation -->
                    <div class="contain-to-grid <?php if ($smof_data['pkb_sticky_nav'] == 1) {
                        echo 'sticky';
                    } ?>">

                        <!-- Starting the Top-Bar -->
                        <nav class="top-bar" data-topbar>
                            <ul class="title-area">
                                <li class="name"></li>
                                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                                <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
                            </ul>
                            <section class="top-bar-section">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'container' => false,
                                    'depth' => 0,
                                    'items_wrap' => '<ul class="left">%3$s</ul>',
                                    'fallback_cb' => 'peekaboo_menu_fallback', // workaround to show a message to set up a menu
                                    'walker' => new peekaboo_walker(array(
                                        'in_top_bar' => true,
                                        'item_type' => 'li'
                                    )),
                                ));
                                ?>
                                <?php include 'incl/social-toolbox.php'; ?>

                            </section>
                        </nav>
                        <!-- End of Top-Bar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header end -->

        <?php if (is_page_template('page-home.php')) {
            if ($smof_data['pkb_slide_type'] == 'orbit') {
                include 'incl/slide-home.php'; // Orbit slider
            } else {
                include 'incl/slide-flexslider.php'; // Flexslider
            }
        } // Get slide if it is Home Page ?>
        <?php if (is_page_template('page-home.php')) {
            include 'incl/quick-menu.php';
        } // Get slide if it is Home Page ?>