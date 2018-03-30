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
 * Template for admin checklist
 *
 * @package Yithemes
 * @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="fieldset checklist-height" id="<?php echo $var[0] . '-' . $var[2] ?>-container" <?php if ( isset( $var[1]['deps'] ) ): ?>data-field="<?php echo $var[0] . '-' . $var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'] . '-' . $var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >
    <label for="<?php echo $var[0] . '-' . $var[2]; ?>"><?php echo $var[1]['title']; ?></label>
    <div class="checklist">
        <?php if( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ): ?>
            <input type="hidden" class="checklist-value wpb_vc_param_value" name="<?php echo $var[0]; ?>" value="<?php echo ( $var[1]['std'] ) ?>">
        <?php endif; ?>
        <?php foreach ( $var[1]['options'] as $key => $value ) : ?>
            <label class="radio-inline">
                <input class="checklist-options" type="checkbox" name="list-<?php echo $var[0]; ?>" <?php checked( true, in_array( $key, explode( ', ', $var[1]['std'] ) ) ) ?> value="<?php echo $key; ?>" /><?php echo $value; ?>
            </label>
        <?php endforeach; ?>
    </div>
    <div class="clear"></div>
</div>