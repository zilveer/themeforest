<?php global $r_option; ?>

<?php get_header(); ?>

<?php
   
   /* Hooks and functions
   ------------------------------------------------------------------------*/

   /* Remove default page title */
   add_filter('woocommerce_show_page_title', 'override_page_title');
   function override_page_title() {
      return false;
   }

   /* Change default catalog image */ 
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

   add_action( 'woocommerce_before_shop_loop_item_title', 'wc_catalog_thumb', 10);
 
   /* WooCommerce Loop Product Thumbs */
   function wc_catalog_thumb() {
        echo wc_get_product_thumbnail();
   } 
   
 
   /* WooCommerce Product Thumbnail */
    
   if ( ! function_exists( 'wc_get_product_thumbnail' ) ) {
        
      function wc_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
         global $post, $woocommerce;
    
         if ( ! $placeholder_width )
            $placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
         if ( ! $placeholder_height )
            $placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
            
            $output = '<span class="thumb-icon">';
    
            if ( has_post_thumbnail() ) {
               
               $output .= get_the_post_thumbnail( $post->ID, $size ); 
               
            } else {
            
               $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            
            }
            $output .= '<span class="icon plus"></span>';
            $output .= '</span>';
            return $output;
      }
   }


   // Remove add to cart button on archives
   // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


   /* Theme functions
   ------------------------------------------------------------------------*/

   /* Sidebar */
   if ( isset( $r_option['product_sidebar'] ) ) {
      if ( is_product() ) {
         $sidebar = $r_option['product_sidebar'];
      } else {
         $sidebar = $r_option['products_sidebar'];
      }

      $sidebar = $sidebar == 'on' ? $sidebar = 'on' : $sidebar = 'off';
   }

   /* Include page header */
   if ( isset( $post ) ) get_template_part( '/includes/page_header', '' );

?>

<section id="main-content" class="container clearfix">
   <!-- main -->
   <section <?php if ( $sidebar == 'on' ) echo 'id="main"'; ?> class="clearfix">

      <?php woocommerce_content(); ?>
      
   </section>
   <!-- /main -->

   <?php if ( $sidebar == 'on' ) : ?>
   <!-- sidebar -->
   <aside class="sidebar">
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-shop')) : ?>
      <?php endif; ?>
   </aside>
   <?php endif; ?>

</section>

<?php get_footer(); ?>