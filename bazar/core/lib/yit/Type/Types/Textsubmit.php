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
 * YIT Type: Text
 * 
 * @since 1.0.0
 */
class YIT_Type_Textsubmit {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {            
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                <input type="text" name="<?php yit_field_name( $value['id'] ) ?>" id="<?php echo $value['id'] ?>" value="<?php echo yit_get_option( $value['id'] ) ?>" />
                <input type="submit" value="<?php echo $value['submit']; ?>" id="<?php echo $value['id'] ?>-button" class="input_button button" />
                </div>
                <div class="description">
                    <?php echo $value['desc'] ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}