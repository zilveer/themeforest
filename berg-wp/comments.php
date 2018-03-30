<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package berg-wp
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>
<div class="comments-container" id="comments">
	<?php if (have_comments()) : ?>
	<header class="section-header">	
		<h2 class="comments-title h3">
			<?php 
			echo __('Discussion on', 'BERG');?> <?php echo get_the_title();
			?>
		</h2>
	</header>
	<div class="container">
		<div class="comments">
			<?php 
				$listComments = wp_list_comments(array(
				'walker' => new zipGun_walker_comment,
				'style' => 'div',
				'short_ping' => true,
				'max_depth' => 1,
				'callback' => null,
				'end-callback' => null,
				'type' => 'all',
				'avatar_size' => 100
				));
			?>
			<div class="paginate-comments">
				<?php paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;')); ?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<?php
	if (isset($post->comment_status)) { 
		$commentStatus = $post->comment_status;
		if ($commentStatus == 'open') {
			echo '<header class="section-header"><h2 class="h3">';
			echo __( 'Leave a Reply', 'BERG');
			echo '</h2></header>';
		}
	}
?>
<div class="container">
	<div class="row">
			<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			if (is_user_logged_in()) {
				echo '<div class="col-md-8 col-md-offset-2">';
				echo '<div class="logged_in">';
				$comments_args = array(
					'title_reply' => '',
					'label_submit'=>__('SEND', 'BERG'),
					'comment_notes_before' => '',
					'comment_notes_after' => '',
					'comment_field' => '<div class="col-md-12"><div class="form-group"><textarea id="comment" placeholder="'._x( 'Comment', 'noun' ).'" class="form-control input-row-3" name="comment" aria-required="true"></textarea></div></div>',
				  	'logged_in_as' => '<div class="col-md-12"><p class="logged-in-as">' . sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'BERG'),
						esc_url( admin_url( 'profile.php' ) ),
				      	$user_identity,
				      	esc_url( wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) )
				    ) . '</p></div>',
				);			
				comment_form($comments_args);
				echo '</div>';
			} else {
				echo '<div class="col-md-10 col-md-offset-1">';
				$comments_args = array(
					'title_reply' => '',
					// change the title of send button 
					'label_submit'=>''.__( 'SEND', 'BERG').'',
					// remove "Text or HTML to be displayed after the set of comment fields"
					'comment_notes_before' => '',
					'comment_notes_after' => '',
					// redefine your own textarea (the comment body)
					'comment_field' => '<div class="col-md-6"><div class="form-group"><textarea id="comment" placeholder="'._x( 'Comment', 'noun' ).'" class="form-control input-row-3" name="comment" aria-required="true"></textarea></div></div>',
					'fields' => apply_filters( 'comment_form_default_fields', array(

						'author' =>
						'<div class="col-md-6"><div class="form-group comment-form-author">' .
						'<input id="author" placeholder="'.__( 'Name', 'BERG').'" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' /></div>',

						'email' =>
						'<div class="form-group comment-form-email">' .
						'<input id="email" placeholder="'.__( 'Email', 'BERG').'" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' /></div>',

						'url' =>
						'<div class="form-group comment-form-url">' .
						'<input id="url" placeholder="'.__( 'Website', 'BERG').'" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30" /></div></div>'
						)
					)
				);
				comment_form($comments_args);
				echo '</div>';
			}
			?>
		</div>
	</div>
</div>