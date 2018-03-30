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
 * YIT Type: Upload
 * 
 * @since 1.0.0
 */
class YIT_Type_Upload {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
     * @todo check why if the fields is empty, then prints 1 (string value)
	 */
    public static function display( $value, $dep ) {
        ob_start(); ?>
            <div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text rm_upload">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                    <input type="text" name="<?php yit_field_name( $value['id'] ) ?>" id="<?php echo $value['id'] ?>" value="<?php echo yit_get_option( $value['id'] ) == '1' ? '' : yit_get_option( $value['id'] ) ?>" class="upload_img_url" />
                    <input type="button" value="<?php _e('Upload', 'yit') ?>" id="<?php echo $value['id'] ; ?>-button" class="upload_button button" />
                </div>
                <div class="clear"></div>
                <div class="description"><?php echo $value['desc'] ?></div>
                <div class="clear"></div>
                <div class="upload_img_preview" style="margin-top:10px;">
                    <?php
                        $file = yit_get_option($value['id']);
                        if(preg_match('/(jpg|jpeg|png|gif|ico)$/',$file)) echo "<img src=\"".YIT_CORE_ASSETS_URL."/images/sleep.png\" data-src=\"$file\" />";
                    ?>
                </div>
            </div>
        <?php
        return ob_get_clean();
    }
}