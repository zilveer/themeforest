<?php

if(!function_exists('hue_mikado_single_portfolio')) {
	/**
	 * Loads holder template for portfolio single
	 */
	function hue_mikado_single_portfolio() {
		$portfolio_template = hue_mikado_get_portfolio_single_type();

		$params = array(
			'portfolio_template' => $portfolio_template,
			'fullwidth'          => $portfolio_template == 'full-width-custom',
			'holder_class'       => array(
				$portfolio_template,
				'mkd-portfolio-single-holder'
			)
		);

		if($portfolio_template == 'gallery') {
			$params['holder_class'][] = 'mkd-portfolio-gallery-'.hue_mikado_options()->getOptionValue('portfolio_single_numb_columns');
		}

		hue_mikado_get_module_template_part('templates/single/holder', 'portfolio', '', $params);
	}
}

if(!function_exists('hue_mikado_get_portfolio_single_type')) {
	/**
	 * Returns template of current portfolio item
	 *
	 * @return bool|mixed|void
	 */
	function hue_mikado_get_portfolio_single_type() {
		return hue_mikado_get_meta_field_intersect('portfolio_single_template');
	}
}

if(!function_exists('hue_mikado_get_portfolio_single_media')) {
	/**
	 * Returns a media array of current portfolio item
	 *
	 * @return array
	 */
	function hue_mikado_get_portfolio_single_media() {
		$image_ids       = get_post_meta(get_the_ID(), 'mkd_portfolio-image-gallery', true);
		$videos          = get_post_meta(get_the_ID(), 'mkd_portfolio_images', true);
		$portfolio_media = array();

		if($image_ids !== '') {
			$image_ids = explode(',', $image_ids);

			foreach($image_ids as $image_id) {
				$media                = array();
				$media['title']       = get_the_title($image_id);
				$media['type']        = 'image';
				$media['description'] = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				$media['image_src']   = wp_get_attachment_image_src($image_id, 'full');

				$portfolio_media[] = $media;
			}
		}

		if(is_array($videos) && count($videos)) {
			usort($videos, 'hue_mikado_compare_portfolio_videos');
			foreach($videos as $video) {
				$media = array();

				if(!empty($video['portfoliovideotype'])) {
					$media['title']       = $video['portfoliotitle'];
					$media['type']        = $video['portfoliovideotype'];
					$media['description'] = 'video';
					$media['video_url']   = hue_mikado_portfolio_get_video_url($video);

					if($video['portfoliovideotype'] == 'self') {
						$media['video_cover'] = !empty($video['portfoliovideoimage']) ? $video['portfoliovideoimage'] : '';
					}

					if($video['portfoliovideotype'] !== 'self') {
						$media['video_id'] = $video['portfoliovideoid'];
					}
				} elseif(!empty($video['portfolioimgtype'])) {
					$media['title']     = $video['portfoliotitle'];
					$media['type']      = $video['portfolioimgtype'];
					$media['image_src'] = $video['portfolioimg'];
				}

				$portfolio_media[] = $media;
			}
		}

		return $portfolio_media;
	}
}

if(!function_exists('hue_mikado_portfolio_get_video_url')) {
	/**
	 * Returns URL of video associated to current portfolio
	 *
	 * @param $video
	 *
	 * @return array|string
	 */
	function hue_mikado_portfolio_get_video_url($video) {
		switch($video['portfoliovideotype']) {
			case 'youtube':
				return 'http://www.youtube.com/embed/'.$video['portfoliovideoid'].'?wmode=transparent';
				break;
			case 'vimeo';
				return 'http://player.vimeo.com/video/'.$video['portfoliovideoid'].'?title=0&amp;byline=0&amp;portrait=0';
				break;
			case 'self':
				$return_array = array();
				if(!empty($video['portfoliovideowebm'])) {
					$return_array['webm'] = $video['portfoliovideowebm'];
				}

				if(!empty($video['portfoliovideomp4'])) {
					$return_array['mp4'] = $video['portfoliovideomp4'];
				}

				if(!empty($video['portfoliovideoogv'])) {
					$return_array['ogv'] = $video['portfoliovideoogv'];
				}

				return $return_array;

				break;
		}
	}
}

if(!function_exists('hue_mikado_portfolio_get_media_html')) {
	/**
	 * Loads template for current portfolio item media
	 *
	 * @param $media
	 */
	function hue_mikado_portfolio_get_media_html($media) {
		global $wp_filesystem;
		$params = array();

		//For adding image overlay in gallery template type
		$params['gallery'] = (hue_mikado_get_portfolio_single_type() == 'gallery') ? true : false;

		if($media['type'] == 'image') {
			$params['lightbox'] = hue_mikado_options()->getOptionValue('portfolio_single_lightbox_images') == 'yes';

			$media['image_url'] = is_array($media['image_src']) ? $media['image_src'][0] : $media['image_src'];
			if(empty($media['description'])) {
				$media['description'] = $media['title'];
			}
		}

		if(in_array($media['type'], array('youtube', 'vimeo'))) {
			$params['lightbox'] = hue_mikado_options()->getOptionValue('portfolio_single_lightbox_videos') == 'yes';

			if($params['lightbox']) {
				switch($media['type']) {
					case 'vimeo':
						WP_Filesystem();
						$url      = 'http://vimeo.com/api/v2/video/'.$media['video_id'].'.php';
						$response = unserialize($wp_filesystem->get_contents($url));

						$params['video_title']    = $response[0]['title'];
						$params['lightbox_thumb'] = $response[0]['thumbnail_large'];
						break;
					case 'youtube':
						$url = 'http://gdata.youtube.com/feeds/api/videos/'.trim($media['video_id']).'?alt=json';

						$params['video_title'] = $media['title'];

						$params['lightbox_thumb'] = 'http://img.youtube.com/vi/'.trim($media['video_id']).'/maxresdefault.jpg';
						break;
				}
			}
		}

		$params['media'] = $media;

		hue_mikado_get_module_template_part('templates/single/media/'.$media['type'], 'portfolio', '', $params);
	}
}

