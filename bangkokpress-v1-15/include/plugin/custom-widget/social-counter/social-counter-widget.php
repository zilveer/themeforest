<?php
/**
 * Plugin Name: Social Counter Widget
 * Plugin URI: http://goodlayers.com/
 * Description: This widget will display your RSS subscribers, Twitter followers and Facebook fans in one nice looking box.
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

require "scw_stats.class.php";

add_action('widgets_init', 'gdl_social_widget');
function gdl_social_widget() {
	register_widget( 'SC_widget' );
}

class SC_widget extends WP_Widget {

    // Initialize the widget
    function SC_widget() {
        parent::__construct(false, $name = 'Social Counter Widget');
		
        $this->cacheFileName = WP_CONTENT_DIR."/sc_cache.txt";
    }

    // Output of the widget
    function widget($args, $instance) {
        extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
        $facebook_id	= $instance['facebook_id'];
        $twitter_id	= $instance['twitter_id'];
        $feedburner_id = $instance['feedburner_id'];
		$consumer_key = $instance[ 'consumer_key' ];
		$consumer_secret = $instance[ 'consumer_secret' ];
		$access_token = $instance[ 'access_token' ];
		$access_token_secret = $instance[ 'access_token_secret' ];		
		
        $cacheFileName = $this->cacheFileName;

        if( file_exists($cacheFileName) && ((time() - filemtime($cacheFileName)) <  30*60) ){
            $stats = unserialize(file_get_contents($cacheFileName));
        }else if( file_exists($cacheFileName) ){
			$old_stats = unserialize(file_get_contents($cacheFileName));		
		}
		
        if(!$stats){
            $stats = new SubscriberStats(array(
                'facebookFanPageURL'	=> $facebook_id,
                'feedBurnerURL'			=> $feedburner_id,
                'twitterName'			=> $twitter_id,
                'consumer_key'			=> $consumer_key,
                'consumer_secret'		=> $consumer_secret,
                'access_token'			=> $access_token,
                'access_token_secret'	=> $access_token_secret,
				'rss'					=> $old_stats->rss,
				'twitter'				=> $old_stats->twitter,
				'facebook'				=> $old_stats->facebook
            ));
            file_put_contents($cacheFileName, serialize($stats));
        }

        ?>
			<div class="sidebar-social-counter-widget">
              <?php echo $before_widget; ?>
			  <?php 
				if ( $title ){ 
					echo $before_title . $title . $after_title; 
				}else if( strrpos($after_title, 'bkp-frame') > 0 ) {
					echo '<div class="bkp-frame-wrapper"><div class="bkp-frame p20 gdl-divider">';
				}
			  ?>
					<?php $stats->generate(); ?>
              <?php echo $after_widget; ?>
			</div>
        <?php

    }

    // Widget Form
    function form($instance) {
		$title = esc_attr( $instance[ 'title' ] );
        $twitter_id  = esc_attr($instance['twitter_id']);
        $facebook_id = esc_attr($instance['facebook_id']);
        $feedburner_id = esc_attr($instance['feedburner_id']);
		$consumer_key = esc_attr( $instance[ 'consumer_key' ] );
		$consumer_secret = esc_attr( $instance[ 'consumer_secret' ] );
		$access_token = esc_attr( $instance[ 'access_token' ] );
		$access_token_secret = esc_attr( $instance[ 'access_token_secret' ] );		
		
        ?>
		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>		
		
        <p>
          <label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Facebook page URL (not ID !):', 'gdl_back_office'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" type="text" value="<?php echo $facebook_id; ?>" />
        </p>
		
        <p>
          <label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner URL (not ID !):', 'gdl_back_office'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
        </p>
		
        <p>
          <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:', 'gdl_back_office'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />
        </p>

		
		<!-- Consumer Key --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php echo $consumer_key; ?>" />
		</p>

		<!-- Consumer Secret --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
		</p>

		<!-- Access Token --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access Token :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
		</p>

		<!-- Access Token Secret --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><?php _e('Access Token Secret :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" type="text" value="<?php echo $access_token_secret; ?>" />
		</p>		
		
        <?php
    }
	
	// Update the widget
    function update($new_instance, $old_instance) {
        if($new_instance != $old_instance) unlink($this->cacheFileName);
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
        $instance['facebook_id'] = strip_tags($new_instance['facebook_id']);
        $instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		$instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );
        return $instance;
    }	

} // SC_widget

?>