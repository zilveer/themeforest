<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function dfd_get_select_options_multi( $what = '') {
	$args = array(
		'type' => 'post',
		'hide_empty' => 0
	);

	$args['taxonomy'] = $what;
	$categories = get_categories( $args);

	$str = array();

	if(!empty($categories) && is_array($categories)) {
		foreach( $categories as $category ) {
			if(is_object($category)) {
				$str[$category->name] = $category->slug;
			}
		}
	}

	return $str;
}
/*
function dfd_custom_taxonomy_item_select($what) {
	$args = array(
		'post_status' => 'publish',
		'post_type' => $what,
		'posts_per_page' => -1,
	);
	$query = new WP_Query($args);
	$items = array();
	if(!empty($query)) {
		foreach($query->posts as $post) {
			if (has_post_thumbnail($post->ID)) {
				$thumb_id = get_post_thumbnail_id($post->ID);
				$img_url = wp_get_attachment_url($thumb_id);
				$img = dfd_aq_resize($img_url, 120, 120, true, true, true);
				if(!$img) {
					$img = $img_url;
				}
			} else {
				$img = get_template_directory_uri() . '/assets/images/no_image_resized_120-120.jpg';
			}
			$items[$post->ID] = $img;
		}
	}

	return $items;
}
*/
if(!function_exists('dfd_vc_columns_to_string')) {
	function dfd_vc_columns_to_string ($str = 1) {
		$arr = array(1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve');

		if( isset($arr[$str]) )	{
			return $arr[$str];
		} else {
			return 'six';
		}
	}
}

function dfd_product_categories_select($backend = false) {
	$args = array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true,
	);
	$categories = get_categories($args);
	$items = array();
	if(!empty($categories)) {
		foreach($categories as $category) {
			$item_meta = array();
			$category_image = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
			$category_image_url = wp_get_attachment_url($category_image);
			if($backend) {
				$category_image_url = dfd_aq_resize($category_image_url, 120, 120, true);
			}
			if(!$category_image_url) {
				$category_image_url = get_stylesheet_directory_uri().'/assets/images/no_image_resized_120-120.jpg';
			}
			$item_meta['name'] = $category->name;
			$item_meta['desc'] = $category->category_description;
			$item_meta['url'] = $category_image_url;
			$item_meta['cat_src'] = get_term_link(intval($category->term_id), 'product_cat');
			if($backend) {
				$items[$category->term_id] = $category_image_url;
			} else {
				$items[$category->term_id] = $item_meta;
			}
		}
	}

	return $items;
}

if(!function_exists('dfd_soc_icons_hover_composer')) {
	function dfd_soc_icons_hover_composer() {
		$composer_styles = array();
		$defauls_styles = dfd_soc_icons_hover_style();
		if(!empty($defauls_styles) && is_array($defauls_styles)) {
			foreach($defauls_styles as $key => $val) {
				$composer_styles[$val] = $key;
			}
		}
		return $composer_styles;
	}
}

if(!function_exists('dfd_build_shortcode_style_param')) {
	function dfd_build_shortcode_style_param($admin_path, $front_path, $simple = true, $tooltips = false) {
		$images_dir = locate_template($admin_path);
				
		$options_array = array();

		if(is_dir($images_dir)) {
			$dir_content = scandir($images_dir);
			if(!empty($dir_content) && is_array($dir_content)) {
				foreach($dir_content as $item) {
					$tooltip_text = '';
					if(substr_count($item, '.png') == 1) {
						$val = substr($item, 0, -4);
						$front_file = locate_template($front_path).$val.'.php';
						if(file_exists($front_file)) {
							if($simple) {
								$options_array[$val] = get_template_directory_uri() . '/' . $admin_path . $item;
							} else {
								if($tooltips && isset($tooltips[$val]))
									$tooltip_text = $tooltips[$val];
								
								if($tooltip_text == '')
									$tooltip_text = $val;
								
								$options_array[$val] = array(
									'tooltip' => $tooltip_text,
									'src' => get_template_directory_uri() . '/' . $admin_path . $item
								);
							}
						}
					}
				}
			}
		}
		
		return $options_array;
	}
}

