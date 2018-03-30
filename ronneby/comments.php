<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!function_exists('dfd_comment')) {	
	function dfd_comment($comment, $args, $depth) {
		global $dfd_ronneby;
		$GLOBALS['comment'] = $comment;
		$read_more_style = (isset($dfd_ronneby['style_hover_read_more']) && !empty($dfd_ronneby['style_hover_read_more'])) ? $dfd_ronneby['style_hover_read_more'] : 'chaffle';
		?>

	<li <?php comment_class(); ?>>
		<div class="clearfix">

			<div class="avatar-box">
				<?php echo get_avatar($comment, $size = '80'); ?>
			</div>

			<header class="comment-author vcard">
				<div class="author box-name"><?php echo get_comment_author_link(); ?></div>
				<div class="date subtitle"><?php printf(__('%1$s', 'dfd'), get_comment_date('F d, Y, g:i a')); ?></div>
				<div class="reply">
					<?php if (is_user_logged_in()) : ?>
						<span class="dop-link">
							<?php edit_comment_link('<span class="'.esc_attr($read_more_style).'" data-lang="en">'.__('Edit', 'dfd').'</span>', '', ''); ?>
						</span>
					<?php endif; ?>
					<?php echo comment_reply_link(array(
						'depth' => $depth,
						'max_depth' => $args['max_depth'], 
						'reply_text'=>'<span class="'.esc_attr($read_more_style).'" data-lang="en">'.__('Leave reply','dfd').'</span>'
					)); ?>
				</div>
			</header>

			<div class="ovh">

				<section class="comment-content">

					<?php if ($comment->comment_approved == '0') : ?>
						<div class="alert-box">
							<?php _e('Your comment is awaiting moderation.', 'dfd'); ?>
						</div>
					<?php endif; ?>

					<?php comment_text(); ?>

				</section>

			</div>
			<div class="clear"></div>
			<footer></footer>
		</div>

	<?php }
}
 ?>
<?php if (post_password_required()) : ?>
    <section id="comments">
        <div class="alert-box alert">
            <?php _e('This post is password protected. Enter the password to view comments.', 'dfd'); ?>
        </div>
    </section><!-- /#comments -->
<?php else : ?>


	<?php if (have_comments()) : ?>
		<section id="comments">
			<div class="block-title">
				<?php printf(_n('There is 1 comment on this post', 'There are %1$s comments on this post', (int) get_comments_number(), 'dfd'), number_format_i18n(get_comments_number())); ?>
			</div>

			<ol class="commentlist">
				<?php wp_list_comments(array('callback' => 'dfd_comment')); ?>
			</ol>

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>

			<nav class="page-nav">
				<span class="older"><?php previous_comments_link(__('Older', 'dfd')); ?></span>
				<span class="newer"><?php next_comments_link(__('Newer', 'dfd')); ?></span>
			</nav>

			<?php endif; // check for comment navigation ?>

			<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
			<?php endif; ?>

		</section><!-- /#comments -->

	<?php endif; ?>

	<?php if (comments_open()) : ?>

		<section id="respond">

			<div class="block-title">
				<?php comment_form_title(__('Leave a reply', 'dfd'), __('Leave a Reply to %s', 'dfd')); ?>
				<?php if (!is_user_logged_in()) : ?>
				<?php endif; ?>
				<?php /*<div class="subtitle"><?php _e('Required fields are marked *', 'dfd'); ?></div>*/ ?>
			</div>

			<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
			<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>

			<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'dfd'), wp_login_url(get_permalink())); ?></p>

			<?php else : ?>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

				<?php if (is_user_logged_in()) { ?>
				<p class="text-left"><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php" class="box-name">%s</a>.', 'dfd'), get_option('siteurl'), $user_identity); ?>
					<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'dfd'); ?>" class="box-name"><?php _e('Log out &raquo;', 'dfd'); ?></a>
				</p>
			<?php } else {?>

					<div class="input-wrap"><label><?php _e('Name', 'dfd'); if ($req) _e('*', 'dfd'); ?></label><input type="text" placeholder="" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>></div><!--

					--><div class="input-wrap"><label><?php _e('Email', 'dfd'); if ($req) _e('*', 'dfd'); ?></label><input type="email" placeholder="" class="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>></div><!--

					--><div class="input-wrap"><label><?php _e('Website', 'dfd'); ?></label><input type="url" placeholder="" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3"></div>

			<?php } ?>
					<div class="clear"></div>
					<div class="textarea-wrap"><label><?php _e('Comment', 'dfd'); ?></label><textarea rows="8" name="comment" id="comment" tabindex="4" placeholder=""></textarea></div>

				<p class="text-left">
					<button name="submit" class="button" tabindex="5">
						<?php _e('Submit Comment', 'dfd'); ?>
					</button>
				</p>

				<?php comment_id_fields(); ?>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
			<?php endif; ?>
		</section>
	<?php endif; ?>
<?php endif;