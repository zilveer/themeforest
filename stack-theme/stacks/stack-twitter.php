<div class="stack stack-twitter" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="twitter-box">
		<div class="row">
			<div class="span9">
				<?php if( theme_options('advance', 'twitter_consumer_key') &&
				theme_options('advance', 'twitter_consumer_secret') &&
				theme_options('advance', 'twitter_user_token') &&
				theme_options('advance', 'twitter_user_secret') ): ?>
					<span class="tweet" data-username="<?php echo $stack['stack_title']; ?>" data-modpath="<?php echo admin_url( 'admin-ajax.php' ); ?>"></span>
				<?php else: ?>
				<ul class="tweet_list"><li>Please set Twitter App info at "WP-Admin > Appearance > Theme Options > Advance > Twitter App"</li></ul>
				<?php endif; ?>
			</div>
			<div class="span3">
				<a href="https://twitter.com/<?php echo $stack['stack_title']; ?>" class="twitter-follow-button" data-show-count="false" data-lang="en" data-align="right" data-width="200px">Follow @<?php echo $stack['stack_title']; ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
	</div>
</div>
</div><!-- stack-twitter -->