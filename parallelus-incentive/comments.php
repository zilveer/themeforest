<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() )
	return;


if ( have_comments() || comments_open($post->ID) ) : ?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'framework' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'theme_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php 
		// Show coments
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through 
			?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'framework' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'framework' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'framework' ) ); ?></div>
			</nav>
			<?php 
		endif; // check for comment navigation 
		// Comments closed
		if ( ! comments_open($post->ID) && get_comments_number() ) :
			 ?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'framework' ); ?></p>
			<?php 
		endif; 

	endif; // have_comments()

	comment_form(); ?>

</div><!-- #comments .comments-area -->

<?php endif; ?>