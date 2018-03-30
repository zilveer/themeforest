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


<div class="container">
    <div class="sixteen columns">
     	<!-- Page Title -->
     	<div id="page-title">

        <?php $breadcrumbs = ot_get_option('centum_breadcrumbs'); ?>
        	<h1 <?php if($breadcrumbs == 'yes') echo 'class="has-breadcrumbs"';?>><?php woocommerce_page_title(); ?></h1>

	        <?php
	        if($breadcrumbs == 'yes') {
	        woocommerce_breadcrumb(array(
	           'delimiter'  => ' ',
	           'wrap_before'  => '<ul id="breadcrumbs"><li><a>Home</a></li>',
	           'wrap_after' => '</ul>',
	           'before'   => '<li class="current_element">',
	           'after'   => '</li>',
	           'home'    => null
	           ));
	        }
	        ?>
           <div id="bolded-line"></div>
       </div>
       <!-- Page Title / End -->
   	</div>
</div>
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

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>



<?php get_footer( 'shop' ); ?>