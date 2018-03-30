<?php
/**
 * The template for displaying a carousel type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($conf) = $t->template->data(); ?>
<?php $settings =& $conf->settings; ?>
<?php $navigation = absint($settings->layout) < $content->count();  ?>

<div class="row-fluid carouselBox" data-slidewidth="<?php echo $settings->sw ?>">				
	<?php while ($content->looping()): ?>
	<?php $meta = $content->meta(); ?>
	<?php $link = empty($meta->info->url) ? get_permalink() : $meta->info->url; ?>

	<div 
		data-autopause="enabled"
		data-delay="<?php echo $settings->delay; ?>"
		>

		<div>
			<?php switch ($settings->style): case "testimonials": ?>

			<?php $cite = empty($meta->info->type) ? "" : ", ".$meta->info->type; ?>

			<div>
				<i class="icon-quote"></i>
				<h2><?php echo get_the_excerpt(); ?></h2>
				<cite>
					&mdash;
					<span class="accent"><?php $content->title(); ?></span><?php echo $cite ?>
				</cite>
			</div>
			<?php break; case "services": ?>

			<div data-animation="fadeInDown" class="service-item pe-animation-maybe">
				<div>
					<?php $icon = empty($meta->info->icon) ? 'icon-comment' : $meta->info->icon; ?>
					<i class="<?php echo $icon ?>"></i>
					<span class="arrow"></span>
				</div>
				<h4><?php $content->title(); ?></h4>
				<?php $content->content(); ?>
			</div>

			<?php break; default: ?>

			<div class="project-item">
				<?php if ($content->hasFeatImage()): ?>
				<a class="over-effect" href="<?php echo $link; ?>">
					<?php $content->img($settings->w,$settings->h) ?>
				</a>
				<?php endif; ?>
				<h6><a href="<?php echo $link; ?>"><?php $content->title(); ?></a></h6>
				<p><?php echo $t->utils->truncateString(get_the_excerpt(),$settings->chars); ?></p>
			</div>

			<?php endswitch; ?>
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
