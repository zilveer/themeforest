<?php
/**
 * Comments Function
 * @package by Theme Record
 * @auther: MattMao
*/

#
#Theme Comments List
#
if ( !function_exists( 'theme_comments_list' ) )
{
	function theme_comments_list($comment, $args, $depth) 
	{
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<?php _e( 'Pingback:', 'TR' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'TR' ), '<span class="edit-link">', '</span>' ); ?>
	<?php break; default : ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="clearfix comment-wrap">

		<div class="comment-author vcard">
		<?php
			$avatar_size = 38;
			if ( '0' != $comment->comment_parent ) { $avatar_size = 38; }
			echo get_avatar( $comment, $avatar_size );
		?>	
		</div><!-- .comment-author .vcard -->

		<div class="comment-entry">
			<div class="comment-meta meta">
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()); ?>
			<?php printf(__('<span class="time">%1$s at %2$s</span>', 'TR'), get_comment_date(),  get_comment_time()) ?> &middot;
			<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<span class="reply">'.__('Reply', 'TR').'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			<?php edit_comment_link( __('Edit', 'TR'), '&middot; <span class="edit-link">', '</span>' ); ?>
			</div>
			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'TR' ); ?></div>
				<?php endif; ?>
				<div class="comment-text post-format"><?php comment_text(); ?></div>
			</div>
		</div><!-- .comment-entry -->

	</article><!-- #comment-## -->
	<?php break; endswitch; ?>
	<?php
	}
}


#
#Theme Comment Form
#
if ( !function_exists( 'theme_comment_form' ) )
{
	function theme_comment_form() 
	{
		$req = get_option( 'require_name_email' );

		$fields =  array(
			'author' => '<div class="comment-form-file" ><input id="author" name="author" type="text" placeholder="'.__('Name', 'TR').( $req ? ' *' : '' ).'" size="30" /></div>',
			'email'  => '<div class="comment-form-file" ><input id="email" name="email" type="text" placeholder="'.__('Email', 'TR').( $req ? ' *' : '' ).'" size="30" /></div>',
			'url'    => '<div class="comment-form-file" ><input id="url" name="url" type="text" placeholder="'.__('Website', 'TR').'" size="30" /></div>'
		);

		$args = array(
			'title_reply' =>  '<span>' .__('Leave a Reply', 'TR'). '</span>',
			'cancel_reply_link' =>   '<span>' .__('Cancel reply', 'TR'). '</span>',
			'comment_notes_before' => '',
			'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' => '<textarea id="comment" class="comment-form-content" name="comment" rows="5"></textarea>',
			'comment_notes_after' => '',
			'label_submit' => __('Submit Comment', 'TR')
		);

		comment_form($args); 
	}
}
?>