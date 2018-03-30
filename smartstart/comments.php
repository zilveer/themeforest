<section id="comments">

	<?php if ( post_password_required() ): ?>

		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ss_framework' ); ?></p>

</section><!-- #comments -->

	<?php return; endif; ?>

	<?php if ( have_comments() ): ?>

		<h2 id="comments-title">
			<?php printf( _n( 'Comments (%1$s)', 'Comments (%1$s)', get_comments_number(), 'ss_framework'), number_format_i18n( get_comments_number() ), '' . get_the_title() . '' ); ?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'ss_framework_comments' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
		
			<nav class="pagination comments-pagination">
				<?php paginate_comments_links(); ?>
			</nav>
			
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
	
		<p class="nocomments"><?php _e( 'Comments are closed.', 'ss_framework' ); ?></p>
		
	<?php endif; ?>

	<?php comment_form(); ?>

</section><!-- #comments -->