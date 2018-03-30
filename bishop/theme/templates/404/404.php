<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

 $image_url = "";
 $text ="";
 $is_custom_content = ( yit_get_option( 'content-enable-404' ) == "no" );
//---------------------------------------------------------------------
 if( $is_custom_content ) {
     $image_url= get_template_directory_uri(). "/images/404.png";
     $text =__( 'I suggest you to use this search box below:', 'yit' );
 }
else {
    $image_url  = yit_get_option( 'content-404-image' );
    $text = yit_convert_tags( yit_addp( do_shortcode( stripslashes( yit_get_option( 'content-404-text' ) ) ) ) );
}
?>

    <div class="error-404-image-container">
        <?php if( isset( $image_url ) && $image_url != '' ): ?>
        <img class="error-404-image group" src="<?php echo $image_url ?>" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="404" />
        <?php endif; ?>
    </div>
    <div class="error-404-text group">
        <p><?php printf( $text , home_url() ) ?></p>
        <?php get_search_form(); ?>
    </div>


