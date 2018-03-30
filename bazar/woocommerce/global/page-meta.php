<?php
/**
 * Content Wrappers
 */

if ( !is_woocommerce() ) return;

if( ! isset( $post_id ) ) {
    global $product;
    if( isset( $product ) ) {
        $post_id = $product->id;
    }else {
        $post_id = 0;
    }

}


$tag_title      = apply_filters( 'yit_page_meta_title_tag', 'h1' );
$show_breadcrumb = is_page() ? yit_get_post_meta( $post_id, '_show-breadcrumb' ) : ( bool ) yit_get_option('breadcrumb');
?>
            <?php do_action( 'yith_before_shop_page_meta' );  ?>
            <!-- START PAGE META -->
            <div id="page-meta" class="group<?php if ( is_product() ) echo ' span12' ?>">
                <?php if ( ! is_single() && ( ( !is_product_category() && yit_get_option('shop-products-title') ) || ( is_product_category() && yit_get_option('shop-category-title') ) ) ) : ?>
        		<<?php echo $tag_title ?> class="product-title page-title"><?php woocommerce_page_title() ?></<?php echo $tag_title ?>>
        		<?php endif; ?>

        		<?php do_action( 'shop_page_meta' ) ?>

                <?php if ( $show_breadcrumb ) : ?>
                    <!-- BREDCRUMB -->
                    <div class="breadcrumbs">
                        <?php
                        if ( is_woocommerce() && yit_get_option( 'shop-show-breadcrumb' ) ) {
                            do_action( 'yit_shop_breadcrumb' );
                        } ?>
                    </div>
                <?php endif; ?>

        		<?php if ( is_single() && yit_get_option('shop-show-back') ) : ?>
        			<div class="back-shop"> <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ) ?>">&lsaquo; <?php echo apply_filters( 'yit_back_shop_link', __( 'Back to the shop', 'yit' ) ); ?></a> </div>
				<?php endif; ?>
        	</div>
        	<!-- END PAGE META -->