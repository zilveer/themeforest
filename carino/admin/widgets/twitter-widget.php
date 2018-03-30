<?php

/**
  * Twitter Widget
  *
  * @author : VanThemes ( http://www.vanthemes.com )
  * 
  */

add_action( 'widgets_init', 'van_latest_tweets_init' );
function van_latest_tweets_init() {
	register_widget( 'van_latest_tweets' );
}
class van_latest_tweets extends WP_Widget {

	function van_latest_tweets() {
		$options = array( 'classname' => 'twitter-widget','description' => 'Latest tweets widget'  );
		$control = array( 'width' => 250, 'height' => 350, 'id_base' => 'latest-tweets-widget' );
		$this->WP_Widget( 'latest-tweets-widget','( '.THEME_NAME .' ) - Twitter', $options, $control );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title     = apply_filters('widget_title', $instance['title'] );
		$username  = van_get_option('twitter_username');
		$number    = $instance['number'];

		echo $before_widget;

		if ( $title ){
			echo $before_title .$title . $after_title;
		} 
		?>
		<div class="twitter-widget">
			<div class="follow-btn">
				<a href="<?php echo esc_url( 'http://twitter.com/' . $username ); ?>" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @<?php echo $username; ?></a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<?php echo van_recent_tweets( $number ); ?>
		</div>
		<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number']    = strip_tags( $new_instance['number'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('@Follow Me' , 'van') , 'number' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p><small style="color:red;">Please, Make sure that you have set up the <strong>twitter API</strong> settings. From appearance -> <?php echo THEME_NAME; ?> settings -> Twitter Settings</small></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Title :","van"); ?> </label>
			<input  class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Tweets : </label>
			<input type="text" style="width:35px;" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo esc_attr( $instance['number'] ); ?>"  />
		</p>
	<?php
	}
}