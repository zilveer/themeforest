<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
Module Name: Ultimate Carousel for Visual Composer
Module URI: https://www.brainstormforce.com/demos/ultimate-carousel
*/
if(!class_exists("Ultimate_Carousel")){
	class Ultimate_Carousel{
		
		function __construct(){
			add_action("init", array($this, "init_carousel_addon"));
			add_shortcode("ultimate_carousel", array($this, "ultimate_carousel_shortcode"));
			add_action( "wp_enqueue_scripts", array( $this, "ultimate_front_scripts"),1 );
			add_action( "admin_enqueue_scripts", array( $this, "custom_param_styles") );
			add_action( "admin_enqueue_scripts", array( $this, "ultimate_admin_scripts"),100 );
			//add_action('save_post', array($this,'ultimate_carousel_shortcode_id_array') ); //is post has our map shortcode
			if ( function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('slick_icon' , array(&$this, 'icon_settings_field' ) );
			}
			// Generate param type "checkboxes"
//			if ( function_exists('vc_add_shortcode_param')) {
//				vc_add_shortcode_param('ult_switch' , array($this, 'checkbox_param')) ;
//			}
		}
		function custom_param_styles(){
			echo '<style type="text/css">
					.items_to_show.vc_shortcode-param {
						background: #E6E6E6;
						padding-bottom: 10px;
					}
					.items_to_show.ult_
					_bottom{
						margin-bottom: 15px;
					}
					.items_to_show.ult_margin_top{
						margin-top: 15px;
					}
				</style>';
		}
		function ultimate_front_scripts(){
			wp_register_script("ult-slick",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/slick.min.js',array('jquery'),null,false);
			wp_register_script("ult-slick-custom",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/slick.custom.min.js',array('jquery','ult-slick'),null,false);
		}
		
		function ultimate_admin_scripts($hook){
			if($hook == "post.php" || $hook == "post-new.php"){
				wp_enqueue_style("ult-icons", get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/slick/icons.css');
			}
		}
		
		function init_carousel_addon(){
			if(function_exists("vc_map")){
				new dfd_hide_unsuport_module_frontend("ult_carousel");
				vc_map(
					array(
						'name' => __('Advanced Carousel', 'js_composer'),
						'base' => 'ultimate_carousel',
						'icon' => 'ultimate_carousel',
						'class' => 'ultimate_carousel ult_carousel',
						'as_parent' => array('except' => 'ultimate_carousel'),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 1.0','dfd'),
						'description' => 'Apply animations everywhere.',
						'params' => array(
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Slider Type','dfd'),
								'param_name' => 'slider_type',
								'value' => array(
										__('Horizontal','dfd') => 'horizontal',
										__('Vertical','dfd') => 'vertical',
										__('Horizontal Full Width','dfd') => 'full_width',
										__('Vertical Full Screen','dfd') => 'full_screen'
									),
								'description' => __('','dfd'),								
								'group'=> 'General',
						  	),
							array(
								'type' => 'text',
								'param_name' => 'title_text_typography',
								'heading' => __('<p>Items to Show‏ - </p>','dfd'),
								'value' => '',
								'edit_field_class' => 'vc_col-sm-12 items_to_show ult_margin_top',
								'group' => 'General'
							),
							array(
								'type' => 'number',
								'class' => '',
								'edit_field_class' => 'vc_col-sm-4 items_to_show ult_margin_bottom',
								'heading' => __('On Desktop','dfd'),
								'param_name' => 'slides_on_desk',
								'value' => '5',
								'min' => '1',
								'max' => '25',
								'step' => '1',
								'description' => __('','dfd'),
								'group'=> 'General',
						  	),
							array(
								'type' => 'number',
								'class' => '',
								'edit_field_class' => 'vc_col-sm-4 items_to_show ult_margin_bottom',
								'heading' => __('On Tabs','dfd'),
								'param_name' => 'slides_on_tabs',
								'value' => '3',
								'min' => '1',
								'max' => '25',
								'step' => '1',
								'description' => __('','dfd'),
								'group'=> 'General',
						  	),
							array(
								'type' => 'number',
								'class' => '',
								'edit_field_class' => 'vc_col-sm-4 items_to_show ult_margin_bottom',
								'heading' => __('On Mobile','dfd'),
								'param_name' => 'slides_on_mob',
								'value' => '2',
								'min' => '1',
								'max' => '25',
								'step' => '1',
								'description' => __('','dfd'),
								'group'=> 'General',
						  	),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Infinite loop', 'dfd'),
								'param_name' => 'infinite_loop',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => __('Restart the slider automatically as it passes the last slide.', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency'  => '',
								'group'=> 'General',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Transition speed','dfd'),
								'param_name' => 'speed',
								'value' => '300',
								'min' => '100',
								'max' => '10000',
								'step' => '100',
								'suffix' => 'ms',
								'description' => __('Speed at which next slide comes.','dfd'),
								'group'=> 'General',
						  	),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Autoplay Slides‏', 'dfd'),
								'param_name' => 'autoplay',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => __('Enable Autoplay', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency'  => '',
								'group'=> 'General',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Autoplay Speed','dfd'),
								'param_name' => 'autoplay_speed',
								'value' => '5000',
								'min' => '100',
								'max' => '10000',
								'step' => '10',
								'suffix' => 'ms',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'autoplay', 'value' => array('on')),
								'group'=> 'General',
						  	),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable center mode','dfd'),
								'param_name' => 'center_mode',
								'value' => array('Yes, please' => 'yes'),
								'group'=> 'General',
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('','dfd'),
								'group'=> 'General',
						  	),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Navigation Arrows', 'dfd'),
								'param_name' => 'arrows',
								// 'admin_label' => true,
								'value' => 'show',
								'options' => array(
									'show' => array(
											'label' => __('Display next / previous navigation arrows', 'dfd'),
											'on' => __('Yes', 'dfd'),
											'off' => __('No', 'dfd'),
										),
									),
								'description' => __('', 'dfd'),
								//'dependency'  => '',
								'group'=> 'Navigation',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable slides count on navigation arrows','dfd'),
								'param_name' => 'enable_counter',
								'value' => array('Yes, please' => 'yes'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Do not hide arrows when not in focus','dfd'),
								'param_name' => 'arrows_always_show',
								'value' => array('Yes, please' => 'yes'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Arrow Style','dfd'),
								'param_name' => 'arrow_style',
								'value' => array(
									__('Default','dfd') => 'default',
									__('Circle Background','dfd') => 'circle-bg',
									__('Square Background','dfd') => 'square-bg',
									__('Circle Border','dfd') => 'circle-border',
									__('Square Border','dfd') => 'square-border',
								),
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Background Color','dfd'),
								'param_name' => 'arrow_bg_color',
								'value' => '',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrow_style', 'value' => array('circle-bg','square-bg')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Border Color','dfd'),
								'param_name' => 'arrow_border_color',
								'value' => '',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrow_style', 'value' => array('circle-border','square-border')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Border Size','dfd'),
								'param_name' => 'border_size',
								'value' => '2',
								'min' => '1',
								'max' => '100',
								'step' => '1',
								'suffix' => 'px',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrow_style', 'value' => array('circle-border','square-border')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Arrow Color','dfd'),
								'param_name' => 'arrow_color',
								'value' => '#333333',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Arrow Size','dfd'),
								'param_name' => 'arrow_size',
								'value' => '30',
								'min' => '10',
								'max' => '75',
								'step' => '1',
								'suffix' => 'px',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'slick_icon',
								'class' => '',
								'heading' => __('Select icon for "Next Arrow"', 'dfd'),
								'param_name' => 'next_icon',
								'value' => 'ultsl-arrow-right4',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
							),
							array(
								'type' => 'slick_icon',
								'class' => '',
								'heading' => __('Select icon for "Previous Arrow"', 'dfd'),
								'param_name' => 'prev_icon',
								'value' => 'ultsl-arrow-left4',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'arrows', 'value' => array('show')),
								'group'=> 'Navigation',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Dots Navigation', 'dfd'),
								'param_name' => 'dots',
								// 'admin_label' => true,
								'value' => 'show',
								'options' => array(
									'show' => array(
											'label' => __('Display dot navigation', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency'  => '',
								'group'=> 'Navigation',
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Color of dots','dfd'),
								'param_name' => 'dots_color',
								'value' => '#333333',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'dots', 'value' => array('show')),
								'group'=> 'Navigation',
						  	),
							array(
								'type' => 'slick_icon',
								'class' => '',
								'heading' => __('Select icon for "Navigation Dots"', 'dfd'),
								'param_name' => 'dots_icon',
								'value' => 'ultsl-record',
								'description' => __('','dfd'),
								'dependency' => Array('element' => 'dots', 'value' => array('show')),
								'group'=> 'Navigation',
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Item Animation','dfd'),
								'param_name' => 'item_animation',
								'value' => array(
							 		__('No Animation','dfd') => '',
									__('Swing','dfd') => 'swing',
									__('Pulse','dfd') => 'pulse',
									__('Fade In','dfd') => 'fadeIn',
									__('Fade In Up','dfd') => 'fadeInUp',
									__('Fade In Down','dfd') => 'fadeInDown',
									__('Fade In Left','dfd') => 'fadeInLeft',
									__('Fade In Right','dfd') => 'fadeInRight',
									__('Fade In Up Long','dfd') => 'fadeInUpBig',
									__('Fade In Down Long','dfd') => 'fadeInDownBig',
									__('Fade In Left Long','dfd') => 'fadeInLeftBig',
									__('Fade In Right Long','dfd') => 'fadeInRightBig',
									__('Slide In Down','dfd') => 'slideInDown',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Slide In Left','dfd') => 'slideInLeft',
									__('Bounce In','dfd') => 'bounceIn',
									__('Bounce In Up','dfd') => 'bounceInUp',
									__('Bounce In Down','dfd') => 'bounceInDown',
									__('Bounce In Left','dfd') => 'bounceInLeft',
									__('Bounce In Right','dfd') => 'bounceInRight',
									__('Rotate In','dfd') => 'rotateIn',
									__('Light Speed In','dfd') => 'lightSpeedIn',
									__('Roll In','dfd') => 'rollIn',
									),
								'description' => __('', 'dfd'),
								'group'=> 'Animation',
						  	),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Draggable Effect', 'dfd'),
								'param_name' => 'draggable',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => __('Allow slides to be draggable', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency'  => '',
								'group'=> 'Advanced',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Touch Move', 'dfd'),
								'param_name' => 'touch_move',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => __('Enable slide moving with touch', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency' => Array('element' => 'draggable', 'value' => array('on')),
								'group'=> 'Advanced',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('RTL Mode', 'dfd'),
								'param_name' => 'rtl',
								// 'admin_label' => true,
								'value' => '',
								'options' => array(
									'on' => array(
											'label' => __('Turn on RTL mode', 'dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								'description' => __('', 'dfd'),
								'dependency'  => '',
								'group'=> 'Advanced',
							),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
			}
		}
		
		function ultimate_carousel_shortcode($atts, $content) {
			if(dfd_show_unsuport_nested_module_frontend("carusel")) return false;
			$slider_type = $slides_on_desk = $slides_on_tabs = $slides_on_mob = $slide_to_scroll = $speed = $infinite_loop = $autoplay = $autoplay_speed = '';
			$lazyload = $arrows = $enable_counter = $arrows_always_show = $dots = $dots_icon = $next_icon = $prev_icon = $dots_color = $draggable = $swipe = $touch_move = '';
			$rtl = $arrow_color = $arrow_size = $arrow_style = $arrow_bg_color = $arrow_border_color = $border_size = $item_space = $el_class = $center_mode = '';
			$item_animation = $center_mode_class = '';
			extract(shortcode_atts(array(
				'slider_type' => 'horizontal',
				'slides_on_desk' => '5',
				'slides_on_tabs' => '3',
				'slides_on_mob' => '2',
				//'slide_to_scroll' => '',
				'speed' => '300',
				'infinite_loop' => 'on',
				'autoplay' => 'on',
				'autoplay_speed' => '5000',
				'lazyload' => '',
				'arrows' => 'show',
				'enable_counter' => '',
				'arrows_always_show' => '',
				'dots' => 'show',
				'dots_icon' => '',
				'next_icon' => '',
				'prev_icon'=> '',
				'dots_color' => '',
				'arrow_color' => '',
				'arrow_size' => '30',
				'arrow_style' => 'default',
				'arrow_bg_color' => '',
				'arrow_border_color' => '',
				'border_size' => '1.5',
				'draggable' => 'on',
				'swipe' => 'true',
				'touch_move' => 'on',
				'rtl' => '',
				'item_space' => '',
				'center_mode' => '',
				'el_class' => '',
				'item_animation' => '',
			),$atts));
			
			
			$uid = uniqid(rand());
			
			$settings = $responsive = $infinite = $dot_display = $custom_dots = $arr_style = '';
			
			/*if($slide_to_scroll == "all")
				$slide_to_scroll = $slides_on_desk;
			else*/
			$slide_to_scroll = 1;
			
			$arr_style .= 'color:'.esc_attr($arrow_color).'; font-size:'.esc_attr($arrow_size).'px; width: '.esc_attr($arrow_size).'px;';
			if($arrow_style == "circle-bg" || $arrow_style == "square-bg"){
				$arr_style .= "background:".esc_attr($arrow_bg_color).";";
			} elseif($arrow_style == "circle-border" || $arrow_style == "square-border"){
				$arr_style .= "border:".esc_attr($border_size)."px solid ".esc_attr($arrow_border_color).";";
			}
			
			if($dots !== "off" && $dots !== "") {
				$settings .= 'dots: true,';
			} else {
				$settings .= 'dots: false,';
			}
			if($autoplay !== 'off' && $autoplay !== '') {
				$settings .= 'autoplay: true,';
			}
			if($autoplay_speed !== '') {
				$settings .= 'autoplaySpeed: '.esc_js($autoplay_speed).',';
			}
			if($speed !== '') {
				$settings .= 'speed: '.$speed.',';
			}
			if($infinite_loop !== 'off' && $infinite_loop !== '') {
				$settings .= 'infinite: true,';
			} else {
				$settings .= 'infinite: false,';
			}
			if($lazyload !== 'off' && $lazyload !== '') {
				$settings .= 'lazyLoad: true,';
			}
			if(!empty($center_mode)) {
				$settings .= 'centerMode: true,';
				$center_mode_class .= 'dfd-carusel-center-mode';
			}
			if($arrows !== 'off' && $arrows !== ''){
				$settings .= 'arrows: true,';
				$settings .= 'nextArrow: \'<span style="'.$arr_style.'" class="slick-next '.esc_attr($arrow_style).'"><span class="count"></span><i class="'.esc_attr($next_icon).'"></i></span>\',';
				$settings .= 'prevArrow: \'<span style="'.$arr_style.'" class="slick-prev '.esc_attr($arrow_style).'"><span class="count"></span><i class="'.esc_attr($prev_icon).'"></i></span>\',';
			} else {
				$settings .= 'arrows: false,';
			}
			
			if($slide_to_scroll !== '') {
				$settings .= 'slidesToScroll:'.esc_js($slide_to_scroll).',';
			}
			if($slides_on_desk !== '') {
				$settings .= 'slidesToShow:'.esc_js($slides_on_desk).',';
			}
			if($slides_on_mob == '') {
				$slides_on_mob = $slides_on_desk;
			}
			if($slides_on_tabs == '') {
				$slides_on_tabs = $slides_on_desk;
			}
			if($draggable !== 'off' && $draggable !== ''){
				$settings .= 'swipe: true,';
				$settings .= 'draggable: true,';
			} else {
				$settings .= 'swipe: false,';
				$settings .= 'draggable: false,';
			}
			
			if($touch_move !== 'off' && $touch_move !== '') {
				$settings .= 'touchMove: true,';
			} else {
				$settings .= 'touchMove: false,';
			}
			if($rtl !== 'off' && $rtl !== '') {
				$settings .= 'rtl: true,';
			}
			
			if($slider_type == 'vertical' || $slider_type == 'full_screen') {
				$settings .= 'vertical: true,';
			}
			$slider_add_class = '';
			
			if($slider_type == 'full_screen') {
				$slider_add_class .= ' ult_vertical';
			}
			
			if($arrows_always_show) {
				$slider_add_class .= ' dfd-keep-arrows';
			}
			
			$settings .= 'responsive: [
							{
								breakpoint: 1280,
								settings: {
									slidesToShow: '.esc_js($slides_on_desk).',
									slidesToScroll: '.esc_js($slide_to_scroll).',
									'.$infinite.'
									'.$dot_display.'
								}
							},
							{
								breakpoint: 1025,
								settings: {
									slidesToShow: '.esc_js($slides_on_tabs).',
									slidesToScroll: '.esc_js($slides_on_tabs).'
								}
							},
							{
								breakpoint: 480,
								settings: {
									slidesToShow: '.$slides_on_mob.',
									slidesToScroll: '.$slides_on_mob.'
								}
							}
						],';
			$settings .= 'pauseOnHover: true,
						pauseOnDotsHover: true,';
			if($dots_icon !== 'off' && $dots_icon !== ''){
				if($dots_color !== 'off' && $dots_color !== '') {
					$custom_dots = 'style="color:'.esc_attr($dots_color).';"';
				}
				$settings .= 'customPaging: function(slider, i) {
                   return \'<i type="button" '.esc_attr($custom_dots).' class="'.esc_attr($dots_icon).'" data-role="none"></i>\';
                },';
			}
			
			if($item_animation == ''){
				$item_animation = 'no-animation';
			}
			ob_start();
			$uniqid = uniqid(rand());
			echo '<div class="dfd-carousel-wrapper">';
			echo '<div id="ult-carousel-'.esc_attr($uniqid).'" class="ult-carousel-wrapper ult_'.esc_attr($slider_type).' '.esc_attr($center_mode_class).' '.esc_attr($slider_add_class).'">';
				echo '<div class="ult-carousel-'.esc_attr($uid).' '.esc_attr($el_class).'">';
					ultimate_override_shortcodes($item_space, $item_animation);
					echo do_shortcode($content);
					ultimate_restore_shortcodes();
				echo '</div>';
			echo '</div>';
			?>
			<script type="text/javascript">
				(function($) {
					"use strict";
					var $carousel = $('.ult-carousel-<?php echo esc_js($uid); ?>');
					$(document).ready(function() {
						<?php if($enable_counter) :  ?>
							var total_slides;
							$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
								var prev_slide_index, next_slide_index, current;
								var $prev_counter = $carousel.find('.slick-prev .count');
								var $next_counter = $carousel.find('.slick-next .count');
								total_slides = slick.slideCount;
								current = (currentSlide ? currentSlide : 0) + 1;
								prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
								next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
								$prev_counter.text(prev_slide_index + '/' + total_slides);
								$next_counter.text(next_slide_index + '/'+ total_slides);
							});
						<?php endif; ?>
						$carousel.slick({<?php echo $settings; ?>});
					});
				})(jQuery);
			</script>
            <?php
			echo '</div>';
			return ob_get_clean();
		}
		
				// create icon style attribute
		function icon_settings_field($settings, $value) {
			$uid = uniqid();
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			if($param_name == "next_icon" || $param_name == "prev_icon"){
				$icons = array('dfd-icon-right_1','dfd-icon-right_2');
			}
			if($param_name == "prev_icon"){
				$icons = array('dfd-icon-left_1','dfd-icon-left_2');
			}
			
			if($param_name == "dots_icon"){
				$icons = array('dfd-square-dots ','dfd-circle-large-dots','dfd-circle-small-dots','dfd-line-dots');
			}
		
			$output = '<input type="hidden" name="'.esc_attr($param_name).'" class="wpb_vc_param_value '.esc_attr($param_name).' '.esc_attr($type).' '.esc_attr($class).'" value="'.esc_attr($value).'" id="trace-'.esc_attr($uid).'"/>';
			$output .='<div id="icon-dropdown-'.esc_attr($uid).'" >';
			$output .= '<ul class="icon-list">';
			$n = 1;
			foreach($icons as $icon)
			{
				$selected = ($icon == $value) ? 'class="selected"' : '';
				$id = 'icon-'.esc_attr($n);
				$output .= '<li '.$selected.' data-icon="'.esc_attr($icon).'"><i class="dfd-icon '.esc_attr($icon).'"></i><label class="dfd-icon">'.$icon.'</label></li>';
				$n++;
			}
			$output .='</ul>';
			$output .='</div>';
			$output .= '<script type="text/javascript">		
					jQuery("#icon-dropdown-'.esc_js($uid).' li").click(function() {
						jQuery(this).attr("class","selected").siblings().removeAttr("class");
						var icon = jQuery(this).attr("data-icon");
						jQuery("#trace-'.esc_js($uid).'").val(icon);
						jQuery(".icon-preview-'.esc_js($uid).'").html("<i class=\'ult-icon "+icon+"\'></i>");
					});
			</script>';
			$output .= '<style type="text/css">';
			$output .= 'ul.icon-list li {
							display: inline-block;
							float: left;
							padding: 5px;
							border: 1px solid #ddd;
							font-size: 18px;
							width: 18px;
							height: 18px;
							line-height: 18px;
							margin: 0 auto;
						}
						ul.icon-list li label.dfd-icon {
							display: none;
						}
						.ult-icon-preview {
							padding: 5px;
							font-size: 24px;
							border: 1px solid #ddd;
							display: inline-block;
						}
						ul.icon-list li.selected {
							background: #3486D1;
							padding: 10px;
							margin: 0 -1px;
							margin-top: -7px;
							color: #fff;
							font-size: 24px;
							width: 24px;
							height: 24px;
						}
						ul.icon-list li {position: relative;}
						ul.icon-list li i.dfd-square-dots,
						ul.icon-list li i.dfd-circle-large-dots,
						ul.icon-list li i.dfd-circle-small-dots,
						ul.icon-list li i.dfd-line-dots {
							position: absolute;
							top: 50%;
							left: 50%;
						}
						ul.icon-list li i.dfd-square-dots {
							display:block;
							position:relative;
							width:4px;
							height:4px;
							margin-top: -2px;
							margin-left: -2px;
							background:#d2d2d2;
						}
						ul.icon-list li i.dfd-circle-large-dots,
						ul.icon-list li i.dfd-circle-small-dots {
							display:block;
							position:relative;
							border-radius:50%;
							width:7px;
							height:7px;
						}
						ul.icon-list li i.dfd-circle-large-dots {
							margin-top: -3.5px;
							margin-left: -3.5px;
							background:#d2d2d2;
						}
						ul.icon-list li i.dfd-circle-small-dots {
							margin-top: -4.5px;
							margin-left: -4.5px;
							background:transparent;
							border:1px solid #d2d2d2;
						}
						ul.icon-list li i.dfd-line-dots {
							display:block;
							width:22px;
							margin-left: -11px;
							height:1px;
							background:#d2d2d2;
						}';
			$output .= '</style>';
			return $output;
		}
		// ult_switch param
		function checkbox_param($settings, $value){
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = $checked = '';
			$un = uniqid();
			if(is_array($options) && !empty($options)){
				foreach($options as $key => $opts){
					if($value == $key){
						$checked = "checked";
					} else {
						$checked = "";
					}
					$uid = uniqid();
					$output .= '<div class="onoffswitch">
							<input type="checkbox" name="'.esc_attr($param_name).'" value="'.esc_attr($value).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . ' onoffswitch-checkbox chk-switch-'.esc_attr($un).'" id="switch'.esc_attr($uid).'" '.$checked.'>
							<label class="onoffswitch-label" for="switch'.esc_attr($uid).'">
								<div class="onoffswitch-inner">
									<div class="onoffswitch-active">
										<div class="onoffswitch-switch">'.$opts['on'].'</div>
									</div>
									<div class="onoffswitch-inactive">
										<div class="onoffswitch-switch">'.$opts['off'].'</div>
									</div>
								</div>
							</label>
						</div>';
					$output .= '<div class="chk-label">'.$opts['label'].'</div><br/>';
				}
			}
			
			$output .= '<script type="text/javascript">
				jQuery("#switch'.esc_js($uid).'").change(function(){
					 
					 if(jQuery("#switch'.esc_js($uid).'").is(":checked")){
						jQuery("#switch'.esc_js($uid).'").val("'.esc_js($key).'");
						jQuery("#switch'.esc_js($uid).'").attr("checked","checked");
					 } else {
						jQuery("#switch'.esc_js($uid).'").val("off");
						jQuery("#switch'.esc_js($uid).'").removeAttr("checked");
					 }
					
				});
			</script>';
			
			return $output;
		}
		
	}
	new Ultimate_Carousel;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) && !class_exists('WPBakeryShortCode_ultimate_carousel') ) {
		class WPBakeryShortCode_ultimate_carousel extends WPBakeryShortCodesContainer {
		}
	}
}
if(!function_exists('ultimate_override_shortcodes')) {
	function ultimate_override_shortcodes($item_space, $item_animation) {
		global $shortcode_tags, $_shortcode_tags;
		// Let's make a back-up of the shortcodes
		$_shortcode_tags = $shortcode_tags;
		// Add any shortcode tags that we shouldn't touch here
		$disabled_tags = array( 'vc_tab', 'vc_accordion_tab', 'info_list_item', 'ult_hotspot_items', 'info_circle_item', 'ultimate_icon_list_item', 'ult_ihover_item', 'dfd_service_item' );
		foreach ( $shortcode_tags as $tag => $cb ) {
			if ( in_array( $tag, $disabled_tags ) ) {
				continue;
			}
			// Overwrite the callback function
			$shortcode_tags[ $tag ] = 'ultimate_wrap_shortcode_in_div';
			$_shortcode_tags["ult_item_space"] = $item_space;
			$_shortcode_tags["item_animation"] = $item_animation;
		}
	}
}
// Wrap the output of a shortcode in a div with class "ult-item-wrap"
// The original callback is called from the $_shortcode_tags array
if(!function_exists('ultimate_wrap_shortcode_in_div')) {
	function ultimate_wrap_shortcode_in_div( $attr, $content = null, $tag ) {
		global $_shortcode_tags;

		return '<div class="ult-item-wrap" data-animation="animated '.esc_attr($_shortcode_tags["item_animation"]).'">' . call_user_func( $_shortcode_tags[ $tag ], $attr, $content, $tag ) . '</div>';
	}
}
if(!function_exists('ultimate_restore_shortcodes')) {
	function ultimate_restore_shortcodes() {
		global $shortcode_tags, $_shortcode_tags;
		// Restore the original callbacks
		if ( isset( $_shortcode_tags ) ) {
			$shortcode_tags = $_shortcode_tags;
		}
	}
}