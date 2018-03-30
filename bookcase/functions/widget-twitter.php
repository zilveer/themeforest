<?php

/*******************************************************
*
*	Custom Twitter Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_twitter_widgets' );

// Register widget
function ag_twitter_widgets() {
	register_widget( 'AG_Twitter_Widget' );
}

// Widget class
class ag_twitter_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/
	
	function AG_Twitter_Widget() {
	
		/* General widget settings */
		$widget_ops = array( 'classname' => 'ag_twitter_widget', 'description' => __('A widget that displays your latest tweets.', 'framework') );

		/* Widget control settings */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'ag_twitter_widget' );

		/* Create widget */
		$this->WP_Widget( 'ag_twitter_widget', __('Custom Twitter Widget', 'framework'), $widget_ops, $control_ops );
	}

/*----------------------------------------------------------*/
/*	Display The Widget 
/*----------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Variables from settings. */
		$postnum = $instance['postnum'];
		$twitterid = $instance['twitterid'];
		$buttontext = $instance['buttontext'];
		
		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		?>
        <?php 
/* Display the widget title & subtitle if one was input (before and after defined by themes). */
if ( $title ) echo ' 
            <h4 class="widget-title">'.$title.'</h4>'
?>
<?php // $postnum = $postnum + 1;
echo '
<div id="twitter_div">
                <ul id="twitter_update_list">
                    <li>&nbsp;</li>
                </ul>
</div>
            <a href="http://www.twitter.com/'.$twitterid.'" class="button small">'.$buttontext.'</a>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$twitterid.'&amp;count='.$postnum.'$amp;callback=twitterCallback2"></script>'
?>

<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

/*----------------------------------------------------------*/
/*	Update the Widget
/*----------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Remove HTML: */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['postnum'] = strip_tags( $new_instance['postnum'] );
		$instance['twitterid'] = strip_tags( $new_instance['twitterid'] );
		$instance['buttontext'] = strip_tags( $new_instance['buttontext'] );
	
		return $instance;
	}
	

/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
		'title' => '',
		'postnum' => '',
		'twitterid' => '',
		'buttontext' => '',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<!-- Widget Title: Text Input -->
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
        <?php _e('Twitter Title (Optional):', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'twitterid' ); ?>">
        <?php _e('Twitter Username:', 'framework') ?>
    </label>
   <input class="widefat" id="<?php echo $this->get_field_id( 'twitterid' ); ?>" name="<?php echo $this->get_field_name( 'twitterid' ); ?>" value="<?php echo $instance['twitterid']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'postnum' ); ?>">
        <?php _e('Number of Tweets:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'postnum' ); ?>" name="<?php echo $this->get_field_name( 'postnum' ); ?>" value="<?php echo $instance['postnum']; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>">
        <?php _e('Button Text:', 'framework') ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
</p>
<?php
	}
}
?>