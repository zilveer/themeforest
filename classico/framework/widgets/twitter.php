<?php  if ( ! defined('ET_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Twitter Widget
// **********************************************************************// 

class Etheme_Twitter_Widget extends WP_Widget {
    function Etheme_Twitter_Widget() {
        $widget_ops = array( 'classname' => 'etheme_twitter', 'description' => __('Display most recent Twitter feed', ET_DOMAIN) );
        $control_ops = array( 'id_base' => 'etheme-twitter' );
        parent::__construct( 'etheme-twitter', '8theme - '.__('Twitter Feed', ET_DOMAIN), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );
        echo $before_widget;
        if ( $title ) echo $before_title . $title . $after_title;
        $attr = array( 'usernames' => $instance['usernames'], 'limit' => $instance['limit'], 'interval' => $instance['interval'] );
        $attr['interval'] = $attr['interval'] * 10;
        //echo etheme_get_twitter( $attr );
        $tweets = et_get_tweets($instance['consumer_key'],$instance['consumer_secret'],$instance['user_token'],$instance['user_secret'],$attr['usernames'], $attr['limit']);

        if(count($tweets) > 0 && empty($tweets['errors'])) {
            $html = '<ul class="twitter-list">';
                foreach ($tweets as $tweet) {
                    $html .= '<li><div class="media"><i class="pull-left fa fa-twitter"></i><div class="media-body">' . @$tweet['text'] . '</div></div></li>';
                }
            $html .= '</ul>';
        }
        $html = etheme_tweet_linkify($html);

        echo $html;

        echo $after_widget;
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( @$new_instance['title'] );
        $instance['usernames'] = strip_tags( @$new_instance['usernames'] );
        $instance['consumer_key'] = strip_tags( @$new_instance['consumer_key'] );
        $instance['consumer_secret'] = strip_tags( @$new_instance['consumer_secret'] );
        $instance['user_token'] = strip_tags( @$new_instance['user_token'] );
        $instance['user_secret'] = strip_tags( @$new_instance['user_secret'] );
        $instance['limit'] = strip_tags( @$new_instance['limit'] );
        $instance['interval'] = strip_tags( @$new_instance['interval'] );
        return $instance;
    }
    function form( $instance ) {
        $defaults = array( 'title' => '', 'usernames' => '8theme', 'limit' => '2', 'interval' => '5', 'consumer_key' => '', 'consumer_secret' => '', 'interval' => '', 'user_secret' => '', 'user_token' => '' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        etheme_widget_input_text( __('Title:', ET_DOMAIN), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
        etheme_widget_input_text( __('Username:', ET_DOMAIN), $this->get_field_id( 'usernames' ), $this->get_field_name( 'usernames' ), $instance['usernames'] );
        etheme_widget_input_text( __('Customer Key:', ET_DOMAIN), $this->get_field_id( 'consumer_key' ), $this->get_field_name( 'consumer_key' ), $instance['consumer_key'] );
        etheme_widget_input_text( __('Customer Secret:', ET_DOMAIN), $this->get_field_id( 'consumer_secret' ), $this->get_field_name( 'consumer_secret' ), $instance['consumer_secret'] );
        etheme_widget_input_text( __('Access Token:', ET_DOMAIN), $this->get_field_id( 'user_token' ), $this->get_field_name( 'user_token' ), $instance['user_token'] );
        etheme_widget_input_text( __('Access Token Secret:', ET_DOMAIN), $this->get_field_id( 'user_secret' ), $this->get_field_name( 'user_secret' ), $instance['user_secret'] );
        etheme_widget_input_text( __('Number of tweets:', ET_DOMAIN), $this->get_field_id( 'limit' ), $this->get_field_name( 'limit' ), $instance['limit'] );
    }
}
