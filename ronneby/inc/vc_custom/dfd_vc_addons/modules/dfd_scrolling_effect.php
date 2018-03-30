<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Scrolling Effect Module
*/
if(!class_exists('Dfd_Scrolling_Effect')) 
{
	class Dfd_Scrolling_Effect{
		function __construct(){
			add_action('init',array($this,'dfd_scrolling_effect_init'));
			add_shortcode('dfd_scrolling_effect',array($this,'dfd_scrolling_effect_shortcode'));
		}
		function dfd_scrolling_effect_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   'name' => __('Scrolling effect module','dfd'),
					   'base' => 'dfd_scrolling_effect',
					   'class' => 'vc_info_banner_icon',
					   'icon' => 'vc_icon_info_banner',
					   'category' => __('Ronneby 2.0','dfd'),
					   'description' => __('Pretty scrolling effect. Can be used at the top of the page only','dfd'),
					   'params' => array(
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Image','dfd'),
								'param_name' => 'module_image',
								'value' => '',
								'description' => __('Upload the image. Please make sure that allow_url_fopen is enabled on your server/hosting for correct work of this module','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image custom offset', 'dfd'),
								'param_name' => 'module_image_offset',
								'value' => 0,
								'min' => '-500',
								'max' => '500',
								'description' => __('','dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_scrolling_effect_shortcode($atts) {
			$output = $el_class = $module_image = $module_image_offset = $item_width = $item_height = '';
			
			extract(shortcode_atts( array(
				'module_image' => '',
				'module_image_offset' => '0',
				'el_class' => '',
			),$atts));
			
			$att_image_css = $image_width = $image_height = '';
			
			$image_src = wp_get_attachment_image_src($module_image, 'full');
			
			$uniqid = uniqid('dfd-scrolling-effect-');
			
			//$el_class .= ' ' . esc_attr($wrapper_template);
			
			if(!empty($image_src[0]) && isset($image_src[1]) && isset($image_src[2])) {
				$image_width = $image_src[1];
				$image_height = $image_src[2];
			}
			if($image_src[0]) {
				$att_image_css .= '#'.esc_attr($uniqid).' .dfd-same-bg {background-image: url('.esc_url($image_src[0]).');}';
			}
			if(!empty($image_width) && !empty($image_height)) {
				$att_image_css .= '#'.esc_attr($uniqid).' .dfd-scaling-image {
							top: 50%;
							width: '.esc_attr($image_width).'px;
							height: '.esc_attr($image_height).'px;
							margin-left: -'.esc_attr($image_width/2).'px;
							margin-top: -'.esc_attr($image_height/2 - $module_image_offset).'px;
						}
						#'.esc_attr($uniqid).' .dfd-appearing-image {
							width: '.esc_attr($image_width*.3).'px;
							height: '.esc_attr($image_height*.3).'px;
							margin-top: '.esc_attr($image_height/2 + $module_image_offset).'px;
						}';
			}
			ob_start();
			?>
			
			<div id="<?php echo esc_attr($uniqid) ?>" class="dfd-scrolling-effect-module <?php echo esc_attr($el_class) ?>">
				
				<div class="dfd-scrolling-effect-item">
				
					<div class="dfd-scaling-image dfd-same-bg"></div>
					<div class="dfd-appearing-image dfd-same-bg"><img src="<?php echo esc_url($image_src[0]);?>" alt="image holder" style="visibility: hidden;" /></div>
				
				</div>
				
				<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							
							<?php if(!empty($att_image_css)) : ?>
								$('head').append('<style type="text/css"><?php echo esc_js($att_image_css) ?></style>');
							<?php endif; ?>
							
							if(!Modernizr.touch) {
								var $window = $(window),
									$container = $('#<?php echo esc_js($uniqid) ?>'),
									el = $('.dfd-scaling-image', $container),
									mac = $('.dfd-appearing-image', $container),
									offset = mac.offset();

								$window.on('scroll', function() {
									var windowTop = $window.scrollTop(),
										scrollPercent = (offset.top - windowTop) / offset.top,
										scale = 'scale(' + scrollPercent + ')';

									el.css('transform', scale);

									if (scrollPercent <= .3) {
										el.hide();
										mac.css('opacity',1);
									} else {
										el.show();
										mac.css('opacity',0);
									}
								});
							}
						});
					})(jQuery);
				</script>
				
			</div>
			<?php
			$output .= ob_get_clean();
			return $output;
		}
	}
}
if(class_exists('Dfd_Scrolling_Effect'))
{
	$Dfd_Scrolling_Effect = new Dfd_Scrolling_Effect;
}
