<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */

if ($slider = Website::getSliderName()) {

	// Slider query
	$slider_query = new WP_Query(array(
		'post_type'   => 'slider',
		'post_status' => 'publish',
		'p'           => $slider
	));

	if ($slider_query->have_posts()) {

		// Slider options
		$slider_query->the_post();
		$slider_items = Website::po('content/items');
		$slider_type  = Website::po('options/type');

		// Slider items query
		$slider_items_query = new WP_Query(array(
			'post_type'      => 'slider-item',
			'post_status'    => 'publish',
			'post__in'       => empty($slider_items) ? array(0) : $slider_items,
			'posts_per_page' => -1,
			'orderby'        => Website::po('options/orderby'),
			'order'          => strtoupper(Website::po('options/order')),
		));

		$banners      = array();
		$slides       = array();
		$descriptions = array();

		// Additional banners
		for ($i = 1; $i <= 2; $i++) {

			// Banner
			$banner = wp_get_attachment_image(Website::po("banner_{$i}/image"), 'banner-small');

			// Banner caption
			if ($caption = Website::po("banner_{$i}/caption/text")) {
				$banner .= sprintf(
					'<span class="caption %s">%s</span>',
					Website::po("banner_{$i}/caption/color"),
					$caption
				);
			}

			// Banner link
			if ($link = Website::po("banner_{$i}/link")) {
				$banner = sprintf('<a href="%s">%s</a>', $link, $banner);
			}

			// Banner
			$banner = sprintf('<div class="banner small image %s">%s</div>', $i == 1 ? 'second' : 'third', $banner);
			$banners[] = $banner;

		}

		// Slider items
		while ($slider_items_query->have_posts()) {

			// Slider item options
			$slider_items_query->the_post();

			// Slide
			if ($video = Website::po('video/code')) {

				// YouTube
				$video = preg_replace_callback(
					'#src="(?P<url>(https?:)?//www.youtube.com/embed/[-_a-z0-9]+)\??(?P<get>.*?)"#i',
					function($m) {
						return sprintf('src="%s?wmode=opaque%s"', $m['url'], isset($m['get']) && $m['get'] ? '&amp;'.$m['get'] : '');
					},
					$video
				);

				// Slide video
				$slide = $video;

			} else {

				// Slide image
				if (!has_post_thumbnail()) {
					continue;
				}
				$slide = get_the_post_thumbnail(get_the_ID(), 'banner-'.str_replace('_', '-', $slider_type));

				// Slide text
				if ($text = Website::po('content/text/text')) {
					$slide .= sprintf(
						'<span class="caption %s" style="color: %s;"><span>%s</span></span>',
						Website::po('content/text/align'),
						Website::po('content/text/color'),
						nl2br($text)
					);
				}

				// Slide link
				if ($link = Website::po('content/link/url')) {
					$slide = sprintf('<a href="%s" target="%s">%s</a>', $link, Website::po('content/link/new_window') ? '_blank' : '_self', $slide);
				}

				// Slide caption
				if ($caption = Website::po('content/caption')) {
					$slide .= sprintf('<p class="flex-caption">%s</p>', $caption);
				}

			}

			// Slide
			$slide = sprintf('<li>%s</li>', $slide);
			$slides[] = $slide;

			// Description
			$description = '';

			// Description title
			if ($title = Website::po('description/title')) {
				$description .= sprintf('<h1>%s</h1>', $title);
			}

			// Description text
			if ($text = Website::po('description/text')) {
				if ($tablet_text = Website::po('description/tablet_text')) {
					$description .= sprintf(
						'<div class="hide-tablet">%s</div>'.
						'<div class="tablet">%s</div>',
						\Drone\Func::stringToHTML($text),
						\Drone\Func::stringToHTML($tablet_text)
					);
				} else {
					$description .= \Drone\Func::stringToHTML($text);
				}
			}

			// Description url
			if ($url = Website::po('description/readmore/url')) {
				$description .= sprintf('<p><a href="%s" class="more">%s</a></p>', $url, Website::po('description/readmore/text'));
			}

			// Description
			$description = sprintf('<article>%s</article>', $description);
			$descriptions[] = $description;

		}

		// Output
		echo '<div id="banners" class="clear">';

		switch ($slider_type) {
			case 'full':
				?>
				<div class="banner full flexslider fixed">
					<ul class="slides">
						<?php echo implode('', $slides); ?>
					</ul>
				</div>
				<?php
				break;
			case 'one_two':
				?>
				<div class="banner big flexslider fixed alpha">
					<ul class="slides">
						<?php echo implode('', $slides); ?>
					</ul>
				</div>
				<div class="beta">
					<?php echo implode('', $banners); ?>
				</div>
				<?php
				break;
			case 'one_text':
				?>
				<div class="banner">
					<div class="alpha big flexslider fixed">
						<ul class="slides">
							<?php echo implode('', $slides); ?>
						</ul>
					</div>
					<div class="descriptions beta">
						<?php echo implode('', $descriptions); ?>
					</div>
				</div>
				<?php
				break;
		}

		echo '</div>';

		// Reset query
		wp_reset_query();

	}

}