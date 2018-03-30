<?php

/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit;
} // Exit if accessed directly

?>
<div id="<?php echo $field['id'] ?>-container" class="yit_options clearfix" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $field['id'] ?>" data-dep="<?php echo $field['prefix'] . $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>>
        <label for="<?php echo $field['id'] ?>"><?php echo $field['label'] ?></label>
        <input type="checkbox" class="checkbox" id="<?php echo $field['id'] ?>" name="<?php echo $field['name'] ?>" value="1" <?php if ( isset( $field['std'] ) ) : ?>data-std="<?php echo $field['std'] ?>" <?php endif; checked( $field['value'], 1 ) ?> />
        <span class="description"><?php echo $field['desc'] ?></span>
</div>