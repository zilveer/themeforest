<?php
/**
 * The template for displaying a gallery images type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($conf,$loop) = $t->template->data(); ?>
<?php $cover = empty($conf->settings->cover) ? $t->gallery->cover($conf->data->id) : $conf->settings->cover; ?>
<?php $settings = $conf->settings; ?>
<?php $gid = "pe-gallery-images"; ?>
<?php $gid .= empty($id) ? "" : "{$id}_"; ?>
<?php $gid .= empty($conf->data->id) ? "" : $conf->data->id; ?>

<?php while ($item =& $loop->next()): ?>
<div class="row-fluid pe-gallery-images">
	<div class="span12">
		<a 
			title="<?php echo esc_attr($item->title); ?>"
			<?php if ($item->caption_title): ?>
			data-title="<?php echo esc_attr($item->caption_title); ?>"
			<?php endif; ?>
			<?php if ($item->caption_description): ?>
			data-description="<?php echo esc_attr($item->caption_description); ?>"
			<?php endif; ?>
			<?php if (!empty($item->video)): ?>
			data-flare-video="<?php echo esc_attr($item->video->url); ?>"
			data-flare-videowidth="<?php echo esc_attr($item->video->width); ?>"
			data-flare-videoposter="<?php echo esc_attr($item->video->poster); ?>"
			<?php endif; ?>
			class="peOver"
			data-target="flare"
			data-flare-gallery="<?php echo $gid ?>"
			id="<?php echo "{$gid}_{$item->id}" ?>"
			data-flare-thumb="<?php echo $t->image->resizedImgUrl($item->img,90,74); ?>"
			<?php if ($settings->bw): ?>
			data-flare-bw="<?php echo $t->image->bw($item->img); ?>"
			<?php endif; ?>
			data-flare-plugin="<?php echo $settings->type ?>"
			data-flare-scale="<?php echo $settings->scale ?>"
			href="<?php echo $item->img; ?>"
			>
			<?php echo $t->image->resizedImg($item->img,$t->media->w,$t->media->h); ?>
		</a>
	</div>
</div>
<?php endwhile; ?>
