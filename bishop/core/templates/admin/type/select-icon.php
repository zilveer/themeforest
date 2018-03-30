<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Awesome Icon Admin View
 *
 * @package	Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$current_options = yit_get_option( $id );
?>



<div id="<?php echo $id ?>-container" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options select_icon rm_option rm_input rm_text">
    <label for="<?php echo $id ?>"><?php echo $name ?></label>

    <div class="option">
        <div class="select_wrapper icon_type">
            <select name="<?php yit_field_name( $id ); ?>[select]" id="<?php echo $id ?>">
                <?php foreach ( $options['select'] as $val => $option ) { ?>
                    <option value="<?php echo $val ?>"<?php selected( $current_options['select'], $val ) ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </div>




        <div class="select_wrapper awesome_icon" style="font-family: 'FontAwesome'">
            <select style="font-family: 'FontAwesome'" name="<?php yit_field_name( $id ); ?>[icon]" id="<?php echo $id ?>[icon]">
                <?php foreach ( $options['icon'] as $option => $val ) { $esc_icon = ! empty( $option ) ? '&#x' . $option . '; ' : ''; ?>
                    <option value="<?php echo $val ?>"<?php selected( $current_options['icon'], $val ); ?>>
                        <?php echo $esc_icon . $val; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="input_wrapper custom_icon">
            <input type="text" name="<?php yit_field_name( $id ) ?>[custom]" id="<?php echo $id . '-custom' ?>" value="<?php echo $current_options['custom'] ?>" class="upload_img_url upload_custom_icon" />
            <input type="button" value="<?php _e( 'Upload', 'yit' ) ?>" id="<?php echo $id; ?>-custom-button" class="upload_button button" />

            <div class="upload_img_preview" style="margin-top:10px;">
                <?php
                $file = $current_options['custom'];
                if ( preg_match( '/(jpg|jpeg|png|gif|ico)$/', $file ) ) {
                    echo __('Image preview', 'yit') . ': ' . "<img src=\"" . YIT_CORE_ASSETS_URL . "/images/sleep.png\" data-src=\"$file\" />";
                }
                ?>
            </div>

        </div>
    </div>

    <div class="clear"></div>


    <div class="description">
        <?php echo $desc ?>
        <?php if( $std['select'] == 'custom' ) : ?>
            <?php printf( __( '(Default: %s <img src="%s"/>)', 'yit' ), $options['select']['custom'], $std['custom'] ) ?>
        <?php else: ?>
            <?php printf( __( '(Default: %s <i class="fa fa-%s"></i> %s)', 'yit' ), $options['select']['icon'], $options['icon'][ array_search( $std['icon'], $options['icon'] ) ], $options['icon'][ array_search( $std['icon'], $options['icon'] ) ]  ) ?>
        <?php endif; ?>
    </div>

    <div class="clear"></div>

</div>
