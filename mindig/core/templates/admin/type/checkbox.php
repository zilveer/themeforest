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
 * Checkbox Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$value = yit_get_option( $id );
?>

<div id="<?php echo $id ?>-container" <?php if ( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>
        <input type="checkbox" name="<?php yit_field_name( $id ) ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( $value ) ?>" <?php checked( $value, 'yes' ); ?> class="checkbox-inline"  />
    </div>
    <div class="description">
        <?php echo $desc ?> <?php printf( __( '(Default: %s)', 'yit' ), ( ( $std ) ? __( 'On', 'yit' ) : __( 'Off', 'yit' ) ) ) ?>
    </div>
    <div class="clear"></div>
</div>
