<?php	
	/**
	 * The Template for displaying all single products.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/single-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.1.2
	 */	
	 
	$options = get_option('sf_dante_options');
	$default_sidebar_config = $options['default_product_sidebar_config'];
	$default_left_sidebar = strtolower($options['default_product_left_sidebar']);
	$default_right_sidebar = strtolower($options['default_product_right_sidebar']);
	
	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
	if (!$options['enable_pb_product_pages']) {
	$pb_active = false;
	}
	
	$sidebar_config = sf_get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(sf_get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(sf_get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	sf_set_sidebar_global($sidebar_config);
		
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
	global $sf_has_products, $sf_include_isotope;
	$sf_has_products = true;
	$sf_include_isotope = true;
?>

<?php get_header('shop'); ?>

<?php if (have_posts()) : the_post(); ?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">

	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<article class="clearfix col-sm-8">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<article class="clearfix col-sm-8">
	<?php } else { ?>
	<article class="clearfix row">
	<?php } ?>
	
	<?php if ($sidebar_config == "both-sidebars") { ?>
		<div class="page-content col-sm-6 clearfix">
	<?php } else if ($sidebar_config == "no-sidebars") { ?>
		<div class="page-content col-sm-12 clearfix">
	<?php } else { ?>
		<div class="page-content clearfix">
	<?php } ?>
										
			<section class="article-body-wrap">
				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>	
			</section>
			
		</div>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
		<aside class="sidebar left-sidebar col-sm-3">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>
		<?php } ?>
	
	<!-- CLOSE article -->
	</article>

	<?php if ($sidebar_config == "left-sidebar") { ?>
			
		<aside class="sidebar left-sidebar col-sm-4">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>
		
		<aside class="sidebar right-sidebar col-sm-4">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
		
	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		<aside class="sidebar right-sidebar col-sm-3">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>
	
	<?php } ?>
			
</div>

<?php endif; ?>

<?php get_footer('shop'); ?>