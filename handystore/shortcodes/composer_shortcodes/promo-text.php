<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_promo_text' );

function handy_promo_text(){

  vc_map( array(
      "name" => esc_html__( 'Promo Text', 'plumtree' ),
      "base" => "handy_promo_text",
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
  	  "description" => esc_html__( 'Output Promo text with icon', 'plumtree' ),
  		'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      "params" => array(
    			array(
    				'type' => 'textfield',
    				'heading' => esc_html__( 'Title text', 'plumtree' ),
    				'param_name' => 'el_title',
            'value' => __('Title goes here', 'plumtree'),
    			),
          array(
            'type' => 'font_container',
            'param_name' => 'font_container',
            'value' => 'font_size:18|text_align:left',
            'settings' => array(
              'fields' => array(
                'text_align',
                'font_size',
                'color',
                'text_align_description' => __( 'Select text alignment.', 'plumtree' ),
                'font_size_description' => __( 'Enter font size.', 'plumtree' ),
                'color_description' => __( 'Select heading color.', 'plumtree' ),
              ),
            ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __( 'Use custom font family?', 'plumtree' ),
            'param_name' => 'use_custom_fonts',
            'value' => array( __( 'Yes', 'plumtree' ) => 'yes' ),
            'description' => __( 'Add custom font-family from Google Fonts library.', 'plumtree' ),
          ),
          array(
            'type' => 'google_fonts',
            'param_name' => 'google_fonts',
            'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
            'settings' => array(
              'fields' => array(
                'font_family_description' => __( 'Select font family.', 'plumtree' ),
                'font_style_description' => __( 'Select font styling.', 'plumtree' ),
              ),
            ),
            'dependency' => array(
              'element' => 'use_custom_fonts',
              'value' => 'yes',
            ),
          ),
          array(
            'type' => 'vc_link',
            'heading' => __( 'URL (Link)', 'plumtree' ),
            'param_name' => 'link',
            'description' => __( 'Add link to promo text heading.', 'plumtree' ),
          ),
          array(
    				'type' => 'textarea',
    				'heading' => __( 'Promo content Text', 'plumtree' ),
    				'param_name' => 'text',
    				'value' => __( 'This is custom promo text description', 'plumtree' ),
    				'description' => '',
    			),
          array(
            'type' => 'checkbox',
            'heading' => __( 'Add icon?', 'plumtree' ),
            'param_name' => 'add_icon',
            'value' => array( __( 'Yes', 'plumtree' ) => 'yes' ),
            'description' => '',
          ),
          array(
    				'type' => 'dropdown',
    				'heading' => __( 'Icon library', 'plumtree' ),
    				'value' => array(
    					__( 'Font Awesome', 'plumtree' ) => 'fontawesome',
    					__( 'Open Iconic', 'plumtree' ) => 'openiconic',
    					__( 'Typicons', 'plumtree' ) => 'typicons',
    					__( 'Entypo', 'plumtree' ) => 'entypo',
    					__( 'Linecons', 'plumtree' ) => 'linecons',
    					__( 'Mono Social', 'plumtree' ) => 'monosocial',
    				),
    				'admin_label' => true,
    				'param_name' => 'icon_library',
    				'description' => __( 'Select icon library.', 'plumtree' ),
            'dependency' => array(
    					'element' => 'add_icon',
    					'value' => 'yes',
    				),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_fontawesome',
    				'value' => 'fa fa-adjust', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false,
    					// default true, display an "EMPTY" icon?
    					'iconsPerPage' => 4000,
    					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'fontawesome',
    				),
    				'description' => __( 'Select icon from library.', 'plumtree' ),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_openiconic',
    				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false, // default true, display an "EMPTY" icon?
    					'type' => 'openiconic',
    					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'openiconic',
    				),
    				'description' => __( 'Select icon from library.', 'plumtree' ),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_typicons',
    				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false, // default true, display an "EMPTY" icon?
    					'type' => 'typicons',
    					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'typicons',
    				),
    				'description' => __( 'Select icon from library.', 'plumtree' ),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_entypo',
    				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false, // default true, display an "EMPTY" icon?
    					'type' => 'entypo',
    					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'entypo',
    				),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_linecons',
    				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false, // default true, display an "EMPTY" icon?
    					'type' => 'linecons',
    					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'linecons',
    				),
    				'description' => __( 'Select icon from library.', 'plumtree' ),
    			),
    			array(
    				'type' => 'iconpicker',
    				'heading' => __( 'Icon', 'plumtree' ),
    				'param_name' => 'icon_monosocial',
    				'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
    				'settings' => array(
    					'emptyIcon' => false, // default true, display an "EMPTY" icon?
    					'type' => 'monosocial',
    					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
    				),
    				'dependency' => array(
    					'element' => 'icon_library',
    					'value' => 'monosocial',
    				),
    				'description' => __( 'Select icon from library.', 'plumtree' ),
    			),
    			array(
    				'type' => 'colorpicker',
    				'heading' => __( 'Custom color', 'plumtree' ),
    				'param_name' => 'custom_icon_color',
    				'description' => __( 'Select custom icon color.', 'plumtree' ),
            'dependency' => array(
    					'element' => 'add_icon',
    					'value' => 'yes',
    				),
    			),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Size', 'plumtree' ),
            'param_name' => 'icon_size',
            'value' => array(
              __( 'Small', 'plumtree' ) => 'small',
              __( 'Normal', 'plumtree' ) => 'normal',
              __( 'Large', 'plumtree' ) => 'large',
            ),
            'description' => '',
            'dependency' => array(
              'element' => 'add_icon',
              'value' => 'yes',
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Icon Position', 'plumtree' ),
            'param_name' => 'icon_pos',
            'value' => array(
              __( 'Left', 'plumtree' ) => 'left',
              __( 'Center', 'plumtree' ) => 'center',
              __( 'Right', 'plumtree' ) => 'right',
            ),
            'description' => '',
            'dependency' => array(
              'element' => 'add_icon',
              'value' => 'yes',
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Background shape', 'plumtree' ),
            'param_name' => 'background_icon_style',
            'value' => array(
              __( 'None', 'plumtree' ) => 'none',
              __( 'Circle', 'plumtree' ) => 'rounded',
              __( 'Square', 'plumtree' ) => 'boxed',
              __( 'Rounded', 'plumtree' ) => 'rounded-less',
              __( 'Outline Circle', 'plumtree' ) => 'rounded-outline',
              __( 'Outline Square', 'plumtree' ) => 'boxed-outline',
              __( 'Outline Rounded', 'plumtree' ) => 'rounded-less-outline',
            ),
            'description' => __( 'Select background shape and style for icon.', 'plumtree' ),
            'dependency' => array(
              'element' => 'add_icon',
              'value' => 'yes',
            ),
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __( 'Custom background color for icon', 'plumtree' ),
            'param_name' => 'custom_background_color',
            'description' => '',
            'dependency' => array(
    					'element' => 'add_icon',
    					'value' => 'yes',
    				),
          ),
    			array(
    				'type' => 'textfield',
    				'heading' => esc_html__( 'Extra class name', 'plumtree' ),
    				'param_name' => 'el_class',
    				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'plumtree' ),
    			),
    			array(
    				'type' => 'css_editor',
    				'heading' => esc_html__( 'CSS box', 'plumtree' ),
    				'param_name' => 'css',
    				'group' => esc_html__( 'Design Options', 'plumtree' ),
    			),
      )
   ) );
}

