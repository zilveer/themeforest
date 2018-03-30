<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $post;

# Nivo Lightbox
wp_enqueue_script('nivo-lightbox');
wp_enqueue_style('nivo-lightbox-default');

the_post();

get_header();

$id = get_the_id();
$img = wp_get_attachment_image_src($id, 'original');

?>
<div class="container page-container">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="attachment-title"><?php the_title(); ?></h2>

			<a href="<?php echo $img[0]; ?>" class="attachment-img nivo">
				<?php echo wp_get_attachment_image($id, 'post-thumb-big'); ?>
			</a>

			<dl>
				<?php if($post->post_content): ?>
				<dt><?php _e('Description', 'aurum'); ?></dt>
				<dd><?php the_content(); ?></dd>
				<?php endif; ?>

				<?php if($post->post_excerpt): ?>
				<dt><?php _e('Caption', 'aurum'); ?></dt>
				<dd><?php the_excerpt(); ?></dd>
				<?php endif; ?>

				<?php if($post->_wp_attachment_image_alt): ?>
				<dt><?php _e('Alt Text', 'aurum'); ?></dt>
				<dd><?php echo $post->_wp_attachment_image_alt; ?></dd>
				<?php endif; ?>

				<dt><?php _e('Date Added', 'aurum'); ?></dt>
				<dd><?php the_date(get_option('date_format')); ?></dd>

				<dt><?php _e('Dimensions', 'aurum'); ?></dt>
				<dd><?php echo "$img[1] x $img[2]"; ?></dd>

				<dt><?php _e('Size', 'aurum'); ?></dt>
				<dd><?php echo size_format(filesize(get_attached_file($post->ID))); ?></dd>
			</dl>

		</div>
	</div>
</div>
<?php

get_footer();