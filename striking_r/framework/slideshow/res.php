<?php
class Theme_Slideshow_Reslider {
	public $add_script = false ;

	public function __construct(){
		add_action('wp_footer', array($this, 'header'));
	}
	
	public function header() {
		if($this->add_script){
			wp_enqueue_script('reslider-init');
			wp_enqueue_style('reslider-css');
		}
	}

	public function render($images, $options, $shortcode = false) {
		if(empty($images))
			return '';

		$this->add_script = true;

		$marginTop = 'margin-top:'.$options['marginTop'].'px;';
		$marginBottom = 'margin-bottom:'.$options['marginBottom'].'px;';
		$imageW = (int)$options['width'];
		$imageH = (int)$options['height'];

		if($options['fullWidth']){
			$sliderW = '';
			$sliderH ='';
		}else{
			$sliderW = 'width:'.$imageW.'px;';
			$sliderH = 'height:'.$imageH.'px;';
		}

		$options['touchenabled'] = $options['touchenabled'] ? 'on' : 'off';
		$options['stopOnHover'] = $options['stopOnHover'] ? 'on' : 'off';
		$options['shuffle'] = $options['shuffle'] ? 'on' : 'off';
		$options['stopLoop'] = $options['stopLoop'] ? 'on' : 'off';
		$options['fullWidth'] = $options['fullWidth'] ? 'on' : 'off';

		if($options['hidelayer']){
			$options['hidelayer'] = 480;
		}else{
			$options['hidelayer'] = 0;
		}

		if($options['stopAfterLoops'] == 0){
			$options['stopAfterLoops']= -1;
		}

		if($options['navi']){
			$options['navigationType'] = 'bullet';
			$options['navigationArrows'] = 'verticalcentered';
		}else{
			$options['navigationType'] = 'none';
			$options['navigationArrows'] = 'none';
		}
	
		/*$default_caption = $options['enableCaption'];
		$cposition = $options['captionPosition'];
		$cstyle = $options['captionStyle'];

		
		if(!empty($style)){
			$cstyle = str_replace(array(" ","\n","\r","\t"),'',$cstyle);
		}else{			
			$cstyle='';
		
		}*/

		$bartimer = '';
		if($options['bartimer']){
			$bartimer = '<div class="tp-bannertimer tp-'.$options['timerposi'].'"></div>';
		}

		$options = htmlspecialchars(json_encode($options));

		$output = <<<HTML
<div class="rev-slider-wrapper" >
<div class="rev-slider"  data-options="{$options}" style="display:none;{$sliderW}{$sliderH}">
<ul>	
HTML;

	foreach($images as $image) {
		if(!empty($image['post_id'])){
			$post_id = $image['post_id'];

			$transition = get_post_meta($post_id, '_res_transitions', true);
			$slotamount = get_post_meta($post_id, '_res_amount', true);
			$masterspeed = get_post_meta($post_id, '_res_transition_duration', true);
			$newdelay = get_post_meta($post_id,'_res_newdelay',true);
			$delay = get_post_meta($post_id, '_res_delay', true);
			$rotate = get_post_meta($post_id,'_res_rotation',true);

			
		}
		if(!empty($transition)){
			$transition = ' data-transition="'.$transition.'"';
		}else{
			$transition = ' data-transition="random"';
		}

		if(!empty($slotamount)){
			$slotamount = ' data-slotamount="'.$slotamount.'"';
		}else{
			$slotamount = ' data-slotamount="5"';
		}

		if(!empty($masterspeed)){
			$masterspeed = ' data-masterspeed="'.$masterspeed.'"';
		}else{
			$masterspeed = ' data-masterspeed="300"';
		}
	
		$delay = '';
		if($newdelay){
			if(!empty($delay)){
				$delay = ' data-delay="'.$delay.'"';
			}
		}

		if(!empty($rotate)){
			$rotate = ' data-rotate="'.$rotate.'"';
		}else{
			$rotate = '';
		}

		$image_src = theme_get_image_src($image['source'], array($imageW,$imageH));

		$link = '';
		$link_target = '';
		if(isset($image['link']) && $image['link'] != false){
			$link = ' data-link="'.$image['link'].'"';
			$link_target = ' data-target="'.$image['target'].'"';
		}

		/*$output .= '<li '.$transition.$slotamount.$masterspeed.$delay.$rotate.$link.$link_target.'>';*/
		$output .= '<li '.$transition.$slotamount.$masterspeed.$delay.$rotate.$link.$link_target.'>';
		$output .= '<img src="'.$image_src.'" alt="'.$image['title'].'" />';

		$fullvideo = get_post_meta($post_id, '_res_enable_fullvideo', true);
		/*if($fullvideo){
			$video_id = get_post_meta($post_id, '_res_video_id', true);
			if(!empty($video_id)){
				$video_type = get_post_meta($post_id, '_res_video_type', true);
				$video_auto = get_post_meta($post_id, '_res_full_video_auto', true);
				if($video_type =='youtube'){
					$video_src = 'http://www.youtube.com/embed/'.$video_id.'?hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0;rel=0;';
				}else if($video_type =='vimeo'){
					$video_src = 'http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0;api=1';
				}
				$output .='<div class="tp-caption fade fullscreenvideo" data-autoplay="'.$video_auto.'" data-x="0" data-y="0" data-speed="500" data-start="10" data-easing="easeOutBack"><iframe src="'.$video_src.'" width="100%" height="100%"></iframe></div>';
			}	
		}*/

		if(isset($image['type']) && !empty($image['post_id']) && $image['type']=='slideshow'){
			$query = array(
				'post_type' => 'layer',
				'meta_key'=>'_layer_index',
				'orderby' => 'meta_value',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'slide_id',
						'value' => $image['post_id'],
					),
					array(
						'key'=>'_layer_active',
						'value'=>'1'
					),
					array(
						'key'=>'_layer_content',
						'value'=>'',
						'compare'=>'!='
					),
				)
			);
			$r = new WP_Query($query);
			

			while($r->have_posts()) {
				$r->the_post();
				$layer_id = get_the_ID();
				$layer_metas = get_post_meta($layer_id);

				$layer_opts = array();

				foreach ($layer_metas as $key => $value) {
					$layer_opts[substr($key,1)] = $value[0];
				}

				extract($layer_opts);
				

				if(!empty($layer_top)){
					$layer_top = $imageH * (float)$layer_top / 100;
				}else{
					$layer_top = '';
				}

				if(!empty($layer_left)){
					$layer_left = $imageW * (float)$layer_left / 100;
				}else{
					$layer_left = 0;
				}

				if(empty($layer_animate)){
					$layer_animate = 'fade';
				}
				if(empty($layer_class)){
					$layer_class = '';
				}


				if(empty($layer_start)){
					$layer_start = 0;
				}

				if(empty($layer_speed)){
					$layer_speed = 300;
				}

				if(empty($layer_easing)){
					$layer_easing = 'easeOutExpo';
				}

				$layer_content = do_shortcode(stripslashes($layer_content));
				


				$output .= '<div class="tp-caption '.$layer_animate.' '.$layer_class.'"  data-x="'.$layer_left.'" data-y="'.$layer_top.'" data-speed="'.$layer_speed.'" data-start="'.$layer_start.'" data-easing="'.$layer_easing.'"  >'.$layer_content.'</div>'; 
			}
		/*}else if( $default_caption){
			$positionX='data-x="" ';
			$positionY='data-y="" ';
			switch ($cposition) {
				case 'left':
					$positionX='data-x="0"';
					break;
				
				default:
					// code...
					break;
			}
			$output .= '<div style="'.$cstyle.'" class="tp-caption default-caption '.$cposition.' fade" '.$positionX.$positionY.' data-speed="500" data-start="0" data-easing="easeOutBack">'.$image['desc'].'</div>';*/
		}
		
		$output .= '</li>';
	}

	$output .= <<<HTML
</ul>

{$bartimer}
</div>
</div>
HTML;
		return $output;
	}

}
?>
