
<?php $imageUrl = '';
$width = 600;
$height = 1000;
$args = array(
	'post_type' => 'attachment',
	'numberposts' => -1,
	'post_status' => null,
	'post_parent' => get_the_ID()
);

$attachments = get_posts($args);
?>


<ul class="bxslider">
<?php if ($attachments): ?>
	<?php foreach ($attachments as $attach): ?>
		<?php $image = wp_get_attachment_image_src($attach->ID, 'full'); ?>
		<?php $imageUrl = $image[0]; ?>
		<li><a href="<?php echo $imageUrl; ?>" data-lightbox="image-<?php echo get_the_ID()?>"><img src="<?php echo $imageUrl ?>" /></a></li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>


<script>
	  jQuery('.bxslider').bxSlider({
		  mode: 'fade',
				infiniteLoop: true,
				hideControlOnEnd: false,
				speed: 800,
				easing: null,
				slideMargin: 0,
				startSlide: 0,
				randomStart: false,
				captions: false,
				ticker: false,
				tickerHover: false,
				adaptiveHeight: true,
				adaptiveHeightSpeed: 500,
				video: false,
				useCSS: true,
				preloadImages: 'visible',
				responsive: true,

				// TOUCH
				touchEnabled: true,
				swipeThreshold: 50,
				oneToOneTouch: true,
				preventDefaultSwipeX: true,
				preventDefaultSwipeY: false,

				// PAGER
				pager: true,
				pagerType: 'full',
				pagerShortSeparator: ' / ',
				pagerSelector: null,
				buildPager: null,
				pagerCustom: null,

				// CONTROLS
				controls: true,
				nextText: 'Next',
				prevText: 'Prev',
				nextSelector: null,
				prevSelector: null,
				autoControls: false,
				startText: 'Start',
				stopText: 'Stop',
				autoControlsCombine: false,
				autoControlsSelector: null,

				// AUTO
				auto: false,
				pause: 4000,
				autoStart: true,
				autoDirection: 'next',
				autoHover: false,
				autoDelay: 0
	  });
</script>