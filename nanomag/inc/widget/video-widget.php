<?php
add_action('widgets_init','jellywp_video_widgets');

function jellywp_video_widgets(){
		register_widget("jellywp_video_widget");
}

class jellywp_video_widget extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function __construct(){	
		$widget_ops = array( 'classname' => 'video_embed_widget', 'description' => esc_attr__( 'paste video url for display (youtube, vimeo).', 'nanomag') );
		parent::__construct('jellywp_video_widget', esc_attr__('jellywp: Video embed widget', 'nanomag'), $widget_ops);
			
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
		extract($args);
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$video_url = apply_filters( 'widget_title', $instance['video_url'] );
		$video_height = apply_filters( 'widget_title', $instance['video_height'] );	
		
		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>

<div class="widget_container">		
		<?php jelly_embed_video_url($video_url, 300, $video_height);?>				
     <div class="clear"></div>
    </div>
    				

			<?php
			echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['video_url'] = strip_tags($new_instance['video_url']);
		$instance['video_height'] = strip_tags($new_instance['video_height']);	
		return $instance;
	}



	function form($instance){
		?>
		<?php
			$defaults = array( 'title'=> esc_attr__( '', 'nanomag'), 'video_url' => '', 'video_height' => 200);
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag'  ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('video_url')); ?>"><?php esc_attr_e( 'Video URL( Vimeo/Youtube ) :', 'nanomag'  ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('video_url')); ?>" name="<?php echo esc_attr($this->get_field_name('video_url')); ?>" type="text" value="<?php echo esc_attr($instance['video_url']); ?>" />
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('video_height')); ?>"><?php esc_attr_e( 'Video Height :', 'nanomag'  ); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('video_height')); ?>" name="<?php echo esc_attr($this->get_field_name('video_height')); ?>" type="text" value="<?php echo esc_attr($instance['video_height']); ?>" />
		</p>
		
		
		
		
		<?php

	}
}
?>