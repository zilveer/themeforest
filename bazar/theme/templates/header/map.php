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
if( empty( $map_url ) )
    { return; }

$is_gmap = false;
if( strpos( $map_url, 'maps.google' ) || preg_match( '#google\.(.*)?/maps#', $map_url ) )
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
} ?>
<!-- START MAP -->
<div id="map">
	<h3><?php echo yit_get_option( 'gmap-text' ) ?></h3>
	<div class="border">
	    <?php if( $is_gmap ) : ?>
	    <iframe
	        frameborder="0"
	        scrolling="no"
	        marginheight="0"
	        marginwidth="0"
	        src="<?php echo $map_url ?>&amp;output=embed">
	    </iframe>
	    <?php else : ?>
	    <?php echo $image  ?>
	    <?php endif ?>
       

        <!--div id="map-handler" class="container"><a href="#"><?php _e( '[x] Close', 'yit' ) ?></a></div>
        <div class="map-overlay-top"></div>
        <div class="map-overlay-bottom"></div>
        <div></div>-->
	</div>
</div>
<!-- END MAP -->