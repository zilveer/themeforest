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

    <?php global $icy_options;
    $icy_options = thsp_cbp_get_options_values(); ?>

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
    <link href='http://fonts.googleapis.com/css?family=Lora:700,400italic,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,300italic' rel='stylesheet' type='text/css'>

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

<div class="icy-menu-trigger-wrapper">
    <a href="#" class="icy-menu-trigger"><i class="icon-reorder"></i></a>

    <div id="icy-mobile-menu-wrapper">
        <?php 
            wp_nav_menu( array( 
                'theme_location' => 'main-menu', 
                'container' => '', 
                'before' => '',
            ) ); 
        ?>

    </div>
</div>

<div id="wrapper" class="row-fluid">

   <!-- START header .sixteen columns -->
    <header class="header container clearfix">

        <!-- START #logo -->
        <div class="logo span9">

            <?php 
                global $icy_options;
                
                $logo = '';             
                $logo = $icy_options['logo'];                                
                
                if ( $logo != "" ) { ?>
                <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>"/></a>
                <?php } else { ?>

                <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>

                <?php } ?>
        
        <!-- END #logo -->
        </div>

        <div class="site-description span3">
            <?php $tagline = get_bloginfo('description'); ?>
            <h2><?php echo $tagline; ?></h2>
        </div>

    </header>
    <!-- END header -->