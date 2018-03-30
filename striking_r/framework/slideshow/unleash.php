<?php
class Theme_Slideshow_Unleash {
	public $add_script = false ;

	public function __construct(){
		add_action('wp_footer', array($this, 'header'));
	}
	public function header() {
		if($this->add_script){
			wp_enqueue_script('unleash-init');
			wp_enqueue_style('unleash-css');
		}
	}

	public function render($images, $options, $shortcode = false) {
		if(empty($images))
			return '';

		$this->add_script = true;

		$marginTop = 'padding-top:'.$options['marginTop'].'px;';
		$marginBottom = 'padding-bottom:'.$options['marginBottom'].'px;';
	
		$imagew = (int)$options['slide_width'];
		$imageh = (int)$options['slide_height'];

		$sliderW = 'width:'.$options['max_width'].'px;';

		if (isset($options['captionCss']) && !empty($options['captionCss']))$caption_css = ' '.$options['captionCss']; else $caption_css='';
		unset($options['captionCss']);

		$caption = $options['caption'];

		if($options['controls'] === false){
			$options['hide_controls'] = false;
			$css = ' uleash_no_controls';
		} else {
			$css = '';
		}
		$options = htmlspecialchars(json_encode($options));
		
		$output = <<<HTML
<div class="unleash-slider-wrap{$css}" style="{$marginTop}{$marginBottom}{$sliderW}">
<div class="unleash-slider-list" data-options='{$options}'>
HTML;

		$i = 1;
		foreach($images as $image) {
			if ($i>=2) $image_style=' style="display:none;"'; else  $image_style='';
			$output .= '<div class="unleash-slider-item item-'.$i.'"'.$image_style.'>';
			$image_src = theme_get_image_src($image['source'], array($imagew,$imageh));
			if(isset($image['link']) && $image['link'] != false){
				$output .= '<a href="'.$image['link'].'" target="'.$image['target'].'"><img src="'.$image_src.'" alt="" /></a>';
			} else {
				$output .= '<img src="'.$image_src.'" alt="" />';
			}
			$output .= '<img src="'.$image_src.'" alt="" />';
			$title = $caption?$image['title']:'';
			$desc = $caption?$image['desc']:'';
			
			if(!$caption ||(empty($title) && empty($desc))){
				$display_caption = ' unleash-caption-hidden';$display_style='';
			}else{
				$display_caption = '';
				$display_style=' style="display:none;"';
			}
			$output .= '<div class="unleash-slider-detail'.$caption_css.$display_caption.'"'.$display_style.' >';

			if($image['link'] != false){
				$output .= '<h3 class="unleash-slider-caption"><a href="'.$image['link'].'" target="'.$image['target'].'">'.$title.'</a></h3>';
			}else{
				$output .= '<h3 class="unleash-slider-caption">'.$title.'</h3>';
			}
			$output .= empty($desc) ? '' : ('<div class="unleash-slider-desc">'.do_shortcode($desc).'</div>');
			$output .= '</div>';
			$output .= '</div>';
			$i++;
			
		}
		$output .= <<<HTML
</div>
</div>
HTML;
		return $output;
	}
}
