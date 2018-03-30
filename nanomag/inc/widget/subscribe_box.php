<?php
add_action('widgets_init','jellywp_subscribe_box_widget');


function jellywp_subscribe_box_widget(){
		register_widget("jellywp_subscribe_box");
}

class jellywp_subscribe_box extends WP_widget{

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

	function jellywp_subscribe_box(){
		$widget_ops = array( 'classname' => 'jellywp_subscribe_box', 'description' => esc_attr__( 'Email subscribe box' , 'nanomag') );
		parent::__construct('jellywp_subscribe_box', esc_attr__('jellywp: Email subscribe box', 'nanomag'), $widget_ops);
	}

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget($args,$instance){
	extract($args);		
		
		$title = $instance['title'];
		$feed_url = $instance['feed_url'];
		$feed_description = $instance['feed_description'];
		?>

		<div class="widget">
			<div class="email_subscribe_box <?php if(!of_get_option('disable_css_animation')==1){echo esc_attr("appear_animation");}?>">
				<?php if($title) { echo '<h2>'.esc_attr($title).'</h2>'; }?>	
		<div class="email_subscribe_box_content">
		<p><?php echo esc_attr($feed_description); ?></p>
<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feed_url); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
		     <input type="text" class="text" name="email" value="<?php _e('Your Email', 'nanomag'); ?>" onfocus="if(this.value=='<?php _e('Your Email', 'nanomag'); ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Your Email', 'nanomag'); ?>';"/>
		     <input type="hidden" name="loc" value="en_US"/>
			<input type="hidden" value="<?php echo esc_attr($feed_url); ?>" name="uri"/>
		     <input type="submit"  class="buttons" value="<?php esc_attr_e('Subscribe', 'nanomag');?>" />
                     </form>

                  </div>
			</div>
		</div>
		<?php
	
	}

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['feed_url'] = $new_instance['feed_url'];
		$instance['feed_description'] = $new_instance['feed_description'];
		
		return $instance;
	}



	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'Email Subscribe' , 'nanomag') , 'feed_description' => 'Mauris mattis auctor cursus. Phasellus tellus tellus, imperdiet ut imperdiet eu, iaculis a sem.', 'feed_url' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e( 'Title:', 'nanomag'); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('feed_description')); ?>"><?php esc_attr_e( 'Feed description:', 'nanomag'); ?></label>
			<textarea class="widefat" style="width: 100%; height:150px;" id="<?php echo esc_attr($this->get_field_id('feed_description')); ?>" name="<?php echo esc_attr($this->get_field_name('feed_description')); ?>"><?php echo esc_attr($instance['feed_description']); ?></textarea>
		</p>
        
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'feed_url' )); ?>"><?php esc_attr_e('feedburner name: (your name without http://feeds.feedburner.com/)', 'nanomag'); ?></label>
		<input width="100%" id="<?php echo esc_attr($this->get_field_id( 'feed_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'feed_url' )); ?>" value="<?php echo esc_attr($instance['feed_url']); ?>" class="widefat" />
		</p>
        
     
		<?php

	}
}
?>