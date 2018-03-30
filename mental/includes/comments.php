<?php
/**
 * Mental Comments templates
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Custom Comments Callback
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function mental_comments( $comment, $args, $depth )
{
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	?>


	<li id="comment-<?php comment_ID() ?>">
		<div class="cm-item">
			<figure>
				<?php if ( $args['avatar_size'] != 0 ) { echo get_avatar( $comment, 70 ); } ?>
			</figure>
			<div class="cm-body">
				<div class="cm-title-line">
					<span class="cm-title"><?php echo get_comment_author_link() ?></span>
					<time
						datetime="<?php echo date( 'Y-m-d', strtotime( get_comment_date() . ' ' . get_comment_time() ) ) ?>">
						<?php printf( __( '%1$s at %2$s', 'mental' ), get_comment_date(), get_comment_time() ) ?>
					</time>
					<?php comment_reply_link( array_merge( $args, array(
								'add_below' => 'comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ) ?>
					<?php edit_comment_link( __( '(Edit)', 'mental' ), '  ', '' ) ?>
				</div>
				<div class="cm-content">
					<p><?php comment_text() ?></p>
				</div>
			</div>
		</div>
	</li>

<?php
}


/**
 * Mental Comment Form function
 *
 * @param array $args
 * @param null $post_id
 */
function mental_comment_form( $args = array(), $post_id = null )
{
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	} else {
		$id = $post_id;
	}

	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req = get_option( 'require_name_email' );
	//   $aria_req = ( $req ? " aria-required='true'" : '' );
	$html5         = 'html5' === $args['format'];
	$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'mental' ), '<span class="required">*</span>' );

	$defaults = array(
		'fields'               => '',
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'mental' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'mental' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mental' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'mental' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>', 'mental' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Comment', 'mental' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'mental' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'mental' ),
		'label_submit'         => __( 'Post Comment', 'mental' ),
		'format'               => 'xhtml',
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
	<?php if ( comments_open( $post_id ) ) : ?>
	<?php do_action( 'comment_form_before' ); ?>
	<div id="respond" class="comment-respond comment-form">
		<h4 class="margin-btm-md"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?>
			<small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
		</h4>

		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
			<?php echo wp_kses($args['must_log_in'], mental_allowed_tags()); ?>
			<?php do_action( 'comment_form_must_log_in_after' ); ?>
		<?php else : ?>
			<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post"
			      id="<?php echo esc_attr( $args['id_form'] ); ?>" class=""<?php echo ( $html5 ) ? ' novalidate' : ''; ?>>
				<?php do_action( 'comment_form_top' ); ?>
				<?php if ( is_user_logged_in() ) : ?>
					<?php
					echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
					?>
					<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
				<?php else : ?>
					<?php echo wp_kses($args['comment_notes_before'], mental_allowed_tags()); ?>
					<?php do_action( 'comment_form_before_fields' ); ?>
					<div class="row">
						<div class="col-sm-4 form-group">
							<label class="sr-only" for="input_name"><?php _e( 'Name *', 'mental' ) ?></label>
							<input name="author" type="text" class="form-control" id="input_name"
							       placeholder="<?php _e( 'Name *', 'mental' ) ?>">
						</div>
						<div class="col-sm-4 form-group">
							<label class="sr-only" for="input_email"><?php _e( 'Email *', 'mental' ) ?></label>
							<input name="email" type="email" class="form-control" id="input_email"
							       placeholder="<?php _e( 'Email *', 'mental' ) ?>">
						</div>
						<div class="col-sm-4 form-group">
							<label class="sr-only" for="input_url"><?php _e( 'Website', 'mental' ) ?></label>
							<input name="url" type="text" class="form-control" id="input_url"
							       placeholder="<?php _e( 'Website', 'mental' ) ?>">
						</div>
					</div>
					<?php do_action( 'comment_form_after_fields' ); ?>
				<?php endif; ?>
				<div class="form-group">
					<label class="sr-only" for="input_message"><?php _e( 'Comment', 'mental' ) ?></label>
					<textarea name="comment" class="form-control" rows="7" id="input_message"
					          placeholder="<?php _e( 'Comment', 'mental' ) ?>"></textarea>
					<?php echo wp_kses($args['comment_notes_after'], mental_allowed_tags()); ?>
				</div>
				<button type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"
				        value="<?php echo esc_attr( $args['label_submit'] ); ?>"
				        class="btn btn-default btn-wide"><?php _e( 'Submit', 'mental' ) ?></button>
				<?php comment_id_fields( $post_id ); ?>
				<?php do_action( 'comment_form', $post_id ); ?>
			</form>
		<?php endif; ?>
	</div><!-- #respond -->
	<?php
	do_action( 'comment_form_after' );
else :
	do_action( 'comment_form_comments_closed' );
endif;
}