<?php
$output = $title = $exp = '';
global $hs_active_tab, $i, $accordion;

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
	'labeltyp' => 'select',
	'labeltxt' => 'Empty Text'
), $atts));

if($i == $hs_active_tab){
	$cls = '';
	$exp = 'false';
	$in = 'in';
}else{
	$cls = 'collapsed';
	$exp = 'true';
	$in = '';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel panel-default', $this->settings['base'], $atts );

	$output .= "\n\t\t\t" . '<div class="'.$css_class.'" >';
    $output .= "\n\t\t\t\t" . '<div class="panel-heading" role="tab" id="hs_'.sanitize_title($title).'"><h4 class="panel-title"><a class="'.esc_attr($cls).'" data-toggle="collapse" href="#'.sanitize_title($title).'" aria-expanded="'.esc_attr($exp).'" aria-controls="'.sanitize_title($title).'" '.$accordion.'>'.esc_attr($title);
	if($labeltyp != 'select')
		$output .= '<span class="label label-'.esc_attr($labeltyp).'">'.esc_attr($labeltxt).'</span>';
	
	$output .= '<span class="panel-icon"></span></a></h4></div>';
    $output .= "\n\t\t\t\t" . '<div id="'.sanitize_title($title).'" class="panel-collapse collapse '.esc_attr($in).'" role="tabpanel" aria-labelledby="hs_'.sanitize_title($title).'"><div class="panel-body">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div></div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.panel') . "\n";

echo $output;
$i++;