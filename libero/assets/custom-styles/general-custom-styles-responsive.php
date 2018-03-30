<?php
if(!function_exists('libero_mikado_design_responsive_styles')) {
    /**
     * Generates general responsive custom styles
     */
    function libero_mikado_design_responsive_styles() {

        $parallax_style = array();
        if (libero_mikado_options()->getOptionValue('parallax_min_height') !== '') {
            $parallax_style['height'] = 'auto !important';
            $parallax_min_height = libero_mikado_options()->getOptionValue('parallax_min_height');
            $parallax_style['min-height'] = libero_mikado_filter_px($parallax_min_height) . 'px';
        }

		echo libero_mikado_dynamic_css('.mkd-section.mkd-parallax-section-holder', $parallax_style);
    }

    add_action('libero_mikado_style_dynamic_responsive_480', 'libero_mikado_design_responsive_styles');
    add_action('libero_mikado_style_dynamic_responsive_480_768', 'libero_mikado_design_responsive_styles');
}

if(!function_exists('libero_mikado_title_responsive_styles')){
	/*
	 * Generates title responsive styles
	 */

	function libero_mikado_title_responsive_styles(){
		$title_styles = array();

		$title_font_size =  intval(libero_mikado_options()->getOptionValue('page_title_fontsize'));
		$title_h1_font_size = intval(libero_mikado_options()->getOptionValue('h1_fontsize'));

		if ($title_font_size == ''){
			$title_font_size = $title_h1_font_size;
		}

		if ($title_font_size !== ''){
			if ($title_font_size > 60){
				$title_styles['font-size'] = ($title_font_size * 0.7).'px';				
			}
			elseif($title_font_size > 40){
				$title_styles['font-size'] = ($title_font_size * 0.8).'px';
			}
		}

		if (count($title_styles)){
			echo libero_mikado_dynamic_css(array(
				'.mkd-title .mkd-title-holder h1',
				'.mkd-title.mkd-standard-type.mkd-title-enabled-breadcrumbs .mkd-title-holder h1'
				), $title_styles);
		}
	}

	add_action('libero_mikado_style_dynamic_responsive_480','libero_mikado_title_responsive_styles');
}