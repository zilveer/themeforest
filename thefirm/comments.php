<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 * 
 * Modified for The Firm WP Theme
 * 
 */
?>
<?php $eet_option = eet_get_global_options(); ?>
 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'eet_textdomain' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>

			<h4 class="comments-title"><?php echo $eet_option['eetcnt_trc_comm']; ?>(<?php comments_number('0', '1', '%'); ?>)</h4>

<?php if ( get_comment_pages_count() > 1 ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'eet_textdomain' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'eet_textdomain' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'elentech_comments' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'eet_textdomain' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'eet_textdomain' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php if (is_single()) {echo 'Comments are closed.';}; ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments()
$aria_req = ( $req ? " aria-required='true'" : '' ); //accesibility stuff
?>



            <?php $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
    'author' => '<div class="formflooat"><p class="comment-form-author formfloatl formm">' .
                '<label for="author">'.$eet_option['eetcnt_trc_name'].'</label> <br/> 
                <input id="author" name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' />' .
                '</p><!-- #form-section-author .form-section -->',
    'email'  => '<p class="comment-form-email formfloatl formm">' .
                '<label for="email">'.$eet_option['eetcnt_trc_email'].'</label><br/> 
                <input id="emailc" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />' .
                '</p><!-- #form-section-email .form-section -->',
    'url'    => '<p class="comment-form-url formfloatr formm">' .
                '<label for="url">'.$eet_option['eetcnt_trc_website'].'</label><br/>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
                '</p></div><!-- #form-section-url .form-section -->' ) ),
    'comment_field' => '<p class="comment-form-comment">' .
                '<label for="comment">'.$eet_option['eetcnt_trc_comme'].'</label><br/>' .
                '<textarea id="comment" name="comment" cols="45" rows="8" tabindex="4" aria-required="true"></textarea>' .
                '</p><div class="clearfix"></div><!-- #form-section-comment .form-section -->',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'eet_textdomain' ), wp_login_url( ) ) . '</p>',
        'comment_notes_before' => '',
    'comment_notes_after' => '',
    'id_form' => 'commentform',
    'id_submit' => 'submitC',
    'title_reply' => $eet_option['eetcnt_trc_lar'],
    'title_reply_to' => $eet_option['eetcnt_trc_lar'],
    'cancel_reply_link' => 'Cancel',
    'label_submit' => $eet_option['eetcnt_trc_pco']
); ?>


<div id="send_comm"><?php comment_form($defaults); ?></div>

</div><!-- #comments -->
<div class="clearfix"></div>