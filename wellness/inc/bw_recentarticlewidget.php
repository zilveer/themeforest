<?php 
/*
Plugin Name: Recent Article Widget
Plugin URI: -
Description: Custom Recent Articles/Posts Widget to display thumbnail
Author: BWThemes
Version: 1.1
Author URI: http://www.bwthemes.com
    
*/

class BW_RecentArticleWidget extends WP_Widget {

		function form( $instance ) {
		
				/* Default Widget Settings */
				$defaults = array(
				'title' => 'Recent Posts',
				'number' => '4'
				);
		
				$instance = wp_parse_args( (array) $instance, $defaults );
		
				$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
				$title = strip_tags($instance['title']);
				$text = format_to_edit($instance['text']);
			?>
			<!-- Widget Title -->
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>
			<!-- Widget Article Count -->
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Posts to Show:</label>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
			</p>
    <!--?php } ?-->
			<?php
		}

		function BW_RecentArticleWidget() {
			$widget_ops = array('classname' => 'widget_bratarecentarticle', 'description' => 'Custom Recent Article/Post Widget');
			$control_ops = array( 'id_base' => 'widget_bratarecentarticle' );
			parent::__construct('widget_bratarecentarticle', 'Wellness Theme: Recent Posts', $widget_ops, $control_ops);
		}

		function widget($args, $instance) {
				extract( $args );
				$title 		= apply_filters('widget_title', $instance['title']); // the widget title
				$numposts = $instance['number']; // the number of posts to show
				echo $before_widget;
				
				//Widget output
				if ( $title )
				echo $before_title . $title . $after_title;
				?>
					<ul class="bw_recent_posts">
					<?php
						$args = array('numberposts' => $numposts,'post_status' => 'publish' );
						$recent_posts = wp_get_recent_posts($args);
						foreach( $recent_posts as $recent ){
							echo '<li>';
							if(has_post_thumbnail($recent["ID"])) {
								echo '<a href="'.get_permalink($recent["ID"]).'">';
								echo get_the_post_thumbnail($recent["ID"], array(80,80) );
								echo '</a>';
								}
							echo '<a href="' . get_permalink($recent["ID"]) . '" title="'.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a>';
							echo  '<br /><br /><span class="widget_meta">' . get_the_time("F j, Y", $recent["ID"]) . ' | ' . get_the_author_meta('nickname',$recent["post_author"]) . '</span>' ;
							echo '<div class="clear"></div></li>';
						}
					?>
					</ul>
				
				
				<?php 
				echo $after_widget;
		}
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}
	
}

add_action('widgets_init', create_function('', 'return register_widget("BW_RecentArticleWidget");'));
?>