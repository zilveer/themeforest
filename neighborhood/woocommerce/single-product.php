<?php
	/**
	 * The Template for displaying all single products.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/single-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     1.6.4
	 */

	$options = get_option('sf_neighborhood_options');
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['woo_page_heading_bg_alt'];
	$default_sidebar_config = $options['default_product_sidebar_config'];
	$default_left_sidebar = strtolower($options['default_product_left_sidebar']);
	$default_right_sidebar = strtolower($options['default_product_right_sidebar']);

	$show_page_title = sf_get_post_meta($post->ID, 'sf_page_title', true);
	$page_title_one = sf_get_post_meta($post->ID, 'sf_page_title_one', true);
	$page_title_bg = sf_get_post_meta($post->ID, 'sf_page_title_bg', true);
	$no_breadcrumbs = sf_get_post_meta($post->ID, 'sf_no_breadcrumbs', true);

	if ($show_page_title == "") {
		$show_page_title = $default_show_page_heading;
	}
	if ($page_title_bg == "") {
		$page_title_bg = $default_page_heading_bg_alt;
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

	global $has_products, $include_isotope;
	$has_products = true;
	$include_isotope = true;
?>

<?php get_header('shop'); ?>

<?php if (have_posts()) : the_post(); ?>

<?php
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">

	<!-- OPEN article -->
	<?php if ($sidebar_config == "left-sidebar") { ?>
	<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>">
	<?php } elseif ($sidebar_config == "right-sidebar") { ?>
	<article <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<article <?php post_class('clearfix'); ?> id="<?php the_ID(); ?>">
	<?php } ?>

	<?php if ($sidebar_config == "both-sidebars") { ?>
		<div class="page-content span6 clearfix">
	<?php } else if ($sidebar_config == "no-sidebars") { ?>
		<div class="page-content clearfix">
	<?php } else { ?>
		<div class="page-content clearfix">
	<?php } ?>

			<section class="article-body-wrap">

				<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

			</section>

		</div>

		<?php if ($sidebar_config == "both-sidebars") { ?>
		<aside class="sidebar left-sidebar span3">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>
		<?php } ?>

	<!-- CLOSE article -->
	</article>

	<?php if ($sidebar_config == "left-sidebar") { ?>

		<aside class="sidebar left-sidebar span4">
			<?php dynamic_sidebar($left_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "right-sidebar") { ?>

		<aside class="sidebar right-sidebar span4">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>

	<?php } else if ($sidebar_config == "both-sidebars") { ?>

		<aside class="sidebar right-sidebar span3">
			<?php dynamic_sidebar($right_sidebar); ?>
		</aside>

	<?php } ?>

</div>

<?php
	/**
	 * woocommerce_after_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php endif; ?>

<?php get_footer('shop'); ?>