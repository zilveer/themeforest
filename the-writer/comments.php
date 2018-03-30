<div id="comments" class="comments-area">

		<?php if ( have_comments() ) { ?>

			<h2 class="comments-title">
				<?php
					printf( _n( 'One Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'ocmx' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</h2>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'obox_comment', 'style' => 'ol' ) ); ?>
			</ol><!-- .commentlist -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ocmx' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ocmx' ) ); ?></div>
			</nav>
			<?php endif; // check for comment navigation ?>

			<?php }
			/* If there are no comments and comments are closed, let's leave a note.
			 * But we only want the note on posts and pages that had comments in the first place.
			 */
			if ( !is_page() && ! comments_open() && get_comments_number() ) : ?>
				<p class="nocomments"><?php _e( 'Comments are closed.' , 'ocmx' ); ?></p>
			<?php endif; ?>

		<?php comment_form();  ?>

	</div><!-- #comments .comments-area -->