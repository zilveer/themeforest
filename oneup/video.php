<?php
/**
 * Shows a youtube/vimeo video.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($video) = $t->template->data(); ?>


<?php if (!empty($video->poster) && ($w = $t->media->w)): ?>
<?php $h = round($w*9/16); ?>
<?php $video->poster = $t->image->resizedImgUrl($video->poster,$w,$h);  ?>
<?php endif; ?>

<?php if ($video->fullscreen === "yes"): ?>
<a 
	href="<?php echo $video->url ?>" 
	<?php if (!empty($video->poster)): ?>
	data-poster="<?php echo $video->poster; ?>"
	<?php endif; ?>
	data-target="flare"
	<?php if (!empty($video->formats)): ?>
	data-flare-videoformats="<?php echo join(",",$video->formats); ?>"
	<?php endif; ?>
	<?php if (!empty($video->poster)): ?>
	data-flare-videoposter="<?php echo $video->poster; ?>"
	<?php endif; ?>
	<?php if (!empty($video->width)): ?>
	data-flare-videowidth="<?php echo $video->width; ?>"
	<?php endif; ?>
	class="peVideo">
</a>

<?php else: ?>
<a 
	href="<?php echo $video->url ?>" 
	<?php if (!empty($video->formats)): ?>
	data-formats="<?php echo join(",",$video->formats); ?>" 
	<?php endif; ?>
	<?php if (!empty($video->poster)): ?>
	data-poster="<?php echo $video->poster; ?>"
	<?php endif; ?>
	class="peVideo">
</a>


<?php endif; ?>
