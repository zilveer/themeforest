<?php

/***************************************/
/*			Globalization $woptions
/***************************************/


GLOBAL $webnus_options;

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?><!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="<?php bloginfo('charset');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<title><?php
	
	/***************************************/
	/*			Title Generation Process
	/***************************************/
	if(is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php'))
	{
		
		wp_title( '|', true, 'right' );
			
	}elseif(is_plugin_active('wordpress-seo/wp-seo.php'))
	{
		
		wp_title( '|', true, 'right' );
		
	}else{
		
		global $page, $paged;
		
		wp_title( '|', true, 'right' );
		
		bloginfo( 'name' );
		
		$site_description = get_bloginfo( 'description', 'display' );
		
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page' ,WEBNUS_TEXT_DOMAIN) . ' %s', max( $paged, $page ) );
	}
		/***************************************/
	/*			End Title Generation Process
	/***************************************/
		
		
?></title>

<meta name="author" content="<?php 

if( !is_single() )
	echo get_bloginfo('name');
else {
	global $post;
	
	if(isset($post) && is_object($post))
	{
		
			
		$flname = get_the_author_meta('first_name',$post->post_author). ' ' . get_the_author_meta('last_name',$post->post_author);
		$flname = trim($flname);
		if (empty($flname)) 
			the_author_meta('display_name',$post->post_author);
		else 
			echo $flname;
		
	}
	
}


?>">


	<!-- Mobile Specific Metas
  ================================================== -->
<?php

// $responsive = $webnus_options->webnus_enable_responsive();

if( $webnus_options->webnus_enable_responsive() ){
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } else { ?>
<meta name="viewport" content="width=1200,user-scalable=yes">
<?php } ?>


	<!-- Modernizer
  ================================================== -->

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.11889.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js" type="text/javascript"></script>
	<![endif]-->
		<!-- HTML5 Shiv events (end)-->
	<!-- MEGA MENU -->
 	
	
	<!-- Favicons
  ================================================== -->
<?php if($webnus_options->webnus_fav_icon()): ?>
<link rel="shortcut icon" href="<?php echo $webnus_options->webnus_fav_icon(); ?>">
<?php else: ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<?php endif; ?>

	<!-- CSS + JS
  ================================================== -->
<?php wp_head();  ?>
</head>

<?php
/** Codes for transparent header **/
$transparent_header = '';
if( is_page())
{
GLOBAL $webnus_page_options_meta;
$transparent_header_meta = isset($webnus_page_options_meta)?$webnus_page_options_meta->the_meta():null;
$transparent_header =(isset($transparent_header_meta) && is_array($transparent_header_meta) && isset($transparent_header_meta['webnus_page_options'][0]['webnus_transparent_header']))?$transparent_header_meta['webnus_page_options'][0]['webnus_transparent_header']:null;
}
$transparent_header_class = ($transparent_header=='light')?'transparent-header-w':'';
$transparent_header_class .= ($transparent_header=='dark')?'transparent-header-w t-dark-w':'';
?>
	
<body <?php body_class('default-header '. $transparent_header_class); ?>>

	<!-- Primary Page Layout
	================================================== -->

<div id="wrap" class="colorskin-<?php echo $webnus_options->webnus_color_skin(); ?> <?php echo $webnus_options->webnus_get_layout(); ?>
<?php if ($webnus_options->webnus_header_menu_type() == 6) echo 'vertical-header-enabled'; elseif ($webnus_options->webnus_header_menu_type() == 7) echo 'vertical-toggle-header-enabled'; ?>">

<?php
if( $webnus_options->webnus_toggle_toparea_enable() )
{
?>	
	<section class="toggle-top-area" >
		<div class="w_toparea container">
			<div class="col-md-3">
				<?php dynamic_sidebar('top-area-1'); ?>
			</div>
			<div class="col-md-3">
				<?php dynamic_sidebar('top-area-2'); ?>
			</div>
			<div class="col-md-3">
				<?php dynamic_sidebar('top-area-3'); ?>
			</div>	
			<div class="col-md-3">
				<?php dynamic_sidebar('top-area-4'); ?>
			</div>				
		</div>
		<a class="w_toggle" href="#"></a>
	</section>
<?php
}	


	
  /******************/
 /**  Load Topbar Template
 /******************/

 
 $menu_type = $webnus_options->webnus_header_menu_type();
 
 switch($menu_type)
 {
	case 1:
		get_template_part('parts/topbar'); 
		get_template_part('parts/header1');
	break;
	case 2:
	case 3:
	case 4:
	case 5:
		get_template_part('parts/topbar'); 
		get_template_part('parts/header2');
	break;
	
	
	case 6:
	case 7:
		get_template_part('parts/header3');
	break;
	case 8:
	get_template_part('parts/header4');
	break;
	case 9:
	get_template_part('parts/header2');
	break;
	default: 
		get_template_part('parts/topbar'); 
		get_template_part('parts/header1');
	break;
 }

/***************************************/
/*			If woocommerce available add page headline section.
/***************************************/

if(isset($post) && 'product' == get_post_type( $post->ID ))
{
if( ((function_exists('is_product') && is_product()) && $webnus_options->webnus_woo_product_title_enable()) ){
?>

<section id="headline">
    <div class="container">
      <h3><?php 
	  
	  if( function_exists('is_product') ){
	  
	  if( is_product() )
		echo $webnus_options->webnus_woo_product_title() ;
	  
	  
	  }
	  
	  ?></h3>
    </div>
</section><?php
	}

if((function_exists('is_product') && !is_product()) && $webnus_options->webnus_woo_shop_title_enable())
{?>
	
	<section id="headline">
    <div class="container">
      <h3><?php 
	  
	 
	 
		echo $webnus_options->webnus_woo_shop_title() ;
	  
	 
	  
	  ?></h3>
    </div>
</section>

<?php }
/***************************************/
/*			End woocommerce section
/***************************************/
?>
<section class="container" >
<!-- Start Page Content -->
<hr class="vertical-space">
<?php

}
?>