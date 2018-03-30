<?php
global $post, $product, $woocommerce;
//$attachment_ids = $product->get_gallery_attachment_ids();
$cg_attach_ids = $product->get_gallery_attachment_ids();

global $wp_locale;
$rtl = '';
$rtl = ( isset( $wp_locale ) && ('rtl' == $wp_locale->text_direction ) );


?> 
<!-- start quickview contents -->           
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row single-product-details product-nocols">
            <div class="product-images col-lg-6 col-md-6 col-sm-6">

                <div class="images cg-prod-gallery">

                    <script type="text/javascript">

                        jQuery( document ).ready( function( $ ) {
                            var sync1 = $( "#sync1" );
                            sync1.owlCarousel( {
                                <?php 
                                if ( $rtl ) {
                                echo 'rtl : true,';
                                }
                                ?>
                                singleItem: true,
                                slideSpeed: 200,
                                navigation: true,
                                navigationText: [
                                    "<i class='fa fa-angle-left'></i>",
                                    "<i class='fa fa-angle-right'></i>"
                                ],
                                pagination: false,
                                autoHeight: true,
                                responsiveRefreshRate: 200,
                            } );

                            $( ".variations" ).on( 'change', 'select', function( e ) {
                                sync1.trigger( "owl.goTo", 0 );
                            } );

                        } );

                    </script>

                    <div id="sync1" class="cg-prod-lvl1">

                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php
                            $cg_attach_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );

                            $cg_attach_count = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
                            ?>

                            <div class="item cg-product-gallery-img">
                                <span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ) ?></span>
                            </div>

                        <?php endif; ?> 

                        <?php
                        if ( $cg_attach_ids ) {

                            $capthumbsinc = 0;
                            $columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

                            foreach ( $cg_attach_ids as $cg_attach_id ) {

                                $classes = array( 'zoom' );

                                if ( $capthumbsinc == 0 || $capthumbsinc % $columns == 0 )
                                    $classes[] = 'first';

                                if ( ( $capthumbsinc + 1 ) % $columns == 0 )
                                    $classes[] = 'last';

                                $cg_image_uri = wp_get_attachment_url( $cg_attach_id );

                                if ( !$cg_image_uri )
                                    continue;

                                $cg_image = wp_get_attachment_image( $cg_attach_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
                                $cg_image_class = esc_attr( implode( ' ', $classes ) );
                                $cg_image_title = esc_attr( get_the_title( $cg_attach_id ) );

                                printf( '<div class="item cg-product-gallery-img"><span>%s</span></div>', wp_get_attachment_image( $cg_attach_id, 'shop_single' ) );

                                $capthumbsinc++;
                            }
                        }
                        ?>

                    </div>
                </div>

                <!-- end images -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="summary entry-summary">
                    <h1 itemprop="name" class="product_title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <?php
                        /**
                         * cg_woocommerce_single_product_summary hook
                         *
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         */
                        do_action( 'cg_woocommerce_single_product_summary_quickview' );
                        ?>
                        <?php wc_get_template( 'single-product/meta.php' );
                        ?>
                </div><!-- .summary -->
            </div>
        </div>
    </div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<!-- end quickview contents -->           


