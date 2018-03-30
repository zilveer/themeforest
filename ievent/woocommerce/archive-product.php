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
 
$ievent_data =  ievent_globals();
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' ); ?>
	<?php
	$content_class = '';
	$sidebar_class = '';
		if( $ievent_data['woo_layout'] == 'no-sidebar' ) {
			$content_class = 'has-no-sidebar';
			$sidebar_class = 'no-sidebar';
			$set_content_width ='';
		} elseif( $ievent_data['woo_layout'] == 'right-sidebar' ) {
			$content_class = 'content-left alpha';
			$sidebar_class = 'sidebar-right omega';
			$set_content_width ='with-sidebar';
		} elseif( $ievent_data['woo_layout'] == 'left-sidebar' ) {
			$content_class = 'content-right omega';
			$sidebar_class = 'sidebar-left alpha';
			$set_content_width ='with-sidebar';
		}
	
	?>
    
    <!-- BOF Main Content -->
    <div id="main" role="main" class="main">
        <div id="primary" class="content-area">
                <div class="container <?php echo esc_attr( $set_content_width ); ?>">
                    <div class="sixteen columns jx-ievent-padding <?php echo esc_attr( $content_class ); ?>">	
							<?php
                                /**
                                 * woocommerce_before_main_content hook
                                 *
                                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                                 * @hooked woocommerce_breadcrumb - 20
                                 */
                                do_action( 'woocommerce_before_main_content' );
                            ?>
                    
                            <?php
                                /**
                                 * woocommerce_archive_description hook
                                 *
                                 * @hooked woocommerce_taxonomy_archive_description - 10
                                 * @hooked woocommerce_product_archive_description - 10
                                 */
                                do_action( 'woocommerce_archive_description' );
                            ?>
                    
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
                    
                                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    
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
                    
                                <?php wc_get_template( 'loop/no-products-found.php' ); ?>
                    
                            <?php endif; ?>
                    
                        <?php
                            /**
                             * woocommerce_after_main_content hook
                             *
                             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                             */
                            do_action( 'woocommerce_after_main_content' );
                        ?>
	    
                </div>
                <!-- EOF Body Content -->
                    
                    <div id="sidebar" class="four columns right jx-ievent-padding <?php echo esc_attr( $sidebar_class ); ?>">
                		<?php
								/**
								 * woocommerce_sidebar hook
								 *
								 * @hooked woocommerce_get_sidebar - 10
								 */
								do_action( 'woocommerce_sidebar' );
							?>
                	</div>
                	<!-- EOF sidebar -->
                </div>
        </div><!-- #primary -->
    </div>
<?php get_footer( 'shop' ); ?>
