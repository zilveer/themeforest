<?php
	
	$designare_general_options= array( array(
		"name" => "Twitter and Social Icons",
		"type" => "title",
		"img" => DESIGNARE_IMAGES_URL."icon_general.png"
	),
	
	array(
		"type" => "open",
		"subtitles"=>array(array("id"=>"social", "name"=>"Social Icons"), array("id"=>"twitter", "name" => "Twitter"))
	),
	
	
	
	/* ------------------------------------------------------------------------*
	 * Top Panel
	 * ------------------------------------------------------------------------*/
	
	array(
		"type" => "subtitle",
		"id"=>'social'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Social Icons</h3>"
	),
	
	array(
		"name" => "Facebook Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-facebook",
		"type" => "text",
		"desc" => "Enter full url   ex: http://facebook.com/DesignareThemes",
		"std" => ""
	),
	array(
		"name" => "Twitter Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Tumblr Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-tumblr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Forrst Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-forrst",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Stumble Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-stumble",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Flickr Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-flickr",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "LinkedIn Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-linkedin",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Delicious Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-delicious",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Skype Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-skype",
		"type" => "text",
		"desc" => "For a directly call to your Skype, add the following code.  skype:username?call",
		"std" => ""
	),
	array(
		"name" => "Digg Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-digg",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Google Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-google",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Vimeo Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-vimeo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Picasa Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-picasa",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "DeviantArt Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-deviantart",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Behance Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-behance",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Instagram Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-instagram",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "MySpace Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-myspace",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Blogger Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-blogger",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Wordpress Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-wordpress",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "GrooveShark Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-grooveshark",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Youtube Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-youtube",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Reddit Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-reddit",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "RSS Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-rss",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "SoundCloud Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-soundcloud",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Pinterest Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-pinterest",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Dribbble Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-dribbble",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Yelp Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-yelp",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Foursquare Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-foursquare",
		"type" => "text",
		"std" => ""
	),
	
	array(
		"name" => "Xing Icon",
		"id" => DESIGNARE_SHORTNAME."_icon-xing",
		"type" => "text",
		"std" => ""
	),

	array(
		"type" => "close"
	),
	
	/* twitter options */ 
	array(
		"type" => "subtitle",
		"id"=>'twitter'
	),
	
	array(
		"type" => "documentation",
		"text" => "<h3>Twitter Scroller</h3>"
	),
	
	array(
		"name" => "Twitter Username",
		"id" => DESIGNARE_SHORTNAME."_twitter_username",
		"type" => "text",
		"std" => ''
	),
	
	array(
		"name" => "Twitter App Consumer Key",
		"id" => "twitter_consumer_key",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Consumer Secret",
		"id" => "twitter_consumer_secret",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Access Token",
		"id" => "twitter_user_token",
		"type" => "text"
	),
	
	array(
		"name" => "Twitter App Access Token Secret",
		"id" => "twitter_user_secret",
		"type" => "text"
	),
	
	array(
		"name" => "Number Tweets",
		"id" => DESIGNARE_SHORTNAME."_twitter_number_tweets",
		"type" => "text",
		"std" => '5'
	),
	
	array( "type" => "close" ),
	
		
	/*close array*/
	
	array(
		"type" => "close"
	));
	
	designare_add_options($designare_general_options);
	
?>