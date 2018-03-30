<?php
/**
 * Twitter PHP Script
 * This script gets a user's twitter timeline and returns it as a multidimension array
 * each array containing 'tweet, date and link' respectively.
 *
 * LICENSE: This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * http://www.gnu.org/licenses/
 *
 * @author Opeyemi Obembe <ray@devedgelabs.com>
 * @copyright Copyright (c) 2010, devEdgeLabs.
 */

class Twitter
{
	var $count;
	var $feedUrl;
	var $username;
	
	//@params: twitter username, number of needed updates (20 max)
	function Twitter($username, $count = 20)
	{
		$this->username = $username;
		$this->feedUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username;
		$this->count = $count > 20 ? 20 : $count;
		$this->consumer_key = '';
		$this->consumer_secret = '';
		$this->access_token = '';
		$this->access_token_secret = '';
	}
	
	function since($date)
	{
		$timestamp = strtotime($date);
		$seconds = time() - $timestamp;
		
		$units = array(
			'second' => 1,
			'minute' => 60,
			'hour' 	 => 3600,
			'day'	 => 86400,
			'month'  => 2629743,
			'year'   => 31556926
		);
		
		foreach($units as $k => $v)
		{
			if($seconds >= $v)
			{
				$results = floor($seconds/$v);
				if($k == 'day' | $k == 'month' | $k == 'year')
					$timeago = date('D, d M, Y h:ia', $timestamp);
				else
					$timeago = ($results >= 2) ? 'about '.$results.' '.$k.'s ago' : 'about '.$results.' '.$k.' ago';
			}
		}
		
		return $timeago;
	}
	
	// Returns a multidimentional array, each containg 'tweet, date and link' respectively
	function get($count = 20)
	{
		$username = $this->username;
	
		// Append the count
		$url = $this->feedUrl;
		$url .= '&count='.$count;

		$tweets_cache_path = get_template_directory().'/cache/twitter_'.$username.'_'.$count.'.cache';
		
		if(file_exists($tweets_cache_path))
		{
			$tweets_cache_timer = intval((time()-filemtime($tweets_cache_path))/60);
		}
		else
		{
			$tweets_cache_timer = 0;
		}

		
		if(!file_exists($tweets_cache_path) OR $tweets_cache_timer > 15)
		{
			$connection = getConnectionWithAccessToken($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
			$tweets = $connection->get($url);
			
			if(!empty($tweets->errors)){
				if($tweets->errors[0]->message == 'Invalid or expired token'){
					echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!';
				}else{
					echo '<strong>'.$tweets->errors[0]->message.'</strong>' ;
				}
				return;
			}

			$tweets_data = array();
			
			foreach($tweets as $tweet)
			{
				$tweet_text = auto_link_twitter($tweet->text);
				$tweets_data[]['text'] = $tweet_text;
			}
				
			if(file_exists($tweets_cache_path))
			{
				unlink($tweets_cache_path);
			}
			
			$myFile = $tweets_cache_path;
			$fh = fopen($myFile, 'w') or die("can't open file");
			$stringData = serialize($tweets_data);
			fwrite($fh, $stringData);
			fclose($fh);
		}
		else
		{
			$file = file_get_contents($tweets_cache_path, true);
					
			if(!empty($file))
			{
				$tweets = unserialize($file);
				
				foreach($tweets as $tweet)
				{
					$tweets_data[]['text'] = $tweet['text'];
				}			
			}
		}
		
		return $tweets_data;
	}
}
?>