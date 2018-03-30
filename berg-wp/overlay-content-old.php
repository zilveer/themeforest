<div class="berg-overlay-container">

	<div class="berg-overlay-gallery-wrapper">
		<div class="berg-overlay-gallery">

			<div class="owl-carousel berg-overlay-carousel">
				<?php
				$slides = get_post_meta(get_the_id(), 'portfolio_single', true);

				if (has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
					echo '<div class="item"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
				}

				if (!empty($slides)) {
					$slides = explode(',', $slides);

					if (is_array($slides)) {
						foreach ($slides as $slide) {
							echo '<div class="item"><figure>';
							$image = wp_get_attachment_image_src($slide, 'large_bg');
							echo '<img src="'.$image[0].'" alt=""/>';
							echo '</figure></div>';
						}
					}
				} 
				?>
			</div>
		</div>

		<div class="berg-overlay-close"></div>
		<div class="controls" style="width: 100%; text-align: center; position: absolute; top: 50%; margin-top: -25px; z-index: 999;">
			<div class="arrow-left berg-arrow berg-arrow-left"></div>
			<div class="arrow-right berg-arrow berg-arrow-right"></div>
		</div>
	</div>

	<div class="berg-overlay-content <?php if (YSettings::g('berg_portfolio_description', 0) == 1) { echo 'hidden'; } ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<header class="berg-overlay-header">
						<div class="clearfix">
							<img src="<?php echo $small_image_url[0]; ?>" class="hidden-xs hidden-sm" style="float: left; display: block; width: 80px; height: auto; margin-right: 30px;" />
							<h2 class="hidden-xs" style="margin-bottom: 5px"><?php the_title();?></h2>
							<h4 class="visible-xs"><?php the_title();?></h4>
							<p class="hidden-xs" style="white-space:nowrap; text-overflow: ellipsis; overflow: hidden; margin: 0; "><?php the_excerpt();?></p>
						</div>
						<?php if ($post->post_content != ''): ?>
							<div class="berg-overlay-to-bottom"><span class="btn btn-color btn-sm"><?php echo __('Read more', 'BERG'); ?></span></div>
						<?php endif; ?>
					</header>
				</div>
			</div>
			<?php if ($post->post_content != ''): ?>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<article>
						<?php the_content(); ?>
					</article>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>

</div>