<?php
if (empty($view_params['url'])) return false;

//delete_post_meta(get_the_ID() , '_blog_post_tweet');


if (!get_post_meta(get_the_ID() , '_blog_post_tweet')) {
    
    global $mk_options;
    $consumer_key = $mk_options['twitter_consumer_key'];
    $consumer_secret = $mk_options['twitter_consumer_secret'];
    $access_token = $mk_options['twitter_access_token'];
    $access_token_secret = $mk_options['twitter_access_token_secret'];
    
    if (!$consumer_key && !$consumer_secret && !$access_token && !$access_token_secret && !$view_params['url']) return false;
    
    $id = uniqid();
    
    $token = get_option('mk_twitter_token_' . get_the_ID());
    
    delete_option('mk_twitter_token_' . get_the_ID());
    
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
            update_option('mk_twitter_token_' . get_the_ID(), $keys->access_token);
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

    
    $twitterId = explode('/', $view_params['url']);
    add_filter('https_ssl_verify', '__return_false');
    $api_url = 'https://api.twitter.com/1.1/statuses/lookup.json?id=' . $twitterId[5];
    $response = wp_remote_get($api_url, $args);
    
    $twitter = json_decode(wp_remote_retrieve_body($response) , true);
    

    update_post_meta(get_the_ID() , '_blog_post_tweet', $twitter);
}

$tweet = get_post_meta(get_the_ID() , '_blog_post_tweet', true);
?>

<div class="blog-twitter-content">
    <?php echo $tweet[0]['text']; ?>
    <footer>
        <span><?php echo $tweet[0]['user']['name']; ?></span>
        <a href="https://twitter.com/<?php echo $tweet[0]['user']['screen_name']; ?>" target="_blank">
            @<?php echo $tweet[0]['user']['screen_name']; ?>
        </a>
    </footer>
</div>