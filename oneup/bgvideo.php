<?php
/**
 * Shows the home background video
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>

<?php if ($t->hasBgVideo()): ?>
<?php $meta =& $t->content->meta(); ?>
<?php $bg = empty($meta->bg) ? new StdClass() : $meta->bg; ?>
<?php $videos = empty($bg->videos) ? false : $bg->videos; ?>

<?php if ($videos): ?>
<div 
	class="pe-bg-video"
	id="pe-bg-video"
	<?php foreach ($videos as $idx => $video): ?>
	<?php printf('data-video%d="%s" ',$idx,$video["url"]); ?>
	<?php endforeach; ?>
	data-settings="containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1, showControls:0, stopMovieOnBlur:false" 
	data-fallback="<?php echo $bg->fallback; ?>">
</div>
<div class="pe-bg-video pe-overlay" id="pe-bg-video-overlay"></div>

<?php endif; ?>

<?php endif; ?>
        