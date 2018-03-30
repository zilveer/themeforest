<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists("Dfd_Equal_Height_Content")){
	class Dfd_Equal_Height_Content{
		
		function __construct(){
			add_action('init', array($this, 'dfd_equal_height_content_init'));
			add_shortcode('dfd_equal_height_content', array($this, 'dfd_equal_height_content_shortcodes'));
		}
		
		function dfd_equal_height_content_init(){
			if(function_exists("vc_map")){
				new dfd_hide_unsuport_module_frontend("eq_height_content_block");
				vc_map(
					array(
						"name" => __('Equal height content blocks', 'dfd'),
						'base' => "dfd_equal_height_content",
						'icon' => "ultimate_carousel",
						'class' => "ultimate_carousel eq_height_content_block",
						'as_parent' => array('except' => 'vc_gmaps'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 2.0','dfd'),
						'description' => '',
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => __('Columns width','dfd'),
								'param_name' => 'columns_width',
								'value' => array(
										__('Inherit from container', 'dfd') => 'full-width-elements',
										__('Half size', 'dfd') => 'half-size-elements',
										__('1/3 of container width', 'dfd') => 'one-third-width-elements',
										__('1/4 of container width', 'dfd') => 'quarter-width-elements',
									),
								'description' => __('Please select width of the elements','dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Columns offsets','dfd'),
								'param_name' => 'columns_offsets',
								'value' => array(
										__('No offset', 'dfd') => '',
										__('Small paddings', 'dfd') => 'dfd-small-paddings',
										__('Normal paddings', 'dfd') => 'dfd-normal-paddings',
									),
								'description' => __('Please select width of the elements','dfd'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Align content vertically', 'dfd'),
								'param_name' => 'align_content_vertically',
								'value' => array(__('Yes, please', 'dfd') => 'yes'),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Destroy equal heights on mobile devices', 'dfd'),
								'param_name' => 'mobile_destroy_equal_heights',
								'value' => array(__('Yes, please', 'dfd') => 'yes'),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('','dfd'),
						  	),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
			}
		}
		
		function dfd_equal_height_content_shortcodes($atts, $content){
			if(dfd_show_unsuport_nested_module_frontend("Equal height content blocks")) return false;
			$custom_class = $el_class = '';
			
			extract(shortcode_atts(array(
				'columns_width' => 'full-width-elements',
				'columns_offsets' => '',
				'mobile_destroy_equal_heights' => '',
				'align_content_vertically' => '',
				'el_class' => ''
			),$atts));
			
			if(!empty($mobile_destroy_equal_heights)) {
				$custom_class .= ' dfd-mobile-destroy-equal-heights';
			}
			
			if(!empty($align_content_vertically)) {
				$custom_class .= ' dfd-align-content-vertically';
			}
			
			if(empty($columns_width)) {
				$columns_width = 'full-width-elements';
			}
			$custom_class .= ' '.$columns_width;
			
			if(!empty($columns_offsets)) {
				$custom_class .= ' '.$columns_offsets;
			}
			
			ob_start();
			$uniqid = uniqid(rand());
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-equal-height-wrapper clearfix '.esc_attr($custom_class).' '.esc_attr($el_class).'">';
				echo do_shortcode($content);
			echo '</div>';
			?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					$(document).ready(function() {
						if($('#<?php echo esc_js($uniqid); ?>').hasClass('dfd-align-content-vertically')) {
							$('#<?php echo esc_js($uniqid); ?>').find('>div').wrapInner('<div class="dfd-vertical-aligned"></div>');
						}
					});
				})(jQuery);
			</script>
            <?php
			return ob_get_clean();
		}
	}
	new Dfd_Equal_Height_Content;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_equal_height_content extends WPBakeryShortCodesContainer {
		}
	}
}