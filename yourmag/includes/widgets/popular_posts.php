<?php

/* Royal Popular Post Widget */
 
class Royal_PopularPost_Widget extends WP_Widget {
   
    function Royal_PopularPost_Widget() {
		global $themename;
		$widget_ops = array('classname' => 'popular-widget', 'description' => __( "Popular post widget with post thumbnails.", 'my-text-domain') );
		$control_ops = array('width' => 250, 'height' => 200);
		$this->WP_Widget('popularwidget', __('2) Royal Popular Posts', 'my-text-domain'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
		global $wpdb;
        extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts', 'my-text-domain') : $instance['title'], $instance, $this->id_base);
		
		if ( !$number = (int) $instance['number'] )
			$number = 3;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
			
		$disable_thumb = $instance['disable_thumb'] ? '1' : '0';
		
		$pop_posts =  $number;
		
		$now = gmdate("Y-m-d H:i:s",time());
		$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
		$popularposts = "SELECT ID, post_title, post_date, COUNT($wpdb->comments.comment_post_ID) AS 'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish' AND post_date < '$now' AND post_date > '$lastmonth' AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
		$posts = $wpdb->get_results($popularposts);
		$popular = '';

		echo $before_widget;
		echo $before_title . $title . $after_title;

		if($posts){ ?>

		<ul class="widget_recent_posts">
			<?php foreach($posts as $post){ 
					$post_title = stripslashes($post->post_title);
					$permalink = get_permalink($post->ID);
					$post_date = $post->post_date;
					$post_date = mysql2date('F j, Y', $post_date, true);
					$category = get_the_category($post->ID);
					$category_link = get_category_link($post->ID);
			?>
			<li>
				<?php if(!$disable_thumb) { ?>
				<a href="<?php echo $permalink; ?>">
				<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>	
				<span class="widget_thumbnail">
				<?php $image = aq_resize( $thumbnailSrc, 120, 85, true ); ?>
                <img src="<?php echo $image ?>" alt="<?php echo $post_title; ?>" title="<?php echo $post_title; ?>" />
				 </span>
				</a>
				<?php } ?>
				<div class="widget_info">
				<a class="widget_title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a>
				<div class="widget_date"><?php echo $post_date; ?></div>
			    </div>
			<div class="clear"></div>	
			</li>
				<?php } ?>
		</ul>
			<?php }
			
		echo $after_widget;
    }

    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['disable_thumb'] = !empty($new_instance['disable_thumb']) ? 1 : 0;
				
        return $instance;
    }

    function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumb = isset( $instance['disable_thumb'] ) ? (bool) $instance['disable_thumb'] : false;
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 3;
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'my-text-domain'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Enter the number of popular posts you'd like to display:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumb'); ?>" name="<?php echo $this->get_field_name('disable_thumb'); ?>"<?php checked( $disable_thumb ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumb'); ?>"><?php _e( 'Disable Post Thumbnail?', 'my-text-domain' ); ?></label></p>

        <?php
    }

}

add_action('widgets_init', create_function('', 'return register_widget("Royal_PopularPost_Widget");'));

?>