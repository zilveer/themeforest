<?php

// [banner]
function banner_simple_height($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'subtitle' => 'Subtitle',
		'link_url' => '',
		'new_tab'  => '',
		'title_color' => '#fff',
		'subtitle_color' => '#fff',
		'inner_stroke' => '2px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'height' => 'auto',
		'sep_padding' => '5px',
		'sep_color' => '#fff',
		'with_bullet' => 'no',
		'bullet_text' => '',
		'bullet_bg_color' => '',
		'bullet_text_color' => ''
	), $params));
	
	$banner_with_img = '';
	
	if (is_numeric($bg_image)) {
		$bg_image = wp_get_attachment_url($bg_image);
		$banner_with_img = 'banner_with_img';
	}
	
	$content = do_shortcode($content);

	if ($new_tab == 'true')
	{
		$link_tab = 'onclick="window.open(\''.$link_url.'\', \'_blank\');"';
	}
	else 
	{
		$link_tab = 'onclick="location.href=\''.$link_url.'\';"';
	}
	
	$banner_simple_height = '
		<div class="shortcode_banner_simple_height '.$banner_with_img.'" '.$link_tab.'>
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