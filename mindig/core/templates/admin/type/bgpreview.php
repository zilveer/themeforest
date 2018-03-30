<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$bgs = yit_get_backgrounds();
$bg = yit_get_option( $id );

?>

<div id="<?php echo $id ?>-container" <?php if ( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_select rm_bg-preview">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <div class="select_wrapper" style="margin-right: 30px">
            <select name="<?php yit_field_name( $id ); ?>[image]" id="<?php echo $id ?>_image">
                <option value=""><?php _e( 'Select a background', 'yit' ) ?></option>
                <?php foreach ( $bgs as $val => $option ): ?>
                    <option value="<?php echo esc_attr( $val ) ?>"<?php selected( $bg['image'], $val ) ?>><?php echo $option; ?></option>

                <?php endforeach; ?>
            </select>
        </div>

        <div id="<?php echo $id ?>_color_container" class="colorpicker_container">
            <div style="background-color: <?php echo $bg['color'] ?>"></div>
        </div>
        <input class="code panel-colorpicker" type="text" name="<?php yit_field_name( $id ) ?>[color]" id="<?php echo $id ?>_color" style="width:90px" value="<?php echo esc_attr( $bg['color'] ) ?>" />


        <div class="clear"></div>
        <div class="bg-preview" id="<?php echo $id ?>_preview">
            <div style="background: <?php echo $bg['color'] ?> url('<?php echo ( $bg['image'] != 'custom' ) ? $bg['image'] : '' ?>') 50% 0"></div>
        </div>

    </div>
    <div class="description">
        <?php echo $desc ?> <?php printf( __( '(Default: %s)', 'yit' ), ( ! empty( $std['image'] ) ? $std['image'] . ', ' : '' ) . $std['color'] ) ?> <br />
        <?php printf( __('You can add more backgrounds to this list just by adding the images within the folder <code>%s/images/backgrounds/</code>', 'yit') , get_template_directory_uri()); ?>
    </div>
    <div class="clear"></div>
</div>