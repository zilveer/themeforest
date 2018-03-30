<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="yit_options reset-<?php echo sanitize_title($title) ?>">

    <h3><?php echo $title ?></h3>

    <p><?php echo str_replace('%s', get_template(), $desc) ?></p>

    <p>
        <?php if( isset( $multi ) && $multi ) : ?>
            <div class="select_wrapper multi_link">
                <select name="<?php echo sanitize_title($title); ?>[]" class="select_wrapper multi_link" id="select_multi_link">
                    <?php foreach ( $options as $val => $option ) { ?>
                        <option value="<?php echo esc_attr( $option['href'] ) ?>"><?php echo $option['msg']; ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php endif; ?>

        <a class="<?php if( isset($link_class) ): echo $link_class; endif; ?> button button-secondary link-button" href="<?php echo $link_href ?>"><?php echo $link_name ?></a>
    </p>

</div>