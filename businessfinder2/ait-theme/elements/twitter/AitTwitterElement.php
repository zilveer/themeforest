<?php


class AitTwitterElement extends AitElement
{
	public function init()
	{
		$this->title = esc_html__('Twitter', 'ait-admin');

		$this->configuration = array();
	}



	public function getRawTweets()
	{
		$result = array();
		$twitter = new TwitterOAuth($this->options['consumerKey'], $this->options['consumerSecret'], $this->options['accessToken'], $this->options['accessTokenSecret']);
		$tdata = $twitter->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$this->options['username']."&count=".$this->options['posts']);
		if(empty($tdata->errors)){
			$result = $tdata;
		}
		return $result;
	}



	public function getTweets()
	{
		$tweets = $this->getRawTweets();
		foreach($tweets as $i => $tweet){
			$timestamp = strtotime($tweet->created_at);
			$isLessThanOneDayOld = (abs(time() - $timestamp)) < 86400;
			if ($isLessThanOneDayOld) {
				$timestamp = human_time_diff($timestamp) . esc_html__(' ago', 'ait');
			} else {
				$timestamp = date_i18n(($this->options['dateFormat']), $timestamp);
			}
			$tweet->timestamp = $timestamp;

			if($this->options['escapeSpecialChars']){
				$tweet->text = htmlspecialchars($tweet->text);
			}
			if($this->options['linksClickable']){
				$tweet->text = preg_replace('`\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))`', '<a href="$0">$0</a>', $tweet->text);
				$tweet->text = preg_replace('/(@)([a-zA-Z0-9\_]+)/', '@<a href="https://twitter.com/$2">$2</a>', $tweet->text);
				$tweet->text = preg_replace('/(#)([a-zA-Z0-9\_]+)/', '#<a href="https://twitter.com/search/?q=$2">$2</a>', $tweet->text);
			}
		}
		return $tweets;
	}

}
