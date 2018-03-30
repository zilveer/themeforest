<?php
require_once('UltimateOAuth/UltimateOAuth.php');

class TwitterFeed {
	private $connection;
	
	public function __construct($config) {
		$this->connection = new UltimateOAuth($config['consumerKey'], $config['consumerSecret'], $config['accessToken'], $config['accessTokenSecret']);
	}

	public function getList($parameters){
		$defaults = array(
			'list_id' => '',           // * The numerical id of the list.
			'slug'    => '',           // * You can identify a list by its slug instead of its numerical id.
			'owner_screen_name' => '', // The screen name of the user who owns the list being requested by a slug.
			'count'   => '',           // Specifies the number of results to retrieve per "page."
			'page'    => '',
			'include_rts' => '',       // When set to either 1, the list timeline will contain native retweets (if they exist) in addition to the standard stream of tweets.
			'include_entities' => '1', // The entities node will be omitted when set to false.
		);
		$parameters = array_merge($defaults, $parameters);
		$tweets = $this->get('lists/statuses.json', $parameters);
		echo json_encode($tweets);
	}

	public function getFavorites($parameters){
		$defaults = array(
			'screen_name'    => '',    // * The screen name of the user for whom to return results for.
			'count'   => '',           // Specifies the number of results to retrieve per "page."
			'page'    => '',
			'include_entities' => '1', // The entities node will be omitted when set to false.
		);
		$parameters = array_merge($defaults, $parameters);
		$tweets = $this->get('favorites/list.json', $parameters);
		echo json_encode($tweets);
	}

	public function getUserTimeLine($parameters){
		$defaults = array(
			'screen_name'    => '',    // * The screen name of the user for whom to return results for.
			'count'   => '',           // Specifies the number of results to retrieve per "page."
			'page'    => '',
			'include_rts' => '',       // When set to either 1, the list timeline will contain native retweets (if they exist) in addition to the standard stream of tweets.
			'include_entities' => '1', // The entities node will be omitted when set to false.
		);
		$parameters = array_merge($defaults, $parameters);
		$tweets = $this->get('statuses/user_timeline.json', $parameters);
		echo json_encode($tweets);
	}

	public function getSearch($parameters){
		$defaults = array(
			'count'   => '',           // Specifies the number of results to retrieve per "page."
			'q'       => '',           // * A UTF-8, URL-encoded search query of 1,000 characters maximum, including operators.
			
			'include_entities' => '1', // The entities node will be omitted when set to false.
		);
		$parameters = array_merge($defaults, $parameters);
		$tweets = $this->get('search/tweets.json', $parameters);

		if(isset($tweets->statuses)){
			$tweets = $tweets->statuses;
		}
		echo json_encode($tweets);
	}

	public function get($url, $parameters = array()){
		return $this->connection->get($url, $parameters);
	}
}
