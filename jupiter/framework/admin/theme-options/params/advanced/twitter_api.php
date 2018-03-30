<?php
$advanced_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_twitter_api",
    "name" => __("Advanced / Twitter API ", "mk_framework") ,
    "desc" => __('<ol style="list-style-type:decimal !important;">
  <li>Go to "<a target="_blank" href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a>," login with your twitter account and click "Create a new application".</li>
  <li>Fill out the required fields, accept the rules of the road, and then click on the "Create your Twitter application" button. You will not need a callback URL for this app, so feel free to leave it blank.</li>
  <li>Once the app has been created, click the "Create my access token" button.</li>
  <li>You are done! You will need the following data later on:</ol>', "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Consumer Key", 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "twitter_consumer_key",
            "default" => "",
            "type" => "text"
        ) ,
        array(
            "name" => __("Consumer Secret", 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "twitter_consumer_secret",
            "default" => "",
            "type" => "text"
        ) ,
        array(
            "name" => __("Access Token", 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "twitter_access_token",
            "default" => "",
            "type" => "text"
        ) ,
        array(
            "name" => __("Access Token Secret", 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "twitter_access_token_secret",
            "default" => "",
            "type" => "text"
        ) ,
    ) ,
);
