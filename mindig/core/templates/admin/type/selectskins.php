
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
 * Select Admin View
 *
 * @package	Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$is_multiple = isset( $multiple ) && $multiple;
$multiple = ( $is_multiple ) ? ' multiple' : '';

$db_value = yit_get_option( $id );

if ( $std === false ) {
    $std_string = 'none';
}
elseif ( $is_multiple ) {
    $std_string = '';
    foreach ( $std as $value ) {
        $std_string .= $options[$value] . ' ';
    }

    if ( ! is_array( $db_value ) ) {
        $db_value = array();
    }
}
else {
    $std_string = $options[$std];
}
?>
<div id="<?php echo $id ?>-container" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <div class="select_wrapper skin_change">
            <select name="<?php yit_field_name( $id ); ?><?php if( $is_multiple ) echo "[]" ?>" class="select_wrapper skin_type" id="<?php echo $id ?>" <?php echo $multiple ?> >
                <?php foreach ( $options as $val => $option ) { ?>
                    <option data-skin_name="<?php echo $val; ?>" value="<?php echo esc_attr( $val ) ?>"<?php ($is_multiple) ? selected( true, in_array( $val,  $db_value ) ) : selected( $db_value, $val ) ?>><?php echo $option['msg']; ?></option>
                <?php } ?>
            </select>
        </div>
        <a href="#" data-selected="<?php echo $db_value ?>" data-action="yit_change_skin" class="button-primary change-theme-skin" data-field_id="<?php echo $id ?>"><?php _e( 'Change demo', 'yit' ) ?></a>
        <a href="#" data-selected="<?php echo $db_value ?>" data-action="yit_reset_skin" class="button-secondary reset-theme-skin" data-field_id="<?php echo $id ?>"><?php _e( 'Reset demo', 'yit' ) ?></a>
        <span class="spinner"></span>
    </div>
    <div class="skin_image">
        <img src="<?php echo YIT_THEME_ASSETS_URL . '/images/skins/' . $db_value . '.png' ?>" class="skin_preview" data-previewurl="<?php echo YIT_THEME_ASSETS_URL . '/images/skins/' ?>"/>
    </div>

    <div class="clear"></div>
</div>