<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Horizontal Scroll
* Add-on URI: http://wpsaloon.com
*/
if(!class_exists('Dfd_Horizontal_Scroll')) {
	class Dfd_Horizontal_Scroll {
		
		var $container_height;
		var $items_offset;
		
		function __construct() {
			$this->container_height = '';
			$this->items_offset = '';
			add_action('init', array($this, 'add_dfd_horizontal_scroll'));
			add_shortcode( 'dfd_horizontal_scroll', array($this, 'dfd_horizontal_scroll' ) );
			add_shortcode( 'dfd_horizontal_scroll_container', array($this, 'dfd_horizontal_scroll_container' ) );
			add_shortcode( 'dfd_horizontal_scroll_item', array($this, 'dfd_horizontal_scroll_item' ) );
		}
		function dfd_horizontal_scroll($atts, $content = null) {
			if(dfd_show_unsuport_nested_module_frontend("Horizontal scroll gallery")) return false;
			$enable_prev_next = $enable_dragg_line = $container_height = $items_offset = $start_from = $navigation_event = $display_mode = $scroll_source = $animation_speed = $el_class = $module_animation = $arrows_color = $navbar_color = '';
			extract(shortcode_atts(array(
				'enable_prev_next' => '',
				'enable_dragg_line' => '',
				'container_height' => '',
				'items_offset' => '',
				'start_from' => '',
				'navigation_event' => '',
				'display_mode' => 'basic',
				'scroll_source' => '',
				'arrows_color' => '',
				'navbar_color' => '',
				'animation_speed' => '',
				'el_class' => '',
				'module_animation' => '',
			), $atts));
			
			if(empty($container_height)) {
				$container_height = 550;
			}
			
			if(!empty($items_offset)) {
				$items_padding = $items_offset/2;
			} else {
				$items_padding = 0;
			}
			
			if(empty($animation_speed)) {
				$animation_speed = 300;
			}
			
			if(empty($navigation_event)) {
				$navigation_event = 'click';
			}
			
			$this->container_height = $container_height;
			$this->items_offset = $items_padding;
			
			$unique_id = uniqid('dfd-horizontal-scroll-');
			
			$output = $animate = $animation_data = $navbar_css = $arrows_css =  '';
			if($navbar_color != '') {
				$navbar_css .= 'style="background: '.esc_attr($navbar_color).'"';
			}
			if($arrows_color != '') {
				$arrows_css =  'style="color: '.esc_attr($arrows_color).'"';
			}
			
			if ( ! ($module_animation == '')){
				$animate = ' cr-animate-gen';
				$animation_data = 'data-animate-item = ".dfd-horizontal-scroll-wrap" data-animate-type = "'.esc_attr($module_animation).'" ';
			}
			
			wp_enqueue_script('dfd-sly');
			
			$output .= '<div id="'.esc_attr($unique_id).'" class="dfd-horizontal-scroll-wrap '.esc_attr($animate).'" '.$animation_data.'>';
			$output .= '<div class="dfd-horizontal-scroll-container" data-height="'.esc_attr($container_height).'">';
			$output .= '<ul class="slidee">';
			$output .= do_shortcode($content);
			$output .= '</ul>';
			$output .= '</div>';
			if($enable_dragg_line) {
				$output .= '<div class="scrollbar">';
				$output .= '<div class="handle" '.$navbar_css.'></div>';
				$output .= '</div>';
			}
			if($enable_prev_next) {
				$output .= '<div class="dfd-navbar">';
				$output .= '<a href="#" class="sly-prev" '.$arrows_css.'><i class="dfd-icon-left_2"></i></a>';
				$output .= '<a href="#" class="sly-next" '.$arrows_css.'><i class="dfd-icon-right_2"></i></a>';
				$output .= '</div>';
			}
			ob_start();
			?>
			<script type="text/javascript">
				(function($) {
					$(window).load(function() {
						var $window = $(window),
							$container = $('#<?php echo esc_js($unique_id) ?>'),
							$slider = $('.dfd-horizontal-scroll-container', $container),
							startFrom = <?php echo (!empty($start_from)) ? esc_js($start_from) : 'null' ?>,
							dataHeight = $slider.data('height');
						if($window.width() > 1022) {
							$slider.css('height', dataHeight).sly({
								//slidee:     null,  // Selector, DOM element, or jQuery object with DOM element representing SLIDEE.
								horizontal: true, // Switch to horizontal mode.

								// Item based navigation
								itemNav:        '<?php echo esc_js($display_mode) ?>',  // Item navigation type. Can be: 'basic', 'centered', 'forceCentered'.
								//itemSelector:   null,  // Select only items that match this selector.
								smart:          true, // Repositions the activated item to help with further navigation.
								activateOn:     '<?php echo esc_js($navigation_event) ?>',  // Activate an item on this event. Can be: 'click', 'mouseenter', ...
								activateMiddle: true, // Always activate the item in the middle of the FRAME. forceCentered only.

								// Scrolling
								<?php if($scroll_source != ''): ?>
								scrollSource: $container.find('.scrollbar'),  // Element for catching the mouse wheel scrolling. Default is FRAME.
								<?php endif; ?>
								scrollBy:     1,     // Pixels or items to move per one mouse scroll. 0 to disable scrolling.
								scrollHijack: 300,   // Milliseconds since last wheel event after which it is acceptable to hijack global scroll.
								scrollTrap:   false, // Don't bubble scrolling when hitting scrolling limits.

								// Dragging
								//dragSource:    null,  // Selector or DOM element for catching dragging events. Default is FRAME.
								mouseDragging: true, // Enable navigation by dragging the SLIDEE with mouse cursor.
								touchDragging: true, // Enable navigation by dragging the SLIDEE with touch events.
								releaseSwing:  true, // Ease out on dragging swing release.
								swingSpeed:    0.2,   // Swing synchronization speed, where: 1 = instant, 0 = infinite.
								elasticBounds: true, // Stretch SLIDEE position limits when dragging past FRAME boundaries.
								//interactive:   null,  // Selector for special interactive elements.

								// Scrollbar
								<?php if($enable_dragg_line): ?>
								scrollBar:     $container.find('.scrollbar'),  // Selector or DOM element for scrollbar container.
								dragHandle:    true, // Whether the scrollbar handle should be draggable.
								dynamicHandle: true, // Scrollbar handle represents the ratio between hidden and visible content.
								minHandleSize: 50,    // Minimal height or width (depends on sly direction) of a handle in pixels.
								clickBar:      true, // Enable navigation by clicking on scrollbar.
								syncSpeed:     0.5,   // Handle => SLIDEE synchronization speed, where: 1 = instant, 0 = infinite.
								<?php endif; ?>

								<?php /* ?>
								// Pagesbar
								pagesBar:       null, // Selector or DOM element for pages bar container.
								activatePageOn: null, // Event used to activate page. Can be: click, mouseenter, ...
								pageBuilder:          // Page item generator.
									function (index) {
										return '<li>' + (index + 1) + '</li>';
									},
								<?php */ ?>

								<?php if($enable_prev_next): ?>
								// Navigation buttons
								//forward:  null, // Selector or DOM element for "forward movement" button.
								//backward: null, // Selector or DOM element for "backward movement" button.
								prev:     $container.find('.sly-prev'), // Selector or DOM element for "previous item" button.
								next:     $container.find('.sly-next'), // Selector or DOM element for "next item" button.
								//prevPage: null, // Selector or DOM element for "previous page" button.
								//nextPage: null, // Selector or DOM element for "next page" button.
								<?php endif; ?>

								<?php /*
								// Automated cycling
								cycleBy:       null,  // Enable automatic cycling by 'items' or 'pages'.
								cycleInterval: 5000,  // Delay between cycles in milliseconds.
								pauseOnHover:  false, // Pause cycling when mouse hovers over the FRAME.
								startPaused:   false, // Whether to start in paused sate.
								*/ ?>

								// Mixed options
								moveBy:        300,     // Speed in pixels per second used by forward and backward buttons.
								speed:         <?php echo esc_js($animation_speed) ?>,       // Animations speed in milliseconds. 0 to disable animations.
								easing:        'swing', // Easing for duration based (tweening) animations.
								startAt:       startFrom,    // Starting offset in pixels or items.
								keyboardNavBy: 'items',    // Enable keyboard navigation by 'items' or 'pages'.

								// Classes
								draggedClass:  'dragged', // Class for dragged elements (like SLIDEE or scrollbar handle).
								activeClass:   'active',  // Class for active items and pages.
								disabledClass: 'disabled', // Class for disabled navigation elements.
							});
						}
					});
				})(jQuery);
			</script>
			<?php
			$output .= ob_get_clean();
			$output .= '</div>';
			
			return $output;
		}
		function dfd_horizontal_scroll_container($atts,$content = null) {
			$item_width = $content_align = $el_class = $content_bg_check = $css = '';
			extract(shortcode_atts(array(
				'item_width' => '600',
				'content_align' => '',
				'content_bg_check' => '',
				'el_class' => '',
				'css' => '',
			), $atts));
			$output = $item_css = '';
			
			$items_padding = $this->items_offset;
			
			$image_height = $this->container_height;
			
			$item_css .= 'width: '.esc_attr($item_width).'px;';
			if(!empty($image_height)) {
				$item_css .= 'height: '.esc_attr($image_height).'px;';
			}
			if(!empty($items_padding)) {
				$item_css .= 'padding: 0 '.esc_attr($items_padding).'px;';
			}
			
			if($content_bg_check != '') {
				$el_class .= ' '.($content_bg_check);
			}
						
			$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . vc_shortcode_custom_css_class( $css, ' ' ), 'dfd_horizontal_scroll_container', $atts );
			
			$output .= '<li>';
			$output .= '<div class="cover" style="'.$item_css.'">';
			$output .= '<div class="'.esc_attr($css_class).'">';
			$output .= '<div class="'.esc_attr($content_align).'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</li>';
			
			return $output;
		}
		function dfd_horizontal_scroll_item($atts,$content = null) {
			$content_type = $single_custom_portfolio_item = $portfolio_hover_style = $image_width = $el_class = $image = '';
			extract(shortcode_atts(array(
				'content_type' => 'image',
				'single_custom_portfolio_item' => '',
				'portfolio_hover_style' => '',
				'enable_panr' => '',
				'image' => '',
				'image_width' => '',
				'el_class' => '',
			), $atts));
			$output = $item_html = '';
			
			if(empty($image_width)) {
				$image_width = 600;
			}
			
			$image_height = $this->container_height;
			
			$items_padding = $this->items_offset;
						
			if(empty($portfolio_hover_style)) {
				$portfolio_hover_style = 'portfolio-hover-style-1';
			}
			
			if($enable_panr) {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
				$portfolio_hover_style .= ' panr';
			}
			
			if(strcmp($content_type, 'image') === 0 && $image != '') {
				$image_src = wp_get_attachment_image_src($image,'full');
				$image_meta = wp_get_attachment_metadata($image);

				if(isset($image_meta['image_meta']['caption']) && $image_meta['image_meta']['caption'] != '') {
					$caption = $image_meta['image_meta']['caption'];
				} else if(isset($image_meta['image_meta']['title']) && $image_meta['image_meta']['title'] != '') {
					$caption = $image_meta['image_meta']['title'];
				} else {
					$caption = 'team image';
				}
				$img = dfd_aq_resize($image_src[0], $image_width, $image_height, true, true, true);
				if(!$img) {
					$img = $image_src[0];
				}
				$item_html .= '<img src="'.esc_url($img).'" alt="'.esc_attr($caption).'"/>';
			} elseif(strcmp($content_type, 'portfolio') === 0 && $single_custom_portfolio_item != '') {
				$args = array(
					'post_type' => 'my-product',
					'p' => $single_custom_portfolio_item,
				);
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()) : $the_query->the_post();
					if (has_post_thumbnail()) {
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
						$article_image = dfd_aq_resize($img_url, $image_width, $image_height, true, true, true);
						if(!$article_image) {
							$article_image = $img_url;
						}
					} else {
						$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
					}
					ob_start();
					echo '<div class="project '. esc_attr($portfolio_hover_style) .'">';
						echo '<div class="work-cover">';
							echo '<div class="entry-thumb">';
								echo '<img src="'. esc_url($article_image) .'" alt="'. get_the_title() .'"/>';
								get_template_part('templates/portfolio/entry-hover');
							echo '</div>';
						echo '</div>';
					echo '</div>';
					$item_html .= ob_get_clean();
				endwhile; wp_reset_postdata();
			}
			
			$output .= '<li>';
			$output .= '<div class="cover" style="padding: 0 '.esc_attr($items_padding).'px;">';
			$output .= $item_html;
			$output .= '</div>';
			$output .= '</li>';
			
			return $output;
		}

		function add_dfd_horizontal_scroll() {
			if(function_exists('vc_map')) {
				new dfd_hide_unsuport_module_frontend("horizont_scroll_gal");
				vc_map(
				array(
				   'name' => __('Horizontal scroll gallery','dfd'),
				   'base' => 'dfd_horizontal_scroll',
				   'class' => 'vc_info_list horizont_scroll_gal',
				   'icon' => 'vc_icon_list',
				   'category' => __('Ronneby 2.0','dfd'),
				   'as_parent' => array('only' => 'dfd_horizontal_scroll_item, dfd_horizontal_scroll_container'),
				   'description' => __('For horizontal gallery.','dfd'),
				   'content_element' => true,
				   'show_settings_on_create' => true,
				   'params' => array(
						array(
							'type' => 'checkbox',
							'class' => '',
							'heading' => __('Enable prev/next navigation arrows', 'dfd'),
							'param_name' => 'enable_prev_next',
							'value' => array(__('Yes, please', 'js_composer') => 'yes'),
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Arrows Color', 'dfd'),
							'param_name' => 'arrows_color',
							'value' => '',
							'description' => __('', 'dfd'),
							'dependency' => array(
								'element' => 'enable_prev_next',
								'not_empty' => true,
							),
						),
						array(
							'type' => 'checkbox',
							'class' => '',
							'heading' => __('Enable draggable navigation line', 'dfd'),
							'param_name' => 'enable_dragg_line',
							'value' => array(__('Yes, please', 'js_composer') => 'yes'),
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Container height', 'dfd'),
							'param_name' => 'container_height',
							'value' => 550,
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Items offset', 'dfd'),
							'param_name' => 'items_offset',
							'value' => '',
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Start from', 'dfd'),
							'param_name' => 'start_from',
							'value' => '',
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Enable navigation event', 'dfd'),
							'param_name' => 'navigation_event',
							'value' => array(
								__('Click', 'dfd') => 'click',
								__('Hover', 'dfd') => 'hover',
							),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Module mode', 'dfd'),
							'param_name' => 'display_mode',
							'value' => array(
								__('Basic', 'dfd') => 'basic',
								__('Centered', 'dfd') => 'forceCentered',
							),
						),
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => __('Navbar Color', 'dfd'),
							'param_name' => 'navbar_color',
							'value' => '',
							'description' => __('', 'dfd'),
							'dependency' => array(
								'element' => 'enable_prev_next',
								'not_empty' => true,
							),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => __('Apply scrolling animation on', 'dfd'),
							'param_name' => 'scroll_source',
							'value' => array(
								__('Module', 'dfd') => '',
								__('Scrollbar', 'dfd') => 'scrollbar',
							),
							'dependency' => array(
								'element' => 'enable_dragg_line',
								'not_empty' => true,
							),
						),
						array(
							'type' => 'number',
							'class' => '',
							'heading' => __('Animation speed', 'dfd'),
							'param_name' => 'animation_speed',
							'value' => 300,
						),
						array(
							'type' => 'textfield',
							'heading' => __('Extra class name', 'js_composer'),
							'param_name' => 'el_class',
							'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
						),
						array(
							   'type'        => 'dropdown',
							   'class'       => '',
							   'heading'     => __( 'Animation', 'dfd' ),
							   'param_name'  => 'module_animation',
							   'value'       => dfd_module_animation_styles(),
							   'description' => __( '', 'dfd' ),
							   'group'       => 'Animation Settings',
							),
					),
					'js_view' => 'VcColumnView'
				));
				vc_map(
					array(
						'name' =>  __( 'Horizontal scroll shortcode item container', 'dfd' ),
						'base' => 'dfd_horizontal_scroll_container',
						'as_parent' => array('except' => 'dfd_horizontal_scroll_container, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_tta_section, rev_slider_vc, ultimate_icon_list_item, dfd_horizontal_scroll_item, dfd_horizontal_scroll, dfd_service_item, dfd_masonry_container, dfd_masonry_item, dfd_side_by_side_slider, dfd_side_by_side_left, dfd_side_by_side_right, dfd_side_by_side_slide, vc_accordion, vc_tabs, vc_tour, dfd_scrolling_content, dfd_scrolling_content2 , dfd_equal_height_content, dfd_scrolling_effect'),
						'as_child' => array('only' => 'dfd_horizontal_scroll'),
						'content_element' => true,
						'category' => 'DFD VC Addons',
						'icon' => 'ultimate_carousel',
						'show_settings_on_create' => false,
						'js_view' => 'VcColumnView',
						'params' => array(
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Item width', 'dfd'),
								'param_name' => 'item_width',
								'value' => 600,
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Content alignment', 'dfd'),
								'param_name' => 'content_align',
								'value' => array(
									__('Top', 'dfd') => '',
									__('Middle', 'dfd') => 'dfd-vertical-aligned',
								),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Background Style', 'dfd'),
								'param_name' => 'content_bg_check',
								'value' => array(
									__('Light background', 'dfd') => '',
									__('Dark background', 'dfd') => 'dfd-background-dark'
								),
								'description' => __('Please specify background style for correct shortcodes appearance.', 'dfd'),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
							array(
								'type' => 'css_editor',
								'edit_field_class' => 'dfd_side_by_side_item_custom_class',
								'heading' => __( 'CSS box', 'js_composer' ),
								'param_name' => 'css',
								// 'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
								'group' => __( 'Design Options', 'js_composer' )
							),
						)
					)
				);
				vc_map(
					array(
					   'name' => __('Horizontal scroll Item', 'dfd'),
					   'base' => 'dfd_horizontal_scroll_item',
					   'class' => 'vc_info_list',
					   'icon' => 'vc_icon_list',
					   'category' => __('DFD VC Addons','dfd'),
					   'content_element' => true,
					   'as_child' => array('only' => 'dfd_horizontal_scroll'),
					   'params' => array(
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Content type', 'dfd'),
								'param_name' => 'content_type',
								'value' => array(
									__('Simple image', 'dfd') => 'image',
									__('Portfolio item', 'dfd') => 'portfolio',
								),
							),
							array(
								'type' => 'radio_image_post_select',
								'heading' => __('Portfolio item to display','dfd'),
								'param_name' => 'single_custom_portfolio_item',
								'value' => '',
								'post_type' => 'my-product',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => __('Select portfolio item to display', 'dfd'),
								'dependency' => array('element' => 'content_type','value' => array('portfolio')),
							),
							array(
								'type' => 'dropdown',
								'heading' => __('Portfolio hover style','dfd'),
								'param_name' => 'portfolio_hover_style',
								'value' => dfd_portfolio_hover_variants(),
								'description' => __('Default is Style 1', 'dfd'),
								'dependency' => array('element' => 'content_type','value' => array('portfolio')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable easy image parallax effect on hover','dfd'),
								'param_name' => 'enable_panr',
								'value' => array('Enable easy parallax' => 'yes'),
								'dependency' => array('element' => 'portfolio_hover_style','value' => array(
									'portfolio-hover-style-2',
									'portfolio-hover-style-3',
									'portfolio-hover-style-4',
									'portfolio-hover-style-5',
									'portfolio-hover-style-6',
									'portfolio-hover-style-7',
									'portfolio-hover-style-8',
									'portfolio-hover-style-9',
									'portfolio-hover-style-10',
									'portfolio-hover-style-11',
									'portfolio-hover-style-13',
									'portfolio-hover-style-14',
									'portfolio-hover-style-15',
									'portfolio-hover-style-16',
									'portfolio-hover-style-17',
									'portfolio-hover-style-18',
									'portfolio-hover-style-19',
									'portfolio-hover-style-20',
									'portfolio-hover-style-21',
									'portfolio-hover-style-22',
								)),
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Image','dfd'),
								'param_name' => 'image',
								'value' => '',
								'description' => __('Upload the image','dfd'),
								'dependency' => Array('element' => 'content_type','value' => array('image')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Image width', 'dfd'),
								'param_name' => 'image_width',
								'value' => 600,
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
						)
					) 
				);
			}//endif
		}
	}
}
global $Dfd_Horizontal_Scroll;
if(class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_dfd_horizontal_scroll extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_dfd_horizontal_scroll_container extends WPBakeryShortCodesContainer {}
}
if(class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_dfd_horizontal_scroll_item extends WPBakeryShortCode {}
}
if(class_exists('Dfd_Horizontal_Scroll')) {
	$Dfd_Horizontal_Scroll = new Dfd_Horizontal_Scroll;
}