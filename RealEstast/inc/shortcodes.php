<?php

class PGL_Shortcodes {
	static function init() {
		add_shortcode("agent", array("PGL_Shortcodes", "agent_shortcode"));
		add_shortcode("block", array("PGL_Shortcodes","block_shortcode"));
		add_shortcode("container", array("PGL_Shortcodes","container_shortcodes"));
		add_shortcode("googlemap", array("PGL_Shortcodes", "googlemap_shortcode"));
		add_shortcode("heading_block", array("PGL_Shortcodes", "heading_shortcode"));
		add_shortcode("row", array("PGL_Shortcodes", "row_shortcode"));
	}

	function googlemap_shortcode( $atts, $content = NULL ) {
		extract( shortcode_atts( array(
			"width"  => '640',
			"height" => '480',
			"src"    => ''
		), $atts ) );
		return '<iframe width="' . $width . '" height="' . $height . '" src="' . $src . '&output=embed" ></iframe>';
	}

	function quote_shortcode( $atts, $content = NULL) {

	}

	static function heading_shortcode( $atts, $content = NULL) {
		extract( shortcode_atts( array(
			"heading" => ""
		), $atts ) );
		return '<div class="properties"><div class="container"><div class="grid_full_width"><div class="all-text"><h3>'.$heading.'</h3>'.do_shortcode($content).'</div></div></div></div>';
	}

	static function block_shortcode( $atts, $content = NULL ) {

		extract(shortcode_atts(array(
			'size'          => 2,
			"heading"       => '',
			"heading_level" => "6",
			"offset"        => ''
		), $atts));
		/**
		 * @var string $size
         * @var string $offset
         * @var string $heading
         * @var int $heading_level
		 */
		return '<div class="block-code col-md-' . $size . ($offset ? ' col-md-offset-' . $offset : '') . '">' . ($heading ? '<h' . $heading_level .'>' . $heading . '</h' . $heading_level .'>' : '') . do_shortcode($content) . '</div>';
	}

	static function row_shortcode( $atts, $content = NULL) {
		return '<div class="row-code row">'. do_shortcode($content) . '</div>';
	}

	static function agent_shortcode( $atts ) {
		/**
		 * @var $name
		 * @var $title
		 * @var $desc
		 * @var $phone
		 * @var $mail
		 * @var $img
		 */
		extract(shortcode_atts(array(
			'name'  => '',
			'title' => '',
			'desc'  => '',
			'phone' => '',
			'mail'  => '',
			'img'   => ''
		), $atts));
		$html = '<div class="our-border clearfix">
				' . ( $img ? '<div class="our-img"><img src="' . $img . '" /></div>' : '') . '
				<div class="our-info">
					'. ($title ? '<h4>' . $title . '</h4>' : '') . '
					'. ($name ? '<h5>' . $name . '</h5>' : '') . '
					'. ($desc ? '<p>' . $desc . '</p>' : '') . '
					'. ($phone ? '<span>' . __('Call', PGL) . '</span> ' . $phone . '<br/>' : '') . '
					'. ($mail ? '<span>' . __('Mail', PGL) . '</span> <a href="mailto:' . $mail . '">' . $mail . '</a>' : ''  ) .'
				</div>
				</div>';
		return do_shortcode($html);
	}

	static function container_shortcodes( $atts, $content = NULL) {
		extract(shortcode_atts(array(
			'extra_classes'  => '',
		), $atts));
		$html = '<div class="'. $extra_classes. '"><div class="container">' . do_shortcode(shortcode_unautop($content)) . '</div></div>';
		return $html;
	}
}