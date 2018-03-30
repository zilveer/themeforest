<?php
/**
 * Plugin Name: Goodlayers Featured Player Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show featured player.
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'gdlr_featured_player_widget' );
if( !function_exists('gdlr_featured_player_widget') ){
	function gdlr_featured_player_widget() {
		register_widget( 'Goodlayers_Feature_Player' );
	}
}

if( !class_exists('Goodlayers_Feature_Player') ){
	class Goodlayers_Feature_Player extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'gdlr-featured-player-widget', 
				__('Goodlayers Featured Player Widget','gdlr_translate'), 
				array('description' => __('A widget that show featured player', 'gdlr_translate')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$thumbnail_size = $instance['thumbnail_size'];
			 
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . $title . $args['after_title']; 
			}
				
			// Widget Content
			$player = get_posts(array(
				'suppress_filters' => 0,
				'name' => $category,
				'post_type' => 'player',
				'post_status' => 'publish',
				'numberposts' => 1
			));

			$player_val = gdlr_lms_decode_preventslashes(get_post_meta($player[0]->ID, 'gdlr-soccer-player-settings', true));
			$player_options = empty($player_val)? array(): json_decode($player_val, true);	
					
			echo '<div class="feature-player-widget-wrapper">';
			echo '<div class="feature-player-widget-thumbnail">';
			echo gdlr_get_image(get_post_thumbnail_id($player[0]->ID), $thumbnail_size, true);
			echo '</div>';
			
			echo '<div class="feature-player-widget-title-wrapper">';
			echo '<h4 class="feature-player-widget-title">' . $player[0]->post_title . '</h4>';
			echo '<div class="feature-player-widget-position">';
			echo '<span class="gdlr-soccer-player-squad" >' . $player_options['player-info']['squad'] . '</span>';
			echo $player_options['player-info']['position'];
			echo '</div>';
			echo '</div>'; // feature-player-widget-title
			
			echo '<div class="feature-player-widget-info-wrapper">';
			if( !empty($player_options['player-info']['games-played']) || $player_options['player-info']['games-played'] === "0" ){
				echo '<div class="feature-player-widget-info">';
				echo '<span class="gdlr-head">' . $player_options['player-info']['games-played'] . '</span>';
				echo '<span class="gdlr-tail">' . __('Games Played', 'gdlr_translate') . '</span>';
				echo '</div>';
			}
			if( !empty($player_options['player-stats']['goals']) || $player_options['player-stats']['goals'] === "0" ){
				echo '<div class="feature-player-widget-info">';
				echo '<span class="gdlr-head">' . $player_options['player-stats']['goals'] . '</span>';
				echo '<span class="gdlr-tail">' . __('Goals', 'gdlr_translate') . '</span>';
				echo '</div>';			
			}
			if( !empty($player_options['player-stats']['assists']) || $player_options['player-stats']['assists'] === "0" ){
				echo '<div class="feature-player-widget-info">';
				echo '<span class="gdlr-head">' . $player_options['player-stats']['assists'] . '</span>';
				echo '<span class="gdlr-tail">' . __('Assists', 'gdlr_translate') . '</span>';
				echo '</div>';			
			}
			echo '</div>'; // feature-player-widget-info
			
			echo '<a class="feature-player-widget-link gdlr-button with-border" href="' . get_permalink($player[0]->ID) . '" >' . __('View Profile & Stats', 'gdlr_translate') . '</a>';
			echo '</div>'; // feature-player-widget-wrapper		
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$thumbnail_size = isset($instance['thumbnail_size'])? $instance['thumbnail_size']: '';
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'gdlr_translate'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>		

			<!-- Post Category -->
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select Player :', 'gdlr_translate'); ?></label>		
				<select class="widefat" name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>">
				<?php 	
				$category_list = gdlr_get_post_list('player'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo $cat_slug; ?>" <?php if ($category == $cat_slug) echo ' selected '; ?>><?php echo $cat_name; ?></option>				
				<?php } ?>	
				</select> 
			</p>
			
			<!-- Thumbnail Size -->
			<p>
				<label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e('Thumbnail Size :', 'gdlr_translate'); ?></label>		
				<select class="widefat" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" id="<?php echo $this->get_field_id('thumbnail_size'); ?>">
				<?php 	
				$thumbnails = gdlr_get_thumbnail_list();
				foreach($thumbnails as $th_slug => $th_name){ ?>
					<option value="<?php echo $th_slug; ?>" <?php if ($thumbnail_size == $th_slug) echo ' selected '; ?>><?php echo $th_name; ?></option>				
				<?php } ?>	
				</select> 
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['thumbnail_size'] = (empty($new_instance['thumbnail_size']))? '': strip_tags($new_instance['thumbnail_size']);

			return $instance;
		}	
	}
}
?>