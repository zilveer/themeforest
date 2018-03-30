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
 * Awesome Icon Admin View
 *
 * @package	Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if ( isset( $deps ) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>

        <div class="select_wrapper" style="font-family: 'FontAwesome'">
            <select style="font-family: 'FontAwesome'" name="<?php yit_field_name( $id ); ?>" id="<?php echo $id ?>">
                <?php foreach ( $options as $option => $val ) { ?>
                    <option value="<?php echo $val ?>"<?php selected( yit_get_option( $id ), $val ) ?>>
                        <?php echo '&#x' . $option . '; ' . $val; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

    </div>
    <div class="description">
        <?php echo $desc ?> <?php printf( __( '(Default: <i class="fa fa-%s"></i> %s)', 'yit' ), $std, $options[ array_search( $std, $options ) ] ); ?>
    </div>
    <div class="clear"></div>
</div>