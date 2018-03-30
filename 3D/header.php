<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>
<?php global $wpdb;	$prefix = $wpdb->prefix; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta name="description" content="<?php echo get_post_meta($post->ID,'im_theme_seo_description', true); ?>">
	<meta name="keywords" content="<?php echo get_post_meta($post->ID,'im_theme_seo_keywords', true); ?>">
	<meta http-equiv="content-language" content="<?php bloginfo('language'); ?>">
    <?php if(is_single()){ ?>	<meta name="classification" content="<?php $i = 0; foreach((get_the_category()) as $category) { if($i == 0){echo $category->cat_name; $i++;} else {echo ', '.$category->cat_name;} } ?>"><?php } ?>
    
    <?php wp_enqueue_script( '' ); ?>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link rel="shortcut icon" href="<?php echo get_option('im_theme_favicon',true); ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <?php include_once('theme_head.php'); ?>
</head>
<body <?php body_class( 'home' ); ?>>

<!-- Container Start -->
<div class="container_24">




	<!-- Logo -->
    <?php if(is_home()) { ?>
    	<div id="theme-light"></div>
		<div class="theme-back"></div>
    <?php } else { ?>
    	<div id="theme-light-two"></div>
		<div class="theme-back-two"></div>
    <?php } ?>
	
	<!-- Logo -->
	<div class="grid_5 logo">
    	<?php if(get_option('iam_theme_3D_logo')){ ?><a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_option('iam_theme_3D_logo', true); ?>" alt="" /></a><?php } ?>
    </div>
    

    

    
    <!-- Menu -->
    <?php  wp_nav_menu(array(
		  'container'       => 'div', 
		  'container_class' => 'grid_16 menu', 
		  'container_id'    => '',
		  'menu_class'      => 'clearfix', 
		  'menu_id'         => 'nav')); 
  	?>
	<!-- /Menu -->
    
    <!-- Search -->
    <div class="grid_3">
    	<div class="top-search">
    		<form>
    			<input name="s" type="text" value="> SEARCH" onfocus="if(this.value=='> SEARCH')this.value='';" onblur=	"if(this.value=='')this.value='> SEARCH';"/>
    		</form>
    	</div>
    </div>
    <!-- /Search -->
    
    <div class="clear"></div>
    
    
    <?php if(is_home()){ ?>
    <!-- Slider -->
    	<?php include_once('inc/homepage_slider.php'); ?>
    <!-- /Slider -->
    <div class="clear"></div>
    <?php } ?>
   
    
    