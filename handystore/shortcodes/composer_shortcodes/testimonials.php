<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :


add_action( 'vc_before_init', 'handy_testimonials' );

function handy_testimonials(){

	vc_map( array(
      "name" => esc_html__( 'Testimonials', 'plumtree' ),
      "base" => "handy_testimonials",
		  "description" => esc_html__( 'Output carousel with Testimonials', 'plumtree' ),
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
			'icon' => get_template_directory_uri() . '/images/vc-icon.png',

      "params" => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title text', 'plumtree' ),
				'param_name' => 'el_title',
				'value' => __('Title goes here', 'plumtree'),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Testimonials Style', 'plumtree' ),
				'param_name' => 'testimonials_style',
				'value' => array(
						'Style 1' => 'style_1',
						'Style 2' => 'style_2',
						'Style 3' => 'style_3',
				),
				'std'=> 'fade',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Transition Type', 'plumtree' ),
				'param_name' => 'transition_type',
				'value' => array(
						'Fade' => 'fade',
						'Back Slide' => 'backSlide',
						'Go Down' => 'goDown',
						'Fade Up' => 'fadeUp',
					),
				'std'=> 'fade',
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Autoplay', 'plumtree' ),
				'param_name' => 'autoplay',
				'description' => esc_html__( 'Whether to running your carousel automatically or not', 'plumtree' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Show Arrows', 'plumtree' ),
				'param_name' => 'show_arrows',
				'description' => esc_html__( 'Show/hide arrow buttons', 'plumtree' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Show Page Navigation', 'plumtree' ),
				'param_name' => 'page_navi',
				'description' => esc_html__( 'Show/hide navigation buttons under your carousel', 'plumtree' ),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Testimonials Items', 'plumtree' ),
				'param_name' => 'testimonials_items',
				'value' => urlencode( json_encode( array(
					array(
						'name' => esc_html__( 'Name', 'plumtree' ),
						'occupation' => esc_html__( 'Occupation', 'plumtree' ),
						'content_text' => esc_html__( 'Text', 'plumtree' ),
					),
					array(
						'name' => esc_html__( 'Name', 'plumtree' ),
						'occupation' => esc_html__( 'Occupation', 'plumtree' ),
						'content_text' => esc_html__( 'Text', 'plumtree' ),
					),
				) ) ),
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( ' Image', 'plumtree' ),
						'param_name' => 'image',
						'description' => esc_html__( 'Add Image', 'plumtree' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image size', 'plumtree' ),
						'param_name' => 'img_size',
						'value' => array(
							'Thumbnail' => 'thumbnail',
							'Medium' => 'medium',
							'Large' => 'large',
							'Full' => 'full',
							),
						'std'=> 'full',
						'description' => esc_html__( "Enter image size. You can change these images' dimensions in wordpress media settings.", 'plumtree' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Name', 'plumtree' ),
						'param_name' => 'name',
						'description' => esc_html__( 'Enter Name', 'plumtree' ),

					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Occupation', 'plumtree' ),
						'param_name' => 'occupation',
						'description' => esc_html__( 'Enter Occupation', 'plumtree' ),

					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Content Text', 'plumtree' ),
						'param_name' => 'content_text',
						'description' => esc_html__( 'Set content of element', 'plumtree' ),

					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Add star rating to testimonial', 'plumtree' ),
						'param_name' => 'rating_value',
						'value' => array(
								'5 Stars' => '5',
								'4 Stars' => '4',
								'3 Stars' => '3',
								'2 Stars' => '2',
								'1 Star' => '1',
						),
						'std'=> '5',
						'dependency' => array(
							'element' => 'testimonials_style',
							'value' => array( 'style_2' ),
						),
					),
			),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'plumtree' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'plumtree' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'plumtree' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'plumtree' ),
		),
      )
   ) );

}

class WPBakeryShortCode_handy_testimonials extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_title' => 'Title Here',
			'transition_type' => 'fade',
			'autoplay' => 'false',
			'show_arrows' => '',
			'page_navi' => 'false',
			'testimonials_items'=> '',
			'css' => '',
			'el_class'=> '',
			'testimonials_style' => 'style_1'
		), $atts ) );

		$output = '';
		$carousel_content = '';
		$testimonials_items_content = vc_param_group_parse_atts($testimonials_items);
		$container_id = uniqid('owl',false);
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'pt-testimonials wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		if ( $testimonials_items_content ) {
      foreach ( $testimonials_items_content as $item ) {
				$carousel_content .= '<div class="carousel-item">';
				$carousel_content .= '<div class="item-wrapper">';
				if(array_key_exists('image', $item )){
					$image_attributes = wp_get_attachment_image_src( $item['image'], $item['img_size']);
					$img_alt = get_post_meta($item['image'], '_wp_attachment_image_alt', true);
					$carousel_content .= '<div class="img-wrapper"><img alt="' . esc_attr($img_alt) . '" src="' . esc_url($image_attributes[0]) . '" width="' . esc_attr($image_attributes[1]) . '" height="' . esc_attr($image_attributes[2]) . '" /></div>';
				}
				$carousel_content .= '<div class="text-wrapper">';
				if(array_key_exists('name', $item )){
					$carousel_content .='<h3>'.$item['name'].'</h3>';
				}
				if(array_key_exists('occupation', $item )){
					$carousel_content .='<span class="occupation">'.$item['occupation'].'</span>';
				}
				if ( $testimonials_style == 'style_2' ) {
					$width = absint($item['rating_value']*2);
					$carousel_content .= '<div class="star-rating"><span style="width:'.$width.'0%"></span></div>';
				}
				if(array_key_exists('content_text', $item )){
					$carousel_content .= '<p><q>'.$item['content_text'].'</q></p>';
				}
				$carousel_content .= '</div>';

				$carousel_content .= '</div>';
				$carousel_content .= '</div>';
      }
		}

		$output .= '<div class="'.$css_class.'" id="'.$container_id.'">';
		$output .= "<div class='title-wrapper'><h3>{$el_title}</h3>";
		if ( $show_arrows ) { $output .= "<span class='prev'></span><span class='next'></span>"; }
		$output .= "</div><div class='carousel-container {$testimonials_style}'>";
		$output .= $carousel_content;
		$output .= "</div></div>";

		$output.='<script type="text/javascript">
					(function($) {
						$(document).ready(function() {
							var owl = $("#'.$container_id.' .carousel-container");

							owl.owlCarousel({
								navigation : false,
								pagination : '.$page_navi.',
								autoPlay   : '.$autoplay.',
								slideSpeed : 300,
								paginationSpeed : 400,
								singleItem : true,
								transitionStyle : "'.$transition_type.'",
							});

							// Custom Navigation Events
							$("#'.$container_id.'").find(".next").click(function(){
								owl.trigger("owl.next");
							})
							$("#'.$container_id.'").find(".prev").click(function(){
								owl.trigger("owl.prev");
							})
						});
					})(jQuery);
				</script>';

		return $output;
	}

}

endif;