if(!function_exists('hue_mikado_compare_portfolio_videos')) {
	/**
	 * Function that compares two portfolio image for sorting
	 *
	 * @param $a int first image
	 * @param $b int second image
	 *
	 * @return int result of comparison
	 */
	function hue_mikado_compare_portfolio_videos($a, $b) {
		if(isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
			if($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
				return 0;
			}

			return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
		}

		return 0;
	}
}

if(!function_exists('hue_mikado_compare_portfolio_options')) {
	/**
	 * Function that compares two portfolio options for sorting
	 *
	 * @param $a int first option
	 * @param $b int second option
	 *
	 * @return int result of comparison
	 */
	function hue_mikado_compare_portfolio_options($a, $b) {
		if(isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
			if($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
				return 0;
			}

			return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
		}

		return 0;
	}
}

if(!function_exists('hue_mikado_portfolio_get_info_part')) {
	/**
	 * Loads portfolio info item based on passed param
	 *
	 * @param $part
	 */
	function hue_mikado_portfolio_get_info_part($part) {
		$portfolio_template = hue_mikado_get_portfolio_single_type();

		hue_mikado_get_module_template_part('templates/single/parts/'.$part, 'portfolio', $portfolio_template);
	}
}

if(!function_exists('hue_mikado_portfolio_get_single_navigation')) {
	/**
	 *
	 */
	function hue_mikado_portfolio_get_single_navigation() {
		$params = array();

		$in_same_term = hue_mikado_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';

		$prev_post               = get_previous_post($in_same_term, '', 'portfolio-category');
		$next_post               = get_next_post($in_same_term, '', 'portfolio-category');
		$params['has_prev_post'] = false;
		$params['has_next_post'] = false;

		if($prev_post) {
			$params['prev_post_object'] = $prev_post;
			$params['has_prev_post']    = true;
			$params['prev_post']        = array(
				'title' => get_the_title($prev_post->ID),
				'link'  => get_the_permalink($prev_post->ID),
				'image' => get_the_post_thumbnail($prev_post->ID, 'thumbnail')
			);

			$params['prev_post_has_image'] = !empty($params['prev_post']['image']);
		}

		if($next_post) {
			$params['next_post_object'] = $next_post;
			$params['has_next_post']    = true;
			$params['next_post']        = array(
				'title' => get_the_title($next_post->ID),
				'link'  => get_the_permalink($next_post->ID),
				'image' => get_the_post_thumbnail($next_post->ID, 'thumbnail')
			);

			$params['next_post_has_image'] = !empty($params['next_post']['image']);
		}

		hue_mikado_get_module_template_part('templates/single/parts/navigation', 'portfolio', '', $params);
	}
}

if(!function_exists('hue_mikado_get_ptf_masonry_layout')){
	function hue_mikado_get_ptf_masonry_layout(){
		$html = '';
		$image_gallery_val = get_post_meta(get_the_ID(), 'mkd_portfolio-image-gallery', true);
		if($image_gallery_val !== ""){

			$html .= '<div class="mkd-ptf-gallery">';
			$html .= '<div class="mkd-ptf-gallery-sizer"></div>';
			$html .= '<div class="mkd-ptf-gallery-gutter"></div>';

			if($image_gallery_val != '' ) {
				$image_gallery_array = explode(',',$image_gallery_val);
			}
			if ( isset($image_gallery_array) && count($image_gallery_array) !== 0) {

				foreach($image_gallery_array as $image_gallery_id){

					$image_size = get_post_meta($image_gallery_id, 'attachment_image_size', true);
					$image_size_class = 'default';
					$image_size_value = 'hue_mikado_landscape';
					if($image_size){
						switch($image_size){
							case 'large_width_height' :
								$image_size_class = 'mkd-ptf-img-large-height-width';
								$image_size_value = 'hue_mikado_large_width_height';
								break;
							case 'large_height' :
								$image_size_class = 'mkd-ptf-img-large-height';
								$image_size_value = 'hue_mikado_large_height';
								break;
							default:
								$image_size_class = 'default';
								$image_size_value = 'hue_mikado_large_width_height';
								break;
						}
					}

					$html .= '<div class="mkd-ptf-gallery-item '.esc_attr($image_size_class).'">';
					$html .= '<a href="'.wp_get_attachment_url($image_gallery_id).'" data-rel="prettyPhoto[single_pretty_photo]" title="'.get_the_title($image_gallery_id).' ">';
					$html .=  wp_get_attachment_image($image_gallery_id, $image_size_value);
					$html .=  '</a>';
					$html .= '</div>';
				}

			}
			$html .= '</div>'; //close mkd-ptf-gallery
		}
		return $html;
	}
}