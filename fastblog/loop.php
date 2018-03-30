<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

<?php while (have_posts()): the_post(); // todo: dodac komentarze, zrobic porzadek ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		<div class="corner left top"></div>
		<div class="corner left bottom"></div>
		<div class="corner right top"></div>
		<div class="corner right bottom"></div>
		<?php
			$hide_title = (is_single() && fastblog_get_option('post/hide_title')) || (is_page() && fastblog_get_option('page/hide_title'));
			if (FASTBLOG_TUMBLOG):
				$title = woo_tumblog_the_title('title', true, '', '', true, 'h2');
				if (!(is_page() || is_attachment() || preg_match('/<span class="post-icon [a-z]+">/i', $title))):
					$custom_post = true;
		?>
			<span class="post-icon <?php echo is_attachment() ? 'attachment' : 'custom'; ?>">
				<?php if (is_attachment()): ?>
					<span><?php _e('Post', 'fastblog') ?></span>
				<?php
					else:
					$categories = get_the_category();
					$category   = array_shift($categories);
				?>
					<a href="<?php echo get_category_link($category->term_id); ?>" rel="category" title="<?php echo esc_attr(sprintf(__('View all posts in %s', 'fastblog'), $category->name)); ?>"><?php _e('Post', 'fastblog'); ?></a>
				<?php endif; ?>
			</span>
		<?php
				else:
					$custom_post = false;
				endif;
				echo $hide_title ? preg_replace('|<h2.*>.*</h2>|iU', '', $title) : $title;
			elseif (!$hide_title):
		?>
			<h2 class="title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php endif; ?>
		<div class="content">
			<?php
				if (FASTBLOG_TUMBLOG) {
					if ($custom_post) {
						fastblog_post_thumbnail();
					} else {
						echo fastblog_prepare_tumblog_content(woo_tumblog_content(true), FASTBLOG_THUMB_TUMBLOG_WIDTH);
					}
				} else {
					fastblog_post_thumbnail();
				}
				if (is_attachment() && (strpos(get_post_mime_type(get_the_ID()), 'image') === 0)) {
					echo '<p>'.wp_get_attachment_image(get_the_ID(), 'post-thumbnail').'</p>';
				} else if ((has_excerpt() && (!is_singular())) || is_search()) {
					the_excerpt();
				} else {
					the_content(__('More', 'fastblog').'&hellip;');
					if (is_singular()) {
						wp_link_pages();
					}
				}
			?>
			<div class="clear"></div>
			<?php if (is_single() && fastblog_get_option('post/about')): ?>
				<div class="box about">
					<?php echo get_avatar(get_the_author_meta('ID'), 65); ?>
					<div class="content">
						<h4><?php the_author(); ?></h4>
						<p><?php the_author_meta('description'); ?></p>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php get_template_part('meta', 'loop'); ?>
	</div>

	<?php
		if (is_single()) {
			$meta = fastblog_get_option('post/meta');
			if ($meta['tags']) {
				the_tags('<div class="tags">', '', '</div>');
			}
		}
	?>
	<?php if (is_singular()) comments_template(); ?>

<?php endwhile; ?>