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
 * Template file for select size of text
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
	if ( ! is_null( $px ) )
		$size = "{$px}px";
	
	elseif ( ! is_null( $perc ) )
		$size = "{$perc}%";
	
	elseif ( ! is_null( $em ) )
		$size = "{$em}em";
?>		
<span style="font-size: <?php echo $size;?>;"><?php echo do_shortcode( $content ); ?></span>