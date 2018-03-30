<?php

// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'theme_tweets_widgets' );

// Register widget
function theme_tweets_widgets() {
	register_widget( 'Theme_Tweet_Widget' );
}

// Widget class
class theme_tweet_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function theme_Tweet_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'theme_tweet_widget',
		'description' => __('A widget that displays your latest tweets.', 'framework')
	);

	// Widget control settings
	/*$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'theme_tweet_widget'
	);*/

	// Create the widget
	$this->WP_Widget( 'theme_tweet_widget', __('Custom Latest Tweets','framework'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$username = $instance['username'];
	$postcount = $instance['postcount'];
	$tweettext = $instance['tweettext'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display Latest Tweets
	 ?>
		
			<ul id="twitter_update_list">
				<li>&nbsp;</li>
			</ul>
            <?php if($tweettext != '') : ?>
			<a href="http://twitter.com/<?php echo $username ?>" id="twitter-link"><?php echo $tweettext ?></a>
            <?php endif; ?>
		<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
		<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?callback=twitterCallback2&screen_name=<?php echo $username ?>&count=<?php echo $postcount ?>"></script>
	
	<?php 

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['username'] = strip_tags( $new_instance['username'] );
	$instance['postcount'] = strip_tags( $new_instance['postcount'] );
	$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
	'title' => 'Latest Tweets',
	'username' => 'swishthemes',
	'postcount' => '5',
	'tweettext' => 'Follow on Twitter',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Username: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. swishthemes', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
	</p>
	
	<!-- Postcount: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 20)', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
	</p>
	
	<!-- Tweettext: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text e.g. Follow on Twitter', 'framework') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
	</p>
		
	<?php
	}
}
?>