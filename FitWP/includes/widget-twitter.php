<?php
/*
 * Plugin Name: DD Twitter Widget
 * Plugin URI: http://themeforest.net/user/DDStudios/portfolio
 * Description: A widget that displays tweets
 * Version: 1.0
 * Author: Dany Duchaine
 * Author URI: http://themeforest.net/user/DDStudios/
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'dd_tweets_widgets' );

/*
 * Register widget.
 */
function dd_tweets_widgets() {
	register_widget( 'DD_Tweet_Widget' );
}

/*
 * Widget class.
 */
class dd_tweet_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function DD_Tweet_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'dd_tweet_widget', 'description' => __('A widget that displays your latest tweets.', 'localization') );

		 /* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dd_tweet_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'dd_tweet_widget', __('DD Twitter Widget','localization'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
                $title = apply_filters('widget_title', $instance['title'] );
		$user = $instance['user'];
		$postcount = $instance['postcount'];
	
		/* Before widget (defined by themes). */
        echo $before_widget;

        		/* Display Latest Tweets */

        ?>

<?php echo $before_title ?><?php echo $title ?><?php echo $after_title ?>
   <!-- Twitter Widgets -->
                <div id="twitter-slides">
                    
                    <div class="slides_container">
                        
                         <!-- Twitter Item -->
                        <div class="twitter-item active">
                            
                            <div class="twitter-meta clearfix">
                                
                                <div class="twitter-avatar">
                                    
                                       <a href="http://www.twitter.com/<?php echo $user ?>"><img src="http://twitter.com/api/users/profile_image?screen_name=<?php echo $user ?>" /></a>
                                        
                                </div>
                                    
                                <div class="twitter-info">
                                    
                                    <span class="testimonial-name"><?php echo $user ?></span>
                                    <a href="http://www.twitter.com/<?php echo $user ?>" class="testimonial-website"><span>Follow me on twitter</span></a>
                                        
                                </div>
                                    
                            </div>
                                
                            <div class="twitter-content clearfix">
                              
                                <div class="tweet"></div>    
                                
                            </div>
                                
                        </div>
                        <!-- // End Of Twitter Item -->
                            
                    </div>
                        
                </div>
                <!-- // End Of Twitter Widgets -->
                
   <script type='text/javascript'>
       
   jQuery(".tweet").tweet({
            username: "<?php echo $user ?>",
            join_text: "",
            count: <?php echo $postcount ?>,
            auto_join_text_ed: "",
            auto_join_text_ing: "",
            auto_join_text_reply: "",
            auto_join_text_url: "",
            loading_text: "loading tweets..."
        })

</script>
             
                
		<?php 

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
                $instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user'] = strip_tags( $new_instance['user'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		

		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
                'title' => 'My Tweets',
		'username' => 'ddstudios',
		'postcount' => '5',
				);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

              
		<p>
			<label for="<?php echo $this->get_field_id( 'user' ); ?>"><?php _e('Username:', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'user' ); ?>" name="<?php echo $this->get_field_name( 'user' ); ?>" value="<?php echo $instance['user']; ?>" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 20)', 'localization') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
		<!-- Tweettext: Text Input -->
				
	<?php
	}
}
?>