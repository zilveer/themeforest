<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

	<!-- Head section -->
	<head>

		<?php $template_uri = get_template_directory_uri(); ?>

		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<?php if (Website::to('other/description')): ?>
			<meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
		<?php endif; ?>
		<meta name="msapplication-TileImage" content="<?php echo Website::to('other/metro_ui_tile/image', '__default', sprintf('%s/data/img/tile/%s.png', $template_uri, Website::getLeadingLetter())); ?>" />
		<meta name="msapplication-TileColor" content="<?php echo Website::to('other/metro_ui_tile/color', '__default', Website::to('appearance/color')); ?>" />

		<?php wp_head(); ?>

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo $template_uri; ?>/data/css/ie9.min.css" />
		<![endif]-->
		<!--[if lte IE 8]>
			<link rel="stylesheet" href="<?php echo $template_uri; ?>/data/css/ie8.min.css" />
			<script src="<?php echo $template_uri; ?>/data/js/html5.min.js"></script>
			<script src="<?php echo $template_uri; ?>/data/js/respond.min.js"></script>
		<![endif]-->

	</head>
	<!-- // Head section -->

	<body <?php body_class(defined('ICL_LANGUAGE_CODE') ? 'lang-'.ICL_LANGUAGE_CODE : null); ?>>

		<?php if (count($nav_top_visible = Website::to('nav/top/visible')) > 0): ?>
			<!-- Top section -->
			<?php
				$top_class = '';
				if (Website::to('nav/top/fixed')) {
					$top_class .= 'fixed ';
				}
				if (count($nav_top_visible) == 1) {
					$top_class .= sprintf('%slte-mobile ', $nav_top_visible[0] == 'desktop' ? 'hide-' : '');
				}
			?>
			<header id="top" class="<?php echo trim($top_class); ?>">
				<div class="container">

					<h1><?php _e('Navigate / search', 'website'); ?></h1>

					<div class="frame">

						<div class="inner">

							<!-- Search form -->
							<form action="<?php echo esc_url(home_url('/')); ?>" method="get">
								<section id="search">
									<input type="submit" value="" />
									<div class="input">
										<input name="s" type="text" placeholder="<?php esc_attr_e('search', 'website'); ?>" value="<?php echo get_search_query(); ?>" />
									</div>
								</section>
							</form>
							<!-- // Search form -->

						</div><!-- // .inner -->

						<!-- Top navigation -->
						<?php Website::navMenu('top'); ?>
						<!-- // Top navigation -->

					</div><!-- // .frame -->

				</div>
			</header>
			<!-- // Top section -->
		<?php endif; ?>

		<!-- Main section -->
		<div id="main" class="clear">
			<div class="container">

				<!-- Header -->
				<header id="header" class="clear">
					<?php
						extract(Website::to_('header')->toArray());
						$ad['enabled'] = $ad['enabled'] && ($ad['image'] || $ad['code']);
						if (Website::to('advanced/scheme_switcher')) {
							$scheme        = Website::to('appearance/scheme');
							$ad['image']   = str_replace('%scheme%', $scheme, $ad['image']);
							$logo['image'] = str_replace('%scheme%', $scheme, $logo['image']);
						}
					?>
					<hgroup class="alpha<?php if (!$ad['enabled'] || $logo['center']) echo ' noad'; ?>">
						<h1 class="alpha vertical<?php if ($logo['center']) echo ' center'; ?>">
							<span>
								<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($logo['text']); ?>">
									<?php echo $logo['image'] ? sprintf('<img src="%s" alt="%s" />', esc_url($logo['image']), esc_attr($logo['text'])) : $logo['text']; ?>
								</a>
							</span>
						</h1>
						<?php if ($tagline && !$logo['center']): ?>
							<h2 class="vertical">
								<span><?php echo preg_replace('/\s*_\s*/', '&nbsp;', $tagline); ?></span>
							</h2>
						<?php else: ?>
							<div class="clear-this"></div>
						<?php endif; ?>
					</hgroup>
					<?php if ($ad['enabled'] && !$logo['center']): ?>
						<div class="ad beta vertical<?php if ($ad['hide_mobile']) echo ' hide-lte-mobile'; ?>">
							<div>
								<?php
									if ($ad['code']) {
										echo do_shortcode($ad['code']);
									} else if ($ad['url']) {
										printf('<a href="%s"><img src="%s" alt="ad" /></a>', $ad['url'], $ad['image']);
									} else {
										printf('<img src="%s" alt="ad" />', $ad['image']);
									}
								?>
							</div>
						</div>
					<?php endif; ?>
				</header>
				<!-- // Header -->

				<!-- Main navigation -->
				<?php Website::navMenu('main'); ?>
				<!-- // Main navigation -->