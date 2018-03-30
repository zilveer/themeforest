<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$css_rules = $animation_css = '';
$uniqid = uniqid('dfd-grad-bg-');
if(isset($dfd_bg_grad) && !empty($dfd_bg_grad)) {
	$css_rules = 'background: '.esc_js($dfd_bg_grad).';';

	if(isset($dfd_bg_grad_animate) && $dfd_bg_grad_animate == 'on') {
		$dfd_bg_grad_anim_duration = (isset($dfd_bg_grad_anim_duration) && $dfd_bg_grad_anim_duration != '') ? $dfd_bg_grad_anim_duration : 3000;
		$css_rules .= 'background-size: '.esc_attr($dfd_bg_grad_anim_duration/10).'% '.esc_attr($dfd_bg_grad_anim_duration/10).'%;';
		$css_rules .= '-webkit-animation: MoveBG '.esc_js($dfd_bg_grad_anim_duration / 1000).'s ease infinite;';
		$css_rules .= '-moz-animation: MoveBG '.esc_js($dfd_bg_grad_anim_duration / 1000).'s ease infinite;';
		$css_rules .= '-ms-animation: MoveBG '.esc_js($dfd_bg_grad_anim_duration / 1000).'s ease infinite;';
		$css_rules .= '-o-animation: MoveBG '.esc_js($dfd_bg_grad_anim_duration / 1000).'s ease infinite;';
		$css_rules .= 'animation: MoveBG '.esc_js($dfd_bg_grad_anim_duration / 1000).'s ease infinite;';
	}
			
	$css_rules = '#'.esc_js($uniqid).'{'.$css_rules.'}';
			
	$output .=	'<div class="dfd-row-bg-wrap dfd-row-bg-gradient" id="'.esc_attr($uniqid).'"></div>';
	$output .=	'<script type="text/javascript">
					(function($) {
						$("head").append("<style>'.$css_rules.'</style>");
					})(jQuery);
				</script>';
}