<?php
/*
* Add-on Name: Stats Counter for Visual Composer
* Template : Design layout 01
*/
if(class_exists('Ultimate_Pricing_Table')){
	class Pricing_Design01 extends Ultimate_Pricing_Table{
		public static function generate_design($atts,$content = null){
			$package_heading = $module_animation = $package_sub_heading = $price_value = $package_price = $package_unit = $price_sub_heading = $package_btn_text = $package_link = $package_featured = $package_hot = $el_class = '';
			extract(shortcode_atts(array(
				'package_heading' => '',
				'package_sub_heading' => '',
				'price_value' => '',
				'package_price' => '',
				'package_unit' => '',
				'price_sub_heading' => '',
				'package_btn_text' => '',
				'package_link' => '',
				'package_featured' => '',
				'package_hot' => '',
				'package_name_font_family' => '',
				'package_name_font_style' => '',
				'package_name_font_size' => '',
				'package_name_font_color' => '',
				'package_name_line_height' => '',
				'subheading_font_family' => '',
				'subheading_font_style' => '',
				'subheading_font_size' => '',
				'subheading_font_color' => '',
				'subheading_line_height' => '',
				'price_value_font_family' => '',
				'price_value_font_style' => '',
				'price_value_font_size' => '',
				'price_value_font_color' => '',
				'price_value_line_height' => '',
				'price_font_family' => '',
				'price_font_style' => '',
				'price_font_size' => '',
				'price_font_color' => '',
				'price_line_height' => '',
				'price_unit_font_family' => '',
				'price_unit_font_style' => '',
				'price_unit_font_size' => '',
				'price_unit_font_color' => '',
				'price_unit_line_height' => '',
				'price_sub_heading_font_family' => '',
				'price_sub_heading_font_style' => '',
				'price_sub_heading_font_size' => '',
				'price_sub_heading_font_color' => '',
				'price_sub_heading_line_height' => '',
				'features_font_family' => '',
				'features_font_style' => '',
				'features_font_size' => '',
				'features_font_color' => '',
				'features_line_height' => '',
				'button_font_family' => '',
				'button_font_style' => '',
				'button_font_size' => '',
				'button_font_color' => '',
				'button_line_height' => '',
				'module_animation' => '',
				'el_class' => '',
			),$atts));
			$output = $link = $target = $featured = $hot = $featured_style = $normal_style = $dynamic_style = '';
			if($package_link !== ''){
				$link = vc_build_link($package_link);
				if(isset($link['target']) && !empty($link['target'])){
					$target = 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"';
				} else {
					$target = '';
				}
				$link = $link['url'];
			} else {
				$link = '#';
			}
			if($package_featured !== ''){
				$featured = "ult_featured";
				$dynamic_style = $featured_style;
			} else {
				$dynamic_style = $normal_style;			
			}
			if($package_hot !== ''){
				$hot = 'ult_hot';
				
			} else {
				$dynamic_style = $normal_style;			
			}
			
			/* Typography */
			
			$package_name_inline = $sub_heading_inline = $price_value_inline = $price_inline = $price_unit_inline = $price_sub_heading_inline = $features_inline = $button_inline = '';
			
			// package name/title
			if($package_name_font_family != '')
			{
				$pkgfont_family = get_ultimate_font_family($package_name_font_family);
				$package_name_inline .= 'font-family:\''.esc_attr($pkgfont_family).'\';';
			}
			
			$package_name_inline .= get_ultimate_font_style($package_name_font_style);
			
			if($package_name_font_size != '')
				$package_name_inline .= 'font-size:'.esc_attr($package_name_font_size).'px;';

			if($package_name_font_color != '')
				$package_name_inline .= 'color:'.esc_attr($package_name_font_color).';';

			if($package_name_line_height != '')
				$package_name_inline .= 'line-height:'.esc_attr($package_name_line_height).'px;';
			
			// sub heading
			if($subheading_font_family != '')
			{
				$shfont_family = get_ultimate_font_family($subheading_font_family);
				$sub_heading_inline .= 'font-family:\''.esc_attr($shfont_family).'\';';
			}
			
			$sub_heading_inline .= get_ultimate_font_style($subheading_font_style);
			
			if($subheading_font_size != '')
				$sub_heading_inline .= 'font-size:'.esc_attr($subheading_font_size).'px;';
					
			if($subheading_font_color != '')
				$sub_heading_inline .= 'color:'.esc_attr($subheading_font_color).';';

			if($subheading_line_height != '')
				$sub_heading_inline .= 'line-height:'.esc_attr($subheading_line_height).'px;';
				
			// price value
			if($price_value_font_family != '')
			{
				$pricevaluefont_family = get_ultimate_font_family($price_value_font_family);
				$price_value_inline .= 'font-family:\''.esc_attr($pricevaluefont_family).'\';';
			}
			
			$price_value_inline .= get_ultimate_font_style($price_value_font_style);
			
			if($price_value_font_size != '')
				$price_value_inline .= 'font-size:'.esc_attr($price_value_font_size).'px;';
					
			if($price_value_font_color != '')
				$price_value_inline .= 'color:'.esc_attr($price_value_font_color).';';

			if($price_value_line_height != '')
				$price_value_inline .= 'line-height:'.esc_attr($price_value_line_height).'px;';
			
			// price
			if($price_font_family != '')
			{
				$pricefont_family = get_ultimate_font_family($price_font_family);
				$price_inline .= 'font-family:\''.esc_attr($pricefont_family).'\';';
			}
			
			$price_inline .= get_ultimate_font_style($price_font_style);
			
			if($price_font_size != '')
				$price_inline .= 'font-size:'.esc_attr($price_font_size).'px;';
					
			if($price_font_color != '')
				$price_inline .= 'color:'.esc_attr($price_font_color).';';

			if($price_line_height != '')
				$price_inline .= 'line-height:'.esc_attr($price_line_height).'px;';
				
			// price unit
			if($price_unit_font_family != '')
			{
				$price_unitfont_family = get_ultimate_font_family($price_unit_font_family);
				$price_unit_inline .= 'font-family:\''.esc_attr($price_unitfont_family).'\';';
			}
			
			$price_unit_inline .= get_ultimate_font_style($price_unit_font_style);
			
			if($price_unit_font_size != '')
				$price_unit_inline .= 'font-size:'.esc_attr($price_unit_font_size).'px;';
					
			if($price_unit_font_color != '')
				$price_unit_inline .= 'color:'.esc_attr($price_unit_font_color).';';

			if($price_unit_line_height != '')
				$price_unit_inline .= 'line-height:'.esc_attr($price_unit_line_height).'px;';
			
			
			// price sub heading
			if($price_sub_heading_font_family != '')
			{
				$price_subheading_family = get_ultimate_font_family($price_sub_heading_font_family);
				$price_sub_heading_inline .= 'font-family:\''.esc_attr($price_subheading_family).'\';';
			}
			
			$price_sub_heading_inline .= get_ultimate_font_style($price_sub_heading_font_style);
			
			if($price_sub_heading_font_size != '')
				$price_sub_heading_inline .= 'font-size:'.esc_attr($price_sub_heading_font_size).'px;';
					
			if($price_sub_heading_font_color != '')
				$price_sub_heading_inline .= 'color:'.esc_attr($price_sub_heading_font_color).';';

			if($price_sub_heading_line_height != '')
				$price_sub_heading_inline .= 'line-height:'.esc_attr($price_sub_heading_line_height).'px;';
			
			
				
			// features
			if($features_font_family != '')
			{
				$featuresfont_family = get_ultimate_font_family($features_font_family);
				$features_inline .= 'font-family:\''.esc_attr($featuresfont_family).'\';';
			}
			
			$features_inline .= get_ultimate_font_style($features_font_style);
			
			if($features_font_size != '')
				$features_inline .= 'font-size:'.esc_attr($features_font_size).'px;';
					
			if($features_font_color != '')
				$features_inline .= 'color:'.esc_attr($features_font_color).';';

			if($features_line_height != '')
				$features_inline .= 'line-height:'.esc_attr($features_line_height).'px;';
				
			// button
			if($button_font_family != '')
			{
				$buttonfont_family = get_ultimate_font_family($button_font_family);
				$button_inline .= 'font-family:\''.esc_attr($buttonfont_family).'\';';
			}
			
			$button_inline .= get_ultimate_font_style($button_font_style);
			
			if($button_font_size != '')
				$button_inline .= 'font-size:'.esc_attr($button_font_size).'px;';
					
			if($button_font_color != '')
				$button_inline .= 'color:'.esc_attr($button_font_color).';';

			if($button_line_height != '')
				$button_inline .= 'line-height:'.esc_attr($button_line_height).'px;';
				
			$args = array(
				$package_name_font_family, $subheading_font_family, $price_font_family, $features_font_family, $button_font_family
			);
			enquque_ultimate_google_fonts($args);
			
			$package_unit_html = '';
			if(!empty($package_unit)) {
				$package_unit_html .= '<span class="ult_price_term" style="'.$price_unit_inline.'">'.$package_unit.'</span>';
			}

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			/* End Typography */
			
			$output .= '<div class="dfd-pricing-cover '.esc_attr($animate).'" '.$animation_data.'>
						<div class="ult_pricing_table_wrap ult_design_1 '.esc_attr($featured).' '.esc_attr($hot).' '.esc_attr($el_class).'">
							<div class="ult_pricing_table" style="'.$featured_style.'">';

					$output .= '<div class="top-part">';
						$output .= '<span class="inscription-hot">hot!</span>
									<div class="ult_pricing_heading">
										<h3 class="box-name" style="'.$package_name_inline.'">'.$package_heading.'</h3>';
									if($package_sub_heading !== ''){
										$output .= '<h5 class="subtitle" style="'.$sub_heading_inline.'">'.$package_sub_heading.'</h5>';
									}
						$output .= '</div><!--ult_pricing_heading-->';
						$output .= '<div class="ult_price_body_block">
										<div class="ult_price_body">
											<div class="ult_price">
												<span class="price-value" style="'.$price_value_inline.'">'.$price_value.'</span>
												<span class="ult_price_figure" style="'.$price_inline.'">'.$package_price.'</span>'.
												$package_unit_html
											.'</div>
											<div class="price-description subtitle" style="'.$price_sub_heading_inline.'">'.$price_sub_heading.'</div>
										</div>
									</div><!--ult_price_body_block-->
								</div><!--ult_top-part-->';

					$output .= '<div class="bottom-part">';
						$output .= '<div class="ult_price_features" style="'.$features_inline.'">
									'.wpb_js_remove_wpautop(do_shortcode($content), true).'
									</div><!--ult_price_features-->';
						if($package_btn_text !== ""){
							$output .= '<div class="ult_price_link" style="'.$normal_style.'">
										<a href="'.esc_url($link).'" '.$target.' class="ult_price_action_button" style="'.$featured_style.' '.$button_inline.'">'.$package_btn_text.'</a>
									</div><!--ult_price_link-->';
						}
					$output .= '</div><!--ult_bottom-part-->';

					$output .= '<div class="ult_clr"></div>
					</div><!--pricing_table-->
				</div><!--pricing_table_wrap-->
			</div><!--cover-->';
			return $output;
		}
	}
}