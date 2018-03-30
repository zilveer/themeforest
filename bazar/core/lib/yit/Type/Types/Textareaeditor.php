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
 * YIT Type: TextareaEditor
 *
 * @since 1.0.0
 */
class YIT_Type_Textareaeditor {

	/**
	 * Load and print the correspondent field type.
	 *
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {
		$editor_args = array(
			'wpautop' => false, // use wpautop?
			'media_buttons' => true, // show insert/upload button(s)
			'textarea_name' => yit_get_field_name( $value['id'] ),
			'textarea_rows' => 30, // rows="..."
			'tabindex' => '',
			'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
			'editor_class' => '', // add extra class(es) to the editor textarea
			'teeny' => false, // output the minimal editor config used in Press This
			//'dfw' => false, // replace the default fullscreen with DFW (needs specific DOM elements and css)
			'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
			'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
		);
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_textareaeditor rm_option rm_input rm_text">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                <?php wp_editor( yit_get_option( $value['id'] ), $value['id'], $editor_args ); ?>
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
