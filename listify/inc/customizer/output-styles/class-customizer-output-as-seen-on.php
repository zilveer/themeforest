<?php
/**
 * Output buttons.
 *
 * @since 1.3.0
 * @package Customizer
 */
class 
	Listify_Customizer_OutputCSS_ASO
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
        $background = listify_theme_color( 'color-as-seen-on-background' );

		Listify_Customizer_CSS::add( array(
            'selectors' => array( '.as-seen-on' ),
            'declarations' => array( 'background-color' => $background )
        ) );
    }
}

new Listify_Customizer_OutputCSS_ASO();
