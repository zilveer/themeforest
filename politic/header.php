<!DOCTYPE html>

<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- Icy Pixels | Powered by WordPress -->

<!-- BEGIN head -->
<head>

	<!-- Basic Page Needs -->
    <title><?php
    if (is_home()) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif(is_page_template('template-home.php')) { bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_single() || is_page()) { single_post_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    elseif (is_search()) { _e('Search Results', 'framework'); echo " ".wp_specialchars($s); }
    elseif (is_category() || is_tag()) { single_cat_title(); echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); }
    else { echo trim(wp_title(' ',false)); }
    ?></title>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
    
    <!-- RSS & Pingbacks -->
   	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php 
    $feed = get_option(' icy_feedburner ');
    if ($feed != '')
    {
        echo get_option(' icy_feedburner ');
    }
    else
    {
        bloginfo('rss2_url');
    } ?>" />
   	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,700,800,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>
    <!-- Theme Hook -->
    <?php wp_head(); ?> 
    
    <!-- html5.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- css3-mediaqueries.js for IE less than 9 -->
    <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
  
</head>
<!-- END head section -->

<body <?php body_class('body-content'); ?>>
<!-- START body -->

<!--START #wrapper -->
<div id="wrapper">

        <!-- START .container -->
        <div class="container header-background">

            <!-- START header .sixteen columns -->
        	<header class="full-width header" style="padding: 0">

                    <!-- START #logo -->
        			<div class="logo no-bottom">
                    <?php 
        					/*
                            If the "plain text logo" is set in theme options -> using text
                            if a logo url has been set in theme options -> using image
        					if none of the above then -> default logo.png */
        					
                            if (get_option('icy_plain_logo') == 'true') { ?>
                            <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                            <?php } elseif (get_option('icy_logo')) { ?>
                            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('icy_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a>
                            <?php } else { ?>
                            <a href="<?php echo home_url(); ?>"><div class="logo-image" title="<?php bloginfo( 'name' ); ?>"></div></a>
                            <?php } ?>
                    
                    <!-- END #logo -->
                    </div>

            <!-- END .social -->
        	</header>
        	<!-- END header -->

        </div>
        <!-- END container -->

            <!-- START nav -->
            <nav class="slider full-width clearfix">
                    
                <?php 
                    wp_nav_menu( array( 
                        'theme_location' => 'main-menu', 
                        'container' => '', 
                        'before' => '',
                    ) ); 
                ?>
                
                <?php if( ( get_option( 'icy_donate_text' ) ) != '' ) : ?>
                    <a class="button donate-btn" href="<?php echo get_option( 'icy_donate_url' ) ?>">
                        <?php echo get_option( 'icy_donate_text' ); ?>
                    </a>
                <?php endif; ?>
                       
            </nav>
            <!-- END nav -->

