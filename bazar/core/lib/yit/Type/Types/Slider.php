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
 * YIT Type: Slider
 * 
 * @since 1.0.0
 */
class YIT_Type_Slider {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="slider_container yit_options rm_option rm_input slider_control slider">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>

				<?php $labels = ( isset( $value['label'] ) ) ? ' ' . $value['label'] : '' ?>
                <div class="ui-slider">
                    <span class="minCaption"><?php echo $value['min'] . $labels ?></span>
                    <span class="maxCaption"><?php echo $value['max'] . $labels ?></span>
                    <span id="<?php echo $value['id']; ?>-feedback" class="feedback"><strong><?php echo yit_get_option( $value['id'], $value['std'] ) . $labels ?></strong></span>
                    
                    <div id="<?php echo $value['id']; ?>-div" data-step="<?php echo isset($value['step']) ? $value['step'] : 1 ?>" data-labels="<?php echo $labels ?>" data-min="<?php echo $value['min'] ?>" data-max="<?php echo $value['max'] ?>" data-val="<?php echo yit_get_option( $value['id'], $value['std'] ); ?>" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <input id="<?php echo $value['id'] ?>" type="hidden" name="<?php yit_field_name( $value['id'] ); ?>" value="<?php echo yit_get_option( $value['id'], $value['std'] ); ?>" />
                    </div> 
                </div> 

                </div>
                <div class="description">
				<?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), $value['std'] ) ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php 
		return ob_get_clean();
	}
}