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

//$std = array();


if(isset($field['std'])) {
    $std = $field['std'];
}

?>

<div id="<?php echo $field['id'] ?>-container" class="yit_options clearfix" <?php if ( isset($deps) ): ?>data-field="<?php echo $field['id'] ?>" data-dep="<?php echo $field['prefix'] . $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>>
    <label for="<?php echo $field['id']?>"><?php echo $field['label']?></label>

    <input type="text" name="<?php echo $field['name'] ?>" id="<?php echo $field['id'] ?>" value="<?php echo esc_attr( $field['value'] ) ?>" <?php if( isset( $std ) ) : ?>data-default-color="<?php echo $std ?>"<?php endif ?> class="panel-colorpicker" />
    <span class="description"><?php echo $field['desc'] ?></span>

    <div class="clear"></div>
</div>