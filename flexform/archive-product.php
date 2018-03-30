<?php	
	$options = get_option('sf_flexform_options');
	
	$default_page_heading_bg_alt = $options['woo_page_heading_bg_alt'];
	
	$sidebar_config = $options['woo_sidebar_config'];
	$left_sidebar = strtolower($options['woo_left_sidebar']);
	$right_sidebar = strtolower($options['woo_right_sidebar']);
	
	if ($sidebar_config == "") {
		$sidebar_config = 'right-sidebar';
	}
	if ($left_sidebar == "") {
		$left_sidebar = 'woocommerce-sidebar';
	}
	if ($right_sidebar == "") {
		$right_sidebar = 'woocommerce-sidebar';
	}
	
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
?>

<?php get_header('shop'); ?>

<div class="row">
	<div class="page-heading span12 clearfix alt-bg <?php echo $default_page_heading_bg_alt; ?>">
		<h1><?php woocommerce_page_title(); ?></h1>
	</div>
</div>

<?php 
	// BREADCRUMBS
	echo sf_breadcrumbs();
?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<!-- OPEN page -->
	<?php if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) { ?>
	<div <?php post_class('clearfix span8'); ?> id="<?php the_ID(); ?>">
	<?php } else if ($sidebar_config == "both-sidebars") { ?>
	<div <?php post_class('clearfix row'); ?> id="<?php the_ID(); ?>">
	<?php } else { ?>
	<div <?php post_class('clearfix'); ?> id="<?php the_ID(); ?>">
	<?php } ?>
	
		<?php if ($sidebar_config == "both-sidebars") { ?>
			
			<div class="page-content span6">
				<?php do_action( 'woocommerce_archive_description' ); ?>
				
				<?php if ( have_posts() ) : ?>
		
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
		
					<?php woocommerce_product_loop_start(); ?>
		
						<?php woocommerce_product_subcategories(); ?>
		
						<?php while ( have_posts() ) : the_post(); ?>
		
							<?php woocommerce_get_template_part( 'content', 'product' ); ?>
		
						<?php endwhile; // end of the loop. ?>
		
					<?php woocommerce_product_loop_end(); ?>
		
					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>
		
				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
		
					<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
		
				<?php endif; ?>
			</div>
				
			<aside class="sidebar left-sidebar span3">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
		
		<?php } else { ?>
		
		<div class="page-content clearfix">

			<?php do_action( 'woocommerce_archive_description' ); ?>
	
			<?php if ( have_posts() ) : ?>
	
				<?php
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>
	
				<?php woocommerce_product_loop_start(); ?>
	
					<?php woocommerce_product_subcategories(); ?>
	
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
					<?php endwhile; // end of the loop. ?>
	
				<?php woocommerce_product_loop_end(); ?>
	
				<?php
					/**
					 * woocommerce_after_shop_loop hook
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				?>
	
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
	
				<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
	
			<?php endif; ?>
			
		</div>
		
		<?php } ?>	
	
	<!-- CLOSE page -->
	</div>
	
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

<?php get_footer('shop'); ?>