<?php
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'style' => 'style1',
    'tab_color' => '#444',
    'tab_color_active' => '#444',
    'tab_background_color' => '',
    'tab_background_color_active' => '',
    'el_class' => ''
), $atts));

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}(\sicon_title="([^\"]*)")?/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
$tab_color = ($tab_color!='')?' color:'.$tab_color.'!important;':'';
$tab_color_active = ($tab_color_active!='')?' color:'.$tab_color_active.'!important;':'';
$tab_background_color = ($tab_background_color!='')?' background-color:'.$tab_background_color.'!important;':'';
$tab_background_color_active_tab = ($tab_background_color_active!='')?' background-color:'.$tab_background_color_active.'!important;':'';
$tab_border_color_active = ($tab_background_color_active!='')?' border-color: transparent transparent transparent '.$tab_background_color_active.'!important;':'';
$unique_id = uniqid().'_'.time();
$id  ="vc_tabs".$unique_id;
switch ($style) {
	case 'style2':
		if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
		$tabs_nav = '';
		$tabs_nav .= '<ul id="'.$id.'" class="wpb_tabs_nav ui-tabs-nav vc_clearfix '.$style.'">';
		?>
		<style type="text/css" scoped>
			.wpb_tabs ul#<?php echo $id;?> li.ui-tabs-active a.ui-tabs-anchor,
			.wpb_tabs ul#<?php echo $id;?> li:hover a.ui-tabs-anchor{
				<?php echo $tab_color_active;?>
				<?php echo $tab_background_color_active_tab;?>
			}
			.wpb_tabs ul#<?php echo $id;?> li a{
				<?php echo $tab_color;?>
				<?php echo $tab_background_color;?>
			}
		</style>
		<?php
		foreach ( $tab_titles as $tab ) {
		    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		    $tab_atts = shortcode_parse_atts($tab[0]);
		    if(isset($tab_atts['icon_title'])){
		    	$tab_matches[1][0] = '<i class="'.$tab_atts['icon_title'].'"></i>';
		    }
		    if(isset($tab_matches[1][0])) {
		        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

		    }
		}
		$tabs_nav .= '</ul>'."\n";

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

		$output .= "\n\t".'<div class="'.$css_class.' '.$style.'" data-interval="'.$interval.'">';
		$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
		$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
		$output .= "\n\t\t\t".$tabs_nav;
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		if ( 'vc_tour' == $this->shortcode) {
		    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
		}
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment($element);

		echo $output;
		break;
	case 'style3':
		if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
		$tabs_nav = '';
		$tabs_nav .= '<ul id="'.$id.'" class="wpb_tabs_nav ui-tabs-nav vc_clearfix '.$style.'">';
		?>
		<style type="text/css" scoped>
			.wpb_tabs.style3 ul#<?php echo $id;?> li .ui-tabs-anchor:hover:before,
			.wpb_tabs.style3 ul#<?php echo $id;?> li.ui-tabs-active .ui-tabs-anchor:before {
				<?php echo $tab_border_color_active; ?>
			}
			.wpb_tabs ul#<?php echo $id;?> li.ui-tabs-active a.ui-tabs-anchor,
			.wpb_tabs ul#<?php echo $id;?> li:hover a.ui-tabs-anchor{
				<?php echo $tab_color_active;?>
				<?php echo $tab_background_color_active_tab;?>
			}
			.wpb_tabs ul#<?php echo $id;?> li a{
				<?php echo $tab_color;?>
				<?php echo $tab_background_color;?>
			}
		</style>
		<?php
		foreach ( $tab_titles as $tab ) {
		    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		    $tab_atts = shortcode_parse_atts($tab[0]);
		    if(isset($tab_atts['icon_title'])){
		    	$tab_matches[1][0] = '<i class="'.$tab_atts['icon_title'].'"></i>';
		    }
		    if(isset($tab_atts['image'])){
		    	if (is_numeric($tab_atts['image'])) {
                $image_src = wp_get_attachment_url($tab_atts['image']);
	            } else {
	                $image_src = $tab_atts['image'];
	            }
		    	$tab_matches[1][0] = '<img src="'.$image_src.'" alt="" />';
		    }
		    if(isset($tab_matches[1][0])) {
		        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';
		    }
		}
		$tabs_nav .= '</ul>'."\n";
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );
		$output .= "\n\t".'<div class="'.$css_class.' '.$style.'" data-interval="'.$interval.'">';
		$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
		$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
		$output .= "\n\t\t\t".$tabs_nav;
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		if ( 'vc_tour' == $this->shortcode) {
		    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
		}
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment($element);
		echo $output;
		break;

	case 'style4':
		if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
		$tabs_nav = '';
		$countItem = count($tab_titles);
		$tabs_nav .= '<ul id="'.$id.'" class="wpb_tabs_nav ui-tabs-nav vc_clearfix '.$style.' total-'.$countItem.'">';
		?>
		<style type="text/css" scoped>
			.wpb_tabs.style4 ul#<?php echo $id;?> li:hover .ui-tabs-anchor:before,
			.wpb_tabs.style4 ul#<?php echo $id;?> li.ui-tabs-active .ui-tabs-anchor:before {
				border-top-color: <?php echo $tab_background_color_active ?>;
			}
			.wpb_tabs ul#<?php echo $id;?> li.ui-tabs-active a.ui-tabs-anchor,
			.wpb_tabs ul#<?php echo $id;?> li:hover a.ui-tabs-anchor{
				<?php echo $tab_color_active;?>
				<?php echo $tab_background_color_active_tab;?>
			}
			.wpb_tabs ul#<?php echo $id;?> li a{
				<?php echo $tab_color;?>
				<?php echo $tab_background_color;?>
			}
		</style>
		<?php
		foreach ( $tab_titles as $tab ) {
		    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		    $tab_atts = shortcode_parse_atts($tab[0]);
		    if(isset($tab_atts['icon_title']) && $tab_atts['icon_title']!=''){
		    	$tab_matches[1][0] = '<i class="'.$tab_atts['icon_title'].'"></i>';
		    }
		    if(isset($tab_matches[1][0])) {
		        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

		    }

		}
		$tabs_nav .= '</ul>'."\n";

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

		$output .= "\n\t".'<div class="'.$css_class.' '.$style.'" data-interval="'.$interval.'">';
		$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
		$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
		$output .= "\n\t\t\t".$tabs_nav;
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		if ( 'vc_tour' == $this->shortcode) {
		    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
		}
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment($element);

		echo $output;
	break;

	case 'style5':
		if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
		$tabs_nav = '';
		$tabs_nav .= '<ul id="'.$id.'" class="wpb_tabs_nav ui-tabs-nav vc_clearfix '.$style.'">';
		?>
		<style type="text/css" scoped>
			.wpb_tabs ul#<?php echo $id;?>{
				border-bottom-color: <?php echo $tab_background_color_active; ?>;
			}
			.wpb_tabs ul#<?php echo $id;?> li.ui-tabs-active a.ui-tabs-anchor,
			.wpb_tabs ul#<?php echo $id;?> li:hover a.ui-tabs-anchor{
				<?php echo $tab_color_active;?>
				<?php echo $tab_background_color_active_tab; ?>
			}
			.wpb_tabs ul#<?php echo $id;?> li a{
				<?php echo $tab_color;?>
				<?php echo $tab_background_color;?>
			}
		</style>
		<?php
		foreach ( $tab_titles as $tab ) {
		    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		    $tab_atts = shortcode_parse_atts($tab[0]);
		    if(isset($tab_atts['icon_title']) && $tab_atts['icon_title']!=''){
		    	$tab_matches[1][0] = '<i class="'.$tab_atts['icon_title'].'"></i>';
		    }
		    if(isset($tab_matches[1][0])) {
		        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

		    }

		}
		$tabs_nav .= '</ul>'."\n";

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

		$output .= "\n\t".'<div class="'.$css_class.' '.$style.'" data-interval="'.$interval.'">';
		$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
		$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
		$output .= "\n\t\t\t".$tabs_nav;
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		if ( 'vc_tour' == $this->shortcode) {
		    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
		}
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment($element);

		echo $output;
		break;
	default:
		if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
		$tabs_nav = '';
		$tabs_nav .= '<ul id="'.$id.'" class="wpb_tabs_nav ui-tabs-nav vc_clearfix '.$style.'">';
		?>
		<style type="text/css" scoped>
			.wpb_tabs ul#<?php echo $id;?> li.ui-tabs-active a.ui-tabs-anchor,
			.wpb_tabs ul#<?php echo $id;?> li:hover a.ui-tabs-anchor{
				<?php echo $tab_color_active;?>
				<?php echo $tab_background_color_active_tab;?>
			}
			.wpb_tabs ul#<?php echo $id;?> li a{
				<?php echo $tab_color;?>
				<?php echo $tab_background_color;?>
			}
		</style>
		<?php
		foreach ( $tab_titles as $tab ) {
		    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
		    $tab_atts = shortcode_parse_atts($tab[0]);
		    if(isset($tab_atts['icon_title']) && $tab_atts['icon_title']!=''){
		    	$tab_matches[1][0] = '<i class="'.$tab_atts['icon_title'].'"></i>';
		    }
		    if(isset($tab_matches[1][0])) {
		        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

		    }

		}
		$tabs_nav .= '</ul>'."\n";

		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

		$output .= "\n\t".'<div class="'.$css_class.' '.$style.'" data-interval="'.$interval.'">';
		$output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix">';
		$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
		$output .= "\n\t\t\t".$tabs_nav;
		$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
		if ( 'vc_tour' == $this->shortcode) {
		    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
		}
		$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
		$output .= "\n\t".'</div> '.$this->endBlockComment($element);

		echo $output;
		break;
}
		