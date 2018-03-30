<?php

$shop_page_id = null;

if ( is_shop() ){
    $shop_page_id = woocommerce_get_page_id( 'shop' );
    $page_title   = get_the_title( $shop_page_id );
    $ish_woo_id = $shop_page_id;
}
else{
    $ish_woo_id = get_the_ID();
}

get_header();

global $wp_query;
//var_dump($wp_query);

?>


<?php ishyoboy_get_lead($shop_page_id); ?>

    <!-- Content part section -->
    <section class="part-content">
        <div class="row">
            <div class="<?php echo ishyoboy_get_content_class($shop_page_id); ?>">
                <?php
                // Breadcrumbs display
                ishyoboy_show_breadcrumbs();
                ?>

                <div class="space"></div>

                <?php woocommerce_content(); ?>

                <div class="space"></div>

            </div>

            <?php
            // SIDEBAR
            get_sidebar('woocommerce');
            ?>

        </div>
    </section>
    <!-- Content part section END -->

    <!-- #content  END -->
<?php  get_footer(); ?>