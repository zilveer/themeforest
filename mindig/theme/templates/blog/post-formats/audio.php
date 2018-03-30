<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $wp_embed;

$url = yit_get_post_meta( get_the_ID(), '_audio-url' );
if( $url == '' ) return;

$iframe = ( bool ) yit_get_post_meta( get_the_ID(), '_audio-iframe' );
$show_artwork = ( bool ) yit_get_post_meta( get_the_ID(), '_audio-artwork' );
$show_comments = ( bool ) yit_get_post_meta( get_the_ID(), '_audio-comments' );
$auto_play = ( bool ) yit_get_post_meta( get_the_ID(), '_audio-play' );
$color = yit_get_post_meta( get_the_ID(), '_audio-color' );

$options = array(
    'iframe' => isset( $iframe ) && $iframe == 1 ? true : false,
    'url'    => isset( $url ) ? $url : '',
    'width'  => ( isset( $image_size['width'] ) && $iframe &&  ! (  is_singular( 'post' ) || ( isset($doing_ajax) && $doing_ajax ) ) ) ? $image_size['width'] : 0,
    'height' => ( isset( $image_size['height'] ) && $iframe ) ? $image_size['height'] : 'auto',
    'params' => array(
        'show_artwork'  => isset( $show_artwork ) && ( $show_artwork == 'yes' || $show_artwork ) ? true : false,
        'auto_play'     => isset( $auto_play ) && ( $auto_play == 'yes' || $auto_play ) ? true : false,
        'show_comments' => isset( $show_comments ) && ( $show_comments == 'yes' || $show_comments ) ? true : false,
        'color'         => isset( $color ) ? str_replace( '#', '', $color ) : 'ff7700',
    )
);

// Both "width" and "height" need to be integers
if ( isset( $options['width'] ) && ! preg_match( '/^\d+$/', $options['width'] ) ) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
}

if ( isset( $options['height'] ) && ! preg_match( '/^\d+$/', $options['height'] ) ) {
    unset( $options['height'] );
}

if ( $iframe ) {
    $html = $wp_embed->shortcode( $options, $options['url'] );
    $html = soundcloud_oembed_params( $html, $options['params'] );
}
else {
    // Merge in "url" value
    $options['params'] = array_merge( array(
        'url' => $options['url']
    ), $options['params'] );

    // Build URL
    $url = 'http://player.soundcloud.com/player.swf?' . http_build_query( $options['params'] );
    // Set default width if not defined
    $width = isset( $options['width'] ) && $options['width'] !== 0 ? $options['width'] : '100%';
    // Set default height if not defined
    $height = isset( $options['height'] ) && $options['height'] !== 0 ? $options['height'] : '81';

    $notsupported = '<p>' . __( 'We are sorry but Adobe Flash&copy; is not supported on your device.', 'yit' ) . '</p>';

    $html = preg_replace( '/\s\s+/', "", sprintf( '
                        <object width="%s" height="%s">
                            <param name="movie" value="%s">
                            <param name="allowscriptaccess" value="always">
                            <param name="wmode" value="transparent">
                            <embed wmode="transparent" width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash">%s</embed>
                          </object>', $width, $height, $url, $width, $height, $url, $notsupported ) );
}

?>

<div class="post-format <?php echo $post_format ?>">
    <?php echo $html; ?>
</div>