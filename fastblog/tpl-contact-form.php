<?php
/**
 * @template name: Contact form
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content" class="<?php echo fastblog_get_option('sidebar') == 'right' ? 'left' : 'right'; ?>">

	<?php if (have_posts()): the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<div class="corner left top"></div>
			<div class="corner left bottom"></div>
			<div class="corner right top"></div>
			<div class="corner right bottom"></div>
			<h2 class="title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<div class="content">
				<?php the_content(''); ?>
				<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" class="contact-form">
					<p class="input"><input type="text" name="author" /><?php _e('Name', 'fastblog'); ?>*</p>
					<p class="input"><input type="text" name="email" /><?php _e('Email', 'fastblog'); ?>*</p>
					<p class="input"><input type="text" name="subject" /><?php _e('Subject', 'fastblog'); ?></p>
					<p class="textarea"><textarea name="message" rows="5" cols="15"></textarea></p>
					<p class="submit"><a title="<?php _e('Send', 'fastblog'); ?>"><?php _e('Send', 'fastblog'); ?></a></p>
					<div class="status"></div>
					<div class="loader"></div>
					<input type="hidden" name="action" value="fastblog_contact_form" />
					<div class="clear"></div>
				</form>
			</div>
		</div>

	<?php endif; ?>

</div>

<?php get_footer(); ?>