<?php 

/* Logo Item
-------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'logo_item' ) ) {
    function logo_item($atts, $content = null) {
 
		extract(shortcode_atts(array(
		    'logo' => '',
		    'link' => '',
		), $atts));

		$link = ( $link == '||' ) ? '' : $link;
        $link = vc_build_link( $link );

		if ( strlen( $link['url'] ) > 0 ) {
			$link_open = '<a href="' . $link['url'] . '" title="' . $link['title'] . '" target="' . $link['target'] . '">';
			$link_close = '</a>';
		} else {
			$link['title'] = '';
			$link_open = $link_close = '';
		}

		$output = '<div>';

		if( !empty($logo) ) {
			$photo = wp_get_attachment_image_src( $logo, 'full' );
			$output .= $link_open . '<img src="' . $photo[0] . '" alt="' . $link['title'] . '">' . $link_close;
		}

		$output .= '</div>';

		return $output;

	}
}

add_shortcode('logo_item', 'logo_item');