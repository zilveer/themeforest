<?php
class TFuse_Widget_Pages extends WP_Widget {

	function TFuse_Widget_Pages() {
		$widget_ops = array('classname' => 'widget_pages', 'description' => __( 'Your site&#8217;s WordPress Pages','tfuse') );
		$this->WP_Widget('pages', __('TFuse Pages','tfuse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Pages','tfuse') : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		$out = wp_list_pages( apply_filters('widget_pages_args', array('title_li' => '', 'echo' => 0, 'sort_column' => $sortby, 'exclude' => $exclude, 'link_before'  => '<span>','link_after'   => '</span>') ) );

		if ( !empty( $out ) ) {
            echo '<div class="widget-container widget_pages">';
            $title = tfuse_qtranslate($title);
            if ( $title) echo '<div class="widget_title clearfix"><h3 class="clearfix">'.$title.'</h3></div>'; ?>

            <ul><?php echo $out; ?></ul>
            <?php echo '</div>';
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}
		$instance['exclude'] = $new_instance['exclude'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	    ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:','tfuse' ); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title','tfuse'); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order','tfuse'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID' ,'tfuse'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude:','tfuse' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Page IDs, separated by commas.','tfuse' ); ?></small>
		</p>
<?php
	}
}

function TFuse_Unregister_WP_Widget_Pages() {
	unregister_widget('WP_Widget_Pages');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Pages');

register_widget('TFuse_Widget_Pages');