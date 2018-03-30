<?php
if ( class_exists( 'WPBakeryShortCode' ) ) :

add_action( 'vc_before_init', 'handy_banner' );

function handy_banner() {
	 vc_map( array(
			'name' => esc_html__( 'Banner', 'plumtree' ),
			'base' => 'handy_banner',
			'description' => esc_html__( 'Creates unique banner with cool hover effect', 'plumtree' ),
			'category' => esc_html__( 'Handy Shortcodes', 'plumtree'),
			'icon' => get_template_directory_uri() . '/images/vc-icon.png',
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Banner Image', 'plumtree' ),
					'param_name' => 'banner_img',
					'description' => esc_html__( 'Select image from media library.', 'plumtree' ),
				),
				array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Image size', 'plumtree' ),
				'param_name' => 'banner_img_size',
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
					'type' => 'textarea_raw_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Banner main caption', 'plumtree' ),
					'param_name' => 'main_caption',
					'value' => base64_encode( '<p>I am raw html block.<br/>Click edit button to change this html</p>' ),
				),
				array(
					'type' => 'position',
					'heading' => esc_html__( 'Specify left offset for banner main caption (in %)', 'plumtree' ),
					'param_name' => 'main_caption_pos_left',
					'value'=>'',
					'std'=> '50',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'position',
					'heading' => esc_html__( 'Specify top offset for banner main caption (in %)', 'plumtree' ),
					'param_name' => 'main_caption_pos_top',
					'value'=>'',
					'std'=> '50',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'textarea_raw_html',
					'holder' => 'div',
					'heading' => esc_html__( 'Banner secondary caption', 'plumtree' ),
					'param_name' => 'secondary_caption',
					'value' => '',
				),
				array(
					'type' => 'position',
					'heading' => esc_html__( 'Specify left offset for banner secondary caption (in %)', 'plumtree' ),
					'param_name' => 'secondary_caption_pos_left',
					'value'=>'',
					'std'=> '50',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
					'type' => 'position',
					'heading' => esc_html__( 'Specify top offset for banner secondary caption (in %)', 'plumtree' ),
					'param_name' => 'secondary_caption_pos_top',
					'value'=>'',
					'std'=> '50',
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				),
				array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Choose hover effect for Banner', 'plumtree' ),
				'param_name' => 'hover_effect',
				'value' => array(
					'lily' => 'lily',
					'sadie' => 'sadie',
					'roxy' => 'roxy',
					'bubba' => 'bubba',
					'romeo' => 'romeo',
					'honey' => 'honey',
					'oscar' => 'oscar',
					'marley' => 'marley',
					'ruby' => 'ruby',
					'milo' => 'milo',
					'dexter' => 'dexter',
					'sarah' => 'sarah',
					'chico' => 'chico',
					'julia' => 'julia',
					'goliath' => 'goliath',
					'selena' => 'selena',
					'kira' => 'kira',
					'ming' => 'ming',
					'without hover' => 'without-hover',
					),
					'std'=> 'lily',
				),
				array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Add link to banner', 'plumtree' ),
				'param_name' => 'banner_link',
				'value' => '',
				'description' => '',
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
		)
	);
}

class WPBakeryShortCode_handy_banner extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'banner_img' 				 => '',
			'banner_img_size'			 => 'full',
			'main_caption'				 => '',
			'main_caption_pos_left' 	 => '50',
			'main_caption_pos_top' 		 => '50',
			'secondary_caption' 		 => '',
			'secondary_caption_pos_left' => '50',
			'secondary_caption_pos_top'  => '50',
			'hover_effect' 				 => 'lily',
			'banner_link' 				 => '',
			'el_class' 					 => '',
			'css' => '',
		), $atts ) );

		$img = '';
		$output = '';
		$width_class = '';

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'handy-banner wpb_content_element effect-' . esc_attr($hover_effect) . ' ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

		if ($banner_img && $banner_img !='') {
			$img = wp_get_attachment_image( $banner_img, $banner_img_size );
		}

		$output .= '<figure class="'. $css_class .'">';
		$output .= $img;
		$output .= '<figcaption>';
		if ($main_caption && $main_caption!='') {
			$output .= '<h3 class="main-caption" style="left:'.esc_attr($main_caption_pos_left).'%; top:'.esc_attr($main_caption_pos_top).'%;">' . rawurldecode( base64_decode( strip_tags( $main_caption ) ) ) . '</h3>';
		}
		if ($secondary_caption && $secondary_caption!='') {
			$output .= '<h4 class="secondary-caption" style="left:'.esc_attr($secondary_caption_pos_left).'%; top:'.esc_attr($secondary_caption_pos_top).'%;">' . rawurldecode( base64_decode( strip_tags( $secondary_caption ) ) ) . '</h4>';
		}
		$output .= '</figcaption>';
		if ($banner_link && $banner_link!='') {
			$href = vc_build_link($banner_link);
			$output .= '<a href="' . esc_url( $href["url"] ) . '" title="' . esc_attr( $href["title"] ) . '" target="' . esc_attr( $href["target"] ) . '"></a>';
		}
		$output .= '</figure>';

		return $output;
	}
}


endif;
