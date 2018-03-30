<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	
	$sidebar = ( isset($_GET['layout']) ) ? $_GET['layout'] : false;
	$layout = ( $sidebar ) ? $sidebar : get_option('foundry_product_layout','sidebar-right');

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<section>
    <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('container'); ?>>
        <div class="row">
        
        	<div class="col-sm-12">
        		<?php 
        			/**
        			 * woocommerce_before_single_product hook
        			 *
        			 * @hooked wc_print_notices - 10
        			 */
        			 do_action( 'woocommerce_before_single_product' );
        		?>
        	</div>
        	
            <?php get_template_part('inc/content-product', $layout); ?>
            
        </div>
    </div>
</section>

<?php woocommerce_output_related_products(); ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>