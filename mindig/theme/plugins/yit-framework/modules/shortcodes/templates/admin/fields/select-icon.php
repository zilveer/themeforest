<?php
/*
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
 * @package    Yithemes
 * @author     Andrea Grillo <andrea.grillo@yithemes.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


$id = $var[0] . '-' . $var[2];
$options = $var[1]['options'];
$fontFamily = ( isset( $var[1]['fontFamily'] ) ) ? $var[1]['fontFamily'] : 'FontAwesome';

?>


<div class="fieldset" id="<?php echo $id ?>-container" <?php if ( isset( $var[1]['deps'] ) ): ?>data-field="<?php echo $var[0] . '-' . $var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'] . '-' . $var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?>>
    <label for="<?php echo $id ?>"><?php echo $var[1]['title']; ?></label>

    <div class="select_wrapper awesome_icon" style="font-family: '<?php echo $fontFamily ?>'">
        <select style="font-family: '<?php echo $fontFamily ?>'" class="<?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? 'wpb_vc_param_value' : '' ?>" name="<?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? '' : 'shortcode-' ?><?php echo $var[0] ?>" id="<?php echo $var[0].'-'.$var[2]; ?>">
            <?php foreach ( $options as $option => $val ) { $esc_icon = ( ! empty( $option ) )? '&#x' . $option . '; ' : ''; ?>
                <option value="<?php echo $val ?>" <?php if( isset( $var[1]['std'] ) ): selected( $val, $var[1]['std'] ); endif; ?> >
                    <?php echo $esc_icon . $val; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="clear"></div>


    <?php if ( isset( $var[1]['description'] ) && $var[1]['description'] != '' ) : ?>
        <span class="description"><?php echo $var[1]['description']; ?></span>
    <?php endif; ?>

    <div class="clear"></div>

</div>
