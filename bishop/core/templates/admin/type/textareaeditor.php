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
 * Text Area Editor Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$editor_args = array(
    'wpautop' => false, // use wpautop?
    'media_buttons' => false, // show insert/upload button(s)
    'textarea_name' => yit_field_name( $id, false ),
    'textarea_rows' => 30, // rows="..."
    'tabindex' => '',
    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
    'editor_class' => '', // add extra class(es) to the editor textarea
    'teeny' => false, // output the minimal editor config used in Press This
    //'dfw' => false, // replace the default fullscreen with DFW (needs specific DOM elements and css)
    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
);

?>

<div id="<?php echo $id ?>-container" <?php if( isset( $deps ) ): ?>data-field="<?php echo $deps['field'] ?>" data-dep="<?php echo $deps['dep'] ?>" data-value="<?php echo $deps['value'] ?>" <?php endif ?>class="yit_options rm_textareaeditor rm_option rm_input rm_text">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?></label>
        <?php wp_editor( yit_get_option( $id ), $id, $editor_args ); ?>
    </div>
    <div class="description">
        <?php echo $desc ?>
    </div>
    <div class="clear"></div>
</div>
