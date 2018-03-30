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
 * Template file for create a toggle content
 *
 * @package Yithemes
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0.0
 */

wp_enqueue_script( 'yit-shortcodes' );

$style = array();
$animate_data = ( $animate != '' ) ? ' data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

if ( $background_type == "color" ) {
	$style[] = "background:$background_color;";
}
elseif ( $background_type == "image" ) {
	$style[] = "background-image:url($background_image); background-size: cover;";
}

if ( $height != '' ) {
	$style[] = "height: {$height}px;'";
}

$style = ! empty( $style ) ? ' style="' . implode( '', $style ) . '"' : '';
?>
<div class="section-background-outer">
    <div class="section-background <?php echo $animate ?>"<?php echo $style.$animate_data; ?>></div>
</div>
<?php if ( $with_content == 'no' ) : ?><div style="height: <?php echo $height ?>px;"></div><?php endif; ?>