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
 * Colorpicker Admin View
 *
 * @package	Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$current_value = yit_get_option( $id );

?>

<div id="<?php echo $id ?>-container" <?php if ( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_colorpicker colorpicker_<?php echo isset( $variations ) ? count( $variations ) : 1 ?>">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <?php if( ! isset( $variations ) ) : ?>
            <input type="text" name="<?php yit_field_name( $id ) ?>[color]" id="<?php echo $id ?>-color" value="<?php echo esc_attr( $current_value['color'] ) ?>" data-default-color="<?php echo $std['color'] ?>" class="medium-text code panel-colorpicker" />

           <?php if( isset( $std['opacity'] ) ) : ?>
                <div class="clear"></div>
                <div class="number_container wp-picker-opacity">
                    <span class="colorpicker-opacity-label"><?php _e(' Opacity:', 'yit');  ?></span>
                    <input class="number" type="text" name="<?php yit_field_name( $id ) ?>[opacity]" id="<?php yit_field_name( $id ) ?>_opacity" value="<?php echo esc_attr( $current_value['opacity'] ) ?>" data-min="0" data-max="100" />
                </div>
            <?php endif; ?>

        <?php else : ?>
            <?php foreach( $variations as $variation_name => $variation_label ) : ?>
                <input type="text" name="<?php yit_field_name( $id ) ?>[color][<?php echo $variation_name ?>]" id="<?php echo $id ?>-<?php echo $variation_name ?>-color" value="<?php echo esc_attr( $current_value['color'][ $variation_name ] ) ?>" data-variations-label="<?php echo $variation_label ?>" data-default-color="<?php echo $std['color'][ $variation_name ] ?>" class="medium-text code panel-colorpicker" />
            <?php endforeach; ?>
            <div class="clear"></div>
            <?php foreach( $variations as $variation_name => $variation_label ) : ?>

                <?php if( isset( $std['opacity'] ) ) : ?>
                    <div class="number_container wp-picker-opacity">
                        <span class="colorpicker-opacity-label"><?php _e(' Opacity:', 'yit');  ?></span>
                        <input class="number" type="text" name="<?php yit_field_name( $id ) ?>[opacity][<?php echo $variation_name ?>]" id="<?php echo $id ?>_opacity_<?php echo $variation_name ?>" value="<?php echo esc_attr( $current_value['opacity'][ $variation_name ] ) ?>" data-min="0" data-max="100" />
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if( isset( $refresh_button ) && $refresh_button ) : ?>
        <a href="#" class="button-secondary refresh-main-color" data-action="" data-field_id="<?php echo esc_attr( $id ) ?>" data-href="<?php echo esc_url( $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ) ?>">
            <?php _e( 'Change all', 'yit' ) ?>
        </a>
        <span class="spinner"></span>
        <?php endif; ?>

    </div>

    <div class="description">
        <?php echo $desc ?>
        <?php if( ! isset( $variations ) ) : ?>

             <?php
                if( isset( $std['opacity'] ) ) {
                    printf( __( '<br />(Default: color: %s - opacity: %s)', 'yit' ), $std['color'], $std['opacity'] );
                } else {
                    printf( __( '<br />(Default: %s)', 'yit' ), $std['color'] );
                }
            ?>

        <?php else: ?>
            <?php foreach( $variations as $variation_name => $variation_label ) {

                if( isset( $std['opacity'] ) ) {
                    printf( __( '<br />(Default %s: color: %s - opacity: %s)', 'yit' ), $variation_name, $std['color'][ $variation_name ], $std['opacity'][ $variation_name ] );
                } else {
                    printf( __( '<br />(Default %s: %s)', 'yit' ), $variation_name, $std['color'][ $variation_name ] );
                }

            } ?>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>
