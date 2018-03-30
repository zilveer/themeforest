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
 * @author     Francesco Licandro <francesco.licandro@yithemes.it>
 * @since      1.0.0
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly

if(isset($field['deps'])){
    $deps = $field['deps'];
}

?>
<div id="<?php echo $field['id'] ?>-container" class="slider_container" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $field['id'] ?>" data-dep="<?php echo $field['prefix'] . $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>>
    <label for="<?php echo $field['id'] ?>"><?php echo $field['label'] ?></label>
    <div class="ui-slider">
        <span class="minCaption"><?php echo $field['min']  ?></span>
        <span class="maxCaption"><?php echo $field['max']  ?></span>
        <span id="<?php echo $field['id'] ?>-feedback" class="feedback"><strong><?php echo $field['value'] ?></strong></span>

        <div id="<?php echo $field['id'] ?>-div" data-step="<?php echo isset( $field['step'] ) ? $field['step'] : 1 ?>" data-labels="<?php echo '' ?>" data-min="<?php echo $field['min'] ?>" data-max="<?php echo $field['max'] ?>" data-val="<?php echo $field['value']; ?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
            <input id="<?php echo $field['id'] ?>" type="hidden" name="<?php echo $field['name'] ?>" value="<?php echo esc_attr( $field['value'] ); ?>" />
        </div>
    </div>
    <span class="description"><?php echo $field['desc'] ?></span>
</div>

