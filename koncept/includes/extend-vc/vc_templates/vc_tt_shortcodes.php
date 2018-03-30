<?php

function vc_tta_accordion_function( $atts, $content ) {

	wp_enqueue_script('jquery-ui-accordion');
	$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
	//
	extract(shortcode_atts(array(
	    'title' => '',
	    'el_class' => '',
	    'type' => 'accordion',
	    'size' => 'large',
	    'active_tab' => '0',
	    'css_animation' => '',
	    'css_animation_speed' => 'default',
	    'css_animation_delay' => '0'
	), $atts));

	$css_class = 'krown-accordion clearfix '. $type . ' ' . $size . $el_class.' not-column-inherit';

	$output = '<div data-opened="' . $active_tab . '" class="' . $css_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div>';

	return $output;

}

add_shortcode( 'vc_tta_accordion', 'vc_tta_accordion_function' );

function vc_tta_tabs_function( $atts, $content ) {

	$output = $title = $interval = $el_class = '';
	extract(shortcode_atts(array(
	    'title' => '',
	    'interval' => 0,
	    'nav_bullets' => 'none',
	    'nav_arrows' => 'none',
	    'size' => 'large',
	    'el_class' => '',
	    'css_animation' => '',
	    'css_animation_speed' => 'default',
	    'css_animation_delay' => '0'
	), $atts));

	$element = 'krown-tabs';

	// Extract tab titles
	$deprec = -1;
	preg_match_all( '/\[vc_tta_section[\s]*title="([^\"]+)"[\s]*tab_id="([^\"]+)"[\s]*icon="([^\"]+)"\]/i', $content, $matches, PREG_SET_ORDER );

	if ( empty( $matches ) || sizeof( $matches ) == 0 ) {
		$deprec = 0;
		preg_match_all( '/\[vc_tta_section[\s]*icon="([^\"]+)"[\s]*title="([^\"]+)"[\s]*tab_id="([^\"]+)"\]/i', $content, $matches, PREG_SET_ORDER );
	}

	if ( empty( $matches ) || sizeof( $matches ) == 0 ) {
		$deprec = 1;
		preg_match_all( '/\[vc_tta_section[\s]*title="([^\"]+)"[\s]*tab_id="([^\"]+)"\]/i', $content, $matches, PREG_SET_ORDER );
	}

	if ( empty( $matches ) || sizeof( $matches ) == 0 ) {
		_e( "This shortcode isn't properly configured. Please review it.", "krown" );
		return;
	}

	$tabs_nav = '<ul class="titles clearfix' . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
	foreach ( $matches as $tab ) {
	    if(isset($tab[0])) {
	    	if ( $deprec == 0 ) {
	        	$tabs_nav .= '<li><h5 href="#tab-' . $tab[3] .'">' . $tab[2] . '</h5></li>';
	        	$tabs_nav .= '<li style="width:' . $tabs_width . '%"><h5 href="#tab-' . $tab[2] .'">' . $tab[1] . '</h5></li>';
	    	} else {
	        	$tabs_nav .= '<li><h5 href="#tab-' . $tab[2] .'">' . $tab[1] . '</h5></li>';
	    	}
	    }
	}
	$tabs_nav .= '</ul>'."\n";

	$css_class = $element.' ' .$size.$el_class;

	$output .= "\n\t".'<div class="'.$css_class.'">';
	$output .= "\n\t\t\t".$tabs_nav;
	$output .= "\n\t\t\t".'<div class="contents">'.wpb_js_remove_wpautop($content).'</div>';
	$output .= "\n\t".'</div> ';

	return $output;

}

add_shortcode( 'vc_tta_tabs', 'vc_tta_tabs_function' );

function vc_tta_tour_function( $atts, $content ) {
	
	$output = $title = $interval = $el_class = '';
	extract(shortcode_atts(array(
	    'title' => '',
	    'interval' => 0,
	    'nav_bullets' => 'none',
	    'nav_arrows' => 'none',
	    'size' => 'large',
	    'el_class' => '',
	    'css_animation' => '',
	    'css_animation_speed' => 'default',
	    'css_animation_delay' => '0'
	), $atts));

	$output = '<div class="flexslider krown-tour nav-bullets-' . $nav_bullets . ( $el_class != '' ? ' ' . $el_class : '' ) . '" data-nav-bullets="' . $nav_bullets . '" data-nav-arrows="' . $nav_arrows . '"  data-autoplay="' . $interval*1000 . '">
			<div class="slides">' . do_shortcode( $content ) . '</div>
		</div>';

	return $output;

}

add_shortcode( 'vc_tta_tour', 'vc_tta_tour_function' );


function vc_tta_section_function( $atts, $content ) {

	$parent_tag = vc_post_param( 'parent_tag', '' );

	$output = $title = '';

	extract(shortcode_atts(array(
		'title' => __("Section", "krown")
	), $atts));

	$output .= "\n\t\t\t" . '<section>';
    $output .= "\n\t\t\t\t" . '<h5>' .$title.'</h5>';
    $output .= "\n\t\t\t\t" . '<div class="content">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "krown") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</section> ';

	return $output;

}

add_shortcode( 'vc_tta_section', 'vc_tta_section_function' );