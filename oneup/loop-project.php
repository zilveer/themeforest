<?php
/**
 * The loop for displaying one or more project custom post type.
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

<?php while ($content->looping()): ?>
<?php $meta =& $content->meta(); ?>
<?php $link = $content->getLink(); ?>

<?php $t->media->w(620); ?>

<div class="row-fluid project-single-col clearfix pe-load-more-item">	
	<section class="span8 media">
		<?php if ($content->media() === "image"): ?>
		<a class="over-effect" href="<?php echo $link; ?>">
			<?php $content->img(620,350); ?>
		</a>
		<?php endif; ?>
	</section>
	<section class="span4 info">
		<div class="inner-spacer-left-lrg">
			<h3><a href="<?php echo $link ?>"><?php $content->title(); ?></a></h3>
			<div class="categories">
				<?php $content->tags(", ","prj-category"); ?>
			</div>
			<div class="pe-wp-default">
				<?php $content->content(); ?>
			</div>
		</div>
	</section>
</div>
<?php endwhile; ?>

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>
