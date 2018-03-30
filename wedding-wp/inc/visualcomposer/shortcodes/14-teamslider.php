<?php
class WPBakeryShortCode_team_slider extends WPBakeryShortCodesContainer {
    protected function content($atts, $content = null) {
	  	extract(shortcode_atts(array(
		"type" => '',		
		), $atts));
		$out = '<div class="team-slider flexslider">';
		$out .= '<ul class="slides">';
		$out .= do_shortcode($content);
		$out .= '</ul></div>';
		return $out;
	}
}

vc_map( array(
    "name" => "Webnus Team Slider",
    "base" => "team_slider",
    "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    "icon" => "webnus_ourteam",
    "as_parent" => array('only' => 'team_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => false,
    "js_view" => 'VcColumnView'
) );

?>