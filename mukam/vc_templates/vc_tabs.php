<?php
$output = $title = $interval = $el_class = $tabs_style = $addclass ='';
$counttabs = $active_tab = '1';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'tabs_style' => '',
    'addicon' => '',
    'el_class' => ''
), $atts));

if ( $addicon != '' ) {
    $addicon = '<i class="'.$addicon.' pull-left"></i>';
}

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs clearfix">';
foreach ( $tab_titles as $tab ) {
	if ($active_tab == $counttabs ) {
		$addclass = 'class="active"';
	}
	else {
		$addclass = '';
	}
	$counttabs++;
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li '.$addclass.'><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab">'.$addicon . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);


$output .= "\n\t\t".'<div class="'.$tabs_style .'">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= '<div class="tab-content">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= "\n\t\t".'</div>';


echo $output;