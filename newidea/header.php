<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @since newidea 4.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php global $page, $paged , $pages_rel; ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <?php if(newidea_get_options_key('favicon') != "") : ?>
        <link rel="shortcut icon" href="<?php echo newidea_get_options_key('favicon');?>" />
        <?php endif;?>
        <!-- Mobile viewport optimized: j.mp/bplateviewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    	<div class="bg-for-image"></div>
    	<!-- head content for logo,menu,social,search -->
    	<header>
        	<span></span>
        	<div class="container">
				<?php if(intval(newidea_get_options_key('menu-position')) == 0) : ?>
                	<!-- MENU -->
                    <?php echo newidea_get_menus_nav($pages_rel); ?>
                <?php endif; ?>
                
                <?php if(newidea_get_options_key('social-enable') == "on" && intval(newidea_get_options_key('social-position','',false,0)) == 0) : ?>
                     <!-- Social -->
					 <?php echo newidea_get_social(); ?>
                <?php endif; ?>
                
                <?php if(intval(newidea_get_options_key('logo-image-position')) == 0) : ?>
                     <!-- LOGO -->
                     <div id="logo">
                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"></a>
                    </div>
                <?php endif; ?>
            </div>
		</header>