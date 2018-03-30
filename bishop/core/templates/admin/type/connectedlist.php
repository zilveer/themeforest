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
 * Connected List Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text rm_connectedlist">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <?php $yit_option = json_decode( stripslashes( yit_get_option( $id ) ), true ); ?>
        <?php $lists = is_array($yit_option) ? $yit_option : $lists; ?>

        <?php foreach( $lists as $list=>$options ): ?>
            <div class="list_container">
                <h4><?php echo $heads[$list] ?></h4>
                <ul id="list_<?php echo $list ?>" class="connectedSortable" data-list="<?php echo $list ?>">
                    <?php foreach( $options as $option=>$label ): ?>
                        <li data-option="<?php echo $option ?>" class="ui-state-default"><?php echo $label ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endforeach ?>
        <input type="hidden" name="<?php yit_field_name( $id ) ?>" id="<?php echo $id ?>" value='<?php echo esc_attr( yit_get_option( $id ) ) ?>' />
    </div>
    <div class="description">
        <?php echo $desc ?>
    </div>
    <div class="clear"></div>
</div>