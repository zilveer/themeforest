<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

// Make sure the plugin is active
if( ! defined( 'YOUXI_SHORTCODE_VERSION' ) ) {
	return;
}

/* ==========================================================================
	Youxi Shortcode plugin config
============================================================================= */

/**
 * Disable enqueueing bootstrap
 */
add_filter( 'youxi_shortcode_enqueue_bootstrap', '__return_false' );

/**
 * Mapbox Access Token
 */
add_filter( 'youxi_shortcode_mapbox_access_token', 'shiroi_mapbox_access_token' );

/**
 * Add the tinymce and page builder to `post`
 */
if( ! function_exists( 'shiroi_shortcode_tinymce_post_types' ) ) {

	function shiroi_shortcode_tinymce_post_types( $post_types ) {
		
		if( ! is_array( $post_types ) ) {
			$post_types = array( $post_types );
		}
		$post_types[] = 'post';

		return $post_types;
	}
}
add_filter( 'youxi_shortcode_tinymce_post_types', 'shiroi_shortcode_tinymce_post_types' );

/**
 * Hook to modify some shortcodes
 */
if( ! function_exists( 'shiroi_youxi_shortcode_register' ) ) {

	function shiroi_youxi_shortcode_register( $manager ) {

		$remove = array(
			'container', 
			'fullwidth', 
			'call_to_action', 
			'clients', 
			'icon_box', 
			'posts', 
			'service', 
			'team', 
			'slide', 
			'testimonials', 
			'testimonial', 
			'widget_area', 
			'counter', 
			'twitter'
		);
		foreach( $remove as $r ) {
			$manager->remove_shortcode( $r );
		}
	}
}
add_action( 'youxi_shortcode_register', 'shiroi_youxi_shortcode_register' );

/**
 * Set Default Column Size
 */
if( ! function_exists( 'shiroi_shortcode_column_default_type' ) ):

function shiroi_shortcode_column_default_type() {
	return 'md';
}
endif;
add_filter( 'youxi_shortcode_column_default_type', 'shiroi_shortcode_column_default_type' );

/**
 * Define column sizes
 */
if( ! function_exists( 'shiroi_shortcode_column_types' ) ):

function shiroi_shortcode_column_types( $column_types ) {
	return array(
		'xs' => esc_html__( 'Extra Small (&lt; 480px)', 'youxi' ), 
		'sm' => esc_html__( 'Small (&ge; 768px)', 'youxi' ), 
		'md' => esc_html__( 'Medium (&ge; 992px)', 'youxi' ), 
		'lg' => esc_html__( 'Large (&ge; 1200px)', 'youxi' )
	);
}
endif;
add_filter( 'youxi_shortcode_column_types', 'shiroi_shortcode_column_types' );

/* ==========================================================================
	Dropcap
============================================================================= */

/**
 * Dropcap shortcode callback
 */
if( ! function_exists( 'shiroi_dropcap_shortcode_callback' ) ):

function shiroi_dropcap_shortcode_callback( $atts, $content, $tag ) {

	return '<span class="dropcap">' . substr( strip_tags( $content ), 0, 1 ) . '</span>' . substr( $content, 1 );
}
endif;
add_filter( 'youxi_shortcode_dropcap_callback', create_function( '', 'return "shiroi_dropcap_shortcode_callback";' ) );

/* ==========================================================================
	Heading
============================================================================= */

/**
 * Heading shortcode callback
 */
if( ! function_exists( 'shiroi_heading_shortcode_cb' ) ):

	function shiroi_heading_shortcode_cb( $atts, $content, $tag ) {

		extract( $atts, EXTR_SKIP );

		$classes = array();

		if( 'bordered' == $style ) {
			$classes[] = $style;
			$content = '<span>' . $content . '</span>';
		}

		if( preg_match( '/^(center|right)$/', $style ) ) {
			$classes[] = 'text-' . $alignment;
		}

		if( is_string( $remove_margins ) ) {
			$remove_margins = array_unique( explode( ',', $remove_margins ) );
			foreach( $remove_margins as $remove ) {
				if( in_array( $remove, array( 'top', 'bottom' ) ) ) {
					$classes[] = 'no-margin-' . trim( $remove );
				}
			}
		}

		$classes[] = sanitize_html_class( trim( $extra_classes ) );

		if( $classes ) {
			$classes = ' class="' . esc_attr( join( ' ', array_filter( $classes ) ) ) . '"';
		} else {
			$classes = '';
		}

		return '<' . $element . $classes . '>' . $content . '</' . $element . '>';
	}
