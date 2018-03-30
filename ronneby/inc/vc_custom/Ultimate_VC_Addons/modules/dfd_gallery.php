<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Gallery module
*/
if(!class_exists('DFd_Gallery_module')) {
	class DFd_Gallery_module {
		function __construct(){
			add_action('init',array($this,'gallery_module_init'));
			add_shortcode('dfd_gallery_module',array($this,'gallery_module_shortcode'));
		}
		function gallery_module_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Gallery','dfd'),
						'base' => 'dfd_gallery_module',
						'class' => 'vc_interactive_icon',
						'icon' => 'vc_icon_interactive',
						'category' => __('Ronneby 1.0','dfd'),
						//'deprecated' => '4.6',
						'description' => __('Displays agllery items elements','dfd'),
						'params' => array(
							array(
								'type' => 'dropdown',
								'heading' => __('Gallery style','dfd'),
								'param_name' => 'gallery_style_class',
								'value' => array(
										__('Gallery isotop', 'dfd') => 'gallery_isotop',
										__('Gallery slider', 'dfd') => 'gallery_slider',
										__('Gallery wide', 'dfd') => 'gallery_wide',
										__('Custom gallery items', 'dfd') => 'gallery_single_item',
									),
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
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider', 'gallery_isotop')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Categories','dfd'),
								'param_name' => 'works_categories',
								'value' => dfd_get_select_options_multi('gallery_category'),
								//"description" => __("If the description text is not suiting well on specific screen sizes, you may enable this option - which will hide the description text.",'dfd'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_isotop', 'gallery_slider','gallery_wide')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of works to display', 'dfd'),
								'param_name' => 'works_to_show',
								'value' => 5,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider', 'gallery_wide', 'gallery_slider', 'gallery_isotop')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of slides to display', 'dfd'),
								'param_name' => 'slides_to_show',
								'value' => 4,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Number of slides to scroll', 'dfd'),
								'param_name' => 'slides_to_scroll',
								'value' => 1,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Slideshow speed', 'dfd'),
								'param_name' => 'slideshow_speed',
								'value' => 3000,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable autoslideshow','dfd'),
								'param_name' => 'auto_slideshow',
								'value' => array('Enable autoslideshow' => 'yes'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable pagination','dfd'),
								'param_name' => 'enable_dots',
								'value' => array('Enable pagination' => 'yes'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_slider')),
							),
							/*array(
								'type' => 'dropdown',
								'heading' => __('Gallery hover style','dfd'),
								'param_name' => 'gallery_hover_style',
								'value' => dfd_gallery_hover_variants(),
								'description' => __('Default is Style 1', 'dfd'),
								//'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_isotop','gallery_slider','gallery_single_item')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable easy image parallax effect on hover','dfd'),
								'param_name' => 'enable_panr',
								'value' => array('Enable easy parallax' => 'yes'),
								'dependency' => array('element' => 'gallery_hover_style','value' => array(
									'gallery-hover-style-2',
									'gallery-hover-style-3',
									'gallery-hover-style-4',
									'gallery-hover-style-5',
									'gallery-hover-style-6',
									'gallery-hover-style-7',
									'gallery-hover-style-8',
									'gallery-hover-style-9',
									'gallery-hover-style-10',
									'gallery-hover-style-11',
									'gallery-hover-style-13',
									'gallery-hover-style-14',
									'gallery-hover-style-15',
									'gallery-hover-style-16',
									'gallery-hover-style-17',
									'gallery-hover-style-18',
									'gallery-hover-style-19',
									'gallery-hover-style-20',
									'gallery-hover-style-21',
									'gallery-hover-style-22',
								)),
							),*/
							array(
								'type' => 'radio_image_post_select',
								'heading' => __('Gallery item to display','dfd'),
								'param_name' => 'single_custom_gallery_item',
								'value' => '',
								'post_type' => 'gallery',
								'css' => array(
									'width' => '120px',
									'height' => '120px',
									'background-repeat' => 'repeat',
									'background-size' => 'cover' 
								),
								'show_default' => false,
								'description' => __('Select gallery item to display', 'dfd'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_single_item')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Gallery item width', 'dfd'),
								'param_name' => 'gallery_item_width',
								'value' => 600,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_single_item', 'gallery_slider')),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Gallery item height', 'dfd'),
								'param_name' => 'gallery_item_height',
								'value' => 550,
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_single_item', 'gallery_slider')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable zoom effect for this work','dfd'),
								'param_name' => 'enable_zoom_effect',
								'value' => array('Yes, please' => 'yes'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_single_item')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Layout mode','dfd'),
								'param_name' => 'masonry_layout_mode',
								'value' => array(
									__('Masonry','dfd') => 'masonry',
									__('Grid','dfd') => 'fitRows'
								),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_isotop')),
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Enable sort panel','dfd'),
								'param_name' => 'enable_sort_panel',
								'value' => array('Enable sort panel' => 'yes'),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_isotop')),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Sort panel alignment','dfd'),
								'param_name' => 'sort_panel_alignment',
								"value" => array(
									__('Center','dfd') => "text-center",
									__('Left','dfd') => "text-left",
									__('Right','dfd') => "text-right"
								),
								'dependency' => array('element' => 'gallery_style_class','value' => array('gallery_isotop')),
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
					)
				);
			}
		}
		// Shortcode handler function for stats banner
		function gallery_module_shortcode($atts) {
			$output = $sort_panel_html = $gallery_style_class = $works_num = $enable_zoom_effect = $single_gallery_item_class = $el_class = $sort_panel_alignment = $title_color = $title_css = $module_animation = $masonry_layout_mode = $enable_panr = '';
			extract(shortcode_atts( array(
				'works_to_show' => '',
				'columns_offsets' => '',
				'works_categories' => '',
				'gallery_style_class' => '',
				'gallery_hover_style' => '',
				'masonry_layout_mode' => '',
				'enable_sort_panel' => '',
				'sort_panel_alignment' => 'text-center',
				'title_color' => '',
				'enable_zoom_effect' => '',
				'single_custom_gallery_item' => '',
				'slides_to_show' => '',
				'slides_to_scroll' => '',
				'slideshow_speed' => '',
				'auto_slideshow' => '',
				'enable_dots' => '',
				'gallery_item_width' => '',
				'gallery_item_height' => '',
				'enable_panr' => '',
				'module_animation' => '',
				'el_class' => ''
			),$atts));
			
			if(empty($works_to_show)) {
				$works_to_show = -1;
			}
			
			if(!empty($title_color)) {
				$title_css .= 'style="color: '.esc_attr($title_color).';"';
			}
						
			if(empty($gallery_hover_style)) {
				$gallery_hover_style = 'gallery-hover-style-1';
			}
			
			if($enable_panr) {
				wp_enqueue_script('dfd-tween-max');
				wp_enqueue_script('dfd-panr');
				$gallery_hover_style .= ' panr';
			}
			
			if(empty($gallery_style_class)) {
				$gallery_style_class = 'gallery_isotop';
			}
			
			if(empty($enable_sort_panel)) {
				$enable_sort_panel = false;
			}
			
			if(empty($masonry_layout_mode)) {
				$masonry_layout_mode = 'masonry';
			}
			/*
			if($enable_zoom_effect) {
				$single_gallery_item_class .= ' folio-zoom-effect';
			}
			*/
			if(empty($single_custom_gallery_item)) {
				$single_custom_gallery_item = false;
			}
			
			if(empty($slides_to_show)) {
				$slides_to_show = 4;
			}
			
			if(empty($slides_to_scroll)) {
				$slides_to_scroll = 1;
			}
			
			if(empty($slideshow_speed)) {
				$slideshow_speed = 3000;
			}
			
			if(empty($auto_slideshow)) {
				$auto_slideshow = 'false';
			} else {
				$auto_slideshow = 'true';
			}
			
			if(empty($enable_dots)) {
				$enable_dots = 'false';
			} else {
				$enable_dots = 'true';
			}
			
			if(empty($gallery_item_width)) {
				$gallery_item_width = 600;
			}
			
			if(empty($gallery_item_height)) {
				$gallery_item_height = 550;
			}
			
			switch($gallery_style_class) {
				case 'gallery_single_item':
					$works_num = -1;
					break;
				case 'gallery_isotop':
				case 'gallery_slider':
				case 'gallery_wide':
				default:
					$works_num = $works_to_show;
					break;
			}
			
			if(strcmp($gallery_style_class, 'gallery_wide') === 0) {
				$gallery_item_width = 1920;
				$gallery_item_height = 190;
			}
			
			if(!empty($columns_offsets) && (strcmp($gallery_style_class, 'gallery_isotop') === 0 || strcmp($gallery_style_class, 'gallery_slider') === 0)) {
				$el_class .= ' '.$columns_offsets;
			}
			
			$module_id = uniqid('dfd-gallery-');
			
			ob_start();
			echo '<div class="dfd-gallery-module-wrapper">';
			echo '<div id="'.$module_id.'" class="dfd-gallery-module '. esc_attr($gallery_style_class) .' '.esc_attr($el_class).'">';
				if (!isset($works_categories) || empty($works_categories)) {
					$args = array(
						'post_type' => 'gallery',
						'posts_per_page' => $works_num,
					);
				} else {
					$args = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'gallery_category',
								'field' => 'slug',
								'terms' => explode(',',$works_categories),
							)
						),
						'post_type' => 'gallery',
						'posts_per_page' => $works_num,
					);
				}

				$taxonomy = 'gallery_category';

				$categories_arr = get_terms($taxonomy);

				if(!empty($categories_arr) && is_array($categories_arr) && !is_wp_error($categories_arr)) {
					$sort_panel_html .= '<div class="sort-panel '.esc_attr($sort_panel_alignment).'">';
						$sort_panel_html .= '<ul class="filter">';
							$sort_panel_html .= '<li class="active"><a data-filter=".dfd-gallery-item" href="#">'. __('All', 'dfd') .'</a></li>';
							foreach ($categories_arr as $category) {
								$sort_panel_html .= '<li><a data-filter=".dfd-gallery-item[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
							}
						$sort_panel_html .= '</ul>';
					$sort_panel_html .= '</div>';
				}

				if(strcmp($gallery_style_class, 'gallery_isotop') === 0 && $enable_sort_panel) {
					echo $sort_panel_html;
				}

				$animate = $animation_data = '';

				if ( ! ($module_animation == '')){
					$animate = ' cr-animate-gen';
					$animation_data = 'data-animate-item = ".dfd-gallery-item" data-animate-type = "'.esc_attr($module_animation).'" ';
				}

				$the_query = new WP_Query($args);

				echo '<div class="dfd-gallery-list '.esc_attr($animate).'" '.$animation_data.'>';

					while ($the_query->have_posts()) : $the_query->the_post();

						if (has_post_thumbnail()) {
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
							$article_image = dfd_aq_resize($img_url, $gallery_item_width, $gallery_item_height, true, true, true);
							if((strcmp($gallery_style_class, 'gallery_isotop') === 0 && strcmp($masonry_layout_mode, 'masonry') === 0) || !$article_image) {
								$article_image = $img_url;
							}
						} else {
							$article_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
						}

						$_gallery_id = get_the_ID();

						$terms = get_the_terms($_gallery_id, 'gallery_category');

						$data_categories  = '';

						if(!empty($terms) && is_array($terms) && !is_wp_error($terms)) {
							foreach ($terms as $term) {
								$data_categories .= ' '.strtolower(preg_replace('/\s+/', '-', $term->slug));
								$term_url =  get_term_link($term->slug, 'gallery_category');
							}
						}
						
						if($_gallery_id != $single_custom_gallery_item && strcmp($gallery_style_class, 'gallery_single_item') === 0) {
							continue;
						} else {
							echo '<div class="dfd-gallery-item '. esc_attr($gallery_hover_style.$single_gallery_item_class) .'" data-category="'. esc_attr($data_categories) .'">';
								echo '<div class="dfd-gallery-item-cover">';
									echo '<a href="'.esc_url($img_url).'" data-rel="prettyPhoto[gallery-'.esc_attr($module_id).']">';
										echo '<img src="'. esc_url($article_image) .'" alt="'. get_the_title() .'"/>';
									echo '</a>';
								echo '</div>';
							echo '</div>';
						}

					endwhile; wp_reset_postdata();

				echo '</div>';
				if(strcmp($gallery_style_class, 'gallery_isotop') === 0) {
					echo '<div class="dfd-gallery-list-hidden"></div>';
				}
			echo '</div>';
			
			if(strcmp($gallery_style_class, 'gallery_isotop') === 0) {
				wp_enqueue_script('isotope');
				wp_enqueue_script('dfd-gallery-module-isotope');
				
				echo '<script type="text/javascript">';
					echo 'jQuery(document).ready(function () {';
						echo 'jQuery("#'. esc_js($module_id) .'").dfdIsotopeGalleryModule("'.esc_js($masonry_layout_mode).'");';
					echo '});';
				echo '</script>';
			}
			
			if(strcmp($gallery_style_class, 'gallery_slider') === 0) {
				
				$breakpoint_first = ($slides_to_show > 3) ? 3 : $slides_to_show;
				
				$breakpoint_second = ($slides_to_show > 2) ? 2 : $slides_to_show;
				
				echo '<script type="text/javascript">';
					echo '(function($){';
						echo '"use strict";';
						echo '$(document).ready(function(){';
							echo '$("#'. esc_js($module_id) .' .dfd-gallery-list").slick({';
								echo 'infinite: true,';
								echo 'slidesToShow: '. esc_js($slides_to_show).',';
								echo 'slidesToScroll: '. esc_js($slides_to_scroll) .',';
								echo 'arrows: false,';
								echo 'dots: '. esc_js($enable_dots) .',';
								echo 'autoplay: '. esc_js($auto_slideshow) .',';
								echo 'autoplaySpeed: '. esc_js($slideshow_speed) .',';
								echo 'responsive: [';
									echo '{';
										echo 'breakpoint: 1280,';
										echo 'settings: {';
											echo 'slidesToShow: '. esc_js($breakpoint_first) .',';
											echo 'infinite: true,';
											echo 'arrows: false';
										echo '}';
									echo '},';
									echo '{';
										echo 'breakpoint: 1024,';
										echo 'settings: {';
											echo 'slidesToShow: '. esc_js($breakpoint_second) .',';
											echo 'infinite: true,';
											echo 'arrows: false,';
										echo '}';
									echo '},';
									echo '{';
										echo 'breakpoint: 480,';
										echo 'settings: {';
											echo 'slidesToShow: 1,';
											echo 'slidesToScroll: 1,';
											echo 'arrows: false,';
										echo '}';
									echo '}';
								echo '],';
							echo '});';
						echo '});';
						echo '$("#'. esc_js($module_id) .'").find(".next").click(function(e) {';
							echo '$("#'. esc_js($module_id) .'").slickNext();';

							echo 'e.preventDefault();';
						echo '});';

						echo '$("#'. esc_js($module_id) .'").find(".prev").click(function(e) {';
							echo '$("#'. esc_js($module_id) .'").slickPrev();';

							echo 'e.preventDefault();';
						echo '});';
						echo '$("#'. esc_js($module_id) .' .item").on("mousedown select",(function(e){';
							echo 'e.preventDefault();';
						echo '}));';
					echo '})(jQuery);';
				echo '</script>';
			}
			
			echo '</div>';
			
			$output .= ob_get_clean();

			return $output;
		}
	}
}
if(class_exists('DFd_Gallery_module')) {
	$DFd_Gallery_module = new DFd_Gallery_module;
}