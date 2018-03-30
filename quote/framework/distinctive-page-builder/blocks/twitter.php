<?php

class Twitter_Block extends AQ_Block {
		
	/* Create Block Instance */
	function __construct() {
		$block_options = array(
			'name' => 'Twitter',
			'size' => 'span12',
			'block_description' => 'Use to add a Tweet<br />to the page.'
		);		
		/* Create Block */
		parent::__construct('twitter_block', $block_options);
	}
	
	/* Create Form */
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'blocktitle' => '',
			'button' => 'Follow me on Twitter!',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		if (is_plugin_active('oauth-twitter-feed-for-developers/twitter-feed-for-developers.php')) { ?>

		<p class="description">
			<label for="<?php echo $this->get_field_id('blocktitle') ?>">
				Title
				<?php echo aq_field_input('blocktitle', $block_id, $blocktitle, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Twitter username, e.g: envato
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('button') ?>">
				The follow button text
				<?php echo aq_field_input('button', $block_id, $button, $size = 'full') ?>
			</label>
		</p>
		<?php } else {
			echo 'You Need To Install oAuth Twitter Plugin to use this block';
		}
	}
	
	/* Create Front End Output */
	function block($instance) {
		extract($instance);

		$config['key'] = get_option('tdf_consumer_key');
		$config['secret'] = get_option('tdf_consumer_secret');
		$config['token'] = get_option('tdf_access_token');
		$config['token_secret'] = get_option('tdf_access_token_secret');
		if(!empty($config['key']) && !empty($config['secret']) && !empty($config['token']) && !empty($config['token_secret'])) {

			$number_of_tweets = 5;
			$options = array("trim_user" => false );
			$tweets = getTweets($title, $number_of_tweets, $options); 

			$img = array();
			foreach ($tweets as $value) {
				foreach ($value['user'] as $key) {
					$img[] = $value['user']['profile_image_url'];
				}
			}

			?>

			<div class="centered">

			<img src="<?php $imgsrc = str_replace('_normal', '', $img[0]); echo $imgsrc; ?>" class="tweet-avatar">

				<h3><?php echo $blocktitle; ?></h3>
				<div id="tweet-slider" class="owl-carousel">
				<?php foreach($tweets as $tweet) :	
				$the_tweet = $tweet['text'];		
			    if( $the_tweet ) :				    	
			        if(is_array($tweet['entities']['user_mentions'])){
			            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
			                $the_tweet = preg_replace(
			                    '/@'.$user_mention['screen_name'].'/i',
			                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" class="jta-tweet-a jta-tweet-link" target="_blank">@'.$user_mention['screen_name'].'</a>',
			                    $the_tweet);
			            }
			        }		
			        if(is_array($tweet['entities']['hashtags'])){
			            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
			                $the_tweet = preg_replace(
			                    '/#'.$hashtag['text'].'/i',
			                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" class="jta-tweet-a jta-tweet-link" target="_blank">#'.$hashtag['text'].'</a>',
			                    $the_tweet);
			            }
			        }
			        if(is_array($tweet['entities']['urls'])){
			            foreach($tweet['entities']['urls'] as $key => $link){
			                $the_tweet = preg_replace(
			                    '`'.$link['url'].'`',
			                    '<a href="'.$link['url'].'" class="jta-tweet-a jta-tweet-link" target="_blank">'.$link['url'].'</a>',
			                    $the_tweet);
			            }
			        }		        
			    endif; ?>

					<div class="col-md-8 col-md-offset-2">
						<span class="tweet_time">
							<a href="https://twitter.com/<?php echo $title; ?>/status/<?php echo$tweet['id_str']; ?>" target="_blank"><?php echo date('h:i A M d',strtotime($tweet['created_at'] . '+ 1 hour')); ?></a>
						</span>
						<span class="tweet_text">
							<?php echo $the_tweet; ?>
						</span>				
					</div>

			    <?php endforeach; ?>
			</div>
			</div>
		
	<?php } else { echo 'Please setup the twitter API'; }

	}
	
}