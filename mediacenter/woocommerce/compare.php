<?php global $product, $yith_woocompare; ?>
<div class="container">
    <?php if ( !empty( $products ) ) : ?>
    <div class="section section-page-title inner-xs">
        <div class="page-header">
            <h2 class="page-title">
                <?php echo the_title(); ?>
            </h2>
            <p class="page-subtitle"><a id="product-comparison-page-clear-all" href="<?php echo $yith_woocompare->obj->remove_product_url('all') ?>" data-product_id="all" class="clear-all"><?php _e( 'Clear all', 'mediacenter' ) ?></a></p>
        </div>
    </div><!-- /.section-page-title -->

    <div class="table-responsive inner-bottom-xs inner-top-xs">

        <table class="table table-bordered table-striped compare-list">
            <thead>
                <tr>
                    <td>&nbsp;</td>
                    <?php foreach( $products as $i => $product ) : ?>
                    <td class="text-center">
                        <div class="image-wrap">
                            <a class="remove-link" href="<?php echo $yith_woocompare->obj->remove_product_url( $product->id ); ?>" data-product_id="<?php echo $product->id; ?>"><i class="fa fa-times-circle"></i></a>
                            <?php echo wp_get_attachment_image( $product->fields['image'], 'yith-woocompare-image' ); ?>
                        </div>
                        <p><strong><?php echo $product->fields['title']; ?></strong></p>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <tr class="tr-add-to-cart">
                    <td>&nbsp;</td>
                    <?php foreach( $products as $i => $product ) : ?>
                    <td class="text-center">
                        <?php wc_get_template( 'loop/add-to-cart.php', array( 'product' => $product ) ); ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>

                <?php foreach ( $fields as $field => $name ) : ?>
                    <?php if( !in_array( $field, array( 'image', 'title', 'add-to-cart' ) ) ) : ?>

                    <tr class="comparison-item <?php echo $field ?>">
                        <th>
                            <?php echo $name ?>
                            <?php if ( $field == 'image' ) echo '<div class="fixed-th"></div>'; ?>
                        </th>

                        <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                        <td class="comparison-item-cell <?php echo $product_class; ?>">
                            <?php
                                if( $field == 'stock' ){
                                    $availability = $product->get_availability();
                                    $availability_label_class = media_center_availability_label_class( $availability );
                                    echo '<span class="label ' . $availability_label_class . '">' . $product->fields[$field] . '</span>';
                                }else{
                                    echo empty( $product->fields[$field] ) ? '&nbsp;' : $product->fields[$field];
                                }
                            ?>
                        </td>
                        <?php endforeach ?>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if ( $repeat_price == 'yes' && isset( $fields['price'] ) ) : ?>
                    <tr class="price repeated">
                        <th><?php echo $fields['price'] ?></th>
                        <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                            <td class="<?php echo $product_class ?>"><?php echo $product->fields['price'] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>

                <?php if ( $repeat_add_to_cart == 'yes' && isset( $fields['add-to-cart'] ) ) : ?>
                    <tr class="add-to-cart repeated">
                        <th><?php echo $fields['add-to-cart'] ?></th>
                        <?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
                        <td class="<?php echo $product_class ?>"><?php wc_get_template( 'loop/add-to-cart.php', array( 'product' => $product ) ); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
    </div><!-- /.table-responsive -->

    <?php else : ?>

    <div class="inner"> 

        <h1 class="lead-title text-center cart-empty">
            <?php _e( 'No products were added <br /> to the compare table', 'mediacenter' ) ?>
        </h1>
        
        <p class="return-to-shop text-center">
            <a class="wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">
                <i class="fa fa-mail-reply"></i>
                <?php _e( 'Return To Shop', 'mediacenter' ) ?>
            </a>
        </p>

    </div><!-- /.inner-top -->

    <?php endif; ?>
</div><!-- /.container -->