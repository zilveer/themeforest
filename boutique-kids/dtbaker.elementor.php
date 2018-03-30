<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if(!class_exists('dtbaker_elementor')) {
	class dtbaker_elementor {

		private static $instance = null;

		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self; }

			return self::$instance;
		}

		public function init() {

			// Add new button widget option
			add_filter('elementor/elements/base/add_control/button_type',function($args){
				$args['options']['dark_arrow'] = __('Dark Arrow', 'boutique-kids');
				return $args;
			});

			/*add_action('elementor/elements/add_group_control/typography',function($filtered_controls, $element, $user_args){
				if(isset($filtered_controls['font_family']['selectors']) && is_array($filtered_controls['font_family']['selectors'])){
				}
				return $filtered_controls;
			}, 10, 3);*/
			add_filter('elementor/groups/base/add_controls/typography',function($filtered_controls, $element, $user_args){
				/*if(isset($filtered_controls['font_family']['selectors']) && is_array($filtered_controls['font_family']['selectors'])){
					$filtered_controls['font_family']['selectors']['']
				}*/
				return $filtered_controls;
			}, 10, 3);


			add_action('elementor/after_register_controls',function($base){
				if($base->get_id() == 'image-carousel'){
					$base->add_control(
						'boutique_border_style',
						[
							'label' => __( 'Border Style', 'boutique-kids' ),
							'type' => 'select', //Controls_Manager::SELECT,
							'default' => 'default',
							'section' => 'section_image_carousel',
							'options' => array(
								'default' => 'Default',
								'boxed' => 'Line Box',
							),
						]
					);
					$base->add_control(
						'boutique_layout_type',
						[
							'label' => __( 'Layout Type', 'boutique-kids' ),
							'type' => 'select', //Controls_Manager::SELECT,
							'default' => 'default',
							'section' => 'section_image_carousel',
							'options' => array(
								'default' => 'Default',
								'slider' => 'Slider with Text',
							),
						]
					);
				}
			});

			// modify output of existing widget.
			add_action('elementor/widgets/render_content/before', function($widget, $instance = []){
				if(!empty($instance['boutique_border_style'])) {
					$widget->add_render_attribute( 'widget-container', 'class', [
						esc_attr('boutique-border-style-' . $instance['boutique_border_style'])
					] );
				}
				if(!empty($instance['boutique_layout_type'])) {
					$widget->add_render_attribute( 'widget-container', 'class', [
						esc_attr('boutique-layout-type-' . $instance['boutique_layout_type'])
					] );
				}
			}, 10, 2);
			add_filter('elementor/widgets/image_carousel/image_html', function($image_html, $attachment, $instance = []){
				//print_r($instance);
				if(!empty($instance['boutique_layout_type']) && $instance['boutique_layout_type'] == 'slider') {
					$slider_text = '<h2>Post Title</h2>';
					$slider_text .= '<p>Post text post text post text post text post text post text post text post text post text </p>';
					$slider_text .= '<a href="adf">Test Button</a>';
					$image_html = '<div class="dtbaker-image-slider-text">' . $slider_text . '</div><div class="dtbaker-image-slider-image"><div class="dtbaker-photo-frame"><div>' . $image_html . '</div></div></div>';
				}
				return $image_html;
			}, 10, 3);

		}
	}

	dtbaker_elementor::get_instance()->init();
}