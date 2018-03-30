<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );




/** 
 * Returns available templates for feeds collection (used by shortcodes, widgets).
 * 
 * If you want to add/delete some choices, hook into the btp_feeds_collection_templates custom filter.
 *  
 * @return			array 
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



function btp_feeds_get_collection_templates() {
	$templates = array(
		'list-vertical'		=> __( 'list-vertical', 'btp_theme' ),
		'list-horizontal'	=> __( 'list-horizontal', 'btp_theme' ),
	);

	return apply_filters( 'btp_feeds_collection_templates', $templates );
}



/**
 * Returns available feed items.
 *  
 * If you want to add/delete some items, hook into the btp_feeds_items custom filter.
 * 
 * @return			array
 */
function btp_feeds_get_items() {
	$items = array(
		'behance', 
		'blogger', 
		'delicious', 
		'designfloat', 
		'deviantart', 
		'digg', 
		'facebook', 
		'flickr',
		'googleplus',
        'instagram',
		'lastfm', 
		'linkedin',
		'livejournal', 
		'megavideo', 
		'myspace', 
		'piano', 
		'pinterest',
		'playstation', 
		'reddit', 
		'rss', 
		'socialvibe', 
		'spotify', 
		'stumbleupon', 
		'technorati', 
		'tumblr', 
		'twitpic', 
		'twitter', 
		'vimeo', 
		'wordpress', 
		'youtube'
	); 
	
	return apply_filters( 'btp_feeds_items', $items );
}



class BTP_Option_View_Feed extends BTP_Option_View {
	public function get_css_class() { return 'btp-option-view-feed'; }
	
	public function capture_label() {
		$out = '';

		$out .= '<div class="btp-label">';
			$out .= '<h4><img src="' . esc_url( $this->args[ 'icon' ]  ) . '" alt="' . esc_attr( $this->get_name() ) . '" style="margin: 0 7px 0 0; vertical-align: text-bottom;" />' . esc_html( $this->get_label() ) . '</h4>';
		$out .= '</div>';
		
		return $out;
	}
}


?>