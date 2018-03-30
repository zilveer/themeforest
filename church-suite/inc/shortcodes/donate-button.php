<?php
 function webnus_donate_button( $atts, $content = null ) {
 	extract(shortcode_atts(array(
 	'donate_content'      => '',
 	'id'      => '0',
 	'color'      => 'green',
 	'size'      => 'small',
	'border'=>'false',
	'icon'=>''
 	), $atts));

	$icon_str = !empty($icon)? '<i class="'.$icon.'"></i>' : '';
	
 	$out = '<a href="#w-donation" class="donate-button  inlinelb button '. $color . '  '. $size . ' '. $border . ' " target="_self"><span class="media_label">'. $icon_str . $donate_content . '</a>';
	$out .='<div style="display:none"><div class="w-modal modal-donate" id="w-donation"><h3 class="modal-title">'.esc_html__('Donate Now','webnus_framework').'</h3><br>'.do_shortcode('[contact-form-7 id="'.$id.'" title="Donate"]').'</div></div>';
 	return $out;
 	return $out;

	
 }
 add_shortcode('donate', 'webnus_donate_button');
?>