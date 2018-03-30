<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to theme_comments().
 */

function theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment_wrap">
			<div class="gravatar"><?php echo get_avatar($comment,$size='60',$default=''); ?></div>
			<div class='comment_content'>
				<div class="comment_meta">
					<?php printf( '<cite class="comment_author">%s</cite>', get_comment_author_link()) ?><?php edit_comment_link(__('(Edit)', 'striking-r' ),'  ','') ?>
					<time class="comment_time"><?php echo get_comment_date(); ?></time>
				</div>
				<div class='comment_text'>
					<?php comment_text() ?>
<?php if ($comment->comment_approved == '0') : ?>
					<span class="unapproved"><?php _e('Your comment is awaiting moderation.','striking-r') ?></span>
<?php endif; ?>
				</div>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</div>
<?php
}
?>

<?php if ( comments_open() || have_comments()) :?>
<section id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'striking-r' ); ?></p>
</section><!-- #comments -->
<?php
		return;
	endif;
	
if ( have_comments() ) : ?>
	<h3 id="comments_title"><?php
	if (get_comments_number() == 1) { 
			printf( __( 'One Response to %2$s' , 'striking-r') ,'','<em>' . get_the_title() . '</em>' );
	}
		else {
			printf( __( '%1$s Responses to %2$s' , 'striking-r') , get_comments_number(),'<em>' . get_the_title() . '</em>' );
	}
	?></h3>

	<ul class="commentlist">
		<?php
			wp_list_comments( array( 'callback' => 'theme_comments' ) );
		?>
	</ul>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav class="comments_navigation">
		<div class="nav_previous"><?php previous_comments_link(); ?></div>
		<div class="nav_next"><?php next_comments_link(); ?></div>
	</nav>
<?php endif; // check for comment navigation ?>


<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
	/*<p class="nocomments"><?php _e( 'Comments are closed.', 'striking-r' ); ?></p>*/
?>
	
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php if ( comments_open() ) :// Comment Form ?>
	<?php
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$post_id = get_queried_object_id();
	$fields =  array(
		'author' => '<p><input type="text" name="author" class="text_input" id="author" value="'.esc_attr($comment_author).'" size="22" tabindex="1"'.$aria_req.' />' .
		            '<label for="author">' . __('Name','striking-r') . ( $req ? '<span class="required">*</span>' : '' ).'</label></p>',
		'email'  => '<p><input type="text" name="email" class="text_input" id="email" value="'.esc_attr($comment_author_email).'" size="22" tabindex="2"'.$aria_req.' />' .
		            '<label for="email">' . __('Email','striking-r') . ( $req ? '<span class="required">*</span>' : '' ).'</label></p>',
		'url'    => '<p><input type="text" name="url" class="text_input" id="url" value="'.esc_attr($comment_author_url).'" size="22" tabindex="3"'.$aria_req.' />' .
		            '<label for="url">' . __('Website','striking-r') .'</label></p>',		      
	);
	$required_text = sprintf( ' ' . __('Required fields are marked %s','striking-r'), '<span class="required">*</span>' );
	$comment_args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p><textarea class="textarea" name="comment" id="comment" cols="70" rows="10" tabindex="4" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __('You must be <a href="%s">logged in</a> to post a comment','striking-r'), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','striking-r'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.','striking-r') . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		//'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s','striking-r'), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __('Leave a Reply','striking-r'),
		'title_reply_to'       => __('Leave a Reply to %s','striking-r'),
		'cancel_reply_link'    => __('Cancel reply','striking-r'),
		'label_submit'         => __('Post Comment','striking-r'),
	);
	comment_form($comment_args); ?>

<?php endif; ?>

</section><!-- #comments -->
<?php endif; // end ! comments_open() ?>