<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
 ?>
<div class="google-map-frame  <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?> style="<?php if ($width != '' && $height != '') : ?>width: <?php echo $width; ?>px; height: <?php echo $height; ?>px;<?php else: echo 'width: auto; height: '.$height; endif; ?> ">
	<iframe <?php if ($width != '' && $height != '') : ?>width="<?php echo $width; ?>" <?php else: ?>style="width: 100%;"<?php endif; ?> height="<?php echo $height; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $src; ?>&amp;output=embed&amp;noscroll=1" ></iframe>
<div class="shadow-thumb-sidebar"></div>
</div>