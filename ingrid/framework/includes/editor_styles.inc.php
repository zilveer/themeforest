<?php
add_filter( 'mce_buttons_2', 'wps_mce_buttons_2' );
/**
* Show the style dropdown on the second row of the editor toolbar.
*
* @param array $buttons Exising buttons
* @return array Amended buttons
*/
function wps_mce_buttons_2( $buttons ) {

    // Check if style select has not already been added
    if ( isset( $buttons['styleselect'] ) )
        return;

    // Appears not, so add it ourselves.
    array_unshift( $buttons, 'styleselect' );
    return $buttons;

}

add_filter( 'tiny_mce_before_init', 'wps_mce_before_init' );
/**
* Add column entries to the style dropdown.
*
* 'text-domain' should be replaced with your theme or plugin text domain for
* translations.
*
* @param array $settings Existing settings for all toolbar items
* @return array Amended settings
*/
function wps_mce_before_init( $settings ) {

    $style_formats = array(

		array(
			'title' => __( '1/2 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_half',
			),
		array(
			'title' => __( '1/2 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_half last',
			),
		array(
			'title' => __( '1/3 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_third',
			),
		array(
			'title' => __( '1/3 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_third last',
			),
		array(
			'title' => __( '2/3 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'two_third',
			),
		array(
			'title' => __( '2/3 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'two_third last',
			),
		array(
			'title' => __( '1/4 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_fourth',
			),
		array(
			'title' => __( '1/4 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_fourth last',
			),
		array(
			'title' => __( '3/4 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'three_fourth',
			),
		array(
			'title' => __( '3/4 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'three_fourth last',
			),
		array(
			'title' => __( '1/5 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_fifth',
			),
		array(
			'title' => __( '1/5 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'one_fifth last',
			),
		array(
			'title' => __( '2/5 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'two_fifth',
			),
		array(
			'title' => __( '2/5 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'two_fifth last',
			),
		array(
			'title' => __( '3/5 Column', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'three_fifth',
			),
		array(
			'title' => __( '3/5 Column (Last in a row)', 'ingrid' ),
			'block' => 'div',
			'wrapper' => 'p',
			'classes' => 'three_fifth last',
			)		
		);

	// Check if there are some styles already
	if ( !empty($settings['style_formats']) )
		$settings['style_formats'] = array_merge( $settings['style_formats'], json_encode( $style_formats ) );
	else
		$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}
?>