<?php
function webnus_twitterfeed ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'  				=>'di',
	'img'					=>'',
	'title'					=>'',
	'username'				=>'',
	'count' 				=>'3',
	'access_token'			=>'',
	'access_token_secret'	=>'',	
	'consumer_key'			=>'',	
	'consumer_secret'		=>'',	
	'mirror'				=>'',	
	'follow_text'			=>''	
	), $atts));

	ob_start();
	
	if(is_numeric($img)){
		$img = wp_get_attachment_url( $img );
	}

	$type = ( $type == 'di' ) ? 'jasmine' : 'violet' ;

	?>

		<div class="w-twitterfeed-<?php echo $type.$mirror; ?>">

		    <figure class="tw-fig">
				<img src="<?php echo $img; ?>" alt="Twitter Image">
				<figcaption class="tw-cap">
					<h3><?php echo $title; ?></h3>
					<h4><a target="_blank" href="https://twitter.com/<?php echo $username; ?>">@<?php echo $username; ?></a></h4>
				</figcaption>
			</figure>

			<?php
			require_once get_template_directory() . '/inc/twitter/TwitterAPIExchange.php';
			
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

						// Formatting Twitter’s Date/Time
						$items['created_at'] = date("l M j \- g:ia",strtotime($items['created_at']));

				        echo '<li class="tw-item">' . $items['text'] . '</li>';
				        echo '<li class="tw-timestamp">' . $items['created_at'] . '</li>';
				    }
				echo '</ul>';
			} ?>
			
			<a target="_blank" href="https://twitter.com/intent/user?screen_name=<?php echo $username; ?>" class="follow-text w-button"><?php echo $follow_text ?></a>


		</div><?php


$out = ob_get_contents();
ob_end_clean();
$out = str_replace('<p></p>','',$out);
	
	return $out;

}
add_shortcode('twitterfeed','webnus_twitterfeed');

?>