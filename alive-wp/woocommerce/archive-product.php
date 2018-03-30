<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @package WooCommerce
 * @since WooCommerce 1.0
 * @todo replace loop-shop with a content template and include query/loop here instead.
 */

get_header('shop'); ?>
	  
	<?php 
		/** 
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */	 
		do_action('woocommerce_before_main_content');
	?>

		<h1 class="pageHeading">
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
		</h1>
				
		<?php if ( is_tax() && get_query_var( 'paged' ) == 0 ) : ?>
			<?php echo '<div class="term-description">' . wpautop( wptexturize( term_description() ) ) . '</div>'; ?>
		<?php elseif ( ! is_search() && get_query_var( 'paged' ) == 0 && ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php echo '<div class="page-description">' . apply_filters( 'the_content', $shop_page->post_content ) . '</div>'; ?>
		<?php endif; ?>
				
		<?php if ( have_posts() ) : ?>
		
			<?php do_action('woocommerce_before_shop_loop'); ?>
			<?php 
				$item_count = 0;
				$items_per_page = (of_get_option("shop_products") == "") ? 6 : of_get_option("shop_products");
			?>
			<div id="productContainer" class="container">
				<ul class="contentPaginate">
			
				<?php theme_woocommerce_product_subcategories(); ?>
		
				<?php while ( have_posts() ) : the_post(); ?>
					<?php 
					if ($item_count == 0) {
						echo '<li><ul class="products">';
					}
					?>
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
					<?php 
						$item_count++;
						if ($item_count == $items_per_page) {
							echo '</ul></li>';
							$item_count = 0;		
						}
					?>
				<?php endwhile; // end of the loop. ?>
				<?php if ($item_count != $items_per_page) {
							echo '</ul></li>';		
						}
					?>
				</ul>
				<div class="page_navigation"></div>
			</div>

			<?php do_action('woocommerce_after_shop_loop'); ?>
		
		<?php else : ?>
		
			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
					
				<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
					
			<?php endif; ?>
		
		<?php endif; ?>
		
		<div class="clear"></div>

		<?php 
			/** 
			 * woocommerce_pagination hook
			 *
			 * @hooked woocommerce_pagination - 10
			 * @hooked woocommerce_catalog_ordering - 20
			 */		
			do_action( 'woocommerce_pagination' ); 
		?>

	<?php
		/** 
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */	 
		do_action('woocommerce_after_main_content'); 
	?>

	<?php 
		/** 
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */		
		do_action('woocommerce_sidebar'); 
	?>

<?php get_footer('shop'); ?>