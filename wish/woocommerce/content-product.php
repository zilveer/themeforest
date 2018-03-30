<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
 
 //$wish_product_flip_action will enable or disable flip functionality
 // $hide_categories will show/hide cats
 // $redux_wish['products_per_row'] will set number of products per row and it is also defined in loop-start.php
global $product, $woocommerce_loop;
$redux_wish = wish_redux();

$flip_mode = $redux_wish["wish-woocommerce-hover-flip"];

$wish_product_flip_action = 'disabled';

if($flip_mode){
    $wish_product_flip_action = 'enabled';
}


$hide_categories = $redux_wish['wish-woocommerce-category-hide'];

$wish_attachment_ids = $product->get_gallery_attachment_ids();
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( !$product->is_visible() )
    return;

// Increase loop count
$woocommerce_loop['loop'] ++;
//$grid_count = $redux_wish['products_per_row'];
?>

<li class="<?php if( $wish_product_flip_action == 'disabled' ){ echo 'block'; } ?> product wish-wrap-product animated" data-animation="fadeInUp" data-animation-delay="200">	

    <?php do_action( 'woocommerce_before_shop_loop_item' );  ?>
    
    <div class="wish-product-img">
       <?php if( $wish_product_flip_action == 'enabled' ){ ?> <a href="<?php the_permalink(); ?> "><?php } ?>
            <div class="first-flip <?php if( $wish_product_flip_action == 'disabled' ){ echo 'image'; } ?>"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ) ?>
            <?php if( $wish_product_flip_action == 'disabled' ){ ?>
             <div class="picture-overlay">
							<div class="icons">
								<div><span class="icon"><a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a></span></div>
							</div>
            
            </div>  
			<?php } ?>
            
						
                 </div><!-- first flip -->
            <?php
            if (( $wish_attachment_ids ) && ( $wish_product_flip_action == 'enabled' ) ) {

                $loop = 0;

                foreach ( $wish_attachment_ids as $wish_attachment_id ) {

                    $imgsrc = wp_get_attachment_url( $wish_attachment_id );

                    if ( !$imgsrc )
                        continue;

                    $loop++;

                    printf( '<div class="back-flip back">%s</div>', wp_get_attachment_image( $wish_attachment_id, 'shop_catalog' ) );

                    if ( $loop == 1 )
                        break;
                }
            } else {
                ?>

                <div class="back-flip"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog' ) ?></div>

                <?php
            }
            ?>
            <?php if( $wish_product_flip_action == 'enabled' ){ echo '</a>'; } ?>
           
<div class="wish-product-meta-wrap">
    <div class="wish-pro-info">
            <span class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></span>
            
            <?php $product_categories = strip_tags( $product->get_categories( '|', '', '' ) );  ?>
			  <?php if ( !$hide_categories ) { ?>
                <span class="category"><?php list($category) = explode( '|', $product_categories );
            echo $category; ?></span>
            <?php } ?>
        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
       <div class="wish-btn-cart-products"><!-- start after shop loop item -->
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?><!-- end after shop loop item -->
				
            </div>
    </div>
</div>
<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
</li>
