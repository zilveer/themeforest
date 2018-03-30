<?php
return array(
	"title" => __("Twitter", "theme_admin"),
	"shortcode" => 'twitter',
	"type" => 'self-closing',
	"options" => array(
		array(
			"name" => __("Username",'theme_admin'),
			"desc" => __("Put your twitter name into this field. &nbsp;Multiuse is no longer possible due to the changes in the twitter api in 2013",'theme_admin'),
			"id" => "username",
			"default" => "",
			"type" => "text"
		),
		array(
			"name" => __("Tweet Count to Display",'theme_admin'),
			"desc" => __("Use this setting to determine the number of tweets to show in the widget. &nbsp;The count can vary from 1 to 20, with a default setting of 4 tweets showing.",'theme_admin'),
			"id" => "count",
			"default" => '4',
			"min" => 0,
			"max" => 20,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Avatar Size (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Use this setting to determine the size of the square avatar. &nbsp;The thumbnail can vary up to 48 x 48 in size.",'theme_admin'),
			"id" => "avatarSize",
			"default" => '0',
			"min" => 0,
			"max" => 48,
			"step" => "1",
			"type" => "range"
		),
		array(
			"name" => __("Query (Optional)&#x200E;",'theme_admin'),
			"desc" => __("Check out <a href='https://dev.twitter.com/docs/using-search' target='_blank'>Twitter's Search API</a>, if interested in customizing the twitter feed.", 'theme_admin'),
			"id" => "query",
			"default" => '',
			"type" => "textarea"
		),
	),
);