if(!function_exists('_crum_parse_text_shortcode_params')){
	/**
	 * Parse TEXT params in shortcodes.
	 *
	 * @param $string
	 * @param $tag_class
	 * @param $use_google_fonts
	 * @param $custom_fonts
	 *
	 * @return array
	 */
	function _crum_parse_text_shortcode_params( $string, $tag_class = '', $use_google_fonts = 'no', $custom_fonts = false ) {
		$parsed_param =  array();
		$parsed_array = array(
			'style' => '',
			'tag' => 'div',
			'class' => '',
			'color' => '',
		);
		$param_value  = explode( '|', $string );

		if ( is_array( $param_value ) ) {
			foreach ( $param_value as $single_param ) {
				$single_param                     = explode( ':', $single_param );
				if ( isset($single_param[1]) && $single_param[1] != '' ) {
					$parsed_param[ $single_param[0] ] = $single_param[1];
				} else {
					$parsed_param[ $single_param[0] ] = '';
				}
			}
		}

		if ( ! empty( $parsed_param ) && is_array( $parsed_param ) ) {
			$parsed_array['style'] = 'style="';

			if ( 'yes' === $use_google_fonts && class_exists('Vc_Google_Fonts')) {

				$google_fonts_obj  = new Vc_Google_Fonts();
				$google_fonts_data = strlen( $custom_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( array(), $custom_fonts ) : '';

				$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
				$parsed_array['style'] .= 'font-family:' . $google_fonts_family[0] . '; ';
				$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
				$parsed_array['style'] .= 'font-weight:' . $google_fonts_styles[1] . '; ';
				$parsed_array['style'] .= 'font-style:' . $google_fonts_styles[2] . '; ';

				$settings = get_option( 'wpb_js_google_fonts_subsets' );
				if ( is_array( $settings ) && ! empty( $settings ) ) {
					$subsets = '&subset=' . implode( ',', $settings );
				} else {
					$subsets = '';
				}

				if ( isset( $google_fonts_data['values']['font_family'] ) && function_exists('vc_build_safe_css_class') ) {
					wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
				}
			}

			foreach ( $parsed_param as $key => $value ) {

				if ( strlen( $value ) > 0 ) {
					if ( 'font_style_italic' === $key ) {
						$parsed_array['style'] .= 'font-style:italic; ';
					} elseif ( 'font_style_bold' === $key ) {
						$parsed_array['style'] .= 'font-weight:bold; ';
					} elseif ( 'font_style_underline' === $key ) {
						$parsed_array['style'] .= 'text-decoration:underline; ';
					} elseif ( 'color' === $key ) {
						$parsed_array['style'] .= $key . ': ' . str_replace( '%23', '#', $value ) . '; ';
						$parsed_array['color'] = str_replace( '%23', '#', $value );
					} elseif('tag' === $key){
						$parsed_array['tag'] = $value;
					}else {
						$parsed_array['style'] .= str_replace( '_', '-', $key ) . ': ' . $value . 'px; ';
					}
				}
			}
			$parsed_array['style'] .= '"';
			/*if( 1 === count($parsed_param) && isset($parsed_param['tag'])){
				$parsed_array['style'] = '';
			}*/
			if ( isset($parsed_array['tag']) && ('div' === $parsed_array['tag']) ) {
				$parsed_array['class'] = $tag_class;
			}
		}

		return $parsed_array;
	}
}
if ( ! function_exists( '_crum_vc_delim_settings' ) ) {
	/**
	 * Array with VC_map for delimiters
	 */
	function _crum_vc_delim_settings() {
		return array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Delimiter position:', 'dfd' ),
				'param_name' => 'line_position',
				'value'      => array(
					esc_html__( 'Default', 'dfd' ) => '',
					esc_html__( 'Before Title', 'dfd' ) => 'top',
					esc_html__( 'After Title', 'dfd' ) => 'medium',
					esc_html__( 'After Subtitle', 'dfd' ) => 'bottom',
				),
				'group'            => esc_html__( 'Style', 'dfd' ),
			),
			array(
				'type'             => 'number',
				'heading'          => esc_html__( 'Width', 'dfd' ),
				'param_name'       => 'line_width',
				'min'              => 0,
				'suffix'           => '',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
				'group'            => esc_html__( 'Style', 'dfd' ),
			),
			array(
				'type'             => 'number',
				'heading'          => esc_html__( 'Height', 'dfd' ),
				'param_name'       => 'line_border',
				'min'              => 0,
				'suffix'           => '',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
				'group'            => esc_html__( 'Style', 'dfd' ),
			),

			array(
				'type'             => 'colorpicker',
				'heading'          => esc_html__( 'Color', 'dfd' ),
				'param_name'       => 'line_color',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'            => esc_html__( 'Style', 'dfd' ),
			),
			array(
				'type'             => 'checkbox',
				'heading'          => esc_html__( 'Hide element', 'dfd' ),
				'value'            => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
				'param_name'       => 'line_hide',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'            => esc_html__( 'Style', 'dfd' ),
			),
		);

	}
}
if ( ! function_exists( '_crum_vc_icon_settings' ) ) {
	/**
	 * Array with VC_map for icons / images
	 */
	function _crum_vc_icon_settings() {

		return array(
			array(
				'type'       => 'dropdown',
				'class'      => '',
				'heading'    => esc_html__( 'Icon to display:', 'dfd' ),
				'param_name' => 'icon_type',
				'value'      => array(
					esc_html__( 'Font Icon Manager', 'dfd' ) => 'selector',
					esc_html__( 'Custom Image Icon', 'dfd' ) => 'custom',
				),
				'group'      => esc_html__( 'Icon', 'dfd' ),
			),
			array(
				'type'             => 'number',
				'heading'          => esc_html__( 'Opacity', 'dfd' ) .' (0-100) %',
				'param_name'       => 'opacity',
				'min'              => '0',
				'max'              => '100',
				'value'            => '100',
				'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
				'group'            => esc_html__( 'Icon', 'dfd' ),
			),
			array(
				'type'       => 'number',
				'heading'    => esc_html__( 'Size of Icon', 'dfd' ),
				'param_name' => 'icon_size',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
				'min'        => 12,
				'group'      => esc_html__( 'Icon', 'dfd' ),
			),
			array(
				'type'       => 'colorpicker',
				'class'      => 'crum_vc',
				'heading'    => esc_html__( 'Color', 'dfd' ),
				'param_name' => 'icon_color',
				'group'      => esc_html__( 'Icon', 'dfd' ),
				'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
			),
			array(
				'type'       => 'icon_manager',
				'class'      => '',
				'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
				'param_name' => 'icon',
				'value'      => '',
				'group'      => esc_html__( 'Icon', 'dfd' ),
				'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
			),
			array(
				'type'        => 'attach_image',
				'class'       => '',
				'heading'     => esc_html__( 'Upload Image:', 'dfd' ),
				'param_name'  => 'icon_image_id',
				'admin_label' => true,
				'value'       => '',
				'group'       => esc_html__( 'Icon', 'dfd' ),
				'description' => esc_html__( 'Upload the custom image icon.', 'dfd' ),
				'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
			),

		);

	}
}

