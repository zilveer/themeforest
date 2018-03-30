<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
@Module: Category Grid Layout
@Since: 1.0
@Package: WooComposer
*/
if(!class_exists('Dfd_Woo_Sinle_Cat')){
	class Dfd_Woo_Sinle_Cat
	{
		function __construct(){
			add_action('init',array($this,'woocomposer_init_single_cat'));
			add_shortcode('woocomposer_single_cat',array($this,'woocomposer_single_cat_shortcode'));
		} /* end constructor */
		function woocomposer_init_single_cat(){
			if(function_exists('vc_map')){
				$orderby_arr = array(
					esc_attr__('Date','dfd') => 'date',
					esc_attr__('Title','dfd') => 'title',
					esc_attr__('Product ID','dfd') => 'ID',
					esc_attr__('Name','dfd') => 'name',
					esc_attr__('Price','dfd') => 'price',
					esc_attr__('Sales','dfd') => 'sales',
					esc_attr__('Random','dfd') => 'rand',
				);
				vc_map(
					array(
						'name'		=> esc_attr__('Single Product Category', 'dfd'),
						'base'		=> 'woocomposer_single_cat',
						'icon'		=> 'woo_grid',
						'class'	   => 'woo_grid',
						'category'  => esc_html__('WooComposer', 'dfd'),
						'description' => 'Display categories in grid view',
						'controls' => 'full',
						'wrapper_class' => 'clearfix',
						'show_settings_on_create' => true,
						'params' => array(
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'General settings', 'dfd' ),
								'param_name'       => 'main_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group' => esc_attr__('General', 'dfd'),
							),
							array(
								'type' => 'radio_image_select',
								'heading' => esc_html__('Style','dfd'),
								'param_name' => 'single_category_style',
								'simple_mode' => false,
								'options'     => array(
									'style-1' => array(
										'tooltip' => esc_attr__('Standard','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_cat/style-1.png'
									),
									'style-2' => array(
										'tooltip' => esc_attr__('Fade in','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_cat/style-2.png'
									),
									'style-3' => array(
										'tooltip' => esc_attr__('Fade out','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/woo_cat/style-3.png'
									),
								),
								'group' => esc_attr__('General', 'dfd'),
							),
							array(
								'type' => 'radio_image_box',
								'heading' => esc_html__('Select products category to display','dfd'),
								'param_name' => 'single_category_item',
								'value' => '',
								'options' => dfd_product_categories_select(true),
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'group' => esc_attr__('General', 'dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'group' => esc_attr__('General', 'dfd'),
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'group' => esc_attr__('General', 'dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Category title settings', 'dfd' ),
								'param_name'       => 'title_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										'line_height',
										'color',
										'font_style'
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'title_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'title_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Category description settings', 'dfd' ),
								'param_name'       => 'subtitle_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'subtitle_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'div',
										'letter_spacing',
										'font_size',
										//'line_height',
										'color',
										'font_style'
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'subtitle_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'            => esc_attr__( 'Style', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'subtitle_custom_fonts',
								'value'      => '',
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'dependency' => array(
									'element' => 'subtitle_google_fonts',
									'value'   => 'yes',
								),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Heading background', 'dfd' ),
								'param_name'       => 'bg_heading',
								'group'            => esc_attr__( 'Style', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Heading background', 'dfd'),
								'param_name' => 'background',
								'value' => '',
								'group' => esc_attr__('Style', 'dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Image resolutions', 'dfd' ),
								'param_name'       => 'img_heading',
								'group'            => esc_attr__( 'Image', 'dfd' ),
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 500,
								'min' => 50,
								'max' => 1920,
								'suffix' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_attr__('Image', 'dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image height', 'dfd'),
								'param_name' => 'image_height',
								'value' => 500,
								'min' => 50,
								'max' => 1920,
								'suffix' => '',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group' => esc_attr__('Image', 'dfd'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Image hover effect','dfd'),
								'param_name' => 'hover_style',
								'value' => array(
									esc_attr__('None','dfd') => '',
									//esc_attr__('Shadow','dfd') => 'dfd-image-shadow',
									esc_attr__('Fade in','dfd') => 'dfd-image-fade-in',
									esc_attr__('Fade out','dfd') => 'dfd-image-fade-out',
									esc_attr__('Blur','dfd') => 'dfd-image-blur',
									esc_attr__('Grow','dfd') => 'dfd-image-scale',
									esc_attr__('Grow with rotation','dfd') => 'dfd-image-scale-rotate',
									esc_attr__('Image parallax','dfd') => 'panr',
								),
								'group' => esc_attr__('Image', 'dfd'),
							),
						)/* vc_map params array */
					)/* vc_map parent array */ 
				); /* vc_map call */ 
			} /* vc_map function check */
		} /* end woocomposer_init_single_cat */
		function woocomposer_single_cat_shortcode($atts){
			$color_heading = $size_title = $color_subtitle = $size_subtitle = $single_category_item = $image_width = $image_height = $output = $module_animation = $el_class = $title_html = $subtitle_html = '';
			$title = $title_font_options = $title_google_fonts = $title_custom_fonts = $subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = '';
			
			$atts = vc_map_get_attributes( 'woocomposer_single_cat', $atts );
			extract( $atts );
			
			$css_rules = $animate = $animation_data = '';
			
			$uniqid = uniqid('dfd-woo-single-cat-');

			if ( ! ( $module_animation == '' ) ) {
				$el_class      .= ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if(isset($background) && $background != '') {
				$css_rules .= '#'.esc_js($uniqid).' .dfd-heading .inline-block {background: '.esc_js($background).'}';
			}
			
			if($image_width == '') {
				$image_width = 500;
			}
			
			if($image_height == '') {
				$image_height = 500;
			}
			
			if(isset($hover_style) && $hover_style != '') {
				$el_class .= ' '.$hover_style;
				if($hover_style == 'panr') {
					wp_enqueue_script('dfd-tween-max');
					wp_enqueue_script('dfd-panr');
				}
			}
			
			if(!isset($single_category_style) || '' == $single_category_style)
				$single_category_style = 'style-1';
			
			$el_class .= ' '.$single_category_style;
						
			if(!empty($single_category_item)) :
				$categories_meta = dfd_product_categories_select();
				$image_url = dfd_aq_resize($categories_meta[$single_category_item]['url'], $image_width, $image_height, true, true, true);
				if(!$image_url) {
					$image_url = $categories_meta[$single_category_item]['url'];
				}
				
				/* Title */
				if(isset($categories_meta[$single_category_item]['name'])) {
					$title .= $categories_meta[$single_category_item]['name'];
					$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts );
					$title_html .= '<'.esc_attr($title_options['tag']).' class="box-name '.esc_attr($title_options['class']).'" ' . $title_options['style'] . '>'. $title .'</'.esc_attr($title_options['tag']).'>';
				}
				
				/* Subtitle */
				if(isset($categories_meta[$single_category_item]['desc'])) {
					$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'widget-sub-title', $subtitle_google_fonts, $subtitle_custom_fonts );
					$subtitle_html .= '<'.esc_attr($subtitle_options['tag']).' class="subtitle mobile-hide '.esc_attr($subtitle_options['class']).'" ' . $subtitle_options['style'] . '>'. $categories_meta[$single_category_item]['desc'] .'</'.esc_attr($subtitle_options['tag']).'>';
				}
				
				ob_start();
				?>
				<div id="<?php echo esc_attr($uniqid) ?>" class="dfd-woo-single-category clearfix <?php echo esc_attr($el_class); ?>" <?php echo $animation_data; ?>>
					<div class="left">
						<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($categories_meta[$single_category_item]['name']); ?>" />
						<?php if($title_html != '' || $subtitle_html != '') : ?>
						<div class="dfd-heading">
							<div class="inline-block">
								<?php echo $title_html ?>
								<?php echo $subtitle_html ?>
							</div>
						</div>
						<?php endif; ?>
						<a href="<?php echo esc_url($categories_meta[$single_category_item]['cat_src']) ?>" title="<?php echo esc_attr($title) ?>" class="main-link"></a>
					</div>
				</div>
				<?php
				$output .= ob_get_clean();
			endif;
			
			if(!empty($css_rules)) {
				$output .= '<script type="text/javascript">
								(function($) {
									$("head").append("<style>'.$css_rules.'</style>");
								})(jQuery);
							</script>';
			}
			
			return $output;
		}/* end woocomposer_single_cat_shortcode */
	} /* end class Dfd_Woo_Sinle_Cat */
	new Dfd_Woo_Sinle_Cat;
}