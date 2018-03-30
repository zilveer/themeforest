<?php
/**
 * The loop for displaying search results.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($conf) = $t->template->data(); ?>
<?php $settings = $conf->settings; ?>
<?php $w = $t->media->w; ?>
<?php $h = $t->media->h; ?>

<?php while ($content->looping()) : ?>
<?php $link = $content->getLink(); ?>

<!--new result-->
<div class="row-fluid result pe-load-more-item">
	<div class="span9 result-title">
	 <h3><a href="<?php echo $link; ?>"><?php $content->title(); ?></a></h3>
	 <p><?php the_excerpt(); ?></p>
	 <a href="<?php echo $link; ?>" class="more-link"><?php _e("View Result",'Pixelentity Theme/Plugin'); ?></a>
	</div>
	<div class="span3 post-image">
		<a href="<?php echo $link; ?>">
			<?php $content->img(420,372); ?>
		</a>
	</div>
</div>

<?php endwhile; ?>

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>