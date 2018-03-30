<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php wp_enqueue_script('tmm_widget_twitterFetcher', TMM_THEME_URI . '/js/widgets/min/twitterFetcher.min.js'); ?>

<div class="widget widget_latest_tweets">

	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php echo esc_html($instance['title']) ?></h3>
	<?php endif; ?>

		<?php
			$title = $instance['title'];
			$limit = $instance['postcount']; if (!$limit) $limit = 5;
			$twitter_id =  $instance['twitter_id'];
			$hash = md5(rand(1, 999));
		?>

		<script type="text/javascript">
			jQuery(function() {
				var config = {
					"id": '<?php echo TMM::get_option("twitter_widget_id"); ?>',
					"domId": 'tweets_<?php echo esc_js($hash); ?>',
					"maxTweets": <?php echo (int) $limit; ?>,
					"enableLinks": true,
					"showTime": true,
					"showUser": false,
					"showRetweet": false,
					"showInteraction": false
				};
				twitterFetcher.fetch(config);
			});
		</script>

		<div class="tweets-container" id="tweets_<?php echo $hash; ?>"></div>

</div><!--/ .widget-->

