<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$show_title = DfdMetaBoxSettings::compared('blog_single_show_title', false);

$show_meta = DfdMetaBoxSettings::compared('blog_single_show_meta', false);

$show_read_more_share = DfdMetaBoxSettings::compared('blog_single_show_read_more_share', false);

$show_fixed_share = DfdMetaBoxSettings::compared('blog_single_show_fixed_share', false);

$share_style = DfdMetaBoxSettings::compared('blog_single_share_style', false);
if($share_style) $share_style = 'dfd-share-'.$share_style;
?>

<?php
if($show_fixed_share == 'on') {
	get_template_part('templates/entry-meta/mini','share-single');
}
?>

<article <?php post_class(); ?>>
	<div class="dfd-single-post-heading">
		<?php if($show_title == 'on') : ?>
			<div class="dfd-news-categories">
				<?php get_template_part('templates/entry-meta/mini', 'category-highlighted'); ?>
			</div>
			<div class="dfd-blog-title"><?php the_title(); ?></div>
		<?php endif; ?>
		<?php if($show_meta == 'on') : ?>
			<?php get_template_part('templates/entry-meta', 'post-bottom') ?>
		<?php endif; ?>
	</div>
	<div class="entry-content">

		<?php     

		if(!get_post_format()) {
			get_template_part($post->ID, 'standard');
			the_content();
		} elseif (has_post_format('video')) {
			get_template_part('templates/post', 'video');
			the_content();
		} elseif (has_post_format('gallery')) {
			get_template_part('templates/post', 'gallery');
			the_content();
		} elseif (has_post_format('quote')) {
			get_template_part('templates/post', 'quote');
		} elseif (has_post_format('audio')) {
			get_template_part('templates/post', 'audio');
			the_content();
		}
	 ?>

	</div>
	<?php if($show_read_more_share == 'on') : ?>
		<div class="dfd-meta-container">
			<div class="dfd-commentss-tags">
				<div class="post-comments-wrap">
					<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
					<span class="box-name"><?php _e('Comments','dfd') ?></span>
				</div>
				<div class="dfd-single-tags clearfix">
					<?php get_template_part('templates/entry-meta/mini', 'tags'); ?>
				</div>
			</div>
			<div class="dfd-like-share">
				<div class="post-like-wrap left">
					<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
				</div>
				<div class="dfd-share-cover <?php echo esc_attr($share_style);  ?>">
					<?php get_template_part('templates/entry-meta/mini','share-blog') ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

</article>

<?php get_template_part('templates/author','box');

if (isset($dfd_ronneby['blog_items_disp']) && $dfd_ronneby['blog_items_disp']) { ?>
	<div class="block-under-single-post">
		<?php echo do_shortcode($dfd_ronneby['block_single_blog_item']); ?>
	</div>
<?php }