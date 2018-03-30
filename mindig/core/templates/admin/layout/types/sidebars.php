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
 * Select Plugin Admin View
 *
 * @package    Yithemes
 * @author     Emanuela Castorina <emanuela.castorina@yithemes.it>
 * @since      1.0.0
 */


if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly
$layout = ! isset( $field['value']['layout'] ) ? 'sidebar-no' : $field['value']['layout'];
$sidebar_left = ! isset( $field['value']['sidebar-left'] ) ? '-1' : $field['value']['sidebar-left'];
$sidebar_right = ! isset( $field['value']['sidebar-right'] ) ? '-1' : $field['value']['sidebar-right'];

?>
<div class="yit-sidebar-layout yit_options rm_option rm_input rm_text">
    <div class="option">
        <label for="_slider_name"><?php echo $field['label'] ?></label>

        <input type="radio" name="<?php echo $field['name'] ?>[layout]" id="<?php echo $field['id'] . '-left' ?>" value="sidebar-left" <?php checked( $layout, 'sidebar-left' ) ?> />
        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sidebar-left.png" title="<?php _e( 'Left sidebar', 'yit' ) ?>" alt="<?php _e( 'Left sidebar', 'yit' ) ?>" class="<?php echo $field['id'] . '-left' ?>" />

        <input type="radio" name="<?php echo  $field['name'] ?>[layout]" id="<?php echo $field['id'] . '-right' ?>" value="sidebar-right" <?php checked( $layout, 'sidebar-right' ) ?> />
        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sidebar-right.png" title="<?php _e( 'Right sidebar', 'yit' ) ?>" alt="<?php _e( 'Right sidebar', 'yit' ) ?>" class="<?php echo $field['id'] . '-right' ?>" />

        <input type="radio" name="<?php echo  $field['name'] ?>[layout]" id="<?php echo $field['id'] . '-double' ?>" value="sidebar-double" <?php checked( $layout, 'sidebar-double' ) ?> />
        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/double-sidebar.png" title="<?php _e( 'Double sidebar', 'yit' ) ?>" alt="<?php _e( 'Double sidebar', 'yit' ) ?>" class="<?php echo $field['id'] . '-double' ?>" />

        <input type="radio" name="<?php echo  $field['name'] ?>[layout]" id="<?php echo $field['id'] . '-no' ?>" value="sidebar-no" <?php checked( $layout, 'sidebar-no' ) ?> />
        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/no-sidebar.png" title="<?php _e( 'No sidebar', 'yit' ) ?>" alt="<?php _e( 'No sidebar', 'yit' ) ?>" class="<?php echo $field['id'] . '-no' ?>" />
    </div>
    <div class="clearfix"></div>
    <div class="option" id="choose-sidebars">
        <div class="side">
            <div class="select-mask" <?php if ( $layout != 'sidebar-double' && $layout != 'sidebar-left' ) { echo 'style="display:none"'; } ?> id="<?php echo $field['id'] ?>-sidebar-left-container">
                <label for ="<?php echo $field['id'] ?>-sidebar-left"><?php _e('Sidebar Left','yit') ?></label>
                <select name="<?php echo  $field['name'] ?>[sidebar-left]" id="<?php echo $field['id'] ?>-sidebar-left">
                    <option value="-1"><?php _e( 'Choose a sidebar', 'yit' ) ?></option>
                    <?php foreach ( yit_registered_sidebars() as $val => $option ) { ?>
                        <option value="<?php echo esc_attr( $val ) ?>" <?php selected( $sidebar_left, $val ) ?>><?php echo $option; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="side">
            <div class="select-mask"  <?php if ( $layout != 'sidebar-double' && $layout != 'sidebar-right' ) { echo 'style="display:none"'; } ?> id="<?php echo $field['id'] ?>-sidebar-right-container">
                <label for ="<?php echo $field['id'] ?>-sidebar-right"><?php _e('Sidebar Right','yit') ?></label>
                <select name="<?php echo  $field['name'] ?>[sidebar-right]" id="<?php echo $field['id'] ?>-sidebar-right">
                    <option value="-1"><?php _e( 'Choose a sidebar', 'yit' ) ?></option>
                    <?php foreach ( yit_registered_sidebars() as $val => $option ) { ?>
                        <option value="<?php echo esc_attr( $val ) ?>" <?php selected( $sidebar_right, $val ) ?>><?php echo $option; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>


