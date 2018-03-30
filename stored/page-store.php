<?php
/*
Template Name: Store
*/
get_header(); ?>
<div class="store-home">
    <?php /* START PRODUCTS */
    global $paged, $wp_query, $wp;
	if  ( empty($paged) ) {
		if ( !empty( $_GET['paged'] ) ) {
			$paged = $_GET['paged'];
		} elseif ( !empty($wp->matched_query) && $args = wp_parse_args($wp->matched_query) ) {
			if ( !empty( $args['paged'] ) ) {
				$paged = $args['paged'];
			}
		}
		if ( !empty($paged) )
			$wp_query->set('paged', $paged);
        }
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if ( !class_exists('Cart66_Cloud') ) { // If not using Cart66 Cloud
		$wp_query->query('paged='.$paged.'&post_type=products&posts_per_page='.stripslashes(of_get_option('products_total')).'');
	} else {
		$wp_query->query('paged='.$paged.'&post_type=cc_product&posts_per_page='.stripslashes(of_get_option('products_total')).'');
	}

	if ( $wp_query->have_posts() ) : ?>

	<div id="products_grid">

	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<?php get_template_part( 'loop', 'gridproduct' ); ?>

	<?php endwhile; ?>

		<div class="clear"></div>
	</div> <?php // end #products_grid ?>
	<div class="navigation">
		<div class="nav-prev"><?php previous_posts_link( __('&laquo; Previous Page', 'designcrumbs')) ?></div>
		<div class="nav-next"><?php next_posts_link( __('Next Page &raquo;', 'designcrumbs')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>
	<h2><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>

	<?php endif; wp_reset_query(); ?>
</div><!-- end .store-home -->

<?php get_footer(); ?>