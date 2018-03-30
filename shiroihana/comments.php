<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if( post_password_required() ):
	return;
endif; ?>

<section id="comments" class="entry-comments-wrap">

	<?php if( have_comments() ):

	?><div class="comment-entries">

		<h3 class="entry-comments-title">
			<?php if( get_comments_number() > 0 ):
				printf( _n( '<span>One comment on</span> %2$s', '<span>%1$s comments on</span> %2$s', get_comments_number(), 'shiroi' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			else:
				printf( __( '<span>No comment on</span> %1$s', 'shiroi' ), get_the_title() );
			endif;
			?>
		</h3>

		<div class="entry-comments-list">
			<ul><?php wp_list_comments( array( 'callback' => 'shiroi_comment' )); ?></ul>
		</div>

		<?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : 
		?><nav class="entry-comments-nav clearfix">
			<div class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'shiroi' ) ); ?></div>
			<div class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'shiroi' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php if( ! comments_open() ):
		?><div class="alert alert-warning">
			<?php _e( 'Comments are closed for this entry.', 'shiroi' ); ?>
		</div>
		<?php endif; ?>

	</div>
	<?php endif;

	comment_form( array(
		'class_form' => 'comment-form form-horizontal', 
		'class_submit' => 'submit btn btn-primary'
	) ); ?>

</section>