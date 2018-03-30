<?php
function multipurpose_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<div id="div-comment-<?php comment_ID() ?>">
		<div class="comment-author vcard">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>	
			<cite class="fn"><?php echo get_comment_author_link() ?></cite>
			<p class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date(); esc_attr__('at', 'multipurpose') ?> <?php echo get_comment_time() ?></a><span class="sep">|</span> <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
			
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
			<p class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'multipurpose') ?></p>
		<?php endif; ?>
		<div class="comment-body"><?php comment_text() ?></div>
	</div>
<?php
}

function multipurpose_comment_form_args() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$comment_notes_before = '<p class="comment-notes">' . esc_attr__( 'Your email address will not be published.', 'multipurpose' ) . '</p>';
	$comment_notes_after = '';
	$fields =  array(
	    'author' => '<label for="author">'.esc_attr__( 'Name', 'multipurpose' ).( $req ? ' <span class="required">*</span>' : '' ).'</label><input id="author" name="author"'. $aria_req . ' value="' . esc_attr( $commenter['comment_author'] ) . '"><br>',
	    'email' => '<label for="email">' . esc_attr__( 'Email', 'multipurpose' ) .( $req ? ' <span class="required">*</span>' : '' ). '</label><input id="email" name="email"' . $aria_req . ' value="' . esc_attr(  $commenter['comment_author_email'] ) .'"><br>',
	    'url' => '<label for="url">' . esc_attr__( 'Website', 'multipurpose' ) . '</label><input id="url" name="url"' . $aria_req . ' value="' . esc_attr( $commenter['comment_author_url'] ) .'"><br>'
	);

	$comment_field = '<label for="comment">' . esc_attr__( 'Comment', 'multipurpose' ) . '</label><textarea name="comment" id="comment" rows="8" cols="50"></textarea>';
	return array('fields' => $fields, 'comment_field' => $comment_field, 'comment_notes_before' => $comment_notes_before, 'comment_notes_after' => $comment_notes_after);
}
