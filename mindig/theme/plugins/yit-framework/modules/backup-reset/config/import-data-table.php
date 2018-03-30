<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$plugins = get_plugins();

return array(
    'theme_options'    => array(
        'name'    => __( 'Theme Options', 'yit' ),
        'visible' => apply_filters( 'yit_show_theme_options_on_import', true )
    ),

    'page'             => array(
        'name'    => __( 'Page and Content', 'yit' ),
        'visible' => apply_filters( 'yit_show_page_on_import', true )
    ),

    'menu'             => array(
        'name'    => __( 'Menu', 'yit' ),
        'visible' => apply_filters( 'yit_show_menu_on_import', true )
    ),

    'widgets_sidebars' => array(
        'name'    => __( 'Widgets and Sidebars', 'yit' ),
        'visible' => apply_filters( 'yit_show_widgets_sidebars_on_import', true )
    ),

    'woocommerce'      => array(
        'name'    => __( 'WooCommerce', 'yit' ),
        'visible' => apply_filters( 'yit_show_woocommerce_on_import', isset( $plugins['woocommerce/woocommerce.php'] ) )
    ),

    'buddypress'       => array(
        'name'    => __( 'BuddyPress', 'yit' ),
        'visible' => apply_filters( 'yit_show_buddypress_on_import', isset( $plugins['buddypress/bp-loader.php'] ) )
    ),

    'bbpress'          => array(
        'name'    => __( 'bbPress', 'yit' ),
        'visible' => apply_filters( 'yit_show_bbpress_on_import', isset( $plugins['bbpress/bbpress.php'] ) )
    ),

    'sliders'          => array(
        'name'    => __( 'Sliders', 'yit' ),
        'visible' => apply_filters( 'yit_show_sliders_on_import', ( isset( $plugins['revslider/revslider.php'] ) || isset( $plugins['yit-sliders/yit-slider.php'] ) ) )
    ),

    'faq'              => array(
        'name'    => __( 'FAQs', 'yit' ),
        'visible' => apply_filters( 'yit_show_faq_on_import', isset( $plugins['yit-faq/yit-faq.php'] ) )
    ),

    'contactform'      => array(
        'name'    => __( 'Contact Form', 'yit' ),
        'visible' => apply_filters( 'yit_show_contactform_on_import', isset( $plugins['yit-contactforms/yit-contact-form.php'] ) )
    ),

    'featuretabs'      => array(
        'name'    => __( 'Feature Tabs', 'yit' ),
        'visible' => apply_filters( 'yit_show_featuretabs_on_import', isset( $plugins['yit-features-tabs/yit-feature-tabs.php'] ) )
    ),

    'logos'            => array(
        'name'    => __( 'Logos', 'yit' ),
        'visible' => apply_filters( 'yit_show_logos_on_import', isset( $plugins['yit-logos/yit-logos.php'] ) )
    ),

    'newsletter'       => array(
        'name'    => __( 'Newsletter', 'yit' ),
        'visible' => apply_filters( 'yit_show_newsletter_on_import', isset( $plugins['yit-newsletter/yit-newsletter.php'] ) )
    ),

    'portfolios'       => array(
        'name'    => __( 'Portfolios', 'yit' ),
        'visible' => apply_filters( 'yit_show_portfolios_on_import', isset( $plugins['yit-portfolio/yit-portfolio.php'] ) )
    ),

    'services'         => array(
        'name'    => __( 'Services', 'yit' ),
        'visible' => apply_filters( 'yit_show_service_on_import', isset( $plugins['yit-services/yit-services.php'] ) )
    ),

    'teams'            => array(
        'name'    => __( 'Teams', 'yit' ),
        'visible' => apply_filters( 'yit_show_teams_on_import', isset( $plugins['yit-team/yit-team.php'] ) )
    ),

    'testimonails'     => array(
        'name'    => __( 'Testimonials', 'yit' ),
        'visible' => apply_filters( 'yit_show_testimonials_on_import', isset( $plugins['yit-testimonials/yit-testimonials.php'] ) )
    ),
);