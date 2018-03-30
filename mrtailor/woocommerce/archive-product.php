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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $mr_tailor_theme_options;

$category_header_src = "";

if (function_exists('woocommerce_get_header_image_url')) $category_header_src = woocommerce_get_header_image_url();

get_header('shop');

	$shop_page_has_sidebar = false;
	
	if ( (isset($mr_tailor_theme_options['shop_layout'])) && ($mr_tailor_theme_options['shop_layout'] == "0" ) ) {
		
		$shop_page_has_sidebar = false; 
	
	} else {
	
		if ( is_active_sidebar( 'catalog-widget-area' ) ){
			$shop_page_has_sidebar = true;
		}
	
	}

if ( is_shop() && get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_title_meta_box_check', true ) ) {
    $page_title_option = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_title_meta_box_check', true );
} else {
    $page_title_option = "off";
}


?>
	<div id="primary" class="content-area catalog-page <?php echo $shop_page_has_sidebar ? 'with-sidebar' : 'without-sidebar'; ?>">
        
        <div class="category_header <?php if ($category_header_src != "") : ?>with_featured_img<?php endif; ?>" <?php if ($category_header_src != "") : ?>style="background-image:url(<?php echo $category_header_src ; ?>)<?php endif; ?>">
        
            <div class="category_header_overlay"></div>
            
            <div class="row">
                <div class="large-8 large-centered columns">

                    <?php do_action('woocommerce_before_main_content'); ?>

                    <?php if ( $page_title_option == "off" ) : ?>

                        <h1 class="page-title shop_page_title"><?php woocommerce_page_title(); ?></h1>

                    <?php endif; ?>

                    <?php do_action( 'woocommerce_archive_description' ); ?>
					
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="large-12 columns">        

                <div id="content" class="site-content" role="main">
                        					
                        <?php 
                        // Find the category + category parent, if applicable
                        $term 			= get_queried_object();
                        $parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
                        $categories 	= get_terms('product_cat', array('hide_empty' => 0, 'parent' => $parent_id));
                        ?>
                    
                        <?php
                    
                        $show_categories = FALSE;

                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == '') ) $show_categories = FALSE;
                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'products') ) $show_categories = FALSE;
                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_categories = TRUE;
                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'both') ) $show_categories = TRUE;
                        
                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == '') ) $show_categories = FALSE;
                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'products') ) $show_categories = FALSE;
                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_categories = TRUE;
                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'both') ) $show_categories = TRUE;

                        if ( is_product_category() && (get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'products') ) $show_categories = FALSE;
                        if ( is_product_category() && (get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'subcategories' ) ) $show_categories = TRUE;
                        if ( is_product_category() && (get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'both') ) $show_categories = TRUE;
						
						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_categories = FALSE;

                        //echo "Shop Page Display: " . get_option('woocommerce_shop_page_display') . "<br />";                        
                        //echo "Default Category Display: " . get_option('woocommerce_category_archive_display') . "<br />";
                        //echo "Display type (edit product category): " . get_woocommerce_term_meta($term->term_id, 'display_type', true) . "<br />";
                    
                        ?>
                    
                        <?php if (!is_paged()) : //show categories only on first page ?>
						
							<?php if ($show_categories == TRUE) : ?>
    
                                <?php if ($categories) : ?>
                                
                                <div class="row">
                                    <div class="categories_grid">
                                        
                                        <?php $cat_counter = 0; ?>
                                        
                                        <?php $cat_number = count($categories); ?>
                                        
                                        <?php foreach($categories as $category) : ?>
                                            
                                            <?php                        
                                                $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
                                                $image = wp_get_attachment_url( $thumbnail_id );
                                                $cat_class = "";
                                            ?>
                                        
                                            <?php
                                        
                                                if (is_shop() && get_option('woocommerce_shop_page_display') == 'both') $cat_class = "original_grid";
                                                if (is_product_category() && get_option('woocommerce_category_archive_display') == 'both') $cat_class = "original_grid";
                                                
                                                if (is_product_category() && get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'products') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'subcategories') $cat_class = "";
                                                if (is_product_category() && get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'both') $cat_class = "original_grid";
    
                                            ?>
                                            
                                            <?php 
                                                if($cat_class != "original_grid") 
                                                {
                                                    $cat_counter++;                                        
    
                                                    switch ($cat_number) {
                                                        case 1:
                                                            $cat_class = "one_cat_" . $cat_counter;
                                                            break;
                                                        case 2:
                                                            $cat_class = "two_cat_" . $cat_counter;
                                                            break;
                                                        case 3:
                                                            $cat_class = "three_cat_" . $cat_counter;
                                                            break;
                                                        case 4:
                                                            $cat_class = "four_cat_" . $cat_counter;
                                                            break;
                                                        case 5:
                                                            $cat_class = "five_cat_" . $cat_counter;
                                                            break;
                                                        default:
                                                            if ($cat_counter < 7) {
                                                                $cat_class = $cat_counter;
                                                            } else {
                                                                $cat_class = "more_than_6";
                                                            }
                                                    }
                                                    
                                                }
                                            ?>
                                            
                                            <div class="category_<?php echo $cat_class; ?>">
												<div class="category_grid_box">
													<span class="category_item_bkg" style="background-image:url(<?php echo $image; ?>)"></span> 
													<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="category_item">
														<span class="category_name"><?php echo $category->name; ?></span>
													</a>
												</div>
											</div>
                                        
                                        <?php endforeach; ?>
                                        
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>
                                
                                <?php endif; ?>
                            
                            <?php endif; ?>
                        
                        <?php endif; ?>
                                    
                        <?php
                    
                        $show_products = TRUE;

                        if ( is_shop() && (get_option('woocommerce_shop_page_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_option('woocommerce_category_archive_display') == 'subcategories') ) $show_products = FALSE;

                        if ( is_product_category() && (get_woocommerce_term_meta($term->term_id, 'display_type', true) == 'subcategories' ) ) $show_products = FALSE;
						
						if ( isset($_GET["s"]) && $_GET["s"] != '' ) $show_products = TRUE;
                    
                        ?>
                        
                        <?php if ($show_products == TRUE) : ?>
                
							<?php if ( have_posts() ) : ?>
							
								<style>
									.categories_grid { margin-bottom: 0; }
								</style>
								
                                <div class="catalog_top row">
                                    <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                                </div>
                                
                                <div class="row">
                                    <div class="large-12 columns">
                                        <hr class="catalog_top_sep" />
                                    </div><!-- .columns -->
                                </div>
                    
								<div class="row">
									
									<?php if ($shop_page_has_sidebar) : ?>
										
									<div class="large-3 columns show-for-large-up">
										<div class="shop_sidebar wpb_widgetised_column">
											<?php dynamic_sidebar('catalog-widget-area'); ?>
										</div>
									</div>
									
									<div class="large-9 columns">
											
									<?php else : ?>
										
									<div class="large-12 columns">
									
									<?php endif; ?>
						
										<div class="active_filters_ontop"><?php the_widget( 'WC_Widget_Layered_Nav_Filters', 'title=' ); ?></div>
						
										<?php woocommerce_product_loop_start(); ?>            
											<?php while ( have_posts() ) : the_post(); ?>                            
												<?php woocommerce_get_template_part( 'content', 'product' ); ?>                            
											<?php endwhile; // end of the loop. ?>                            
										<?php woocommerce_product_loop_end(); ?>
										
										<div class="woocommerce-after-shop-loop-wrapper">
											<?php do_action( 'woocommerce_after_shop_loop' ); ?>
										</div>
										
									</div><!-- .columns -->
								</div><!--.row-->
								
                            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
                    
								 <?php if (!is_paged()) : //show categories only on first page ?>
									<?php if ($show_categories == TRUE) : ?>
										<?php if ($categories) : ?>
											<style>
												.no-products-info { margin-top: -34px; }
												
												/* min-width 641px, medium screens */
												@media only screen and (min-width: 40.063em) {
													.no-products-info { margin-top: -156px; }
												}
											</style>
										<?php endif; ?>
									<?php endif; ?>
								<?php endif; ?>
								
                                <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
                    
                            <?php endif; ?>
                        
                        <?php endif; ?>
                
                    <?php do_action('woocommerce_after_main_content'); ?>
    
    			</div><!-- #content -->           
            </div><!-- .columns -->        
        </div><!-- .row -->
    </div><!-- #primary -->

<?php get_footer('shop'); ?>