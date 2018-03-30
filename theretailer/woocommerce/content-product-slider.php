<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $theretailer_theme_options;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

?>

	
<li class="products_slider_item">

    <div class="products_slider_content">
        
        <div class="products_slider_images_wrapper">
		
			<?php if ( has_post_thumbnail() ) : ?>
    
            <?php
                //Get the Thumbnail URL
                $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
            ?>
            
            <div class="products_slider_images"><a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?></a></div>
            
            <?php endif; ?>
            <?php
                $attachments = get_posts( array(
                    'post_type' 	=> 'attachment',
                    'numberposts' 	=> -1,
                    'post_status' 	=> null,
                    'post_parent' 	=> $post->ID,
                    'post__not_in'	=> array( get_post_thumbnail_id() ),
                    'post_mime_type'=> 'image',
                    'orderby'		=> 'menu_order',
                    'order'			=> 'ASC'
                ) );
                if ($attachments) {
            
                    $loop = 0;
            
                    foreach ( $attachments as $key => $attachment ) {
            
                        if ( get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
                            continue;
                        
                        $loop++;
                        
                        //printf( '<div class="products_slider_images">%s</div>', wp_get_attachment_image( $attachment->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) ) );
                        
                        if ($loop == 2) break;
            
                    }
            
                }
            ?>
        
        </div>   
        
        <div class="products_slider_infos">
            
            <!-- Show only the first category-->
            <?php $gbtr_product_cats = $product->get_categories('|||', '', ''); //Categories separeted by ||| ?>
            <div class="products_slider_category"><?php list($firstpart) = explode('|||', $gbtr_product_cats); echo $firstpart; ?></div>
            
            <div class="products_slider_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            
            <div class="products_slider_price">
			<?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                 
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            </div>
            
            <?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
            <div class="products_slider_button_wrapper">
            
				<?php
                if ( ! $product->is_purchasable() && ! in_array( $product->product_type, array( 'external', 'grouped' ) ) ) return;
                ?>
                
                <?php if ( ! $product->is_in_stock() ) : ?>
                
                    <a class="dark_button" href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>
                
                <?php else : ?>
                
                    <?php
                
                        switch ( $product->product_type ) {
                            case "variable" :
                                $link 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
                                $label 	= apply_filters( 'variable_add_to_cart_text', __('Select options', 'woocommerce') );
                            break;
                            case "grouped" :
                                $link 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
                                $label 	= apply_filters( 'grouped_add_to_cart_text', __('View options', 'woocommerce') );
                            break;
                            case "external" :
                                $link 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
                                $label 	= apply_filters( 'external_add_to_cart_text', __('Read More', 'woocommerce') );
                            break;
                            default :
                                $link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
                                $label 	= apply_filters( 'add_to_cart_text', __('Add to cart', 'woocommerce') );
                            break;
                        }
                
                        printf('<a class="dark_button" href="%s" rel="nofollow" data-product_id="%s">%s</a>', $link, $product->id, $label);
                
                    ?>
            
                <?php endif; ?>
            
            </div>
            <?php } ?>
        
        </div>        
        
    </div>

</li>

		
