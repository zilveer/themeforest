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
 * Template file for create a content in two column of a third
 *
 * @package Yithemes
 * @autor Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
	$classes = array( 'col-sm-8' );
	
    // additional classes
    if( $class != '' )    
        $classes[] = $class;
	
	// last
	$classes[] = ( isset($last) && $last == 'yes' ) ? 'last' : '';
    $classes[] = $vc_css;
?>

<div class="<?php echo implode( $classes, ' ' ); ?>"><?php echo apply_filters( 'the_content', $content ); ?></div>

<?php  echo ( isset($last) && $last == 'yes' ) ? '<div class="clear"></div>' : ''; ?>