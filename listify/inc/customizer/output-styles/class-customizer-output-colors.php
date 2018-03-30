<?php
/**
 * Output colors.
 *
 * @since 1.0.0
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_Colors 
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
        /**
         * Page Background Color
         */
        $page_background = '#' . get_background_color();

		Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'html'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $page_background )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.tertiary li.is-active a:before',
                '.nav-menu.tertiary li.current-menu-item a:before'
            ),
            'declarations' => array(
                'border-bottom-color' => esc_attr( $page_background )
            )
        ) );

		/**
		 * Header
		 */
		$header_text_color = get_header_textcolor();

		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.site-branding .site-title',
					'.site-branding .site-description',
					'.site-header-minimal .site-title',
					'.site-header-minimal .site-description'
				),
				'declarations' => array(
					'display' => 'none'
				)
			) );
		} else {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.site-title a',
					'.site-title a:hover',
					'.site-description'
				),
				'declarations' => array(
					'color' => esc_attr( '#' . str_replace( '#', '', $header_text_color ) )
				)
			) );
		}

        /**
         * Inputs
         */
        $input_text_color = listify_theme_color( 'color-input-text' );
        $input_background_color = listify_theme_color( 'color-input-background' );
        $input_border_color = listify_theme_color( 'color-input-border' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input',
                'textarea',
                'input[type=checkbox]',
                'input[type=radio]',
                '.site select',
                '.facetwp-facet .facetwp-checkbox:before',
                '.filter_by_tag a:before',
                '.search-choice-close', 
                '.widget_layered_nav li a:before', 
                '.site-main .content-box select',
                '.site-main .widget select',
                '.site-main .job_listings select',
                '.mfp-content select',
                'body .chosen-container-single .chosen-single',
                'body .chosen-container-multi .chosen-choices li.search-field input[type=text]',

				// select2
				'.select2-container .select2-choice',
                '.select2-container .select2-choice',

				// FacetWP
				'.facetwp-facet.facetwp-type-fselect .fs-label-wrap',

				// Chosen
				'body .chosen-container .chosen-drop',
				'body .chosen-container-single .chosen-search input[type=text]',
				'body .chosen-container-single .chosen-search input[type=text]:focus',
            ),
            'declarations' => array(
                'color' => esc_attr( $input_text_color ),
                'border-color' => esc_attr( $input_border_color ),
                'background-color' => esc_attr( $input_background_color )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'.wp-editor-container'
            ),
            'declarations' => array(
                'border-color' => esc_attr( $input_border_color ),
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input[type=checkbox]:checked:before',

				// FacetWP
                '.facetwp-facet .facetwp-checkbox.checked:after',
                '.facetwp-facet .facetwp-link.checked',
				'.facetwp-facet.facetwp-type-fselect .fs-option',
            ),
            'declarations' => array(
                'color' => esc_attr( $input_text_color ),
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.facetwp-facet.facetwp-type-fselect .fs-arrow',
            ),
            'declarations' => array(
                'border-top-color' => esc_attr( $input_text_color ),
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input:focus',
                'textarea:focus',
            ),
            'declarations' => array(
                'background-color' => esc_attr( Listify_Customizer_CSS::darken( $input_background_color, 10 ) )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				// WooCommerce - Social Login
				'.wc-social-login-divider span:after',
				'.wc-social-login-divider span:before'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $input_border_color )
            )
        ) );

        // empty covers
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.listing-cover',
                '.entry-cover',
                '.homepage-cover.page-cover',
                '.list-cover',
            ),
            'declarations' => array(
                'background-color' => Listify_Customizer_CSS::darken( esc_attr( $page_background ), -10 )
            )
        ) );

        /**
         * Body Text Color
         *
         * A lot of the specific selectors are to override plugin CSS
         * or links that stick out too much (buttons, etc).
         */
        $body_text_color = listify_theme_color( 'color-body-text' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'body',
                '.listify_widget_panel_listing_tags .tag',
                '.entry-cover.no-image',
                '.entry-cover.no-image a',
                '.listing-cover.no-image',
                '.listing-cover.no-image a:not(.button)',
                '.widget a',
                '.content-pagination .page-numbers',
                '.facetwp-pager .facetwp-page',
                '.type-job_listing.style-list .job_listing-entry-header',
                '.type-job_listing.style-list .job_listing-entry-header a',
                '.js-toggle-area-trigger',
                '.job-dashboard-actions a',
                '.job-manager-bookmark-actions a',
                'body.fixed-map .site-footer',
                'body.fixed-map .site-footer a',
                '.homepage-cover .job_search_form .select:after',
                '.tabbed-listings-tabs a',
                '.archive-job_listing-toggle',
                '.job-manager-form fieldset.fieldset-job_hours',
                '.no-image .ion-ios-star:before',
                '.no-image .ion-ios-star-half:before',
                '.select2-default',
                '.select2-container .select2-choice',
                '.select2-container-multi .select2-choices .select2-search-choice',
                '.filter_by_tag a',
                'a.upload-images',
                'a.upload-images span',
                '.nav-menu .sub-menu.category-list a',
                '.woocommerce-tabs .tabs a',
                '.star-rating-wrapper a:hover ~ a:before',
                '.star-rating-wrapper a:hover:before',
                '.star-rating-wrapper a.active ~ a:before',
                '.star-rating-wrapper a.active:before',
                '.cluster-overlay a',
                '.map-marker-info',
                '.map-marker-info a',
				'.archive-job_listing-layout.button.active',
				'.entry-title--grid a',
				'.entry-read-more',
				'.listing-by-term-title a',

				// bookmarks
				'.type-job_listing.style-list .wp-job-manager-bookmarks-form .bookmark-notice',

				// Private Messages
				'.pm-column a'
            ),
            'declarations' => array(
                'color' => esc_attr( $body_text_color )
            )
        ) );

        // slightly lighter body text to stand out against body text
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.comment-meta a',
                '.commentlist a.comment-ago',
                'div:not(.no-image) .star-rating:before',
                'div:not(.no-image) .stars span a:before',
                '.job_listing-author-descriptor',
                '.entry-meta',
                '.entry-meta a',
                '.home-widget-description',
                '.listings-by-term-content .job_listing-rating-count',
                '.listings-by-term-more a',
                '.search-form .search-submit:before',
                '.mfp-content .mfp-close:before',
                'div:not(.job-package-price) .woocommerce .amount',
                '.woocommerce .quantity',
                '.showing_jobs',
                '.account-sign-in',
                '.archive-job_listing-layout.button',
            ),
            'declarations' => array(
                'color' => Listify_Customizer_CSS::darken( esc_attr( $body_text_color ), 35 )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.social-profiles a',
                '.listing-gallery-nav .slick-dots li button:before'
            ),
            'declarations' => array(
                'background-color' => Listify_Customizer_CSS::darken( esc_attr( $body_text_color ), 35 )
            )
        ) );

        // ultra dark popup needs a standard gray
        if ( in_array( self::$scheme, array( 'ultra-dark' ) ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.popup',
                    '.mfp-content .mfp-close:before',
                    '.select:after',
                    '.homepage-cover .job_search_form .select:after',
                    '.search-form .search-submit:before',
                    '.cluster-overlay a',
                    '.map-marker-info',
                    '.map-marker-info a'
                ),
                'declarations' => array(
                    'color' => '#454545'
                )
            ) );

            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    'table',
                    'td',
                    'th'
                ),
                'declarations' => array(
                    'border-color' => 'rgba(255, 255, 255, .1)'
                )
            ) );
        }

        /**
         * Body Link Color
         */
        $body_link_color = listify_theme_color( 'color-link' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'a',
                '.listify_widget_panel_listing_content a',
            ),
            'declarations' => array(
                'color' => esc_attr( $body_link_color )
            )
        ) );

        // darken on hover
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'a:active',
                'a:hover',
                '.primary-header .current-account-toggle .sub-menu a'
            ),
            'declarations' => array(
                'color' => Listify_Customizer_CSS::darken( esc_attr( $body_link_color ), -25 )
            )
        ) );

        /**
         * Header and Primary + Secondary Navigation
         *
         * It gets a bit hairy in here and should definitely be reviewed at one point
         */
        $header_background_color = listify_theme_color( 'color-header-background' );
        $primary_navigation_text_color = listify_theme_color( 'color-navigation-text' );
        $secondary_navigation_text_color = listify_theme_color( 'color-secondary-navigation-text' );
        $secondary_navigation_background_color = listify_theme_color( 'color-secondary-navigation-background' );
        $tertiary_navigation_text_color = listify_theme_color( 'color-tertiary-navigation-text' );
        $tertiary_navigation_background_color = listify_theme_color( 'color-tertiary-navigation-background' );

        // main header
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.search-overlay',
                '.primary-header'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $header_background_color )
            )
        ) );

		if ( is_front_page() ) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.site-header--transparent .primary-header'
				),
				'declarations' => array(
					'background-color' => 'transparent'
				),
				'media' => 'screen and (min-width: 992px)'
			) );
		}

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
				'.primary.nav-menu .current-cart .current-cart-count'
			),
            'declarations' => array(
                'border-color' => esc_attr( $header_background_color )
            )
        ) );

		// add a border if the header is white
		if ( 
			'#ffffff' == $header_background_color &&
			( 
				is_post_type_archive( 'job_listing' ) ||
				is_tax( array( 'job_listing_category', 'job_listing_tag', 'job_listing_type' ) )
			)
		) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.primary-header'
				),
				'declarations' => array(
					'border-bottom' => '1px solid rgba(86, 87, 88, 0.2)'
				)
			) );
		}

        // mega menu on large devices
        if ( ! in_array( self::$scheme, array( 'default', 'green-flash', 'green' ) ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu.secondary .sub-menu.category-list'
                ),
                'declarations' => array(
                    'background-color' => esc_attr( $header_background_color )
                ),
                'media' => 'screen and (min-width: 768px)'
            ) );
        } else {
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu.secondary .sub-menu.category-list'
                ),
                'declarations' => array(
                    'background-color' => esc_attr( $page_background )
                ),
                'media' => 'screen and (min-width: 768px)'
            ) );
        }

        // default menu links should have a color, but this gets overwritten down the line
        // sub menu link items are the same as the `$header_background_color` as well
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu a',
                '.nav-menu li:before',
                '.nav-menu li:after',
                '.nav-menu a:before',
                '.nav-menu a:after',
                '.nav-menu ul a',
                '.nav-menu.primary ul ul a',
                '.nav-menu.primary ul ul li:before',
                '.nav-menu.primary ul ul li:after',
            ),
            'declarations' => array(
                'color' => esc_attr( $header_background_color )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.primary ul ul a:hover'
            ),
            'declarations' => array(
                'color' => Listify_Customizer_CSS::darken( esc_attr( $header_background_color ), -25 )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        // set the primary navigation text color on large devices
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.primary a',
                '.nav-menu.primary li:before',
                '.nav-menu.primary li:after',
                '.nav-menu.primary a:before',
                '.nav-menu.primary a:after',
            ),
            'declarations' => array(
                'color' => esc_attr( $primary_navigation_text_color )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        // close button on search overlay needs to stand off header (like navigation text)
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.search-overlay a.search-overlay-toggle',
            ),
            'declarations' => array(
                'color' => esc_attr( $primary_navigation_text_color )
            )
        ) );

		// transparnet header on the homepage
		if ( is_front_page() && 'transparent' == get_theme_mod( 'home-header-style', 'default' ) ) {
			Listify_Customizer_CSS::add( array(
				'selectors' => array(
					'.site-header--transparent .site-title a',
					'.site-header--transparent .site-description',
					'.nav-menu.primary a',
					'.nav-menu.primary li:before',
					'.nav-menu.primary li:after',
					'.nav-menu.primary a:before',
					'.nav-menu.primary a:after',
				),
				'declarations' => array(
					'color' => esc_attr( apply_filters( 'listify_home_header_transparent_text_color', '#ffffff' ) )
				),
				'media' => 'screen and (min-width: 992px)'
			) );
		}

        // set the secondary navigation background color
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.main-navigation',
            ),
            'declarations' => array(
                'background-color' => esc_attr( $secondary_navigation_background_color )
            )
        ) );

        // set the secondary navigation top level links
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.secondary > li > a',
                '.nav-menu.secondary > li > a:before',
                '.nav-menu.secondary > li > a:after',
                '.nav-menu.secondary > li:before',
                '.nav-menu.secondary > li:after'
            ),
            'declarations' => array(
                'color' => esc_attr( $secondary_navigation_text_color )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.secondary ul ul a:hover',
            ),
            'declarations' => array(
                'color' => esc_attr( Listify_Customizer_CSS::darken( $secondary_navigation_text_color, -25 ) )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu .children.category-list .container:before',
                '.nav-menu .sub-menu.category-list .container:before',
                'ul.nav-menu .children.category-list .container:before',
                'ul.nav-menu .sub-menu.category-list .container:before'
            ),
            'declarations' => array(
                'border-top-color' => esc_attr( $secondary_navigation_background_color )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.navigation-bar-toggle',
                '.search-overlay-toggle'
            ),
            'declarations' => array(
                'color' => esc_attr( $secondary_navigation_text_color )
            )
        ) );

        // set the tertiary navigation background color
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.tertiary-navigation'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $tertiary_navigation_background_color )
            )
        ) );

        // set the secondary navigation top level links
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.tertiary > ul > li > a',
                '.nav-menu.tertiary > li > a',
                '.nav-menu.tertiary > li > a:before',
                '.nav-menu.tertiary > li > a:after',
                '.nav-menu.tertiary > li:before',
                '.nav-menu.tertiary > li:after'
            ),
            'declarations' => array(
                'color' => esc_attr( $tertiary_navigation_text_color )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.nav-menu.tertiary ul ul a:hover',
            ),
            'declarations' => array(
                'color' => esc_attr( Listify_Customizer_CSS::darken( $tertiary_navigation_text_color, -25 ) )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        // see above, with no @media
        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.tertiary-navigation .navigation-bar-toggle'
            ),
            'declarations' => array(
                'color' => esc_attr( $tertiary_navigation_text_color )
            )
        ) );

        // dark color scheme has some special things
        if ( in_array( self::$scheme, array( 'dark', 'light-gray' ) ) ) {
            // mega menu, and cta
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu.secondary .sub-menu.category-list',
                ),
                'declarations' => array(
                    'background-color' => esc_attr( $header_background_color )
                ),
                'media' => 'screen and (min-width: 768px)'
            ) );

            // dropdown arrow
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    'ul.nav-menu .sub-menu.category-list .container:before'
                ),
                'declarations' => array(
                    'border-top-color' => esc_attr( $secondary_navigation_background_color )
                )
            ) );
        }

        // light scheme has a white header so the text needs to be updated
        if ( in_array( self::$scheme, array( 'radical-red', 'iced-coffee', 'light-gray' ) ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu a',
                    '.nav-menu li:before',
                    '.nav-menu li:after',
                    '.nav-menu a:before',
                    '.nav-menu a:after',
                    '.nav-menu ul a',
                    '.nav-menu.primary ul ul a',
                    '.nav-menu.primary ul ul li:before',
                    '.nav-menu.primary ul ul li:after',
                ),
                'declarations' => array(
                    'color' => esc_attr( $primary_navigation_text_color )
                )
            ) );

            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.nav-menu.primary ul ul a:hover',
                ),
                'declarations' => array(
                    'color' => esc_attr( Listify_Customizer_CSS::darken( $primary_navigation_text_color, -10 ) )
                ),
				'media' => 'screen and (min-width: 992px)'
            ) );
        }

        /**
         * Primary color used for buttons, and important things
         */
        $primary = listify_theme_color( 'color-primary' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.listify_widget_panel_listing_tags .tag.active:before',
                '.job-package-includes li:before',
                '.woocommerce-tabs .tabs .active a',
                'body:not(.facetwp) .locate-me:before',

				// WooCommerce
				'.woocommerce .quantity input[type="button"]'
            ),
            'declarations' => array(
                'color' => esc_attr( $primary )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input[type="button"].facetwp-reset:hover',
                'input[type="button"].facetwp-reset:focus',
                '.tabbed-listings-tabs a:hover',
                '.tabbed-listings-tabs a.active',
                '.archive-job_listing-toggle.active',
                'body:not(.facetwp) .locate-me:hover:before'
            ),
            'declarations' => array(
                'color' => esc_attr( Listify_Customizer_CSS::darken( $primary, -35 ) )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input[type="button"]',
                'input[type="reset"]',
                'input[type="submit"]',
                '.button',
                '.facetwp-type-slider .noUi-connect',
                '.ui-slider .ui-slider-range',
                '.listing-owner',
                '.comment-rating',
                '.job_listing-rating-average',
                '.map-marker.active:after',
                '.cluster',
                '.widget_calendar tbody a',
                '.job_listing-author-info-more a:first-child',
				'.load_more_jobs',
				'.listify-badge',
				'.listing-featured-badge',

				// WP Job Manager
				'button.update_results'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $primary )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                'input[type="button"]:hover',
                'input[type="button"]:focus',

                'input[type="reset"]:hover',
                'input[type="reset"]:focus',
                'input[type="submit"]:hover',
                'input[type="submit"]:focus',
                '.button:hover',
                '.button:focus',
                '::selection',

				// WP Job Manager
				'button.update_results:hover',
				'button.update_results.refreshing',
                '.load_more_jobs:hover',
            ),
            'declarations' => array(
                'background-color' => esc_attr( Listify_Customizer_CSS::darken( $primary, -5 ) )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '::-moz-selection'
            ),
            'declarations' => array(
                'background-color' => esc_attr( Listify_Customizer_CSS::darken( $primary, -5 ) )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.tabbed-listings-tabs a:hover',
                '.tabbed-listings-tabs a.active',
                '.archive-job_listing-toggle.active',
                'li.job-package:hover',
                '.job_listing_packages ul.job_packages li:hover',
                '.facetwp-type-slider .noUi-horizontal .noUi-handle',
                '.ui-slider .ui-slider-handle',

				// WooCommerce
				'.woocommerce-message',
				'.job-manager-message',
                '.woocommerce-info',
            ),
            'declarations' => array(
                'border-color' => esc_attr( $primary )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.listing-featured--outline .job_listing-entry-header:before'
            ),
            'declarations' => array(
                'box-shadow' => 'inset 0 0 0 3px ' . esc_attr( $primary )
            )
        ) );

        // a colored header means the cart count needs to be white, and text the header color
        if ( in_array( self::$scheme, array( 'green-flash', 'green', 'classic' ) ) ) {
            $decs = array(
                'color' => esc_attr( $header_background_color ),
                'background-color' => '#ffffff',
                'border-color' => esc_attr( $header_background_color )
            );
        } else {
            $decs = array(
                'color' => '#ffffff',
                'background-color' => esc_attr( $primary ),
                'border-color' => esc_attr( $header_background_color )
            );
        }

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.primary.nav-menu .current-cart .current-cart-count'
            ),
            'declarations' => $decs,
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Accent color used for more subtle items
         */
        $accent = listify_theme_color( 'color-accent' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.widget_layered_nav li.chosen a:after',
                '.widget_layered_nav li.chosen a',
                '.ion-ios-star:before',
                '.ion-ios-star-half:before',
                '.upload-images:hover .upload-area',
                '.comment-author .rating-stars .ion-ios-star',
                '.job_listing_packages ul.job_packages li label',
                '.upload-images:hover',
                '.search-choice-close:after',
				'.claimed-ribbon span:before',
				'.filter_by_tag a.active:after',

				// WooCommerce
				'.woocommerce-tabs .tabs .active a'
            ),
            'declarations' => array(
                'color' => esc_attr( $accent )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.button-secondary',
                'input[type="button"].facetwp-reset',
                '.job_listing-author-info-more a:last-child',

				// WooCommerce
				'.type-product .onsale',
				'.type-product .price ins',
				'.job-package-tag'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $accent )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.button-secondary:hover',
                '.button-secondary:focus',
                'input[type="button"].facetwp-reset:hover',
                'input[type="button"].facetwp-reset:focus'
            ),
            'declarations' => array(
                'background-color' => esc_attr( Listify_Customizer_CSS::darken( $accent, -5 ) )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.upload-images:hover'
            ),
            'declarations' => array(
                'border-color' => esc_attr( $accent )
            )
        ) );

        /**
         * Footer
         */

        $widgets_text = listify_theme_color( 'color-footer-widgets-text' );
        $widgets_background = listify_theme_color( 'color-footer-widgets-background' );
        $copy_text = listify_theme_color( 'color-footer-text' );
        $copy_background = listify_theme_color( 'color-footer-background' );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.site-footer-widgets'
            ),
            'declarations' => array(
                'color' => esc_attr( $widgets_text ),
                'background-color' => esc_attr( $widgets_background )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.footer-widget',
                '.footer-widget a',
                '.footer-widget a:hover',
                '.site-social a:hover'
            ),
            'declarations' => array(
                'color' => esc_attr( $widgets_text )
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.site-footer',
                '.site-social a'
            ),
            'declarations' => array(
                'color' => esc_attr( $copy_text ),
            )
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.site-footer'
            ),
            'declarations' => array(
                'background-color' => esc_attr( $copy_background )
            )
        ) );
    }

}

new Listify_Customizer_OutputCSS_Colors();
