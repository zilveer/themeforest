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
 * Template file for show a simple custom button, with icon
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
	
	if( $icon_path != '' ):
		$icon_path = esc_url( $icon_path );
	endif;
	//else
		//$path = get_template_directory_uri() . '/images/icons/for_button/' . $icon . '.png';
	
	$style = '';
	if( isset($icon_path) && $icon_path != '' )
		$style = ' style="background-image:url(\'' . $icon_path . '\')"';	
?>

<a class="more-button more-button-<?php echo $sense; ?>" href="<?php echo $href; ?>" title="<?php echo $content; ?>">
	<?php echo $content; ?>
	<span class="icon <?php echo $icon; ?>"<?php echo $style; ?>>&nbsp;</span>
</a>