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
 * @author     Francesco Licandro <francesco.licandro@gmail.com>
 * @since      1.0.0
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly

if(isset($field['deps'])){
    $deps = $field['deps'];
}

?>

<div id="<?php echo $field['id'] ?>-container" class="yit_options rm_option rm_input rm_number rm_text" <?php if ( isset($deps) ): ?>data-field="<?php echo $field['id'] ?>" data-dep="<?php echo $field['prefix'] . $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>>
    <label for="<?php echo $field['id'] ?>"><?php echo $field['label'] ?></label>
            <span class="field">
                <input class="number" type="number" id="<?php echo $field['id'] ?>" name="<?php echo $field['name'] ?>" <?php if(isset($field['min']) && isset($field['max'])) echo $field['min'].' '.$field['max'] ?> value="<?php echo esc_attr( $field['value'] ) ?>" <?php if( isset( $field['std'] ) ) : ?>data-std="<?php echo $field['std'] ?>"<?php endif ?>" />
                <span class="description"><?php $field['desc'] ?></span>
            </span>
</div>