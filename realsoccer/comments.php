<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() )
	return;
?>

<div id="comments" class="gdlr-comments-area">
<?php if(have_comments()){ ?>
	<h3 class="comments-title">
		<?php 
			if( get_comments_number() <= 1 ){
				echo get_comments_number() . ' ' . __('Response', 'gdlr_translate'); 
			}else{
				echo get_comments_number() . ' ' . __('Responses', 'gdlr_translate'); 
			}
		?>
	</h3>

	<ol class="commentlist">
		<?php wp_list_comments(array('callback' => 'gdlr_comment_list', 'style' => 'ol')); ?>
	</ol><!-- .commentlist -->

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')){ ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php echo __( 'Comment navigation', 'gdlr_translate' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'gdlr_translate' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'gdlr_translate' ) ); ?></div>
		</nav>
	<?php } ?>

<?php } ?>

<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ($req ? " aria-required='true'" : '');
	
	$args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => __('Leave a Reply', 'gdlr_translate'),
		'title_reply_to'    => __('Leave a Reply to %s', 'gdlr_translate'),
		'cancel_reply_link' => __('Cancel Reply', 'gdlr_translate'),
		'label_submit'      => __('Post Comment', 'gdlr_translate'),
		'comment_notes_before' => '',
		'comment_notes_after' => '',

		'must_log_in' => '<p class="must-log-in">' .
			sprintf( __('You must be <a href="%s">logged in</a> to post a comment.', 'gdlr_translate'),
			wp_login_url(apply_filters( 'the_permalink', get_permalink())) ) . '</p>',
		'logged_in_as' => '<p class="logged-in-as">' .
			sprintf( __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'gdlr_translate'),
			admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink( ))) ) . '</p>',

		'fields' => apply_filters('comment_form_default_fields', array(
			'author' =>
				'<div class="comment-form-head">' .
				'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" data-default="' . esc_attr(__('Name*', 'gdlr_translate')) . '" size="30"' . $aria_req . ' />',
			'email' => 
				'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" data-default="' . esc_attr(__('Email*', 'gdlr_translate')) . '" size="30"' . $aria_req . ' />',
			'url' =>
				'<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
				'" data-default="' . esc_attr(__('Website', 'gdlr_translate')) . '" size="30" /><div class="clear"></div></div>'
		)),
		'comment_field' =>  '<div class="comment-form-comment">' .
			'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			'</textarea></div>'
		
	);
	comment_form($args); 

?>
</div><!-- gdlr-comment-area -->