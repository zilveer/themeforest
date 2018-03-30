<?php

extract( shortcode_atts( array(
			"style" => 'grid',
			'enable_title' => 'true',
			'structure' => 'column',
			'masonry_style' => 'style1',
			'item_spacing' => '8',
			"images" => '',
			"height" => 500,
			"column" => 4,
			'image_quality' => 1,
			"margin_bottom" => 20,
			'thumb_style_width' => 700,
			'thumb_style_height' => 380,
			'hover_scenarios' => 'overlay',
			'scroller_dimension' => 400,
			"el_class" => '',
			'item_id' => '',
			'image_size' => 'crop',
		), $atts ) );

require_once THEME_INCLUDES . "/image-cropping.php";	

if ( $images == '' ) {

	echo do_shortcode('[mk_message_box type="warning"]No media attachments are selected for image gallery shortcode.[/mk_message_box]');

	return null;
}


$args = array(
			'post_type' => 'attachment',
			'post__in'=> explode( ',', $images ),
			'post_mime_type' => 'image' ,
			'post_status' => null,
			'order'=>'DESC',
			'orderby' => 'post__in',
			'numberposts' => -1
			);

$id = Mk_Static_Files::shortcode_id();

$item_id = (!empty($item_id)) ? $item_id : 1409305847;


$output = $final_output = $column_css = $item_width = $slide_item = $thumb_item = $first_loop_css = '';

$scroller_css = array('','','','');

global $mk_settings;
$grid_width = $mk_settings['grid-width'];
$content_width = $mk_settings['content-width'];

if ( is_singular() ) {
	global $post;
	$layout = get_post_meta( $post->ID, '_layout', true );
} else {
	$layout == 'full';
}





