<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
	global $post, $product, $theretailer_theme_options;
	
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	
	//woocommerce_single_product_summary
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
	add_action( 'woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5 );
	add_action( 'woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20 );
	add_action( 'woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30 );
	add_action( 'woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50 );
	
	
	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	
	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );

	// Get category permalink
	$permalinks 	= get_option( 'woocommerce_permalinks' );
	$category_slug 	= empty( $permalinks['category_base'] ) ? _x( 'product-category', 'slug', 'woocommerce' ) : $permalinks['category_base'];
	
	$product_page_has_sidebar = false;
	
	if ((isset($theretailer_theme_options['products_layout'])) && ($theretailer_theme_options['products_layout'] == "1")) {
		$product_page_has_sidebar = true; 
	}
 
	$terms = get_the_terms($post->ID,'product_cat');
	$count = count($terms); $i=0;
			
	if ($terms) {
		foreach ($terms as $term) {
			//if($term->parent==0){
				$i++;
			//}
		}
	}
 
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>	
    
    <?php 
	if ((isset($theretailer_theme_options['breadcrumbs'])) && ($theretailer_theme_options['breadcrumbs'] == "1")) {
	?>	
		<div class="single-product-top">
			
			<?php if ($i >= 1) { ?>
				
				<div class="product_navigation desktops">
					
					<div class="nav-next-single"><?php next_post_link( '%link', '', true, '', 'product_cat' ); ?></div>
					<div class="nav-previous-single"><?php previous_post_link( '%link', '', true, '', 'product_cat' ); ?></div>
					
					<div class="clr"></div>
					
				</div>
			
			<?php } ?>
			
			<?php do_action('woocommerce_before_main_content_breadcrumb'); ?>
		
		</div><!--.single-product-top-->
		 
	<?php } ?>
    
	<?php if ( $product_page_has_sidebar ) : ?>
	
	<div class="grid_9 push_3 product_page_has_sidebar">
		<div class="product_main_infos with_sidebar">
	
	<?php else : ?>
	
		<div class="product_main_infos without_sidebar">	
	
	<?php endif; ?>
	
		
			<?php
				/**
				 * woocommerce_before_single_product hook
				 *
				 * @hooked woocommerce_show_messages - 10
				 */
				 do_action( 'woocommerce_before_single_product' );
			?>    
			
			<div class="grtr_product_header_mobiles">
			
				<span class="product_title entry-title"><?php the_title(); ?></span>
				
				<?php //do_action( 'woocommerce_single_product_summary_single_rating' ); ?>
				
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				
					<p class="price"><?php echo $product->get_price_html(); ?></p>
					
					<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
					<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
				
					<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
				
				</div>
			
			</div>
			
			<div class="gbtr_poduct_details_left_col">
				
				<?php            
				if (isset($theretailer_theme_options['out_of_stock_text'])) {
					$out_of_stock_text = __($theretailer_theme_options['out_of_stock_text'], 'woocommerce');
				} else {
					$out_of_stock_text = __('Out of stock', 'woocommerce');
				}
				?>
				
				<?php if ( (!isset($theretailer_theme_options['catalog_mode'])) || ($theretailer_theme_options['catalog_mode'] == 0) ) : ?>
					<?php if ( !$product->is_in_stock() ) : ?>            
                        <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php echo $out_of_stock_text; ?></div>            
                    <?php endif; ?>
                <?php endif; ?>
				
				
				<?php
					/**
					 * woocommerce_show_product_images hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					if ( (!isset($theretailer_theme_options['catalog_mode'])) || ($theretailer_theme_options['catalog_mode'] == 0) ) {
						do_action( 'woocommerce_before_single_product_summary_sale_flash' );
					}
					do_action( 'woocommerce_before_single_product_summary_product_images' );
					do_action( 'woocommerce_before_single_product_summary' );
				?>
			
			</div>
			
			<div class="gbtr_poduct_details_right_col">
				
				<div class="product_infos summary">
			
					<?php
						do_action( 'woocommerce_single_product_summary_single_title' );
						do_action( 'woocommerce_single_product_summary_single_rating' );
						do_action( 'woocommerce_single_product_summary_single_price' );
						do_action( 'woocommerce_single_product_summary_single_excerpt' );
						if ( (!isset($theretailer_theme_options['catalog_mode'])) || ($theretailer_theme_options['catalog_mode'] == 0) ) {
							do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
						}
						do_action( 'woocommerce_single_product_summary' );
						do_action( 'woocommerce_single_product_summary_single_meta' );
						do_action( 'woocommerce_single_product_summary_single_sharing' );
					?>
			
				</div><!-- .summary -->
			
			</div>
			
			<div class="clr"></div>
		
		</div>
		
		<div class="clr"></div>

		<?php do_action( 'getbowtied_woocommerce_single_product_share' ); ?>
		
		<div class="clr"></div>
	
		<div class="">
		
			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
			?>
		
		</div>
	
<?php if ( $product_page_has_sidebar ) : ?>

	</div><!-- .grid_9-->
	<?php if ( is_active_sidebar( 'widgets_product_listing' ) ) : ?>
	<div class="grid_3 pull_9 product_page_sidebar">
		<div class="gbtr_aside_column_left">
			<?php dynamic_sidebar('widgets_product_listing'); ?>
		</div>
	</div>            
	<?php endif; ?>
			 
<?php endif; ?>     

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
