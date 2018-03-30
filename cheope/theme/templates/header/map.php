<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post;
if( !is_page() || !isset( $post->ID ) )
    { return; }
 
$map_url = yit_get_post_meta( get_the_ID(), '_google-map' );
$link_view_map = $map_url;

if( empty( $map_url ) )
    { return; }

if ( strstr( $map_url, '/maps/place/' ) ) { // New Google Maps URL

    $cp_array = explode( '/', $map_url);
    $cp_array_2 = explode( ',', $cp_array[6] );

    $cp_query = $cp_array[5];
    $cp_ll = str_replace( '@', '', $cp_array_2[0] ) . ',' . $cp_array_2[1];
    $cp_zoom = str_replace( 'z', '', $cp_array_2[2] );

    $map_url = 'https://maps.google.com/maps?sll=' . $cp_ll . '&q=' . $cp_query . '&z=' . $cp_zoom . '&ll=' . $cp_ll . '&output=embed';
    $link_view_map = str_replace('&output=embed','',$map_url);
}


$is_gmap = false;
if( strstr( $map_url, 'maps.google' ) )
    { $is_gmap = true; }

if( !$is_gmap ) {
    $image_id = yit_get_attachment_id( $map_url );
    
    if ( $image_id != 0 ) {
        list( $image_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id, 'map_image' );      
        if ( empty( $width ) )  $width = $image_width;
        if ( empty( $height ) ) $height = $image_height;
        $img_attrs['src'] = $image_url;
    }
    
    $image_link = yit_get_post_meta( get_the_ID(), '_google-map-link' );
    if( !empty( $image_link ) )
        $image = '<a target="_blank" style="display:block;" href="' . $image_link .'"><img class="span12" src="' . $image_url . '" title="" alt="" /></a>';
    else
        $image = '<img class="span12" src="' . $image_url . '" title="" alt="" />';
}

?>
<!-- START MAP -->
<div id="map">
    <?php if( $is_gmap ) : ?>
    <iframe
        style="width:100%;height:335px;"
        frameborder="0" 
        scrolling="no" 
        marginheight="0" 
        marginwidth="0" 
        src="<?php echo $map_url ?>&amp;output=embed">
    </iframe>
    <?php else : ?>
    <?php echo $image  ?>
    <?php endif ?>
    
    <div id="map-handler" class="container"><a href="#"><?php _e( '[x] Close', 'yit' ) ?></a></div>
</div>
<!-- END MAP -->