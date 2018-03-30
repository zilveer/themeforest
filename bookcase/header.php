<?php
/**
 * The Theme Header
 * @package WordPress
 * @subpackage Bookcase
 * @since Bookcase 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php 
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ellipsis' ), max( $paged, $page ) );

	?>
</title>
<!-- Embed Google Web Fonts Via API -->
<script type="text/javascript">
      WebFontConfig = {
        google: { families: [ '<?php if ( $h1font = get_option('of_heading_font') ) { echo $h1font; } else { echo 'Open Sans'; $h1font = 'Open Sans';} ?>', '<?php if ( $h2font = get_option('of_secondary_font') ) { echo $h2font; } else { echo 'Open Sans'; $h2font = 'Open Sans';} ?>', '<?php if ( $pfont = get_option('of_p_font') ) { echo $pfont; } else { echo 'Open Sans'; $pfont = 'Open Sans';} ?>', '<?php if ( $tinyfont = get_option('of_tiny_font') ) { echo $tinyfont; } else { echo 'Droid Serif'; $navfont = 'Droid Serif';} ?>'] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
    </script>
<!-- Embed Google Web Fonts Via API -->
<?php if ($themeskin = get_option('of_theme_skin') ) { if ($themeskin == 'Dark') { ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/dark.css" rel="stylesheet" type="text/css" media="all" />
<?php } elseif ($themeskin == 'Light') { ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/light.css" rel="stylesheet" type="text/css" media="all" />
<?php } } else { ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/light.css" rel="stylesheet" type="text/css" media="all" />
<?php } ?>
<!--Skin -->
<link href="<?php bloginfo( 'stylesheet_url' ); ?>" rel="stylesheet" type="text/css" media="all" />
<!--Site Layout -->
<?php wp_head(); ?>
<!-- User-Defined Styles -->
<link rel="stylesheet" href="<?php echo home_url();?>/index.php?ag_custom_var=css" type="text/css" />
<!-- User-Defined Styles -->
</head>
<body <?php body_class(); ?>>
<div id="preloaded-images"> <img src="<?php echo get_template_directory_uri();?>/images/loading.gif" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/loading-dark.gif" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/xout.gif" width="1" height="1" alt="Image 01" /> <img src="<?php echo get_template_directory_uri();?>/images/comment-icon.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/tag-icon.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/calendar-icon.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/bubble-light.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/bubble-dark.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/bubble-light-dark.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/bubble-dark-dark.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/play.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/uparrow.png" width="1" height="1" alt="Image" /> <img src="<?php echo get_template_directory_uri();?>/images/downarrow.png" width="1" height="1" alt="Image" /> </div>
</noscript>
<div class="logonav">
    <div class="logo">
        <h1><a href="<?php echo home_url(); ?>">
            <?php if ( $logo = get_option('of_logo') ) { ?>
            <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
            <?php } else { bloginfo( 'name' );} ?>
            </a> </h1>
    </div>
    <?php  if ($tagline = get_option('of_site_tagline')) { echo '<div class="description"><h4>'.$tagline.'</h4></div>'; } ?>
    <div class="nav">
        <?php if ( has_nav_menu( 'top_nav_menu' ) ) { /* if menu location 'Top Navigation Menu' exists then use custom menu */ ?>
        <?php wp_nav_menu( array('menu' => 'Top Navigation Menu', 'menu_class' => 'sf-menu sf-vertical')); ?>
        <?php } else { /* else use wp_list_pages */?>
        <ul class="sf-menu sf-vertical">
            <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order')); ?>
        </ul>
        <?php } ?>
    </div>
    <div class="clear"></div>
    <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Below Navigation') ) ?>
</div>
<div class="top"> <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/scroll-top.png" alt="Scroll to Top"/></a>
    <div class="clear"></div>
    <div class="scroll">
        <p><?php _e('To Top', 'framework'); ?></p>
    </div>
</div>
<!--End Header-->
