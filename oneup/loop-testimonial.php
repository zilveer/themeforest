<?php
/**
 * The loop for displaying one or more testimonial custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<?php while ($content->looping(1) ) : ?>
<?php $meta = $content->meta(); ?>
<?php $testimonial = empty($meta->info) ? false : $meta->info; ?>
<?php $cite = empty($testimonial->type) ? "" : $testimonial->type; ?>
<?php $content->beginRow('<div class="row-fluid">'); ?>

<div class="span12">
	<div class="testimonial">
		<div class="speech"></div>
		<div class="content">
			<blockquote>
				<?php $content->content(); ?>
			</blockquote>
			<p>
				<cite><?php $content->title(); ?>
				<?php if ($cite): ?>
				, <span class="accent"><?php echo $cite; ?></span>
				<?php endif; ?>
				</cite>
			</p>
		</div>
	</div>
</div>

<?php $content->endRow(); ?>
<?php endwhile; ?>
