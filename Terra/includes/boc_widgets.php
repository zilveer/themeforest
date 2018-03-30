<?php
        
function boc_load_widgets() {

    register_widget('boc_latest');
    register_widget('contact_info_widget');

}   



/**
 * Latest Posts Widget
 */
class boc_latest extends WP_Widget {

        function boc_latest() {
            $widget_ops = array('description' => 'Terra Latest Posts');
			$this->__construct('boc_latest', 'Terra Latest Posts', $widget_ops);
        }

        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            $title = empty($instance['title']) ? '&nbsp;' : '<span>'.apply_filters('widget_title', $instance['title']).'</span>';
            $count = $instance['count'];

            echo removeSpanFromTitle($before_title) . $title . removeSpanFromTitle($after_title);
            wp_reset_query();
            rewind_posts();

            $recent_posts = new WP_Query(
                array(
                    'posts_per_page' => $count,
                    'post_status' => 'publish',
                    'nopaging' => 0,
                    'post__not_in' => get_option('sticky_posts')
                    )
                );

            // Cycle through Posts    
            if ($recent_posts->have_posts()) :while ($recent_posts->have_posts()) : $recent_posts->the_post();
            ?>

            <div class="latest_post_sidebar clearfix">
                <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('small-thumb'); ?></a>
                <p class="latest_post_sidebar_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
                <p class="date"><?php echo get_the_date();?></p>
            </div>
                <?php
                endwhile;
                endif;
                wp_reset_query();
                rewind_posts();

                echo $after_widget;
            }

            function update($new_instance, $old_instance) {
                $instance = $old_instance;
                $instance['title'] = strip_tags($new_instance['title']);

                $instance['count'] = $new_instance['count'];

                return $instance;
            }

            function form($instance) {
                $instance = wp_parse_args((array) $instance, array('title' => ''));
                $title = strip_tags($instance['title']);

                $count = $instance['count'];
                ?>


                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:
                        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                    </label>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('count'); ?>">How many posts? (Number):
                        <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
                    </label>
                </p>

                <?php
            }

}


/**
 * Contact Info Widget
 */
class contact_info_widget extends WP_Widget {
	
	function contact_info_widget()
	{
		$widget_ops = array('classname' => 'contact_info', 'description' => '');
		$this->__construct('contact_info-widget', 'Terra: Contact Info', $widget_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		<?php if($instance['phone']): ?>
		<div class="icon_phone"><?php echo $instance['phone']; ?></div>
		<?php endif; ?>

		<?php if($instance['email']): ?>
		<div class="icon_mail"><?php echo $instance['email']; ?></div>
		<?php endif; ?>

		<?php if($instance['address']): ?>
		<div class="icon_loc"><?php echo $instance['address']; ?></div>
		<?php endif; ?>
		
		<div class="clear h10"></div>
		
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['web'] = $new_instance['web'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Contact Info');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">Phone:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>
	<?php
	}
} 