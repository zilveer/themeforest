<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
 ?>


	<div class="row">
                    
		<!-- Heading -->
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading">
				<h4><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Account Details', 'homeshop' ) ); ?></h4>
				<div class="carousel-arrows">
					<a href="<?php echo get_permalink(wc_get_page_id( 'cart' ) ); ?>"><i class="icons icon-reply"></i></a>
				</div>
			</div>
			
		</div>
		<!-- /Heading -->
		
	</div>	
	
	
	
<div class="page-content">
                    	
		
	
<?php
/**
 * My Account navigation.
 * @since 2.6.0
 */
do_action( 'woocommerce_account_navigation' ); ?>

<div class="clear"></div>


<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>




                        
	</div>
