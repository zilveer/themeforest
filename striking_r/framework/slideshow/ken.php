<?php
class Theme_Slideshow_Ken {
	public $add_script = false ;

	public function __construct(){
		add_action('wp_footer', array($this, 'header'));
	}
	
	public function header() {
		if($this->add_script){
			wp_enqueue_script('ken-init');
			wp_enqueue_style('ken-css');
		}
	}

	public function render($images, $options, $shortcode = false) {
		if(empty($images))
			return '';

		$this->add_script = true;

		$paddingTop = 'padding-top:'.$options['marginTop'].'px;';
		$paddingBottom = 'padding-bottom:'.$options['marginBottom'].'px;';
		$wrap_max = 'max-width:'.($options['width']).'px;';
		$wrap_height = 'height:'.($options['height']).'px;';

		
		$options['pauseOnMain'] = $options['pauseOnMain'] ? 'on' : 'off';
		$opt_json = htmlspecialchars(json_encode($options));
		$output = <<<HTML
<div class="ken-container padding-{$options['border']}" style="{$paddingTop}{$paddingBottom}">
<div class="ken-wrap" data-options='{$opt_json}' style="{$wrap_max}{$wrap_height}">
<ul class="ken-list">		
HTML;
		$i = 1;
		foreach($images as $image) {
			$transition = 'fade';
			$startalign = 'random';
			$endalign = 'random';
			$zoom = 'random';
			$zoom_fact = 'random';
			if(!empty($image['post_id'])){
				$post_id = $image['post_id'];
				if(!empty($image['parent'])){
					$post_id = $image['parent'];
				}
				$transition = get_post_meta($post_id, '_ken_transition', true);
				$startalign = get_post_meta($post_id, '_ken_startalign', true);
				$startalign = implode(',',explode('_',$startalign));
				$endalign = get_post_meta($post_id, '_ken_endalign', true);
				$endalign = implode(',',explode('_',$endalign));
				$zoom = get_post_meta($post_id, '_ken_zoom', true); 
				$zoom_fact = get_post_meta($post_id, '_ken_zoomfact', true); 
				$zoom_random = get_post_meta($post_id, '_ken_zoomfactr', true);

				if($zoom_random){
					$zoom_fact = 'random';
				}
			}

			$output .= '<li data-ww="'.$options['width'].'" data-hh="'.$options['height'].'" data-transition="'.$transition.'" data-startalign="'.$startalign.'" data-zoom="'.$zoom.'" data-zoomfact="'.$zoom_fact.'" data-endAlign="'.$endalign.'" data-panduration="12" data-colortransition="4">';
			
			$thumb_img = '';
			if($options['naviType'] == 'thumb'){
				$thumbW = (int)$options['thumbWidth'];
				$thumbH = (int)$options['thumbHeight'];
				$thumb_img = theme_get_image_src($image['source'], array($thumbW,$thumbH));	
				$thumb_img = 'data-thumb="'.$thumb_img.'"'.' data-thumb_bw="'.$thumb_img.'"';		
			}
			$width = (int)$options['width'];
			$height = (int)$options['height'];
			$image_src = theme_get_image_src($image['source'], array($width,$height));
			if(isset($image['link']) && $image['link'] != false){
				$output .= '<a href="'.$image['link'].'" target="'.$image['target'].'"><img '.$thumb_img.' src="'.$image_src.'" alt="" /></a>';
			}
			else {
				$output .= '<img '.$thumb_img.' src="'.$image_src.'" alt="" />';
			}

			if(isset($image['type']) && $image['type'] == 'slideshow'){
				$iframe_src = get_post_meta($post_id, '_ken_video_iframe_src', true);
				$mp4_src = get_post_meta($post_id, '_ken_video_mp4_src', true);
				$webm_src = get_post_meta($post_id, '_ken_video_webm_src', true);
				$ogg_src = get_post_meta($post_id, '_ken_video_ogg_src', true);

				$video_type = get_post_meta($post_id, '_ken_video_type', true);
				if($video_type == 'iframe' && !empty($iframe_src)){

					if(preg_match('#^(?:http(?:s?)://?)(?:www\.)?youtu(?:be\.com/watch\?(?:.*?&(?:amp;)?)?v=|\.be/)([\w\-]+)?#i', $iframe_src, $matches)){
						$iframe_src = 'http://www.youtube.com/embed/'.$matches[1];
					}elseif(preg_match('#^(?:http(?:s?)://?)(?:www\.)?vimeo\.com/(\d*)?#i', $iframe_src, $matches)){
						$iframe_src = 'http://player.vimeo.com/video/'.$matches[1];
					}
					$output .= '<div class="video_kenburner">';
					$output .= '<div class="video_kenburn_wrap">';
					$output .= '<div class="video_video">';
					$output .= '<iframe class="video_clip" src="'.$iframe_src.'"></iframe>';
					$output .= '</div>';
					$output .= '<div class="close"></div>';
					$output .= '</div>';
					$output .= '</div>';

				}elseif($video_type == 'html5' && (!empty($mp4_src) || !empty($webm_src) || !empty($ogg_src)) ){
					$output .= '<div class="video_kenburner">';
					$output .= '<div class="video_kenburn_wrap">';
					$output .= '<div class="video_video">';
					$output .= '<iframe class="video_clip" id="video" src="'.site_url().'?html5iframe=true&sliderid='.$post_id.'" allowfullscreen=""></iframe>';
					$output .= '</div>';
					$output .= '<div class="close"></div>';
					$output .= '</div>';
					$output .= '</div>';
				}
			}
			
			if(isset($options['description']) && $options['description']){
				if( $image['type']=='slideshow' ){
					$desc = '';
					$desc_type = get_post_meta($post_id, '_ken_desc_type', true);
					switch ($desc_type) {
						case 'none':
							break;
						case 'caption':
							if(isset($image['title'])){
								$desc = $image['title'];
							}
							break;
						default:
							if(isset($image['desc'])){
								$desc = $image['desc'];
							}
							break;
					}
					if(!empty($desc)){
						$output .= '<div class="creative_layer">';
						$desc_position = 'cp-'.get_post_meta($post_id, '_ken_desc_position', true);
						$desc_transition = get_post_meta($post_id, '_ken_desc_transition', true);

						$output .= '<div class="ken-desc '.$desc_position .' '.$desc_transition.'">';
						$output .= do_shortcode($desc);
						$output .= '</div>';
						$output .= '</div>';
					}
				}elseif(!empty($image['desc'])){
					$output .= '<div class="creative_layer">';

					$position = rand(1,100);
					if($position%4 == 0){
						$position = 'cp-right';
					}elseif($position%4 == 1){
						$position = 'cp-left';
					}elseif($position%4 == 2){
						$position = 'cp-top';
					}elseif($position%4 == 3){
						$position = 'cp-bottom';
					}

					$output .= '<div class="ken-desc fade '.$position.'">';
					$output .= do_shortcode($image['desc']);
					$output .= '</div>';
					$output .= '</div>';
				}
			}


			$output .= '</li>';	
		}

		$output .= <<<HTML
</ul>
</div>
</div>
HTML;
		return $output;
	}

}
?>
