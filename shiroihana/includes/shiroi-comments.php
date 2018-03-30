<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Callback for `wp_list_comments`
============================================================================= */

if( ! function_exists( 'shiroi_comment' ) ):

function shiroi_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'shiroi' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'shiroi' ), '<div class="comment-edit-link">', '</div>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="comment-entry clearfix" itemprop="comment" itemscope itemtype="https://schema.org/UserComments">
			<figure class="comment-avatar">
				<?php echo get_avatar( $comment, 80 ); ?>
			</figure>
			<div class="comment-text">
				<header class="comment-head">
					<h5 class="comment-author-name">
						<span itemprop="creator"><?php comment_author_link(); ?></span>
						<?php if( $comment->user_id === $post->post_author ):
						?> <small><?php _e( '(author)', 'shiroi' ); ?></small>
						<?php endif; ?>
					</h5>
					<time class="comment-time" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>" itemprop="commentTime">
						<?php printf( __( '%1$s at %2$s', 'shiroi' ), get_comment_date(), get_comment_time() ) ?>
					</time>
				</header>
				<div class="comment-body">
					<div class="comment-text" itemprop="commentText">
						<?php comment_text(); ?>
					</div>

					<?php if ( '0' == $comment->comment_approved ): 
					?><div class="alert alert-warning"><?php _e( 'Your comment is awaiting moderation.', 'shiroi' ); ?></div>
					<?php endif; ?>

					<div class="comment-links"><?php
						comment_reply_link( array_merge( $args, array( 'before' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
						edit_comment_link( __( 'Edit', 'shiroi' ) );
					?></div>
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch;
}
endif;

/* ==========================================================================
	Comment Form Defaults
============================================================================= */

if( ! function_exists( 'shiroi_comment_form_defaults' ) ):

function shiroi_comment_form_defaults( $defaults ) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	
	$defaults['fields'] = array(
		'author' => 
			'<div class="form-group comment-form-author">' . 
				'<label class="sr-only" for="author">' . _x( 'Name', 'noun', 'shiroi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .  '" class="form-control" placeholder="' . _x( 'Name', 'noun', 'shiroi' ) . ( $req ? ' *' : '' )  .  '" >' . 
				'</div>' . 
			'</div>', 
		'email' => 
			'<div class="form-group comment-form-email">' . 
				'<label class="sr-only" for="email">' . _x( 'Email', 'noun', 'shiroi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .  '" class="form-control" placeholder="' . _x( 'Email', 'noun', 'shiroi' ) . ( $req ? ' *' : '' )  .  '" >' . 
				'</div>' . 
			'</div>', 
		'url' => 
			'<div class="form-group comment-form-url">' . 
				'<label class="sr-only" for="url">' . _x( 'URL', 'noun', 'shiroi' ) . '</label>' . 
				'<div class="col-md-8">' . 
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .  '" class="form-control" placeholder="' . _x( 'URL', 'noun', 'shiroi' ) . '" >' . 
				'</div>' . 
			'</div>'
	);

	$defaults['comment_field'] =  
		'<div class="form-group comment-form-comment">' . 
			'<label class="sr-only" for="comment">' . _x( 'Comment', 'noun', 'shiroi' ) . '</label>' . 
			'<div class="col-md-12">' . 
				'<textarea id="comment" name="comment" rows="7" class="form-control" placeholder="' . _x( 'Comment', 'noun', 'shiroi' ) . '"></textarea>' . 
			'</div>' . 
		'</div>';

	return $defaults;
}
endif;
add_filter( 'comment_form_defaults', 'shiroi_comment_form_defaults' );
