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
 * Template file for select a special font of text
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$style = '';
	if ( ! is_null( $size ) )
		$style = ' style="font-size:' . $size . $unit . ';"';
?>	

<span class="special-font"<?php echo $style; ?>><?php echo do_shortcode( $content ); ?></span>