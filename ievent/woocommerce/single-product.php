<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
get_header( 'shop' );
global $ievent_data;
 
	$content_class = '';
	$sidebar_class = '';
	if(get_post_meta(get_the_ID(), 'ievent_sidebar', true) == 'no-sidebar') {
		$content_class = 'has-no-sidebar';
		$sidebar_class = 'no-sidebar';
		$set_content_width ='';
	} elseif (get_post_meta(get_the_ID(),  'ievent_sidebar', true) == 'right-sidebar') {
		$content_class = 'content-left alpha';
		$sidebar_class = 'sidebar-right omega';
		$set_content_width ='with-sidebar';
	} elseif (get_post_meta(get_the_ID(),  'ievent_sidebar', true) == 'left-sidebar') {
		$content_class = 'content-right omega';
		$sidebar_class = 'sidebar-left alpha';
		$set_content_width ='with-sidebar';
	} elseif ( (get_post_meta(get_the_ID(),'ievent_sidebar', true) == 'default') || (get_post_meta(get_the_ID(),  'ievent_sidebar', true) == '') ) {
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
	}
	
	?>
    
	<!-- BOF Main Content -->
    <div id="main" role="main" class="main">
        <div id="primary" class="content-area">
                <div class="container <?php echo esc_attr( $set_content_width ); ?>">
                    <div class="sixteen columns jx-ievent-padding <?php echo esc_attr( $content_class ); ?>">
						<?php
                        $hide_breadcrumbs = '';
                        if ( isset( $ievent_data['opt_hide_breadcrumbs_product'] ) && $ievent_data['opt_hide_breadcrumbs_product'] != '0' ) {
                            $hide_breadcrumbs = $ievent_data['opt_hide_breadcrumbs_product'];
                        }
                        if ( $hide_breadcrumbs != '1' ) {
                            woocommerce_breadcrumb();
                        }
                        ?>
						<?php
                        /**
                         * woocommerce_before_main_content hook
                         *
                         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                         * @hooked woocommerce_breadcrumb - 20
                         */
                        do_action( 'woocommerce_before_main_content' );
                        ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
                        <?php endwhile; // end of the loop. ?>
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