if ( ! function_exists( 'crumina_icon_render' ) ) {
	/**
	 * Icon generator for Frontend
	 */
	function crumina_icon_render( $atts = array() ) {

		$icon_type = $icon = $icon_image_id = $icon_size = $icon_color = $icon_hover = $opacity = '';

		$output = $icon_style = $img_style = '';

		$defaults = array(
			'icon_type'     => 'icon',
			'icon'    => '',
			'icon_image_id' => '',
			'icon_size'     => '',
			'icon_color'    => '',
			'icon_hover'    => '',
			'opacity'  => '',
		);

		extract( shortcode_atts( $defaults, $atts ) );

		if ( ! empty( $opacity ) ) {
			if ( intval($opacity) >= 100 ) {
				$opacity = 1;
			} elseif ( intval($opacity) > 0 ) {
				$opacity = '0.' . intval($opacity);
			} elseif ( intval($opacity) < 0 ) {
				$opacity = 0;
			}
		}

		if ( 'custom' === $icon_type ) {

			$image_url = wp_get_attachment_image_src( $icon_image_id, 'full' );

			if (! empty( $icon_size )){
				$image_src = dfd_aq_resize( $image_url[0], $icon_size * 2, $icon_size * 2, true, true, true );
				if(!$image_src) $image_src = $image_url[0];
			} else {
				$image_src = $image_url[0];
			}


			if ( ! empty( $icon_size ) || ! empty( $opacity ) ) {

				$img_style .= 'style="';

				if ( isset( $icon_size ) && ! empty( $icon_size ) ) {
					$img_style .= 'width:' . $icon_size . 'px; ';
				}

				if ( ! empty( $opacity ) ) {
					$img_style .= 'opacity:' . $opacity.';';
				}

				$img_style .= '"';

			}

			$output .= '<img src="' . esc_url($image_src) . '" alt="" ' . esc_attr($img_style) . '/>';

		} else {
			if ( !empty( $icon_size ) || ! empty( $icon_color ) || ! empty( $opacity ) ) {
				$icon_style .= 'style="';

				if ( ! empty( $icon_size ) ) {
					$icon_style .= 'font-size:' . $icon_size . 'px; ';
				}

				if ( ! empty( $icon_color ) ) {
					$icon_style .= 'color:' . $icon_color.'; ';
				}

				if ( ! empty( $opacity ) ) {
					$icon_style .= 'opacity:' . $opacity.';';
				}

				$icon_style .= '"';
			}

			if ($icon_hover) {
				$icon_hover = 'data-hover="'.$icon_hover.'"';
			}

			$output .= '<i class="featured-icon ' . $icon . '" ' . $icon_style . ' ' . $icon_hover . '></i>';
		}

		return $output;
	}
}

if(!function_exists('crum_get_shortcode_atts')){
	/**
	 * Parse child shortcodes params with attributes.
	 *
	 * @param $content
	 *
	 * @return array
	 */
	function crum_get_shortcode_atts($content){

		preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
		$shortcode_args = array();

		$i = 0;

		if(isset($matches[3]) && is_array($matches[3])){
			foreach ($matches[3] as $single_shortcode_atts){
				$temp = explode('" ',trim($single_shortcode_atts));
				foreach($temp as $pair){
					$temp_1 = explode('="',$pair);
					$shortcode_args[$i][$temp_1[0]] = $temp_1[1];
				}
				$i++;
			}
		}
		return $shortcode_args;
	}
}

if ( function_exists( 'vc_set_template_dir' ) ) {
	$templates_path = get_template_directory() . '/inc/vc_custom/vc_templates/';
	vc_set_shortcodes_templates_dir( $templates_path );
}

if(function_exists('vc_remove_param')) {
	//vc_remove_param('vc_row','bg_image');
	//vc_remove_param('vc_row','bg_image');
	//vc_remove_param('vc_row','el_class');
	vc_remove_param('vc_row','el_class');
	vc_remove_param('vc_row','bg_image_repeat');
	vc_remove_param('vc_row','font_color');
	vc_remove_param('vc_row','full_width');
	vc_remove_param('vc_row','el_id');
	vc_remove_param('vc_row','parallax');
	vc_remove_param('vc_row','parallax_image');
	vc_remove_param('vc_row','parallax_speed_video');
	vc_remove_param('vc_row','parallax_speed_bg');
	//vc_remove_param('vc_row','full_height');
	vc_remove_param('vc_row','content_placement');
	vc_remove_param('vc_row','video_bg');
	vc_remove_param('vc_row','video_bg_url');
	vc_remove_param('vc_row','video_bg_parallax');
	vc_remove_param('vc_row','gap');
	vc_remove_param('vc_row','equal_height');
	//vc_remove_param('vc_row','columns_placement');
	vc_remove_param('vc_row_inner','el_id');
	vc_remove_param('vc_row_inner','equal_height');
	vc_remove_param('vc_row_inner','content_placement');
	vc_remove_param('vc_row_inner','gap');
	vc_remove_param('vc_video','title');
	vc_remove_param('vc_video','link');
	vc_remove_param('vc_tour','title');
	vc_remove_param('vc_single_image','onclick');
}

