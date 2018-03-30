<?php
$show_time = ( isset($time) && $time == 'yes' ) ? 'true' : 'false';

$username = ( isset($instance['username']) && $instance['username'] != '' ) ? $instance['username'] : yit_get_option('twitter-username');
$access_token = ( isset($access_token) && $access_token != '' ) ? $access_token : yit_get_option('twitter-access-token');
$access_token_secret = ( isset($access_token_secret) && $access_token_secret != '' ) ? $access_token_secret : yit_get_option('twitter-access-token-secret');
$consumer_key = ( isset($consumer_key) && $consumer_key != '' ) ? $consumer_key : yit_get_option('twitter-consumer-key');
$consumer_secret = ( isset($consumer_secret) && $consumer_secret != '' ) ? $consumer_secret : yit_get_option('twitter-consumer-secret');

$twitter_data = yit_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $items);

if ( !isset($twitter_data->errors) ) : ?>

    <div class="<?php echo $class; ?>">
        <?php echo '<ul class="tweets-widget">';
        $i = 1;
        foreach ($twitter_data as $tweet){
            if (!empty($tweet)) {
                $text = $tweet->text;
                $text_in_tooltip = str_replace('"', '', $text); // replace " to avoid conflicts with title="" opening tags
                $id = $tweet->id;
                $time = strftime('%d/%m/%Y %H:%M:%S', strtotime($tweet->created_at));
                $username = $tweet->user->name;
            }
            echo '<li class="tweet_' . $i . '"><p><span class="text">' . $text . '</span><br />';
            if ( $show_time == 'true' ) echo '<span class="meta">' . $time . '</span>';
            echo '</p></li>';

            ?>
            <script type="text/javascript">
                jQuery(function($){
                    var test = twttr.txt.autoLink("<?php echo $text ?>");
                    $('ul li.tweet_<?php echo $i ?> span.text').replaceWith(test);
                });
            </script>
            <?php $i++;
        }
        echo '</ul>' ?>
    </div>
<?php endif ?>