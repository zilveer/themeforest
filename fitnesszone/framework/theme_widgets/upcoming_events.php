<?php
/** My Upcoming Events Widget
  * Objective:
  *		1.To list out posts
**/
class MY_Upcoming_Events extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_upcoming_events', 'description'=>'To list out events');
		parent::__construct(false,IAMD_THEME_NAME.__(' Events','iamd_text_domain'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_post_count'=>'') );
		$title = strip_tags($instance['title']);
		$_post_count = !empty($instance['_post_count']) ? strip_tags($instance['_post_count']) : "-1";?>

        <!-- Form -->
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','iamd_text_domain');?> 
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

	    <p><label for="<?php echo $this->get_field_id('_post_count'); ?>"><?php _e('No.of posts to show:','iamd_text_domain');?></label>
		   <input id="<?php echo $this->get_field_id('_post_count'); ?>" name="<?php echo $this->get_field_name('_post_count'); ?>" value="<?php echo esc_attr($_post_count);?>" /></p>
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_post_count'] = strip_tags($new_instance['_post_count']);
	return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		global $post;
		$title = empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$_post_count = (int) $instance['_post_count'];
		$arg = "posts_per_page={$_post_count}&post_type=tribe_events";

		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title.$title.$after_title;
		echo "<div class='upcoming-events-widget'><ul>";
			 $the_query = new WP_Query($arg);
			 if($the_query->have_posts()) :
			 while($the_query->have_posts()):
			 	$the_query->the_post();
				$title = get_the_title();
				echo "<li>";
					$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'my-post-thumb', false);
					$image = ( $image != false)? $image[0] : "http".dt_theme_ssl()."://placehold.it/70x60";
					echo "<a href='".get_permalink()."' class='entry-thumb'>";
					echo "<img src='$image' alt='{$title}'/>";
					echo "</a>";

					echo "<h4><a href='".get_permalink()."'>{$title}</a></h4>";

					echo '<div class="entry-metadata">';
						echo '<p class="date">'.__('Start time: ', 'iamd_text_domain').substr(get_post_meta($post->ID, '_EventStartDate', true), 0, 16).'<br>'.__('End time: ', 'iamd_text_domain').substr(get_post_meta($post->ID, '_EventEndDate', true), 0, 16).'</p>';
					echo '</div>';
				echo "</li>";
			 endwhile;
			 else:
			 	echo "<li><h4>".__('No Events found','iamd_text_domain')."</h4></li>";
			 endif;
			 wp_reset_postdata();
	 	echo "</ul></div>";			 
		echo $after_widget;
	}
}?>