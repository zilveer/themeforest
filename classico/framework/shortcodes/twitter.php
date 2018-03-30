<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! twitter
// **********************************************************************// 

add_shortcode('twitter','etheme_twitter_shortcode');

function etheme_twitter_shortcode($atts, $content) {
		extract( shortcode_atts( array(
			'title' => '',
			'username' => '',
			'consumer_key' => '',
			'consumer_secret' => '',
			'user_token' => '',
			'user_secret' => '',
			'limit' => 10,
			'design' => 'slider',
			'class' => 10
		), $atts ) );

		$id = rand(100,999);
		
		if(empty($consumer_key) || empty($consumer_secret) || empty($user_token) || empty($user_secret) || empty($username)) {
			return __('Not enough information', ET_DOMAIN);
		}
		
		$tweets_array = et_get_tweets($consumer_key, $consumer_secret, $user_token, $user_secret, $username, $limit, 100, 'slider');
		
		$output = '';
		
		$output .= '<div class="et-twitter-'.$design.' '.$class.'">';
		if($title != '') {
			$output .= '<h2 class="twitter-slider-title"><span>'.$title.'</span></h2>';
		}
		
		
		$output .= '<ul class="et-tweets ' . $design.$id . '">';
		
		
		foreach($tweets_array as $tweet) {
			$output .= '<li class="et-tweet">';
			$output .= etheme_tweet_linkify($tweet['text']);
			$output .= '<div class="twitter-info">';
                            $output .= '<a href="'.$tweet['user']['url'].'" class="active" target="_blank">@'.$tweet['user']['screen_name'].'</a> '.date("l M j \- g:ia",strtotime($tweet['created_at']));
			$output .= '</div>';
			$output .= '</li>';
		}
		
		$output .= '</ul>';
			
		$output .= '</div>';

		if( $design == 'slider' ) {
			$items = '[[0, 1], [479,1], [619,1], [768,1],  [1200, 1], [1600, 1]]';
			$output .=  '<script type="text/javascript">';
			$output .=  '     jQuery(".'.$design.$id.'").owlCarousel({';
			$output .=  '         items:1, ';
			$output .=  '         navigation: true,';
			$output .=  '         navigationText:false,';
			$output .=  '         rewindNav: false,';
			$output .=  '         itemsCustom: '.$items.'';
			$output .=  '    });';
			$output .=  ' </script>';
		}
		
		
		return $output;
}




// **********************************************************************// 
// ! Register New Element: twitter
// **********************************************************************//
add_action( 'init', 'et_register_vc_twitter');
if(!function_exists('et_register_vc_twitter')) {
	function et_register_vc_twitter() {
		if(!function_exists('vc_map')) return;
	    $params = array(
	      'name' => '[8THEME] Twitter',
	      'base' => 'twitter',
	      'icon' => 'icon-wpb-etheme',
	      'category' => 'Eight Theme',
	      'params' => array(
	        array(
	          "type" => "textfield",
	          "heading" => __("Title", ET_DOMAIN),
	          "param_name" => "title"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Username", ET_DOMAIN),
	          "param_name" => "username"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Customer Key", ET_DOMAIN),
	          "param_name" => "consumer_key"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Customer Secret", ET_DOMAIN),
	          "param_name" => "consumer_secret"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Access Token", ET_DOMAIN),
	          "param_name" => "user_token"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Access Token Secret", ET_DOMAIN),
	          "param_name" => "user_secret"
	        ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Number of tweets", ET_DOMAIN),
	          "param_name" => "limit"
	        ),
            array(
              "type" => "dropdown",
              "heading" => __("Design", ET_DOMAIN),
              "param_name" => "design",
              "value" => array( 
                  __("Slider", ET_DOMAIN) => 'slider',
                  __("Grid", ET_DOMAIN) => 'grid',
                )
            ),
	        array(
	          "type" => "textfield",
	          "heading" => __("Extra Class", ET_DOMAIN),
	          "param_name" => "class",
	          "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', ET_DOMAIN)
	        )
	      )
	
	    );  
	
	    vc_map($params);
	}
}
