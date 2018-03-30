<?php
	add_shortcode('sixteen', 'sixteen_handler');
	function sixteen_handler($atts, $content=null, $code="") {
		return "<div class=\"sixteen columns\">".do_shortcode($content)."</div>";
	}
	add_shortcode('half', 'half_handler');
	function half_handler($atts, $content=null, $code="") {
		return "<div class=\"eight columns\">".do_shortcode($content)."</div>";
	}

	add_shortcode('one-third', 'one_third_handler');
	function one_third_handler($atts, $content=null, $code="") {
		return "<div class=\"one-third column\">".do_shortcode($content)."</div>";
	}
	add_shortcode('two-thirds', 'two_third_handler');
	function two_third_handler($atts, $content=null, $code="") {
		return "<div class=\"two-thirds column\">".do_shortcode($content)."</div>";
	}
	add_shortcode('four', 'four_handler');
	function four_handler($atts, $content=null, $code="") {
		return "<div class=\"four columns\">".do_shortcode($content)."</div>";
	}
	add_shortcode('three-fourths', 'three_fourths_handler');	function three_fourths_handler($atts, $content=null, $code="") {		return "<div class=\"twelve  columns\">".do_shortcode($content)."</div>";	}
?>