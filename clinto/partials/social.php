<?php if ( function_exists('ot_get_option') ) { ?>
	<ul class="channels">
		<li class="rss"><a title="Subscribe to our RSS" href="<?php echo ot_get_option( 'feed_url', '/feed' ); ?>">RSS</a></li>
		<li class="facebook"><a title="Follow us with Facebook" href="<?php echo ot_get_option( 'facebook_url', '#' ); ?>">Facebook</a></li>
		<li class="twitter"><a title="Follow us with Twitter" href="<?php echo ot_get_option( 'twitter_url', '#' ); ?>">Twitter</a></li>
		<li class="newsletter"><a title="Subscribe to our Newsletter" href="<?php echo ot_get_option( 'mailchimp_link_url', '#' ); ?>">Newsletter</a></li>
	</ul>
<?php } ?>
