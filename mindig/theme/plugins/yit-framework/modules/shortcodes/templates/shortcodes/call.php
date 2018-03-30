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
 * Template file for shows a box with an incipit and a number phone
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

$style = '';
if ( is_null( $incipit ) ) {
    $style = ' style="margin-top:0;line-height:101px;"';
}
else {
    $incipit = '<p>' . $incipit . '</p>';
}

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>
<div class="<?php echo esc_attr( $class . $animate . $vc_css ); ?>" <?php echo $animate_data ?>>
    <div class="incipit">
        <h2<?php echo $style; ?>><?php echo $title; ?></h2>
        <?php echo $incipit; ?>
    </div>
    <div class="separate-phone"></div>
    <div class="number-phone"><?php echo $phone; ?></div>
    <div class="clear"></div>
    <div class="decoration-image"></div>
</div>