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
 * Template file for create a progress bar
 *
 * @package Yithemes
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since 1.0.0
 */

wp_enqueue_script( 'yit-shortcode-easypiechart' );
wp_enqueue_script( 'yit-shortcodes' );

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>
<style>
    .piechart.piechart-<?php echo $size ?>{
        width:<?php echo $size ?>px;
        height:<?php echo $size ?>px;
    }

    .piechart.piechart-<?php echo $size ?> span{
        line-height:<?php echo $size ?>px;
        font-size: <?php echo $font_size ?>px;
    }

</style>
<div class="piechart piechart-<?php echo $size ?> <?php echo esc_attr( $animate . $vc_css ) ; ?>" <?php echo $animate_data ?> data-percent="<?php echo $percent ?>" data-size="<?php echo $size ?>" data-linewidth="<?php echo $line_width ?>" data-barcolor="<?php echo $barcolor ?>" data-trackcolor="<?php echo $trackcolor ?>">
    <span><?php echo do_shortcode($content) ?></span>
</div>