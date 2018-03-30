<?php

function toggle($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => '',
                'type'=> '',
		'icon' => '',
		'icon_color' => '',
                'title' => ''
		), $atts));

	
	if ($icon == 'pm') {
		$icon_class = 'toggle_pm';
	} elseif ($icon == 'q') {
		$icon_class = 'toggle_qm';
	} else {
		$icon_class = 'toggle_arrows';
	}
	if ($style != 'closed') {
		$class = ' toggle_active';
	} else {
		$class = '';
	}
	if ($style != '') {
	$style = 'toggle_'.$style.' ';
	}
	if ($icon_color != '') {
		$icon_color = 'style="color:'.$icon_color.';"';
	}
	if ($type == 'min') {
	return '<div class="toggle_minimal '.$style.$class.'"><h4 class="toggle_title"><i class="toggle_icon '.$icon_class.'" '.$icon_color.'></i>'.$title.'</h4><div class="toggle_content">'.wpautop(do_shortcode($content)).'</div></div>';
		
	} else {
	return '<div class="toggle_wrap '.$style.$class.'"><h4 class="toggle_title"><i class="toggle_icon '.$icon_class.'" '.$icon_color.'></i>'.$title.'</h4><div class="toggle_content">'.wpautop(do_shortcode($content)).'</div></div>';
	}
			
	}

add_shortcode('toggle', 'toggle');


?>