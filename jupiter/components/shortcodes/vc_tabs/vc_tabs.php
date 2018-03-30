<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();


if( ! function_exists( 'vc_tabs__get_tabs' ) ) {
	function vc_tabs__get_tabs( $list_item_markup = '', $content = '' ) {

		$html = '';
		$has_tabs = preg_match_all( "/(.?)\[(vc_tab)\b(.*?)(?:(\/))?\]/s", $content, $matches );

		if ( $has_tabs ) {
		    for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
		    	$tab = $matches[ 3 ];
		        $tab[ $i ] = shortcode_parse_atts( $tab[ $i ] );

		        $has_icon = isset( $tab[ $i ][ 'icon' ] ) ? true : false;
		        $li_class = $has_icon ? ' tab-with-icon' : '';
				// set first tab to active 
		        $li_class .= ($i == 0) ? ' is-active' : '';
		        $icon  = $has_icon ? $tab[ $i ][ 'icon' ] : false;
		        $title = $tab[ $i ][ 'title' ];

		        if( $has_icon ) {
		            $icon_class = (strpos($icon, 'mk-') !== false) ? $icon : ( 'mk-'.$icon.'' );
					$set_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon_class,16);
		        } else {
		            $set_icon = '';
		        }

		        $html .= sprintf( $list_item_markup, $li_class, $set_icon, $title );
		    }
		}

		return $html;
	}
}


if( ! function_exists( 'vc_tabs__get_panes' ) ) {
	function vc_tabs__get_panes( $content ) {

		$html = wpb_js_remove_wpautop( $content );
		$html = phpQuery::newDocument( $html );
		// set first pane to active 
		pq( '.mk-tabs-pane' )
			->eq( 0 )
			->addClass( 'is-active' );

		return $html;
	}
}
   


/**
 * Custom CSS Output
 * ==================================================================================*/

$class = '';

$orientation_css = '';
if( $style == 'default' ) {
    $orientation_css = ' '.$orientation.'-style ';
} 

$tab_location_css = '';
if( $orientation == 'vertical' ) {
	$tab_location_css = ' vertical-'.$tab_location;
}

// Collect additional classes based on user settings
$class .= ' mobile-'.$responsive;
$class .= ' '.$tab_location_css;
$class .= ' '.$style.'-style';
$class .= ' '.$orientation_css;
$class .= ' '.$el_class;



if( !empty($container_bg_color) ) {
	Mk_Static_Files::addCSS('
		#mk-tabs-'.$id.' .mk-tabs-tabs .is-active a,
		#mk-tabs-'.$id.' .mk-tabs-panes, 
		#mk-tabs-'.$id.' .mk-fancy-title span {
		    background-color: '.$container_bg_color.'
		}
	', $id);
}

include( $path . '/template.php' );
