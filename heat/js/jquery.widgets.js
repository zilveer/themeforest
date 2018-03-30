jQuery(document).ready(function($){
	
	// Twitter
	var $twitter = jQuery('#tweets-wrapper');
		
	if( $twitter.length ) {
	
		$(function() {
		
			$twitter.jTweetsAnywhere({
				username: $('#twitter-username').text(),
				count: $('#twitter-number').text(),
				showTweetFeed: {
					showProfileImages: false,
					showUserScreenNames: false,
					showUserFullNames: false,
					showTwitterBird: false,
					showInReplyTo: false,
					showActionReply: true,
					showActionRetweet: false,
					showActionFavorite: true,
					includeRetweets: false
				},
				// Override defaultTweetDecorator to avoid class jta-clear.
				tweetDecorator: function(tweet, options) {
					var html = '';
		
					if (options._tweetFeedConfig.showProfileImages)
					{
						html += options.tweetProfileImageDecorator(tweet, options);
					}
		
					if (options.tweetBodyDecorator)
					{
						html += options.tweetBodyDecorator(tweet, options);
					}
		
					return '<li class="jta-tweet-list-item">' + html + '</li>';
				}
			});
		
		});
	
	}

});
