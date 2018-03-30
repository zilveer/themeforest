<?php
/*
 * The template for displaying comments part
*/
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">
	
		<?php if ( have_comments() ) : ?>
			<div class="post-bottom-element">
				<div class="comments-list-area">
					<div class="comment-reply-title"><h2><?php
							printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'eventstation' ),
							number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
						?></h2>
					</div>
					<ol class="comment-list">
						<?php
							wp_list_comments( array(
								'style'       => 'ol',
								'short_ping'  => true,
								'avatar_size' => 77,
								'callback' => 'eventstation_comment',
							) );
						?>
						<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
						
							<nav class="navigation comment-navigation" role="navigation">
								<h1 class="screen-reader-text section-heading"><?php echo esc_html__( 'Comment Navigation', 'eventstation' ); ?></h1>
								<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'eventstation' ) ); ?></div>
								<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'eventstation' ) ); ?></div>
							</nav>
							
						<?php endif; ?>

						<?php if ( ! comments_open() && get_comments_number() ) : ?>
						
							<p class="no-comments"><?php echo esc_html__( 'Comments are closed.' , 'eventstation' ); ?></p>
						
						<?php endif; ?>
						
					</ol>
				</div>
			</div>
		<?php endif; ?>

		<div class="post-bottom-element">
		<?php
			$comments_args = array(
				'id_form'           => 'commentform',
				'id_submit'         => 'submit',
				'class_submit'		=> 'btn btn-danger',
				'title_reply_before'    => '<div class="comment-reply-title"><h2>',
				'title_reply_after'    => '</div></h2>',
				'title_reply_to'    => '<div class="comment-title">' . esc_html__('Leave a Reply to', 'eventstation') . ' %s' . '</div>',
				'cancel_reply_link' => esc_html__( 'Cancel Reply', 'eventstation'),
				'label_submit'      => esc_html__( 'Send Message', 'eventstation'),
				'comment_field' =>  '<div class="form-group col-sm-8 col-xs-12  comments-area-textarea comments-area-col-left"><textarea class="form-control" placeholder="' . esc_html__('Your Message', 'eventstation') . '' . esc_html__('*', 'eventstation') .  '" name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea></div>',

				'comment_notes_before' => '',

				'fields' => apply_filters( 'comment_form_default_fields', array(
					'author' =>
						'<div class="col-sm-4 col-xs-12 comments-area-col-right"><div class="comments-area-col"><div class="form-group name clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('Name Surname', 'eventstation') . '' . ( $req ?  '' . esc_html__('*', 'eventstation') . '' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div></div>',

					'email' =>
						'<div class="comments-area-col"><div class="form-group email clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('Your E-Mail', 'eventstation') . '' . ( $req ? '' . esc_html__('*', 'eventstation') . '' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1"' . ($req ? "aria-required='true'" : '' ). ' /></div></div>',

					'url' =>
						'<div class="comments-area-col"><div class="form-group website clearfix"><input class="form-control" type="text" placeholder="' . esc_html__('Website URL', 'eventstation') . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" tabindex="1" /></div></div></div>'
					)
				),

			);
			comment_form( $comments_args );
		?>
		</div>
		
	</div>