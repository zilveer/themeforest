<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="widget widget_latest_tweets">
	
	<?php if (!empty($instance['title'])): ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php endif; ?>
		
		<?php 
			$title = $instance['title'];
			$limit = $instance['postcount']; if (!$limit) $limit = 5;
			$twitter_id =  $instance['twitter_id'];
			$hash = md5(rand(1, 999));
		?>
		
		<script type="text/javascript">
			jQuery(function() {
				twitterFetcher.fetch('<?php echo $twitter_id; ?>', 'tweets_<?php echo $hash; ?>', <?php echo $limit; ?>, true);
			});
		</script>
		
		<div class="tweets-container" id="tweets_<?php echo $hash; ?>"></div>

</div><!--/ .widget-->

