<?php
/**
 *
 */

class MySite_SubNav_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_SubNav_Widget() {
        $widget_ops = array( 'classname' => 'mysite_subnav_widget', 'description' => __( 'Displays a list of SubPages', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 250, 'height' => 200 );
		$this->WP_Widget( 'subnav', sprintf( __( '%1$s - Sub Navigation', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
		global $post, $page_exclusions;
		
        extract( $args );
		
		$parent = $post->post_parent;
		
		$title = apply_filters('widget_title', empty($instance['title']) ? get_the_title($parent) : $instance['title'], $instance, $this->id_base);
				
		if( is_search() || is_404() || is_archive() || is_single() )
			return;	
		
    	$out = $before_widget; 

     	$out .= $before_title . $title . $after_title;

		$children = wp_list_pages("sort_column=menu_order&exclude=$page_exclusions&title_li=&child_of=" . $parent . "&echo=0&depth=1");
		$out .= '<ul>';
		$out .= $children;
		$out .= '</ul>';
		
		$out .= $after_widget;
	
		echo $out;
	}

	/**
	 *
	 */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <?php 
    }

}

?>