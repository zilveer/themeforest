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
 * Template file for show text highlight
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

?>
<span class="shortcode-highlight <?php echo esc_attr( $vc_css ) ?>" style="color:<?php echo $text_color ?>; background-color:<?php echo $background_color ?>;"><?php echo do_shortcode($content); ?></span>