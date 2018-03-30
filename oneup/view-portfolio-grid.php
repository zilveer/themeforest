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

	<div class="peIsotopeContainer peIsotopeGrid" 
		 data-cell-width="<?php echo $w; ?>" 
		 data-cell-height="<?php echo $h; ?>"
		 data-cell-gx="<?php echo $gx; ?>"
		 data-cell-gy="<?php echo $gy; ?>"
		 data-sort="<?php echo $settings->sort; ?>"
		 >
		<div class="row-fluid">
			<div class="span12" id="pe-load-more-<?php echo $portID; ?>">

				<?php $clayout = empty($settings->clayout) || $settings->clayout != "fixed" ? false : array(1,1); ?>

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

				<?php //print_r(array($w,"here",$cw,$ch)); continue; ?>

				<?php $link = $content->getLink(); ?>
				
				<div class="peIsotopeItem pe-grid-img pe-load-more-item <?php $content->filterClasses($settings->filterable); ?>">
					<?php $ptitle = empty($portfolio->ptitle) ? get_the_title() : $portfolio->ptitle;  ?>
					<span class="cell-title">
						<span>
							<a href="<?php echo $link ?>">
								<?php echo wp_kses_post($ptitle); ?>
							</a>
						</span>
						<?php if (!empty($portfolio->pdescription)): ?>
						<span class="description"><?php echo wp_kses_post($portfolio->pdescription); ?></span>
						<?php endif; ?>
					</span>			
					<div data-animation="fadeIn" class="scalable pe-animation-maybe" data-cols="<?php echo $cols; ?>" data-rows="<?php echo $rows; ?>">
						<?php if ($settings->lightbox === "yes" && (empty($portfolio->lightbox) || $portfolio->lightbox === "yes")): ?>
						<?php $format = $content->format();  ?>
						<?php switch($format): case "gallery": // Gallery post ?>
						
						<?php $view = $t->gallery->conf($meta->gallery->id,"GalleryCover"); ?>
						<?php if ($thumb): ?>
						<?php $view->settings->cover = $thumb; ?>
						<?php list($url,$vw,$vh) = $t->image->resize($thumb,$cw,$ch,$w != "auto"); ?>
						<?php else: ?>
						<?php $vw = $pw; ?>
						<?php $vh = $ph; ?>
						<?php endif; ?>
						<?php $t->view->resize($view,$vw,$vh) ?>

						<?php break; default: // Standard post ?>
						
						<?php $video = $format === "video" ? $t->video->conf() : false; ?>
						
						<a
							class="<?php echo $thumb ? "" : "pe-placeholder"; ?>"
							data-title="<?php echo empty($portfolio->title) ? "" : esc_attr($portfolio->title); ?>" 
							data-description="<?php echo empty($portfolio->description) ? "" : esc_attr($portfolio->description); ?>"
							<?php if (!empty($video->url)): ?>
							data-flare-video="<?php echo $video->url; ?>"
							<?php endif; ?>
							<?php if (!empty($video->poster)): ?>
							data-flare-videoposter="<?php echo $video->poster; ?>"
							<?php endif; ?>
							<?php if (!empty($video->width)): ?>
							data-flare-videowidth="<?php echo $video->width; ?>"
							<?php endif; ?>

							data-flare-gallery="<?php echo $flareGallery; ?>"
							data-flare-thumb="<?php echo $t->image->resizedImgUrl($thumb,90,74); ?>"
							data-flare-plugin="default"
							data-flare-scale="fit"

							<?php if ($thumb): ?>
							href="<?php $content->origImage(); ?>"
							<?php else: ?>
							href="<?php echo $link; ?>"
							<?php endif; ?>
							>
							<?php if ($thumb): ?>
							<?php echo $t->image->resizedImg($thumb,$cw,$ch,$w != "auto"); ?>
							<?php else: ?>
							<?php echo $t->image->placeholder($pw,$ph); ?>
							<?php endif; ?>
						</a>

						<?php endswitch; ?>
						

						<?php else: ?>
						<a href="<?php echo $link; ?>">
							<?php if ($thumb): ?>
							<?php echo $t->image->resizedImg($thumb,$cw,$ch,$w != "auto"); ?>
							<?php else: ?>
							<?php echo $t->image->placeholder($pw,$ph); ?>
							<?php endif; ?>
						</a>
						<?php endif; ?>						

					</div>
				</div>
					

				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
<!-- /Project Feed -->

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>
