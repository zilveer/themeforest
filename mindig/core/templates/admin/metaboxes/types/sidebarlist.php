<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}


extract( $args );

$options = yit_registered_sidebars();
?>
<label for="<?php echo $id ?>"><?php echo $label ?></label>
<div class="select_wrapper">
    <select id="<?php echo $id ?>" name="<?php echo $name ?>">
        <?php foreach ( $options as $key => $item ) : ?>
        <option value="<?php echo esc_attr( $key ) ?>"<?php selected( $key, $value ) ?>><?php echo $item ?></option>
        <?php endforeach; ?>
    </select>      
</div>
<span class="desc inline"><?php echo $desc ?></span>