<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', BRANKIC_THEME_SHORT); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
     <div class="post" id="comments">
        <h3 class="title"><?php                
                comments_number(__('No Comments', BRANKIC_THEME_SHORT), __('One Comment', BRANKIC_THEME_SHORT), __('% Comments', BRANKIC_THEME_SHORT)); ?></h3>       
                       
        <ul class="comment-list">
        <?php wp_list_comments('callback=bra_cust_comment'); ?>
        </ul><!--END comment-list-->
            
    </div><!--END post-->

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', BRANKIC_THEME_SHORT); ?></p>

	<?php endif; ?>
<?php endif; ?>
 <div class="post">
<div class="comment-form-wrapper">
<?php if ( comments_open() ) : ?>      

<?php 
$defaults = array(
    'id_form'              => 'comment-form',
    'id_submit'            => 'submit',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'title_reply'          => __( 'Leave a comment', BRANKIC_THEME_SHORT ),
    'title_reply_to'       => __( 'Leave a Reply to %s', BRANKIC_THEME_SHORT ),
    'cancel_reply_link'    => __( 'Cancel reply', BRANKIC_THEME_SHORT ),
    'label_submit'         => __( 'Submit Comment', BRANKIC_THEME_SHORT ),
);
comment_form($defaults); 
?> 

<?php endif; // if you delete this the sky will fall on your head 
?>
            </div> <!-- end of comment-form-wrapper -->
        
        </div><!--END post--> 
<?php


function bra_cust_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li>                        

                    <div>
                        <div class="avatar">
                            <?php echo get_avatar($comment, 45); ?>                               
                        </div><!--END AVATAR-->
                        
                        <div class="comment-meta">
                            <p class="author"><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></p>
                            <p class="date"><?php comment_time('M j, Y'); ?> - <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', BRANKIC_THEME_SHORT), 'login_text' => __('Log in to leave a comment', BRANKIC_THEME_SHORT), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>                       
                        </div><!--END COMMENT-META-->

                        <div class="comment-wrap" id="comment-<?php comment_ID(); ?>">
                             <?php comment_text() ?>   
                        </div><!--END COMMENT-WRAP-->
                    </div>
                             
                
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', BRANKIC_THEME_SHORT); ?></em></p>
<?php endif; ?>                

<?php 
}



?>