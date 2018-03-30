<?php
/**
 * Functions used in the footer
 */

if ( ! function_exists( 'mc_display_footer_social_links' ) ) {
	/**
	 * Display social links in the footer
	 */
	function mc_display_footer_social_links() {
		$social_networks 		= apply_filters( 'mc_set_social_networks', mc_get_social_networks() );
		$social_links_output 	= '';
		$social_link_html		= apply_filters( 'mc_footer_social_link_html', '<a class="%1$s" href="%2$s"></a>' );
		
		foreach ( $social_networks as $social_network ) {
			if ( isset( $social_network[ 'link' ] ) && !empty( $social_network[ 'link' ] ) ) {
				$social_links_output .= sprintf( '<li>' . $social_link_html . '</li>', $social_network[ 'icon' ], $social_network[ 'link' ] );
			}
		}

		if ( !empty ( $social_links_output ) ) {
			$social_links_output = '<div class="social-icons">
										<h3>' . apply_filters( 'media_center_get_in_touch_text', __( 'Get in touch', 'mediacenter' ) ) . '</h3>
										<ul>' . $social_links_output . '</ul>
									</div>';
			echo apply_filters( 'mc_footer_social_links_html', $social_links_output );
		}
	}
}