<?php
/*---------------------------------------------------------------------------------*/
/* Ads Widget */
/*---------------------------------------------------------------------------------*/

class AdWidget_300 extends WP_Widget {

	function AdWidget_300() {
		$widget_ops = array('description' => 'Use this widget to add Ad as a widget.' );
		parent::WP_Widget(false, __('Themnific - Ads Widget 300px', 'themnific'),$widget_ops);      
	}

	function widget($args, $instance) {  
		$title = $instance['title'];
		$adcode = $instance['adcode'];
		$image = $instance['image'];
		$href = $instance['href'];
		$alt = $instance['alt'];

        echo '';

		if($title != '')
			echo '<h2 class="widget-single inn">'.$title.'</h2>';

		if($adcode != ''){
		?>
		
		<?php echo $adcode; ?>
		
		<?php } else { ?>
			<a href="<?php echo $href; ?>"><img class="ad300 rad" src="<?php echo $image; ?>" alt="<?php echo $alt; ?>" /></a>
			<div style="clear: both;"></div>
		<?php
		}
		
		echo '';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form($instance) {    
	
		$defaults = array('title' => '', 'adcode' => '', 'image' => '', 'href' => '', 'alt' => '');
		$instance = wp_parse_args((array) $instance, $defaults);
			    
		$title = esc_attr($instance['title']);
		$adcode = esc_attr($instance['adcode']);
		$image = esc_attr($instance['image']);
		$href = esc_attr($instance['href']);
		$alt = esc_attr($instance['alt']);
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','themnific'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Ad Code:','themnific'); ?></label>
            <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
        </p>
        <p><strong>or</strong></p>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','themnific'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','themnific'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo $href; ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','themnific'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
} 

register_widget('AdWidget_300');
?>