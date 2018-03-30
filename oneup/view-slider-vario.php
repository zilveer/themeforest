<?php
/**
 * The template for displaying a vario slider type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $view =& $t->view; ?>
<?php list($conf,$loop) = $t->template->data(); ?>
<?php $id = empty($conf->id) ? "" : $conf->id; ?>
<?php $w = $t->media->w; ?>
<?php $h = $t->media->h; ?>
<?php $boxed = empty($conf->settings->layout) || $conf->settings->layout === "boxed"; ?>
<?php $maxH = empty($conf->settings->max) ? 0 : $conf->settings->max; ?>
<?php $maxH = $view->resized ? $h : $maxH; ?>
<?php $minH = empty($conf->settings->min) ? 0 : $conf->settings->min; ?>
<?php $video = empty($conf->settings->bg) || $conf->settings->bg != "video" || empty($conf->settings->video) ? false : $conf->settings->video; ?>


<div 
	class="peSlider peVolo peNeedResize pe-block"
	<?php if (empty($conf->settings->autopause)): ?>
	data-autopause="disabled"
	<?php endif; ?>
	data-plugin="peVario"
	data-controls-arrows="edges-full" 
	data-controls-bullets="disabled"
	data-icon-font="enabled" 
	<?php if (!$boxed): ?>
	data-height="<?php echo $minH ?>,2.35,<?php echo $maxH; ?>"
	<?php endif; ?>
	<?php if ($video): ?>
	data-video-source="<?php echo preg_replace("/\.mp4$/i",".ogv",$video); ?>"
	data-video-formats="mp4"
	<?php if (!empty($conf->settings->fallback)): ?>
	data-video-fallback="<?php echo $conf->settings->fallback; ?>"
	<?php endif; ?>
	data-video-loop="<?php echo empty($conf->settings->loop) ? "disabled" : "enabled" ?>"
	<?php endif; ?>

	>
	<div class="peWrap">

	<?php while ($slide =& $loop->next()): ?>
	
	<?php $link = empty($slide->link) ? false: $slide->link; ?>
	<?php $img = $video ? "" : (!$boxed ?  $t->image->resizedImg($slide->img,10000,10000) : $t->image->resizedImg($slide->img,$w,$h)); ?>
	
	<div 
		data-delay="<?php echo empty($conf->settings->delay) ? 0 : $conf->settings->delay; ?>"
		data-transition="<?php echo empty($conf->settings->transition) ? "random" : $conf->settings->transition; ?>"
		class="<?php echo $slide->idx == 0 ? "visible" : ""; ?> <?php echo $boxed ? "" : "scale" ?>"
		>
		
		<?php if (!empty($slide->caption)) $view->caption($slide->caption); ?>
		<?php if ($link): ?>
		<a href="<?php echo $link ?>" data-flare-gallery="fsGallery<?php echo $id ?>">
			<?php echo $img; ?>
		</a>
		<?php else: ?>
		<?php echo $img; ?>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
	</div>
</div>

