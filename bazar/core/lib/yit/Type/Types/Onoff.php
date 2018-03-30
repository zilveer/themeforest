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
 * YIT Type: OnOff
 * 
 * @since 1.0.0
 */
class YIT_Type_OnOff {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="onoff_container yit_options rm_option rm_input rm_onoff">
                <div class="option">
                    <label><?php echo $value['name'] ?></label>
                    <input type="checkbox" name="<?php yit_field_name( $value['id'] ) ?>" id="<?php echo $value['id'] ?>" value="<?php echo 1 * yit_get_option( $value['id'] ) ?>" <?php checked( 1 * yit_get_option( $value['id'] ), 1 ); ?> class="on_off<?php if(1 * yit_get_option( $value['id'] )): ?> onoffchecked<?php endif ?>" />
                    <span>&nbsp;</span>
                </div>
                <div class="description">
				<?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), ( ( $value['std'] ) ? __( 'On', 'yit' ) : __( 'Off', 'yit' ) ) ) ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}