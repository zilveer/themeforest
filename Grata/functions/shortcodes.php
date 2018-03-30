<?php

// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

$auto_open = FALSE;
$first_tab = FALSE;
$first_tab_title = FALSE;

class US_Shortcodes {

	public function __construct()
	{
		add_filter('the_content', array($this, 'paragraph_fix'));
		add_filter('the_content', array($this, 'a_to_img_magnific_pupup'));

		add_shortcode('cols', array($this, 'cols'));
		add_shortcode('one_half', array($this, 'one_half'));
		add_shortcode('one_third', array($this, 'one_third'));
		add_shortcode('two_third', array($this, 'two_third'));
		add_shortcode('one_quarter', array($this, 'one_quarter'));
		add_shortcode('three_quarter', array($this, 'three_quarter'));
		add_shortcode('one_fourth', array($this, 'one_fourth'));
		add_shortcode('three_fourth', array($this, 'three_fourth'));
		add_shortcode('one_fifth', array($this, 'one_fifth'));
		add_shortcode('two_fifth', array($this, 'two_fifth'));
		add_shortcode('three_fifth', array($this, 'three_fifth'));
		add_shortcode('four_fifth', array($this, 'four_fifth'));
		add_shortcode('one_sixth', array($this, 'one_sixth'));
		add_shortcode('five_sixth', array($this, 'five_sixth'));

		add_shortcode('button', array($this, 'button'));

		add_shortcode('tabs', array($this, 'tabs'));
		add_shortcode('accordion', array($this, 'accordion'));
		add_shortcode('toggle', array($this, 'toggle'));
		add_shortcode('item', array($this, 'item'));
		add_shortcode('item_title', array($this, 'item_title'));

		add_shortcode('separator', array($this, 'separator'));

		add_shortcode('icon', array($this, 'icon'));
		add_shortcode('iconbox', array($this, 'iconbox'));

		add_shortcode('testimonial', array($this, 'testimonial'));

		add_shortcode('team_member', array($this, 'team_member'));

		remove_shortcode('gallery');
		add_shortcode('gallery', array($this, 'gallery'));

		add_shortcode('portfolio', array($this, 'portfolio'));
		add_shortcode('blog', array($this, 'blog'));
		add_shortcode('horizontal_blocks', array($this, 'horizontal_blocks'));

		add_shortcode('mega_heading', array($this, 'mega_heading'));
		add_shortcode('heading_line', array($this, 'heading_line'));

		add_shortcode('contact_form', array($this, 'contact_form'));
		add_shortcode('bottom_buttons', array($this, 'bottom_buttons'));
		add_shortcode('offer', array($this, 'offer'));
		add_shortcode('shop', array($this, 'shop'));

		add_shortcode('link_block', array($this, 'link_block'));

		add_shortcode('vertical_blocks', array($this, 'vertical_blocks'));
		add_shortcode('left_block', array($this, 'left_block'));
		add_shortcode('right_block', array($this, 'right_block'));

		add_shortcode('paragraph_big', array($this, 'paragraph_big'));
		add_shortcode('highlight', array($this, 'highlight'));

		add_shortcode('pricing_table', array($this, 'pricing_table'));
		add_shortcode('pricing_column', array($this, 'pricing_column'));
		add_shortcode('pricing_row', array($this, 'pricing_row'));
		add_shortcode('pricing_footer', array($this, 'pricing_footer'));

		add_shortcode('responsive_video', array($this, 'responsive_video'));
		add_shortcode('clients', array($this, 'clients'));

		add_shortcode('actionbox', array($this, 'actionbox'));
		add_shortcode('counter', array($this, 'counter'));
		add_shortcode('social_links', array($this, 'social_links'));
		add_shortcode('message_box', array($this, 'message_box'));

		add_shortcode('gmaps', array($this, 'gmaps'));

		add_shortcode('simple_slider', array($this, 'simple_slider'));
		add_shortcode('simple_slide', array($this, 'simple_slide'));
	}

	public function paragraph_fix($content)
	{
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']',
			']<br>' => ']',
		);

