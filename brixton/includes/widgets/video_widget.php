<?php
/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'video_widget' );
/* Function that registers our widget. */
function video_widget() {
	register_widget( 'videos' );
}
class videos extends WP_Widget {
	function videos() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'videos', 'description' => 'Displays the post image and title.');
		/* Create the widget. */
		parent::__construct( 'videos-widget','Brixton - Premium Video', $widget_ops, '' );
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
		
	}
	function widget( $args, $instance ) {
		global $pmc_data;
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget; 
		
		if ( $title ) echo $before_title . $title . $after_title;  ?>
		<style scoped>
		.widget.videos .self.id-<?php echo $this->id; ?>  .wttitle{margin-top: -<?php echo $instance['text-top']; ?>}
		<?php if(!empty($instance['self_video']) && !empty($instance['display_text'])) { ?>
			.widget.videos .self a{background:#fff; width:100%; floaT:left; padding:20px 0; text-align:center; opacity:0.4}
			.widget.videos .widgett.self{margin:0;}		
		<?php } ?>
		</style>
		<div class="widgett <?php if(!empty($instance['self_video'])) echo 'self'; ?> id-<?php echo $this->id; ?>">	
			<div class="video">
					<?php
					if(empty($instance['self_video'])){
						$embed_code = wp_oembed_get(esc_url($instance['video']));
					} else {
						$embed_code = wp_video_shortcode(array('src' => esc_url($instance['video']),'autoplay'=>$instance['auto_play'],'poster' => $instance['image']));
					}
					echo $embed_code ;
					?>
				</div>
				<?php if(!empty($instance['display_text'])) { ?>
					<div class="wttitle"><a target="_blank" href="<?php echo $instance['link']; ?>" rel="bookmark" title="Permanent Link to <?php echo $instance['text']; ?>"><?php echo $instance['text'];?></a></div>
				<?php } ?>
		</div>	
			
		
		
		
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video'] = $new_instance['video'];		
		$instance['link'] = $new_instance['link'];
		$instance['text'] = $new_instance['text'];
		$instance['text-top'] = $new_instance['text-top'];		
		$instance['display_text'] = $new_instance['display_text'];		
		$instance['self_video'] = $new_instance['self_video'];		
		$instance['auto_play'] = $new_instance['auto_play'];				
		$instance['image'] = $new_instance['image'];
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Brixton Video', 'video' => 'https://www.youtube.com/watch?v=35YZkJaDhh8', 'text' => 'Brixton Video Text', 'text-top' => '200px');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<script>
		jQuery(document).ready(function($) {
			$(document).on("click", ".upload_image_button", function() {

				jQuery.data(document.body, 'prevElement', $(this).prev());

				window.send_to_editor = function(html) {
					var imgurl = jQuery(html).find('img').attr('src');
					var inputText = jQuery.data(document.body, 'prevElement');
					if(inputText != undefined && inputText != '')
					{
						inputText.val(imgurl);
					}

					tb_remove();
				};

				tb_show('', 'media-upload.php?type=image&TB_iframe=true');
				return false;
			});
		});		
		</script>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'video' ); ?>">Video URL:</label>
			<input class="widefat"  id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" value="<?php echo esc_attr($instance['video']); ?>" />
			<br /><small>(Youtube or Vimeo or self hosted)</small>
		</p>
		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'self_video' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'self_video' ); ?>" name="<?php echo $this->get_field_name( 'self_video' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'self_video' ); ?>">Self hosted video (formats : 'mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv')?</label>
		</p>
        <p>
            <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image cover for self hosted video:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $instance['image'] ); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>		
		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'auto_play' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'auto_play' ); ?>" name="<?php echo $this->get_field_name( 'auto_play' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'auto_play' ); ?>">Auto play (only for self hosted video)?</label>
		</p>		
		<p>
		<input class="checkbox" type="checkbox" <?php checked( $instance[ 'display_text' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'display_text' ); ?>" name="<?php echo $this->get_field_name( 'display_text' ); ?>" /> 
		<label for="<?php echo $this->get_field_id( 'display_text' ); ?>">Display Text with link?</label>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>">Link URL:</label>
			<input class="widefat"  id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_attr($instance['link']); ?>" />
			<br /><small>(Link for the text)</small>
		</p>			
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>">Text:</label>
			<input class="widefat"  id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" value="<?php echo esc_attr($instance['text']); ?>" />
			<br /><small>(Text over the video)</small>
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'text-top' ); ?>">Text bottom margin:</label>
			<input class="widefat"  id="<?php echo $this->get_field_id( 'text-top' ); ?>" name="<?php echo $this->get_field_name( 'text-top' ); ?>" value="<?php echo esc_attr($instance['text-top']); ?>" />
			<br /><small>(Bottom margin for text with px (200px))</small>
		</p>		
		<?php
	}
	public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');

    }

}


?>
