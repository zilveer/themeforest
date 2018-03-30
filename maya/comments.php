<?php
 
/**
 * @package WordPress
 * @subpackage Kassyopea
 * @since Kassyopea 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'yiw' ); ?></p>
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
			<h3 id="comments-title">
                <?php comments_number(__('no comments', 'yiw'), __('<span>1</span> comment', 'yiw'), __('<span>%</span> comments', 'yiw')); ?>
			</h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'yiw' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'yiw' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist group">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( array( 'type' => 'comment', 'callback' => 'yiw_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'yiw' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'yiw' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
    <?php if( pings_open( get_the_ID() ) ) : ?>
    <!-- START TRACKBACK & PINGBACK -->
	<h2 id="trackbacks"><?php _e( 'Trackbacks and pingbacks', 'yiw' ) ?></h2>
	<?php $numero_trackback = 0; ?>
	<ol class="trackbacklist">
	<?php foreach ($comments as $comment) : 
       if ($comment->comment_type == "trackback" || $comment->comment_type == "pingback") {
       // Visualizzo solo i trackback e pingback
		?>
		<li id="comment-<?php comment_ID() ?>" class="group">
            <cite><?php comment_author_link() ?></cite>
			<br/>
			<?php comment_excerpt(); ?>
		</li>
		<?php 
		$numero_trackback++; 
	   } /* end if ($comment->comment_type... */
	endforeach; /* end for each comment */ 
	?>
	</ol>
	<!-- END TRACKBACK & PINGBACK -->
	
	<?php
	if ($numero_trackback == 0) { ?>
		   <p><em><?php _e('No trackback or pingback available for this article', 'yiw'); ?></em></p>
		<?php }
	?>
    <?php endif; // ping_status ?>	
	

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<!--<p class="nocomments"><?php _e( '&nbsp;', 'yiw' ); ?></p>-->
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php                           
	$commenter = wp_get_current_commenter();
	
	if ( is_user_logged_in() )
		$email_author = get_the_author_meta('user_email');
	else
		$email_author = $commenter['comment_author_email'];

	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$url_avatar = get_template_directory_uri() . '/images/noavatar.png';
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . 
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . 
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);
	
	//$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	$comment_args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">'.__( 'Your comment', 'yiw' ).'</label><textarea id="comment" name="comment" cols="45" rows="8"></textarea></p><div class="clear"></div>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a <span>Reply</span>', 'yiw' ),
		'title_reply_to'       => __( 'Leave a <span>Reply</span> to %s', 'yiw' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'yiw' ),
		'label_submit'         => __( 'Post Comment', 'yiw' ),
	);
	
	comment_form( $comment_args ); 
?>

</div><!-- #comments -->
