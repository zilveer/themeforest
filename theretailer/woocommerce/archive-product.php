<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
 
global $theretailer_theme_options;

global $wp_query;

//woocommerce_before_main_content
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

add_action( 'woocommerce_before_main_content_breadcrumb', 'woocommerce_breadcrumb', 20 );

//woocommerce_before_shop_loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );

$archive_product_sidebar = 'no';

if ( ($theretailer_theme_options['sidebar_listing']) && ($theretailer_theme_options['sidebar_listing'] == 1) ) { $archive_product_sidebar = 'yes'; };

if (isset($_GET["product_listing_sidebar"])) { $archive_product_sidebar = $_GET["product_listing_sidebar"]; }

$category_header_src = "";

if (function_exists('woocommerce_get_header_image_url')) $category_header_src = woocommerce_get_header_image_url();
$description = apply_filters( 'the_content', term_description() );

get_header('shop'); ?>

	<div class="global_content_wrapper">

		<div <?php if ((isset($theretailer_theme_options['category_header_parallax'])) && ($theretailer_theme_options['category_header_parallax'] == "1")) : ?>data-stellar-background-ratio="0.5"<?php endif;?> class="category_header <?php if ( $description ) : ?>with_term_description<?php endif; ?> <?php if ($category_header_src != "") : ?>with_featured_img<?php endif; ?>" style="background-image:url(<?php echo $category_header_src ; ?>)">
			
			<div class="category_header_overlay"></div>
				
			<div class="container_12">
				<div class="grid_10 push_1">
	
					<?php do_action('woocommerce_before_main_content'); ?>
	
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	
						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
	
					<?php endif; ?>
	
					<?php do_action( 'woocommerce_archive_description' ); ?>
					
				</div>
			</div>
			
		</div>
	
	
    <div class="container_12">

        <?php if ($archive_product_sidebar != "yes") { ?>            
        	<div class="grid_12">    
        <?php } else { ?>
        	<div class="grid_9 push_3 shop_with_sidebar">
				
        	
        <?php } ?>
            
            <?php if ($archive_product_sidebar != "yes") { ?>            
           		<div class="listing_products_no_sidebar">           
            <?php } else { ?> 
            	<div class="listing_products">    
            <?php } ?>
        
				<?php do_action( 'woocommerce_before_shop_loop' ); ?>
		
                <div class="catalog_top">
                    
                    <?php
					  
					if ((isset($theretailer_theme_options['breadcrumbs'])) && ($theretailer_theme_options['breadcrumbs'] == "1")) {
						do_action('woocommerce_before_main_content_breadcrumb');
					} else {
						do_action('woocommerce_before_shop_loop_result_count');
					}
					
					do_action( 'woocommerce_before_shop_loop_catalog_ordering' );
					
					//global $woocommerce;

					//$orderby = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
			
					//woocommerce_get_template( 'loop/orderby.php', array( 'orderby' => $orderby ) );
					
					//woocommerce_get_template( 'loop/result-count.php' );
					
					?>
                    
                    <div class="clr"></div>
            
                    <div class="hr shop_separator"></div>
                
                </div>
    
            <?php if ( is_tax() ) : ?>
                <?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>
            <?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
                <?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
            <?php endif; ?>
    
            
			
			<?php if ( have_posts() ) : ?>
                    
                    <?php if (woocommerce_product_subcategories( array( 'before' => '<ul class="products-categories">', 'after' => '</ul><hr class="paddingbottom40" />' ) ) ) : ?><?php endif; ?>
    
                    <?php woocommerce_product_loop_start(); ?>
                    
					<?php while ( have_posts() ) : the_post(); ?>
    
                        
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                       
    
                    <?php endwhile; // end of the loop. ?>
                    
            		<?php woocommerce_product_loop_end(); ?>
                
    
            <?php else : ?>
    
                <?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>
    
                    <p><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
    
                <?php endif; ?>
    
            <?php endif; ?>
    
            <div class="clear"></div>
            
            <?php
			
			if ( $wp_query->max_num_pages > 1 ) {
				if (function_exists("emm_paginate")) {
					emm_paginate();
				}
			}
			 
			?>
    
        
            </div>
        </div>
        
        <?php if ($archive_product_sidebar == "yes") { ?>  
            <?php if ( is_active_sidebar( 'widgets_product_listing' ) ) : ?>
                <div class="grid_3 pull_9">
                    <div class="gbtr_aside_column_left">
                        <?php dynamic_sidebar('widgets_product_listing'); ?>
                    </div>
                </div>            
            <?php endif; ?>
                      
        <?php } ?>           
        
    </div>
    
    </div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer('shop'); ?>
