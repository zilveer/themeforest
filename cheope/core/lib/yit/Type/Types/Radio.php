<?php
/**
 * Your Inspiration Themes
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

/**
 * YIT Type: Radio
 * 
 * @since 1.0.0
 */
class YIT_Type_Radio {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {         
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_radio">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                    
                    <div class="rm_radio">
                    <?php foreach ( $value['options'] as $val => $option ) { ?>
                    	<label class="radio-inline">
                        	<input type="radio" name="<?php yit_field_name( $value['id'] ); ?>" id="<?php echo $value['id'] . '-' . $val ?>" value="<?php echo $val ?>" <?php checked( yit_get_option( $value['id'] ), $val ) ?> /> <?php echo $option ?>
                    	</label>
    				<?php } ?>
                    </div>
                </div>
                <div class="description"><?php echo $value['desc'] ?></div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}