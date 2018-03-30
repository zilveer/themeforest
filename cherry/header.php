<?php
/**
 * The Header for our theme.
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php
	// Detect Yoast SEO Plugin
	if (defined('WPSEO_VERSION')) {
		wp_title('');
	} else {
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
		echo ' | ' . sprintf( __( 'Page %s', 'cherry' ), max( $paged, $page ) );
	}
	?>
</title>

<!-- A little bit of SEO
================================================== -->

<?php if(of_get_option('seo_meta_desc')) { ?>
<meta name="description" content="<?php echo of_get_option('seo_meta_desc'); ?>" />
<?php } ?>

<?php if(of_get_option('seo_meta_keywords')) { ?>
<meta name="keywords" content="<?php echo of_get_option('seo_meta_keywords'); ?>" />
<?php } ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Mobile Specific Metas
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

<?php if (of_get_option('use_favicon')) { ?>
<link rel="shortcut icon" href="<?php  echo of_get_option('favicon_logo'); ?>">
<?php } ?>

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" />

<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
?>

</head>
<body <?php body_class(); ?>>
	
    <?php $layout_style = of_get_option('layout_style'); ?>
	<div id="master-wrapper" class="<?php if ($layout_style == 'boxed') { echo 'boxed-container'; } ?>">
	<div class="top-h-line"></div>
	<div class="container">
        
	<?php
	st_above_header();
	st_header();
	st_below_header();
	
	?>
   
    </div>
    
    <?php
	st_page_headline(); 
	if (of_get_option('header_breadcrumbs')=='yes') {
   		if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
	}
	?>
    
    <div class="clear"></div>
    
    <?php 
	$slideshow_select = of_get_option('slideshow_select'); 
	if ((is_page_template('page-contact.php')) || (is_home() && $slideshow_select == 'camera') || (is_home() && $slideshow_select == 'sequence')  ) { ?> 
    <?php } else { ?>
    <div class="container">
	<?php } ?>
    