<?php if(class_exists('WP_eCommerce')): ?>
<?php
get_header(); ?>
        <section id="main" class="column1">
            <div class="content">

   <?php
   /* Run the loop to output the posts.
    * If you want to overload this in a child theme then include a file
    * called loop-index.php and that will be used instead.
    */
        get_template_part( 'loop', 'page' );
   ?>
   </div><!-- #content -->
            <div class="clear"></div>
  </section><!-- #container -->
<?php get_footer(); ?>
<?php endif ;?> 


<?php if(class_exists('Woocommerce')): ?>
<?php
/**
 * The Template for displaying products in a product tag. Simple includes the archive template.
 *
 */

woocommerce_get_template( 'archive-product.php' );?>
<?php endif ;?>	