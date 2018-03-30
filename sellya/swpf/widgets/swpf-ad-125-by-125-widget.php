<?php

class SWPF_Ad_125_by_125_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SWPF_Ad_125_by_125_Widget', // Base ID  
                'Sellya Ad 125 by 125', // Name  
                array(
                    'description' => __('This widget will show your Ad 125 by 125','sellya')
                )
        );
    }
    public function form($instance){
        global $SWPF_FREAMWORK_DIRECTORY; 
        $defaults = array(
            'title' => 'Sellya Ad 125 by 125', 
            'image_url' => get_template_directory_uri().$SWPF_FREAMWORK_DIRECTORY."/image/ad_125_by_125.png", 
            'link_url' => 'http://smartdatasoft.com'); 
        $instance = wp_parse_args((array) $instance, $defaults);
        $image_url= esc_attr($instance['image_url']);
        $link_url= esc_attr($instance['link_url']);
        ?>
    
        <p>  
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:216px;" />  
        </p> 
        <p>  
            <label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image URL:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" value="<?php echo $image_url ?>" style="width:216px;" />  
        </p> 
        <p>  
            <label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e('Link URL:', 'sellya'); ?></label>  
            <input id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" value="<?php echo $link_url ?>" style="width:216px;" />  
        </p> 
        <?php
    }
    public function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image_url'] = strip_tags($new_instance['image_url']);
        $instance['link_url'] = strip_tags($new_instance['link_url']);
        return $instance;
    }
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $image_url=$instance['image_url'];
        $link_url=$instance['link_url'];
         extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
            
            
               	echo '<div class="swpf_125by125">';
		if ( !empty( $image_url ))
			echo '<a href="' . $link_url . '"><img src="' . $image_url . '" width="125" height="125" title="'.$title.'" /></a>';
			
		echo '</div>';
            echo $after_widget;
         
    }

}
add_action('widgets_init', create_function('', 'register_widget( "SWPF_Ad_125_by_125_Widget" );'));
?>