<?php $t =& peTheme(); ?>
<?php list($conf,$loop) = $t->template->data(); ?>

<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>

<?php $width = isset( $meta->gallery ) && isset( $meta->gallery->width ) && absint( $meta->gallery->width ) !== 0 ? absint( $meta->gallery->width ) : $t->media->w; ?>
<?php $height = isset( $meta->gallery ) && isset( $meta->gallery->height ) && absint( $meta->gallery->height ) !== 0 ? absint( $meta->gallery->height ) : $t->media->h; ?>

<ul class="gallery clearfix">
<?php while ($item =& $loop->next()): ?>

	<li><?php echo $t->image->resizedImg($item->img,$width,$height); ?></li>				

<?php endwhile; ?>
</ul>
<div class="gallery-next"></div>
<div class="gallery-prev"></div>