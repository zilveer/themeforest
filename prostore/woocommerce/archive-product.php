<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/archive-product.php
 * @sub-package WooCommerce/Templates/product-archive.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php get_header('shop'); ?>

	<?php
		do_action('woocommerce_before_main_content');
	?>

		<h3 class="section-title">
			<?php if ( is_search() ) : ?>
				<?php
					printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
					if ( get_query_var( 'paged' ) )
						printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
				?>
			<?php elseif ( is_tax() ) : ?>
				<?php echo single_term_title( "", false ); ?>
			<?php else : ?>
				<?php
					$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

					echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
				?>
			<?php endif; ?>
		</h3>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( is_tax() ) : ?>
			<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
		<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<?php do_action('woocommerce_before_shop_loop'); ?>

				<?php
					$pcID = "slider" . dechex(time()).dechex(mt_rand(1,65535));
				?>
				<?php woocommerce_product_subcategories(array( 'before' => '<h5 class="product-cat-title">Categories</h5><div class="flexslider product-cat clearfix" id="'.$pcID.'"><ul class="slides clearfix">', 'after' => '</ul></div>')); ?>
				<?php
				$params = array($pcID,'2');
				print_carousel_script($params);			
				?>
				
			<?php do_action('custom_after_archive_description'); ?>
								
			<ul class="products <?php echo $data[$prefix."woocommerce_layout_style"]; ?>">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</ul>

			<?php do_action('woocommerce_after_shop_loop'); ?>

		<?php else : ?>

			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

				<div class="panel"><?php _e( '<em class="icon-info-circle"></em> No products found matching your selection.', 'woocommerce' ); ?></div>

			<?php endif; ?>

		<?php endif; ?>

		<div class="clear"></div>

		<?php
			do_action( 'woocommerce_pagination' );
		?>

	<?php
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer('shop'); ?>