endif;
add_filter( 'youxi_shortcode_heading_callback', create_function( '', 'return "shiroi_heading_shortcode_cb";' ) );

/**
 * Heading shortcode atts
 */
if( ! function_exists( 'shiroi_heading_shortcode_atts' ) ):

	function shiroi_heading_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'alignment' => array(
				'type' => 'radio', 
				'label' => __( 'Heading Alignment', 'shiroi' ), 
				'description' => __( 'Choose here the heading text alignment.', 'shiroi' ), 
				'choices' => array(
					'left' => __( 'Left', 'shiroi' ), 
					'center' => __( 'Center', 'shiroi' ), 
					'right' => __( 'Right', 'shiroi' )
				), 
				'std' => 'left', 
				'fieldset' => 'style'
			), 
			'style' => array(
				'type' => 'radio', 
				'label' => __( 'Heading Style', 'shiroi' ), 
				'description' => __( 'Choose the heading style.', 'shiroi' ), 
				'choices' => array(
					0 => __( 'Default', 'shiroi' ), 
					'bordered' => __( 'Bordered', 'shiroi' )
				), 
				'std' => 0
			), 
			'remove_margins' => array(
				'type' => 'checkboxlist', 
				'label' => __( 'Remove Margins', 'shiroi' ), 
				'uncheckable' => true, 
				'description' => __( 'Choose here which margins to remove from the heading.', 'shiroi' ), 
				'choices' => array(
					'top' => __( 'Top', 'shiroi' ), 
					'bottom' => __( 'Bottom', 'shiroi' ), 
				), 
				'serialize' => 'js:function( data ) {
					return $.map( data, function( data, key ) {
						if( !! parseInt( data ) )
							return key;
					});
				}', 
				'deserialize' => 'js:function( data ) {
					var temp = {};
					_.each( ( data + "" ).split( "," ), function( c ) {
						temp[ c ] = 1;
					});
					return temp;
				}', 
				'fieldset' => 'style'
			), 
			'extra_classes' => array(
				'type' => 'text', 
				'label' => __( 'Extra CSS Classes', 'shiroi' ), 
				'description' => __( 'Enter here your custom CSS classes to apply to the heading.', 'shiroi' ), 
				'std' => '', 
				'fieldset' => 'style'
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_heading_atts', 'shiroi_heading_shortcode_atts' );

/**
 * Heading shortcode fieldsets
 */
if( ! function_exists( 'shiroi_heading_shortcode_fieldsets' ) ):

function shiroi_heading_shortcode_fieldsets( $fieldsets ) {
	return array_merge( $fieldsets, array(
		'style' => array(
			'id' => 'style', 
			'title' => __( 'Styling', 'shiroi' )
		)
	));
}
endif;
add_filter( 'youxi_shortcode_heading_fieldsets', 'shiroi_heading_shortcode_fieldsets' );

/* ==========================================================================
	Pricing Table (OK)
============================================================================= */

/**
 * Pricing Table shortcode callback
 */
if( ! function_exists( 'shiroi_pricing_table_shortcode_cb' ) ):

function shiroi_pricing_table_shortcode_cb( $atts, $content, $tag ) {

	extract( $atts, EXTR_SKIP );

	switch( $btn_action ) {
		case 'page':
			$url = get_permalink( $post_id );
			$url = $url ? $url : '#';
			break;
	}

	$o = '<div class="pricing-table' . ( $featured ? ' featured' : '' ) . '">';

		$o .= '<div class="table-header">';
			$o .= '<div class="name">' . $title . '</div>';
		$o .= '</div>';

		if( $show_price ):

			$o .= '<div class="table-price">';

				$o .= '<div class="price text-' . esc_attr( $color ) . '">';
					$o .= '<span>' . esc_html( $currency ) . '</span>';
					$o .= esc_html( $price );
				$o .= '</div>';

				$o .= '<div class="price-description">';
					$o .= esc_html( $price_description );
				$o .= '</div>';

			$o .= '</div>';

		endif;

		$o .= '<div class="table-features">';
			$o .= $content;
		$o .= '</div>';

		if( $show_btn ):

			$o .= '<div class="table-footer">';
				$o .= '<a href="' . esc_url( $url ) . '" class="btn btn-' . esc_attr( $color ) . '">' . $btn_text . '</a>';
			$o .= '</div>';

		endif;

	$o .= '</div>';

	return $o;
}
endif;
add_filter( 'youxi_shortcode_pricing_table_callback', create_function( '', 'return "shiroi_pricing_table_shortcode_cb";' ) );

/* ==========================================================================
	Progressbar (OK)
============================================================================= */

/**
 * Progressbar shortcode atts
 */
if( ! function_exists( 'shiroi_progressbar_shortcode_atts' ) ):

function shiroi_progressbar_shortcode_atts( $atts ) {

	return array_merge( array(
		'label' => array(
			'type' => 'text', 
			'label' => esc_html__( 'Label', 'shiroi' ), 
			'description' => esc_html__( 'Enter here the progressbar label.', 'shiroi' ), 
			'std' => ''
		)
	), $atts );
}
endif;
add_filter( 'youxi_shortcode_progressbar_atts', 'shiroi_progressbar_shortcode_atts' );

/**
 * Progressbar shortcode callback
 */
if( ! function_exists( 'shiroi_progressbar_shortcode_cb' ) ):

function shiroi_progressbar_shortcode_cb( $atts, $content, $tag ) {

	$container_classes = array( 'progress' );
	$bar_classes = array( 'progress-bar' );

	extract( $atts, EXTR_SKIP );

	if( $type ) {
		$bar_classes[] = "progress-bar-{$type}";
	}
	if( $striped ) {
		$container_classes[] = "progress-striped";
	}
	if( $animated ) {
		$container_classes[] = 'active';
	}

	$o = '<div class="progress-counter">';

		if( $label ):
			$o .= '<span class="progress-label">' . esc_html( $label ) . '</span>';
		endif;

		$o .= '<div class="' . esc_attr( implode( ' ', $container_classes ) ) . '">';
			$o .= '<div class="' . esc_attr( implode( ' ', $bar_classes ) ) . '" role="progressbar" aria-valuenow="' . esc_attr( $value ) . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . esc_attr( $value ) . '%"></div>';
		$o .= '</div>';

	$o .= '</div>';

	return $o;
}
endif;
add_filter( 'youxi_shortcode_progressbar_callback', create_function( '', 'return "shiroi_progressbar_shortcode_cb";' ) );

/* ==========================================================================
	Separator
============================================================================= */

/**
 * Separator shortcode callback
 */
if( ! function_exists( 'shiroi_separator_shortcode_cb' ) ):

	function shiroi_separator_shortcode_cb( $atts, $content, $tag ) {
		return '<div class="spacer-' . esc_attr( $atts['size'] ) . ( $atts['extra_classes'] ? esc_attr( ' ' . $atts['extra_classes'] ) : '' ) . '"></div>';
	}
endif;
add_filter( 'youxi_shortcode_separator_callback', create_function( '', 'return "shiroi_separator_shortcode_cb";' ) );

/**
 * Separator shortcode atts
 */
if( ! function_exists( 'shiroi_separator_shortcode_atts' ) ):

	function shiroi_separator_shortcode_atts( $atts ) {

		return array_merge( $atts, array(
			'size' => array(
				'type' => 'uislider', 
				'label' => __( 'Separator Size', 'shiroi' ), 
				'description' => __( 'Choose the height of the separator.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 10, 
					'max' => 100, 
					'step' => 10
				), 
				'std' => 10
			), 
			'extra_classes' => array(
				'type' => 'text', 
				'label' => __( 'Extra CSS Classes', 'shiroi' ), 
				'description' => __( 'Enter here your custom CSS classes to apply to the separator.', 'shiroi' ), 
				'std' => ''
			)
		));
	}
endif;
add_filter( 'youxi_shortcode_separator_atts', 'shiroi_separator_shortcode_atts' );

/* ==========================================================================
	Slider
============================================================================= */

/**
 * Slider shortcode atts
 */
if( ! function_exists( 'shiroi_slider_shortcode_atts' ) ):

	function shiroi_slider_shortcode_atts( $atts ) {

		return array(
			'nav' => array(
				'type' => 'select', 
				'label' => __( 'Navigation', 'shiroi' ), 
				'description' => __( 'Specify the slider navigation type.', 'shiroi' ), 
				'choices' => array(
					0 => __( 'None', 'shiroi' ), 
					'thumbs' => __( 'Thumbs', 'shiroi' ), 
					'dots' => __( 'Dots', 'shiroi' )
				), 
				'std' => 'thumbs'
			), 
			'fit' => array(
				'type' => 'select', 
				'label' => __( 'Image Scale Mode', 'shiroi' ), 
				'description' => __( 'Specify how the images are scaled in the slider.', 'shiroi' ), 
				'choices' => array(
					'none' => __( 'None', 'shiroi' ), 
					'cover' => __( 'Cover', 'shiroi' ), 
					'contain' => __( 'Contain', 'shiroi' )
				), 
				'std' => 'cover'
			), 
			'loop' => array(
				'type' => 'switch', 
				'label' => __( 'Loop', 'shiroi' ), 
				'description' => __( 'Switch to allow the slider to go to the first from the last slide.', 'shiroi' ), 
				'std' => false
			), 
			'transition' => array(
				'type' => 'select', 
				'label' => __( 'Transition', 'shiroi' ), 
				'description' => __( 'Specify the slider transition type.', 'shiroi' ), 
				'choices' => array(
					'slide' => __( 'Slide', 'shiroi' ), 
					'crossfade' => __( 'Cross Fade', 'shiroi' ), 
					'dissolve' => __( 'Dissolve', 'shiroi' )
				), 
				'std' => 'slide'
			), 
			'transitionDuration' => array(
				'type' => 'uislider', 
				'label' => __( 'Transition Duration', 'shiroi' ), 
				'description' => __( 'Specify the slider transition duration.', 'shiroi' ), 
				'widgetopts' => array(
					'min' => 300, 
					'max' => 5000, 
					'step' => 10
				), 
				'std' => 300
			), 
			'ids' => array(
				'type' => 'image', 
				'label' => __( 'Images', 'shiroi' ), 
				'description' => __( 'Choose the images for the slider.', 'shiroi' ), 
				'multiple' => true, 
				'serialize' => 'js:function( data ) {
					return data.join( "," );
				}', 
				'deserialize' => 'js:function( data ) {
					return ( data + "" ).split( "," );
				}'
			)
		);
	}
