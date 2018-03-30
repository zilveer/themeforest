<?php
/**
 * Output buttons.
 *
 * @since 1.3.0
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_Buttons
extends
	Listify_Customizer_OutputCSS {

	public function __construct() {
		$this->priority = 20;

		parent::__construct();
	}

	/**
	 * Add items to the CSS object that will be built and output.
	 *
	 * @since 1.5.0
	 * @return void
	 */
    public function output() {
        $button_style = listify_theme_mod( 'content-button-style', 'default' );
        $primary_color = listify_theme_color( 'color-primary' );
        $accent_color = listify_theme_color( 'color-accent' );

        $base_selectors = array(
            'input[type="button"]',
            'input[type="reset"]',
            'input[type="submit"]',
            '.button',
            '.button.button-small',
            '.facetwp-type-slider .noUi-connect',
            '.ui-slider .ui-slider-range',
            '.listing-owner',
            '.comment-rating',
            '.job_listing-rating-average',
            '.map-marker.active:after',
            '.widget_calendar tbody a',
            '.job_listing-author-info-more a:first-child',

			// WP Job Manager
			'button.update_results',
			'.load_more_jobs',
        );

        if ( 'solid' == esc_attr( $button_style ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => $base_selectors,
                'declarations' => array(
                    'box-shadow' => 'none'
                )
            ) );
        } else if ( 'outline' == esc_attr( $button_style ) ) {
            Listify_Customizer_CSS::add( array(
                'selectors' => $base_selectors,
                'declarations' => array(
                    'color' => esc_attr( $primary_color ),
                    'background-color' => 'transparent',
                    'box-shadow' => 'inset 0 0 0 2px ' . esc_attr( $primary_color )
                )
            ) );

            // icon
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.job_listing-author-info-more a:first-child span:before'
                ),
                'declarations' => array(
                    'color' => esc_attr( $primary_color ),
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
                    '.button.button-small:hover',
                    '.button.button-small:focus',
                    '::selection',

					// WP Job Manager
					'button.update_results:hover',
					'button.update_results.refreshing',
					'.load_more_jobs',
                ),
                'declarations' => array(
					'color' => '#ffffff',
                    'background-color' => esc_attr( $primary_color )
                )
            ) );

            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.button-secondary',
                    'input[type="button"].facetwp-reset',
                    '.job_listing-author-info-more a:last-child'
                ),
                'declarations' => array(
                    'color' => esc_attr( $accent_color ),
                    'background-color' => 'transparent',
                    'box-shadow' => 'inset 0 0 0 2px ' . esc_attr( $accent_color )
                )
            ) );

            // icon
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.job_listing-author-info-more a:last-child span:before'
                ),
                'declarations' => array(
                    'color' => esc_attr( $accent_color ),
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
                    'background-color' => esc_attr( $accent_color )
                )
            ) );

            // any button on a cover should be white
            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.listing-cover.has-image a.button',
                    '.page-cover.has-image a.button',
                    '.entry-cover.has-image a.button',
                    '.listing-cover.has-image button:not([role="presentation"])',
                    '.listing-cover.has-image input[type="button"]',
                    '.listing-cover.has-image input[type="reset"]',
                    '.listing-cover.has-image input[type="submit"]',
                    '.page-cover.has-image button:not([role="presentation"])',
                    '.page-cover.has-image input[type="button"]',
                    '.page-cover.has-image input[type="reset"]',
                    '.page-cover.has-image input[type="submit"]',
                    '.feature-callout-cover a.button'
                ),
                'declarations' => array(
                    'color' => '#fff',
                    'box-shadow' => 'inset 0 0 0 2px #ffffff',
                    'background-color' => 'transparent'
                )
            ) );

            Listify_Customizer_CSS::add( array(
                'selectors' => array(
                    '.listing-cover.has-image a.button:hover',
                    '.page-cover.has-image a.button:hover',
                    '.entry-cover.has-image a.button:hover',
                    '.listing-cover.has-image button:not([role="presentation"]):hover',
                    '.listing-cover.has-image input[type="button"]:hover',
                    '.listing-cover.has-image input[type="reset"]:hover',
                    '.listing-cover.has-image input[type="submit"]:hover',
                    '.page-cover.has-image button:not([role="presentation"]):hover',
                    '.page-cover.has-image input[type="button"]:hover',
                    '.page-cover.has-image input[type="reset"]:hover',
                    '.page-cover.has-image input[type="submit"]:hover',
                    '.feature-callout-cover a.button:hover'
                ),
                'declarations' => array(
                    'color' => esc_attr( $primary_color ),
                    'box-shadow' => 'none',
                    'background-color' => '#fff'
                )
            ) );
        }
    }

}

new Listify_Customizer_OutputCSS_Buttons();
