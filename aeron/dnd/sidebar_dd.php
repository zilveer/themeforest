<?php

/*********** Shortcode: Sidebar ************************************************************/

$ABdevDND_shortcodes['sidebar_dd'] = array(
	'attributes' => array(
		'name' => array(
			'default' => '',
			'description' => __('Sidebar Name or ID', 'dnd-shortcodes'),
		),
	),
	'description' => __('Sidebar with widgets', 'dnd-shortcodes'),
	'info' => __('Display sidebar and all its widgets anywhere inside content. You can create unlimited number of sidebars in Drag&Drop options.', 'dnd-shortcodes')
);
function ABdevDND_sidebar_dd_shortcode( $attributes ) {
    extract(shortcode_atts(ABdevDND_extract_attributes('sidebar_dd'), $attributes));
    $name = trim($name);
    $content='';

        ob_start();  
        dynamic_sidebar($name);
        $content = ob_get_clean();

    return '<div>'.$content.'</div>';
}

