<?php
/**
 * This class handles all functionality for the page builder frontend editor
 *
 * @category   Pagebuilder
 * @package    ZnFramework
 * @author     Balasa Sorin Stefan ( ThemeFuzz )
 * @copyright  Copyright (c) Balasa Sorin Stefan
 * @link       http://themeforest.net/user/ThemeFuzz
 */

class ZnPbCustomCode {

	function __construct() {
		add_action( 'wp' , array(&$this, 'add_inline_code') );
	}

	function add_inline_code(){
		$css = get_post_meta( zn_get_the_id(), 'zn_page_custom_css', true );
		$js  = get_post_meta( zn_get_the_id(), 'zn_page_custom_js', true );

		if ( ! empty( $css ) ) {
			ZN()->add_inline_css( $css );
		}
		if ( ! empty( $js ) ) {
			ZN()->add_inline_js(
				array(
					'zn_page_custom_js' => $js
				)
			);
		}
	}

}