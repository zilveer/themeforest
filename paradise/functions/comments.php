<?php
if ( ! function_exists( 'custom_theme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own custom_theme_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function custom_theme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?>>
		<div class="comment">
			<div class="vcard">
				<?php echo get_avatar($comment, 80); ?>
				<span class="comment_author"><?php echo get_comment_author_link(); ?></span>
				<span class="when_posted"><?php echo get_comment_date('M d, Y'); ?>&nbsp;<?php edit_comment_link(__('(Edit)', TEMPLATENAME)); ?></span>
			</div>
			<div class="posted_content"><div class="pointer_pc"></div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
					<br />
				<?php endif; ?>
				<div class="comment-body"><?php comment_text(); ?></div>
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', TEMPLATENAME ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', TEMPLATENAME), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

function comment_form_custom_fields($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$fields['author'] = '<p><label for="name">' . __( 'Your Name', TEMPLATENAME ) . ': ' . ( $req ? '<small>(' . __('required', TEMPLATENAME) . ')</small>' : '' ) . '</label>' . '<input id="name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['email']  = '<p><label for="email">' . __( 'E-mail', TEMPLATENAME ) . ': ' . ( $req ? '<small>(' . __('will not be published', TEMPLATENAME) . ') (' . __('required', TEMPLATENAME) . ')</small>' : '' ) . '</label>' .	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['url'] = '<p><label for="website">' . __( 'Website', TEMPLATENAME ) . ': </label>' . '<input id="website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
	return $fields;
}
add_filter('comment_form_default_fields', 'comment_form_custom_fields');

?>
