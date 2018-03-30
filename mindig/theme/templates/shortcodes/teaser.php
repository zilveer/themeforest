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
$button = ( isset( $button ) ) ? $button : '';


if ( $image != '' ) {
    $attachment_image_id = yit_plugin_get_attachment_id( $image );
    //TODO: DISCUTERE SE INCLUDERE NEL PLUGIN LA CLASSE Image.php
    $attachment_image_info = yit_getimagesize( $image );
}

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';
?>

<?php if ( $image != '' ) : ?>
    <div class="teaser-wrapper <?php echo esc_attr( $animate . $vc_css ); ?>" <?php echo $animate_data ?>>
        <div class="image" style="width: <?php echo $attachment_image_info[0] ?>px; height: <?php echo $attachment_image_info[1] ?>px;">
            <img src="<?php echo ( $attachment_image_id ) ? yit_image( "id={$attachment_image_id}&size=teaser_widget&output=url", false ) : esc_url( $image ) ?>">

            <div class="image_banner_inside" style="height: <?php echo $attachment_image_info[1] ?>px;">
                <div class="image_banner_text <?php echo $slogan_position ?>">
                    <?php if( $link != '' && $button == '' ) : ?>
                    <a href="<?php echo $link ?>">
                        <?php endif; ?>

                        <p class="title"><?php echo $title ?></p>

                        <p class="subtitle"><?php echo $subtitle ?></p>
                        <?php if ( $button != '' ): ?>
                            <a href="<?php echo $link ?>" class="btn btn-ghost"><?php echo  $button ?></a>
                        <?php endif ?>
                        <?php if( $link != '' && $button == '' ) : ?>
                    </a>
                <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
<?php endif; ?>