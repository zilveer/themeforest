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
 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
    global $post, $product, $mr_tailor_theme_options;

    //woocommerce_before_single_product
	//nothing changed
	
	//woocommerce_before_single_product_summary
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	
	add_action( 'woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10 );
	add_action( 'woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20 );
	
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
	
	//woocommerce_after_single_product_summary
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	
	add_action( 'woocommerce_after_single_product_summary_data_tabs', 'woocommerce_output_product_data_tabs', 10 );

	//woocommerce_after_single_product
	//nothing changed

	//custom actions
	add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	
	$product_page_has_sidebar = false;
	
	if ( (isset($mr_tailor_theme_options['products_layout'])) && ($mr_tailor_theme_options['products_layout'] == "0" ) ) {
		
		$product_page_has_sidebar = false;
	
	} else {
	
		$product_page_has_sidebar = true;
	
	}
	
?>

<?php do_action( 'woocommerce_before_main_content_breadcrumb' ); ?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <div class="large-12 columns">
    
            <?php do_action( 'woocommerce_before_single_product' ); ?>
    
            <div class="product_summary_top">
            <?php
                do_action( 'woocommerce_single_product_summary_single_title' );
                do_action( 'woocommerce_single_product_summary_single_rating' );
                
                if ( post_password_required() ) {
                    echo get_the_password_form();
                    echo '</div></div></div></div>';
                    return;
                }
            ?>
            </div>
    
        </div><!-- .columns -->        
    </div><!-- .row -->

	
	<?php if ( $product_page_has_sidebar ) : ?>
	
	<div class="single-product with-sidebar">
	
		<div class="row">
						   
			<div class="large-3 columns show-for-large-up">
				<div class="wpb_widgetised_column">
					<?php dynamic_sidebar('catalog-widget-area'); ?>
				</div>
			</div>
			
			<div class="large-9 columns">
				
				<div class="row">
					
					<div class="large-7 large-push-0 medium-8 medium-push-2 columns">
			
						<?php				
							if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) {
								do_action( 'woocommerce_before_single_product_summary_sale_flash' );
							}
							do_action( 'woocommerce_before_single_product_summary_product_images' );
							do_action( 'woocommerce_before_single_product_summary' );
						?>
						
						<?php            
						if (isset($mr_tailor_theme_options['out_of_stock_text'])) {
							$out_of_stock_text = __($mr_tailor_theme_options['out_of_stock_text'], 'woocommerce');
						} else {
							$out_of_stock_text = __('Out of stock', 'woocommerce');
						}
						?>
						
						<?php if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) : ?>
							<?php if ( !$product->is_in_stock() ) : ?>            
                                <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php echo $out_of_stock_text; ?></div>            
                            <?php endif; ?>
                        <?php endif; ?>
						
						<div class="product_summary_thumbnails_wrapper with-sidebar">
							<div><?php do_action( 'woocommerce_product_summary_thumbnails' ); ?></div>
						</div><!-- .product_summary_thumbnails_wrapper-->
						
					</div><!-- .columns -->
					
					<div class="large-5 large-push-0 columns">
					
						<div class="product_infos">
							
							<?php
								do_action( 'woocommerce_single_product_summary_single_price' );
								do_action( 'woocommerce_single_product_summary_single_excerpt' );
								if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) {
									do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
								}
								do_action( 'woocommerce_single_product_summary' );
							?>
							
						</div>
			
					</div><!-- .columns -->
				
				</div><!--.row-->
				
				<div class="row">
					<div class="large-12 large-uncentered columns">
						<?php
							do_action( 'woocommerce_after_single_product_summary_data_tabs' );
							
							do_action( 'woocommerce_single_product_summary_single_meta' );
							do_action( 'woocommerce_single_product_summary_single_sharing' );
							
							do_action( 'woocommerce_after_single_product_summary' );
						?>
				
						<div class="product_navigation">
							<?php mr_tailor_product_nav( 'nav-below' ); ?>
						</div>
				
					</div><!-- .columns -->
				</div><!-- .row -->
			
			</div><!--.large-9-->
		
		</div><!--.row-->
	
	</div><!--.single-product .with-sidebar-->
		
	<?php else : ?>
					  
	<div class="single-product without-sidebar">				  
					  
		<div class="row">				  
						 
			<div class="large-1 columns product_summary_thumbnails_wrapper without_sidebar">
				<div><?php do_action( 'woocommerce_product_summary_thumbnails' ); ?>&nbsp;</div>
			</div><!-- .columns -->
			
			<div class="large-5 large-push-0 medium-8 medium-push-2 columns">
	
				<?php				
					if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) {
						do_action( 'woocommerce_before_single_product_summary_sale_flash' );
					}
					do_action( 'woocommerce_before_single_product_summary_product_images' );
					do_action( 'woocommerce_before_single_product_summary' );
				?>
				
				<?php            
				if (isset($mr_tailor_theme_options['out_of_stock_text'])) {
					$out_of_stock_text = __($mr_tailor_theme_options['out_of_stock_text'], 'woocommerce');
				} else {
					$out_of_stock_text = __('Out of stock', 'woocommerce');
				}
				?>
				
				<?php if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) : ?>
					<?php if ( !$product->is_in_stock() ) : ?>            
                        <div class="out_of_stock_badge_single <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php echo $out_of_stock_text; ?></div>            
                    <?php endif; ?>
                <?php endif; ?>
				
				&nbsp;
				
			</div><!-- .columns -->
			
			<?php

			if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
				$viewed_products = array();
			else
				$viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

			if ( ! in_array( $post->ID, $viewed_products ) ) {
				$viewed_products[] = $post->ID;
			}

			if ( sizeof( $viewed_products ) > 4 ) {
				array_shift( $viewed_products );
			}
			
			?>
			
			<?php if ( empty( $viewed_products ) ) : ?>
				<div class="large-6 large-push-0 columns">
			<?php  else : ?>
			
				<?php if ( (!isset($mr_tailor_theme_options['recently_viewed_products'])) || ($mr_tailor_theme_options['recently_viewed_products'] == "1" ) ) : ?>
					<div class="large-5 large-push-0 columns">
				<?php  else : ?>
					<div class="large-6 large-push-0 columns">
				<?php endif; ?>
			
			<?php endif; ?>
			
				<div class="product_infos">
					
					<?php
						do_action( 'woocommerce_single_product_summary_single_price' );
						do_action( 'woocommerce_single_product_summary_single_excerpt' );
						if ( (isset($mr_tailor_theme_options['catalog_mode'])) && ($mr_tailor_theme_options['catalog_mode'] == 0) ) {
							do_action( 'woocommerce_single_product_summary_single_add_to_cart' );
						}						
						do_action( 'woocommerce_single_product_summary' );
					?>
				
				</div>
	
			</div><!-- .columns -->
			
			<?php if ( !empty( $viewed_products ) ) : ?>
			<?php if ( (!isset($mr_tailor_theme_options['recently_viewed_products'])) || ($mr_tailor_theme_options['recently_viewed_products'] == "1" ) ) : ?>
			<div class="large-1 columns recently_viewed_in_single_wrapper">
			
				<div class="recently_viewed_in_single">
					
					<?php include_once('single-product/recently-viewed.php'); ?>
					
				</div>
			
			</div><!-- .columns -->
			<?php endif; ?>
			<?php endif; ?>
				   
		</div><!-- .row -->
			
		<div class="row">
			<div class="large-12 large-uncentered columns">
				<?php
					do_action( 'woocommerce_after_single_product_summary_data_tabs' );
					
					do_action( 'woocommerce_single_product_summary_single_meta' );
					do_action( 'woocommerce_single_product_summary_single_sharing' );
					
					do_action( 'woocommerce_after_single_product_summary' );
				?>
				
				<div class="product_navigation">
					<?php mr_tailor_product_nav( 'nav-below' ); ?>
				</div>
				
			</div><!-- .columns -->
		</div><!-- .row -->
    
	</div><!--.single-product .without-sidebar-->
	
	<?php endif; ?>
	
    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>