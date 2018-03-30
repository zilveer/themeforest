<?php

class WPV_Accordion {
	public function __construct() {
		add_shortcode('accordion', array(__CLASS__, 'shortcode'));
	}

	public static function shortcode($atts, $content = null, $code = 'accordion') {
		extract(shortcode_atts(array(
			'closed_bg' => 'accent1',
			'title_color' => 'accent8',
			'collapsible' => 'true',
		), $atts));

		if (!wpv_sub_shortcode('pane', $content, $params, $sub_contents))
			return do_shortcode($content);

		wp_enqueue_script('jquery-ui-accordion');

		$title_tag = apply_filters('wpv_accordion_title_tag', 'h4');

		$closed_bg = wpv_sanitize_accent($closed_bg);
		$title_color = wpv_sanitize_accent($title_color);

		global $wpv_accordions_shown;
		if(!isset($wpv_accordions_shown))
			$wpv_accordions_shown = 0;

		$wpv_accordions_shown++;

		$output = '';
		foreach($sub_contents as $i=>$sc) {
			$tab_class = '';
			$bgimage = '';
			if(isset($params[$i]['background_image']) && !empty($params[$i]['background_image'])) {
				$bgimage = 'background-image: url("'.$params[$i]['background_image'].'");';
				$tab_class .= ' has-bg';
			}

			$output .= '<li class="pane-wrapper" style="'.esc_attr($bgimage).'">
					<'.$title_tag.' class="tab'.$tab_class.'"><span class="inner">' . $params[$i]['title'] . '</span></'.$title_tag.'>
					<div class="pane"><div class="inner">' . do_shortcode(trim($sc)) . '</div></div>
					</li>';
		}

		$style = '<style scoped>.wpv-accordion-'.$wpv_accordions_shown.' .tab .inner { background-color: '.$closed_bg.'; color: '.$title_color.'; }</style>';

		return '<div class="wpv-accordion-wrapper wpv-accordion-'.$wpv_accordions_shown.'">' . $style . '<ul class="wpv-accordion" data-collapsible="'.esc_attr($collapsible).'">' . $output . '</ul></div>';
	}
}

new WPV_Accordion;
