<?php get_header();

// Check for WooCommerce. If true, load WooCommerce custom layout.
if ( class_exists( 'woocommerce' ) && ( ( 'true' == is_woocommerce() ) || ( 'true' == is_checkout() ) || ( 'true' == is_cart() ) || ( 'true' == is_account_page() ) ) ) : ?>
    <section class="small_banner">
        <?php get_template_part( 'template-part-woocommerce-banner', 'childtheme' ); ?>
    </section>

    <section id="content-container" class="clearfix tt-woocommerce">
        <div id="main-wrap" class="main-wrap-slider clearfix">
            <div class="page_content">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                        the_content();
                        truethemes_link_pages();
                    endwhile; endif;
                ?>
            </div><!-- end .page_content -->

            <aside class="sidebar right-sidebar">
                <?php
                    if ( ( 'true' == is_cart() ) || ( 'true' == is_checkout() ) )
                        dynamic_sidebar( 'WooCommerce - Cart + Checkout' );
                    else
                        dynamic_sidebar('WooCommerce Sidebar' );
                ?>
            </aside><!-- end .sidebar-->
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