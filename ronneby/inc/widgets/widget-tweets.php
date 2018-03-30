<?php
/*
* Latest tweets with PHP widget
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
class crum_latest_tweets extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {
        parent::__construct(
            'twitter-widget', // Base ID
            'Cr: Latest Tweets', // Name
            array('description' => __('Displays your latest Tweets', 'dfd'),) // Args
        );
    }

    //widget output
    public function widget($args, $instance) {
        extract($args);

        echo $before_widget;

        if (isset($instance['title'])) {
            $title = $instance['title'];
		} else {
			$title = false;
		}

        if ($title) {
            echo $before_title;
            echo $title;
            echo $after_title;
        }

        //check settings and die if not set
        if (empty($instance['consumerkey']) || empty($instance['consumersecret']) || empty($instance['accesstoken']) || empty($instance['accesstokensecret']) || empty($instance['cachetime']) || empty($instance['username'])) {
            echo '<strong>Please fill all widget settings!</strong>' . $after_widget;
            return;
        }
		
        //convert links to clickable format
        if (!function_exists('convert_links')) {
            function convert_links($status, $targetBlank = true, $linkMaxLen = 250)
            {

                // the target
                $target = $targetBlank ? " target=\"_blank\" " : "";

                // convert link to url
                $status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

                // convert @ to follow
                $status = preg_replace("/(@([_a-z0-9\-]+))/i", "<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>", $status);

                // convert # to search
                $status = preg_replace("/(#([_a-z0-9\-]+))/i", "<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>", $status);

                // return the status
                return $status;
            }
        }

        if (!function_exists('relative_time')) { 
            //convert dates to readable format
            function relative_time($a) {
                //get current timestampt
                $b = time();
                //get timestamp when tweet created
				if (is_integer($a)) {
					$c = $a;
				} else {
					$c = strtotime($a);
				}
                //get difference
                $d = $b - $c;
                //calculate different time values
                $minute = 60;
                $hour = $minute * 60;
                $day = $hour * 24;
                $week = $day * 7;

                if (is_numeric($d) && $d > 0) {
                    //if less then 3 seconds
                    if ($d < 3) return "right now";
                    //if less then minute
                    if ($d < $minute) return floor($d) . " seconds ago";
                    //if less then 2 minutes
                    if ($d < $minute * 2) return "about 1 minute ago";
                    //if less then hour
                    if ($d < $hour) return floor($d / $minute) . " minutes ago";
                    //if less then 2 hours
                    if ($d < $hour * 2) return "about 1 hour ago";
                    //if less then day
                    if ($d < $day) return floor($d / $hour) . " hours ago";
                    //if more then day, but less then 2 days
                    if ($d > $day && $d < $day * 2) return "yesterday";
                    //if less then year
                    if ($d < $day * 365) return floor($d / $day) . " days ago";
                    //else return more than a year
                    return "over a year ago";
                }
            }
        }

		$additional_class = $unique_id = '';
		$unique_id = uniqid('dfd-tweets-widget-').'-'.rand(0,9999);
		if (!empty($instance['tweetstoshow']) && $instance['tweetstoshow'] == 1) $additional_class = 'single-item';
		if (!empty($instance['tweetstoshow']) && $instance['tweetstoshow'] == 2) $additional_class = 'two-items';
//        $tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
		require_once locate_template('/inc/lib/twitteroauth.php');
		$twitter = new DFDTwitter();
		$tp_twitter_plugin_tweets = $twitter->getTweets();
        if (!empty($tp_twitter_plugin_tweets)) {
			$image = $tp_twitter_plugin_tweets[0]['image'];
			$screen_name = $tp_twitter_plugin_tweets[0]['name'];
			$author_info = (!empty($instance['author_info']) && $instance['author_info'] == 1) ? '' : 'hide';
			$enable_carousel = (!empty($instance['enable_carousel']) && $instance['enable_carousel'] == 1) ? 'with-carousel' : 'without-carousel';
            echo '<div class="tweets-author ' . esc_attr($author_info) .'">
                 <img src="' . $image . '" alt="" />
                 <strong>' . $screen_name . ' <span>@' . $instance['username'] . '</span></strong> '; ?>

            <a href="https://twitter.com/<?php echo $instance['username']; ?>"
               class="twitter-follow-button"
               data-show-count="false"
               data-lang="en"><?php _e('Follow me', 'dfd'); ?></a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>

            <?php echo '</div>';

			//echo '<div class="twitter-icon-wrap"><i class="soc_icon-twitter-3"></i></div>';

            print '<div id="'.esc_attr($unique_id).'" class="tweet-list '. $enable_carousel .'">';
            $fctr = '1';
            foreach ($tp_twitter_plugin_tweets as $tweet) {
                print '<div class="tweet '. esc_attr($additional_class) .'"><div class="tweet-inner">' . $tweet['text'] . '<div class="time subtitle">' . relative_time($tweet['time']) . '</div></div></div>';
                if ($fctr == $instance['tweetstoshow']) {
                    break;
                }
                $fctr++;
            }
            print '</div>';
	    
			if ($instance['read_all'] == 1) {
				echo '<div class="twitter-read-more">';
					$_link_url = 'https://twitter.com/'.$instance['username'];
					echo '<a href="'.esc_url($_link_url).'" class="subtitle" title="">'.__('Read all tweets', 'dfd').'</a>';
				echo '</div>';
			}
			
			if(!empty($instance['enable_carousel']) && $instance['enable_carousel'] == 1) : ?>
			<script type="text/javascript">
				(function($){
					"use strict";
					$(document).ready(function(){
						$('#<?php echo esc_js($unique_id) ?>.tweet-list.with-carousel').slick({
							infinite: true,
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							dots: true,
						});
					});
					$('.tweet-list .tweet').on('mousedown select',(function(e){
						e.preventDefault();
					}));
				})(jQuery);
			</script>
			<?php endif;
			
        }


        echo $after_widget;
    }


    //save widget settings
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['consumerkey'] = strip_tags($new_instance['consumerkey']);
        $instance['consumersecret'] = strip_tags($new_instance['consumersecret']);
        $instance['accesstoken'] = strip_tags($new_instance['accesstoken']);
        $instance['accesstokensecret'] = strip_tags($new_instance['accesstokensecret']);
        $instance['cachetime'] = strip_tags($new_instance['cachetime']);
        $instance['username'] = strip_tags($new_instance['username']);
        $instance['tweetstoshow'] = strip_tags($new_instance['tweetstoshow']);
		$instance['read_all'] = intval($new_instance['read_all']);
		$instance['author_info'] = intval($new_instance['author_info']);
		$instance['enable_carousel'] = intval($new_instance['enable_carousel']);

        if ($old_instance['username'] != $new_instance['username']) {
            delete_option('tp_twitter_plugin_last_cache_time');
        }

        return $instance;
    }


    //widget settings form
    public function form($instance)
    {
        $defaults = array('title' => '', 'consumerkey' => '', 'consumersecret' => '', 'accesstoken' => '', 'accesstokensecret' => '', 'cachetime' => '', 'username' => '', 'tweetstoshow' => '');
        $instance = wp_parse_args((array)$instance, $defaults);

        echo '
				<p><label>'.__('Title','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('title')) . '" id="' . esc_attr($this->get_field_id('title')) . '" value="' . esc_attr($instance['title']) . '" class="widefat" /></p>
				<p><label>'.__('Consumer Key','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('consumerkey')) . '" id="' . esc_attr($this->get_field_id('consumerkey')) . '" value="' . esc_attr($instance['consumerkey']) . '" class="widefat" /></p>
				<p><label>'.__('Consumer Secret','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('consumersecret')) . '" id="' . esc_attr($this->get_field_id('consumersecret')) . '" value="' . esc_attr($instance['consumersecret']) . '" class="widefat" /></p>
				<p><label>'.__('Access Token','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('accesstoken')) . '" id="' . esc_attr($this->get_field_id('accesstoken')) . '" value="' . esc_attr($instance['accesstoken']) . '" class="widefat" /></p>
				<p><label>'.__('Access Token Secret','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('accesstokensecret')) . '" id="' . esc_attr($this->get_field_id('accesstokensecret')) . '" value="' . esc_attr($instance['accesstokensecret']) . '" class="widefat" /></p>
				<p><label>'.__('Cache Tweets in every','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('cachetime')) . '" id="' . esc_attr($this->get_field_id('cachetime')) . '" value="' . esc_attr($instance['cachetime']) . '" class="small-text" /> hours</p>
				<p><label>'.__('Twitter Username','dfd').':</label>
					<input type="text" name="' . esc_attr($this->get_field_name('username')) . '" id="' . esc_attr($this->get_field_id('username')) . '" value="' . esc_attr($instance['username']) . '" class="widefat" /></p>
				<p><label>'.__('Tweets to display','dfd').':</label>
					<select type="text" name="' . esc_attr($this->get_field_name('tweetstoshow')) . '" id="' . esc_attr($this->get_field_id('tweetstoshow')) . '">';
				$i = 1;
				for (i; $i <= 12; $i++) {
					echo '<option value="' . esc_attr($i) . '"';
					if ($instance['tweetstoshow'] == $i) {
						echo ' selected="selected"';
					}
					echo '>' . $i . '</option>';
				}
				echo '</select></p>';
				
				echo '<p><label>'.__('Show read all link', 'dfd').':</label>
					<select type="text" name="' . esc_attr($this->get_field_name('read_all')) . '" id="' . esc_attr($this->get_field_id('read_all')) . '">';
				echo '<option value="0"';
					if ($instance['read_all'] == 0) {
						echo ' selected="selected"';
					}
					echo '>'.__('No', 'dfd').'</option>';
				echo '<option value="1"';
					if ($instance['read_all'] == 1) {
						echo ' selected="selected"';
					}
					echo '>'.__('Yes', 'dfd').'</option>';
				echo '</select></p>';
				
				echo '<p><label>'.__('Show author info', 'dfd').'</label>
					<select type="text" name="' . esc_attr($this->get_field_name('author_info')) . '" id="' . esc_attr($this->get_field_id('author_info')) . '">';
				echo '<option value="0"';
					if ($instance['author_info'] == 0) {
						echo ' selected="selected"';
					}
					echo '>'.__('No', 'dfd').'</option>';
				echo '<option value="1"';
					if ($instance['author_info'] == 1) {
						echo ' selected="selected"';
					}
					echo '>'.__('Yes', 'dfd').'</option>';
				echo '</select></p>';
				
				echo '<p><label>'.__('Enable carousel','dfd').':</label>
					<select type="text" name="' . esc_attr($this->get_field_name('enable_carousel')) . '" id="' . esc_attr($this->get_field_id('enable_carousel')) . '">';
				echo '<option value="0"';
					if ($instance['enable_carousel'] == 0) {
						echo ' selected="selected"';
					}
					echo '>'.__('No', 'dfd').'</option>';
				echo '<option value="1"';
					if ($instance['enable_carousel'] == 1) {
						echo ' selected="selected"';
					}
					echo '>'.__('Yes', 'dfd').'</option>';
				echo '</select></p>';
    }
}
