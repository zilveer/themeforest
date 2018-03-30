<?php
/**
 * Output navigation information.
 *
 * @since unknown
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_Typography
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
         * Body
         */
        $body_font_family = listify_theme_font( 'typography-body-font-family' );
        $body_font_weight = listify_theme_font( 'typography-body-font-weight' );
        $body_font_size = listify_theme_font( 'typography-body-font-size' );
        $body_line_height = listify_theme_font( 'typography-body-line-height' );

        $selectors = array(
            ':not(.wp-core-ui) button',
            'body',
            'input',
            'select',
            'textarea'
        );

        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $body_font_family, 'google' ),
                'font-weight' => esc_attr( $body_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $body_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $body_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Page Headings
         */
        $page_headings_font_family = listify_theme_font( 'typography-page-headings-font-family' );
        $page_headings_font_weight = listify_theme_font( 'typography-page-headings-font-weight' );
        $page_headings_font_size = listify_theme_font( 'typography-page-headings-font-size' );
        $page_headings_line_height = listify_theme_font( 'typography-page-headings-line-height' );

        $selectors = array(
            '.page-title',
            '.job_listing-title',
            '.popup-title',
            '.homepage-cover .home-widget-title'
        );

        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $page_headings_font_family, 'google' ),
                'font-weight' => esc_attr( $page_headings_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $page_headings_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $page_headings_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => array(
                '.homepage-cover .home-widget-title'
            ),
            'declarations' => array(
                'font-size' => absint( $page_headings_font_size * 1.5 ) . 'px'
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Content Headings
         */
        $content_headings_font_family = listify_theme_font( 'typography-content-headings-font-family' );
        $content_headings_font_weight = listify_theme_font( 'typography-content-headings-font-weight' );
        $content_headings_font_size = listify_theme_font( 'typography-content-headings-font-size' );
        $content_headings_line_height = listify_theme_font( 'typography-content-headings-line-height' );

        $selectors = array(
            '.widget-title',
            '.comment-reply-title',
        );

        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $content_headings_font_family, 'google' ),
                'font-weight' => esc_attr( $content_headings_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $content_headings_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $content_headings_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Homepage Headings
         */
        $home_headings_font_family = listify_theme_font( 'typography-home-headings-font-family' );
        $home_headings_font_weight = listify_theme_font( 'typography-home-headings-font-weight' );
        $home_headings_font_size = listify_theme_font( 'typography-home-headings-font-size' );
        $home_headings_line_height = listify_theme_font( 'typography-home-headings-line-height' );

        $selectors = array(
            '.home-widget-title',
        );

        $extra_selectors = array_merge( $selectors, array(
            '.callout-feature-content h2',
            '.home-feature-title h2'
        ) );

        Listify_Customizer_CSS::add( array(
            'selectors' => $extra_selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $home_headings_font_family, 'google' ),
                'font-weight' => esc_attr( $home_headings_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $home_headings_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $home_headings_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Homepage Descriptions
         */
        $home_description_font_family = listify_theme_font( 'typography-home-description-font-family' );
        $home_description_font_weight = listify_theme_font( 'typography-home-description-font-weight' );
        $home_description_font_size = listify_theme_font( 'typography-home-description-font-size' );
        $home_description_line_height = listify_theme_font( 'typography-home-description-line-height' );

        $selectors = array(
            '.home-widget-description',
        );

        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $home_description_font_family, 'google' ),
                'font-weight' => esc_attr( $home_description_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $home_description_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $home_description_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

        /**
         * Buttons
         */
        $buttons_font_family = listify_theme_font( 'typography-button-font-family' );
        $buttons_font_weight = listify_theme_font( 'typography-button-font-weight' );
        $buttons_font_size = listify_theme_font( 'typography-button-font-size' );
        $buttons_line_height = listify_theme_font( 'typography-button-line-height' );

        $selectors = array(
            'button:not([role="presentation"])',
            'input[type="button"]',
            'input[type="reset"]',
            'input[type="submit"]',
            '.button'
        );

        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-family' => Listify_Customizer::$fonts->get_font_stack( $buttons_font_family, 'google' ),
                'font-weight' => esc_attr( $buttons_font_weight )
            )
        ) );

        // size and line height only on desktop
        Listify_Customizer_CSS::add( array(
            'selectors' => $selectors,
            'declarations' => array(
                'font-size' => absint( $buttons_font_size ) . 'px',
                'line-height' => Listify_Customizer::$fonts->get_line_height( $buttons_line_height )
            ),
            'media' => 'screen and (min-width: 992px)'
        ) );

    }

}

new Listify_Customizer_OutputCSS_Typography();
