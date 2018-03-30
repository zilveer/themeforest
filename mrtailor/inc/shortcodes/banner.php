<?php

// [banner]
function banner_simple_height($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Freeshipping on all order over $75',
		'subtitle' => 'Shop Now',
		'link_url' => '',
		'title_color' => '#fff',
		'subtitle_color' => '#fff',
		'inner_stroke' => '0px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'height' => 'auto',
		'sep_padding' => '5px',
		'sep_color' => 'rgba(255,255,255,0.01)',
		'with_bullet' => 'no',
		'bullet_text' => 'Bullet Text Goes Here',
		'bullet_bg_color' => '',
		'bullet_text_color' => ''
	), $params));
	
	$banner_with_img = '';
	
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
		$banner_with_img = 'banner_with_img';
	}
	
	$content = do_shortcode($content);
	
	$banner_simple_height = '
		<div class="shortcode_banner_simple_height '.$banner_with_img.'" onclick="location.href=\''.$link_url.'\';">
			<div class="shortcode_banner_simple_height_inner">
				<div class="shortcode_banner_simple_height_bkg" style="background-color:'.$bg_color.'; background-image:url('.$bg_image.')"></div>
			
				<div class="shortcode_banner_simple_height_inside" style="height:'.$height.'; border: '.$inner_stroke.' solid '.$inner_stroke_color.'">
					<div class="shortcode_banner_simple_height_content">
						<div><h3 style="color:'.$title_color.' !important">'.$title.'</h3></div>
						<div class="shortcode_banner_simple_height_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>
						<div><h4 style="color:'.$subtitle_color.' !important">'.$subtitle.'</h4></div>
					</div>
				</div>
			</div>';
	
	if ($with_bullet == 'yes') {
		$banner_simple_height .= '<div class="shortcode_banner_simple_height_bullet" style="background:'.$bullet_bg_color.'; color:'.$bullet_text_color.'"><span>'.$bullet_text.'</span></div>';
	}
	
	$banner_simple_height .= '</div>';
	
	return $banner_simple_height;
}

add_shortcode('banner', 'banner_simple_height');