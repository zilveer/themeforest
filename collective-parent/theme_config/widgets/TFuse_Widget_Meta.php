<?php
class TFuse_Widget_Meta extends WP_Widget {

	function TFuse_Widget_Meta() {
		$widget_ops = array('classname' => 'widget_meta', 'description' => __( "Log in/out, admin, feed and WP links","tfuse") );
		$this->WP_Widget('meta', __('TFuse Meta','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Meta','tfuse') : $instance['title'], $instance, $this->id_base);

		$before_widget = ' <div class="widget-container widget_meta">';
		$after_widget = '</div>';
		$before_title = '<div class="widget_title clearfix"><h3 class="clearfix">';
		$after_title = '</h3></div>';

		echo $before_widget;
		$title = tfuse_qtranslate($title);
		if ( $title ) echo $before_title . $title . $after_title;
        ?>
			<ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php echo esc_attr(__('Syndicate this site using RSS 2.0','tfuse')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
                <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php echo esc_attr(__('The latest comments to all posts in RSS','tfuse')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
                <li><a href="http://wordpress.org/" title="<?php echo esc_attr(__('Powered by WordPress, state-of-the-art semantic personal publishing platform.','tfuse')); ?>">WordPress.org</a></li>
                <?php wp_meta(); ?>
			</ul>
    <?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
        ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

    <?php
	}
}

function TFuse_Unregister_WP_Widget_Meta() {
	unregister_widget('WP_Widget_Meta');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Meta');

register_widget('TFuse_Widget_Meta');