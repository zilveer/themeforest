<?php
if(version_compare(edgt_get_vc_version(), '4.7.4') >= 0) {

	/**
	 * Shortcode attributes
	 * @var $atts
	 * @var $title
	 * @var $source
	 * @var $type
	 * @var $onclick
	 * @var $custom_links
	 * @var $custom_links_target
	 * @var $img_size
	 * @var $external_img_size
	 * @var $images
	 * @var $custom_srcs
	 * @var $el_class
	 * @var $interval
	 * @var $css
	 * Shortcode class
	 * @var $this WPBakeryShortCode_VC_gallery
	 */
	$title = $source = $type = $onclick = $custom_links = $custom_links_target = $img_size = $external_img_size = $images = $custom_srcs = $el_class = $interval = $css = '';
	$large_img_src = '';

	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $attributes );

	$default_src = vc_asset_url( 'vc/no_image.png' );

	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	$data_array = '';
	$title_style = '';
	$hover_style = '';

	$el_class = $this->getExtraClass( $el_class );
	if ( 'nivo' === $type ) {
		$type = ' wpb_slider_nivo theme-default';
		wp_enqueue_script( 'nivo-slider' );
		wp_enqueue_style( 'nivo-slider-css' );
		wp_enqueue_style( 'nivo-slider-theme' );

		$slides_wrap_start = '<div class="nivoSlider">';
		$slides_wrap_end = '</div>';
	} else if ( 'flexslider' === $type || 'flexslider_fade' === $type || 'flexslider_slide' === $type || 'fading' === $type ) {
		$el_start = '<li>';
		$el_end = '</li>';
		$slides_wrap_start = '<ul class="slides">';
		$slides_wrap_end = '</ul>';
//		wp_enqueue_style( 'flexslider' );
//		wp_enqueue_script( 'flexslider' );

		if ($type == "flexslider_slide" || $type == "flexslider_fade") {
			if ($disable_navigation_arrows == "yes") {
				$disable_navigation_arrows = "yes";
			} else {
				$disable_navigation_arrows = "no";
			}

			$data_array .= 'data-disable-navigation-arrows="' . $disable_navigation_arrows . '" ';
			if ($show_navigation_controls == "yes") {
				$show_navigation_controls = "yes";
			} else {
				$show_navigation_controls = "no";
			}

			$data_array .= 'data-show-navigation-controls="' . $show_navigation_controls . '" ';
		}

	} else if ( 'image_grid' === $type ) {
		//wp_enqueue_script( 'vc_grid-js-imagesloaded' );
		//wp_enqueue_script( 'isotope' );

//		$el_start = '<li class="isotope-item">';
//		$el_end = '</li>';
//		$slides_wrap_start = '<ul class="wpb_image_grid_ul">';
//		$slides_wrap_end = '</ul>';

		$li_classes = '';
		if ($grayscale == 'yes') {
			$li_classes .= 'grayscale';
		} else {
			$li_classes .= 'no_grayscale';
		}

		$el_start = '<li class="' . $li_classes . '">';
		$el_end = '</li>';
		$slides_wrap_start = '<div class="gallery_holder"><ul class="gallery_inner ' . $images_space . '  v' . $column_number . '">';
		$slides_wrap_end = '</ul></div>';

	}

	if ( 'link_image' === $onclick ) {
		//wp_enqueue_script( 'prettyphoto' );
		//wp_enqueue_style( 'prettyphoto' );
	}

	$flex_fx = '';
	$frame_class = '';
	if ( 'flexslider' === $type || 'flexslider_fade' === $type || 'fading' === $type ) {
		$type = ' wpb_flexslider flexslider_fade flexslider';
		$flex_fx = ' data-flex_fx="fade"';
	} else if ( 'flexslider_slide' === $type ) {
		$type = ' wpb_flexslider flexslider_slide flexslider';
		$flex_fx = ' data-flex_fx="slide"';
		if ($frame == "use_frame") {
			$frame_class = " have_frame " . $choose_frame;

		}
	} else if ( 'image_grid' === $type ) {
		$type = ' wpb_image_grid';
	}

	if ($title_font_weight !== '') {
		$title_style .= 'font-weight:' . $title_font_weight . ';';
	}
	if ($title_font_size !== '') {
		$title_font_size = (strstr($title_font_size, 'px', true)) ? $title_font_size : $title_font_size . 'px';
		$title_style .= 'font-size:' . $title_font_size . ';';
	}
	if ($title_font_style !== '') {
		$title_style .= 'font-style:' . $title_font_style . ';';
	}
	if ($title_font_family !== '') {
		$title_style .= 'font-family:"' . $title_font_family . '", sans-serif;';
	}
	if ($title_alignment !== '') {
		$title_style .= 'text-align:' . $title_alignment . ';';
	}
	if ($title_layer_color !== '') {
		$title_style .= 'background-color:' . $title_layer_color . ';';
	}

	if ( '' === $images ) {
		$images = '-1,-2,-3';
	}

	$pretty_rel_random = ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"';

	if ( 'custom_link' === $onclick ) {
		$custom_links = explode( ',', $custom_links );
	}

	switch ( $source ) {
		case 'media_library':
			$images = explode( ',', $images );
			break;

		case 'external_link':
			$images = explode( ',', $custom_srcs );
			break;
	}
	$image_title = '';
	foreach ( $images as $i => $image ) {

		switch ( $source ) {
			case 'media_library':
				if ( $image > 0 ) {
					$img = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size ) );
					$thumbnail = $img['thumbnail'];
					$large_img_src = $img['p_img_large'][0];
					$image_title = get_the_title($image);
				} else {
					$large_img_src = $default_src;
					$thumbnail = '<img src="' . $default_src . '" />';
				}
				break;

			case 'external_link':
				$image = esc_attr( $image );
				$dimensions = vcExtractDimensions( $external_img_size );
				$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
				$thumbnail = '<img ' . $hwstring . ' src="' . $image . '" />';
				$large_img_src = $image;
				break;
		}

		$hover_image = '';
		//checking if background hover color is set
		if ($background_hover_color !== '' && $hover_style === '') {
			$hover_style .= 'background-color: ' . $background_hover_color . ';';
		}


		if ($type == ' wpb_image_grid' && $grayscale == 'no') {
			$hover_image = '<span class="gallery_hover"';
			if ($hover_style !== '') {
				$hover_image .= " style='" . $hover_style . "'";

			}
			$hover_image .= '>';
			if ($hover_icon !== 'none') {
				if ($hover_icon === 'magnifier')
					$hover_image .= '<i class="fa fa-search"></i>';
				else
					$hover_image .= '<i class="fa fa-plus"></i>';

			}
			$hover_image .= '</span>';

		}

		$link_start = $link_end = '';

		switch ( $onclick ) {
			case 'img_link_large':
				$link_start = '<a href="' . $large_img_src . '" target="' . $custom_links_target . '">' . $hover_image;
				$link_end = '</a>';
				break;

			case 'link_image':
				$link_start = '<a class="prettyphoto" href="' . $large_img_src . '"' . $pretty_rel_random . '>' . $hover_image;
				$link_end = '</a>';
				break;

			case 'custom_link':
				if ( ! empty( $custom_links[ $i ] ) ) {
					$link_start = '<a href="' . $custom_links[ $i ] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>'. $hover_image;
					$link_end = '</a>';
				}
				break;
		}

		$gal_images .= $el_start . $link_start . $thumbnail . $link_end;

		if ($show_image_title == 'show_image_title') {
			$gal_images .= '<div class="image_gallery_title"';
			if ($title_style !== '') {
				$gal_images .= " style='$title_style'";
			}
			$gal_images .= ">$image_title";
			$gal_images .= '</div';
		}
		$gal_images .= $el_end;
	}

	$class_to_filter = 'wpb_gallery wpb_content_element vc_clearfix';
	$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

	if ($frame == 'use_frame') {

		$css_class .= " frame_holder";
		if ($choose_frame == "frame2") {
			$css_class .= " frame_holder2";
		}
		if ($choose_frame == "frame3") {
			$css_class .= " frame_holder3";
		}
		if ($choose_frame == "frame4") {
			$css_class .= " frame_holder4";
		}
	}


	$output = '';
	$output .= '<div class="' . $css_class . '">';
	$output .= '<div class="wpb_wrapper">';
	$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );
	$output .= '<div class="wpb_gallery_slides' . $type . $frame_class . '" data-interval="' . $interval . '"' . $flex_fx . ' ' . $data_array . '>' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';
	if ($frame == 'use_frame') {
		$output .= "<div class='gallery_frame'>";
		if ($choose_frame == "frame2") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-2.png' alt='slider-frame-image'/>";
		} elseif ($choose_frame == "frame3") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-3.png' alt='slider-frame-image'/>";
		} elseif ($choose_frame == "frame4") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-4.png' alt='slider-frame-image'/>";
		} else {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame.png' alt='slider-frame-image'/>";
		}
		$output .= "</div>";
	}

	$output .= '</div>';
	$output .= '</div>';

	echo $output;

} else {

	$output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = $column_number = $disable_navigation_arrows = $show_navigation_controls = '';
	extract(shortcode_atts(array(
		'title' => '',
		'type' => 'flexslider',
		'frame' => '',
		'onclick' => 'link_image',
		'custom_links' => '',
		'custom_links_target' => '',
		'img_size' => 'full',
		'images' => '',
		'el_class' => '',
		'interval' => '5',
		'column_number' => '3',
		'grayscale' => 'no',
		'background_hover_color' => '',
		'hover_icon' => 'none',
		'images_space' => 'gallery_without_space',
		'choose_frame' => 'no',
		'show_image_title' => '',
		'title_font_family' => '',
		'title_font_size' => '',
		'title_font_weight' => '',
		'title_font_style' => '',
		'title_layer_color' => '',
		'title_alignment' => '',
		'disable_navigation_arrows' => '',
		'show_navigation_controls' => ''

	), $atts));
	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	$title_style = '';
	$hover_style = '';
	$data_array = '';

	$title = esc_html($title);
	$img_size = esc_attr($img_size);
	$images = esc_attr($images);
	$el_class = esc_attr($el_class);
	$title_font_family = esc_attr($title_font_family);
	$title_font_size = esc_attr($title_font_size);
	$title_layer_color = esc_attr($title_layer_color);
	$background_hover_color = esc_attr($background_hover_color);


	$el_class = $this->getExtraClass($el_class);

	if ($type == 'nivo') {
		$type = ' wpb_slider_nivo theme-default';
		wp_enqueue_script('nivo-slider');
		wp_enqueue_style('nivo-slider-css');
		wp_enqueue_style('nivo-slider-theme');

		$slides_wrap_start = '<div class="nivoSlider">';
		$slides_wrap_end = '</div>';
	} else if ($type == 'flexslider' || $type == 'flexslider_fade' || $type == 'flexslider_slide' || $type == 'fading') {
		$el_start = '<li>';
		$el_end = '</li>';
		$slides_wrap_start = '<ul class="slides">';
		$slides_wrap_end = '</ul>';


		if ($type == "flexslider_slide" || $type == "flexslider_fade") {
			if ($disable_navigation_arrows == "yes") {
				$disable_navigation_arrows = "yes";
			} else {
				$disable_navigation_arrows = "no";
			}

			$data_array .= 'data-disable-navigation-arrows="' . $disable_navigation_arrows . '"';
			if ($show_navigation_controls == "yes") {
				$show_navigation_controls = "yes";
			} else {
				$show_navigation_controls = "no";
			}

			$data_array .= 'data-show-navigation-controls="' . $show_navigation_controls . '"';
		}

	} else if ($type == 'image_grid') {
		//wp_enqueue_script('isotope');
		$li_classes = '';
		if ($grayscale == 'yes') {
			$li_classes .= 'grayscale';
		} else {
			$li_classes .= 'no_grayscale';
		}


		$el_start = '<li class="' . $li_classes . '">';
		$el_end = '</li>';


		$slides_wrap_start = '<div class="gallery_holder"><ul class="gallery_inner ' . $images_space . ' v' . $column_number . '">';
		$slides_wrap_end = '</ul></div>';
	}
	if ($onclick == 'link_image') {
//		wp_enqueue_script('prettyphoto');
//		wp_enqueue_style('prettyphoto');
	}

	$flex_fx = '';
	$frame_class = '';
	if ($type == 'flexslider' || $type == 'flexslider_fade' || $type == 'fading') {
		$type = ' wpb_flexslider flexslider_fade flexslider';
		$flex_fx = ' data-flex_fx="fade"';
	} else if ($type == 'flexslider_slide') {
		$type = ' wpb_flexslider flexslider_slide flexslider';
		$flex_fx = ' data-flex_fx="slide"';
		if ($frame == "use_frame") {
			$frame_class = " have_frame " . $choose_frame;

		}
	} else if ($type == 'image_grid') {
		$type = ' wpb_image_grid';
	}
	if ($title_font_weight !== '') {
		$title_style .= 'font-weight:' . $title_font_weight . ';';
	}
	if ($title_font_size !== '') {
		$title_font_size = (strstr($title_font_size, 'px', true)) ? $title_font_size : $title_font_size . 'px';
		$title_style .= 'font-size:' . $title_font_size . ';';
	}
	if ($title_font_style !== '') {
		$title_style .= 'font-style:' . $title_font_style . ';';
	}
	if ($title_font_family !== '') {
		$title_style .= 'font-family:"' . $title_font_family . '", sans-serif;';
	}
	if ($title_alignment !== '') {
		$title_style .= 'text-align:' . $title_alignment . ';';
	}
	if ($title_layer_color !== '') {
		$title_style .= 'background-color:' . $title_layer_color . ';';
	}
//if ( $images == '' ) return null;
	if ($images == '') $images = '-1,-2,-3';

	$pretty_rel_random = ' rel="prettyPhoto[rel-' . rand() . ']"'; //rel-'.rand();

	if ($onclick == 'custom_link') {
		$custom_links = explode(',', $custom_links);
	}
	$images = explode(',', $images);
	$i = -1;

	foreach ($images as $attach_id) {
		$i++;
		if ($attach_id > 0) {
			$post_thumbnail = wpb_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $img_size));
			$image_title = get_the_title($attach_id);
		} else {
			$different_kitten = 400 + $i;
			$post_thumbnail = array();
			$post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/' . $different_kitten . '/300" />';
			$post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
		}

		$thumbnail = $post_thumbnail['thumbnail'];
		$p_img_large = $post_thumbnail['p_img_large'];
		$link_start = $link_end = '';
		$hover_image = '';

		//checking if background hover color is set
		if ($background_hover_color !== '' && $hover_style === '') {
			$hover_style .= 'background-color: ' . $background_hover_color . ';';
		}


		if ($type == ' wpb_image_grid' && $grayscale == 'no') {
			$hover_image = '<span class="gallery_hover"';
			if ($hover_style !== '') {
				$hover_image .= " style='" . $hover_style . "'";

			}
			$hover_image .= '>';
			if ($hover_icon !== 'none') {
				if ($hover_icon === 'magnifier')
					$hover_image .= '<i class="fa fa-search"></i>';
				else
					$hover_image .= '<i class="fa fa-plus"></i>';

			}
			$hover_image .= '</span>';

		}

		if ($onclick == 'link_image') {
			$link_start = '<a class="lightbox_single_portfolio" href="' . $p_img_large[0] . '"' . $pretty_rel_random . '>' . $hover_image;
			$link_end = '</a>';
		} else if ($onclick == 'custom_link' && isset($custom_links[$i]) && $custom_links[$i] != '') {
			$link_start = '<a href="' . esc_url($custom_links[$i]) . '"' . (!empty($custom_links_target) ? ' target="' . $custom_links_target . '"' : '') . '>' . $hover_image;
			$link_end = '</a>';
		}
		$gal_images .= $el_start . $link_start . $thumbnail . $link_end;
		if ($show_image_title == 'show_image_title') {
			$gal_images .= '<div class="image_gallery_title"';
			if ($title_style !== '') {
				$gal_images .= " style='$title_style'";
			}
			$gal_images .= ">$image_title";
			$gal_images .= '</div';
		}

		$gal_images .= $el_end;
	}
	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element' . $el_class . ' clearfix', $this->settings['base']);
	if ($frame == 'use_frame') {

		$css_class .= " frame_holder";
		if ($choose_frame == "frame2") {
			$css_class .= " frame_holder2";
		}
		if ($choose_frame == "frame3") {
			$css_class .= " frame_holder3";
		}
		if ($choose_frame == "frame4") {
			$css_class .= " frame_holder4";
		}

	}


	$output .= "\n\t" . '<div class="' . $css_class . '">';
	$output .= "\n\t\t" . '<div class="wpb_wrapper">';
	$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_gallery_heading'));
	$output .= '<div class="wpb_gallery_slides' . $type . $frame_class . '" data-interval="' . $interval . '"' . $flex_fx . ' ' . $data_array . '>' . $slides_wrap_start . $gal_images . $slides_wrap_end;
	$output .= '</div>';
	if ($frame == 'use_frame') {

		$output .= "<div class='gallery_frame'>";
		if ($choose_frame == "frame2") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-2.png' alt='slider-frame-image'/>";
		} elseif ($choose_frame == "frame3") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-3.png' alt='slider-frame-image'/>";
		} elseif ($choose_frame == "frame4") {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame-4.png' alt='slider-frame-image'/>";
		} else {
			$output .= "<img src='" . get_template_directory_uri() . "/img/slider_frame.png' alt='slider-frame-image'/>";
		}
		$output .= "</div>";
	}

	$output .= "\n\t\t" . '</div> ' . $this->endBlockComment('.wpb_wrapper');
	$output .= "\n\t" . '</div> ' . $this->endBlockComment('.wpb_gallery');

	print $output;
}