if($style == 'grid') {

	if($structure == 'column') {

		switch ( $column ) {
		case 1:
			if ( $layout == 'full' ) {
				$width = $grid_width;
				$height = !empty( $height ) ? $height : $width;
			} else {
				$width = (($content_width / 100) * $grid_width);
				$height = !empty( $height ) ? $height : 350;
			}
			$column_css = 'one-column';
			break;
		case 2:
			if ( $layout == 'full' ) {
				$width = round($grid_width/2);
				$height = !empty( $height ) ? $height : $width;
			} else {
				$width = round((($content_width / 100) * $grid_width)/2);
				$height = !empty( $height ) ? $height : $width;
			}
			$column_css = 'two-column';
			break;
		case 3:
			if ( $layout == 'full' ) {
				$width = round($grid_width/3);
				$height = !empty( $height ) ? $height : $width;
			} else {
				$width = round((($content_width / 100) * $grid_width)/3);
				$height = !empty( $height ) ? $height : $width;
			}
			$column_css = 'three-column';
			break;

		case 4:
			if ( $layout == 'full' ) {
				$width = $grid_width/4;
				$height = !empty( $height ) ? $height : $width;
			} else {
				$width = (($content_width / 100) * $grid_width)/4;
				$height = !empty( $height ) ? $height : $width;
			}
			$column_css = 'four-column';
			break;
		case 5:
			if ( $layout == 'full' ) {
				$width = $grid_width/5;
				$height = !empty( $height ) ? $height :  $width;
			} else {
				$width = round((($content_width / 100) * $grid_width)/5);
				$height = !empty( $height ) ? $height : $width;
			}
			$column_css = 'five-column';
			break;

		case 6:
			if ( $layout == 'full' ) {
				$width = round($grid_width/6);
				$height = !empty( $height ) ? $height :  $width;
			} else {
				$width = round((($content_width / 100) * $grid_width)/6);
				$height = !empty( $height ) ? $height : $width;
			}
			$column_css = 'six-column';
			break;
		}

		$width = $width*$image_quality;
		$height = $height*$image_quality;

	} else {

		$width = $scroller_dimension - 1;
		$height = $scroller_dimension - 1;
		$scroller_css = array('mk-swiper-container mk-swiper-slider ', 'mk-swiper-wrapper ', 'swiper-slide', ' data-freeModeFluid="true" data-slidesPerView="auto" data-pagination="false" data-freeMode="true" data-mousewheelControl="true" data-direction="horizontal" data-slideshowSpeed="4000" data-animationSpeed="400" data-directionNav="false" ');
		$item_width = ' style="width:'.$scroller_dimension.'px"';
	}

		$i = 0;
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ( $attachments as $attachment ) {
				$i++;
				$title = $attachment->post_title;
				switch ($image_size) {
				    case 'full':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = $image_src_array[0];
				        break;
				    case 'crop':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = bfi_thumb($image_src_array[0], array(
				            'width' => $width * $image_quality,
				            'height' => $height * $image_quality
				        ));
				        break;            
				    case 'large':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'large', true);
				        $image_src = $image_src_array[0];
				        break;
				    case 'medium':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'medium', true);
				        $image_src = $image_src_array[0];
				        break;        
				    default:
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = bfi_thumb($image_src_array[0], array(
				            'width' => $width * $image_quality,
				            'height' => $height * $image_quality
				        ));
				        break;
				}

				$zoom_icon ='<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'" class="mk-lightbox theme-rounded-icon"><i class="mk-nuance-icon-search"></i></a>';

				$output .='<li class="'.$scroller_css[2].'"'.$item_width.'><div class="item-holder mk-gallery-item">';


				$output .='<div class="featured-image '.$hover_scenarios.'-hover"><img alt="'.$title.'" title="'.$title.'" src="' . mk_thumbnail_image_gen($image_src, $width, $height) .'" />';
				$output .='<div class="hover-overlay"></div>';
					$output .='<div class="gallery-meta">';
					$output .= '<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'-2" class="mk-lightbox">';
					$output .= '<i class="mk-theme-icon-plus"></i></a><div class="clearboth"></div>';
					
					if($enable_title == 'true') { 
						$output .= '<div class="the-title">';
						$output .= '<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'-3" class="mk-lightbox">';
						$output .= $title;
						$output .= '</a>';
						$output .= '</div>';
					}
					$output .= '</div>';


				$output .='</div>';

				$output .='</div></li>';




			}
		}

		$final_output .= '<div id="gallery-'.$id.'" style="margin-bottom:'.$margin_bottom.'px" class="mk-gallery '.$style.'-style '.$structure.'-structure '.$scroller_css[0].$column_css.' '.$el_class.'"'.$scroller_css[3].'><ul class="'.$scroller_css[1].'">' . $output . '</ul><div class="clearboth"></div></div>';

} else if($style == 'thumb') {

		$width = $thumb_style_width;
		$height = $thumb_style_height;
		$i = 0;
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ( $attachments as $attachment ) {

				$image_title = $attachment->post_title;
				switch ($image_size) {
				    case 'full':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = $image_src_array[0];
				        break;
				    case 'crop':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = bfi_thumb($image_src_array[0], array(
				            'width' => $width * $image_quality,
				            'height' => $height * $image_quality
				        ));
				        break;            
				    case 'large':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'large', true);
				        $image_src = $image_src_array[0];
				        break;
				    case 'medium':
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'medium', true);
				        $image_src = $image_src_array[0];
				        break;        
				    default:
				        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
				        $image_src = bfi_thumb($image_src_array[0], array(
				            'width' => $width * $image_quality,
				            'height' => $height * $image_quality
				        ));
				        break;
				}
				$image_src_thumb  = bfi_thumb( $image_src_array[ 0 ], array('width' => 100, 'height' => 100, 'crop'=>true));

				$slide_item .= '<div class="swiper-slide"><div class="featured-image '.$hover_scenarios.'-hover">';
				$slide_item .= '<img width="'.$width.'" height="'.$height.'" alt="'.$image_title.'" src="' . mk_thumbnail_image_gen($image_src, $width, $height) .'" />';
				$slide_item .= '<a href="'.$image_src_array[ 0 ].'" title="'.$image_title.'" rel="gallery-loop" class="mk-lightbox gallery-thumb-lightbox"><i class="mk-theme-icon-plus"></i></a>';
				$slide_item .= '</div></div>';

				$i++;
				if($i == 1 ) {
					$first_loop_css = 'active-item';
				}

				$thumb_item .= '<a href="#" class="'.$first_loop_css.'">';
				$thumb_item .= '<img width="100" height="100" alt="'.$image_title.'" src="' . mk_thumbnail_image_gen($image_src_thumb, 100, 100) .'" />';
				$thumb_item .= '</a>';

				$first_loop_css = '';
			}


			$output .= '<div class="gallery-thumb-large"><div id="gallery-'.$id.'" class="mk-swiper-container mk-swiper-slider" data-freeModeFluid="true" data-loop="false" data-slidesPerView="1" data-pagination="false" data-freeMode="false" data-mousewheelControl="true" data-direction="horizontal" data-slideshowSpeed="6000" data-animationSpeed="600" data-directionNav="true"><div class="mk-swiper-wrapper">';
			$output .= $slide_item. '</div>';
			$output .= '<a class="mk-swiper-prev slideshow-swiper-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
			$output .= '<a class="mk-swiper-next slideshow-swiper-arrows"><i class="mk-theme-icon-next-big"></i></a>';
			$output .= '</div></div>';
			$output .= '<div class="gallery-thumbs-small">' .$thumb_item. '</div>';

		}

		$final_output .= '<div style="max-width:'.$width.'px;margin-bottom:'.$margin_bottom.'px" class="mk-gallery '.$style.'-style '.$el_class.'">' . $output . '<div class="clearboth"></div></div>';
} else if($style == 'masonry'){

	$width = 750;
	$height = 750;
	$i = 0;
	$attachments = get_posts($args);

	$mansory_pointer_css = '';


	if ($attachments) {
		foreach ( $attachments as $attachment ) {
			if($masonry_style == 'style1' && $i % 5 == 0) {
		        $mansory_pointer_css .= 'gallery-mansory-large ';
		    } else if($masonry_style == 'style2' && ($i - 2) % 5 == 0) {
		        $mansory_pointer_css .= 'gallery-mansory-large ';
		    }else if($masonry_style == 'style3' && ($i - 1) % 5 == 0) {
		        $mansory_pointer_css .= 'gallery-mansory-large ';
		    }else if($masonry_style == 'style4' && $i == 0) {
		        $mansory_pointer_css .= 'gallery-mansory-large ';
		    }

			$title = $attachment->post_title;
			switch ($image_size) {
			    case 'full':
			        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
			        $image_src = $image_src_array[0];
			        break;
			    case 'crop':
			        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
			        $image_src = bfi_thumb($image_src_array[0], array(
			            'width' => $width * $image_quality,
			            'height' => $height * $image_quality
			        ));
			        break;            
			    case 'large':
			        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'large', true);
			        $image_src = $image_src_array[0];
			        break;
			    case 'medium':
			        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'medium', true);
			        $image_src = $image_src_array[0];
			        break;        
			    default:
			        $image_src_array = wp_get_attachment_image_src($attachment->ID, 'full', true);
			        $image_src = bfi_thumb($image_src_array[0], array(
			            'width' => $width * $image_quality,
			            'height' => $height * $image_quality
			        ));
			        break;
			}

			$zoom_icon ='<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'" class="mk-lightbox theme-rounded-icon"><i class="mk-nuance-icon-search"></i></a>';
			$output .='<article class="mk-gallery-item mk-isotop-item masonry-'.$item_id.' '.$mansory_pointer_css.$scroller_css[2].'"'.$item_width.'><div class="item-holder" style="margin:0 '.$item_spacing.'px '.($item_spacing*2).'px">';

			$output .='<div class="featured-image '.$hover_scenarios.'-hover"><img alt="'.$title.'" title="'.$title.'" width="'.$width.'" height="'.$height.'" src="' . mk_thumbnail_image_gen($image_src, $width, $height) .'" />';
			$output .='<div class="hover-overlay"></div>';
				$output .='<div class="gallery-meta">';
				$output .= '<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'-2" class="mk-lightbox">';
				$output .= '<i class="mk-theme-icon-plus"></i></a><div class="clearboth"></div>';
				
				if($enable_title == 'true') {
					$output .= '<div class="the-title">';
					$output .= '<a href="'.$image_src_array[0].'" title="'.$title.'" rel="gallery-'.$id.'-3" class="mk-lightbox">';
					$output .= $title;
					$output .= '</a>';
					$output .= '</div>';
				}
				$output .= '</div>';


			$output .='</div>';

			$output .='</div></article>';
			$i++;
			$mansory_pointer_css = '';
		}
		$final_output .= '<div class="loop-main-wrapper"><div id="gallery-'.$id.'" data-uniqid="'.$item_id.'" data-style="' . $style . '" style="margin-bottom:'.$margin_bottom.'px" class="mk-gallery isotop-enabled mk-theme-loop '.$style.'-style '.$scroller_css[0].$column_css.' '.$el_class.'"'.$scroller_css[3].'>' . $output . '</div></div>';
	}
}


wp_reset_query();


echo $final_output;







