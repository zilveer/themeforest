<?php if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'satori' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '&nbsp;&nbsp;//&nbsp;&nbsp;Edit', 'satori' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="comment-wrapper">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size ); ?></div><!-- .comment-author .vcard -->
						<div class="comment-info"><span class="comment-author"><?php echo comment_author_link(); ?></span><span class="comment-date"><?php echo comment_date(); ?></span>

					<?php edit_comment_link( __( '&nbsp;&nbsp;//&nbsp;&nbsp;Edit', 'satori' ), '<span class="edit-link">', '</span>' ); ?></div>
				

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'satori' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'satori' ). ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply --></div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

?> 


<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'satori' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<div id="comments-top"></div>
		<h3 id="comments-title">
			<?php
				$numcom = get_comments_number();
				if ( $numcom == 1 ) {
					echo __( 'One comment on', 'satori' ).' &ldquo;'.get_the_title().'&rdquo;';
					}
				elseif ( $numcom > 1 ) {
					echo $numcom . ' ' . __( 'comments on', 'satori' ).' &ldquo;'.get_the_title().'&rdquo;';
					} 
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation' , 'satori' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( '&larr; '.__( 'Older Comments' , 'satori' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments' , 'satori' ).' &rarr;' ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use twentyeleven_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define twentyeleven_comment() and that will be used instead.
				 * See twentyeleven_comment() in twentyeleven/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'twentyeleven_comment' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'satori' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( '&larr; '.__( 'Older Comments'  , 'satori' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments' , 'satori'  ).' &rarr;' ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		 
		elseif ( ! comments_open() && ! is_page() && get_post_type() == 'post' && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'satori' ); ?> </p>
	<?php endif; ?>
   
	<?php $submitcomment=__('Submit comment' , 'satori' ); comment_form(array('title_reply'=>__('Add a Comment' , 'satori' ) , 'comment_notes_after'=>'', 'label_submit'=>$submitcomment) ); ?>

</div><!-- #comments -->