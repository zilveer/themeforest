<?php
/**
 * The template for displaying a single job listings' content.
 *
 * @package Listify
 */

global $job_manager, $post;
?>

<div class="single_job_listing" itemscope itemtype="http://schema.org/LocalBusiness" <?php echo apply_filters('listify_job_listing_data', '', false ); ?>>

    <div <?php echo apply_filters( 'listify_cover', 'listing-cover listing-cover--' . get_theme_mod( 'listing-single-hero-overlay-style', 'gradient' ) . ' content-single-job_listing-hero', array( 'size' => 'full' ) ); ?>>

		<?php do_action( 'listify_single_job_listing_cover_start' ); ?>

        <div class="content-single-job_listing-hero-wrapper cover-wrapper container">

            <div class="content-single-job_listing-hero-inner row">

                <div class="content-single-job_listing-hero-company col-md-7 col-sm-12">
                    <?php do_action( 'listify_single_job_listing_meta' ); ?>
                </div>

                <div class="content-single-job_listing-hero-actions col-md-5 col-sm-12">
                    <?php do_action( 'listify_single_job_listing_actions' ); ?>
                </div>

            </div>

        </div>

		<?php do_action( 'listify_single_job_listing_cover_end' ); ?>

    </div>

    <div id="primary" class="container">
        <div class="row content-area">

        <?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>

            <div class="woocommerce-message"><?php _e( 'This listing is expired.', 'listify' ); ?></div>

        <?php else : ?>

            <?php if ( 'left' == esc_attr( listify_theme_mod( 'listing-single-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar( 'single-job_listing' ); ?>
            <?php endif; ?>

            <main id="main" class="site-main col-xs-12 <?php if ( 'none' != esc_attr( listify_theme_mod( 'listing-single-sidebar-position', 'right' ) ) ) : ?>col-sm-7 col-md-8<?php endif; ?>" role="main">

                <?php if ( listify_has_integration( 'woocommerce' ) ) : ?>
                    <?php wc_print_notices(); ?>
                <?php endif; ?>

                <?php do_action( 'single_job_listing_start' ); ?>

                <?php
                    if ( ! dynamic_sidebar( 'single-job_listing-widget-area' ) ) {
                        $defaults = array(
                            'before_widget' => '<aside class="widget widget-job_listing">',
                            'after_widget'  => '</aside>',
                            'before_title'  => '<h3 class="widget-title widget-title-job_listing %s">',
                            'after_title'   => '</h3>',
                            'widget_id'     => ''
                        );

                        the_widget(
                            'Listify_Widget_Listing_Map',
                            array(
                                'title' => __( 'Listing Location', 'listify' ),
                                'icon'  => 'compass',
                                'map'   => 1,
                                'address' => 1,
                                'phone' => 1,
								'web' => 1,
								'email' => 1,
								'directions' => 1
                            ),
                            wp_parse_args( array( 'before_widget' => '<aside class="widget widget-job_listing listify_widget_panel_listing_map">' ), $defaults )
                        );

                        the_widget(
                            'Listify_Widget_Listing_Video',
                            array(
                                'title' => __( 'Video', 'listify' ),
                                'icon'  => 'ios-film-outline',
                            ),
                            wp_parse_args( array( 'before_widget' => '<aside class="widget widget-job_listing
                            listify_widget_panel_listing_video">' ), $defaults )
                        );

                        the_widget(
                            'Listify_Widget_Listing_Content',
                            array(
                                'title' => __( 'Listing Description', 'listify' ),
                                'icon'  => 'clipboard'
                            ),
                            wp_parse_args( array( 'before_widget' => '<aside class="widget widget-job_listing listify_widget_panel_listing_content">' ), $defaults )
                        );

                        the_widget(
                            'Listify_Widget_Listing_Comments',
                            array(
                                'title' => ''
                            ),
                            $defaults
                        );
                    }
                ?>

                <?php do_action( 'single_job_listing_end' ); ?>

            </main>

            <?php if ( 'right' == esc_attr( listify_theme_mod( 'listing-single-sidebar-position', 'right' ) ) ) : ?>
                <?php get_sidebar( 'single-job_listing' ); ?>
            <?php endif; ?>

        <?php endif; ?>
        </div>
    </div>
</div>
