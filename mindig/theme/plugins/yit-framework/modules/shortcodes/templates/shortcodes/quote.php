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
 * Template file for adds the content into a box quote
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$author = ( $author == '' ) ? '' : '<span>'.$author.'</span>';
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>


<div class="yit_post_quote  <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
    <i class="fa fa-quote-left shade-1"></i>
    <h2 class="quote-title"><?php  echo $author ?></h2>
    <p><?php echo do_shortcode($content); ?></p>
</div>