<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>

<!--Page main wrapper-->
<div id="main-content"> 
	<div class="page-wrapper regular-page">

		<div id="shop-header">
			<?php include( locate_template( OWLAB_WOO_TEMPLATES . '/parts/header.php') ); ?>
		</div>

		<div id="shop-content">
			<div class="container">	

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>



				<hr/>
				<a class="back-to-top" href="#"></a>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
		
<?php get_footer( 'shop' ); ?>