<?php

/**
 * Create the Styling Options section
 */
add_action('admin_init', 'zilla_styling_options');
function zilla_styling_options(){
	
	$styling_options['description'] = __('Configure the visual appearance of you theme by selecting a stylesheet if applicable, choosing your overall layout and inserting any custom CSS necessary.', 'zilla');
	
	$styling_options[] = array('title' => __('Main Layout', 'zilla'),
                               'desc' => __('Select main content and sidebar alignment.', 'zilla'),
                               'type' => 'radio',
                               'id' => 'style_main_layout',
                               'val' => 'layout-2cr',
                               'options' => array(
                                   'layout-2cr' => __('2 Columns (right)', 'zilla'),
                                   'layout-2cl' => __('2 Columns (left)', 'zilla')
                               ));

	$styling_options[] = array('title' => __('Highlight Color', 'zilla'),
							   'desc' => __('Change this color to specify the "highlight" color for your site', 'zilla'),
							   'type' => 'color',
							   'id' => 'style_highlight_color',
							   'val' => '#ea4848');

    $styling_options[] = array('title' => __('Custom CSS', 'zilla'),
                               'desc' => __('Quickly add some CSS to your theme by adding it to this block.', 'zilla'),
                               'type' => 'textarea',
                               'id' => 'style_custom_css');
                                
    zilla_add_framework_page( 'Styling Options', $styling_options, 10 );
}


/**
 * Output main layout
 */
function zilla_style_main_layout($classes) {
	$zilla_values = get_option( 'zilla_framework_values' );
	$layout = 'layout-2cr';
	if( array_key_exists( 'style_main_layout', $zilla_values ) && $zilla_values['style_main_layout'] != '' ){
		$layout = $zilla_values['style_main_layout'];
	}
	$classes[] = $layout;
	return $classes;
}
add_filter( 'body_class', 'zilla_style_main_layout' );


/**
 * Output the custom CSS
 */
function zilla_custom_css($content) {
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'style_custom_css', $zilla_values ) && $zilla_values['style_custom_css'] != '' ){
    	$content .= '/* Custom CSS */' . "\n";
        $content .= stripslashes($zilla_values['style_custom_css']);
        $content .= "\n\n";
    }
    return $content;
    
}
add_filter( 'zilla_custom_styles', 'zilla_custom_css' );

/**
 * Highlight CSS
 */

function zilla_highlight_css( $content ) {
	$zilla_values = get_option( 'zilla_framework_values' );

	if( array_key_exists( 'style_highlight_color', $zilla_values ) ) {
		$color = $zilla_values['style_highlight_color'];

		if( !empty($color) && ( $color != '#ea4848' ) ) {
			$content .= "a,\n.entry-title a:hover,\n#logo a:hover,\n#primary-menu li a:hover,\n#primary-menu li.sfHover > a,\n#primary-menu li.current-menu-item > a,\n#primary-menu .sub-menu > li > a:hover,\n#primary-menu .sub-menu .current-menu-item > a,\n#primary-menu .sub-menu > .sfHover > a,\n.zilla-direction-nav a:hover,\n.entry-link a:hover,\n.entry-meta-footer a:hover,\n.comment-meta a:hover,\n.bypostauthor .comment-meta a:hover,\n.comment-author cite a:hover,\n.bypostauthor .comment-author cite a:hover,\n#commentform .required,\n#load-more:hover,\n#footer a:hover,\n#footer .widget > ul a:hover,\n.widget > ul a:hover,\n.widget_nav_menu a:hover,\n.widget .recentcomments a,\n.zilla-tweet-widget > ul a,\n.zilla-tweet-widget li > a:hover { color: $color; }\n";
			$content .= ".post-thumb { background-color: $color; }\n";
			$content .= ".entry-quote { background: $color; }\n";
		}

	}

	return $content;
}
add_action( 'zilla_custom_styles', 'zilla_highlight_css' );

?>