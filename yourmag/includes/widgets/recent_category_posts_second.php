<?php

/* Royal Recent Category Post Widget - Second Variant */

 
class Royal_Recent_Category_Post_Second_Widget extends WP_Widget {

    function Royal_Recent_Category_Post_Second_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'custom-recent-category-widget-second', 'description' => __( "Recent category post widget - Second Variant", 'my-text-domain') );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget('recentcategorypostssecond', __('4) Royal Recent Category Posts - Second Variant', 'my-text-domain'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
		global $wpdb, $shortname;
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Category Posts - Second Variant', 'my-text-domain') : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
        $customcategory = $instance['customcategory'];
		$category_id = get_cat_ID( $customcategory );
		
        $disable_thumb = isset($_POST['value']) ? $_POST['value'] : ''; 

		$posts = get_posts("numberposts=$number&cat=$category_id&offset=0");

		echo $before_widget;
		echo $before_title . $title . $after_title;

		if($posts){ ?>

		<ul class="full_width_posts_widget">
			<?php foreach($posts as $post){
					$post_title = stripslashes($post->post_title);
					$permalink = get_permalink($post->ID);
					$post_date = $post->post_date;
					$post_date = mysql2date('F j, Y', $post_date, false);
					$category = get_the_category($post->ID);
					$category_link = get_category_link($post->ID);
			?>
			<li>
				<?php if(!$disable_thumb) { ?>
				<a href="<?php echo $permalink; ?>">
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
				<span class="widget_thumbnail_full">
				<?php $image = aq_resize( $thumbnailSrc, 360, 360, true ); ?>
                <img src="<?php echo $image ?>" alt="<?php echo $post_title; ?>" title="<?php echo $post_title; ?>" />
				</span>
				</a>
				<?php } ?>
				
				<div class="full_widget_info">
				<div class="full_widget_date"><?php echo $post_date; ?></div>
				<div class="clear"></div>
				<a class="full_widget_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a>
				
			    <?php $custom_read_more = get_post_meta($post->ID, 'r_custom_read_more', true); ?>
	            <?php if($custom_read_more !== '') { ?>
				
	                <div class="custom_read_more">
					
                    <?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	                <?php if($custom_rm_link !== '') { ?>
					<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
					<?php } else { ?>	
					<a href="<?php echo $permalink; ?>" title="<?php the_title(); ?>">					
	                <?php } ?>						
					
	                <?php echo $custom_read_more; ?> &raquo;
					</a>
                    </div>
					
	            <?php } else { ?>
				
	                <div class="custom_read_more">
					
					<?php $custom_rm_link = get_post_meta($post->ID, 'r_custom_rm_link', true); ?>
	                <?php if($custom_rm_link !== '') { ?>
					<a href="<?php echo $custom_rm_link; ?>" title="<?php the_title(); ?>" target="_blank">
					<?php } else { ?>	
					<a href="<?php echo $permalink; ?>" title="<?php the_title(); ?>">					
	                <?php } ?>	
					
					<?php echo get_option('op_read_more'); ?>
					</a>

                    </div>
					
				<?php } ?>
					
			    </div>
			<div class="clear"></div>
			</li>

				<?php } ?>
		</ul>
			<?php }	
			
		echo $after_widget;
    }

	function update($new_instance, $old_instance) {
	return $new_instance;
	}


    function form($instance) {				
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$customcategory = esc_attr($instance['customcategory']);

		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;	
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my-text-domain'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('customcategory'); ?>"><?php _e('Blog Category:','mediapress'); ?></label>
            <?php
            //Access the WordPress Categories via an Array
			$dd_categories = array();
			$dd_categories_obj = get_categories('hide_empty=0');
			foreach ($dd_categories_obj as $dd_cat) {
    			$dd_categories[$dd_cat->cat_ID] = $dd_cat->cat_name;}
			$categories_tmp = array_unshift($dd_categories, "Select a category:");
            ?>
            <select id="<?php echo $this->get_field_id('customcategory'); ?>" name="<?php echo $this->get_field_name('customcategory'); ?>">
			<?php
			//DISPLAY SELECT OPTIONS
			foreach ($dd_categories as $dd_category) {
				if ($customcategory == $dd_category) {
					$selected_option = 'selected="selected"';
				} else {
					$selected_option = '';
				} ?>
				<option value="<?php echo $dd_category; ?>" <?php echo $selected_option; ?>><?php echo $dd_category; ?></option>
				<?php
			} ?>
			</select>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of recent posts you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>

        <?php 
    }

}

add_action('widgets_init', create_function('', 'return register_widget("Royal_Recent_Category_Post_Second_Widget");'));

?>
