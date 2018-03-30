<?php
/**
 * Comments template
 */
?>

<?php if ( post_password_required() ) : ?>
	<p class="post-excerpt"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'krown' ); ?></p>
<?php
		return;
	endif;
?>

	<aside id="comments">

	<?php if ( ! comments_open() ) : ?>

		<p class="post-excerpt"><?php _e( 'Comments are closed.', 'krown' ); ?></p>

	<?php else : ?>

		<h3 id="comments-title"><?php _e( 'Comments', 'krown'); ?> (<?php comments_number( '0', '1', '%' ); ?>)</h3>

	<?php endif; ?>

	<?php if ( ! have_comments() ) : ?>

		<p class="post-excerpt"><?php _e( 'There are not comments on this post yet. Be the first one!', 'krown' ); ?></p>

	<?php endif; ?>

		<ol id="comments-list"><?php wp_list_comments( array( 'callback' => 'krown_comment' ) ); ?></ol>

		<?php paginate_comments_links(); ?>

		<?php 
			
			$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="krown-column-container span4" style="margin-left:0"><label for="autor">' . __('Name *', 'krown') . '</label><input id="author" name="author" type="text" value=""/></div>',
				'email'  => '<div class="krown-column-container span4"><label for="email">' . __('Email *', 'krown') . '</label><input id="email" name="email" type="text" value="" /></div>',
				'url'    => '<div class="krown-column-container span4 last"><label for="url">' . __('Website', 'krown') . '</label><input id="url" name="url" type="text" value="" /></div>' ) ),
				'comment_field' => '<div class="krown-column-container span12 last" style="margin-left:0"><label for="comment">' . __('Comment *', 'krown') . '</label><textarea id="comment" name="comment" rows="8"></textarea></div>',
				'must_log_in' => '<p style="margin-bottom:25px" class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'krown' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'logged_in_as' => '<p style="margin-bottom:25px" class="logged-in-as">' . sprintf( __( 'You are logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) , 'krown') . '</p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'id_form' => 'comment-form',
				'id_submit' => 'submit',
				'title_reply' => __( 'Post a comment', 'krown' ),
				'title_reply_to' => __( 'Leave a reply to %s', 'krown' ),
				'cancel_reply_link' => __( 'Cancel reply', 'krown' ),
				'label_submit' => __( 'Post comment', 'krown' ),
			); 
			
			echo '<div class="krown-form">';

			comment_form( $defaults ); 

			echo '</div>';
			
		?>
		
	</aside>

	
<?php

	/* This is the function which filters the comments */

	function krown_comment( $comment, $args, $depth ) {

		$retina = krown_retina();
		
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment clearfix">
			
			<div class="comment-avatar"><?php echo get_avatar( $comment, ( $retina === 'true' ? 130 : 65 ), $default='' ); ?></div>

			<div class="comment-content">

				<div class="comment-meta clearfix">

					<h6 class="comment-title"><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?></h6>
					<span class="comment-date"><?php echo comment_date( __( 'F j, Y', 'krown' ) ); ?></span>
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3, 'reply_text' =>  '<i class="krown-icon-cw"></i>' . __( 'Reply', 'krown') ) ) ); ?>

				</div>

				<div class="comment-text">

					<?php comment_text(); ?>
					
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'krown' ); ?></em>
					<?php endif; ?>

				</div>

			</div>

		</li>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'krown' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'krown'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
	}

?>