<?php

class SearchWidget extends WP_Widget {
    function SearchWidget() {
        parent::WP_Widget(false, $name = 'Skeleton Search');	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
              <form id="searchform" action="/index.php" method="get" role="search">
				<div>
				<label class="screen-reader-text" for="s">Search for:</label>
				<input id="s" type="text" name="s" placeholder="Type to search...">
				<input id="searchsubmit" type="submit" value="Search">
				</div>
			  </form>
              <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);		
        return $instance;
    }

    function form($instance) {				
        $title = esc_attr($instance['title']);        
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'skeleton'); ?> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
                       
        <?php 
    }

} 

?>