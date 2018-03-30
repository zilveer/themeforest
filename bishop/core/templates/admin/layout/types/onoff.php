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
?>

<div id="<?php echo $field['id'] ?>-container" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $field['id'] ?>" data-dep="<?php echo $field['prefix'] . $deps['ids']?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?> class="onoff_container yit_options rm_option rm_input rm_onoff">
        <label for="<?php echo $field['id'] ?>"><?php echo $field['label'] ?></label>
        <input type="checkbox" name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>" value="<?php echo esc_attr( $field['value'] ) ?>" <?php checked( $field['value'], 'yes' ); ?> class="on_off<?php if ( $field['value'] == 'yes' ): ?> onoffchecked<?php endif ?>" />
        <span>&nbsp;</span>
    <span class="description"><?php echo $field['desc'] ?></span>
</div>