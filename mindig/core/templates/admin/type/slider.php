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
 * Slider Admin View.
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="slider_container yit_options rm_option rm_input slider_control slider">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <?php $labels = ( isset( $label ) ) ? ' ' . $label : '' ?>
        <div class="ui-slider">
            <span class="minCaption"><?php echo $min . $labels ?></span>
            <span class="maxCaption"><?php echo $max . $labels ?></span>
            <span id="<?php echo $id; ?>-feedback" class="feedback"><strong><?php echo yit_get_option( $id, $std ) . $labels ?></strong></span>

            <div id="<?php echo $id; ?>-div" data-step="<?php echo isset($step) ? $step : 1 ?>" data-labels="<?php echo $labels ?>" data-min="<?php echo $min ?>" data-max="<?php echo $max ?>" data-val="<?php echo yit_get_option( $id, $std ); ?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                <input id="<?php echo $id ?>" type="hidden" name="<?php yit_field_name( $id ); ?>" value="<?php echo esc_attr( yit_get_option( $id, $std ) ); ?>" />
            </div>
        </div>
    </div>

    <div class="description">
        <?php echo $desc ?> <?php printf( __( '(Default: %s)', 'yit' ), $std ) ?>
    </div>
    <div class="clear"></div>
</div>
