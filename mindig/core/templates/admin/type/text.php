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
 * Text Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if ( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>
        <input type="text" name="<?php echo yit_field_name( $id ) ?>" id="<?php echo $id ?>" <?php if ( ! isset( $button ) ) : ?>value="<?php echo esc_attr( yit_get_option( $id ) ) ?>"<?php endif ?>  />

        <?php if ( isset( $button ) ) : ?>
            <input type="submit" value="<?php echo esc_attr( $button ) ?>" class="button" name="button_save" id="<?php echo $id ?>_save">
        <?php endif ?>
    </div>
    <div class="description">
        <?php echo $desc ?>
    </div>
    <div class="clear"></div>
</div>
