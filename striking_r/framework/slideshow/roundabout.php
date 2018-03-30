<?php
class Theme_Slideshow_Roundabout {
	public $add_script = false ;


	public function __construct(){
		add_action('wp_footer', array($this, 'header'));
	}
	public function header() {
		if($this->add_script){
			wp_enqueue_script('roundabout-init');
			wp_enqueue_style('roundabout-css');
		}
	}

	public function render($images, $options, $shortcode = false) {
		if(empty($images))
			return '';

		$this->add_script = true;

		$marginTop = 'padding-top:'.$options['marginTop'].'px;';
		$marginBottom = 'padding-bottom:'.$options['marginBottom'].'px;';

		$size = array((int)$options['imageWidth'],(int)$options['imageHeight']);
		$image_width = 'width:'.$options['imageWidth'].'px;';
		$image_height = 'height:'.$options['imageHeight'].'px;';
		unset($options['imageWidth']);
		unset($options['imageHeight']);
		$slide_width = 'width:'.$options['slideWidth'].'px;';
		$slide_height = 'height:'.$options['slideHeight'].'px;'; 
		unset($options['slideWidth']);
		unset($options['slideHeight']);

		$offsetTop = 'margin-top:'.$options['offsetTop'].'px;';
		$offsetBottom = 'margin-bottom:'.$options['offsetBottom'].'px;'; 
		unset($options['offsetTop']);
		unset($options['offsetBottom']);

		$navi = $options['navi'];
		$navi_hover = $options['navihover'] ? 'show-on-hover' : '';

		$caption = $options['caption'];
		$caption_hover = $options['captionHover'] ? 'is-show-on-hover' : '';
		$caption_position = 'is-'.$options['captionPosition'];

		$auto_play = $options['autoplay'] ? 'is-autoplay' : '';
		
		$options = htmlspecialchars(json_encode($options));

		$output = <<<HTML
<div class="roundabout-wrap" style="{$marginTop}{$marginBottom}">
<ul class="roundabout-list" data-options='{$options}' style="{$slide_width}{$slide_height}{$offsetTop}{$offsetBottom}">
HTML;
		/*$images = slideshow_generator('get_images',$category,$number,'full');*/
		$count = 1;
		foreach($images as $image) {
			if ($count>1) $style='display:none;'; else $style='';
			$output .= '<li class="roundabout-item item-'.$count.'" style="'.$image_width.$image_height.$style.'">';
			$image_src = theme_get_image_src($image['source'], $size);
			if(isset($image['link']) && $image['link'] != false){
				$output .= '<a href="'.$image['link'].'" target="'.$image['target'].'" alt="'.$image['title'].'"><img src="'.$image_src.'" width="100%" height="100%" alt=""/></a>';
			} else {
				$output .= '<img src="'.$image_src.'" width="100%" height="100%" alt=""/>';
			}
			
			if($caption){
				$output .= '<div class="roundabout-caption '.$caption_hover.' '.$caption_position.'">';
				if(!empty($image['title'])){
					if($image['link'] != false){
						$output .= '<div class="roundabout-title"><a href="'.$image['link'].'" target="'.$image['target'].'">'.$image['title'].'</a></div>';
					}else{
						$output .= '<div class="roundabout-title">'.$image['title'].'</div>';
					}
				}
				if(!empty($image['desc'])){
					$output .= '<div class="roundabout-desc">'.do_shortcode($image['desc']).'</div>';
				}
				$output .= '</div>';
			}
			$output .= '</li>';
			$count++;
		}
		
		

		$output .= '</ul>';
		if($navi){
			$output .= '<div class="roundabout-navi '.$navi_hover.' '.$auto_play.'">';

			/*$output .= '<div class="roundabout-prev">prev</div>';
			$output .= '<div class="roundabout-next">next</div>';*/

			//pager
			$output .= '<div class="roundabout-pagers">';
			for ($i = 1; $i < $count; $i++) {
				$active = $i==1 ? ' active' : ''; 
				$output .= '<span class="roundabout-page'.$active.'">'.$i.'</span>';
			}
			$output .= '<span class="roundabout-start">start</span>';
			$output .= '<span class="roundabout-stop">stop</span>';
			$output .= '</div>';
			$output .= '</div>';
		}

		$output .='</div>';

		return $output;
	}
}
