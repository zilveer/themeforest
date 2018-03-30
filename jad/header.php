<!DOCTYPE html>
<!--
	Theme Name: JAD
	Description: Wordpress
	Author: fireform
	License: GNU General Public License version 3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Designed & Coded by Fireform
	All files, unless otherwise stated, are released under the GNU General Public License
	version 3.0 (http://www.gnu.org/licenses/gpl-3.0.html)
-->

<?php sg_init_config($post); ?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class="no-js">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
	<?php sg_header_meta(); ?>
	<?php sg_header_css(); ?>
	<?php sg_header_js(); ?>
	<?php _sg('General')->eFavIcon(); ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<?php _sg('Theme')->eCSS(); ?>
	<?php $body_class = _sg('HandF')->eHeaderImg(); ?>
	<?php if (!_sg('Modules')->enabled('Theme')) { ?>
		<link  type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Podkova:400,700' />
		<link type='text/css' rel='stylesheet' href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic&amp;subset=latin,cyrillic-ext,greek-ext,greek,cyrillic,latin-ext' />
	<?php } ?>
	<?php $body_class .= ((sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'full' AND _sg('Slider')->getSlidesCount() > 0) ? ' ef-fullscreen' : ''); ?>
	<?php $body_class .= ((sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'no') ? ' ef-noslider' : ''); ?>
</head>
<body <?php body_class($body_class); ?>>
	<?php if (sg_get_tpl() != 'page|home' OR _sg('Slider')->getSliderType() != 'full' OR _sg('Slider')->getSlidesCount() == 0) _sg('Theme')->eBGsh(); ?>
	<div id="ef-header">
		<div class="ef-head-top">
			<div class="ef-canvas clearfix">
				<div class="ef-full-grid gu12 ef-pagewrap">
					<div class="ef-row clearfix">
						<div class="ef-col ef-gu12 ef-logonav">
							<div class="ef-logo ef-gu3 alignleft">
								<a href="<?php echo home_url(); ?>"><img src="<?php _sg('General')->eLogoURL(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
							</div>
							<div class="alignright ef-icon-panel">
								<div class="ef-social">
									<?php _sg('HandF')->eSocial(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ef-menu-wrapper ef-default">
				<div class="ef-full-inner clearfix">
					<div class="ef-nav ef-row clearfix">
						<div class="ef-col ef-gu3 ef-site-description">
							<?php _sg('HandF')->eHeaderCTitle(); ?>
						</div>
						<div class="ef-col ef-gu9">
							<?php wp_nav_menu(array('theme_location' => 'main_navigation', 'fallback_cb' => 'sg_page_menu', 'depth' => 4, 'container' => 'ul', 'menu_class' => 'sf-menu')); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bold-divider ef-full-inner"></div>
		<?php if (sg_get_tpl() == 'page|home' AND _sg('Slider')->showSlider()) { ?>
			<?php _sg('Slider')->eSlider(); ?>
			<a href="#" id="ef-to-content"></a>
		<?php } elseif (sg_get_tpl() == 'page|home') { ?>
			<div class="main-ctrl-container ef-breadcrumbs"></div>
		<?php } else { ?>
			<div class="main-ctrl-container ef-breadcrumbs">
				<div class="ef-full-inner">
					<div class="ef-row">
						<div class="ef-col ef-gu6">
							<?php
								if (sg_get_tpl() == 'our-team|default') {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/profile.png') . '</span>' . get_the_title() . '</p>';
								} elseif (sg_get_tpl() == 'extra|default') {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/extras.png') . '</span>' . get_the_title() . '</p>';
								} elseif (is_attachment()) {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/attachment.png') . '</span>' . get_the_title() . '</p>';
								} elseif (is_archive()) {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/archive.png') . '</span>' . __('Archive', SG_TDN) . '</p>';
								} elseif (is_search()) {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/search.png') . '</span>' . __('Search Results', SG_TDN) . '</p>';
								} elseif (is_404()) {
									echo '<p><span class="ef-ti">' . SG_HTML::image(get_template_directory_uri() . '/images/content/pages/search.png') . '</span>' . __('File Not Found', SG_TDN) . '</p>';
								} else {
									_sg('HandF')->eHeaderTitle(get_the_title());
								}
							?>
						</div>
						<div class="ef-col ef-gu6">
							<?php sg_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php if (sg_get_tpl() == 'page|home' AND _sg('Slider')->getSliderType() == 'full' AND _sg('Slider')->getSlidesCount() > 0) { ?>
		<script type="text/javascript">jQuery("#ef-header").attr("style", "height:" + jQuery(window).height() + "px !important;");</script>
		<div id="ef-content-wrap">
			<?php _sg('Theme')->eBGsh(); ?>
	<?php } ?>
	<div id="ef-content" class="ef-canvas clearfix">
		<div class="ef-full-grid gu12">