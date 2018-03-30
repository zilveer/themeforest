<?php /* The template for displaying Comments */

if ( post_password_required() ) {
	return;
} ?>

<aside id="comments" class="comments-area<?php if (handy_get_option('lazyload_on_post')=='on') { echo ' lazyload" data-expand="-100">'; } else { echo '">'; } ?>

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title" itemprop="interactionCount">
			<?php
				printf( _n( 'There Is %1$s Comment', 'There Are %1$s Comments', get_comments_number(), 'plumtree' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<div class="comments-list">
			<?php wp_list_comments( array('walker' => new pt_comments_walker() ) ); ?>
		</div>

		<?php /* Comments pagination */
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

			$comment_navi_type = (handy_get_option('comments_pagination')) ? handy_get_option('comments_pagination') : 'numeric'; 
			if ($comment_navi_type == 'numeric') { ?>
		        <nav class="navigation comment-numeric-navigation"><!-- Comments Nav -->
		            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'plumtree' ); ?></h1>
		            <span class="page-links-title"><?php _e('Comments Navigation:', 'plumtree'); ?></span>
		            <?php paginate_comments_links( array(
						'prev_text' => '<i class="fa fa-chevron-left"></i>',
						'next_text' => '<i class="fa fa-chevron-right"></i>',
		              	'type'      => 'plain',
		              )); ?>
		       	</nav><!-- end of Comments Nav -->
			<?php } elseif ($comment_navi_type == 'newold') { ?>
		        <nav class="navigation comment-navigation"><!-- Comments Nav -->
		            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'plumtree' ); ?></h1>
		            <div class="prev"><?php previous_comments_link( __( '<i class="fa fa-angle-left"></i>Older Comments', 'plumtree' ) ); ?></div>
		            <div class="next"><?php next_comments_link( __( 'Newer Comments<i class="fa fa-angle-right"></i>', 'plumtree' ) ); ?></div>
		        </nav><!-- end of Comments Nav -->
			<?php }
		endif; ?>

		<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'plumtree' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php if (function_exists('pt_comment_form')) { pt_comment_form(); }
		  else { comment_form(); } ?>

</aside><!-- #comments -->
