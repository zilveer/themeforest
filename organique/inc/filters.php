<?php
/**
 * Filters for Organique WP theme
 *
 * @package Organique
 */



/**
 * Add the .light classes to the titles
 */
function customized_title( $title ) {
	if ( ! is_admin() ) {
		return lighted_title( $title );
	} else {
		return $title;
	}

}
// add_filter( "the_title", "customized_title" );




/**
 * Make widget titles as all the other titles are - first word normal, other bold
 */
add_filter( "widget_title", "lighted_title" );


/**
 * Change excerpt length
 */
function organique_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'organique_excerpt_length', 999 );



/**
 * Add custom menu walker to all the menus
 */

function organique_bootstrap_menu_walker( $args ) {
	include_once ( get_template_directory() . '/bower_components/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php' );

	if ( class_exists( 'wp_bootstrap_navwalker' ) ) {
		return array_merge( $args, array(
			'walker' => new wp_bootstrap_navwalker()
		) );
	}
}
add_filter( 'wp_nav_menu_args', 'organique_bootstrap_menu_walker' );


/**
 * Though the wp_bootstrap_navwalker class works great, it disabled the level 0 links, so we can fix that via filter
 */
function organique_navwalker_links( $atts, $item ) {
	$atts = (array) $atts;

	if ( array_key_exists( 'aria-haspopup' , $atts) ) {
		unset( $atts['data-toggle'] );
		unset( $atts['aria-haspopup'] );

		$atts['href'] = ! empty( $item->url ) ? $item->url : '';
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'organique_navwalker_links', 10, 2 );



/**
 * Add shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );



/**
 * Remove the gallery inline styling
 */
// add_filter( 'use_default_gallery_style', '__return_false' );


function add_disabled_editor_buttons($buttons) {
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'hr';

	return $buttons;
}
add_filter('mce_buttons', 'add_disabled_editor_buttons');




/**
 * Add custom row styles to the Page Builder
 *
 * @param  array $styles
 * @return array
 */
function organique_panels_row_styles( $styles ) {
	$styles['wide-light']    = _x('Wide Light', 'backend', 'organique_wp');
	$styles['light-pattern'] = _x('Light Pattern', 'backend', 'organique_wp');
	$styles['no-container']  = _x('No container (suitable for Google maps)', 'backend', 'organique_wp');
	return $styles;
}
add_filter( 'siteorigin_panels_row_styles', 'organique_panels_row_styles', 10, 1 );



/**
 * Add custom row styles to the Page Builder
 *
 * @param  string $default
 * @param  array $row_data
 * @return string
 */
function organique_panels_before_row( $default, $row_data ) {
	if ( in_array( 'wide-light', $row_data[ 'style' ] ) ) {
		return '</div></div></div>
			<div class="banners"><div class="container"><div class="row"><div class="col-xs-12">';
	} else if ( in_array( 'light-pattern', $row_data[ 'style' ] ) ) {
		return '</div></div></div>
			<div class="light-paper-pattern"><div class="container"><div class="row"><div class="col-xs-12">';
	} else if ( in_array( 'no-container', $row_data[ 'style' ] ) ) {
		return '</div></div></div>';
	} else {
		return $default;
	}
}
add_filter( 'siteorigin_panels_before_row', 'organique_panels_before_row', 10, 2 );



/**
 * Add custom row styles to the Page Builder
 *
 * @param  string $default
 * @param  array $row_data
 * @return string
 */
function organique_panels_after_row( $default, $row_data ) {
	if (
		in_array( 'wide-light', $row_data[ 'style' ] ) ||
		in_array( 'light-pattern', $row_data[ 'style' ] )
	) {
		return '</div></div></div></div>
			<div class="container"><div class="row"><div class="col-xs-12">';
	} else if ( in_array( 'no-container', $row_data[ 'style' ] ) ) {
		return '<div class="container"><div class="row"><div class="col-xs-12">';
	} else {
		return $default;
	}
}
add_filter( 'siteorigin_panels_after_row', 'organique_panels_after_row', 10, 2 );



/**
 * Custom tag font size
 */
function set_tag_cloud_sizes($args) {
	$args['smallest'] = 8;
	$args['largest'] = 11;
	return $args;
}
add_filter( 'widget_tag_cloud_args','set_tag_cloud_sizes' );



/**
 * Change the OT list item to the list of the locations for the Google Maps
 *
 * @param  array $settings
 * @return array
 */
function organique_list_item_settings( $settings ) {
	unset( $settings[0] ); // remove image
	unset( $settings[2] ); // remove description

	$settings[1]['label'] = 'Coordinates';
	$settings[1]['desc']  = 'Get this from <a href="https://maps.google.com/" target="_blank">Google Maps</a>, longitude and latitude separated by comma, like <code>40.724885,-74.00264</code> for the New York.';

	return $settings;
}
add_filter( 'ot_list_item_settings', 'organique_list_item_settings', 10, 1 );



/**
* Filter to modify original shortcodes data
*
* @param array $shortcodes Basic plugin shortcodes
* @return array Modified array
*/
function modify_su_buttons( $shortcodes ) {
	// unregister original note, add alert instead
	unset( $shortcodes['button'] );

	$shortcodes[ 'button' ] = array(
		'name'     => _x( 'Button', 'backend', 'organique_wp' ),
		'type'     => 'wrap',
		'group'    => 'content',
		'atts'     => array(
			'url' => array(
				'values'  => array( ),
				'default' => home_url(),
				'name'    => _x( 'Link', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Button link', 'backend', 'organique_wp' )
			),
			'target' => array(
				'type'    => 'select',
				'values'  => array(
					'self'    => _x( 'Same tab', 'backend', 'organique_wp' ),
					'blank'   => _x( 'New tab', 'backend', 'organique_wp' )
				),
				'default' => 'self',
				'name'    => _x( 'Target', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Button link target', 'backend', 'organique_wp' )
			),
			'style' => array(
				'type'    => 'select',
				'values'  => array(
					'default' => _x( 'Default', 'backend', 'organique_wp' ),
					'flat'    => _x( 'Flat', 'backend', 'organique_wp' ),
					'soft'    => _x( 'Soft', 'backend', 'organique_wp' ),
					'glass'   => _x( 'Glass', 'backend', 'organique_wp' ),
					'bubbles' => _x( 'Bubbles', 'backend', 'organique_wp' ),
					'noise'   => _x( 'Noise', 'backend', 'organique_wp' ),
					'stroked' => _x( 'Stroked', 'backend', 'organique_wp' ),
					'3d'      => _x( '3D', 'backend', 'organique_wp' )
				),
				'default' => 'default',
				'name'    => _x( 'Style', 'backend', 'organique_wp' ), 'desc' => _x( 'Button background style preset', 'backend', 'organique_wp' )
			),
			'background' => array(
				'type'    => 'color',
				'values'  => array( ),
				'default' => '#2D89EF',
				'name'    => _x( 'Background', 'backend', 'organique_wp' ), 'desc' => _x( 'Button background color', 'backend', 'organique_wp' )
			),
			'color' => array(
				'type'    => 'color',
				'values'  => array( ),
				'default' => '#FFFFFF',
				'name'    => _x( 'Text color', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Button text color', 'backend', 'organique_wp' )
			),
			'size' => array(
				'type'    => 'slider',
				'min'     => 1,
				'max'     => 20,
				'step'    => 1,
				'default' => 3,
				'name'    => _x( 'Size', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Button size', 'backend', 'organique_wp' )
			),
			'wide' => array(
				'type'    => 'bool',
				'default' => 'no',
				'name'    => _x( 'Fluid', 'backend', 'organique_wp' ), 'desc' => _x( 'Fluid buttons has 100% width', 'backend', 'organique_wp' )
			),
			'center' => array(
				'type'    => 'bool',
				'default' => 'no',
				'name'    => _x( 'Centered', 'backend', 'organique_wp' ), 'desc' => _x( 'Is button centered on the page', 'backend', 'organique_wp' )
			),
			'radius' => array(
				'type'    => 'select',
				'values'  => array(
					'auto'    => _x( 'Auto', 'backend', 'organique_wp' ),
					'round'   => _x( 'Round', 'backend', 'organique_wp' ),
					'0'       => _x( 'Square', 'backend', 'organique_wp' ),
					'5'       => '5px',
					'10'      => '10px',
					'20'      => '20px'
				),
				'default' => 'auto',
				'name'    => _x( 'Radius', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Radius of button corners. Auto-radius calculation based on button size', 'backend', 'organique_wp' )
			),
			'icon' => array(
				'type'    => 'icon',
				'default' => '',
				'name'    => _x( 'Icon', 'backend', 'organique_wp' ),
				'desc'    => _x( 'You can upload custom icon for this button or pick a built-in icon', 'backend', 'organique_wp' )
			),
			'icon_color' => array(
				'type'    => 'color',
				'default' => '#FFFFFF',
				'name'    => _x( 'Icon color', 'backend', 'organique_wp' ),
				'desc'    => _x( 'This color will be applied to the selected icon. Does not works with uploaded icons', 'backend', 'organique_wp' )
			),
			'text_shadow' => array(
				'type'    => 'shadow',
				'default' => 'none',
				'name'    => _x( 'Text shadow', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Button text shadow', 'backend', 'organique_wp' )
			),
			'desc' => array(
				'default' => '',
				'name'    => _x( 'Description', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Small description under button text. This option is incompatible with icon.', 'backend', 'organique_wp' )
			),
			'onclick' => array(
				'default' => '',
				'name'    => _x( 'onClick', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Advanced JavaScript code for onClick action', 'backend', 'organique_wp' )
			),
			'class' => array(
				'default' => '',
				'name'    => _x( 'Class', 'backend', 'organique_wp' ),
				'desc'    => _x( 'Extra CSS class', 'backend', 'organique_wp' )
			)
		),
		'content'  => _x( 'Button text', 'backend', 'organique_wp' ),
		'desc'     => _x( 'Styled button', 'backend', 'organique_wp' ),
		'icon'     => 'heart',
		'function' => 'organique_su_button'
	);

	// Return modified data
	return $shortcodes;
}
add_filter( 'su/data/shortcodes', 'modify_su_buttons' );


/**
 * Backwards compatibility for title tags theme support in WordPress 4.1
 */
if ( ! function_exists( '_wp_render_title_tag' ) && ! function_exists( 'organique_render_title' ) ) {
	function organique_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'organique_render_title' );
}

// Remove references to SiteOrigin Premium.
add_filter( 'siteorigin_premium_upgrade_teaser', '__return_false' );
