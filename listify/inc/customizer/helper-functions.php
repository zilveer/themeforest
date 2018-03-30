<?php
/**
 * Deprecated.
 *
 * Remains for backwards compatbility. Future users should call get_theme_mod().
 *
 * @since unknown
 * @param string $key
 * @param string $default
 * @return mixed
 */
function listify_theme_mod( $key, $default = null ) {
    return get_theme_mod( $key, $default );
}

/**
 * Get information about a control group
 *
 * @param string $group_id
 * @param bool $group
 * @return 1.5.0
 */
function listify_get_control_group( $group_id ) {
	$groups = include( dirname( __FILE__ ) . '/definitions/control-groups/' . $group_id . '.php' );

	return apply_filters( 'listify_control_group_' . $group_id, $groups );
}

/**
 * Get information about a control group
 *
 * @param string $group_id
 * @param bool $group
 * @return array
 */
function listify_get_control_group_defaults( $group_id, $group ) {
	$groups = listify_get_control_group( $group_id );

    return $groups[ $group ][ 'controls' ];
}

/**
 * Get the current color scheme
 *
 * Returns the controls instead of the total scheme data
 * for backwards compat
 *
 * @since unknown
 * @return array $scheme_data Scheme data controls
 */
function listify_get_color_scheme_data() {
    return listify_get_control_group_defaults( 'color-scheme', get_theme_mod( 'color-scheme', 'classic' ) );
}

/**
 * Get the color for the current color scheme
 *
 * @since 1.5.0
 * @param string $mod_key
 * @return string
 */
function listify_theme_color( $mod_key ) {
	$default = false;
	$scheme = listify_get_color_scheme_data();

	if ( isset( $scheme[ $mod_key ] ) ) {
		$default = $scheme[ $mod_key ];
	}

	return get_theme_mod( $mod_key, $default );
}

/**
 * Get the current font kit
 *
 * @since 1.5.0
 * @return array $scheme_data Font kit data for the selected font pack
 */
function listify_get_font_pack_data() {
    return listify_get_control_group_defaults( 'typography-font-pack', get_theme_mod( 'typography-font-pack', 'karla' ) );
}

/**
 * Get the color for the current color scheme
 *
 * @since 1.5.0
 * @param string $mod_key
 * @return string
 */
function listify_theme_font( $mod_key ) {
	$default = false;
	$pack = listify_get_font_pack_data();

	if ( isset( $pack[ $mod_key ] ) ) {
		$default = $pack[ $mod_key ];
	}

	return get_theme_mod( $mod_key, $default );
}

/**
 * Get the current style kit data
 *
 * @since 1.5.0
 * @return array Control group defaults
 */
function listify_get_style_kit_data() {
    return listify_get_control_group_defaults( 'style-kit', get_theme_mod( 'style-kit', 'classic' ) );
}

/**
 * Create a bunch of font controls at once.
 *
 * @since 1.5.0
 * @param string $section
 * @param string $element
 * @param object $wp_customize
 * @return void
 */
function listify_font_style_options( $section, $element, $wp_customize ) {
	// font family
	$wp_customize->add_setting( 'typography-' . $element . '-font-family', array(
		'default' => listify_theme_font( 'typography-' . $element . '-font-family' ),
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( new Listify_Customize_Control_BigChoices(
		$wp_customize,
		'typography-' . $element . '-font-family',
		array(
			'label'   => __( 'Font Family', 'listify' ),
			'choices' => 'fonts',
			'section' => $section
		)
	) );

	// font size
	$wp_customize->add_setting( 'typography-' . $element . '-font-size', array(
		'default' => listify_theme_font( 'typography-' . $element . '-font-size' ),
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'typography-' . $element . '-font-size', array(
		'label'   => __( 'Font Size', 'listify' ),
		'type'    => 'number',
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 78,
			'step'  => 1,
		),
		'section' => $section
	) );

	// font weight
	$wp_customize->add_setting( 'typography-' . $element . '-font-weight', array(
		'default' => listify_theme_font( 'typography-' . $element . '-font-weight' ),
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'typography-' . $element . '-font-weight', array(
		'label'   => __( 'Font Weight', 'listify' ),
		'type' => 'select',
		'choices' => array(
			'normal' => __( 'Normal', 'listify' ),
			'bold' => __( 'Bold', 'listify' )
		),
		'section' => $section
	) );

	// line height
	$wp_customize->add_setting( 'typography-' . $element . '-line-height', array(
		'default' => listify_theme_font( 'typography-' . $element . '-line-height' ),
		'transport' => 'postMessage'
	) );

	$wp_customize->add_control( 'typography-' . $element . '-line-height', array(
		'label'   => __( 'Line Height', 'listify' ),
		'type'    => 'number',
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 5,
			'step'  => 0.25,
		),
		'section' => $section
	) );
}

/**
 * Use a list of dirty theme mods (that contain more than a term ID) and
 * compare them against a list of terms to get the label.
 *
 * Only add non-empty and non-default values. WordPress does not remove a theme
 * mod key once it has been added even if the customizer resets it or sets it
 * to a blank string. 
 *
 * @since 1.5.0
 * @param array $terms
 * @param array $mods
 * @return array $output
 */
function listify_get_decorated_mod_list( $mods, $taxonomy = 'job_listing_category', $type = 'colors' ) {
	global $wpdb;

	$ids = $output = array();

	if ( 'colors' == $type ) {
		$pattern = '/marker-color-(.*)/';
	} else {
		$pattern = '/listings-' . $taxonomy . '-(.*)-icon/';
	}

	foreach ( $mods as $key => $value ) {
		if ( ! $value || '' == $value ) {
			continue;
		}

		if ( preg_match( $pattern, $key, $matches ) ) {
			if ( isset( $matches[1] ) ) {
				// undo our sanitization for keys still using a slug
				if ( 'colors' != $type ) {
					$matches[1] = str_replace( '_', '-', $matches[1] );
				}

				// figure out what to compare against
				$where = "term_id = '%s'";

				if ( ! is_numeric( $matches[1] ) ) {
					$where = "slug = '%s'";
				}

				$_where = $wpdb->prepare( $where, $matches[1] );

				$term = $wpdb->get_var( "SELECT name FROM {$wpdb->terms} WHERE $_where" );

				if ( ! $term ) {
					continue;
				}

				$output[] = array(
					'key' => $key,
					'value' => $value,
					'label' => $term
				);
			}
		}
	}

	return $output;
}
