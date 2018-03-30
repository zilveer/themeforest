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

wp_enqueue_script( 'yit-shortcodes' );

$inside_style = ( $text_position == 'inside' ) ? 'style="height: '.$line_height.'px;line-height: '.$line_height.'px;"' : '';
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$data_speed = ( $speed != '' ) ? ' data-speed="' . $speed . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

$style_title = ( isset ( $font_color ) ) ? 'style="font-size:' . $font_size . 'px; color:' . $font_color .';"' : 'style="font-size:' . $font_size . 'px; color:#000000;"';

?>

<div class="yit-progress-bar text-<?php echo esc_attr( $text_position . $animate . $vc_css ) ?>" <?php echo $animate_data.$data_speed; ?>>
    <?php if ( $text_position != 'after' ):  ?>
        <div class="bar-meta" <?php echo $inside_style ?>><span class="bar-title" <?php echo $style_title ?>><?php echo $title ?></span> <span class="bar-value" <?php echo $style_title ?>><?php echo $percent ?>%</span></div>
    <?php endif; ?>
    <div class="progress" style="height:<?php echo $line_height ?>px;  background-color: <?php echo $trackcolor ?>;">
        <div class="progress-bar <?php echo $speed ?>" role="progressbar"  data-progress="<?php echo $percent ?>" style="<?php if ( wp_is_mobile() ) : ?>width: <?php echo $percent ?>%; <?php endif; ?>height:<?php echo $line_height ?>px; background-color: <?php echo $barcolor ?>;">
            <span class="sr-only"><?php echo $percent ?>% Complete</span>
        </div>
    </div>
    <?php if ( $text_position == 'after' ):  ?>
        <div class="bar-meta" <?php echo $inside_style ?>><span class="bar-title" <?php echo $style_title ?>><?php echo $title ?></span> <span class="bar-value" <?php echo $style_title ?>><?php echo $percent ?>%</span></div>
    <?php endif; ?>
</div>

