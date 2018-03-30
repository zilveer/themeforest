<?php

if ( !function_exists( 'mysite_lang_test' ) ) :
/**
 *
 */
function mysite_lang_test( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'lang' => '',
	), $atts));
	
	$lang_active = ICL_LANGUAGE_CODE;
	
	if ( $lang == $lang_active ) {
		return $content;
	}
}
endif;

add_shortcode( 'wpml_translate', 'mysite_lang_test' );

?>