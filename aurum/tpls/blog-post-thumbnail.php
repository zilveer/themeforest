<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

$has_thumbnail  = (is_single() ? get_data('blog_single_thumbnails') : get_data('blog_thumbnails')) && has_post_thumbnail();
$thumbnail_url  = '';

if($has_thumbnail)
{
	$post_thumb_id = get_post_thumbnail_id();
	$thumb         = wp_get_attachment_image_src($post_thumb_id, 'thumbnail_size');
	$thumbnail_url = $thumb[0];
}

if($more)
{
	$post_gallery = gb_field('post_slider_images');
}
?>
<?php if($has_thumbnail): ?>
<div class="post-image<?php echo is_single() ? ' nivo' : ''; ?>">

	<?php if(isset($post_gallery) && count($post_gallery) > 1): $autoswitch = get_data('blog_gallery_autoswitch'); ?>
		<div class="owl-slider" data-autoswitch="<?php echo floatval($autoswitch == '' ? 5 : $autoswitch); ?>">
			<?php
				if($has_thumbnail)
				{
					$attachment = get_post($post_thumb_id);

					if($attachment)
					{
						$post_gallery = array_merge(array($attachment), $post_gallery);
					}
				}
			?>

			<?php
			foreach($post_gallery as $i => $wp_image):

				$href       = $wp_image->guid;
				$alt        = $wp_image->_wp_attachment_image_alt;
				$is_video   = false;

				if(preg_match("/youtube\.com/i", $alt) || preg_match("/vimeo\.com/i", $alt))
				{
					$href      = $alt;
					$is_video  = true;
				}


				?>
				<a href="<?php echo $href; ?>" data-lightbox-gallery="post-gallery" class="<?php echo $i > 0 ? 'hidden' : ''; echo $is_video ? ' post-is-video' : ' post-is-image'; ?>">
					<?php echo wp_get_attachment_image($wp_image->ID, apply_filters('lab_blog_single_image_size', 'post-thumb-big')); ?>
				</a>
				<?php
			endforeach;
			?>
		</div>
	<?php else: # Simple Post Thumbnail ?>
		<?php
		if(is_single() && $has_thumbnail)
		{
			$alt         = get_post_meta($post_thumb_id, '_wp_attachment_image_alt', true);
			$is_video    = false;

			if(preg_match("/youtube\.com/i", $alt) || preg_match("/vimeo\.com/i", $alt))
			{
				$thumbnail_url  = $alt;
				$is_video       = true;
			}
		}
		?>
		<a href="<?php echo is_single() ? $thumbnail_url : $permalink; ?>" class="<?php echo isset($is_video) && $is_video ? 'post-is-video' : (is_single() ? 'post-is-image' : ''); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( apply_filters('lab_blog_single_image_size', 'post-thumb-big') ); ?>

			<?php if($hover_effect): ?>
				<?php if( ! $more): ?>
					<span class="thumb-hover"></span>
					<em><?php _e('Continue reading...', 'aurum'); ?></em>
				<?php endif; ?>
			<?php endif; ?>
		</a>
	<?php endif; ?>

</div>
<?php endif; ?>