if(function_exists('vc_map')){
	class WPBakeryShortCode_Dfd_Side_By_Side_Slider  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Side by Side slider', 'dfd' ),
		'base' => 'dfd_side_by_side_slider',
		'as_parent' => array('only' => 'dfd_side_by_side_left,dfd_side_by_side_right'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => false,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));
	
	class WPBakeryShortCode_Dfd_Side_By_Side_Left  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Side by Side Left Container', 'dfd' ),
		'base' => 'dfd_side_by_side_left',
		'as_parent' => array('only' => 'dfd_side_by_side_slide'),
		'as_child' => array('only' => 'dfd_side_by_side_slider'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => false,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));

	class WPBakeryShortCode_Dfd_Side_By_Side_Right  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Side by Side Right Container', 'dfd' ),
		'base' => 'dfd_side_by_side_right',
		'as_parent' => array('only' => 'dfd_side_by_side_slide'),
		'as_child' => array('only' => 'dfd_side_by_side_slider'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => false,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));

	class WPBakeryShortCode_Dfd_Side_By_Side_Slide  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Side by Side Slider Item', 'dfd' ),
		'base' => 'dfd_side_by_side_slide',
		'admin_enqueue_css' => get_template_directory_uri() .'/inc/vc_custom/Ultimate_VC_Addons/admin/css/no-margin-css.css',
		'as_parent' => array('except' => 'dfd_side_by_side_slider, dfd_side_by_side_left, dfd_side_by_side_right, dfd_side_by_side_slide, vc_accordion, vc_tabs, vc_tour, dfd_scrolling_content, dfd_scrolling_content2 , dfd_equal_height_content, dfd_scrolling_effect'),
		'as_child' => array('only' => 'dfd_side_by_side_left, dfd_side_by_side_right'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => true,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'css_editor',
				'edit_field_class' => 'vc_col-xs-12 vc_column dfd_side_by_side_item_custom_class',
				'heading' => __( 'CSS box', 'js_composer' ),
				'param_name' => 'css',
				// 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
				'group' => __( 'Design Options', 'js_composer' )
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __('Select Slide Background Style', 'dfd'),
				'param_name' => 'slide_bg_check',
				'value' => array(
					__('Light background', 'dfd') => '',
					__('Dark background', 'dfd') => 'column-background-dark'
				),
			),
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));
	class WPBakeryShortCode_Dfd_Masonry_Container  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Masonry/Grid container', 'dfd' ),
		'base' => 'dfd_masonry_container',
		'as_parent' => array('only' => 'dfd_masonry_item'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => true,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __('Select Layout mode', 'dfd'),
				'param_name' => 'layout_style',
				'value' => array(
					__('Masonry', 'dfd') => 'masonry',
					__('Grid', 'dfd') => 'fitRows'
				),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __('Enable sort panel', 'dfd'),
				'param_name' => 'enable_sort_panel',
				'value' => array(
					__('No', 'dfd') => 'disabled',
					__('Yes', 'dfd') => 'enabled',
				),
			),
			array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => __('Sort panel alignment ', 'dfd'),
				'param_name' => 'sort_panel_alignment',
				'value' => array(
					__('Left', 'dfd') => 'text-left',
					__('Right', 'dfd') => 'text-right',
					__('Center', 'dfd') => 'text-center'
				),
				'dependency' => Array('element' => 'enable_sort_panel','value' => array('enabled')),
			),
			array(
				'type' => 'textarea',
				'heading' => __( 'Categories list', 'ultimate_vc' ),
				'param_name' => 'categories_strings',
				'description' => __('Enter each string on a new line','dfd'),
				'dependency' => Array('element' => 'enable_sort_panel','value' => array('enabled')),
				'admin_label' => true
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => __('Number of columns for wide container', 'dfd'),
				'param_name' => 'columns_number_wide',
				'value' =>'5',
				'min'=>'1',
				'max'=>'8',
				'description' => __("Number of columns if container width more then 1280. Enter value between 1 to 8", 'dfd'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => __('Number of columns for normal container', 'dfd'),
				'param_name' => 'columns_number_normal',
				'value' =>'4',
				'min'=>'1',
				'max'=>'8',
				'description' => __("Number of columns if container width more then 1024 and less then 1280. Enter value between 1 to 8", 'dfd'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => __('Number of columns for medium container', 'dfd'),
				'param_name' => 'columns_number_medium',
				'value' =>'3',
				'min'=>'1',
				'max'=>'8',
				'description' => __("Number of columns if container width more then 800 and less then 1024. Enter value between 1 to 8", 'dfd'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => __('Number of columns for small container', 'dfd'),
				'param_name' => 'columns_number_small',
				'value' =>'2',
				'min'=>'1',
				'max'=>'8',
				'description' => __("Number of columns if container width more then 460 and less then 800. Enter value between 1 to 8", 'dfd'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => __('Number of columns for smartphones', 'dfd'),
				'param_name' => 'columns_number_mobile',
				'value' =>'1',
				'min'=>'1',
				'max'=>'8',
				'description' => __("Number of columns if container width less then 460. Enter value between 1 to 8", 'dfd'),
			),
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));
	
	class WPBakeryShortCode_Dfd_Masonry_Item  extends WPBakeryShortCodesContainer {}
	vc_map(array(
		'name' =>  __( 'Masonry/Grid item', 'dfd' ),
		'base' => 'dfd_masonry_item',
		'as_parent' => array('except' => 'dfd_masonry_container, dfd_masonry_item, dfd_side_by_side_slider, dfd_side_by_side_left, dfd_side_by_side_right, dfd_side_by_side_slide, vc_accordion, vc_tabs, vc_tour, dfd_scrolling_content, dfd_scrolling_content2 , dfd_equal_height_content, dfd_scrolling_effect'),
		'as_child' => array('only' => 'dfd_masonry_container'),
		'content_element' => true,
		'category' => esc_attr__('Ronneby 2.0','dfd'),
		'icon' => 'ultimate_carousel',
		'show_settings_on_create' => true,
		'js_view' => 'VcColumnView',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Category title', 'dfd'),
				'param_name' => 'data_category',
				'description' => __('Please enter the title of the category in sort panel for this item', 'dfd')
			),
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'js_composer'),
				'param_name' => 'el_class',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
			),
		)
	));
    
}

