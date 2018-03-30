<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php global $post; ?>

<?php if ( get_comments_number() != 0 ) : ?>

	<!-- - - - - - - - - - - - Post Comments - - - - - - - - - - - - - - -->


	<section id="comments" class="respond-comments">

		<?php if ( have_comments() ){ ?>

			<h2 class="comments-title"><?php echo get_comments_number() . " " . __('Comments', 'diplomat'); ?></h2>

			<ol class="comments-list">
				<?php wp_list_comments('avatar_size=70&callback=tmm_comments'); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ): ?>
				<nav class="pagination comments-pagination">
					<?php paginate_comments_links(); ?>
				</nav>
			<?php endif; ?>

        <?php } ?>

		<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ): ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'diplomat' ); ?></p>
		<?php endif; ?>

	</section><!--/ #comments-->

	<!-- - - - - - - - - - - end Post Comments - - - - - - - - - - - - - -->

<?php endif; ?>

<?php if ( comments_open() ) : ?>
	
	<!-- - - - - - - - - - - Comment Form - - - - - - - - - - - - - -->

	<?php comment_form(); ?>
	
	<!-- - - - - - - - - - end Comment Form - - - - - - - - - - - - -->

<?php endif; ?>

 <?php
if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments'))
	wp_enqueue_script('comment-reply');
?>
<input type="hidden" name="current_post_id" value="<?php echo $post->ID ?>" />
<input type="hidden" name="current_post_url" value="<?php echo get_permalink($post->ID) ?>" />
<input type="hidden" name="is_user_logged_in" value="<?php echo (is_user_logged_in() ? 1 : 0) ?>" />
