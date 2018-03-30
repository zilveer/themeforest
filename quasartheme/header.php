<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
 
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />





<?php
    /*
     *  Add this to support sites with sites with threaded comments enabled.
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
  
    wp_get_archives('type=monthly&format=link');
	
    wp_head();
?>

</head>
<body <?php body_class(); ?>>

<?php if( xr_get_option('use_boxed_layout',false)): ?>
	<div id="main-canvas">
	    <div>
<?php else : ?>
    <div class="main-container">
<?php endif; ?>

<?php get_template_part('header', 'models'); ?>

<div id="toTop">
	<i class="fa fa-chevron-up to_top_icon"></i>
</div>

<div class="row"><!-- row class removed from here -->
	<div class="large-12 columns">