class WPBakeryShortCode_handy_promo_text extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_title'           => 'Promo text title',
			'font_container' 		 => '',
			'google_fonts'       => '',
			'link' 	             => '',
			'text' 		           => 'Promo text content',
      'add_icon'           => 'yes',
			'icon_library' 		   => 'fontawesome',
      'icon_fontawesome'   => 'fa fa-adjust',
      'icon_openiconic'    => '',
      'icon_typicons'      => '',
      'icon_entypo'        => '',
      'icon_linecons'      => '',
      'icon_monosocial'    => '',
      'icon_size'          => 'small',
      'icon_pos'           => 'left',
      'custom_icon_color'  => '',
      'background_icon_style' => 'none',
      'custom_background_color' => '',
			'el_class'    		   => '',
			'css'         		   => '',
		), $atts ) );

    $output = '';
    $icon_class = '';
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'handy-promo-text ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


    /* get custom font styles */
		$font_container_obj = new Vc_Font_Container();
		$google_fonts_obj = new Vc_Google_Fonts();
		$font_container_field_settings = isset( $font_container['settings'], $font_container['settings']['fields'] ) ? $font_container['settings']['fields'] : array();
		$google_fonts_field_settings = isset( $google_fonts['settings'], $google_fonts['settings']['fields'] ) ? $google_fonts['settings']['fields'] : array();
		$font_container_data = $font_container_obj->_vc_font_container_parse_attributes( $font_container_field_settings, $font_container );
		$google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

    $styles = array();
		if ( ! empty( $font_container_data ) && isset( $font_container_data['values'] ) ) {
			foreach ( $font_container_data['values'] as $key => $value ) {
				if ( 'tag' !== $key && strlen( $value ) ) {
					if ( preg_match( '/description/', $key ) ) {
						continue;
					}
					if ( 'font_size' === $key || 'line_height' === $key ) {
						$value = preg_replace( '/\s+/', '', $value );
					}
					if ( 'font_size' === $key ) {
						$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
						// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
						$regexr = preg_match( $pattern, $value, $matches );
						$value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
						$unit = isset( $matches[2] ) ? $matches[2] : 'px';
						$value = $value . $unit;
					}
					if ( strlen( $value ) > 0 ) {
						$styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
					}
				}
			}
		}
		if ( ( ! isset( $atts['use_theme_fonts'] ) || 'yes' !== $atts['use_theme_fonts'] ) && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
			$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
			$styles[] = 'font-family:' . $google_fonts_family[0];
			$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
			$styles[] = 'font-weight:' . $google_fonts_styles[1];
			$styles[] = 'font-style:' . $google_fonts_styles[2];
		}
    $settings = get_option( 'wpb_js_google_fonts_subsets' );
    if ( is_array( $settings ) && ! empty( $settings ) ) {
    	$subsets = '&subset=' . implode( ',', $settings );
    } else {
    	$subsets = '';
    }
    if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
    	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
    }

    /* get chosen icon */
    if ($icon_library!=='fontawesome') {
      vc_icon_element_fonts_enqueue( $icon_library );
    }
    switch ($icon_library) {
      case 'fontawesome':
        $icon_class = $icon_fontawesome;
      break;
      case 'openiconic':
        $icon_class = $icon_openiconic;
      break;
      case 'typicons':
        $icon_class = $icon_typicons;
      break;
      case 'entypo':
        $icon_class = $icon_entypo;
      break;
      case 'linecons':
        $icon_class = $icon_linecons;
      break;
      case 'monosocial':
        $icon_class = $icon_monosocial;
      break;
    }

    $output .= '<div class="' . $css_class . '">';

    if ($add_icon == 'yes') {
      $background_color = $icon_color = '';
      if ($custom_icon_color && $custom_icon_color!='') {
        $icon_color = ' style="color: '.$custom_icon_color.'"';
      }
      if ($custom_background_color && $custom_background_color!='') {
        $background_color = ' style="background-color: '.$custom_background_color.'; border-color: '.$custom_background_color.'"';
      }
      $output .= '<div class="icon-wrapper pos-'.$icon_pos.' icon-size-'.$icon_size.' background-'.$background_icon_style.'"'.$background_color.'>
                    <i class="vc_icon_element-icon '.$icon_class.'"'.$icon_color.'></i>
                  </div>';
    }
    $output .= '<div class="text-wrapper">';
    if ($el_title && $el_title!='') {
      $output .= '<h4 style="'.implode(";", $styles).'">';
      if ( ! empty( $link ) ) {
        $link = vc_build_link( $link );
        $output .= '<a href="' . esc_attr( $link['url'] ) . '"'
          . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
          . ( $link['rel'] ? ' rel="' . esc_attr( $link['rel'] ) . '"' : '' )
          . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
          . '>';
      }
      $output .= $el_title;
      if ( ! empty( $link ) ) {
        $output .= '</a>';
      }
      $output .= '</h4>';
    }
    if ($text && $text!='') {
      $output .= '<p>'.$text.'</p>';
    }
    $output .= '</div>';

    $output .= '</div>';

		return $output;

  }
}

endif;
