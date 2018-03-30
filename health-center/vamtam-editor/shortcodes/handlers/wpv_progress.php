<?php

class WPV_Progress {
	public function __construct() {
		add_shortcode('wpv_progress', array(__CLASS__, 'shortcode'));
	}

	public static function shortcode($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type' => 'percentage',
			'value' => 0,
			'percentage' => 0,
			'bar_color' => 'accent1',
			'track_color' => 'accent7',
			'value_color' => 'accent2',
		), $atts));

		if($type == 'percentage') {
			return '<div class="wpv-progress pie" data-percent="'.$percentage.'" data-bar-color="'.wpv_sanitize_accent($bar_color).'" data-track-color="'.wpv_sanitize_accent($track_color).'" style="color:'.wpv_sanitize_accent($value_color).'"><span>0</span>%</div>';
		} elseif($type == 'number') {
			return '<div class="wpv-progress number" data-number="'.$value.'" style="color:'.wpv_sanitize_accent($value_color).'"><span>0</span></div>';
		}

		return '';
	}
}

new WPV_Progress;
