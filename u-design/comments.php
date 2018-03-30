<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */

// Do not delete these lines
if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
        die('Please do not load this page directly. Thanks!');
}

if ( post_password_required() ) { ?>
        <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'udesign'); ?></p>
<?php   return;
}
global $udesign_options; ?>


<?php /* You can start editing from here: */ ?>

        <div class="clear"></div>

<?php   if ( have_comments() ) : ?>

            <h5 id="comments"><?php comments_number(__('No Responses', 'udesign'), __('1 Comment', 'udesign'), __('% Comments', 'udesign')); ?></h5>
            <div class="clear"></div>
            <ol class="commentlist">
<?php           wp_list_comments( 'type=comment&callback=udesign_theme_comment' ); ?>
            </ol>
            <div class="clear"></div>
<?php
            // comment pagination
            if ( function_exists('wp_commentnavi') ) :
                wp_commentnavi();
            else : ?>
                <div class="navigation">
                    <div class="alignleft"><?php previous_comments_link() ?></div>
                    <div class="alignright"><?php next_comments_link() ?></div>
                </div>
<?php       endif; ?>
            
<?php   endif; ?>
            
        <div class="clear"></div>
        
<?php   // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) && ( $udesign_options['show_comments_are_closed_message'] ) ) : ?>

            <p class="nocomments"><?php esc_html_e('Comments are closed.', 'udesign'); ?></p>
            <div class="clear"></div>
<?php   endif; // If comments are closed ?>

            

<?php   $comments_args = array(
            'class_form'            =>  'u-design-comment-form comment-form',
            'comment_notes_before'  =>  '',
            // change the title of send button 
            'label_submit'          =>  esc_attr__('Submit Comment', 'udesign'),
            // redefine the comment textarea field
            'comment_field'         =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'udesign' ) . '</label><br />' . 
                                        '<textarea id="comment" name="comment" cols="100%" rows="10" aria-required="true" required="required"></textarea></p>',
        );

        comment_form( $comments_args );
?>
            
        <div class="clear"></div>
            
            
