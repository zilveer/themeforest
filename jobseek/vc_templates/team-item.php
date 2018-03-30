<?php 

/* Logo Item
-------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'logo_item' ) ) {
    function logo_item($atts, $content = null) {
 
		extract(shortcode_atts(array(
		    'logo'     => '',
		    'logo_url' => '',
		), $atts));

		if( !empty( $el_class ) ) $el_class = ' ' . $el_class;

		if( !empty( $el_class ) ) {
			$logo_url = vc_build_link( $logo_url );
			$link_open = '<a href="' . $logo_url['url'] . '" title="' . $logo_url['title'] . '" target="' . $logo_url['target'] . '">';
			$link_close = '</a>';
		} else {
			$link_open = $link_close = '';
		}

		$output = '<div>';

		if( !empty($logo) ) {
			$photo = wp_get_attachment_image_src( $logo, 'full' );
			$output .= $link_open . '<img src="' . $photo[0] . '" class="img-responsive">' . $link_close;
		}

		$output .= '</div>';

		return $output;

	}
}

add_shortcode('logo_item', 'logo_item');