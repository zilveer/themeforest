<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

if (!have_comments() && !comments_open()) {
	return;
}

?>

<section id="comments" class="comments">

	<?php if (post_password_required()): ?>

		<h1><?php _e('This post is password protected. Enter the password to view comments.', 'website'); ?></h1>

	<?php else: ?>

		<?php if (have_comments()): ?>
			<h1><?php _e('Comments', 'website'); ?></h1>
			<?php wp_list_comments(array('style' => 'div', 'callback' => 'Website::comment', 'end-callback' => function() {})); ?>
			<?php
				$pagination = paginate_comments_links(array(
					'prev_next' => Website::to(get_post_type().'/comments_pagination') == 'numbers_navigation',
					'prev_text' => __('Previous', 'website'),
					'next_text' => __('Next', 'website'),
					'echo'      => false
				));
				if ($pagination) {
					printf('<div class="pagination">%s</div>', $pagination);
				}
			?>
		<?php endif; ?>

		<?php
			$commenter = wp_get_current_commenter();
			comment_form(array(

				'fields' => array(
					'author' => '<p><input type="text" name="author" placeholder="'.__('name', 'website').'*" value="'.esc_attr($commenter['comment_author']).'" /> <span class="lte-ie9">'.__('name', 'website').'*</span></p>',
					'email'  => '<p><input type="text" name="email" placeholder="'.__('email', 'website').'* ('.__('not published', 'website').')" value="'.esc_attr($commenter['comment_author_email']).'" /> <span class="lte-ie9">'.__('email', 'website').'* ('.__('not&nbsp;published', 'website').')</span></p>',
					'url'    => '<p><input type="text" name="url" placeholder="'.__('website', 'website').'" value="'.esc_attr($commenter['comment_author_url']).'" /> <span class="lte-ie9">'.__('website', 'website').'</span></p>'
				),
				'comment_field' => '<p><textarea name="comment"></textarea></p>',

				'logged_in_as'         => '',
				'comment_notes_before' => '',
				'comment_notes_after'  => '',

				'title_reply'    => __('Leave a comment', 'website'),
				'title_reply_to' => __('Leave a Reply to %s &bull; ', 'website'),
				'label_submit'   => __('Send &raquo;', 'website')

			));
		?>

	<?php endif; ?>

</section>