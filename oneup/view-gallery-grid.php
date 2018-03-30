<?php
/**
 * The template for displaying a gallery grid type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($conf,$loop) = $t->template->data(); ?>
<?php $settings =& $conf->settings; ?>

<?php $content =& $t->content; ?>
<?php $project =& $t->project; ?>
<?php $media =& $t->media; ?>
<?php $w = empty($settings->width) ? "auto" : $settings->width; ?>
<?php $h = empty($settings->height) ? "auto" : $settings->height; ?>
<?php $h = $h === "auto" && $w === "auto" ? 192 : $h; ?>
<?php $gx = isset($settings->gx) ? $settings->gx : 5; ?>
<?php $gy = isset($settings->gy) ? $settings->gy : 5; ?>

<?php $filterable = empty($settings->filterable) ? false : $settings->filterable; ?>
<?php $gid = "pe-gallery-grid"; ?>
<?php $gid .= empty($id) ? "" : "{$id}_"; ?>
<?php $gid .= empty($conf->data->id) ? "" : $conf->data->id; ?>


<div class="peIsotope portfolio pe-gallery-grid">

	<?php if ($filterable): ?>
	<div class="pe-container filter">
		<div class="row-fluid">
			<nav class="project-filter pe-menu-main">
				<ul class="pe-menu peIsotopeFilter">
					<?php $content->filter(array($settings->filterable,$loop),"","","<li>%s</li>"); ?>
				</ul>									
			</nav>
		</div>
	</div>
	<?php endif; ?>
						

	<div 
		 class="peIsotopeContainer peIsotopeGrid"
		 data-cell-width="<?php echo $w; ?>" 
		 data-cell-height="<?php echo $h; ?>"
		 data-cell-gx="<?php echo $gx; ?>"
		 data-cell-gy="<?php echo $gy; ?>"
		 data-sort="order"
		 >
		<div class="row-fluid">
			<div class="span12">

				<?php $clayout = empty($settings->clayout) || $settings->clayout != "fixed" ? false : array(1,1); ?>

				<?php while ($item =& $loop->next()): ?>
				<?php $hidden = ($settings->max > 0 && $item->idx >= $settings->max); ?>

				
				<div
					<?php if ($hidden): ?>
					class="hiddenLightboxContent" 
					<?php else: ?>
					class="peIsotopeItem <?php $content->filterClasses("media-tags",$item->id) ?>"
					<?php endif; ?>
					>
					<?php if (false): ?>
					<span class="cell-title"><?php echo $item->caption_title; ?></span>
					<?php endif; ?>
					<div class="scalable">
						<a 
							<?php if ($item->caption_title): ?>
							data-title="<?php echo esc_attr($item->caption_title); ?>"
							<?php endif; ?>
							<?php if ($item->caption_description): ?>
							data-description="<?php echo esc_attr($item->caption_description); ?>"
							<?php endif; ?>
							<?php if (!empty($item->video)): ?>
							data-flare-video="<?php echo esc_attr($item->video->url); ?>"
							data-flare-videowidth="<?php echo esc_attr($item->video->width); ?>"
							data-flare-videoposter="<?php echo esc_attr($item->video->poster); ?>"
							<?php endif; ?>
							class="peOver"
							data-target="flare"
							data-flare-gallery="<?php echo $gid; ?>"
							id="<?php echo "{$gid}_{$item->id}" ?>"
							data-flare-thumb="<?php echo $t->image->resizedImgUrl($item->img,90,74); ?>"
							<?php if ($settings->bw): ?>
							data-flare-bw="<?php echo $t->image->bw($item->img); ?>"
							<?php endif; ?>
							data-flare-plugin="<?php echo $settings->type ?>"
							data-flare-scale="<?php echo $settings->scale ?>"
							href="<?php echo $item->img; ?>"
							>
							<?php echo $hidden ? "" : $t->image->resizedImg($item->img,$w === "auto" ? 2640 : $w ,$h === "auto" ? 0 : $h,$w != "auto"); ?>
						</a>
					</div>
				</div>
					

				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
