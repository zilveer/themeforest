<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta = $t->content->meta(); ?>
<?php $bg = empty($meta->bg->background) ? PE_THEME_URL."/images/bg.jpg" : $meta->bg->background;  ?>
<?php $isSlider = (! empty( $meta->bg->type ) && $meta->bg->type == 'slider') ? true : false;  ?>
<?php $isVideo = (! empty( $meta->bg->type ) && $meta->bg->type == 'video') ? true : false;  ?>

<?php if ($isSlider||$isVideo): ?>
<?php define( 'HOME_SLIDER', true ); ?>
<?php endif; ?>

<?php if ($isSlider): ?>

<?php $loop = $t->gallery->getSliderLoop($meta->bg->gallery); ?>
<?php if ( $loop ): ?>
<div class="hidden_overlay" data-src="<?php echo PE_THEME_URL."/images/slider/overlays/03.png"; ?>"></div>
<?php while ($slide =& $loop->next()): ?>
<div class="hiddenslide" data-src="<?php echo $slide->img; ?>"></div>
<?php endwhile; ?>
<?php else: ?>
<p><?php _e("Gallery you selected as a Slider Gallery in Home page settings contains no slides, make sure to upload at least one image for selected gallery.",'Pixelentity Theme/Plugin'); ?></p>
<?php endif; ?>

<section id="<?php $content->slug(); ?>" class="home-first-section hero clearfix">

	<!-- Content -->
	<div class="dark content container">

		<!-- Headings -->
		<div class="ticker">

			<?php if (!empty($meta->bg->headlines)): ?>
			<?php foreach ($meta->bg->headlines as $headline): ?>
			<h1><?php echo $headline; ?></h1>
			<?php endforeach; ?>
			<?php endif; ?>
	 	</div>



	 	<!-- Buttons -->
	 	<?php if ( ! empty( $meta->bg->label1 ) || ! empty( $meta->bg->label2 ) ): ?>
		<ul class="call-to-action">
			<?php if ( ! empty( $meta->bg->label1 ) ) : ?>
			<li>
				<?php $link1 = empty( $meta->bg->url1 ) ? 'javascript:void(0);' : $meta->bg->url1; ?>
				<a class="button" href="<?php echo $link1; ?>">
					<?php echo $meta->bg->label1; ?>
				</a>
			</li>
			<?php endif; ?>
			<?php if ( ! empty( $meta->bg->label2 ) ) : ?>
			<li>
				<?php $link2 = empty( $meta->bg->url2 ) ? 'javascript:void(0);' : $meta->bg->url2; ?>
				<a class="button no-border" href="<?php echo $link2; ?>" target="_blank">
					<?php echo $meta->bg->label2; ?>
					<span class="icon-circle">
						<i class="icon-right-open-big"></i>
					</span>
				</a>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>

		<!-- Slider Controls -->
		<ul class="slider-controls">
			<li><a id="vegas-next" href="#"><?php _e("Next",'Pixelentity Theme/Plugin'); ?></a></li>
			<li><a id="vegas-prev" href="#"><?php _e("Prev",'Pixelentity Theme/Plugin'); ?></a></li>
		</ul>

	</div>

</section>
<!-- End Hero -->

<?php elseif ($isVideo): ?>

<!-- Begin Hero -->
<section id="<?php $content->slug(); ?>" class="home-first-section hero hero-video clearfix" data-video="<?php echo esc_attr( $meta->bg->video ); ?>">

	<!-- Content -->
	<div class="dark content container">

		<!-- Headings -->
		<div class="ticker">
			<?php if (!empty($meta->bg->headlines)): ?>
			<?php foreach ($meta->bg->headlines as $headline): ?>
			<h1><?php echo $headline; ?></h1>
			<?php endforeach; ?>
			<?php endif; ?>
	 	</div>

	 	<!-- Buttons -->
	 	<?php if ( ! empty( $meta->bg->label1 ) || ! empty( $meta->bg->label2 ) ): ?>
		<ul class="call-to-action">
			<?php if ( ! empty( $meta->bg->label1 ) ) : ?>
			<li>
				<?php $link1 = empty( $meta->bg->url1 ) ? 'javascript:void(0);' : $meta->bg->url1; ?>
				<a class="button" href="<?php echo $link1; ?>">
					<?php echo $meta->bg->label1; ?>
				</a>
			</li>
			<?php endif; ?>
			<?php if ( ! empty( $meta->bg->label2 ) ) : ?>
			<li>
				<?php $link2 = empty( $meta->bg->url2 ) ? 'javascript:void(0);' : $meta->bg->url2; ?>
				<a class="button no-border" href="<?php echo $link2; ?>" target="_blank">
					<?php echo $meta->bg->label2; ?>
					<span class="icon-circle">
						<i class="icon-right-open-big"></i>
					</span>
				</a>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>

	</div>

</section>
<!-- End Hero -->

<?php else: ?>

<!-- Begin Hero -->
<section id="<?php $content->slug(); ?>" class="home-first-section hero parallax clearfix" style="background-image: url('<?php echo $bg; ?>');">

	<!-- Content -->
	<div class="dark content container">
		<!-- Headings -->
		<div class="ticker">
			<?php if (!empty($meta->bg->headlines)): ?>
			<?php foreach ($meta->bg->headlines as $headline): ?>
			<h1><?php echo $headline; ?></h1>
			<?php endforeach; ?>
			<?php endif; ?>
	 	</div>

	 	<!-- Buttons -->
	 	<?php if ( ! empty( $meta->bg->label1 ) || ! empty( $meta->bg->label2 ) ): ?>
		<ul class="call-to-action">
			<?php if ( ! empty( $meta->bg->label1 ) ) : ?>
			<li>
				<?php $link1 = empty( $meta->bg->url1 ) ? 'javascript:void(0);' : $meta->bg->url1; ?>
				<a class="button" href="<?php echo $link1; ?>">
					<?php echo $meta->bg->label1; ?>
				</a>
			</li>
			<?php endif; ?>
			<?php if ( ! empty( $meta->bg->label2 ) ) : ?>
			<li>
				<?php $link2 = empty( $meta->bg->url2 ) ? 'javascript:void(0);' : $meta->bg->url2; ?>
				<a class="button no-border" href="<?php echo $link2; ?>" target="_blank">
					<?php echo $meta->bg->label2; ?>
					<span class="icon-circle">
						<i class="icon-right-open-big"></i>
					</span>
				</a>
			</li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>

	</div>

</section>
<!-- End Hero -->

<?php endif; ?>