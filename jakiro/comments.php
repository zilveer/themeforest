<?php
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<div class="title-sep-wrap commentst-title">
			<h3 class="title-sep-text">
				<?php comments_number(esc_html__('No Comments', 'jakiro'), esc_html__('One Comment', 'jakiro'), '% '.esc_html__('Comments', 'jakiro'));?>
			</h3>
			<span class="title-sep"><span></span></span>
		</div>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'callback'	 => 'dh_list_comments',
				'style'      => 'ol',
				'avatar_size'=> 60,
			) );
			?>
		</ol>
		<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<div class="paginate comment-paginate">
			<div class="paginate_links">
				<?php paginate_comments_links()?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'jakiro' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php dh_comment_form(); ?>
</div>