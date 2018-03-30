<?php
// Sub Navigation Widget
class Theme_Widget_Sub_Nav extends WP_Widget {

	function Theme_Widget_Sub_Nav() {
		$widget_ops = array('classname' => 'widget_sub_nav', 'description' => __( 'Displays a list of SubPages', 'theme_admin') );
		$this->WP_Widget('sub-nav', THEME_NAME . ' - ' . __('Sub Navigation', 'theme_admin'), $widget_ops);
	}

	function widget( $args, $instance ) {
		global $post;
		
		if( is_null( $post ) ) return;

		$children = wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );

		if ($children) {
			$parent = $post->ID;
		}else{
			$parent = $post->post_parent;
			if(!$parent){
				$parent = $post->ID;
			}
		}
		$parent_title = get_the_title($parent);
		
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];
		
		$output = wp_list_pages( array('title_li' => '', 'echo' => 0, 'child_of' =>$parent, 'sort_column' => 'menu_order', 'exclude' => $exclude, 'depth' => 1) );

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
		?>
		<ul>
			<li class="active disable-toggle">
				<a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a>
				<ul><?php echo $output; ?></ul>
			</li>
		</ul>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'theme_admin'); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude', 'theme_admin' ); ?>:</label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.' ,'theme_admin'); ?></small>
		</p>
<?php
	}
}
register_widget('Theme_Widget_Sub_Nav');