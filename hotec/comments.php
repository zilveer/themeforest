<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.",'smooththemes'); ?></p>
	<?php
		return;
	}
?>

<div id="comments">
<!-- You can start editing here. -->
<!--if there is one comment-->
<?php if ( have_comments() ) : ?><!--you need the id comments for the links to the comments-->
    	<h4 class="comments-header-title"><?php comments_number(__('No Responses','smooththemes'), __('One Response','smooththemes'), __('% Responses','smooththemes') );?> to &#8220;<?php the_title(); ?>&#8221;</h4>
    	<ol class="comments-list"><!--one comment-->
    	   <?php wp_list_comments('callback=st_comments'); ?>
    	</ol>
    <!--comments navi-->
    <div class="comment_nav">
    	<?php previous_comments_link("<span class='comment_prev advancedlink'>&laquo; ".__('Older Comments','smooththemes')."</span>") ?>
    	<?php next_comments_link("<span class='comment_next advancedlink'>".__('Newer Comments','smooththemes')." &raquo;</span>") ?>
    </div>
	
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
        <h3 class="meta" id="comments">
            <?php comments_number(__('No Responses','smooththemes'), __('One Response','smooththemes'), __('% Responses','smooththemes') );?> 
            <?php _e('to','smooththemes'); ?> &#8220;<span class="t"><?php the_title(); ?></span>&#8221;
        </h3>    
        <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<span class="meta"><?php _e('Comments are closed.','smooththemes'); ?></span>

	<?php endif; ?>
<?php endif; ?><!--end of comments-->

<!--beginn of the comments form-->
<?php if ('open' == $post->comment_status) : ?>

    <div id="respond"><!--you need div  id response for threaded comments-->
    <?php comment_form_title( '', '<h3 class="reply-title">'.__('Leave a Reply to %s').'</h3>'); ?>
    <!--if registration is required-->
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p>
        <?php _e('You must be','smooththemes'); ?> 
        <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
            <?php _e('logged in','smooththemes'); ?>
        </a> 
        <?php _e('to post a comment.','smooththemes'); ?>
    </p>

<?php else : ?>
     <!--begin of the comment form read and understand -->
    <?php 
    $user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
    if ($comment_author == '')  $comment_author = '';
    if ($comment_author_email == '') $comment_author_email = '';
    if ($comment_author_url == '') $comment_author_url = '';
    
   	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$required_text = sprintf( ' ' . __('Required fields are marked %s','smooththemes'), '<span class="required">*</span>' );
    $args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comemnt',
	'title_reply' => __( 'Leave a Reply','smooththemes' ),
	'title_reply_to' => __( 'Leave a Reply to %s','smooththemes'),
	'cancel_reply_link' => __( 'Cancel Reply','smooththemes'  ),
	'label_submit' => __( 'Post Comment','smooththemes' ),
	'comment_field' => '<div class="form-line"><label for="comment_txt">' . __( 'Comment','smooththemes') . '</label><br /><textarea id="comment_txt" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
	'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'smooththemes' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ,'smooththemes'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.','smooththemes') . ( $req ? $required_text : '' ) . '</p>',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
    		'author' => '<div class="form-line comment-form-author">' . '<label for="author">' . __( 'Name','smooththemes' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br /><input id="author" name="author" type="text" value="' . esc_attr( $comment_author) . '" size="30"' . $aria_req . ' /></div>',
    		'email' => '<div class="form-line comment-form-email"><label for="email">' . __( 'Email','smooththemes' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<br /><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
    		'url' => '<div class="form-line comment-form-url"><label for="url">' . __( 'Website','smooththemes' ) . '</label>' . '<br /><input id="url" name="url" type="text" value="' . esc_attr($comment_author_url ) . '" size="30" /></div>' ) ) );
    
    comment_form($args); ?>
    <?php endif; // If registration required and not logged in ?>
</div><!-- respond -->
<?php endif; // if you delete this the sky will fall on your head ?>

</div><!-- #comments -->