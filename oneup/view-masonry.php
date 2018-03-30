<?php
/**
 * The template for displaying a portfolio grid type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($conf) = $t->template->data(); ?>
<?php $isPost = !empty($conf->type) && $conf->type === "post-post"; ?>
<?php $settings =& $conf->settings; ?>

<?php $content =& $t->content; ?>
<?php $project =& $t->project; ?>
<?php $media =& $t->media; ?>
<?php $inlinev = empty($settings->video) ? false : ($settings->video === "yes"); ?>
<?php $inlines = empty($settings->slider) ? false : ($settings->slider === "yes"); ?>
<?php $w = empty($settings->width) ? 320 : $settings->width; ?>
<?php $h = empty($settings->height) ? 180 : $settings->height; ?>
<?php $crop = empty($settings->crop) ? false : ($settings->crop === 'yes'); ?>
<?php $gx = $settings->gx; ?>
<?php $gy = $settings->gy; ?>
<?php $portID = "blog-".$conf->id."-".$post->ID; ?>

<?php $filterable = $settings->filterable; ?>
<?php $flareGallery = "portfolioGallery".$conf->id; ?>

<div class="peIsotope portfolio">

	<?php if ($filterable): ?>
	<div class="pe-container filter">
		<div>
			<nav class="project-filter pe-menu-main">
				<ul class="pe-menu peIsotopeFilter">
					<?php $content->filter($settings->filterable,"","","<li>%s</li>"); ?>
				</ul>									
			</nav>
		</div>
	</div>
	<?php endif; ?>

	<div class="peIsotopeContainer peIsotopeGrid no-transition pe-no-transition" 
		 data-cell-width="<?php echo $w; ?>" 
		 data-cell-height="auto"
		 data-cell-gx="<?php echo $gx; ?>"
		 data-cell-gy="<?php echo $gy; ?>"
		 >
		<div class="row-fluid">
			<div class="span12" id="pe-load-more-<?php echo $portID; ?>">
				<?php $bw = $media->w($w); ?>

				<?php while ($content->looping()): ?>
				<?php $meta =& $content->meta(); ?>
				<?php $img = $content->get_origImage();  ?>

				<?php $portfolio = empty($meta->portfolio) ? false : $meta->portfolio;  ?>

				<?php $thumb = empty($meta->portfolio->image) ? $img : $meta->portfolio->image ; ?>

				<?php $link = $content->getLink(); ?>
				
				<div class="peIsotopeItem pe-load-more-item <?php $content->filterClasses($settings->filterable); ?>">
					<div data-animation="fadeInUp" class="pe-item-mixed scalable pe-animation-maybe">
						<?php $format = $content->format();  ?>
						<?php if ($inlinev && $format === "video"): ?>
						<?php $t->video->output(); ?>
						<?php elseif ($inlines && $format === "gallery"): ?>
						<?php $content->slider($w,$h); ?>
						<?php elseif ($thumb): ?>
						<div class="pe-item-media">
							<a href="<?php echo $link; ?>">
								<?php echo $t->image->resizedImg($thumb,$w,$crop ? $h : null,$crop); ?>
							</a>
						</div>
						<?php endif; ?>
						<div class="pe-item-text">
							<div class="post-title">
								<h2><a href="<?php echo $link; ?>"><?php $content->title(); ?></a></h2>
							</div>
							<?php if ($isPost): ?>
							<div class="comments">
								<a href="<?php echo $link ?>" title="comments"><?php $content->comments(); ?></a>
								<i class="icon-comment"></i>
							</div>
							<div class="post-meta">
								<span class="user"><?php _e("By",'Pixelentity Theme/Plugin'); ?> <?php the_author_posts_link(); ?></span>
								<span class="date"><a href="<?php echo $link; ?>"><?php $content->date(); ?></a>
								</span>
							</div>
							<?php endif; ?>
							<div class="pe-item-text-content pe-wp-default">
								<?php $content->content(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php $bw->restore(); ?>
			</div>
		</div>
	</div>
</div>
<!-- /Project Feed -->

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>
