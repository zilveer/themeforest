<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Number Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if ( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text rm_upload">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>
        <input type="text" name="<?php yit_field_name( $id ) ?>" id="<?php echo $id ?>" value="<?php echo yit_get_option( $id ) == '1' ? '' : esc_attr( yit_get_option( $id ) ) ?>" class="upload_img_url" />
        <input type="button" value="<?php _e( 'Upload', 'yit' ) ?>" id="<?php echo $id; ?>-button" class="upload_button button" />
    </div>
    <div class="clear"></div>
    <div class="description"><?php echo $desc ?></div>
    <div class="clear"></div>
    <div class="upload_img_preview" style="margin-top:10px;">
        <?php
        $file = yit_get_option( $id );
        if ( preg_match( '/(jpg|jpeg|png|gif|ico)$/', $file ) ) {
            echo "<img src=\"" . YIT_CORE_ASSETS_URL . "/images/sleep.png\" data-src=\"$file\" />";
        }
        ?>
    </div>
</div>