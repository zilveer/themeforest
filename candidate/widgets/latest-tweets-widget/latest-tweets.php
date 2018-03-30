<?php
/*
Plugin Name: Latest Tweets
Plugin URI: http://wordpress.org/extend/plugins/latest-tweets-widget/
Description: Provides a sidebar widget showing latest tweets - compatible with the new Twitter API 1.1
Author: Tim Whitlock
Version: 1.0.13
Author URI: http://timwhitlock.info/
*/



/**
 * Pull latest tweets with some caching of raw data.
 * @param string account whose tweets we're pulling
 * @param int number of tweets to get and display
 * @param bool whether to show retweets
 * @param bool whether to show at replies
 * @return array blocks of html expected by the widget
 */
function latest_tweets_render( $screen_name, $count, $rts, $ats ){
    try {
        if( ! function_exists('twitter_api_get') ){
            require_once dirname(__FILE__).'/lib/twitter-api.php';
            _twitter_api_init_l10n();
        }
        // caching full data set, not just twitter api caching
        $cachettl = (int) apply_filters('latest_tweets_cache_seconds', 300 );
        if( $cachettl ){
            $arguments = func_get_args();
            $cachekey = 'latest_tweets_'.implode('_', $arguments );
            if( ! function_exists('_twitter_api_cache_get') ){
                twitter_api_include('core');
            }
            if( $rendered = _twitter_api_cache_get($cachekey) ){
                return $rendered;
            }
        }
        // Build API params for "statuses/user_timeline" // https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
        $trim_user = false;
        $include_rts = ! empty($rts);
        $exclude_replies = empty($ats);
        $params = compact('exclude_replies','include_rts','trim_user','screen_name', 'user');
        // Stripping tweets means we may get less than $count tweets.
        // we'll keep going until we get the amount we need, but may as well get more each time.
        if( $exclude_replies || ! $include_rts ){
            $params['count'] = $count * 3;
        }
        // else ensure we always get more than one to avoid infinite loop on max_id bug
        else {
            $params['count'] = max( 2, $count );
        }
        // pull tweets until we either have enough, or there are no more
        $tweets = array();
        while( $batch = twitter_api_get('statuses/user_timeline', $params ) ){
            $max_id = null;
            foreach( $batch as $tweet ){
                if( isset($params['max_id']) && $tweet['id_str'] === $params['max_id'] ){
                    // previous max included in results, even though docs say it won't be
                    continue;
                }
                $max_id = $tweet['id_str'];
                if( ! $include_rts && preg_match('/^(?:RT|MT)[ :\-]*@/i', $tweet['text']) ){
                    // skipping manual RT
                    continue;
                }
                $tweets[] = $tweet;
            }
            if( isset($tweets[$count]) ){
                $tweets = array_slice( $tweets, 0, $count );
                break;
            }
            if( ! $max_id ){
                // infinite loop would occur if user had only tweeted once, ever.
                break;
            }
            $params['max_id'] = $max_id;
        }
        // render each tweet as a blocks of html for the widget list items
        $rendered = array();
        foreach( $tweets as $tweet ){
            extract( $tweet );
            $link = esc_html( 'http://twitter.com/'.$screen_name.'/status/'.$id_str);
            // render nice datetime, unless theme overrides with filter
            $date = apply_filters( 'latest_tweets_render_date', $created_at );
            if( $date === $created_at ){
                function_exists('twitter_api_relative_date') or twitter_api_include('utils');
                $date = esc_html( twitter_api_relative_date($created_at) );
                $date = '<time datetime="'.$created_at.'">'.$date.'</time>';
            }
            // render and linkify tweet, unless theme overrides with filter
            $html = apply_filters('latest_tweets_render_text', $text );
            if( $html === $text ){
                if( ! function_exists('twitter_api_html') ){
                    twitter_api_include('utils');
                }
                if( ! empty($entities['urls']) || ! empty($entities['media']) ){
                    $text = twitter_api_expand_urls( $text, $entities );
                }
                $html = twitter_api_html( $text );
            }

			$twitter_thumb = $tweet['user']['profile_image_url'];
			

            // piece together the whole tweet, allowing overide
            $final = apply_filters('latest_tweets_render_tweet', $html, $date, $link, $tweet );
            if( $final === $html ){
                $final = '<span class="tweet-details tweet_time" style="display:none;" ><a href="'.$link.'" target="_blank">'.$date.'</a></span>'.
				'<span class="tweet-text tweet_text">'.$html.'</span>';
            }
            $rendered[] = $final;
        }
        // cache rendered tweets
        if( $cachettl ){
            _twitter_api_cache_set( $cachekey, $rendered, $cachettl );
        }
        return $rendered;
    }
    catch( Exception $Ex ){
        return array( '<span class="tweet-text tweet_text"><strong>Error:</strong> '.esc_html($Ex->getMessage()).'</span>' );
    }
} 



/**
 * Render tweets as HTML anywhere
 * @param string $screen_name Twitter handle
 * @param int $num Number of tweets to show, defaults to 5
 * @param bool $rts Whether to show Retweets, defaults to true
 * @param bool $ats Whether to show 'at' replies, defaults to true
 * @return string HTML <div> element containing a list
 */
