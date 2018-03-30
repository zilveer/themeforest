<?php
/**
 * The template for displaying a carousel type view (gallery based)
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($conf,$loop) = $t->template->data(); ?>
<?php $settings =& $conf->settings; ?>
<?php $navigation = absint($settings->layout) < ($loop->last + 1);  ?>

<div class="row-fluid carouselBox pe-gallery-carousel" data-slidewidth="<?php echo $settings->sw ?>">
	<?php while ($slide =& $loop->next()): ?>

	<div
		data-autopause="enabled"
		data-delay="<?php echo $settings->delay; ?>"
		>

		<div>
			<div class="project-item">
				<div class="pe-media">
					<?php if (empty($slide->video->postID)): ?>
					<?php echo $t->image->resizedImg($slide->img,$settings->w,$settings->h); ?>
					<?php else: ?>
					<?php $w = $t->media->w($settings->w); ?>
					<?php $t->video->output($slide->video->postID); ?>
					<?php $w->restore(); ?>
					<?php endif; ?>
				</div>
				<?php if (!empty($slide->caption_title)): ?>
				<h6><?php echo wp_kses_post($slide->caption_title); ?></h6>
				<?php endif; ?>
				<?php if (!empty($slide->caption_description)): ?>
				<p><?php echo wp_kses_post($slide->caption_description); ?></p>
				<?php endif; ?>
			</div>
		</div>  
	</div>
	<?php endwhile; ?>
</div>

<div class="row-fluid">
	<div class="carousel-nav">
		<a href="#" class="prev-btn"><i class="icon-left-open"></i></a>
		<a href="#" class="next-btn"><i class="icon-right-open"></i></a>
	</div>
</div>