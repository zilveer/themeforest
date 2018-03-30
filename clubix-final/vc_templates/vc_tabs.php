<?php
$output = $title = $interval = $el_class = $nav_type = $content_type = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => ''
), $atts));

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

$nav_content_class = 'nav nav-tabs';
$content_class_container = 'tab-content tab-default';

if ( 'vc_tour' == $this->shortcode ) { $nav_content_class = 'nav nav-tabs nav-stacked tabs-bd left-tabs-content'; $content_class_container = 'tab-content tabs-bd tabs-blue right-tab-content'; }

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\")(\sicon\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/*
 * [vc_tabs title="Lala" interval="" el_class=""]
 *
 * [vc_tab icon="" title="" tab_id=""]continut[/vc_tab]
 *
 * [/vc_tabs]
 */


/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul id="myTab" class="'.$nav_content_class.'">';
$i = 0;
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\")(\sicon\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );

    $icon = '';
    if(isset($tab_matches[5][0])) { $icon = '<i class="fa '.$tab_matches[5][0].'"></i>'; }

    if(isset($tab_matches[1][0]) && $i != 0) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab">'. $icon . $tab_matches[1][0] . '</a></li>';
    } else {
        $tabs_nav .= '<li class="active"><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab" >' . $icon . $tab_matches[1][0] . '</a></li>';
    }
    $i++;
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);

$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= '<div id="myTabContent" class="'.$content_class_container.'">';
if($content_type == 'oblique' || $content_type == 'tab-content-dark oblique') { $output .= '<div class="before-tab-pane"></div>'; }
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
if($content_type == 'oblique' || $content_type == 'tab-content-dark oblique') { $output .= '<div class="after-tab-pane"></div>'; }
$output .= '</div>';

echo $output;