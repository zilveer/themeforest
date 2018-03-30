<?php //
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Testimonials
*/
if(!class_exists('Dfd_Subscribe')) 
{
	class Dfd_Subscribe{
		function __construct(){
			add_action('init',array($this,'dfd_subscribe_init'));
			add_shortcode('dfd_subscribe',array($this,'dfd_subscribe_shortcode'));
		}
		function dfd_subscribe_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Subscribe module','dfd'),
						'base' => 'dfd_subscribe',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						'category' => __('Ronneby 1.0','dfd'),
						//'deprecated' => '4.6',
						'description' => __('Displays Subscribe Form','dfd'),
						'params' => array(
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Placeholder','dfd'),
								'param_name' => 'subscribe_module_placeholder',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Feedburner Feed Name', 'dfd'),
								'param_name' => 'subscribe_module_feed_name',
								'admin_label' => true,
								'value' => '',
								'description' => __('Read more how to setup <a href="https://support.google.com/feedburner/answer/78978" target="_blank">Adding FeedBurner Email</a>', 'dfd'),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Module style','dfd'),
								'param_name' => 'subscribe_module_style',
								'value' => array(
										__('Default', 'dfd') => '',
										__('Extended', 'dfd') => 'dfd-subscribe-active',
									),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								"type"        => "dropdown",
								"class"       => "",
								"heading"     => __( "Animation", 'dfd' ),
								"param_name"  => "module_animation",
								"value"       => dfd_module_animation_styles(),
								"description" => __( "", 'dfd' ),
								"group"       => "Animation Settings",
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_subscribe_shortcode($atts) {
			$output = $subscribe_module_feed_name = $subscribe_module_placeholder = $subscribe_module_style = $el_class = $module_animation = '';
			
			extract(shortcode_atts( array(
				'subscribe_module_placeholder' => '',
				'subscribe_module_feed_name' => '',
				'subscribe_module_style' => '',
				'module_animation' => '',
				'el_class' => '',
			),$atts));
			
			$animate = $animation_data = $title_css = $subtitle_css = $background_css = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			$unique_id = uniqid('dfd-subscribe-');

			ob_start();
			?>
			
			<div class="widget dfd-subscribe-module <?php echo esc_attr($el_class).' '.esc_attr($animate); ?>" <?php echo $background_css; ?> <?php echo $animation_data; ?>>
				
				<?php if($subscribe_module_feed_name != '') : ?>
					<div class="dfd-subscribe-module-form <?php echo esc_attr($subscribe_module_style); ?>">
						<form id="form_<?php echo esc_attr($unique_id); ?>" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $subscribe_module_feed_name; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
							<input class="text" type="text" name="email" id="<?php echo uniqid('subsmail_'); ?>" placeholder="<?php if (!empty($subscribe_module_placeholder)) echo esc_attr($subscribe_module_placeholder); ?>" />
							<button type="submit" class="submit"><?php _e('Subscribe', 'dfd'); ?></button>
							<input type="hidden" value="<?php echo esc_attr($subscribe_module_feed_name); ?>" name="uri"/>
							<input type="hidden" name="loc" value="en_US"/>
						</form>
					</div>
				<?php else : ?>
					<h3 class="widget-title"><?php _e('Please fill in the Feedburner Feed Name parameter', 'dfd'); ?></h3>
				<?php endif; ?>
					
			</div>
			
			<?php
			$output .= ob_get_clean();
					
			return $output;
		}
	}
}
if(class_exists('Dfd_Subscribe'))
{
	$Dfd_Subscribe = new Dfd_Subscribe;
}
