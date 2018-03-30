<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if( ! (have_comments() || comments_open()))
	return;

$list_comments_args = array(
	'style' => 'div',
	'callback' => 'laborator_list_comments_open',
	'end-callback' => 'laborator_list_comments_close'
);


$rules_of_commenting = __('Please do not use offensive vocabulary.', 'aurum');

$form_args = array(
	'title_reply' 			=> '<h3 class="title">' . (have_comments() ? __('Reply to Article', 'aurum') : __('Share your thoughts', 'aurum')) . ($rules_of_commenting ? "<small>{$rules_of_commenting}</small>" : '') . '</h3>',
	'title_reply_to' 		=> '<h3 class="title">' . __('Leave a Reply to %s', 'aurum') . '</h3>',

	'comment_notes_before' 	=> '',
	'comment_notes_after' 	=> '',

	'label_submit'			=> __('Comment', 'aurum'),

	'comment_field'			=> '<textarea id="comment" name="comment" class="form-control autogrow" placeholder="' . __('Message:', 'aurum') . '" rows="3" aria-required="true"></textarea>'
);

add_filter('comment_form_default_fields', 'laborator_comment_fields');

add_action('comment_form_before_fields', 'laborator_comment_before_fields');
add_action('comment_form_after_fields', 'laborator_comment_after_fields');
/*

add_action('comment_form', 'laborator_commenting_rules');
*/

?>
<div class="comments">
	<?php if ( have_comments() ) : ?>
	<h3 class="title">
		<?php
			printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'aurum' ), number_format_i18n( get_comments_number() ), get_the_title() );
		?>
	</h3>

	<?php
		wp_list_comments($list_comments_args);

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo str_replace("<ul class='page-numbers'>", "<ul class='pagination pagination-center'>", paginate_comments_links( array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
					'type'      => 'list',
					'echo'		=> false
				) ) );
		endif;
	?>

	<?php endif; ?>


	<?php if(comments_open()): ?>
	<!-- / reply form-->
	<div class="reply-form<?php echo is_user_logged_in() ? ' user-logged-in' : ''; ?>">

		<?php echo comment_form($form_args); ?>

	</div>
	<!-- / reply form end-->
	<?php endif; ?>
</div>