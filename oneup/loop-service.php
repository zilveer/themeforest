<?php
/**
 * The loop for displaying one or more service custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<?php while ($content->looping(2) ) : ?>
<?php $meta = $content->meta(); ?>
<?php $content->beginRow('<div class="row-fluid">'); ?>
<div class="span12">
	<div class="service-single">
		<?php if (!empty($meta->info->icon)): ?>
		<span class="service-icon">
			<span class="arrow"></span>
			<i class="<?php echo $meta->info->icon; ?>"></i>
		</span>
		<?php endif; ?>
		<div class="service-single-content pe-wp-default">
			<?php $content->content(); ?>
		</div>
	</div>
</div>
<?php $content->endRow(); ?>
<?php endwhile; ?>