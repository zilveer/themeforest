<?php

/**
 * Plugin Name: Peekaboo Twitter Widget
 * Version: 2.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/

class pkb_widget_twitter extends WP_Widget
{
    function pkb_widget_twitter() {
        $widget_ops = array(
        'classname'        =>        'pkb_widget_twitter',
        'description'     =>         __('Displays the latest tweets', 'peekaboo')
        );


        parent::__construct( 'pkb_widget_twitter', __('Peekaboo Twitter','peekaboo'), $widget_ops );

    }

    function widget( $args, $instance ) {
        extract ( $args, EXTR_SKIP );
        $title = ( $instance['title'] ) ? $instance['title'] : 'Latest tweets';
        $username = ( $instance['username'] ) ? $instance['username'] : '';
        $no_tweets = ( $instance['no_tweets'] ) ? $instance['no_tweets'] : '4';

        $consumerkey = ( $instance['consumerkey'] ) ? $instance['consumerkey'] : '';
        $consumersecret = ( $instance['consumersecret'] ) ? $instance['consumersecret'] : '';
        $accesstoken = ( $instance['accesstoken'] ) ? $instance['accesstoken'] : '';
        $accesstokensecret = ( $instance['accesstokensecret'] ) ? $instance['accesstokensecret'] : '';

        $unique_id =  $username . $no_tweets . $title ;
        $unique_id = preg_replace("/[^A-Za-z0-9]/", '', $unique_id);
        $root = get_template_directory_uri();
        echo $before_widget;
        echo $before_title . $title . $after_title;
        // wp_enqueue_style("bra_twitter", $root."/functions/twitter/bra_twitter_widget.css");
        require("twitter.php");
        ?>
        <div class="pkb-tweets" id="<?php echo $unique_id; ?>">
        <?php pkb_tweets($username, $no_tweets, $consumerkey, $consumersecret, $accesstoken, $accesstokensecret); ?>
        </div><!--END tweets-->
        <?php
        echo $after_widget;
    }

    function form( $instance ) {
        if (!isset($instance['title'])) $instance['title'] = "";
        if (!isset($instance['username'])) $instance['username'] = "";
        if (!isset($instance['no_tweets'])) $instance['no_tweets'] = "";

        if (!isset($instance['consumerkey'])) $instance['consumerkey'] = "";
        if (!isset($instance['consumersecret'])) $instance['consumersecret'] = "";
        if (!isset($instance['accesstoken'])) $instance['accesstoken'] = "";
        if (!isset($instance['accesstokensecret'])) $instance['accesstokensecret'] = "";

        ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title','peekaboo') ?>:
        <input id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                value="<?php echo esc_attr( $instance['title'] ); ?>"
                class="widefat"/>
        </label>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('username'); ?>">
        <?php _e('Username:','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('username'); ?>"
                name="<?php echo $this->get_field_name('username'); ?>"
                value="<?php echo esc_attr( $instance['username'] ); ?>"
                class="widefat"/>
        </label>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('no_tweets'); ?>">
        <?php _e('Number of tweets:','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('no_tweets'); ?>"
                name="<?php echo $this->get_field_name('no_tweets'); ?>"
                value="<?php echo esc_attr( $instance['no_tweets'] ); ?>"
                class="widefat"/>
        </label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('consumerkey'); ?>">
        <?php _e('Consumer Key:','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('consumerkey'); ?>"
                name="<?php echo $this->get_field_name('consumerkey'); ?>"
                value="<?php echo esc_attr( $instance['consumerkey'] ); ?>"
                class="widefat"/>
        </label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('consumersecret'); ?>">
        <?php _e('Consumer Secret: <a href="https://dev.twitter.com/apps" target="_blank">?</a>','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('consumersecret'); ?>"
                name="<?php echo $this->get_field_name('consumersecret'); ?>"
                value="<?php echo esc_attr( $instance['consumersecret'] ); ?>"
                class="widefat"/>
        </label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('accesstoken'); ?>">
        <?php _e('Access Token:','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('accesstoken'); ?>"
                name="<?php echo $this->get_field_name('accesstoken'); ?>"
                value="<?php echo esc_attr( $instance['accesstoken'] ); ?>"
                class="widefat"/>
        </label>
        </p>

        <p>
        <label for="<?php echo $this->get_field_id('accesstokensecret'); ?>">
        <?php _e('Access Token Secret:','peekaboo') ?>
        <input id="<?php echo $this->get_field_id('accesstokensecret'); ?>"
                name="<?php echo $this->get_field_name('accesstokensecret'); ?>"
                value="<?php echo esc_attr( $instance['accesstokensecret'] ); ?>"
                class="widefat"/>
        </label>
        </p>
        <?php
    }

}

function pkb_widget_twitter_init() {
    register_widget("pkb_widget_twitter");
}
add_action('widgets_init','pkb_widget_twitter_init');