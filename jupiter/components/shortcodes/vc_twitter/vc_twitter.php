<?php

$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');

$html = file_get_contents($path . '/template.php');
$html = phpQuery::newDocument($html);
$shortcode_id = Mk_Static_Files::shortcode_id();

$container = pq('.mk-twitter-shortcode');
$container->addClass($el_class);
$container->attr('id', 'mk-twitter-feed-'.$shortcode_id);
$tweet_item = $container->find('.mk-tweet-list li')->remove();
$heading = pq('.mk-fancy-title');
$twitter_icon = Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-twitter');


if(!empty($text_color)) {  
    Mk_Static_Files::addCSS('
        #mk-twitter-feed-'.$shortcode_id.'{
            color: '.$text_color.' !important;
        }
    ', $shortcode_id);
}
if(!empty($link_color)) {  
    Mk_Static_Files::addCSS('
        #mk-twitter-feed-'.$shortcode_id.' a{
            color: '.$link_color.' !important;
        }
    ', $shortcode_id);
}


if (empty($title)) {
    $heading->remove();
} 
else {
    $heading->find('span')->html($title);
}

if (!$twitter_name || !$consumer_key || !$consumer_secret || !$access_token || !$access_token_secret || !$tweets_count) return false;

$transName = 'mk_jupiter_tweets_' . $item_id;

if (false === get_transient($transName)) {
    
    $token = get_option('mk_twitter_token_' . $item_id);
    
    delete_option('mk_twitter_token_' . $item_id);
    
    if (!$token) {
        
        $credentials = $consumer_key . ':' . $consumer_secret;
        $toSend = base64_encode($credentials);
        
        $args = array(
            'method' => 'POST',
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(
                'Authorization' => 'Basic ' . $toSend,
                'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
            ) ,
            'body' => array(
                'grant_type' => 'client_credentials'
            )
        );
        
        add_filter('https_ssl_verify', '__return_false');
        $response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);
        
        $keys = json_decode(wp_remote_retrieve_body($response));
        
        if ($keys) {
            update_option('mk_twitter_token_' . $item_id, $keys->access_token);
            $token = $keys->access_token;
        }
    }
    $args = array(
        'httpversion' => '1.1',
        'blocking' => true,
        'headers' => array(
            'Authorization' => "Bearer $token"
        )
    );
    
    add_filter('https_ssl_verify', '__return_false');
    $api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $twitter_name . '&count=' . $tweets_count;
    $response = wp_remote_get($api_url, $args);
    
    set_transient($transName, wp_remote_retrieve_body($response) , HOUR_IN_SECONDS);
}

@$twitter = json_decode(get_transient($transName) , true);

if ($twitter && is_array($twitter)) {
    
    foreach ($twitter as $tweet):
        $each_item = $tweet_item->clone();
        
        $latestTweet = $tweet['text'];
        $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
        $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);

        
        $each_item->find('.tweet-icon')->html($twitter_icon);
        
        $each_item->find('.tweet-text')->html($latestTweet);
        
        $each_item->find('.tweet-time')->attr('href', 'http://twitter.com/' . $tweet['user']['screen_name'] . '/statuses/' . $tweet['id_str'])->html(mk_ago(strtotime($tweet['created_at'])));
        
        $each_item->appendTo($container->find('.mk-tweet-list'));
    endforeach;
}

print $html;
