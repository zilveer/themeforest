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
 * Template file for create a table box of prices
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

/* Empty <p> Fix*/
$content = wpautop( trim( $content ) );

$content = str_replace( '<p>', '', $content );
$content = str_replace( '</p>', '', $content );
$content = str_replace( '<br />', '', $content );
/* */
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
?>

<div class="cols-3 <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?> >
	<?php echo do_shortcode($content); ?>
</div>
<div style="clear:both"></div>