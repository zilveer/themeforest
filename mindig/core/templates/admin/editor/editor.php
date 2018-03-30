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
 * @var $file string un file
 */
if ( YIT_Request()->get('updated') == 'true' ): ?>
    <div id="message" class="updated"><p><?php _e( 'File edited successfully.', 'yit' ); ?></p></div>
<?php elseif ( YIT_Request()->get('updated') == 'false' ): ?>
    <div id="message" class="error"><p><?php _e( 'An error occurred while saving the file.', 'yit' ); ?></p></div>
<?php endif; ?>

<div class="wrap">
<?php //screen_icon(); ?>
<h2><?php _e('Custom Style', 'yit') ?></h2>

<div class="fileedit-sub">
    <div class="alignleft">
        <h3><?php echo $filename ?></h3>
    </div>
    <div class="alignright">
    </div>
</div>

<form name="template" method="post">
    <?php wp_nonce_field( 'yit_custom_style' ); ?>
    <textarea cols="70" rows="30" name="newcontent" id="newcontent" aria-describedby="newcontent-description"><?php echo $content; ?></textarea>
    <input type="hidden" name="customcss_action" value="update" />

    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("newcontent"), {
            lineNumbers: 1,
            showCursorWhenSelecting: true
        });
    </script>

    <div>
        <?php if ( is_child_theme() && !file_exists(STYLESHEETPATH . '/' . $filename) ) : ?>
            <p><?php if ( is_writeable( $file ) ) { ?><strong><?php _e( 'Caution:', 'yit' ); ?></strong><?php } ?>
                <?php printf( __( "This is a file in your current parent theme. It's highly recommended to create a <strong>%s</strong> file in your child theme folder.", 'yit' ), $filename); ?></p>
        <?php endif; ?>
        <?php
        if ( is_writeable( $file ) ) :
            submit_button( __( 'Update File', 'yit' ), 'primary', 'submit', true );
        else : ?>
            <p><em><?php _e('You need to make this file writable before you can save your changes. See <a href="http://codex.wordpress.org/Changing_File_Permissions">the Codex</a> for more information.', 'yit'); ?></em></p>
        <?php endif; ?>
    </div>
</form>
