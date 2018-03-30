<?php
$output = $title = $tabposition = $cls = '';
extract( shortcode_atts( array(
	'title' => '',
	'tabposition' => 'Top',
	'tabstyle' => 'Simple Tabs',
), $atts ) );

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
global $tab_i;
$tab_i = 0;
if($tabstyle == 'Simple Tabs'){
	$cls_t_s = ' nav-tabs';
	if($tabposition == 'Bottom')
		$cls_t_s .= ' nav-tabs-inverse';
}
elseif($tabstyle == 'Simple Justified Tabs')
	$cls_t_s = ' nav-tabs nav-justified';
elseif($tabstyle == 'Animated Tabs')
	$cls_t_s = ' nav-lava';elseif($tabstyle == 'Animated Center Tabs')$cls_t_s = ' nav-lava text-center';elseif($tabstyle == 'Animated Dark Tabs')$cls_t_s = ' nav-lava dark';
$tabs_nav .= '<ul class="nav'.esc_attr($cls_t_s).'" role="tablist">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title'])) {
		if($tab_i == 0){
			$active = 'active';
		}
		$tabs_nav .= '<li role="presentation" class="'.$active.'"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" aria-controls="tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '" role="tab" data-toggle="tab">' . $tab_atts['title'] . '</a></li>';
		$active = ''; $tab_i++;
	}
}
$tabs_nav .= '</ul>' . "\n";
$tab_i = 0;
if($tabposition == 'Left')
	$cls = 'vertical-tab left';
elseif($tabposition == 'Right')
	$cls = 'vertical-tab right';
$output .= "\n\t" . '<div role="tabpanel" class="wpb_wrappe_rs '.$cls.'">';
if($tabposition == 'Top' || $tabposition == 'Left')
	$output .= $tabs_nav;
$output .= "\n\t" . ' <!-- Tab Panes --><div class="tab-content">'; 
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.tab-content' ); 
if($tabposition == 'Bottom' || $tabposition == 'Right')
	$output .= $tabs_nav;
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrappe_rs' ); 

echo $output;