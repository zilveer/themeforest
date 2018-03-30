<?php get_header(); ?>

	<?php if (of_get_option('home_widgets_location') == 'above') { ?>
	<?php $sb_count = wp_get_sidebars_widgets(); ?>
	<?php if (count( $sb_count['Home_Page']) != '0') { ?>
	<div id="home_widgets_top" class="<?php if (count( $sb_count['Home_Page']) <= '4') { ?>home_widget_count<?php count_sidebar_widgets( 'Home_Page' );?><?php } else { ?>home_widget_overflow<?php } ?>">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home_Page') ) : endif; ?>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<?php } ?>

	<?php /* START PRODUCTS */
	if (of_get_option('affiliate_mode') != 'no' || ! defined( 'CC_VERSION_NUMBER' ) ) { // if affiliate mode is on
		$product_type = 'products';
	} else {
		$product_type = 'cc_product';
	}

	$query_default = new WP_Query( array(
		'orderby'      => 'desc',
		'post_type'    => $product_type,
		'post_status'  => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => ''.stripslashes(of_get_option('home_products_total')).''
	));
	if ( $query_default->have_posts() ) : ?>
	<?php if (of_get_option('subheading_text') != '') { ?>
	<h2 id="latest_products_title"><?php echo stripslashes(of_get_option('subheading_text')); ?></h2>
	<?php } ?>
	<div id="products_grid">
	<?php while ( $query_default->have_posts() ) : $query_default->the_post(); global $more; $more = 0; ?>

		<?php get_template_part( 'loop', 'gridproduct' ); ?>

	<?php endwhile; ?>
		<div class="clear"></div>
	</div> <?php // end #products_grid ?>
	<?php else : // else; no posts

	endif; ?>
	<?php wp_reset_query(); /* END PRODUCTS */ ?>

	<?php if (of_get_option('view_all_products_text') != '') { ?>
	<?php if (of_get_option('store_link') != '') { ?>
	<h3 id="all_products_cta"><a class="all_products_call" href="<?php echo stripslashes(of_get_option('store_link')); ?>" title="<?php _e('All Products', 'designcrumbs'); ?>"><?php echo stripslashes(of_get_option('view_all_products_text')); ?></a></h3>
	<?php } } ?>

	<?php if (of_get_option('home_widgets_location') == 'below') { ?>
	<?php $sb_count = wp_get_sidebars_widgets(); ?>
	<?php if (count( $sb_count['Home_Page']) != '0') { ?>
	<div id="home_widgets" class="<?php if (count( $sb_count['Home_Page']) <= '4') { ?>home_widget_count<?php count_sidebar_widgets( 'Home_Page' );?><?php } else { ?>home_widget_overflow<?php } ?>">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home_Page') ) : endif; ?>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<?php } ?>

<?php get_footer(); ?>