<?php
/**
 * Renders a single comments; Called for each comment
 */
function crb_render_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar($comment, 48); ?>
				<?php comment_author_link() ?>
				<span class="says">says:</span>
			</div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em class="moderation-notice"><?php _e('Your comment is awaiting moderation.','eden') ?></em><br />
			<?php endif; ?>
		
			<div class="comment-meta">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
					<?php comment_date() ?> at <?php comment_time() ?>
				</a>
				<?php edit_comment_link(__('(Edit)','eden'),'  ','') ?>
			</div>
			
			<div class="comment-text">
				<?php comment_text() ?>
			</div>
	
			<div class="comment-reply">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	<?php
}

/**
 * Restricts direct access to the comments.php and checks whether the comments are password protected.
 * @return boolean
 */
function crb_comments_restrict_access() {
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) {
		echo '<p class="nocomments">'.__('This post is password protected. Enter the password to view comments.','eden').'</p>';
		return false;
	}

	return true;
}

/**
 * Renders all current comments
 * @param  callable $callback
 */
function crb_comments_render_list($callback) {
	?>
	<?php if ( have_comments() ) : ?>
		<h3 class="response-title"><?php comments_number(__('No comments','eden'),__('1 comment','eden'),'% '.__('comments','eden')); ?></h3>
		<ol class="commentlist">
			<?php wp_list_comments('callback=' . $callback); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->
		<?php else : // comments are closed ?>
			<p class="nocomments"><?php _e('Comments are closed.','eden'); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php
}

/** COMMENTS WALKER */
class eden_walker_comment extends Walker_Comment {

	protected function comment( $comment, $depth, $args ) {
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		} ?>

		<<?php echo esc_attr($tag); ?> <?php comment_class( $this->has_children ? 'parent' : '' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-author vcard">
			<?php
				if (function_exists('booked_avatar')):
					echo '<span class="avatar">'.booked_avatar( $comment->user_id, 88 ).'</span>';
				else :
					if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment->user_id, 88 );
				endif;
			?>
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
		</div>
		<?php if ( '0' == $comment->comment_approved ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','eden' ) ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s','eden' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)','eden' ), '&nbsp;&nbsp;', '' );
			?>
		</div>

		<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
	}

	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
		<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
							if (function_exists('booked_avatar')):
								echo '<span class="avatar">'.booked_avatar( $comment->user_id, 88 ).'</span>';
							else :
								if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment->user_id, 88 );
							endif;
						?>
						<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'eden' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit','eden' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','eden' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- .comment-body -->
	<?php
	}
}

function crb_comments_render_form($arguments) {
	comment_form($arguments);
	return false;
}
