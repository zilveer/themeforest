<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template for admin colorpicker
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]?>-container" <?php if ( isset($var[1]['deps']) ): ?>data-field="<?php echo $var[0].'-'.$var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'].'-'.$var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >
    <label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php if (isset($var[1]['title']) && $var[1]['title'] != '') : echo $var[1]['title']; else: echo $var[0]; endif; ?></label>
	
	<div id="<?php echo $var[0].'-'.$var[2]; ?>_container" class="colorpicker_container">
		<div style="background-color: <?php echo $var[1]['std'] ?>;"></div>
    	<input type="text" name="shortcode-<?php echo $var[0]; ?>" id="<?php echo $var[0].'-'.$var[2]; ?>" style="width:150px" value="<?php echo $var[1]['std'] ?>" />
    </div>
    <div class="clear"></div>
    
    <script type="text/javascript" charset="utf-8">

        jQuery(document).ready(function($){
			
			$('#<?php echo $var[0].'-'.$var[2]; ?>').wpColorPicker();
        });

	</script>
</div>