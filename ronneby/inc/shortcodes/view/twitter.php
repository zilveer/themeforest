<?php $twitter_uniqid = uniqid('twitter_row'); ?>
<div class="twitter-row">

	<?php
	// Get the tweets from Twitter.
	require_once locate_template('/inc/lib/twitteroauth.php');
	$twitter = new DFDTwitter();
	$tweets = $twitter->getTweets();
	
	?>
	<?php if (!$twitter->hasError()): ?>
	<div class="twitter-slider">
		<div id="<?php echo esc_attr($twitter_uniqid); ?>">
			<?php if (!empty($tweets)): ?>
				<?php foreach ($tweets as $t) : ?>
					<div class="tweet-item">
						<div class="columns ten push-one">
							<div class="twitter-row-icon-container">
								<i class="soc_icon-twitter-3"></i>
							</div>
							<div class="tweet">
								<?php echo $t['text']; ?>
								<div class="date">
									<?php echo human_time_diff($t['time'], current_time('timestamp')); ?>
									<?php _e('ago', 'dfd'); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php echo DFD_Carousel::controls(); ?>
	</div>
	<?php else: ?>
		<p class="text-bold text-center">
			<?php echo ($twitter->getError()->message); ?>
		</p>
	<?php endif; ?>
</div>

<?php if (!$twitter->hasError() && !empty($tweets)): ?>
<script type="text/javascript">
	(function($) {
		"use strict";
		$(document).ready(function() {

			$('#<?php echo esc_js($twitter_uniqid); ?>').slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				autoplay: false,
				autoplaySpeed: 2000,
			});
		});
		$('#<?php echo esc_js($twitter_uniqid); ?>').next('.slider-controls').find('.next').click(function(e) {
			$('#<?php echo esc_js($twitter_uniqid); ?>').slickNext();

			e.preventDefault();
		});

		$('#<?php echo esc_js($twitter_uniqid); ?>').next('.slider-controls').find('.prev').click(function(e) {
			$('#<?php echo esc_js($twitter_uniqid); ?>').slickPrev();

			e.preventDefault();
		});
		
	})(jQuery);

</script>
<?php endif; ?>