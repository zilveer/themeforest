<?php
// extract(shortcode_atts(array(
// 	'row_id'                => '',
// 	'class'                 => '',
// 	'row_type'              => 'row_center_content',
	
// 	'row_meta_color'		=> '',
// 	'bg_color'              => '',
// 	'bg_image'              => '',
// 	'bg_position'           => '',
// 	'bg_repeat'             => '',
// 	'bg_size'               => '',
	
// 	'row_parallax'          => '',
	
// 	'row_video_bg'          => '',
// 	'bg_video_mp4'          => '',
// 	'bg_video_ogv'          => '',
// 	'bg_video_webm'         => '',
	
// 	'row_color_overlay'     => '',
	
// 	'row_text_color'        => '',
// 	'row_custom_text_color' => '',
	
// 	'border_color'          => '',
// 	'border_style'          => '',
// 	'border_width'          => '',
	
// 	'margin_top'            => '',
// 	'margin_bottom'         => '',
// 	'margin_left'           => '',
// 	'margin_right'          => '',
// 	'padding_top'           => '',
// 	'padding_bottom'        => '',
// 	'padding_left'          => '',
// 	'padding_right'         => '',
// ), $atts));

$atts = vc_map_get_attributes( 'vc_row', $atts );
extract( $atts );

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

// Row ID
$custom_row_id    = (!empty($row_id)) ? $row_id : uniqid("wpc_");
$custom_row_class = (!empty($class)) ? $class : '';
$row_meta_color_class = (!empty($row_meta_color)) ? 'inverted-row' : '';

// Row Type
$row_center_content = null;
if ( !empty($row_type) && $row_type == 'row_center_content' ) {
	$row_center_content = 'row_center_content';
} elseif ( $row_type == 'row_full_center_content' ) {
	//$row_center_content = 'row_full_center_content container';
	$row_center_content = 'container';
} else {
	$row_center_content = 'row_fullwidth_content';
}

// Row Style
$row_css = array();

	if ( !$row_parallax ) {
		if ( $bg_color ) {
			$row_css[] = 'background-color: '. $bg_color .';';
		}

		if ( $bg_image ) {
			$img_url = wp_get_attachment_url($bg_image);
			$row_css[] = 'background-image: url('. $img_url .');';
		}

		if ( $bg_position ) {
			$row_css[] = 'background-position: '. $bg_position .';';
		}

		if ( $bg_repeat ) {
			$row_css[] = 'background-repeat: '. $bg_repeat .';';
		}
		if ( $bg_size ) {
			$row_css[] = 'background-size: '. $bg_size .';';
		}
	}
	
	if ( $border_color && $border_style && $border_width ) {
		$row_css[] = 'border-color: '. $border_color .';';
		$row_css[] = 'border-style: '. $border_style .';';
		$row_css[] = 'border-width: '. $border_width .';';
	}
	
	if ( $margin_top ) {
		$row_css[] = 'margin-top: ' . intval($margin_top) . 'px;';
	}
	
	if ( $margin_bottom ) {
		$row_css[] = 'margin-bottom: ' . intval($margin_bottom) . 'px;';
	}

	if ( $margin_left ) {
		$row_css[] = 'margin-left: ' . intval($margin_left) . 'px;';
	}

	if ( $margin_right ) {
		$row_css[] = 'margin-right: ' . intval($margin_right) . 'px;';
	}
	
	if ( $padding_top || $padding_top == '0' ) {
		$row_css[] = 'padding-top: ' . intval($padding_top) . 'px;';
	}
	
	if ( $padding_bottom || $padding_bottom == '0' ) {
		$row_css[] = 'padding-bottom: ' . intval($padding_bottom) . 'px;';
	}
	
	if ( $padding_left ) {
		$row_css[] = 'padding-left: ' . intval($padding_left) . 'px;';
	}
	
	if ( $padding_right ) {
		$row_css[] = 'padding-right: ' . intval($padding_right) . 'px;';
	}

	// Text Color
	if ( $row_text_color == 'row_text_light' ) {
		$row_css[] = 'color: #FFFFFF;';
	} elseif ( $row_text_color == 'row_text_dark' ) {
		$row_css[] = 'color: #000000;';
	} elseif ( $row_text_color == 'row_text_custom' ) {
		if ( $row_custom_text_color ) {
			$row_css[] = 'color: '. $row_custom_text_color .';';
		}
	} else {  }

$row_css = implode('', $row_css);

if ( $row_css ) {
	$row_css = wp_kses( $row_css, array() );
	$row_css = ' style="' . esc_attr($row_css) . '"';
}

// Row wrapper class
$row_wrapper_class = null;
$parallax_data     = null;
if ( $row_parallax && !$row_video_bg ) {
	$row_wrapper_class = 'wpc_row_parallax';
	$parallax_data     = ' data-bg="'. wp_get_attachment_url($bg_image) .'" data-speed="0.5"';
}

if ( $row_video_bg ) {
	$row_wrapper_class = 'wpc_row_video_bg';
}

// Video Background.
$video_render = null;
if( $row_video_bg == 'use_video' ) {
	wp_enqueue_script('wp-mediaelement');
	wp_enqueue_style('wp-mediaelement');

	$video_render .= '
	<div class="wpc_video_wrapper">
		<video class="wpc_video_bg" width="100%" height="100%" preload="auto" controls loop autoplay muted>';
			if(!empty($bg_video_mp4))  { $video_render .= '<source type="video/mp4" src="'. esc_url($bg_video_mp4).'">'; }
		    if(!empty($bg_video_ogv))  { $video_render .= '<source type="video/ogg" src="'.  esc_url($bg_video_ogv).'">'; }
			if(!empty($bg_video_webm)) { $video_render .= '<source type="video/webm" src="'.  esc_url($bg_video_webm).'">'; }
		$video_render .= '
		</video>';
	$video_render .= '
	</div>';
}

// Start VC Row
echo '
<div id="'.$custom_row_id.'" class="vc_row wpb_row vc_row-fluid '. $row_meta_color_class .' '. $custom_row_class .'">';	

		// Row Wrapper
		echo '
		<div class="row_inner_wrapper '. $row_wrapper_class .' clearfix"'. $row_css . $parallax_data.'>';

			// Background Color Overlay
			if ( $row_parallax || $row_video_bg == 'use_video' ) {
				echo '<div class="wpc_video_color_overlay" style="background-color:'. $row_color_overlay .'"></div>';
			}

			// Parallax data
			if ( !empty($bg_image) && $row_parallax && !$row_video_bg ) echo '
			<div class="wpc_parallax_bg" style="background-image:'. wp_get_attachment_url($bg_image) .'"></div>';
			
			// Video Background
			if( $row_video_bg == 'use_video' ) {
				echo $video_render;
			}

			

			// Row Inner
			echo '
			<div class="row_inner '. $row_center_content .' clearfix">';

				if ( $row_type == 'row_full_center_content' ) echo '
				<div class="row_full_center_content clearfix">';

				// Center Content ( Content in the grid )
				// if ( $row_type == 'row_center_content' ) echo '
				// <div class="row_center_content clearfix">';

					// Extract the content.
					echo do_shortcode($content);

				// if ( $row_type == 'row_center_content' ) echo '
				// </div>';

				if ( $row_type == 'row_full_center_content' ) echo '
				</div>';

			echo '
			</div>';

		echo '
		</div>';

echo '
</div>';
