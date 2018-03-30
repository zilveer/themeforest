<?php

class WPBakeryShortCode_title extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {
		
		$randomid = rand();

		/*extract(shortcode_atts(array(
			'text' 			=> '',
			'font' 			=> '',
			'tag' 			=> '',
			'font_size'		=> '',
			'line_height' 	=> '',
			'color' 		=> '',
			'text_align' 		=> '',
			'el_class'		=> '',
			'css'			=> ''
		), $atts));*/

		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		extract( $atts );

		$el_class = $this->getExtraClass($el_class);

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'shortcode_title title_' . $randomid . ' ' . $font . $el_class . vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts );
		
		$inline_css = "";

		$output = '<'.$tag.' class="'.$css_class.'">'.$text.'</'.$tag.'>';

		$output .= '

		<style>
			.title_'.$randomid.' {
				line-height: ' . $line_height . ';
				color: ' . $color . ' !important;
				text-align: ' . $text_align . ';
			}
			@media only screen and (min-width: 40em) {
				.title_'.$randomid.' {
					font-size: ' . $font_size . ';
				}
			}
		</style>

		';
		
		return $output;
		
	}

}