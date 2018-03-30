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
 * Template for admin select
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]?>-container" <?php if ( isset($var[1]['deps']) ): ?>data-field="<?php echo $var[0].'-'.$var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'].'-'.$var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >
    <label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
    <div class="select_wrapper">
        <select id="<?php echo $var[0].'-'.$var[2]; ?>" name="shortcode-<?php echo $var[0]; ?>">
            <?php if ($var[1]['std'] == '') : ?>
                <option value=""><?php _e('Choose your option' , 'yit'); ?></option>
            <?php endif ?>
            <?php foreach ( $var[1]['options'] as $key => $value) : ?>
                <option <?php if ( $var[1]['std'] == $key ) : ?> selected="selected" <?php endif ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="button" class="button-secondary <?php echo $var[1]['class']?>" value="<?php echo $var[1]['button_name']?>"/>
    <span class="spinner"></span>
    <?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?>
        <span class="description"><?php echo $var[1]['description']; ?></span>
    <?php endif; ?>
</div>