endif;
add_filter( 'youxi_shortcode_slider_atts', 'shiroi_slider_shortcode_atts' );

/**
 * Slider shortcode content
 */
add_filter( 'youxi_shortcode_slider_content', '__return_empty_array' );

/**
 * Slider Shortcode Handler
 */
function shiroi_shortcode_slider_cb( $atts, $content, $tag ) {

	extract( $atts, EXTR_SKIP );

	return shiroi_fotorama( explode( ',', $ids ), array(
		'width'              => '100%', 
		'nav'                => $nav, 
		'fit'                => $fit, 
		'loop'               => $loop, 
		'margin'             => 0, 
		'transition'         => $transition, 
		'transitionduration' => $transitionDuration, 
		'attachment_size'    => shiroi_thumbnail_size()

	), '', '', false );
}
add_filter( 'youxi_shortcode_slider_callback', create_function( '', 'return "shiroi_shortcode_slider_cb";' ) );

/* ==========================================================================
	Tabs (OK)
============================================================================= */

/**
 * Tabs shortcode callback
 */
if( ! function_exists( 'shiroi_tabs_shortcode_cb' ) ):

function shiroi_tabs_shortcode_cb( $atts, $content, $tag ) {

	extract( $atts, EXTR_PREFIX_ALL, 'tabs' );

	$tabs = Youxi_Shortcode::to_array( $content, true );
	
	if( is_array( $tabs ) && ! empty( $tabs ) ) {

		$o = '<ul class="nav nav-' . esc_attr( $tabs_type ) . '">';
			
		foreach( $tabs as $index => $tab ) {

			if( isset( $tab['tag'], $tab['atts'] ) && Youxi_Shortcode::prefix( 'tab' ) == $tab['tag'] ) {

				extract( $tab['atts'], EXTR_PREFIX_ALL, 'tab' );

				$tab_id = sanitize_key( $tab_title . Youxi_Shortcode::count( 'tabs' ) . $index );
				
				$o .= '<li class="nav-item' . ( $index ? '' : ' active' ) . '">';

					$o .= '<a data-toggle="tab" href="#' . esc_attr( $tab_id ) . '" role="tab" aria-controls="' . esc_attr( $tab_id ) . '">';

						$o .= $tab_title;

					$o .= '</a>';

				$o .= '</li>';
			}
		}

		$o .= '</ul>';

		/* Recount before rendering tabs */
		Youxi_Shortcode::recount( 'tab' );

		$o .= '<div class="tab-content">';

			$o .= do_shortcode( $content );

		return $o . '</div>';
	}

	return '';
}
endif;
add_filter( 'youxi_shortcode_tabs_callback', create_function( '', 'return "shiroi_tabs_shortcode_cb";' ) );
