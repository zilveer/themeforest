<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','toranj'); ?></p>
	<?php
		return;
	}
?>




<div id="post-comments">
	
	<?php if ( have_comments() ) : ?>
		<h2 class="lined">
			<?php 
				printf( _nx( 'One comment', '%1$s comments', get_comments_number(), 'Comment title', 'toranj' ), number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<ul id="comment-list">
			<?php wp_list_comments( array( 'callback' => 'owlab_shape_comment' ) ); ?>
		</ul>

		<?php 
			// If the comments are paginated, display the controls.
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="comment-nav" role="navigation">
			<p class="comment-nav-prev">
				<?php previous_comments_link( __( '&larr; Older Comments', 'toranj' ) ); ?>
			</p>

			<p class="comment-nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'toranj' ) ); ?>
			</p>
		</nav> <!-- end comment-nav -->
		<?php endif; ?>


	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( comments_open() ) : ?>
			
		 <?php else : // comments are closed ?>
			<!-- If comments are closed. -->
			<p class="nocomments"><?php _e('Comments are closed.','toranj'); ?></p>

		<?php endif; ?>
	<?php endif; ?>



	<?php if ( comments_open() ) : ?>
	<div id="comment-form">
		<h2 class="lined"><?php _e('Leave a Comment','toranj') ?></h2>
		<?php 
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$arg = array(
		'title_reply' => '',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'comment_field' => '<div class="row row-inputs">
								<div class="col-md-12">
									<textarea class="form-control" id="comment" name="comment" rows="8" placeholder="Comment" aria-required="true"></textarea>
								</div>
							</div>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
						'author' =>
					      	'<div class="row row-inputs">'.
								'<div class="col-md-4 col-sm-6">'.
									'<label for="author">'. __('Name','toranj'). ' <small>'. ( $req ? __('(required)','toranj') : '') .'</small></label>'.
									'<input class="form-control" type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'" size="22" tabindex="1"'. $aria_req .'/>'.
								'</div>'.
							'',

					    'email' =>

					    	''.
								'<div class="col-md-4 col-sm-6">'.
									'<label for="email">'. __('Email','toranj'). ' <small>'. ( $req ? __('(required)','toranj') : '') .'</small></label>'.
									'<input class="form-control" type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="22" tabindex="1"'. $aria_req .'/>'.
								'</div>'.
							'',

					    'url' =>

					    	''.
								'<div class="col-md-4 col-sm-6">'.
									'<label for="url">'. __('Website','toranj').'</label>'.
									'<input class="form-control" type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_url'] ) .'" size="22" tabindex="1"'. $aria_req .'/>'.
								'</div>'.
							'</div>'
					))
	); ?>
	<?php comment_form($arg); ?>
	</div>
	<?php endif;?>
</div>