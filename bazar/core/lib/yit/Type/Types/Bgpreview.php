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
 * YIT Type: BgPreview
 * 
 * @since 1.0.0
 */
class YIT_Type_BgPreview {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {
		$config = YIT_Config::load();
		
		$area = isset($value['area']) ? $value['area'] : 'body';
		
		$bg = yit_get_option( $value['id'] );
		
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_select rm_bg-preview">
                <div class="option">
	                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
	                
	                <div class="select_wrapper" style="margin-right: 30px">
	                    <select name="<?php yit_field_name( $value['id'] ); ?>[image]" id="<?php echo $value['id'] ?>_image">
                            <option value=""><?php _e( 'Select a background', 'yit' ) ?></option>
	                        <?php foreach ( $config[ $area . '_backgrounds'] as $val => $option ): ?>
	                            <option value="<?php echo $val ?>"<?php selected( $bg['image'], $val ) ?>><?php echo $option; ?></option>
	                        
	                        <?php endforeach; ?>
	                    </select>
	                </div>

	                <div id="<?php echo $value['id'] ?>_color_container" class="colorpicker_container"><div style="background-color: <?php echo $bg['color'] ?>"></div></div>
    	            <input type="text" name="<?php yit_field_name( $value['id'] ) ?>[color]" id="<?php echo $value['id'] ?>_color" style="width:90px" value="<?php echo $bg['color'] ?>" />



	                <div class="clear"></div>
	                <div class="bg-preview" id="<?php echo $value['id'] ?>_preview"><div style="background: <?php echo $bg['color']; if($bg['image'] != 'custom'): ?> url('<?php echo $bg['image'] ?>') 50% 0<?php endif ?>"></div></div>

                </div>
                <div class="description">
				<?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), ( !empty( $value['std']['image'] ) ? $value['std']['image'] . ', ' : '' ) . $value['std']['color'] ) ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}