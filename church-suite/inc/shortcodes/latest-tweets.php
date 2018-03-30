<?php
function webnus_twitterfeed ($atts, $content = null) {
	extract(shortcode_atts(array(
	'title'					=>'',
	'username'				=>'',
	'count' 				=>'1',
	'access_token'			=>'',
	'access_token_secret'	=>'',	
	'consumer_key'			=>'',	
	'consumer_secret'		=>'',	
	), $atts));
	ob_start();
?>
		<div class="latest-tweets">
			<div class="ltweets-top">
				<i class="fa-twitter"></i>
				<?php echo($title)? '<h3>'.$title.'</h3>':''; ?>
			</div>
			<?php
			require_once get_template_directory() . '/inc/helpers/twitter-api.php';
			/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
			$settings = array(
				'oauth_access_token' => $access_token,
				'oauth_access_token_secret' => $access_token_secret,
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret
			);
			$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
			$requestMethod = "GET";
			$user = $username;
			$getfield = "?screen_name=$user&count=$count";
			$twitter = new TwitterAPIExchange($settings);
			$string = json_decode($twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest(),$assoc = TRUE);
			if(isset($string["errors"][0]["message"])) {
				if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string["errors"][0]["message"]."</em></p>";}
			} else {
				echo '<ul class="tweets">';
					foreach($string as $items) {
						$items['text'] = preg_replace("/([\w]+\:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/", "<a target=\"_blank\" href=\"$1\">$1</a>", $items['text']);
						// Convert hashtags to twitter searches in <a> links
						$items['text'] = preg_replace("/#([A-Za-z0-9\/\.]*)/", "<a target=\"_new\" href=\"http://twitter.com/search?q=$1\">#$1</a>", $items['text']);
						// Convert attags to twitter profiles in <a> links
						$items['text'] = preg_replace("/@([A-Za-z0-9\/\.]*)/", "<a href=\"http://www.twitter.com/$1\">@$1</a>", $items['text']);
						// Formatting Twitter\'s Date/Time
						$items['created_at'] = date("l M j \- g:ia",strtotime($items['created_at']));
				        echo '<li class="tw-item">' . $items['text'] . '</li>';
				        echo '<li class="tw-timestamp"><i class="fa-clock-o"></i> ' . $items['created_at'] . '</li>';
				    }
				echo '</ul>';
			} ?>
			<div class="ltweets-link-wrapper"><a class="ltweets-link" target="_blank" href="https://twitter.com/<?php echo $username; ?>">@<?php echo $username; ?></a></div>
	</div><?php
	$out = ob_get_contents();
	ob_end_clean();
	$out = str_replace('<p></p>','',$out);
	return $out;
}
add_shortcode('twitterfeed','webnus_twitterfeed');
?>