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
class YIT_Type_Connectedlist {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {            
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text rm_connectedlist">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>

					<?php $yit_option = json_decode( stripslashes( yit_get_option( $value['id'] ) ), true ); ?>
					<?php $value['lists'] = is_array($yit_option) ? $yit_option : $value['lists']; ?>

					<?php foreach( $value['lists'] as $list=>$options ): ?>
					<div class="list_container">
						<h4><?php echo $value['heads'][$list] ?></h4>
						<ul id="list_<?php echo $list ?>" class="connectedSortable" data-list="<?php echo $list ?>">
							<?php foreach( $options as $option=>$label ): ?>
	                    		<li data-option="<?php echo $option ?>" class="ui-state-default"><?php echo $label ?></li>
	                    	<?php endforeach ?>
	                    </ul>
                    </div>
					<?php endforeach ?>
					<input type="hidden" name="<?php yit_field_name( $value['id'] ) ?>" id="<?php echo $value['id'] ?>" value='<?php echo yit_get_option( $value['id'] ) ?>' />
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