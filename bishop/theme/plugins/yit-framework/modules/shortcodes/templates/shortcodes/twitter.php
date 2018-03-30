<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for print a list of last tweets
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

$show_time = ( isset($time) && $time == 'yes' ) ? 'true' : 'false';

if( function_exists( 'yit_get_option' ) ){
    $username = ( isset($instance['username']) && $instance['username'] != '' ) ? $instance['username'] : yit_get_option('twitter-username');
    $access_token = ( isset($access_token) && $access_token != '' ) ? $access_token : yit_get_option('twitter-access-token');
    $access_token_secret = ( isset($access_token_secret) && $access_token_secret != '' ) ? $access_token_secret : yit_get_option('twitter-access-token-secret');
    $consumer_key = ( isset($consumer_key) && $consumer_key != '' ) ? $consumer_key : yit_get_option('twitter-consumer-key');
    $consumer_secret = ( isset($consumer_secret) && $consumer_secret != '' ) ? $consumer_secret : yit_get_option('twitter-consumer-secret');
}

$twitter_data = yit_get_tweets( $access_token, $access_token_secret, $consumer_key, $consumer_secret, $items);
$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
if ( !isset($twitter_data->errors) ) : ?>

    <div class="<?php echo esc_attr( $class.$animate.$vc_css ); ?>" <?php echo $animate_data ?> >
        <?php echo '<ul class="tweets-widget">';
        $i = 1;
        foreach ($twitter_data as $tweet){
            if (!empty($tweet)) {

                $text = $tweet->text;

                $text_in_tooltip = str_replace('"', '', $text); // replace " to avoid conflicts with title="" opening tags
                $id = $tweet->id;
                $time =yit_get_date_diff($tweet->created_at); //strftime('%d/%m/%Y %H:%M:%S', strtotime($tweet->created_at));

                $username = $tweet->user->name;
            }
            echo '<li class="tweet_' . $i . '"><div class="icon-container"><i class="fa fa-twitter"></i></div><div class="text-container"><p><span class="text">' . $text . '</span>&nbsp;';
            if ( $show_time == 'true' ){

                echo '<span class="meta">'.$time.'</span>';
            }

            echo '</p></div><div class="clear"></div></li>';

            ?>
            <?php $i++;
        }
        echo '</ul>' ?>
    </div>
<?php endif ?>

<?php
wp_enqueue_script( 'shortcode_twitter', YIT_Shortcodes()->plugin_assets_url . '/js/twitter-text.js', array( 'jquery' ), '', true );
wp_enqueue_script( 'yit_shortcode', YIT_Shortcodes()->plugin_assets_url . '/js/twitter.min.js', array( 'jquery', 'shortcode_twitter' ), '', true );
?>