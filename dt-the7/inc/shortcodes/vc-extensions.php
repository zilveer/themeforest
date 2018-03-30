<?php
/**
 * Visual Composer extensions.
 *
 */

/**
 * Class The7_Inc_Shortcodes_VCParams adds custom params vor VC shortcodes interface.
 */
class The7_Inc_Shortcodes_VCParams {

	/**
	 * The7_Inc_Shortcodes_VCParams constructor.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register_params' ), 15 );
	}

	/**
	 * Return taxonomies list.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function taxonomy_settings_field( $settings, $value ) {
		$value_arr = $value_inner = $value;
		if ( !is_array($value_arr) ) {
			$value_arr = array_map( 'trim', explode(',', $value_arr) );
		}

		$terms_slugs = array();
		$terms_fields = array();
		if ( !empty($settings['taxonomy']) ) {

			$terms = get_terms( $settings['taxonomy'] );
			if ( $terms && !is_wp_error($terms) ) {

				foreach( $terms as $term ) {
					$terms_slugs[] = $term->slug;

					$terms_fields[] = sprintf(
						'<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
						$settings['param_name'] . '-' . $term->slug,
						$settings['param_name'].' '.$settings['type'],
						$settings['param_name'],
						$term->slug,
						checked( in_array( $term->slug, $value_arr ), true, false ),
						$term->name
					);
				}

			}

			$value_inner = implode( ',', array_intersect( $value_arr, $terms_slugs ) );
		}

		$dependency = vc_generate_dependencies_attributes($settings);
		return '<div class="dt_taxonomy_block">'
		       .'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value_inner.'" '.$dependency.' />'
		       .'<div class="dt_taxonomy_terms">'
		       .implode( $terms_fields )
		       .'</div>'
		       .'</div>';
	}

	/**
	 * Return posts list.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function posttype_settings_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes($settings);

		$posts_fields = array();
		$posts_names = array();

		$value_arr = $value_inner = $value;
		if ( !is_array($value_arr) ) {
			$value_arr = array_map( 'trim', explode(',', $value_arr) );
		}

		if ( !empty($settings['posttype']) ) {

			$args = array(
				'no_found_rows' => 1,
				'ignore_sticky_posts' => 1,
				'posts_per_page' => -1,
				'post_type' => $settings['posttype'],
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC'
			);

			$dt_query = new WP_Query( $args );
			if ( $dt_query->have_posts() ) {

				foreach( $dt_query->posts as $p ) {

					$posts_names[] = $p->post_name;

					$posts_fields[] = sprintf(
						'<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
						$settings['param_name'] . '-' . $p->post_name,
						$settings['param_name'] . ' ' . $settings['type'],
						$settings['param_name'],
						$p->post_name,
						checked( in_array( $p->post_name, $value_arr ), true, false ),
						$p->post_title
					);

				}

			}

			$value_inner = implode( ',', array_intersect( $value_arr, $posts_names ) );
		}

		return '<div class="dt_posttype_block">'
		       .'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value_inner.'" '.$dependency.' />'
		       .'<div class="dt_posttype_post">'
		       .implode( $posts_fields )
		       .'</div>'
		       .'</div>';
	}

	/**
	 * Return title.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function title_settings_field( $settings, $value ) {
		return '<input type="hidden" name="' . $settings['param_name'] . '" class="wpb_vc_param_value" value="" />';
	}

	/**
	 * Return spacing param.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function spacing_param( $settings, $value ) {
		$units = ( isset( $settings['units'] ) ? $settings['units'] : array( 'px' ) );
		if ( ! is_array( $units ) ) {
			$units = array_map( 'trim', explode( ',', $units ) );
		}

		$html = '';

		// Spacing.
		$max = 999;
		$spacing = explode( ' ', $value );
		$sanitized_spacing = array();
		foreach ( array( 'Top', 'Right', 'Bottom', 'Left' ) as $i=>$desc ) {
			// Get space value.
			$val = '0';
			$dim_val = ( $spacing[ $i ] ? $spacing[ $i ] : '0px' );
			preg_match( '/([-0-9]*)(.*)/', $dim_val, $matches );
			if ( ! empty( $matches[1] ) ) {
				$val = min( intval( $matches[1] ), $max );
			}

			// Get space units.
			$cur_units = current( $units );
			if ( ! empty( $matches[2] ) && in_array( $matches[2], $units ) ) {
				$cur_units = $matches[2];
			}

			$sanitized_spacing[ $i ] = $val . $cur_units;

			// Units HTML.
			$units_html = '';
			if ( count( $units ) > 1 ) {
				foreach ( $units as $u ) {
					$units_html .= '<option value="' . esc_attr( $u ) . '" ' . selected( $u, $cur_units, false ) . '>' . esc_html( $u ) . '</option>';
				}
				$units_html = '<select class="dt_spacing-units" data-units="' . esc_attr( $cur_units ) . '">' . $units_html . '</select>';
			} else {
				$units_html = '<span class="dt_spacing-units" data-units="' . esc_attr( $cur_units ) . '">' . esc_html( $cur_units ) . '</span>';
			}

			$units_html = '<div class="dt_spacing-units-wrap">' . $units_html . '</div>';

			// Space HTML.
			$html .= '<div class="dt_spacing-space"><input type="number" max="' . $max . '" class="dt_spacing-value" value="' . esc_attr( $val ) . '">' . $units_html . '<span class="vc_description vc_clearfix">' . $desc . '<span></div>';
		}

		// Param value.
		$html = '<input type="hidden" class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( implode( ' ', $sanitized_spacing ) ) . '">' . $html;

		return $html;
	}

	/**
	 * Return number param.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function number_param( $settings, $value ) {
		$number_obj = new DT_VCNumberParam( $value, $settings['units'] );

		$units_html = $number_obj->get_units_html();
		if ( $units_html ) {
			$units_html = '<div class="dt_number-units-wrap">' . $units_html . '</div>';
		}

		// Restrictions.
		$min = ( isset( $settings['min'] ) ? ' min="' . intval( $settings['min'] ) . '"' : '' );
		$max = ( isset( $settings['max'] ) ? ' max="' . intval( $settings['max'] ) . '"' : '' );
		$step = ( isset( $settings['step'] ) ? ' step="' . intval( $settings['step'] ) . '"' : '' );

		$number = $number_obj->get_number();
		$cur_units = $number_obj->get_units();
		$value = $number_obj->get_value();

		$html = '<input type="hidden" class="wpb_vc_param_value" data-units="' . esc_attr( $cur_units ) . '" name="' . esc_attr( $settings['param_name'] ) . '" value="' .  esc_attr( $value ). '">';
		$html .= '<input type="number"' . $min . $max . $step . ' class="dt_number-value" value="' . esc_attr( $number ) . '">' . $units_html;

		return $html;
	}

	/**
	 * Return dimensions param.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function dimensions_param( $settings, $value ) {
		// Sanitize value.
		$_value = array_slice( array_map( 'absint', explode( 'x', strtolower( $value ) ) ), 0, 2 );
		// Make sure that all values is set.
		for ( $i = 0; $i < 2; $i++ ) {
			if ( empty( $_value[ $i ] ) ) {
				$_value[ $i ] = '';
			}
		}

		// Sanitize heading.
		$width_heading = ( isset( $settings['headings'][0] ) ? $settings['headings'][0] : '' );
		$height_heading = ( isset( $settings['headings'][1] ) ? $settings['headings'][1] : '' );

		// Return HTML.
		$param_name = $settings['param_name'];
		$width = $_value[0];
		$height = $_value[1];
		$param_value = '';
		if ( $width || $height ) {
			$param_value = implode( 'x', $_value );
		}

		return '<input type="hidden" class="wpb_vc_param_value" name="' . esc_attr( $param_name ) . '" value="' . esc_attr( $param_value ) . '">'
		.'<div class="dt_dimensions-value-wrap"><div class="wpb_element_label">' . $width_heading . '</div><input type="number" min="0" class="dt_dimensions-width" value="' . esc_attr( $width ) .  '"></div>'
		.'<span class="dt_dimensions-delimiter">&times;</span>'
		.'<div class="dt_dimensions-value-wrap"><div class="wpb_element_label">' . $height_heading . '</div><input type="number" min="0" class="dt_dimensions-height" value="' . esc_attr( $height ) . '"></div>';
	}

	/**
	 * Return font style param. Checkboxes italic, bold, uppercase.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function font_style_param( $settings, $value ) {
		$_value = self::sanitize_font_style_param( $value );

		$italic = $_value[0];
		$bold = $_value[1];
		$uppercase = $_value[2];

		return '<input type="hidden" class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '">'
			. '<label class="dt_font_style-italic-label"><input type="checkbox" class="dt_font_style-italic" value="italic" ' . checked( 'italic', $italic, false ) . '>' . esc_html( _x( 'Italic', 'backend', 'the7mk2' ) ) . '</label>'
			. '<label class="dt_font_style-bold-label"><input type="checkbox" class="dt_font_style-bold" value="bold" ' . checked( 'bold', $bold, false ) . '>' . esc_html( _x( 'Bold', 'backend','the7mk2' ) ) . '</label>'
			. '<label class="dt_font_style-uppercase-label"><input type="checkbox" class="dt_font_style-uppercase" value="uppercase" ' . checked( 'uppercase', $uppercase, false ) . '>' . esc_html( _x( 'Capitalize', 'backend','the7mk2' ) ) . '</label>';
	}

	/**
	 * Return font style param. Checkboxes italic, bold, uppercase.
	 *
	 * @param array $settings
	 * @param string $value
	 *
	 * @return string
	 */
	public function switch_param( $settings, $value ) {
		if ( ! $value ) {
			$value = $settings['value'];
		}

		list( $on, $off ) = array_values( $settings['options'] );
		list( $on_title, $off_title ) = array_keys( $settings['options'] );

		$values_attr = json_encode( array( $on, $off ) );
		$param_name = $settings['param_name'];
		$id = 'dt_switch-' . $param_name;
		return '<div class="the7-onoffswitch">'
		       .'<input type="checkbox" id="' . esc_attr( $id ) . '" name="' . esc_attr( $param_name ) . '" data-values="' . esc_attr( $values_attr ) . '" value="' . esc_attr( $value ) . '" class="wpb_vc_param_value the7-onoffswitch-checkbox ' . esc_attr( $param_name ) . '" ' . checked( $value, $on, false ) . '>'
		       .'<label class="the7-onoffswitch-label" for="' . esc_attr( $id ) . '">'
			       .'<div class="the7-onoffswitch-inner">'
						.'<div class="the7-onoffswitch-active">'
							.'<div class="the7-onoffswitch-switch">'. esc_html( $on_title ) .'</div>'
						.'</div>'
						.'<div class="the7-onoffswitch-inactive">'
							.'<div class="the7-onoffswitch-switch">'. esc_html( $off_title ) .'</div>'
						.'</div>'
		           .'</div>'
		       .'</label>'
			.'</div>';
	}

