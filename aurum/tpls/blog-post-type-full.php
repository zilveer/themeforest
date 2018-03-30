<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $more;

$hover_effect   = get_data('blog_thumbnail_hover_effect');
$author_info 	= get_data('blog_author_info');
$permalink      = get_permalink();

$has_thumbnail  = (is_single() ? get_data('blog_single_thumbnails') : get_data('blog_thumbnails')) && has_post_thumbnail();
$hover_effect   = get_data('blog_thumbnail_hover_effect');


?>
<article <?php post_class('post'); ?>>
	<?php if($has_thumbnail): ?>
	<div class="col-lg-12">
		<?php include('blog-post-thumbnail.php'); ?>
	</div>
	<?php endif; ?>

	<div class="col-lg-8 col-lg-offset-2">

		<div class="post-content">
			<h1 class="title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php include locate_template('tpls/blog-post-meta.php'); ?>
			</h1>

			<?php include locate_template('tpls/blog-post-content.php'); ?>
			
			<?php include locate_template('tpls/blog-post-nextprev.php'); ?>

		</div>

		<?php if(is_single()): ?>

			<?php include locate_template('tpls/blog-post-share.php'); ?>

			<?php include locate_template('tpls/blog-post-author-info.php'); ?>

			<?php comments_template(); ?>

		<?php endif; ?>

	</div>
</article>