<?php
/**
 * The template for displaying a portfolio preview (ajax) type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($conf) = $t->template->data(); ?>
<?php $settings =& $conf->settings; ?>

<?php $content =& $t->content; ?>
<?php $project =& $t->project; ?>
<?php $media =& $t->media; ?>
<?php $w = empty($settings->width) ? "auto" : $settings->width; ?>
<?php $h = empty($settings->height) ? "auto" : $settings->height; ?>
<?php $h = $h === "auto" && $w === "auto" ? 192 : $h; ?>
<?php $gx = $settings->gx; ?>
<?php $gy = $settings->gy; ?>
<?php $portID = "portfolio-".$conf->id."-".$post->ID; ?>

<?php $filterable = $settings->filterable; ?>
<?php $flareGallery = "portfolioGallery".$conf->id; ?>

<?php $ptype = empty($conf->data->post_type) ? false : $conf->data->post_type; ?>
<?php $nosb = in_array($ptype,array('post','page')); ?>

<div class="pe-ajax-portfolio">


	<div class="pe-ajax-portfolio-spinner">
		<div class="pe-spinner"></div>
	</div>
	<div class="pe-ajax-portfolio-navigation">
		<div>
			<a href="#" class="pe-prev" data-action="prev"><i class="icon-left-open"></i></a>
			<a href="#" class="pe-close" data-action="close"><i class="icon-cancel"></i></a>
			<a href="#" class="pe-next" data-action="next"><i class="icon-right-open"></i></a>
		</div>
	</div>


	<div class="pe-scroller">
		<div class="pe-scroller-slide" id="<?php echo $portID; ?>">

			<div class="peIsotope portfolio pe-no-resize">

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

				<div class="peIsotopeContainer peIsotopeGrid pe-scroller-set-width" 
					 data-cell-width="<?php echo $w; ?>" 
					 data-cell-height="<?php echo $h; ?>"
					 data-cell-gx="<?php echo $gx; ?>"
					 data-cell-gy="<?php echo $gy; ?>"
					 data-sort="<?php echo $settings->sort; ?>"
					 >
					<div class="row-fluid">
						<div class="span12" id="pe-load-more-<?php echo $portID; ?>">

							<?php $clayout = empty($settings->clayout) || $settings->clayout != "fixed" ? false : array(1,1); ?>
							<?php $count = 1; ?>

							<?php while ($content->looping()): ?>
							<?php $meta =& $content->meta(); ?>
							<?php $img = $content->get_origImage();  ?>

							<?php $portfolio = empty($meta->portfolio) ? false : $meta->portfolio;  ?>

							<?php $thumb = empty($meta->portfolio->image) ? $img : $meta->portfolio->image ; ?>
							<?php list($cols,$rows) = $clayout ? $clayout : (explode("x",empty($meta->portfolio->layout) ? "1x1" : $meta->portfolio->layout)); ?>
							<?php $cw = $w*$cols+$gx*($cols-1); ?>
							<?php $ch = $h*$rows+$gy*($rows-1); ?>
							<?php $pw = $cw ? $cw : $ch; ?>
							<?php $ph = $ch ? $ch : $cw; ?>
							<?php $cw = $cw ? $cw : 2640; ?>
							<?php $slug = esc_attr(basename(get_permalink())); ?>
							<?php $link = $content->getLink(); ?>
							<?php $slink = $nosb ? add_query_arg(array("pe-no-sb" => ""),$link) : $link; ?>
							<div class="pe-scroller-slide pe-project-item pe-no-resize pe-scroller-set-width pe-load-more-item" data-slide="<?php echo $count; ?>" data-direction="left" data-slug="<?php echo $slug; ?>" data-load="<?php echo $slink; ?> .pe-portfolio-scroller-item">
							</div>
							<div class="peIsotopeItem pe-grid-img pe-load-more-item <?php $content->filterClasses($settings->filterable); ?>">
								<?php $ptitle = empty($portfolio->ptitle) ? get_the_title() : $portfolio->ptitle;  ?>
								<span class="cell-title">
									<span>
										<a href="<?php echo $link ?>" data-slide="<?php echo $count; ?>">
											<?php echo wp_kses_post($ptitle); ?>
										</a>
									</span>
									<?php if (!empty($portfolio->pdescription)): ?>
									<span class="description"><?php echo wp_kses_post($portfolio->pdescription); ?></span>
									<?php endif; ?>
								</span>
								<div data-animation="fadeIn" class="scalable pe-animation-maybe" data-cols="<?php echo $cols; ?>" data-rows="<?php echo $rows; ?>">
									<a class="<?php echo $thumb ? "" : "pe-placeholder"; ?>" href="<?php echo $link; ?>" data-slide="<?php echo $count; ?>" id="<?php echo "$portID-$count"; ?>" data-slug="<?php echo $slug; ?>">
										<?php if ($thumb): ?>
										<?php echo $t->image->resizedImg($thumb,$cw,$ch,$w != "auto"); ?>
										<?php else: ?>
										<?php echo $t->image->placeholder($pw,$ph); ?>
										<?php endif; ?>
									</a>
								</div>
							</div>
							
							<?php $count++; ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- /Project Feed -->

		</div>

		<?php if (false): ?>
		<?php $count = 1; while ($content->looping()): ?>
		<?php $slug = esc_attr(basename(get_permalink())); ?>
		<?php $link = get_permalink(); ?>
		<?php $link = $nosb ? add_query_arg(array("pe-no-sb" => ""),$link) : $link; ?>
		<div class="pe-scroller-slide pe-project-item pe-no-resize pe-scroller-set-width" data-slide="<?php echo $count++; ?>" data-direction="left" data-slug="<?php echo $slug; ?>" data-load="<?php echo $link; ?> .pe-portfolio-scroller-item">
		</div>
		<?php endwhile; ?>
		<?php endif; ?>

	</div>

	<div class="pe-ajax-portfolio-navigation">
		<div>
			<a href="#" class="pe-prev" data-action="prev"><i class="icon-left-open"></i></a>
			<a href="#" class="pe-close" data-action="close"><i class="icon-cancel"></i></a>
			<a href="#" class="pe-next" data-action="next"><i class="icon-right-open"></i></a>
		</div>
	</div>

</div>

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>
