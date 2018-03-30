<?php
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => ''
), $atts));

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
?>
<?php 
$rgb = candidat_sc_hexToRgb(get_option(SHORTNAME . '_accent1_color'));
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' wpb_content_element '.$el_class), $this->settings['base']);
if ( 'vc_tour' == $this->shortcode) {
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.'  style2 wpb_content_element '.$el_class), $this->settings['base']);
}	
?>

	<h3 class="no-margin-top" ><?php echo $title; ?></h3>
	
	<!-- Tabs -->
	<div class="tabs <?php echo $css_class; ?>">




	<?php
	if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
	$tabs_nav = '';
	$tabs_nav .= '<div class="tab-header"><ul>';
	foreach ( $tab_titles as $tab ) {
	    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
	    if(isset($tab_matches[1][0])) {
	        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'"><h6>' . $tab_matches[1][0] . '</h6></a></li>';
	    }
	}
	$tabs_nav .= '</ul></div>'."\n";

	$output .= "\n\t\t\t".$tabs_nav;
	
	
	$output .= "\n\t\t".'<div class="tab-content">';
	$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
	$output .= "\n\t\t".'</div>';
	echo $output;?>
	
	</div>
	<!-- /Tabs -->