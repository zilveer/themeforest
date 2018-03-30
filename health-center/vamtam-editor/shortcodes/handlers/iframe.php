<?php

class WPV_Iframe {
	public function __construct() {
		add_shortcode('iframe', array(&$this, 'iframe'));
	}

	public function iframe($atts, $content = null) {
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '400px',
			'src' => '',
			'source' => 'http://apple.com',
		), $atts));
		
		$style = array();

		if($width)
			$style[]= 'width:'.$width;
		if($height)
			$style[]= 'height:'.$height;
		
		return '<div class="frame-fl"><iframe src="'.$src.'" style="'.implode(';', $style).'" seamless="seamless"></iframe></div>';
	}
}

new WPV_Iframe;
