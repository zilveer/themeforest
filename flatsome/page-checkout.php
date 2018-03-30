<?php
/*
Template name: WooCommerce - Checkout
*/
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php 
	woocommerce_get_template('checkout/header.php');
	echo '<div class="checkout-container container mb page-wrapper page-checkout">';
   	 the_content();
    echo '</div>';
?>
	
<?php endwhile; // end of the loop. ?>	

<?php get_footer(); ?>