<?php

    /*
    Plugin Name: Simple Twitter Widget
    Plugin URI: http://chipsandtv.com/
    Description: A simple but powerful widget to display updates from a Twitter feed. Configurable and reliable.
    Version: 1.03
    Author: Matthias Siegel
    Author URI: http://chipsandtv.com/


    Copyright 2011  Matthias Siegel  (email : chipsandtv@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    */

    class Twitter_Widget extends WP_Widget {

		function __construct() {
            // Widget settings
            $widget_ops = array( 'classname' => 'twitter-widget', 'description' => 'Display your latest tweets.' );

            // Create the widget
            parent::__construct( 'twitter-widget', 'Swift Framework Tweets', $widget_ops );
        }


        function widget( $args, $instance ) {

            extract( $args );

            global $interval;

            // User-selected settings
            $title         = apply_filters( 'widget_title', $instance['title'] );
            $username      = $instance['username'];
            $tweets        = $instance['posts'];
            $date          = $instance['date'];
            $datedisplay   = $instance['datedisplay'];
            $clickable     = $instance['clickable'];
            $hideerrors    = $instance['hideerrors'];
            $encodespecial = $instance['encodespecial'];

            // Before widget (defined by themes)
            echo $before_widget;

            // Title of widget (before and after defined by themes)
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }


            $result = '<ul class="twitter-widget">';

            $result .= sf_latest_tweet( $tweets, $username );

            $result .= '</ul>';

            $result .= '<div class="twitter-link">Follow <a href="http://www.twitter.com/' . $username . '">@' . $username . '</a>.</div>';

            // Display everything
            echo $result;

            // After widget (defined by themes)
            echo $after_widget;
        }


        // Callback helper for the cache interval filter
        function setInterval() {

            global $interval;

            return $interval;
        }


        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']         = $new_instance['title'];
            $instance['username']      = $new_instance['username'];
            $instance['posts']         = $new_instance['posts'];
            $instance['date']          = $new_instance['date'];
            $instance['datedisplay']   = $new_instance['datedisplay'];
            $instance['clickable']     = $new_instance['clickable'];
            $instance['hideerrors']    = $new_instance['hideerrors'];
            $instance['encodespecial'] = $new_instance['encodespecial'];

            // Delete the cache file when options were updated so the content gets refreshed on next page load
            $upload    = wp_upload_dir();
            $cachefile = $upload['basedir'] . '/_twitter_' . $old_instance['username'] . '.txt';
            @unlink( $cachefile );

            return $instance;
        }


        function form( $instance ) {

            // Set up some default widget settings
            $defaults = array( 'title'         => 'Latest Tweets',
                               'username'      => '',
                               'posts'         => 5,
                               'interval'      => 1800,
                               'date'          => 'j F Y',
                               'datedisplay'   => true,
                               'clickable'     => true,
                               'hideerrors'    => true,
                               'encodespecial' => false
            );
            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'swiftframework' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
                       name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Your Twitter username:', 'swiftframework' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>"
                       name="<?php echo $this->get_field_name( 'username' ); ?>"
                       value="<?php echo $instance['username']; ?>">
            </p>

            <p>
                <label
                    for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php _e( 'Display how many tweets?', 'swiftframework' ); ?></label>
                <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'posts' ); ?>"
                       name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>">
            </p>

        <?php
        }
    }

    add_action( 'widgets_init', 'loadTwitterWidget' );

    function loadTwitterWidget() {

        register_widget( 'Twitter_Widget' );
    }

?>