		$content = strtr($content, $array);
		return $content;
	}

	public function a_to_img_magnific_pupup ($content)
	{
		$pattern = "/<a(.*?)href=('|\")([^>]*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
		$replacement = '<a$1ref="magnificPopup" href=$2$3.$4$5$6>';
		$content = preg_replace($pattern, $replacement, $content);

		return $content;
	}

	public function gmaps ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'address' => '',
				'latitude' => '',
				'longitude' => '',
				'marker' => '',
				'height' => 400,
				'zoom' => 13,
				'type' => 'ROADMAP',

			), $attributes);

		$map_id = rand(99999, 999999);

		if ($attributes['latitude'] != '' AND $attributes['longitude'] != '') {
			$map_location_options = 'latitude: "'.$attributes['latitude'].'", longitude: "'.$attributes['longitude'].'", ';
		} elseif ($attributes['address'] != '') {
			$map_location_options = 'address: "'.$attributes['address'].'", ';
		} else {
			return null;
		}

		$map_marker_options = '';
		if ($attributes['marker'] != '') {
			$map_marker_options = 'html: "'.$attributes['marker'].'", popup: true';
		}


		// It's the first shortcode on the page
		static $first_shortcode = TRUE;
		if ($first_shortcode){
			wp_enqueue_script('us-google-maps');
			wp_enqueue_script('us-gmap');
			$first_shortcode = FALSE;
		}

		$output = '<div class="w-map" id="map_'.$map_id.'" style="height: '.$attributes['height'].'px">
				<div class="w-map-h">

				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#map_'.$map_id.'").gMap({
						'.$map_location_options.'
						zoom: '.$attributes['zoom'].',
						maptype: "'.$attributes['type'].'",
						markers:[
							{
								'.$map_location_options.$map_marker_options.'

							}
						]
					});
				});
			</script>';

		return $output;
	}

	public function actionbox($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'color' => '',
				'title' => 'ActionBox title',
				'description' => '',
				'btn_label' => '',
				'btn_link' => '',
				'btn_color' => 'text',
				'btn_size' => '',
				'btn_icon' => '',
				'btn_external' => '',
			), $attributes);

		$color_class = ($attributes['color'] != '')?' color_'.$attributes['color']:'';


		$output = 	'<div class="w-actionbox'.$color_class.'">'.
			'<div class="w-actionbox-text">';
		if ($attributes['title'] != '')
		{
			$output .= 			'<h3>'.html_entity_decode($attributes['title']).'</h3>';
		}
		if ($attributes['description'] != '')
		{
			$output .= 			'<p>'.html_entity_decode($attributes['description']).'</p>';
		}


		$output .=			'</div>'.
			'<div class="w-actionbox-controls">';

		if ($attributes['btn_label'] != '' AND $attributes['btn_link'] != '')
		{
			$colour_class = ($attributes['btn_color'] != '')?' color_'.$attributes['btn_color']:'';
			$size_class = ($attributes['btn_size'] != '')?' size_'.$attributes['btn_size']:'';
			$icon_part = ($attributes['btn_icon'] != '')?'<i class="fa fa-'.$attributes['btn_icon'].'"></i>':'';
			$external_part = ($attributes['btn_external'] == 1)?' target="_blank"':'';
			$output .= 			'<a class="w-actionbox-button g-btn'.$size_class.$colour_class.'" href="'.$attributes['btn_link'].'"'.$external_part.'><span>'.$icon_part.$attributes['btn_label'].'</span></a>';
		}

		$output .=			'</div>'.
			'</div>';
		return $output;
	}

	public function simple_slider($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'auto_scroll' => false,
				'interval' => 1,
				'type' => '',
				'arrows' => 1,
			), $attributes);

		$type_class = ' default';
		if (in_array($attributes['type'], array('iphone_hor', 'ipad_hor', 'iphone_ver', 'ipad_ver', ))) {
			$type_class = ' '.$attributes['type'];
		}

		$auto_scroll = ($attributes['auto_scroll'] == 1 OR $attributes['auto_scroll'] == 'yes')?'1':'0';
		$arrows = ($attributes['arrows'] == 1 OR $attributes['arrows'] == 'yes')?'1':'0';
		$interval = intval($attributes['interval']);
		if ($interval < 1) {
			$interval = 1;
		}
		$interval = $interval*1000;

		$output =   '<div class="w-gallery type_slider'.$type_class.'">
						<div class="slides" data-autoPlay="'.$auto_scroll.'" data-autoPlaySpeed="'.$interval.'" data-arrows="'.$arrows.'">
							'.do_shortcode($content).'
						</div>
					</div>';

		return $output;
	}

	public function simple_slide($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'img' => '',
			), $attributes);



		$output = 	'<div><img src="'.$attributes['img'].'" alt=""></div>';


		return $output;
	}

	public function counter ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'count' => '99',
				'suffix' => '',
				'prefix' => '',
				'title' => '',
				'color' => '',
				'size' => 'medium',
			), $attributes);

		if  (! in_array($attributes['size'], array('small', 'medium', 'big'))) {
			$attributes['size'] = 'medium';
		}
		$color_class = ($attributes['color'] != '')?' color_'.$attributes['color']:'';

		$output = 	'<div class="w-counter size_'.$attributes['size'].$color_class.'" data-count="'.$attributes['count'].'" data-prefix="'.$attributes['prefix'].'" data-suffix="'.$attributes['suffix'].'">
						<div class="w-counter-h">
							<div class="w-counter-number">'.$attributes['prefix'].$attributes['count'].$attributes['suffix'].'</div>
							<h5 class="w-counter-title">'.$attributes['title'].'</h5>
						</div>
					</div>';

		return $output;

	}

	public function responsive_video ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'link' => 'http://vimeo.com/23237102',
			), $attributes);

		$regexes = array (
			array (
				'regex' => '/^http(?:s)?:\/\/(?:.*?)\.?youtube\.com\/(watch\?[^#]*v=(\w+)).*$/i',
				'provider' => 'youtube',
				'id' => 2,
			),
			array (
				'regex' => '/^http(?:s)?:\/\/(?:.*?)\.?youtu\.be\/(\w+).*$/i',
				'provider' => 'youtube',
				'id' => 1,
			),
			array (
				'regex' => '/^http(?:s)?:\/\/(?:.*?)\.?vimeo\.com\/(\d+).*$/i',
				'provider' => 'vimeo',
				'id' => 1,
			),
		);
		$result = false;

		foreach ($regexes as $regex) {
			if (preg_match($regex['regex'], $attributes['link'], $matches)) {
				$result = array ('provider' => $regex['provider'], 'id' => $matches[$regex['id']]);
			}
		}

		if ($result) {
			if ($result['provider'] == 'youtube') {
				$output = '<div class="w-video"><div class="w-video-h"><iframe width="420" height="315" src="//www.youtube.com/embed/' . $result['id'] . '" frameborder="0" allowfullscreen></iframe></div></div>';
			} elseif ($result['provider'] == 'vimeo') {
				$output = '<div class="w-video"><div class="w-video-h"><iframe src="//player.vimeo.com/video/' . $result['id'] . '?byline=0&amp;color=cc2200" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
			}
		} else {
			global $wp_embed;
			$embed = $wp_embed->run_shortcode('[embed]'.$attributes['link'].'[/embed]');

			$output = '<div class="w-video"><div class="w-video-h">' . $embed . '</div></div>';
		}

		return $output;
	}

	public function pricing_table($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="w-pricing">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function pricing_column($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'type' => '',
				'price' => '',
				'time' => '',
			), $attributes);

		$featured_class = ($attributes['type'] == 'featured')?' type_featured':'';

		$output = 	'<div class="w-pricing-item'.$featured_class.'"><div class="w-pricing-item-h">
						<div class="w-pricing-item-header">
							<div class="w-pricing-item-title"><h5>'.$attributes['title'].'</h5></div>
							<div class="w-pricing-item-price"><span>'.$attributes['price'].'</span><small>'.$attributes['time'].'</small></div>
						</div>
						<ul class="w-pricing-item-features">'.
			do_shortcode($content).
			'</div></div>';

		return $output;
	}

	public function pricing_row($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = 	'<li class="w-pricing-item-feature">'.do_shortcode($content).'</li>';

		return $output;

	}

	public function pricing_footer($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'url' => '',
				'color' => 'text',
				'outlined' => false,
				'size' => '',
				'icon' => '',
			), $attributes);

		if ($attributes['url'] == '') $attributes['url'] = 'javascript:void(0)';
		$outlined_class = ($attributes['outlined'] == 1 OR $attributes['outlined'] == 'yes')?' outlined':'';

		$output = 	'</ul>
					<div class="w-pricing-item-footer">
						<a class="w-pricing-item-footer-button g-btn'.$outlined_class;
		$output .= ($attributes['color'] != '')?' color_'.$attributes['color']:'';
		$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$output .= '" href="'.$attributes['url'].'"><span>'.do_shortcode($content).'</span></a>
					</div>';

		return $output;

	}

	public function tabs($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		global $first_tab, $first_tab_title, $auto_open, $is_tabs;
		$auto_open = TRUE;
		$first_tab_title = TRUE;
		$first_tab = TRUE;
		$is_tabs = TRUE;

		$content_titles = str_replace('[item', '[item_title', $content);
		$content_titles = str_replace('[/item', '[/item_title', $content_titles);

		$output = '<div class="w-tabs"><div class="w-tabs-list">'.do_shortcode($content_titles).'</div>'.do_shortcode($content).'</div>';

		$auto_open = FALSE;
		$first_tab_title = FALSE;
		$first_tab = FALSE;
		$is_tabs = FALSE;

		return $output;
	}

	public function accordion($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'title_align' => '',
			), $attributes);

		global $first_tab, $first_tab_title, $auto_open;
		$auto_open = TRUE;
		$first_tab_title = TRUE;
		$first_tab = TRUE;

		$title_align_class = ($attributes['title_align'] == 'center')?' title_center':'';

		$output = '<div class="w-tabs layout_accordion'.$title_align_class.'">'.do_shortcode($content).'</div>';

		$auto_open = FALSE;
		$first_tab_title = FALSE;
		$first_tab = FALSE;

		return $output;
	}

	public function item_title($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'icon' => '',
				'bg_color' => '',
				'text_color' => '',
			), $attributes);

		$item_style = $item_custom_class = '';
		if ($attributes['bg_color'] != '') {
			$item_style .= 'background-color: '.$attributes['bg_color'].';';
		}
		if ($attributes['text_color'] != '') {
			$item_style .= ' color: '.$attributes['text_color'].';';
		}
		if ($item_style != '') {
			$item_style = ' style="'.$item_style.'"';
			$item_custom_class = ' color_custom';
		}

		$active_class = ($attributes['open'])?' active':'';

		$icon_class = ($attributes['icon'] != '')?' fa fa-'.$attributes['icon']:'';
		$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

		$output = 	'<div class="w-tabs-item'.$active_class.$item_icon_class.$item_custom_class.'"'.$item_style.'>'.
						'<div class="w-tabs-item-h">'.
							'<span class="w-tabs-item-icon"><i class="'.$icon_class.'"></i></span>'.
							'<span class="w-tabs-item-title">'.$attributes['title'].'</span>'.
						'</div>'.
					'</div>';

		return $output;
	}

	public function item($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'title' => '',
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'icon' => '',
				'bg_color' => '',
				'text_color' => '',
				'no_indents' => '',
			), $attributes);

		global $is_tabs;

		$item_style = $item_custom_class = '';
		if ( ! $is_tabs) {
			if ($attributes['bg_color'] != '') {
				$item_style .= 'background-color: '.$attributes['bg_color'].';';
			}
			if ($attributes['text_color'] != '') {
				$item_style .= ' color: '.$attributes['text_color'].';';
			}
			if ($item_style != '') {
				$item_style = ' style="'.$item_style.'"';
				$item_custom_class = ' color_custom';
			}
		}


		$active_class = ($attributes['open'])?' active':'';
		$no_indents_class = ($attributes['no_indents'])?' no_indents':'';

		$icon_class = ($attributes['icon'] != '')?' fa fa-'.$attributes['icon']:'';
		$item_icon_class = ($attributes['icon'] != '')?' with_icon':'';

		$output = 	'<div class="w-tabs-section'.$active_class.$item_icon_class.$item_custom_class.$no_indents_class.'"'.$item_style.'>'.
			'<div class="w-tabs-section-header">'.
			'<span class="w-tabs-section-icon"><i class="'.$icon_class.'"></i></span>'.
			'<h4 class="w-tabs-section-title">'.$attributes['title'].'</h4>'.
			'<span class="w-tabs-section-control"><i class="fa fa-angle-down"></i></span>'.
			'</div>'.
			'<div class="w-tabs-section-content">'.
			'<div class="w-tabs-section-content-h">'.do_shortcode($content).'</div>'.
			'</div>'.
			'</div>';

		return $output;
	}

	public function toggle($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'open' => (@in_array('open', $attributes) OR (isset($attributes['open']) AND $attributes['open'] == 1)),
				'title_align' => '',
			), $attributes);

		$title_align_class = ($attributes['title_align'] == 'center')?' title_center':'';

		$output = 	'<div class="w-tabs layout_accordion type_toggle'.$title_align_class.'">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function paragraph_big($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'align' => '',
			), $attributes);

		$align_class = ($attributes['align'] != '')?' align_'.$attributes['align']:'';

		$output = '<p class="size_big'.$align_class.'">'.do_shortcode($content).'</p>';

		return $output;
	}

	public function highlight($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'color' => '',
			), $attributes);

		$type_class = ($attributes['color'] != '')?' highlight_'.$attributes['color']:'';

		$output = '<span class="highlight'.$type_class.'">'.do_shortcode($content).'</span>';

		return $output;
	}

	public function mega_heading($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'align' => '',
			), $attributes);
		$align_class = ($attributes['align'] != '')?' align_'.$attributes['align']:'';

		$output = 	'<h1 class="mega-heading'.$align_class.'">';
		$output .= 	do_shortcode($content);
		$output .= 	'</h1>';

		return $output;
	}

	public function heading_line($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'color' => '',
				'new_line' => '0',
				'bold' => '0',
			), $attributes);

		$type_class = ($attributes['color'] != '')?' highlight_'.$attributes['color']:'';
		$type_class .= ($attributes['bold'] == '1')?' bold':'';


		$output = 	'';
		if ($attributes['new_line'] == '1') {
			$output .= 		'<br>';
		}
		$output .= 		'<span class="mega-heading-line'.$type_class.'">'.do_shortcode($content).'</span>';

		return $output;
	}

	public function cols ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'offset' => '',
			), $attributes);

		$offset_class = ($attributes['offset'] != '')?' offset_'.$attributes['offset']:' offset_default';

		$output = '<div class="g-cols'.$offset_class.'">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function one_half ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="one-half">'.do_shortcode($content).'</div>';

		return $output;
	}

	public function one_third ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(

			), $attributes);

		$output = '<div class="one-third">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function two_third ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(

			), $attributes);

		$output = '<div class="two-thirds">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_quarter ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(

			), $attributes);

		$output = '<div class="one-quarter">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function three_quarter ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(

			), $attributes);

		$output = '<div class="three-quarters">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_fourth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(

			), $attributes);

		$output = '<div class="one-quarter">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function three_fourth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="three-quarters">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_fifth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="one-fifth">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function two_fifth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="two-fifths">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function three_fifth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="three-fifths">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function four_fifth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="four-fifths">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function one_sixth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="one-sixth">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function five_sixth ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
			), $attributes);

		$output = '<div class="five-sixths">'.do_shortcode($content).'</div>';

		return $output;

	}

	public function contact_form($attributes, $content = null)
	{
		global $smof_data;
		$attributes = shortcode_atts(
			array(
				'btn_color' => 'primary',
				'btn_align' => '',
			), $attributes);

		$colors = array (
			'primary' => 'Primary (theme color)',
			'secondary' => 'Secondary (theme color)',
			'text' => 'Text (theme color)',
			'faded' => 'Faded (theme color)',
			'white' => 'White',
			'red' => 'Red',
			'blue' => 'Blue',
			'green' => 'Green',
			'yellow' => 'Yellow',
			'purple' => 'Purple',
			'pink' => 'Pink',
			'navy' => 'Navy',
			'brown' => 'Brown',
			'midnight' => 'Midnight',
			'teal' => 'Teal',
			'cream' => 'Cream',
			'lime' => 'Lime',
		);

		$colors = array_flip($colors);

		$alignment = array (
			'left' => 'Left',
			'center' => 'Center',
			'right' => 'Right',
		);

		$alignment = array_flip($alignment);

		$btn_color_class = ($smof_data['contact_form_button_color'] != '')?' color_'.@$colors[$smof_data['contact_form_button_color']]:'';
		$btn_align_class = ($smof_data['contact_form_button_align'] != '')?' align_'.@$alignment[$smof_data['contact_form_button_align']]:'';
		$outlined_class = (@$smof_data['contact_form_button_outlined'] == 1)?' outlined':'';
		$btn_text =  (@$smof_data['contact_form_button_text'] != '')?$smof_data['contact_form_button_text']:__('Send Message', 'us');

		$use_mailchimp = (@$smof_data['contact_form_mailchimp'] == 1 AND @$smof_data['contact_form_mailchimp_api_key'] != '' AND @$smof_data['contact_form_mailchimp_list_id'] != '')?1:0;

		$output = 	'<div class="w-form'.$btn_align_class.'">
						<form action="" method="post" id="contact_form" class="contact_form">';
		if (in_array(@$smof_data['contact_form_name_field'], array('Shown, required', 'Shown, not required'))  OR $use_mailchimp)
		{
			$name_required = (@$smof_data['contact_form_name_field'] == 'Shown, required'  OR $use_mailchimp)?1:0;
			$name_required_label = '';
			if ($name_required) {
				$name_required_label = ' *';
			}
			$output .= 		'<div class="w-form-row" id="name_row">
								<div class="w-form-label">
									<label for="name">'.__('Your name', 'us').$name_required_label.'</label>
								</div>
								<div class="w-form-field">
									<input id="name" type="text" name="name" data-required="'.$name_required.'" placeholder="'.__('Your name', 'us').$name_required_label.'">
									<i class="fa fa-user"></i>
								</div>
								<div class="w-form-state" id="name_state"></div>
							</div>';
		}

		if (in_array(@$smof_data['contact_form_email_field'], array('Shown, required', 'Shown, not required'))  OR $use_mailchimp)
		{
			$email_required = (@$smof_data['contact_form_email_field'] == 'Shown, required'  OR $use_mailchimp)?1:0;
			$email_required_label = '';
			if ($email_required) {
				$email_required_label = ' *';
			}
			$output .= 		'<div class="w-form-row" id="email_row">
								<div class="w-form-label">
									<label for="email">'.__('Email', 'us').$email_required_label.'</label>
								</div>
								<div class="w-form-field">
									<input id="email" type="email" name="email" data-required="'.$email_required.'" placeholder="'.__('Email', 'us').$email_required_label.'">
									<i class="fa fa-envelope"></i>
								</div>
								<div class="w-form-state" id="email_state"></div>
							</div>';
		}
		if ( ! $use_mailchimp) {
			if (in_array(@$smof_data['contact_form_phone_field'], array('Shown, required', 'Shown, not required')))
			{
				$phone_required = (@$smof_data['contact_form_phone_field'] == 'Shown, required')?1:0;
				$phone_required_label = '';
				if ($phone_required) {
					$phone_required_label = ' *';
				}
				$output .= 		'<div class="w-form-row" id="phone_row">
								<div class="w-form-label">
									<label for="phone">'.__('Phone Number', 'us').$phone_required_label.'</label>
								</div>
								<div class="w-form-field">
									<input id="phone" type="text" name="phone" data-required="'.$phone_required.'" placeholder="'.__('Phone Number', 'us').$phone_required_label.'">
									<i class="fa fa-phone"></i>
								</div>
								<div class="w-form-state" id="phone_state"></div>
							</div>';
			}

			if (in_array(@$smof_data['contact_form_message_field'], array('Shown, required', 'Shown, not required')))
			{
				$message_required = (@$smof_data['contact_form_message_field'] == 'Shown, required')?1:0;
				$message_required_label = '';
				if ($message_required) {
					$message_required_label = ' *';
				}
				$output .= 		'<div class="w-form-row" id="message_row">
								<div class="w-form-label">
									<label for="message">'.__('Message', 'us').$message_required_label.'</label>
								</div>
								<div class="w-form-field">
									<textarea id="message" name="message" cols="30" rows="10" data-required="'.$message_required.'" placeholder="'.__('Message', 'us').$message_required_label.'"></textarea>
									<i class="fa fa-pencil"></i>
								</div>
								<div class="w-form-state" id="message_state"></div>
							</div>';
			}
		}

		$output .= 			'<div class="w-form-row for_submit">
								<div class="w-form-field">
									<button class="g-btn '.$btn_color_class.$outlined_class.'" id="message_send"><i class="fa fa-spinner fa-spin"></i><span>'.$btn_text.'</span></button>
									<div class="w-form-field-success"></div>
								</div>
							</div>
						</form>
					</div>';

		return $output;
	}

	public function portfolio($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'style' => false,
				'align' => false,
				'items_bg_color' => false,
				'items_text_color' => false,
				'pagination' => false,
				'filters' => false,
				'columns' => 3,
				'category' => null,
				'items' => null,
				'ratio' => '3:2',
				'indents' => false,
				'meta' => false,
			), $attributes);

		if ( ! in_array($attributes['columns'], array(2,3,4,5)))
		{
			$attributes['columns'] = 3;
		}

		if ( ! in_array($attributes['ratio'], array('3:2','4:3','1:1', '2:3', '3:4',)))
		{
			$attributes['ratio'] = '3:2';
		}

		if ( ! in_array($attributes['style'], array('type_1','type_2','type_3','type_4','type_5','type_6',)))
		{
			$attributes['style'] = 'type_1';
		}

		if ( ! in_array($attributes['align'], array('left','right','center',)))
		{
			$attributes['align'] = 'center';
		}

		$items_style = '';
		if ($attributes['items_bg_color'] != '') {
			$items_style .= 'background-color: '.$attributes['items_bg_color'].';';
		}
		if ($attributes['items_text_color'] != '') {
			$items_style .= ' color: '.$attributes['items_text_color'].';';
		}
		if ($items_style != '') {
			$items_style = ' style="'.$items_style.'"';
		}

		$attributes['ratio'] = str_replace(':', '-', $attributes['ratio']);

		global $wp_query;

		$attributes['items'] = intval($attributes['items']);
		$portfolio_items = (is_integer($attributes['items']) AND $attributes['items'] > 0)?$attributes['items']:$attributes['columns'];
		if ($attributes['pagination'] == 1 OR $attributes['pagination'] == 'yes') {
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		} else {
			$paged = 1;
		}
		$args = array(
			'post_type' 		=> 'us_portfolio',
			'posts_per_page' 	=> $portfolio_items,
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'paged' 			=> $paged
		);

		$filters_html = $sortable_class = '';
		$categories_slugs = null;

		if ( ! empty($attributes['category'])) {

			$categories_slugs = explode(',', $attributes['category']);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'us_portfolio_category',
					'field' => 'slug',
					'terms' => $categories_slugs
				)
			);
		}

		if ($attributes['filters'] == 1 OR $attributes['filters'] == 'yes') {
			$categories = get_terms('us_portfolio_category');

			if ( ! empty($categories_slugs))
			{
				foreach ($categories as $cat_id => $category)
				{
					if ( ! in_array($category->slug, $categories_slugs)) {
						unset($categories[$cat_id]);
					}
				}
			}

			if (count($categories) > 1) {
				$filters_html .= '<div class="w-filter">
								<div class="w-filter-list">
									<div class="w-filter-item active">
										<a class="w-filter-link" href="javascript:void(0);" data-filter="*">'.__('View all', 'us').'</a>
									</div>';
				foreach($categories as $category) {
					$filters_html .= '<div class="w-filter-item">
									<a class="w-filter-link" href="javascript:void(0);" data-filter=".'.$category->slug.'">'.$category->name.'</a>
								</div>';
				}
				$filters_html .= '</div>
						</div>';
			}
		}

		if ($filters_html != '') {
			$sortable_class = ' type_sortable';
		}

		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query($args);

		$portfolio_order_counter = 0;

		$indents_class = ($attributes['indents'] == 1 OR $attributes['indents'] == 'yes')?' with_indents':'';

		$output = 	'<div class="w-portfolio '.$attributes['style'].' align_'.$attributes['align'].' columns_'.$attributes['columns'].' ratio_'.$attributes['ratio'].$sortable_class.$indents_class.'">'.$filters_html.
						'<div class="w-portfolio-list">';
		while($wp_query->have_posts())
		{
			$wp_query->the_post();
			$post = get_post();

			$link = 'javascript:void(0);';
			$link_class = $link_target = '';
			$link_tag = 'div';

			if (rwmb_meta('us_custom_link') != '')
			{
				$link = rwmb_meta('us_custom_link');
				$link_class = ' external-link';
				if (rwmb_meta('us_custom_link_blank') == 1)
				{
					$link_target = ' target="_blank"';
				}
				$link_tag = 'a';
			}


			$additional_class = '';
			if (rwmb_meta('us_additional_class') != '') {
				$additional_class = ' '.rwmb_meta('us_additional_class');
			}

			if (has_post_thumbnail()) {
				$the_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-list-'.$attributes['ratio']);
				$the_thumbnail = $the_thumbnail[0];
				$the_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$the_image = '<img src="'.$the_image[0].'" alt="">';
			} else {
				$the_thumbnail =  get_template_directory_uri() .'/img/placeholder/500x500.gif';
				$the_image = '<img src="'.get_template_directory_uri().'/img/placeholder/1200x800.gif" alt="">';
			}

			$item_categories_links = $item_categories_classes = '';
			$item_categories = get_the_terms(get_the_ID(), 'us_portfolio_category');
			if (is_array($item_categories))
			{
				$i = 0;
				foreach ($item_categories as $item_category)
				{
					$i++;
					$item_categories_links .= $item_category->name;
					if ($i < count($item_categories)) {
						$item_categories_links .= ' / ';
						$item_categories_classes .= ' '.$item_category->slug;
					}
					$item_categories_classes .= ' '.$item_category->slug;
				}
			}

			$meta_html = '';

			if ($attributes['meta'] == 'date') {
				$meta_html = get_the_date();
			} elseif ($attributes['meta'] == 'category') {
				$meta_html = $item_categories_links;
			}

			$output .= 	'<div class="w-portfolio-item'.$additional_class.$item_categories_classes.'">
							<div class="w-portfolio-item-h">
								<'.$link_tag.' class="w-portfolio-item-anchor'.$link_class.'" href="'.$link.'" data-id="'.$post->ID.'"'.$link_target.$items_style.'>
									<div class="w-portfolio-item-image"><img src="'.$the_thumbnail.'" alt="'.get_the_title().'"></div>
									<div class="w-portfolio-item-meta">
										<div class="w-portfolio-item-meta-h">
											<h2 class="w-portfolio-item-title">'.get_the_title().'</h2>
											<span class="w-portfolio-item-text">'.$meta_html.'</span>
										</div>
									</div>
								</'.$link_tag.'>
							</div>
						</div>';
		}
		$output .= '</div>';
		if ($attributes['pagination'] == 1 OR $attributes['pagination'] == 'yes') {
			$output .= '<div class="w-portfolio-pagination">
						'.get_the_posts_pagination( array(
					'prev_text' => '<',
					'next_text' => '>',
					'before_page_number' => '<span>',
					'after_page_number' => '</span>',
				) ).'
				</div>';
		}
		$output .= '</div>';
		wp_reset_postdata();
		$wp_query= $temp;

		return $output;
	}

	public function blog($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'pagination' => false,
				'type' => 'square',
				'show_date' => null,
				'show_author' => null,
				'show_categories' => null,
				'show_tags' => null,
				'show_comments' => null,
				'show_read_more' => null,
				'category' => null,
				'items' => null,
				'columns' => null,
			), $attributes);

		$blog_thumbnails = array(
			'square' => 'blog-list','rounded' => 'blog-list','masonry' => 'blog-grid'
		);

		if ( ! in_array($attributes['type'], array('square','rounded','masonry')))
		{
			$attributes['type'] = 'square';
		}

		if ( ! in_array($attributes['columns'], array(1,2,3)))
		{
			$attributes['columns'] = 1;
		}

		if ($attributes['pagination'] == 1 OR $attributes['pagination'] == 'yes' OR $attributes['pagination'] == 'regular') {
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		} else {
			$paged = 1;
		}

		$args = array(
			'post_type' 		=> 'post',
			'post_status' 		=> 'publish',
			'orderby' 			=> 'date',
			'order' 			=> 'DESC',
			'paged' 			=> $paged
		);

		$categories_slugs = null;

		if ( ! empty($attributes['category']))
		{
			$categories_slugs = explode(',', $attributes['category']);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $categories_slugs
				)
			);
		}

		$attributes['items'] = intval($attributes['items']);
		if (is_integer($attributes['items']) AND $attributes['items'] > 0) {
			$args['posts_per_page'] = $attributes['items'];
		}

		$classes = 'w-blog columns_'.$attributes['columns'];

		switch ($attributes['type']) {
			case 'square': $classes .= ' imgpos_atleft';
				break;
			case 'rounded': $classes .= ' imgpos_atleft circle';
				break;
			case 'masonry': $classes .= ' imgpos_attop type_masonry';
				break;
		}

		$output = '<div class="'.$classes.'">
						<div class="w-blog-list">';


		global $wp_query;

		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query($args);

		$max_num_pages = $wp_query->max_num_pages;


		$us_thumbnail_size = $blog_thumbnails[$attributes['type']];
		if (empty($us_thumbnail_size))
		{
			$us_thumbnail_size = 'blog-list';
		}

		while ($wp_query->have_posts())
		{
			$wp_query->the_post();
			global $smof_data;

			$post_format = get_post_format()?get_post_format():'standard';

			global $post;

			$preview = (has_post_thumbnail())?get_the_post_thumbnail(get_the_ID(), $us_thumbnail_size):'';


			if (empty($preview) AND $us_thumbnail_size == 'blog-list')
			{
				$preview = '<img src="'.get_template_directory_uri().'/img/placeholder/500x500.gif" alt="">';
			}
			$output .= '<div class="' . join( ' ', get_post_class( 'w-blog-entry', null ) ) . '">
				<div class="w-blog-entry-h">
					<a class="w-blog-entry-link" href="'.get_permalink().'">';
			if ($preview) {
				$output .= '<span class="w-blog-entry-preview">'.$preview.'</span>';
			}

			$output .= '<h2 class="w-blog-entry-title"><span>'.get_the_title().'</span></h2>';

			$output .= '</a>
					<div class="w-blog-entry-body">
						<div class="w-blog-meta">';
			if ($attributes['show_date'] == 1 OR $attributes['show_date'] == 'yes') {
				$output .= '<div class="w-blog-meta-date">
								<i class="fa fa-clock-o"></i>
								<span>'.get_the_date().'</span>
							</div>';
			}
			if ($attributes['show_author'] == 1 OR $attributes['show_author'] == 'yes') {
				$output .= '<div class="w-blog-meta-author">
								<i class="fa fa-user"></i>';
				if (get_the_author_meta('url')) {
					$output .= '<a href="'.esc_url( get_the_author_meta('url') ).'">'.get_the_author().'</a>';
				} else {
					$output .= '<span>'.get_the_author().'</span>';
				}
				$output .= '</div>';
			}
			if ($attributes['show_categories'] == 1 OR $attributes['show_categories'] == 'yes') {
				$output .= '<div class="w-blog-meta-category">
								<i class="fa fa-folder-open"></i>';
				$categories = get_the_category();
				$categories_output = '';
				$separator = ', ';
				if($categories){
					foreach($categories as $category) {
						$categories_output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
					}
				}
				$output .= trim($categories_output, $separator).'
								</div>';
			}
			if ($attributes['show_tags'] == 1 OR $attributes['show_tags'] == 'yes') {
				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
					$output .= '<div class="w-blog-meta-tags">
									<i class="fa fa-tags"></i>';

					$tags_output = '';
					$separator = ', ';
					foreach($tags as $tag) {
						$tags_output .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>'.$separator;
					}

					$output .= trim($tags_output, $separator).'
									</div>';
				}
			}
			if ($attributes['show_comments'] == 1 OR $attributes['show_comments'] == 'yes') {

				if ( ! (get_comments_number() == 0 AND ! comments_open() AND ! pings_open())) {
					$output .= '<div class="w-blog-meta-comments">';
					$output .= '<i class="fa fa-comments"></i>';
					$number = get_comments_number();

					if ( 0 == $number ) {
						$comments_link = get_permalink() . '#respond';
					}
					else {
						$comments_link = esc_url(get_comments_link());
					}
					$output .= '<a href="'.$comments_link.'">';

					if ( $number > 1 )
						$output .= str_replace('%', number_format_i18n($number), __('% Comments', 'us'));
					elseif ( $number == 0 )
						$output .= __('No Comments', 'us');
					else // must be one
						$output .= __('1 Comment', 'us');
					$output .= '</a></div>';
				}

			}
			$output .= '</div>';

			$output .= '<div class="w-blog-entry-short">';

			$excerpt = get_the_excerpt();

			if (empty($excerpt)) {
				$excerpt = get_the_content(get_the_ID());
				$excerpt = do_shortcode($excerpt);

				$excerpt = apply_filters('the_excerpt', $excerpt);
				$excerpt = str_replace(']]>', ']]>', $excerpt);
				$excerpt_length = apply_filters('excerpt_length', 55);
				$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
				$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
			}

			$output .= $excerpt;

			$output .= '</div>';

			if ($attributes['show_read_more'] == 1 OR $attributes['show_read_more'] == 'yes') {
				$output .= '<a class="w-blog-entry-more g-btn color_faded outlined size_small" href="'.get_permalink().'"><span>'.__('Read More', 'us').'</span></a>';
			}

			$output .= '</div>
				</div>
			</div>';
		}

		$output .= '</div></div>';

		if ($max_num_pages > 1 AND $attributes['pagination'] == 'ajax') {
			$output .=
				'<script type="text/javascript">
var page = 1,
	max_page = '.$max_num_pages.'
jQuery(document).ready(function(){
	jQuery("#blog_load_more").click(function(){
		jQuery(".w-loadmore").addClass("loading");
		jQuery.ajax({
			type: "POST",
			url: "'.admin_url('admin-ajax.php').'",
			data: {
				action: "blogPagination",
				type: "'.$attributes['type'].'",
				show_date: "'.$attributes['show_date'].'",
				show_author: "'.$attributes['show_author'].'",
				show_comments: "'.$attributes['show_comments'].'",
				show_categories: "'.$attributes['show_categories'].'",
				show_tags: "'.$attributes['show_tags'].'",
				show_read_more: "'.$attributes['show_read_more'].'",
				category: "'.$attributes['category'].'",
				columns: "'.$attributes['columns'].'",
				items: "'.$attributes['items'].'",
				page: page+1
			},
			success: function(data, textStatus, XMLHttpRequest){
				page++;

				var newItems = jQuery("<div>", {html:data}),
					blogList = jQuery(".w-blog-list");'."\n";

			if ($attributes['type'] == 'masonry') {
				$output .= '           newItems.imagesLoaded(function() {
												newItems.children().each(function(childIndex,child){
													blogList.append(jQuery(child)).isotope("appended", jQuery(child));
													if (jQuery().fotorama){
														blogList.find(".fotorama").fotorama().on("fotorama:ready", function (e, fotorama) { blogList.isotope("layout"); });
													}
												});
											});';
			} else {
				$output .= '           newItems.children().each(function(childIndex,child){
												blogList.append(jQuery(child));
												if (jQuery().fotorama){
													blogList.find(".fotorama").fotorama();
												}
											});';
			}

			$output .= ' jQuery(".w-loadmore").removeClass("loading");

				if (max_page <= page) {
					jQuery(".w-loadmore").addClass("done");
				}

				jQuery(window).resize();
			},
			error: function(MLHttpRequest, textStatus, errorThrown){
				jQuery(".w-loadmore").removeClass("loading");
			}
		});
	});
});
</script>
<div class="w-loadmore">
	<a href="javascript:void(0);" id="blog_load_more" class="g-btn color_default size_small"><span>'.__('Load More Posts', 'us').'</span></a>
	<i class="fa fa-refresh fa-spin"></i>
