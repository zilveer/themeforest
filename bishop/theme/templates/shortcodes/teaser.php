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
 * Template file for create a banner with an image, a link and text.
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */


$title = ( isset( $title ) ) ? $title : '';
$subtitle = ( isset( $subtitle ) ) ? $subtitle : '';
$image = ( isset( $image ) ) ? esc_url( $image ) : '';
$link = ( isset( $link ) ) ? esc_url( $link ) : '';
$slogan_position = ( isset( $slogan_position ) ) ? $slogan_position : '';

if ( $image != '' ) {
    $attachment_image_id = yit_plugin_get_attachment_id( $image );

    $attachment_image_info = yit_getimagesize( $image );
}

?>

<?php if ( $image != '' ) : ?>
    <div class="teaser <?php echo esc_attr( $vc_css ); ?>">
        <?php if( $link != '' ) : ?>
        <a href="<?php echo $link ?>">
            <?php endif; ?>
            <div class="image">
                <img src="<?php yit_image( "id={$attachment_image_id}&size=teaser_widget&output=url" ) ?>">
                <div class="image-banner">
                    <div class="image-banner-inside">
                        <div class="image-banner-text <?php echo $slogan_position ?>">
                            <p class="title"><?php echo $title ?></p>
                            <p class="subtitle"><?php echo $subtitle ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if( $link != '' ) : ?>
        </a>
    <?php endif; ?>
    </div>
<?php endif ?>