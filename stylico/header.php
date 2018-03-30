<?php
/**
 * 
 * The header template
 *
 */
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html <?php language_attributes(); ?> class="no-js ie ie7">
<![endif]-->
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="no-js ie ie8">
<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="ie no-js"> <!--<![endif]--><head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
 <?php wp_title('|',true,'right'); ?>
 <?php bloginfo('name'); ?>
</title>

<!-- Google Web Fonts Include -->

<!-- CSS Files -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/960.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js" type="text/javascript"></script>

<?php 
wp_head(); 
global $stylico_theme_options;
?>
</head>

<body <?php body_class(); ?>>
   
   <!-- Main Header with Navigation and Logo -->
    <header id="main-header">
        <div class="container_12">
            <a href="<?php echo site_url(); ?>" class="grid_3 alpha" style="margin-top: <?php echo $stylico_theme_options['general']['logo_top']; ?>px;"><img src="<?php echo $stylico_theme_options['general']['logo']; ?>" alt="Logo"></a> 
            <nav id="header-nav" role="navigation" class="grid_9 omega">
                <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => false, 'fallback_cb' => 'stylico_header_nav_fallback' ) ); ?>     
            </nav>
        </div>    
    </header>
    
    <!-- Header Social Bar -->
    <section id="header-bottom" class="container_12">
        <div id="header-socials-menu" class="caontainer_12">
            <?php if(!empty( $stylico_theme_options['general']['facebook_url']) ) : ?>
            <a href="<?php echo $stylico_theme_options['general']['facebook_url']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/stylico/facebook.png" alt="Facebook"></a>
            <?php endif; ?>
            <?php if(!empty( $stylico_theme_options['general']['twitter_url']) ) : ?>
            <a href="<?php echo $stylico_theme_options['general']['twitter_url']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/stylico/twitter.png" alt="Twitter"></a>
            <?php endif; ?>
            <?php if(!empty( $stylico_theme_options['general']['mail_address']) ) : ?>
            <a href="mailto:<?php echo $stylico_theme_options['general']['mail_address']; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/stylico/mail.png" alt="Send Mail"></a>
            <?php endif; ?>
            <a href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/stylico/rss.png" alt="RSS2 Feed"></a>
        </div>
    </section>
    
    <!-- Content Start -->
    <section id="content" class="container_12">
    
        	
