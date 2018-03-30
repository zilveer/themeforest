<?php
/**
 * Share template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 1.0.0
 */

global $yith_wcwl;

if( !is_user_logged_in() ) { return; }

if (!function_exists('sf_get_share_links')) {
	function sf_get_share_links( $url ) {
	    $normal_url = $url;
	    $url = urlencode( $url );
	    $title = urlencode( get_option( 'yith_wcwl_socials_title' ) );
	    $twitter_summary = str_replace( '%wishlist_url%', '', get_option( 'yith_wcwl_socials_text' ) );
	    $summary = urlencode( str_replace( '%wishlist_url%', $normal_url, get_option( 'yith_wcwl_socials_text' ) ) );
	    $imageurl = urlencode( get_option( 'yith_wcwl_socials_image_url' ) );
	
	    $html  = '<div class="yith-wcwl-share">';
	    $html .= apply_filters( 'yith_wcwl_socials_share_title', '<span>' . __( 'Share on:', 'yit' ) . '</span>' );
	    $html .= '<ul class="social-icons">';
	
	    if( get_option( 'yith_wcwl_share_fb' ) )
	    { $html .= '<li class="facebook" style="list-style-type: none; display: inline-block;"><a target="_blank" class="facebook" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . $title . '&amp;p[url]=' . $url . '&amp;p[summary]=' . $summary . '&amp;p[images][0]=' . $imageurl . '" title="' . __( 'Facebook', 'yit' ) . '"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>'; }
	
	    if( get_option( 'yith_wcwl_share_twitter' ) )
	    { $html .= '<li class="twitter" style="list-style-type: none; display: inline-block;"><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . $url . '&amp;text=' . $twitter_summary . '" title="' . __( 'Twitter', 'yit' ) . '"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>'; }
	
	    if( get_option( 'yith_wcwl_share_pinterest' ) )
	    { $html .= '<li class="pinterest" style="list-style-type: none; display: inline-block;"><a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;description=' . $summary . '&media=' . $imageurl . '" onclick="window.open(this.href); return false;"><i class="fa-pinterest"></i><i class="fa-pinterest"></i></a></li>'; }
	
	    if( get_option( 'yith_wcwl_share_googleplus' ) == 'yes' )
	    { $html .= '<li class="googleplus" style="list-style-type: none; display: inline-block;"><a target="_blank" class="googleplus" href="https://plus.google.com/share?url=' . $url . '&amp;title="' . $title . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>'; }
	
	    $html .= '</ul>';
	    $html .= '</div>';
	
	    return $html;
	}
}

if( get_option( 'yith_wcwl_share_fb' ) == 'yes' || get_option( 'yith_wcwl_share_twitter' ) == 'yes' || get_option( 'yith_wcwl_share_pinterest' ) == 'yes' ) {
    $share_url  = $yith_wcwl->get_wishlist_url();
    $share_url .= get_option( 'permalink-structure' ) != '' ? '&amp;user_id=' : '?user_id=';
    $share_url .= get_current_user_id();
    echo sf_get_share_links( $share_url );
}