function latest_tweets_render_html( $screen_name = '', $num = 5, $rts = true, $ats = true ){
    $items = latest_tweets_render( $screen_name, $num, $rts, $ats );
    $list  = apply_filters('latest_tweets_render_list', $items, $screen_name );
    if( is_array($list) ){
        $list = '<ul class="tweet_list"><li class="tweet_first tweet_odd" >'.implode('</li><li  class="tweet_first tweet_odd" >',$items).'</li></ul>';
    }
    return 
        '<div id="twitter-widget" class="tweet latest-tweets">'. 
            apply_filters( 'latest_tweets_render_before', '' ).
            $list.
            apply_filters( 'latest_tweets_render_after', '' ).
        '</div>';
}

 
  
/**
 * latest tweets widget class
 */
class Latest_Tweets_Widget extends WP_Widget {
    
    /** @see WP_Widget::__construct */
    public function __construct( $id_base = false, $name = 'Candidate Latest Tweets', $widget_options = array(), $control_options = array() ){
        if( ! function_exists('_twitter_api_init_l10n') ){
            require_once dirname(__FILE__).'/lib/twitter-api.php';
        }
        _twitter_api_init_l10n();
        $this->options = array(
            array (
                'name'  => 'title',
                'label' => __('Widget title', 'candidate'),
                'type'  => 'text'
            ),
            array (
                'name'  => 'screen_name',
                'label' => __('Twitter handle', 'candidate'),
                'type'  => 'text'
            ),
            array (
                'name'  => 'num',
                'label' => __('Number of tweets', 'candidate'),
                'type'  => 'text'
            ),
           
        );
        parent::__construct( $id_base, $name, $widget_options, $control_options );  
    }    
    
    /* ensure no missing keys in instance params */
    private function check_instance( $instance ){
        if( ! is_array($instance) ){
            $instance = array();
        }
        $instance += array (
            'title' => __('Latest Tweets', 'candidate'),
            'screen_name' => '',
            'num' => '5',
            'rts' => '',
            'ats' => '',
        );
        return $instance;
    }
    
    /** @see WP_Widget::form */
    public function form( $instance ) {
        $instance = $this->check_instance( $instance );
        foreach ( $this->options as $val ) {
            $elmid = $this->get_field_id( $val['name'] );
            $fname = $this->get_field_name($val['name']);
            $value = isset($instance[ $val['name'] ]) ? $instance[ $val['name'] ] : '';
            $label = '<label for="'.$elmid.'">'.$val['label'].'</label>';
            if( 'bool' === $val['type'] ){
                 $checked = $value ? ' checked="checked"' : '';
                 echo '<p><input type="checkbox" value="1" id="'.$elmid.'" name="'.$fname.'"'.$checked.' /> '.$label.'</p>';
            }
            else {
                $attrs = '';
                echo '<p>'.$label.'<br /><input class="widefat" type="text" value="'.esc_attr($value).'" id="'.$elmid.'" name="'.$fname.'" /></p>';
            }
        }
    }

    /** @see WP_Widget::widget */
    public function widget( $args, $instance ) {
        extract( $this->check_instance($instance) );
        // title is themed via Wordpress widget theming techniques
        $title = '<h4>' . apply_filters('widget_title', $title) . '</h4>';
        // by default tweets are rendered as an unordered list
        $items = latest_tweets_render( $screen_name, $num, $rts, $ats );
        $list  = apply_filters('latest_tweets_render_list', $items, $screen_name );
        if( is_array($list) ){
            $list = '<ul class="tweet_list"><li class="tweet_first tweet_odd" >'.implode('</li><li class="tweet_first tweet_odd">',$items).'</li></ul>';
        }
        // output widget applying filters to each element
        echo '<div class="twitter-widget-area">',			
        $args['before_widget'], 
            $title,
            '<div id="twitter-widget" class=" twitter-widget">', 
                apply_filters( 'latest_tweets_render_before', '' ),
                $list,
                apply_filters( 'latest_tweets_render_after', '' ),
            '</div>',
			'<a href="http://twitter.com/'. $screen_name .'" class="button twitter-button">'. __('Follow us on twitter', 'candidate') .'</a>',
         $args['after_widget'],
		 '</div>';
    }
    
}
 


function latest_tweets_register_widget(){
    return register_widget('Latest_Tweets_Widget');
}

add_action( 'widgets_init', 'latest_tweets_register_widget' );



function lastest_tweets_shortcode( $atts ){
    $screen_name = isset($atts['user']) ? trim($atts['user'],' @') : '';
    $num = isset($atts['max']) ? (int) $atts['max'] : 5;
    return latest_tweets_render_html( $screen_name, $num, true, false );
}

add_shortcode( 'tweets', 'lastest_tweets_shortcode' );



if( is_admin() ){
    if( ! function_exists('twitter_api_get') ){
        require_once dirname(__FILE__).'/lib/twitter-api.php';
    }
    // extra visibility of API settings link
    function latest_tweets_plugin_row_meta( $links, $file ){
        if( false !== strpos($file,'/latest-tweets.php') ){
            $links[] = '<a href="options-general.php?page=twitter-api-admin"><strong>'.esc_attr__('Connect to Twitter').'</strong></a>';
        } 
        return $links;
    }
    add_action('plugin_row_meta', 'latest_tweets_plugin_row_meta', 10, 2 );
}