</div>';
		} elseif ($attributes['pagination'] == 1 OR $attributes['pagination'] == 'yes' OR $attributes['pagination'] == 'regular') {
			$output .= '<div class="w-blog-pagination">
						'.get_the_posts_pagination( array(
					'prev_text' => '<',
					'next_text' => '>',
					'before_page_number' => '<span>',
					'after_page_number' => '</span>',
				) ).'
				</div>';
		}

		wp_reset_postdata();
		$wp_query= $temp;

		return $output;
	}

	public function clients($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'amount' => 1000,
				'auto_scroll' => false,
				'interval' => 1,
				'arrows' => 1,
			), $attributes);

		$args = array(
			'post_type' => 'us_client',
			'paged' => 1,
			'posts_per_page' => $attributes['amount'],
		);

		$cleints = new WP_Query($args);

		$arrows = ($attributes['arrows'] == 1 OR $attributes['arrows'] == 'yes')?'1':'0';
		$auto_scroll = ($attributes['auto_scroll'] == 1 OR $attributes['auto_scroll'] == 'yes')?'1':'0';
		$interval = intval($attributes['interval']);
		if ($interval < 1) {
			$interval = 1;
		}
		$interval = $interval*1000;

		$output = 	'<div class="w-clients">
						<div class="w-clients-list" data-autoPlay="'.$auto_scroll.'" data-autoPlaySpeed="'.$interval.'" data-arrows="'.$arrows.'">';

		while($cleints->have_posts())
		{
			$cleints->the_post();
			if(has_post_thumbnail())
			{
				if (rwmb_meta('us_client_url') != '')
				{
					$client_new_tab = (rwmb_meta('us_client_new_tab') == 1)?' target="_blank"':'';
					$client_url = (rwmb_meta('us_client_url') != '')?rwmb_meta('us_client_url'):'javascript:void(0);';

					$output .= 			'<div class="w-clients-item"><a class="w-clients-item-h" href="'.$client_url.'"'.$client_new_tab.'>'.
						get_the_post_thumbnail(get_the_ID(), 'client-logo').
						'</a></div>';
				}
				else
				{
					$output .= 			'<div class="w-clients-item"><span class="w-clients-item-h">'.
						get_the_post_thumbnail(get_the_ID(), 'client-logo').
						'</span></div>';
				}

			}
		}

		$output .=		'</div>
					</div>';
		return $output;
	}

	public function button($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'text' => '',
				'url' => '',
				'external' => '',
				'color' => 'text',
				'size' => '',
				'icon' => '',
				'outlined' => '',
			), $attributes);

		$icon_part = '';
		if ($attributes['icon'] != '') {
			$icon_part = '<i class="fa fa-'.$attributes['icon'].'"></i>';
		}

		$output = '<a href="'.$attributes['url'].'"';
		$output .= ($attributes['external'] == '1')?' target="_blank"':'';
		$output .= ' class="g-btn';
		$output .= ($attributes['color'] != '')?' color_'.$attributes['color']:'';
		$output .= ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$output .= ($attributes['outlined'] == 1 OR $attributes['outlined'] == 'yes')?' outlined':'';
		$output .= '">'.$icon_part.'<span>'.$attributes['text'].'</span></a>';

		return $output;
	}

	public function separator($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'type' => "",
				'size' => "",
				'icon' => "",
			), $attributes);

		$simple_class = '';
		if ($attributes['icon'] == '') {
			$simple_class = ' no_icon';
		}

		$type_class = ($attributes['type'] != '')?' type_'.$attributes['type']:'';
		$size_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';

		$output = 	'<div class="g-hr'.$type_class.$size_class.$simple_class.'">
						<span class="g-hr-h">
							<i class="fa fa-'.$attributes['icon'].'"></i>
						</span>
					</div>';

		return $output;
	}

	public function icon($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => "",
				'color' => "",
				'outline' => "",
				'size' => "",
				'outline' => "",
				'link' => "",
			), $attributes);

		$color_class = ($attributes['color'] != '')?' color_'.$attributes['color']:'';
		$size_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';
		$outline_class = '';
		if ($attributes['outline'] == 'square') {
			$outline_class = ' outline';
		}
		if ($attributes['outline'] == 'circle') {
			$outline_class = ' outline circle';
		}


		if ($attributes['link'] != '') {
			$link = $attributes['link'];
			$link_start = '<a class="w-icon-link" href="'.$link.'">';
			$link_end = '</a>';
		}
		else
		{
			$link_start = '<span class="w-icon-link">';
			$link_end = '</span>';
		}

		$output = 	'<span class="w-icon'.$color_class.$size_class.$outline_class.'">
						'.$link_start.'
							<i class="fa fa-'.$attributes['icon'].'"></i>
						'.$link_end.'
					</span>';

		return $output;
	}

	public function iconbox($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'icon' => '',
				'img' => '',
				'title' => '',
				'outline' => '',
				'color' => '',
				'link' => '',
				'pos' => 'top',
				'size' => 'small',
				'external' => '',

			), $attributes);

		$img_class = ($attributes['img'] != '')?' custom_img':'';
		$color_class = ($attributes['color'] != '')?' color_'.$attributes['color']:'';
		$outline_class = '';
		if ($attributes['outline'] == 'square') {
			$outline_class = ' outline';
		}
		if ($attributes['outline'] == 'circle') {
			$outline_class = ' outline circle';
		}
		$iconpos_class = ($attributes['pos'] != '')?' iconpos_'.$attributes['pos']:'';
		$iconsize_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';

		if ($attributes['link'] != '') {
			$link = $attributes['link'];
			$link_start = '<a class="w-iconbox-link" href="'.$link.'"';
			$link_start .= ($attributes['external'] == '1')?' target="_blank"':'';
			$link_start .= '>';
			$link_end = '</a>';
		}
		else
		{
			$link_start = '<div class="w-iconbox-link">';
			$link_end = '</div>';
		}

		$output =	'<div class="w-iconbox'.$img_class.$iconpos_class.$iconsize_class.$color_class.$outline_class.'">
						'.$link_start.'
						<div class="w-iconbox-icon">
							<i class="fa fa-'.$attributes['icon'].'"></i>';
		if ($attributes['img'] != '') {
			$output .=		'<img src="'.$attributes['img'].'" alt=""/>';
		}
		$output .=	'	</div>
						<h4 class="w-iconbox-title">'.$attributes['title'].'</h4>
						'.$link_end;

		if ($content != '') {
			$output .=	'<div class="w-iconbox-text">
							<p>'.do_shortcode($content).'</p>
						</div>';

		}

		$output .=	'</div>';


		return $output;
	}

	public function social_links($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'size' => '',
				'email' => '',
				'facebook' => '',
				'twitter' => '',
				'google' => '',
				'linkedin' => '',
				'youtube' => '',
				'vimeo' => '',
				'flickr' => '',
				'instagram' => '',
				'behance' => '',
				'pinterest' => '',
				'skype' => '',
				'tumblr' => '',
				'dribbble' => '',
				'vk' => '',
				'xing' => '',
				'twitch' => '',
				'yelp' => '',
				'soundcloud' => '',
				'deviantart' => '',
				'foursquare' => '',
				'github' => '',
				'rss' => '',
				'align' => '',
			), $attributes);

		$socials = array (
			'email' => 'Email',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'google' => 'Google+',
			'linkedin' => 'LinkedIn',
			'youtube' => 'YouTube',
			'vimeo' => 'Vimeo',
			'flickr' => 'Flickr',
			'instagram' => 'Instagram',
			'behance' => 'Behance',
			'pinterest' => 'Pinterest',
			'skype' => 'Skype',
			'tumblr' => 'Tumblr',
			'dribbble' => 'Dribbble',
			'vk' => 'Vkontakte',
			'xing' => 'Xing',
			'twitch' => 'Twitch',
			'yelp' => 'Yelp',
			'soundcloud' => 'SoundCloud',
			'deviantart' => 'DeviantArt',
			'foursquare' => 'Foursquare',
			'github' => 'GitHub',
			'rss' => 'RSS',
		);

		$align_class = ($attributes['align'] != '')?' align_'.$attributes['align']:'';
		$size_class = ($attributes['size'] != '')?' size_'.$attributes['size']:'';

		$output = '<div class="w-socials'.$size_class.$align_class.'">
			<div class="w-socials-list">';

		foreach ($socials as $social_key => $social)
		{
			if ($attributes[$social_key] != '')
			{
				if ($social_key == 'email')
				{
					$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" href="mailto:'.$attributes[$social_key].'">
						<i class="fa fa-envelope"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

				}
				elseif ($social_key == 'google')
				{
					$output .= '<div class="w-socials-item gplus">
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
						<i class="fa fa-google-plus"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

				}
				elseif ($social_key == 'youtube')
				{
					$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
						<i class="fa fa-youtube-play"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

				}
				elseif ($social_key == 'vimeo')
				{
					$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
						<i class="fa fa-vimeo-square"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';

				}
				else
				{
					$output .= '<div class="w-socials-item '.$social_key.'">
					<a class="w-socials-item-link" target="_blank" href="'.$attributes[$social_key].'">
						<i class="fa fa-'.$social_key.'"></i>
					</a>
					<div class="w-socials-item-popup"><span>'.$social.'</span></div>
					</div>';
				}

			}
		}

		$output .= '</div></div>';

		return $output;
	}

	public function testimonial($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'author' => '',
				'img' => '',
				'description' => '',

			), $attributes);

		$output = 	'<div class="w-testimonial">
						<p class="w-testimonial-content">'.do_shortcode($content).'</p>
						<div class="w-testimonial-person">
							<div class="w-testimonial-person-img">
								<span class="w-testimonial-person-img-h">';
		if ($attributes['img'] != '') {
			$output .= '<img src="'.$attributes['img'].'" alt="person">';
		} else {
			$output .= '<i class="fa fa-user"></i>';
		}

		$output .= '</span>
							</div>
							<div class="w-testimonial-person-text">
								<span class="w-testimonial-person-name">'.$attributes['author'].'</span>
								<span class="w-testimonial-person-desc">'.$attributes['description'].'</span>
							</div>
						</div>
					</div>';



		return $output;
	}

	public function message_box ($attributes, $content)
	{
		$attributes = shortcode_atts(
			array(
				'type' => 'info',
			), $attributes);

		$output = '<div class="g-alert with_close type_'.$attributes['type'].'"><div class="g-alert-close"> &#10005; </div><div class="g-alert-body"><p>'.do_shortcode($content).'</p></div></div>';

		return $output;
	}

	public function team_member ($attributes, $content = null)
	{
		$attributes = shortcode_atts(
			array(
				'name' => '',
				'role' => '',
				'img' => '',
				'email' => '',
				'facebook' => '',
				'twitter' => '',
				'linkedin' => '',
				'custom_icon' => '',
				'custom_link' => '',
				'link' => '',
				'external' => '',
				'style' => '',
				'rounded' => '',
			), $attributes);

		$external_part = ($attributes['external'] == 1)?' target="_blank"':'';
		$rounded_class = ($attributes['rounded'] == 1)?' img_circle':'';

		if ( ! in_array( $attributes['style'], array( 'type_1', 'type_2', 'type_3', 'type_4', ) ) ) {
			$attributes['style'] = 'type_1';
		}

		if ( is_numeric( $attributes['img'] ) ) {
			$img_id = preg_replace( '/[^\d]/', '', $attributes['img'] );
			$img = wp_get_attachment_image_src( $img_id, 'gallery-l' );

			if ( $img != NULL ) {
				$attributes['img'] = $img[0];
			}
		}

		if ( $attributes['img'] == NULL OR $attributes['img'] == '' ) {
			$attributes['img'] = get_template_directory_uri() . '/img/placeholder/500x500.gif';
		}

		$social_output = '';

		if ($attributes['facebook'] != '' OR $attributes['twitter'] != '' OR $attributes['linkedin'] != '' OR $attributes['email'] != '' OR ($attributes['custom_icon'] != '' AND $attributes['custom_link'] != ''))
		{
			$social_output .=		'<div class="w-team-links">
				<div class="w-team-links-list">';

			if ($attributes['email'] != '')
			{
				$social_output .= 			'<a class="w-team-links-item email" href="mailto:'.$attributes['email'].'" target="_blank"><i class="fa fa-envelope"></i></a>';
			}
			if ($attributes['facebook'] != '')
			{
				$social_output .= 			'<a class="w-team-links-item facebook" href="'.$attributes['facebook'].'" target="_blank"><i class="fa fa-facebook"></i></a>';
			}
			if ($attributes['twitter'] != '')
			{
				$social_output .= 			'<a class="w-team-links-item twitter" href="'.$attributes['twitter'].'" target="_blank"><i class="fa fa-twitter"></i></a>';
			}
			if ($attributes['linkedin'] != '')
			{
				$social_output .= 			'<a class="w-team-links-item linkedin" href="'.$attributes['linkedin'].'" target="_blank"><i class="fa fa-linkedin"></i></a>';
			}
			if ($attributes['custom_icon'] != '' AND $attributes['custom_link'] != '')
			{
				$social_output .= 			'<a class="w-team-links-item custom" href="'.$attributes['custom_link'].'" target="_blank"><i class="fa fa-'.$attributes['custom_icon'].'"></i></a>';
			}
			$social_output .=			'</div>'.
				'</div>';
		}

		$link_tag_open = '<span>';
		$link_tag_close = '</span>';
		if ($attributes['link'] != '') {
			$link_tag_open = '<a href="'.$attributes['link'].'"'.$external_part.'>';
			$link_tag_close = '</a>';
		}

		$output = 	'<div class="w-team '.$attributes['style'].$rounded_class.'">
						<div class="w-team-image">
							'.$link_tag_open.'
								<img src="'.$attributes['img'].'" alt="member photo" />
							'.$link_tag_close.'
							'.$social_output.'
						</div>
						<div class="w-team-content">
							'.$link_tag_open.'
								<h5 class="w-team-name">'.$attributes['name'].'</h5>
							'.$link_tag_close.'
							<div class="w-team-role">'.$attributes['role'].'</div>
							<div class="w-team-description">
								<p>'.do_shortcode($content).'</p>
							</div>
						</div>
					</div>';

		return $output;
	}

	public function gallery($attributes)
	{
		$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty($attributes['ids']))
		{
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if (empty($attributes['orderby']))
			{
				$attributes['orderby'] = 'post__in';
			}
			$attributes['include'] = $attributes['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if (isset($attributes['orderby']))
		{
			$attributes['orderby'] = sanitize_sql_orderby($attributes['orderby']);
			if ( !$attributes['orderby'])
			{
				unset($attributes['orderby']);
			}
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'include'    => '',
			'exclude'    => ''
		), $attributes));

		$columns_to_size = array(
			1 => 'l',
			2 => 'l',
			3 => 'l',
			4 => 'm',
			5 => 'm',
			6 => 'm',
			7 => 'm',
			8 => 's',
			9 => 's',
			10 => 's',
		);

		$size = 'gallery-'.$columns_to_size[$columns];
		$type_classes = ' columns_'.$columns;



		$id = intval($id);
		if ('RAND' == $order)
		{
			$orderby = 'none';
		}

		if ( !empty($include))
		{
			$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

			$attachments = array();
			if (is_array($_attachments))
			{
				foreach ($_attachments as $key => $val) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			}
		}
		elseif ( !empty($exclude))
		{
			$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
		}
		else
		{
			$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
		}

		if (empty($attachments))
		{
			return '';
		}

		if (is_feed())
		{
			$output = "\n";
			if (is_array($attachments))
			{
				foreach ($attachments as $att_id => $attachment)
					$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			}
			return $output;
		}

		$rand_id = rand(99999, 999999);

		$output = '<div id="gallery_'.$rand_id.'" class="w-gallery'.$type_classes.'"> <div class="w-gallery-tnails">';

		$i = 1;
		if (is_array($attachments))
		{
			foreach ($attachments as $id => $attachment) {

				$title = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
				if (empty($title))
				{
					$title = trim(strip_tags($attachment->post_excerpt)); // If not, Use the Caption
				}
				if (empty($title))
				{
					$title = trim(strip_tags($attachment->post_title)); // Finally, use the title
				}

				$output .= '<a class="w-gallery-tnail order_'.$i.'" href="'.wp_get_attachment_url($id).'" title="'.$title.'">';
				$output .= wp_get_attachment_image($id, $size, 0, array('class' => 'w-gallery-tnail-img'));
				$output .= '<span class="w-gallery-tnail-title"></span>';
				$output .= '</a>';

				$i++;

			}
		}

		$output .= "</div> </div>\n";



		return $output;
	}
}

