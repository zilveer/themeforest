<?php
/*
Template name: WooCommerce - Cart
*/
get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>

<?php 
	woocommerce_get_template('checkout/header.php');
    echo '<div class="cart-container container page-wrapper page-checkout">';
   	 the_content();
    echo '</div>';
?>
	
<?php endwhile; // end of the loop. ?>	

<?php get_footer(); ?>