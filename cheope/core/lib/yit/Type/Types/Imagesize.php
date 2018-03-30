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
class YIT_Type_ImageSize {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {

        $option_value  = yit_get_option( $value['id'] );
        $width  = 160;
        $height = 160;
        $crop   = '';

        if ( is_array( $option_value ) ) {
            if ( isset( $option_value['width'] ) ) {
                $width = $option_value['width'];
            }
            if ( isset( $option_value['height'] ) ) {
                $height = $option_value['height'];
            }
            if ( isset( $option_value['crop'] ) ) {
                if( $option_value['crop'] == '1' || $option_value['crop']==true ) {
                    $crop   = 'value="1" checked';
                }
            }
        }

		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_image_size">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                    <input name="<?php yit_field_name( $value['id'] ); ?>[width]" id="<?php yit_field_name( $value['id'] ); ?>-width" type="text" size="3"
                           value="<?php echo $width; ?>" /> &times;
                    <input name="<?php yit_field_name( $value['id'] ); ?>[height]" id="<?php yit_field_name( $value['id'] ); ?>-height" type="text" size="3"
                           value="<?php echo $height; ?>" />px

                    <input name="<?php  yit_field_name( $value['id'] ); ?>[crop]" id="<?php  yit_field_name( $value['id'] ); ?>-crop" type="checkbox"
                            <?php echo $crop; ?> /> <?php _e( 'Hard Crop?', 'yit' ); ?>

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