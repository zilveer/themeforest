<?php
/**
 * woocommerce.php
 *
 * @package spectra
 * @since 1.0.0
 */

get_header(); ?>
<?php 
    global $spectra_opts, $wp_query, $post;

    // Copy query
    $temp_post = $post;
    $query_temp = $wp_query;

    // Shop id
    $shop_id = get_option( 'woocommerce_shop_page_id' );


   // Get layout
   $spectra_layout = get_post_meta( $shop_id, '_layout', true );
   $spectra_layout = isset( $spectra_layout ) && $spectra_layout != '' ? $spectra_layout = $spectra_layout : $spectra_layout = 'wide';

  if ( ! is_shop() ) {
    $spectra_layout = 'wide';
    $shop_class = 'wc-product';
  } else {
    $shop_class = 'wc-shop';
  }
?>

<?php 
    // Get Custom Intro Section
    if ( is_shop() ) {
      get_template_part( 'inc/custom-intro' );
    } 

?>

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
            
            $output = '';
            if ( has_post_thumbnail() ) {
               
               $output .= get_the_post_thumbnail( $post->ID, $size ); 
               
            } else {
            
               $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            
            }
            return $output;
      }
   }


   // Remove add to cart button on archives
   // remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

?>


<!-- ############ PAGE ############ -->
<div id="page">

   <!-- ############ Container ############ -->
   <div class="container clearfix <?php echo esc_attr( $shop_class ) ?>">
      <div role="main" class="main <?php echo esc_attr( $spectra_layout ) ?>">
         <?php woocommerce_content(); ?>

      </div>
      <!-- /main -->
      <?php if ( $spectra_layout !== 'wide' && $spectra_layout !== 'thin' && $spectra_layout !== 'vc' ) : ?>
         <?php get_sidebar( 'custom' ); ?>
      <?php endif; ?>
   </div>
    <!-- /container -->
</div>
<!-- /page -->

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>
<?php get_footer(); ?>