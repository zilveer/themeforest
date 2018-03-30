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
 * Template file for show a number background with a title and text
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>

<div class="box-sections numbers-sections margin-bottom <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
    <div class="number-box">
        <div class="number"><?php echo $number ?></div>
        <?php if( !empty( $title ) ) yit_plugin_string( '<h4>', yit_plugin_decode_title($title), '</h4>' ); ?>
    </div>
    <div class="clear"></div>
	<?php echo apply_filters( 'the_content', $content ); ?>
</div>