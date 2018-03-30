<?php include(TBI . 'plugins/newsletterForm.php'); ?>
<!DOCTYPE HTML>

<?php
/*
	@package WordPress
	@subpackage The Cause
*/

?>

<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo('charset'); ?>">
<title><?php if (is_home() || is_front_page()) { bloginfo('name'); ?><?php } elseif (is_category() || is_page() ||is_single()) { ?> <?php } ?><?php wp_title(''); ?></title>

<?php $favicon = get_option('tb_favicon', DEFAULT_FAVICON); ?>

<link rel="icon" type="image/png" href="<?php echo $favicon; ?>">

<!-- STYLES -->
<?php get_template_part('tbFonts'); ?>
<link rel="stylesheet" href="<?php echo TEMPLATE_DIRECTORY; ?>/styles/grid960.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php wp_head(); ?>


</head>

<body <?php body_class(); ?>>

<a id="top"></a>

<!-- HEADER -->
<div id="header" class="width100" <?php tb_write_bckg(); ?>>
    <div class="width1000">
        
        <div id="logo"><h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo tb_get_logo(); ?>" alt="<?php bloginfo('name'); ?>"></a></h1></div>
		
    </div>
</div>
<!-- .HEADER -->

<div class="clear"></div>

<!-- CONTENT -->
<div id="contentHolder" class="width100">
    
	<!-- Navigation -->
    <div id="navigationBckg" class="<?php tb_write_bckg('navigation'); ?> width100">
		
        <div id="navigation">
		
		<div class="width1000">
		<?php
			if (has_nav_menu('Navigation')) {
		        wp_nav_menu(
		            array(
		                'theme_location' => 'Navigation', 
		                'container' => false, 
		                'menu_class' => 'navigation',
		                'fallback_cb' => 'tb_default_navigation'
		            )
		        );
			} else {
				tb_default_navigation();
			}
	    ?>
        </div>
		
        </div>
		
    </div>
	<!-- .Navigation -->
        
    <!-- MAIN -->
    <div id="main" class="width100">
	
		<?php
		global $post;
		$postID = $post->ID;
		$mainImageA = get_post_meta($postID, '_main_image', false);
		$mainImage = false;
		foreach ($mainImageA as $tempImg) {
			if (wp_get_attachment_image_src($tempImg)) {
				$mainImage = $tempImg;
				break;
			}
		}
		
		$mainShadow = get_post_meta($postID, '_main_shadow', true);		
		$mainImageArray = tb_get_main_image($mainImage, $mainShadow);
		$sidebarPosition = get_post_meta($postID, '_sidebar_position', true);
		?>
    
        <!-- Slider -->
        <div id="parallaxRevolutionFull"><div>
		
		<?php putRevSlider("full") ?>

        </div></div>
        <!-- .Slider -->
					
        <!-- Content -->
        <div id="content" class="<?php tb_write_bckg('buttons'); ?> <?php tb_write_bckg('buttonsExtra'); ?>  <?php tb_write_bckg('sidebar'); ?> <?php echo tb_get_sidebar_position($sidebarPosition); ?> width1000" style="margin-top: 0 !important;">
		
		<div class="fullWidth">
