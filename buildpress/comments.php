<?php
/**
 * The template for displaying Comments.
 */
?>
<div id="comments" class="comments-post-<?php the_ID(); ?>">
	<?php if ( have_comments() || comments_open() || pings_open() ) : ?>

		<?php if ( get_comments_number() > 0 ) : ?>
			<h2 class="alternative-heading"><?php echo buildpress_pretty_comments_number(); ?></h2>
		<?php endif; ?>

		<?php if ( have_comments() ) : ?>

			<div class="comments-container">
				<?php wp_list_comments( array( 'callback' => 'buildpress_comment', 'avatar_size' => '150' ) ); ?>
			</div>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? ?>
				<nav id="comment-nav-below" class="text-center  text-uppercase" role="navigation">
					<h3 class="assistive-text"><?php echo __( 'Comment Navigation', 'buildpress_wp'); ?></h3>
					<div class="nav-previous  pull-left"><?php previous_comments_link( __( '&larr; Older Comments', 'buildpress_wp') ); ?></div>
					<div class="nav-next  pull-right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'buildpress_wp') ); ?></div>
				</nav>
			<?php endif; ?>

			<?php
				// If there are no comments and comments are closed, let's leave a note.
				// But we only want the note on posts and pages that had comments in the first place.
				if ( ! comments_open() && get_comments_number() ) :
			?>
				<p class="nocomments"><?php _e( 'Comments for this post are closed.'  , 'buildpress_wp'); ?></p>
			<?php
				endif;
			?>

		<?php endif; // have_comments() ?>

		<?php
			//display the title only if the comments are opened
			if ( comments_open() ) :
		?>
			<h2 class="alternative-heading"><?php _e( 'Write a Comment', 'buildpress_wp' ); ?></h2>
		<?php endif; ?>

		<?php
			$commenter = wp_get_current_commenter();
			$req       = get_option( 'require_name_email' );
			$req_html  = $req ? '<span class="required theme-clr">*</span>' : '';
			$req_aria  = $req ? 'aria-required="true" required' : '';

			$fields    = array(
				'author' => sprintf( '<div class="row"><div class="col-xs-12  col-sm-6  form-group"><label for="author">%1$s%2$s</label><input id="author" name="author" type="text" value="%3$s" class="form-control" %4$s /></div></div>',
					__( 'First and Last name', 'buildpress_wp'),
					$req_html,
					esc_attr( $commenter['comment_author'] ),
					$req_aria
				),
				'email'  => sprintf( '<div class="row"><div class="col-xs-12  col-sm-6  form-group"><label for="email">%1$s%2$s</label><input id="email" name="email" type="email" value="%3$s" class="form-control" %4$s /></div></div>',
					__( 'E-mail Address', 'buildpress_wp'),
					$req_html,
					esc_attr( $commenter['comment_author_email'] ),
					$req_aria
				),
				'url'    => sprintf( '<div class="row"><div class="col-xs-12  col-sm-6  form-group"><label for="url">%1$s</label><input id="url" name="url" type="url" value="%2$s" class="form-control" /></div></div>',
					__( 'Website', 'buildpress_wp'),
					esc_attr( $commenter['comment_author_url'] )
				)
			);

			$comments_args = array(
				'fields'        => $fields,
				'id_submit'     => 'comments-submit-button',
				'comment_field' => sprintf( '<div class="row"><div class="col-xs-12  form-group"><label for="comment">%1$s%2$s</label><textarea id="comment" name="comment" class="form-control" rows="8" aria-required="true"></textarea></div></div>',
					_x( 'Your comment', 'noun', 'buildpress_wp'),
					$req_html
				),
				'title_reply'   => '',
			);

			// https://developer.wordpress.org/reference/functions/comment_form/
			comment_form( $comments_args );

	else :
		_e( 'Comments for this post are closed.', 'buildpress_wp');
	endif;
?>
</div>