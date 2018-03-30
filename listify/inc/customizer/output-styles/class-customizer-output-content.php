<?php
/**
 * Output buttons.
 *
 * @since 1.3.0
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_Content
extends
	Listify_Customizer_OutputCSS {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Add items to the CSS object that will be built and output.
	 *
	 * @since 1.5.0
	 * @return void
	 */
    public function output() {
		if ( 
			( get_theme_mod( 'fixed-header', true ) && ! is_front_page() ) ||
			( is_front_page() && 'transparent' != get_theme_mod( 'home-header-style', 'default' ) && get_theme_mod( 'fixed-header', true ) )
		) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'body'
				),
				'declarations' => array(
					'padding-top' => '75px'
				)
			) );
		}

        $content_style = listify_theme_mod( 'content-box-style' );
        $content_background = listify_theme_color( 'color-content-background' );
        $content_border = listify_theme_color( 'color-content-border' );
        $content_accent = listify_theme_color( 'color-content-accent' );

        $decs = array(
            'background-color' => esc_attr( $content_background ),
            'box-shadow' => 'inset 0 0 0 1px ' . esc_attr( $content_border ),
            'border' => 0
        );

        if ( 'default' == $content_style ) {
            $decs[ 'box-shadow' ] = $decs[ 'box-shadow' ] . ', rgba(0, 0, 0, .03) 0 2px 0';
        } elseif ( 'minimal' == $content_style ) {
            $decs[ 'box-shadow' ] = $decs[ 'box-shadow' ];
        } elseif ( 'shadow' == $content_style ) {
            $decs[ 'box-shadow' ] = $decs[ 'box-shadow' ] . ', rgba(0, 0, 0, 0.15) 0 0 10px 0';
        }

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.content-box',
                '.content-shop-wrapper .archive-job_listing-filters-wrapper.top.type-product',
                '.content-shop-wrapper .type-product',
                '.home-feature',
                '.job-package',
                '.job_filters',
                '.listify_widget_search_listings.home-widget .archive-job_listing-filters-wrapper.top.job_search_form',
                '.listify_widget_search_listings.home-widget .job_search_form',
                '.listing-by-term-inner',
                '.single-job_listing-description',
                '.tabbed-listings-tabs a',
                '.tabbed-listings-tabs a.archive-job_listing-filters-wrapper.top',
                '.type-product .thumbnails a',
                '.type-product .thumbnails a.archive-job_listing-filters-wrapper.top',
                '.widget',
                '.woocommerce div.product div.archive-job_listing-filters-wrapper.top.summary',
                '.woocommerce div.product div.summary',
                '.woocommerce-main-image',
                '.woocommerce-page div.product div.archive-job_listing-filters-wrapper.top.summary',
                '.woocommerce-page div.product div.summary, .woocommerce-tabs',
                '.archive-job_listing-layout',
                '.nav-menu .children.category-list .category-count',
                '.nav-menu .sub-menu.category-list .category-count',
                'ul.nav-menu .children.category-list .category-count',
                'ul.nav-menu .sub-menu.category-list .category-count',
                '.facetwp-pager .facetwp-page',
                '.job-manager-pagination li a',
                '.job-manager-pagination li span',
                '.js-toggle-area-trigger',
                '.site .facetwp-sort select',
                'a.page-numbers, span.page-numbers',
                '.archive-job_listing-toggle-inner'
            ),
            'declarations' => apply_filters( 'astoundify_customizer_css_content_box', $decs )
        ) );

        /**
         * Accent
         */

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.comment-reply-title',
                '.entry-content .rcp_form .rcp_subscription_fieldset .rcp_subscription_message', 
                '.entry-content .rcp_header',
                '.entry-content h2',
                '.entry-content h3',
                '.entry-content h4',
                '.job-manager-form h2',
                '.job_listing_packages ul.job_packages .package-section',
                '.listify_widget_panel_listing_content h2',
                '.listify_widget_panel_listing_content h3',
                '.listify_widget_panel_listing_content h4',
                '.listing-by-term-title',
                '.widget-title',
                '.woocommerce-account .woocommerce legend',
                '.woocommerce-tabs .tabs a',
                '.account-sign-in',
                '.job-manager-form fieldset.fieldset-job_hours',
                '.ninja-forms-required-items',
                '.showing_jobs',
                '.summary .stock',
				'.woocommerce-tabs .woocommerce-noreviews',
				'.payment_methods li .payment_box',
				'button.more-filters__toggle',
				'button.more-filters__toggle:hover'
            ),
            'declarations' => array(
                'border-color' => esc_attr( $content_accent )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.ui-slider',
                '.ui-slider-range',
				'.payment_methods li'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $content_accent )
            )
        ) );

        if ( in_array( self::$scheme, array( 'iced-coffee' ) ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu .children.category-list .category-count',
                    '.nav-menu .sub-menu.category-list .category-count',
                    'ul.nav-menu .children.category-list .category-count',
                    'ul.nav-menu .sub-menu.category-list .category-count',
                ),
                'declarations' => array(
                    'box-shadow' => 'none',
                    'border' => '1px solid ' . esc_attr( $content_accent )
                )
            ) );
        }

		/** company image */
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'.listing-entry-company-image--card .listing-entry-company-image__img',
            ),
            'declarations' => array(
                'border-color' => esc_attr( $content_background )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'button.more-filters__toggle',
				'button.more-filters__toggle:hover',
				'button.more-filters__toggle:focus'
            ),
            'declarations' => array(
				'color' => esc_attr( listify_theme_color( 'color-body-text' ) ),
                'border-color' => esc_attr( Listify_Customizer_CSS::darken( $content_accent, -5 ) ),
                'background-color' => esc_attr( $content_background )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'button.more-filters__toggle:hover',
				'button.more-filters__toggle:focus'
            ),
            'declarations' => array(
                'border-color' => esc_attr( Listify_Customizer_CSS::darken( $content_accent, -15 ) )
            )
        ) );
    }

}

new Listify_Customizer_OutputCSS_Content();
