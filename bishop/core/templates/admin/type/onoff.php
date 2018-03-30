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
 * On/Off Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="onoff_container yit_options rm_option rm_input rm_onoff">
    <div class="option">
        <label><?php echo $name ?></label>
        <input type="checkbox" name="<?php yit_field_name( $id ) ?>" id="<?php echo $id ?>" value="<?php echo esc_attr( yit_get_option( $id ) ) ?>" <?php checked( yit_get_option( $id ), 'yes' ); ?> class="on_off<?php if( yit_get_option( $id ) == 'yes' ): ?> onoffchecked<?php endif ?>" />
        <span>&nbsp;</span>
    </div>
    <div class="description">
        <?php echo $desc ?> <?php printf( __( '(Default: %s)', 'yit' ), ( ( $std == 'yes' ) ? __( 'On', 'yit' ) : __( 'Off', 'yit' ) ) ) ?>
    </div>
    <div class="clear"></div>
</div>
