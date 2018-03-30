<?php

if(!function_exists('theme_shortcode_testimonials')){
function theme_shortcode_testimonials($atts, $content=null){
	extract(shortcode_atts(array(
		'autoplay' => 'true',
		'duration' => '4000',
		'class' => ''
	), $atts));
	
	// wp_enqueue_script( 'jquery-testimonials');
	$items = array();
	

	if (preg_match_all("/(.?)\[(testimonial)\b(.*?)(?:(\/))?\](?:(.+?)\[\/testimonial\])?(.?)/s", $content, $matches)) {
		for($i = 0; $i < count($matches[0]); $i++) {
			$options = theme_shortcode_parse_atts($matches[3][$i]);
			if(!isset($options['author'])){
				continue;
			}
			$avatar = '';
			if(isset($options['avatar_type']) && isset($options['avatar_value']) &&!empty($options['avatar_type']) && !empty($options['avatar_value'])){
				$avatar = theme_get_image_src(array(
					'type' => $options['avatar_type'],
					'value' => $options['avatar_value'],
				), array(60, 60));
			}
			if(empty($avatar)){
				$avatar = THEME_IMAGES.'/testimonial_avatar.png';
			}

			$item = array(
				'author'=> $options['author'],
				'content'=> do_shortcode($matches[5][$i]),
				'avatar' => $avatar,
			);

			if(isset($options['meta'])){
				$item['meta'] = $options['meta'];
			}
			if(isset($options['link'])){
				$item['link'] = $options['link'];
			}
			$items[] = $item;
		}
	}
	if(empty($items)) {
		return '';
	}

	$first = $items[0];

	if(isset($first['meta'])){
		if(isset($first['link'])){
			$meta_html = '<span class="testimonial_meta"><a href="'.$first['link'].'" rel="nofollow" target="_blank">'.$first['meta'].'</a></span>';
		} else {
			$meta_html = '<span class="testimonial_meta">'.$first['meta'].'</span>';
		}
	} else {
		$meta_html = '';
	}
	$id = md5(serialize($items));
	if($class){
		$class = ' '.$class;
	}

	$json_items = json_encode($items);
	return <<<HTML
<div class="testimonials{$class}" data-autoplay="{$autoplay}" data-duration="{$duration}" data-items="{$id}">
	<div class="testimonial">
		<div class="testimonial_content"><div>{$first['content']}</div></div>
		<div class="testimonial_author">
			<img class="testimonial_avatar" src="{$first['avatar']}" alt=""/>
			<span class="testimonial_name">{$first['author']}</span>
			{$meta_html}
		</div>
	</div>
	<div class="testimonial_nav">
        <a href="" class="testimonial_previous"></a>
        <a href="" class="testimonial_next"></a>
    </div>
<script type="text/javascript">
var testimonials_{$id} = {$json_items};
</script>
</div>
HTML;
}
}
add_shortcode('testimonials', 'theme_shortcode_testimonials');