<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( YIT_Request()->get('updated') == 'true' ): ?>
    <div id="message" class="updated"><p><?php _e( 'Scripts edited successfully.', 'yit' ); ?></p></div>
<?php elseif ( YIT_Request()->get('updated') == 'false' ): ?>
    <div id="message" class="error"><p><?php _e( 'An error occurred while saving the scripts.', 'yit' ); ?></p></div>
<?php endif; ?>

<div class="wrap">
    <h2><?php _e( 'Custom Script', 'yit' ) ?></h2>
    <div class="fileedit-sub">
        <div class="alignleft">
            <?php _e( 'Here you can write all your custom Javascript', 'yit' ); ?>
            <a class="button inline-button" id="yit-add-closure"><?php _e( 'Add jQuery Closure', 'yit' )?></a>
        </div>
        <div class="alignright">
        </div>
    </div>

    <form name="custom-script" method="post">
        <?php wp_nonce_field( 'yit_custom_script_nonce', 'custom_script_nonce' ); ?>
        <textarea cols="70" rows="30" name="<?php echo $option_name?>" id="<?php echo $option_name?>" aria-describedby="<?php echo $option_name?>-description"><?php echo stripslashes_deep(get_option($option_name))?></textarea>
        <input type="hidden" name="custom_script_action" value="update" />
        <?php submit_button( __( 'Update', 'yit' ), 'primary', 'submit', true ); ?>

        <script>
            var editor = CodeMirror.fromTextArea(document.getElementById("<?php echo $option_name?>"), {
                lineNumbers: 1,
                mode: 'javascript',
                showCursorWhenSelecting: true
            });
        </script>
        <script>
            jQuery('#yit-add-closure').click(function(){
                var text = "(function($) {\n";
                text    += "  \"use strict\";\n";
                text    += "  // Author code here\n";
                text    += "\n\n\n";
                text    += "})(jQuery);";
                editor.replaceRange(
                    text,
                    editor.getCursor('end'),
                    editor.getCursor('end')
                )
            })
        </script>
    </form>
