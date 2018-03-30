<?php
$output = $title = $el_class = $open = $css_animation = '';
extract(shortcode_atts(array(
    'title' => __("Click to toggle", "homeShop"),
    'el_class' => '',
    'open' => 'false',
    'css_animation' => ''
), $atts));
?>
<?php $rgb = sc_hexToRGB(get_option(SHORTNAME . '_accent_color')); ?>
<div class="toggle_wrapper" style="border-top-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2); border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);">
	<?php
	$el_class = $this->getExtraClass($el_class);
	$open = ( $open == 'true' ) ? ' wpb_toggle_title_active' : '';
	$el_class .= ( $open == ' wpb_toggle_title_active' ) ? ' wpb_toggle_open' : '';
	
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle'.$open, $this->settings['base']);
	$css_class .= $this->getCSSAnimation($css_animation);
	
	$output .= apply_filters('wpb_toggle_heading', '<h4 class="'.$css_class.'"><span class="not_active">+</span><span class="active">-</span>'.$title.'</h4>', array('title'=>$title, 'open'=>$open));
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle_content'.$el_class, $this->settings['base']);
	$output .= '<div class="'.$css_class.'">'.wpb_js_remove_wpautop($content, true).'</div>'.$this->endBlockComment('toggle')."\n";
	
	echo $output;?>
</div>