/* VC settings */
if(function_exists('vc_add_param')){
	vc_add_param('vc_row', array(
			'type' => 'ult_param_heading',
			'text' => __('Row sizing options', 'dfd'),
			'param_name' => 'sizing',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_switch',
			'class' => '',
			'heading' => __('Force equal height columns', 'dfd'),
			'param_name' => 'force_equal_height_columns',
			'value' => '',
			'options' => array(
				'main_row' => array(
						'label' => esc_html__('Yes, please','dfd'),
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			/*'value' => array(
				//__('No', 'dfd') => 'no',
				__('Yes', 'dfd') => 'main_row',
				//__('Yes, for child row', 'dfd') => 'child_row',
			),*/
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_switch',
			'class' => '',
			'heading' => __('Align content vertically', 'dfd'),
			'param_name' => 'align_content_vertically',
			//'value' => array(__('Yes, please', 'dfd') => 'yes'),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'value' => 'yes',
			'options' => array(
				'yes' => array(
						'label' => esc_html__('Yes, please','dfd'),
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'dependency' => array('element' => 'force_equal_height_columns','value' => array('main_row', 'child_row')),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_switch',
			'class' => '',
			'heading' => __('Destroy equal heights on mobiles', 'dfd'),
			'param_name' => 'mobile_destroy_equal_heights',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			//'value' => array(__('Yes, please', 'dfd') => 'yes'),
			'value' => 'yes',
			'options' => array(
				'yes' => array(
						'label' => esc_html__('Yes, please','dfd'),
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			'dependency' => array('element' => 'force_equal_height_columns','value' => array('main_row', 'child_row')),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Select Content Width', 'dfd'),
			'param_name' => 'dfd_row_config',
			'value' => array(
				__('Default', 'dfd') => '',
				__('3px column paddings grid', 'dfd') => 'default_row_small_paddings',
				__('No paddings grid', 'dfd') => 'default_row_no_paddings',
				__('Full Width Content', 'dfd') => 'full_width_content',
				__('Full Width Content With 3px Column Paddings', 'dfd') => 'full_width_small_paddings',
				__('Full Width Content With paddings', 'dfd') => 'full_width_content_paddings',
			),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_param_heading',
			'text' => __('Row heading options', 'dfd'),
			'param_name' => 'heading',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => __('Title for one page scroll layout navigation', 'dfd'),
			'param_name' => 'one_page_title',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => __('Anchor', 'dfd'),
			'param_name' => 'anchor',
			'value' => '',
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_param_heading',
			'text' => __('Row effects options', 'dfd'),
			'param_name' => 'effects',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Row effect', 'dfd'),
			'param_name' => 'row_effect',
			'value' => array(
				__('None', 'dfd') => '',
				__('Fade on scroll', 'dfd') => 'dfd-fade-on-scroll'
			),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_switch',
			'class' => '',
			'heading' => __('Row content parallax effect', 'dfd'),
			'param_name' => 'dfd_row_parallax',
			'value' => '',
			'options' => array(
				'dfd-row-parallax' => array(
						'label' => esc_html__('Yes, please','dfd'),
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			/*'value' => array(
				__('Enable', 'dfd') => 'dfd-row-parallax',
			),*/
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Parallax Speed', 'dfd'),
			'param_name' => 'row_parallax_sense',
			'value' =>'30',
			'min'=>'1',
			'max'=>'100',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'description' => __('Control speed of parallax. Enter value between 1 to 100', 'dfd'),
			'dependency' => Array('element' => 'dfd_row_parallax','value' => array('dfd-row-parallax')),
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Parallax limit', 'dfd'),
			'param_name' => 'row_parallax_limit',
			'value' =>'',
			'min'=>'50',
			'max'=>'400',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'description' => __('Module shift limit. Enter value between 50 to 400. Units - px.', 'dfd'),
			'dependency' => Array('element' => 'dfd_row_parallax','value' => array('dfd-row-parallax')),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_switch',
			'class' => '',
			'heading' => __('Enable responsive options', 'dfd'),
			'param_name' => 'dfd_row_responsive_enable',
			'value' => '',
			'options' => array(
				'dfd-row-responsive-enable' => array(
						'label' => esc_html__('Yes, please','dfd'),
						'on' => 'Yes',
						'off' => 'No',
					),
				),
			/*'value' => array(
				__('Enable', 'dfd') => 'dfd-row-responsive-enable',
			),*/
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Pre-built responsive settings', 'dfd'),
			'param_name' => 'row_prebuilt_classes',
			'value' => array(
					__('None', 'dfd') => '',
					__('Remove left border on mobiles', 'dfd') => 'dfd-mobile-remove-left-border',
					__('Remove right border on mobiles', 'dfd') => 'dfd-mobile-remove-right-border',
					__('Remove top border on mobiles', 'dfd') => 'dfd-mobile-remove-top-border',
					__('Remove bottom border on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-border',
					__('Remove all borders on mobiles', 'dfd') => 'dfd-mobile-remove-all-borders',
					__('Remove left padding on mobiles', 'dfd') => 'dfd-mobile-remove-left-padding',
					__('Remove right padding on mobiles', 'dfd') => 'dfd-mobile-remove-right-padding',
					__('Remove top padding on mobiles', 'dfd') => 'dfd-mobile-remove-top-padding',
					__('Remove bottom padding on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-padding',
					__('Remove all paddings on mobiles', 'dfd') => 'dfd-mobile-remove-all-paddings',
					__('Remove left margin on mobiles', 'dfd') => 'dfd-mobile-remove-left-margin',
					__('Remove right margin on mobiles', 'dfd') => 'dfd-mobile-remove-right-margin',
					__('Remove top margin on mobiles', 'dfd') => 'dfd-mobile-remove-top-margin',
					__('Remove bottom margin on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-margin',
					__('Remove all margins on mobiles', 'dfd') => 'dfd-mobile-remove-all-margins',
				),
			'dependency' => Array('element' => 'dfd_row_responsive_enable','value' => array('dfd-row-responsive-enable')),
			'edit_field_class' => 'dfd_vc_hide vc_col-xs-12 vc_column',
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'checkbox',
			'class' => '',
			'heading' => __('Remove css rule on responsive', 'dfd'),
			'param_name' => 'row_responsive_mobile_classes',
			'value' => array(
					__('Left padding', 'dfd') => 'dfd-remove-left-padding',
					__('Right padding', 'dfd') => 'dfd-remove-right-padding',
					__('Top padding', 'dfd') => 'dfd-remove-top-padding',
					__('Bottom padding', 'dfd') => 'dfd-remove-bottom-padding',
					__('Left margin', 'dfd') => 'dfd-remove-left-margin',
					__('Right margin', 'dfd') => 'dfd-remove-right-margin',
					__('Top margin', 'dfd') => 'dfd-remove-top-margin',
					__('Bottom margin', 'dfd') => 'dfd-remove-bottom-margin',
					__('Left border', 'dfd') => 'dfd-remove-left-border',
					__('Right border', 'dfd') => 'dfd-remove-right-border',
					__('Top border', 'dfd') => 'dfd-remove-top-border',
					__('Bottom border', 'dfd') => 'dfd-remove-bottom-border',
				),
			'dependency' => Array('element' => 'dfd_row_responsive_enable','value' => array('dfd-row-responsive-enable')),
			'edit_field_class' => 'dfd_vc_responsive vc_col-xs-12 vc_column',
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'checkbox',
			'class' => '',
			'heading' => __('Apply those rules for devices', 'dfd'),
			'param_name' => 'row_responsive_mobile_resolutions',
			'value' => array(
					__('Semi-wide', 'dfd') => 'dfd-apply-desktop',
					__('Laptops', 'dfd') => 'dfd-apply-laptop',
					__('Tablets', 'dfd') => 'dfd-apply-tablet',
					__('Mobiles', 'dfd') => 'dfd-apply-mobile',
				),
			'dependency' => Array('element' => 'dfd_row_responsive_enable','value' => array('dfd-row-responsive-enable')),
			'edit_field_class' => 'dfd_vc_responsive vc_col-xs-12 vc_column',
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Select Row Delimiter Style','dfd'),
			'param_name' => 'row_delimiter',
			'value' => dfd_vc_delimiter_styles(),
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => __('Delimiter Background Color', 'dfd'),						
			'param_name' => 'delimiter_bg_color_value',
			//"description" => __('At least two color points should be selected. <a href="https://www.youtube.com/watch?v=yE1M4AKwS44" target="_blank">Video Tutorial</a>', 'dfd'),
			'dependency' => array('element' => 'row_delimiter','value' => array('12')),
		)
	);
	vc_add_param('vc_row',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Delimiter height', 'dfd'),
			'param_name' => 'delimiter_height',
			'value' =>'150',
			'min'=>'1',
			'max'=>'500',
			'description' => __('Control speed of parallax. Enter value between 1 to 500', 'dfd'),
			'dependency' => array('element' => 'row_delimiter','value' => array('12')),
		)
	);
	vc_add_param('vc_row', array(
			'type' => 'ult_param_heading',
			'text' => __('Extra features', 'dfd'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => __('Extra CSS Classes', 'dfd'),
			'param_name' => 'el_class',
			'value' => '',
		)
	);
	vc_add_param(
		'vc_row', array(
			'type' => 'textfield',
			'class' => '',
			'heading' => __('Extra CSS Styles', 'dfd'),
			'param_name' => 'extra_css_styles',
			'value' => '',
		)
	);
	vc_add_param('vc_row_inner', array(
			'type' => 'ult_param_heading',
			'text' => __('Extra features', 'dfd'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param('vc_column', array(
			'type' => 'ult_param_heading',
			'text' => __('Main column settings', 'dfd'),
			'param_name' => 'main',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
			'weight' => 6
		)
	);
	vc_add_param("vc_column", array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Select Column Background Style', 'dfd'),
			'param_name' => 'column_bg_check',
			'value' => array(
				__('Light background', 'dfd') => '',
				__('Dark background', 'dfd') => 'column-background-dark'
			),
			'weight' => 5
		));
	vc_add_param('vc_column', array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Column content parallax effect', 'dfd'),
			'param_name' => 'column_parallax',
			'value' => array(
				__('Disable', 'dfd') => '',
				__('Enable', 'dfd') => 'dfd-column-parallax',
			),
			'weight' => 4
		));
	vc_add_param('vc_column',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Parallax Speed', 'dfd'),
			'param_name' => 'column_parallax_sense',
			'value' =>'30',
			'min'=>'-200',
			'max'=>'200',
			'description' => __("Control speed of parallax. Enter value between -200 to 200", 'dfd'),
			'dependency' => Array("element" => "column_parallax","value" => array('dfd-column-parallax')),
			'weight' => 4
		)
	);
	vc_add_param('vc_column',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Parallax limit', 'dfd'),
			'param_name' => 'column_parallax_limit',
			'value' =>'',
			'min'=>'50',
			'max'=>'400',
			'description' => __("Module shift limit. Enter value between 50 to 400. Units - px.", 'dfd'),
			'dependency' => Array("element" => "column_parallax","value" => array('dfd-column-parallax')),
			'weight' => 4
		)
	);
	vc_add_param('vc_column', array(
			'type' => 'ult_param_heading',
			'text' => __('Extra features', 'dfd'),
			'param_name' => 'extra_features',
			'class' => '',
			'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
			'weight' => 1
		)
	);
	vc_add_param('vc_column',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Pre-built responsive settings', 'dfd'),
			'param_name' => 'column_prebuilt_classes',
			'edit_field_class' => 'dfd_vc_hide',
			'value' => array(
					__('None', 'dfd') => '',
					__('Remove left border on mobiles', 'dfd') => 'dfd-mobile-remove-left-border',
					__('Remove right border on mobiles', 'dfd') => 'dfd-mobile-remove-right-border',
					__('Remove top border on mobiles', 'dfd') => 'dfd-mobile-remove-top-border',
					__('Remove bottom border on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-border',
					__('Remove all borders on mobiles', 'dfd') => 'dfd-mobile-remove-all-borders',
					__('Remove left padding on mobiles', 'dfd') => 'dfd-mobile-remove-left-padding',
					__('Remove right padding on mobiles', 'dfd') => 'dfd-mobile-remove-right-padding',
					__('Remove top padding on mobiles', 'dfd') => 'dfd-mobile-remove-top-padding',
					__('Remove bottom padding on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-padding',
					__('Remove all paddings on mobiles', 'dfd') => 'dfd-mobile-remove-all-paddings',
					__('Remove left margin on mobiles', 'dfd') => 'dfd-mobile-remove-left-margin',
					__('Remove right margin on mobiles', 'dfd') => 'dfd-mobile-remove-right-margin',
					__('Remove top margin on mobiles', 'dfd') => 'dfd-mobile-remove-top-margin',
					__('Remove bottom margin on mobiles', 'dfd') => 'dfd-mobile-remove-bottom-margin',
					__('Remove all margins on mobiles', 'dfd') => 'dfd-mobile-remove-all-margins',
				),
			//'description' => __('Upload or select video thumbnail image from media gallery.', 'dfd'),
			'group' => __( 'Responsive Options', 'js_composer' ),
		)
	);
	vc_add_param('vc_column',array(
			'type' => 'checkbox',
			'class' => '',
			'heading' => __('Remove css rule on mobiles', 'dfd'),
			'param_name' => 'column_responsive_mobile_classes',
			'edit_field_class' => 'dfd_vc_responsive',
			'value' => array(
					__('Left border', 'dfd') => 'dfd-remove-left-border',
					__('Right border', 'dfd') => 'dfd-remove-right-border',
					__('Top border', 'dfd') => 'dfd-remove-top-border',
					__('Bottom border', 'dfd') => 'dfd-remove-bottom-border',
					//__('Remove all borders on mobiles', 'dfd') => 'dfd-remove-all-borders',
					__('Left padding', 'dfd') => 'dfd-remove-left-padding',
					__('Right padding', 'dfd') => 'dfd-remove-right-padding',
					__('Top padding', 'dfd') => 'dfd-remove-top-padding',
					__('Bottom padding', 'dfd') => 'dfd-remove-bottom-padding',
					//__('Remove all paddings on mobiles', 'dfd') => 'dfd-remove-all-paddings',
					__('Left margin', 'dfd') => 'dfd-remove-left-margin',
					__('Right margin', 'dfd') => 'dfd-remove-right-margin',
					__('Top margin', 'dfd') => 'dfd-remove-top-margin',
					__('Bottom margin', 'dfd') => 'dfd-remove-bottom-margin',
					//__('Remove all margins on mobiles', 'dfd') => 'dfd-remove-all-margins',
				),
			//'description' => __('Upload or select video thumbnail image from media gallery.', 'dfd'),
			'group' => __( 'Responsive Options', 'js_composer' ),
		)
	);
	vc_add_param('vc_column',array(
			'type' => 'checkbox',
			'class' => '',
			'heading' => __('Apply those rules for devices', 'dfd'),
			'param_name' => 'column_responsive_mobile_resolutions',
			'edit_field_class' => 'dfd_vc_responsive',
			'value' => array(
					__('Laptops', 'dfd') => 'dfd-apply-laptop',
					__('Tablets', 'dfd') => 'dfd-apply-tablet',
					__('Mobiles', 'dfd') => 'dfd-apply-mobile',
				),
			//'description' => __('Upload or select video thumbnail image from media gallery.', 'dfd'),
			'group' => __( 'Responsive Options', 'js_composer' ),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Video mode', 'dfd'),
			'param_name' => 'video_module_mode',
			'value' => array(
					__('Simple video', 'dfd') => 'simple',
					__('Full screen video', 'dfd') => 'full_screen'
				),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'textfield',
			'heading' => __( 'Video link', 'js_composer' ),
			'param_name' => 'link',
			'admin_label' => true,
			'description' => sprintf( __( 'Link to the video. More about supported formats at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' ),
			'dependency' => array('element' => 'video_module_mode','value' => array('simple')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'attach_image',
			'class' => '',
			'heading' => __('Thumbnail Image', 'dfd'),
			'param_name' => 'video_thumb_image',
			'value' => '',
			'description' => __('Upload or select video thumbnail image from media gallery.', 'dfd'),
			'dependency' => array('element' => 'video_module_mode','value' => array('simple')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Video source', 'dfd'),
			'param_name' => 'video_source',
			'value' => array(
					__('Youtube', 'dfd') => 'youtube',
					__('Vimeo', 'dfd') => 'vimeo'
				),
			//'description' => __('Upload or select video thumbnail image from media gallery.', 'dfd'),
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'textfield',
			'heading' => __( 'Video ID', 'dfd' ),
			'param_name' => 'video_id',
			'admin_label' => true,
			//'description' => __( '', 'dfd' ),
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Label Alignment','dfd'),
			'param_name' => 'module_alignment',
			"value" => array(
				__('Left','dfd') => "text-left",
				__('Center','dfd') => "text-center",
				__('Right','dfd') => "text-right"
			),
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => __('Icon color', 'dfd'),
			'param_name' => 'icon_color',
			'value' => '#ffffff',
			'description' => __('', 'dfd'),	
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'colorpicker',
			'class' => '',
			'heading' => __('Label background', 'dfd'),
			'param_name' => 'label_background',
			'value' => '#323232',
			'description' => __('', 'dfd'),	
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'dfd' ),
			'param_name' => 'video_title',
			'admin_label' => true,
			'description' => __( 'Short description', 'dfd' ),
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_video',array(
			'type' => 'textfield',
			'heading' => __( 'Description', 'dfd' ),
			'param_name' => 'description',
			'admin_label' => true,
			'description' => __( 'Short description', 'dfd' ),
			'dependency' => array('element' => 'video_module_mode','value' => array('full_screen')),
		)
	);
	vc_add_param('vc_tour',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Tabs alignment','dfd'),
			'param_name' => 'tabs_alignment',
			"value" => array(
				__('Left','dfd') => 'dfd-left-tabs',
				__('Right','dfd') => 'dfd-right-tabs'
			),
		)
	);
	vc_add_param('vc_accordion',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Alignment','dfd'),
			'param_name' => 'titles_alignment',
			"value" => array(
				__('Left','dfd') => "text-left",
				__('Center','dfd') => "text-center",
				__('Right','dfd') => "text-right"
			),
		)
	);
	vc_add_param('vc_accordion',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Item Animation','dfd'),
			'param_name' => 'item_animation',
			'value'       => dfd_module_animation_styles(),
			'description' => __('', 'dfd'),
			'group'=> 'Animation',
		)
	);
	vc_add_param('vc_column_text',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Item Animation','dfd'),
			'param_name' => 'item_animation',
			'value'       => dfd_module_animation_styles(),
			'description' => __('', 'dfd'),
			'group'=> 'Animation',
		)
	);
	vc_add_param('vc_single_image',array(
			'type' => 'number',
			'class' => '',
			'heading' => __('Image opacity', 'dfd'),
			'param_name' => 'image_opacity',
			'value' =>'',
			'min'=>'0',
			'max'=>'100',
			'description' => __('Image opacity. Units - %.', 'dfd'),
		)
	);
	vc_add_param('vc_single_image',array(
			'type' => 'dropdown',
			'heading' => __( 'On click action', 'js_composer' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( 'Use as navigation for One Page Scroll Page template', 'js_composer' ) => 'link_one_page',
				__( 'Link to large image', 'js_composer' ) => 'img_link_large',
				__( 'Open prettyPhoto', 'js_composer' ) => 'link_image',
				__( 'Open custom link', 'js_composer' ) => 'custom_link',
				__( 'Zoom', 'js_composer' ) => 'zoom',
			),
			'description' => __( 'Select action for click action.', 'js_composer' ),
			'std' => '',
		)
	);
	vc_add_param('vc_single_image',array(
		'type' => 'dropdown',
		'heading' => __( 'Go to:', 'dfd' ),
		'param_name' => 'link_one_page_value',
		'description' => __( 'Specifies the direction of one-page template on click', 'dfd' ),
		'value' => array(
			__( 'None', 'dfd' ) => '',
			__( 'Previous page', 'dfd' ) => 'slickPrev',
			__( 'Next page', 'dfd' ) => 'slickNext'
		),
		'dependency' => Array('element' => 'onclick','value' => array('link_one_page')),
	));
	vc_add_param('vc_single_image',array(
			'type' => 'dropdown',
			'class' => '',
			'heading' => __('Item Animation','dfd'),
			'param_name' => 'item_animation',
			'value'       => dfd_module_animation_styles(),
			'description' => __('', 'dfd'),
			'group'=> 'Animation',
		)
	);
	
	/* Row Background options */
	require_once(locate_template('/inc/vc_custom/dfd_vc_background/dfd_vc_bg.php'));
	
	$Dfd_VC_Row_Background->build_backend_options();
}
