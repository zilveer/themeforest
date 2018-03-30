<?php
global $wp_embed;

$options = array(
    'iframe' => isset( $iframe ) && $iframe == 1 ? true : false,
    'url' => isset( $url ) ? $url : '',
    'width' => isset( $width ) ? $width : 0,
    'height' => isset( $height ) ? $height : 'auto',
    'params' => array(
        'show_artwork' => isset( $show_artwork ) && $show_artwork == 'yes' ? true : false,
        'auto_play' => isset( $auto_play ) && $auto_play == 'yes' ? true : false,
        'show_comments' => isset( $show_comments ) && $show_comments == 'yes' ? true : false,
        'color' => isset( $color ) ? str_replace( '#', '', $color ) : 'ff7700'
    )
);

// Both "width" and "height" need to be integers
if( isset($options['width'] ) && !preg_match( '/^\d+$/', $options['width'] ) ) {
    // set to 0 so oEmbed will use the default 100% and WordPress themes will leave it alone
    $options['width'] = 0;
}

if( isset( $options['height'] ) && !preg_match( '/^\d+$/', $options['height'] ) )
    { unset( $options['height'] ); }

if( $iframe ) {
    $html = $wp_embed->shortcode( $options, $options['url'] );
    $html = soundcloud_oembed_params( $html, $options['params'] );
} else {
    // Merge in "url" value
  $options['params'] = array_merge(array(
    'url' => $options['url']
  ), $options['params']);

  // Build URL
  $url = 'http://player.soundcloud.com/player.swf?' . http_build_query($options['params']);
  // Set default width if not defined
  $width = isset($options['width']) && $options['width'] !== 0 ? $options['width'] : '100%';
  // Set default height if not defined
  $height = isset($options['height']) && $options['height'] !== 0 ? $options['height'] : '81';
  
  $notsupported = '<p>' . __('We are sorry but Adobe Flash&copy; is not supported on your device.', 'yit') . '</p>';

  $html = preg_replace('/\s\s+/', "", sprintf('<object width="%s" height="%s">
                                <param name="movie" value="%s"></param>
                                <param name="allowscriptaccess" value="always"></param>
                                <embed width="%s" height="%s" src="%s" allowscriptaccess="always" type="application/x-shockwave-flash">%s</embed>
                              </object>', $width, $height, $url, $width, $height, $url, $notsupported));
}

echo $html;

?>