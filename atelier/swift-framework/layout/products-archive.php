<?php
    global $sf_options;
    $product_display_columns = $sf_options['product_display_columns'];
    $width                   = "";

    if ( $product_display_columns == "4" ) {
        $width = 'col-sm-3';
    } else if ( $product_display_columns == "5" ) {
        $width = 'col-sm-sf-5';
    } else if ( $product_display_columns == "3" ) {
        $width = 'col-sm-4';
    } else if ( $product_display_columns == "2" ) {
        $width = 'col-sm-6';
    } else if ( $product_display_columns == "6" ) {
        $width = 'col-sm-2';
    }
?>

<?php do_action( 'woocommerce_archive_description' ); ?>

<?php if ( have_posts() ) : ?>

    <!-- LOOP START -->
    <?php woocommerce_product_loop_start(); ?>

    <?php woocommerce_product_subcategories(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php wc_get_template_part( 'content', 'product' ); ?>

    <?php endwhile; // end of the loop. ?>

    <!-- LOOP END -->
    <?php woocommerce_product_loop_end(); ?>

    <?php
    /**
     * woocommerce_after_shop_loop hook
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action( 'woocommerce_after_shop_loop' );
    ?>

<?php elseif ( ! woocommerce_product_subcategories( array(
        'before' => woocommerce_product_loop_start( false ),
        'after'  => woocommerce_product_loop_end( false )
    ) )
) : ?>

    <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

<?php endif; ?>