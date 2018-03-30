<?php echo mk_get_shortcode_view('mk_news', 'components/featured-image', true, ['image_width' => $view_params['image_width'], 'image_height' => $view_params['image_height']]); ?>
<?php echo mk_get_shortcode_view('mk_news', 'components/date', true); ?>

<div class="news-meta-wrapper">
	<?php echo mk_get_shortcode_view('mk_news', 'components/categories', true); ?>
	<div class="clearboth"></div>
	<?php echo mk_get_shortcode_view('mk_news', 'components/title', true); ?>
</div>