	/**
	 * Register params.
	 */
	public function register_params() {
		$dir = get_template_directory_uri();

		vc_add_shortcode_param( 'dt_title', array( $this, 'title_settings_field' ) );
		vc_add_shortcode_param( 'dt_taxonomy', array( $this, 'taxonomy_settings_field' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_posttype', array( $this, 'posttype_settings_field' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_spacing', array( $this, 'spacing_param' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_dimensions', array( $this, 'dimensions_param' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_number', array( $this, 'number_param' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_font_style', array( $this, 'font_style_param' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_switch', array( $this, 'switch_param' ), $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
	}

	/**
	 * Sanitize font style param.
	 *
	 * @param string|array $value
	 *
	 * @return array
	 */
	public static function sanitize_font_style_param( $value ) {
		$_value = $value;
		if ( ! is_array( $_value ) ) {
			$_value = array_map( 'trim', explode( ':', $value ) );
		}

		$defaults = array( 'normal', 'normal', 'none' );
		foreach ( $defaults as $i=>$default ) {
			if ( empty( $_value[ $i ] ) ) {
				$_value[ $i ] = $default;
			}
		}

		return $_value;
	}
}

/**
 * Class DT_VCNumberParam
 */
class DT_VCNumberParam {

	/**
	 * @var int|string
	 */
	protected $number;

	/**
	 * @var array
	 */
	protected $units;

	/**
	 * @var string
	 */
	protected $cur_units;

	/**
	 * DT_VCNumberParam constructor.
	 *
	 * @param       $value
	 * @param array $units
	 */
	public function __construct( $value, $units = array() ) {
		if ( ! is_array( $units ) ) {
			$units = array_map( 'trim', explode( ',', $units ) );
		}

		$this->units = $units;

		preg_match( '/([-0-9]*)(.*)/', $value, $matches );
		$this->number = '';
		if ( isset( $matches[1] ) ) {
			$this->number = ( is_numeric( $matches[1] ) ? intval( $matches[1] ) : '' );
		}

		$this->cur_units = current( $units );
		if ( ! empty( $matches[2] ) && in_array( $matches[2], $units ) ) {
			$this->cur_units = $matches[2];
		}
	}

	/**
	 * Return number.
	 *
	 * @return int|string
	 */
	public function get_number() {
		return $this->number;
	}

	/**
	 * Return current units.
	 *
	 * @return string
	 */
	public function get_units() {
		return $this->cur_units;
	}

	/**
	 * Return combined number and units.
	 *
	 * @return string
	 */
	public function get_value() {
		if ( '' === $this->number ) {
			return '';
		}

		return $this->number . $this->cur_units;
	}

	/**
	 * Return units selector HTML. If units is empty return empty string.
	 *
	 * @return string
	 */
	public function get_units_html() {
		if ( ! $this->units ) {
			return '';
		}

		if ( count( $this->units ) == 1 ) {
			return '<span>' . esc_html( $this->cur_units ) . '</span>';
		}

		$units_html = '';
		foreach ( $this->units as $u ) {
			$units_html .= '<option value="' . esc_attr( $u ) . '" ' . selected( $u, $this->cur_units, false ) . '>' . esc_html( $u ) . '</option>';
		}
		$units_html = '<select class="dt_number-units">' . $units_html . '</select>';

		return $units_html;
	}
}

if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	// Add VC params.
	new The7_Inc_Shortcodes_VCParams();

	/**
	 * Register custom vc_pie shortcode script.
	 */
	function presscore_vc_register_custom_vc_pie_script() {
		wp_register_script( 'vc_dt_pie', PRESSCORE_THEME_URI . '/inc/shortcodes/vc_extend/jquery.vc_chart.js', array('jquery', 'waypoints', 'progressCircle'), wp_get_theme()->get( 'Version' ) );
	}

	add_action( 'wp_enqueue_scripts', 'presscore_vc_register_custom_vc_pie_script', 15 );
}

if ( ! function_exists( 'presscore_vc_add_stripe_decoration_classes' ) ):

	/**
	 * Add stripe HTML decoration classes based on theme options.
	 *
	 * @param array $classes
	 * @param array $atts
	 *
	 * @return array
	 */
	function presscore_vc_add_stripe_decoration_classes( $classes, $atts ) {
		$type = esc_attr( $atts['type'] );
		if ( in_array( $type, array( '1', '2', '3' ) ) ) {
			switch( of_get_option( "stripes-stripe_{$type}_content_boxes_decoration", 'none' ) ) {
				case 'shadow':
					$classes[] = 'shadow-element-decoration';
					break;
				case 'outline':
					$classes[] = 'outline-element-decoration';
					break;
			}

			if ( 'show' == of_get_option( "stripes-stripe_{$type}_outline", 'hide' ) ) {
				$classes[] = 'outline-stripe-decoration';
			}
		}

		return $classes;
	}

	add_filter( 'presscore_vc_row_stripe_class', 'presscore_vc_add_stripe_decoration_classes', 10, 2 );

endif;
