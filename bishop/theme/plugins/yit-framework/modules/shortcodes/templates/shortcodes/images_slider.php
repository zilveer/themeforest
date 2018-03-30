<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for create an image slider
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

/* clean content */

$content =str_replace("<p>","",$content);
$content =str_replace("</p>","",$content);
$content =str_replace("<br>","",$content);
$content =str_replace("</br>","",$content);

$urls = explode("\n", $content);
$urls = array_map('trim', $urls);

if( $width == '0' ) {
    $width = '100%';
}
else {
    $width = $width . 'px';
}

$height = ( $height == '0' ) ? '100%' : $height.'px';

echo '<div class="images-slider-sc '.esc_attr( $vc_css ).'" style="width:' . $width . '; height:' . $height . '" data-effect="'. $effect . '" data-speed="' . $speed . '" data-direction="' . $direction . '">';

echo '<ul class="slides">';

$i = 0;
foreach($urls as $url) {

    $host = $a_before = $a_after = '';
                                            
    if( preg_match( '%^(?=[^&])(?:(?<scheme>[^:/?#]+):)?(?://(?<authority>[^/?#]*))?(?<path>[^?#]*)(?:\?(?<query>[^#]*))?(?:#(?<fragment>.*))?%', $url, $matches ) ) {
        if( empty( $matches[1] ) )
            $url = site_url() . '/' . $matches[3];
        else
            $url = $matches[0];
    }
    
    $url = str_replace( '<br />', '', $url );
    $url = str_replace( array( '<p>', '</p>' ), '', $url );
    
    if($url != ''){
        echo '<li><img style="max-width:100%" src="'. $host . $url . '" alt="'. $i . '" /></li>';
    }
    $i++;
}

echo '</ul></div>';



wp_register_script('yit_flexslider', YIT_Shortcodes()->plugin_assets_url.'/js/flexslider.min.js', array('jquery'), '', true);
wp_register_script('yit_images_slider', YIT_Shortcodes()->plugin_assets_url.'/js/images-slider.min.js', array('jquery', 'yit_flexslider'), '', true);
wp_localize_script('yit_images_slider', 'yit_images_slider_params', array( 'effect' => $effect, 'direction' => $direction, 'speed' => $speed ) );
wp_enqueue_script('yit_images_slider');

add_action( 'wp_enqueue_scripts', array( YIT_Shortcodes(), 'add_handler_images_slider' ), 30 );