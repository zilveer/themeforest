<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby; ?>
<article <?php post_class(); ?>>
	<div class="entry-data">
		<figure class="author-photo">
			<?php echo get_avatar( get_the_author_meta('ID') , 40 ); ?>
		</figure>
		<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
	</div>
	<?php
	/*

	 * if (has_post_thumbnail()) {
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
		if ($dfd_ronneby['post_thumbnails_width'] && $dfd_ronneby['post_thumbnails_height']) {
			$article_image = dfd_aq_resize($img_url, $dfd_ronneby['post_thumbnails_width'], $dfd_ronneby['post_thumbnails_height'], true, true, true);
		} else {
			$article_image = dfd_aq_resize($img_url, 1200, 500, true, true, true);
		}
		?>
		<div class="post-media clearfix">
			<div class="entry-thumb">
				<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
			</div>
		</div>
	<?php
	}*/
	?>

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
	<div class="dfd-meta-container">
		<div class="post-like-wrap left">
			<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
			<div class="box-name"><?php _e('Recommend', 'dfd'); ?></div>
		</div>
		<div class="dfd-single-share left">
			<?php
			if (isset($dfd_ronneby['post_share_button']) && $dfd_ronneby['post_share_button']) {
				get_template_part('templates/entry-meta/mini', 'share-popup');
			}
			?>
			<div class="box-name"><?php _e('Share', 'dfd'); ?></div>
		</div>
		<div class="dfd-single-tags right">
			<?php get_template_part('templates/entry-meta/mini', 'tags'); ?>
			<div class="box-name"><?php _e('Tagged in', 'dfd'); ?></div>
		</div>
	</div>

</article>