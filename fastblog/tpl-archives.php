<?php
/**
 * @template name: Archives
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.4
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
				<ul>
					<?php wp_get_archives(array('show_post_count' => true)); ?>
				</ul>
			</div>
		</div>

	<?php endif; ?>

</div>

<?php get_footer(); ?>