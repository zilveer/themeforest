<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register default metaboxes.
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

extract( $args );
?>
<label for="<?php echo $id ?>"><?php echo $title ?></label>
<div id="<?php echo $id ?>_container" class="colorpicker_container"><div style="background-color: <?php echo $value ?>"></div></div>
<input type="text" name="<?php echo $name ?>" id="<?php echo $id ?>" value="<?php echo $value ?>" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?> />
<span class="desc inline"><?php echo $desc ?></span>
            
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){
	
	$('#<?php echo $id ?>_container').parent().removeClass('colorpicker');
	$('#<?php echo $id ?>_container').ColorPicker({
		color: '<?php echo $value ?>',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#<?php echo $id ?>_container div').css('backgroundColor', '#' + hex);
			$( '#<?php echo $id ?>_container' ).next( 'input' ).attr( 'value', '#' + hex );
		}
	});
    
});
</script>