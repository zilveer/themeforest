<?php get_header();

// Check for WooCommerce. If true, load WooCommerce custom layout.
if ( class_exists( 'woocommerce' ) && ( ( 'true' == is_woocommerce() ) || ( 'true' == is_checkout() ) || ( 'true' == is_cart() ) || ( 'true' == is_account_page() ) ) ) : ?>
    <section class="small_banner">
        <?php get_template_part( 'template-part-woocommerce-banner', 'childtheme' ); ?>
    </section>

    <section id="content-container" class="clearfix">
        <div id="main-wrap" class="main-wrap-slider clearfix">
            <?php
                get_template_part( 'template-part-page-banner', 'childtheme' );
                    woocommerce_content();

                comments_template( '/page-comments.php', true );
                get_template_part( 'template-part-inline-editing', 'childtheme' );
            ?>
        </div><!-- end #main-wrap -->

<?php // Else load default layout.
else :
    get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

    <section id="content-container" class="clearfix">
        <div id="main-wrap" class="main-wrap-slider clearfix">
            <?php
                get_template_part( 'template-part-page-banner', 'childtheme' );
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                    truethemes_link_pages();
                endwhile; endif;
                comments_template( '/page-comments.php', true );
                get_template_part( 'template-part-inline-editing', 'childtheme' );
            ?>
        </div><!-- end #main-wrap -->
<?php endif; ?>

<?php get_footer(); ?>