global $us_shortcodes;

$us_shortcodes = new US_Shortcodes;

// Add buttons to tinyMCE
function us_add_buttons() {
	if (current_user_can('edit_posts') &&  current_user_can('edit_pages'))
	{
		add_filter('mce_external_plugins', 'us_tinymce_plugin');
		add_filter('mce_buttons_3', 'us_tinymce_buttons');
	}
}

function us_tinymce_buttons($buttons) {
	array_push($buttons, "columns", "typography", "separator_btn", "us_button", "icon", "iconbox", "tabs", "accordion", "toggle", "portfolio", "team_member", "blog", "testimonial", "clients", "simple_slider", "social_links", "actionbox", "pricing_table", "responsive_video", "contact_form", "gmaps", "message_box", "counter");
	return $buttons;
}

function us_tinymce_plugin($plugin_array) {
	$plugin_array['columns'] = get_template_directory_uri().'/functions/tinymce/buttons.js';

	$plugin_array['responsive_video'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['team_member'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['us_button'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['tabs'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['accordion'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['toggle'] = get_template_directory_uri().'/functions/tinymce/buttons.js';

	$plugin_array['separator_btn'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['icon'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['iconbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['testimonial'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['portfolio'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['blog'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['contact_form'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['typography'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['actionbox'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['pricing_table'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['social_links'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['gmaps'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['counter'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['message_box'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['clients'] = get_template_directory_uri().'/functions/tinymce/buttons.js';
	$plugin_array['simple_slider'] = get_template_directory_uri().'/functions/tinymce/buttons.js';

	return $plugin_array;
}

add_action('admin_init', 'us_add_buttons');
