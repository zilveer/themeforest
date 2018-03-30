<?php

/**
 * Tag cloud widget class
 *
 * @since 2.8.0
 */
class Rentify_Widget_Tag_Cloud extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__( "A cloud of your most used tags.",'rentify') );
		parent::__construct('tag_cloud', esc_html__('Rentify Tag Cloud','rentify'), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = esc_html__('Tags','rentify');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo apply_filters( 'Tag_before',  $args['before_widget'] );

		if ( $title ) {
            echo apply_filters('Tag_before_title',$args['before_title']). esc_attr($title) . apply_filters('Tag_after_title',$args['after_title']);  
		}

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
?>
	<div class="widget-tag">
        <div class="tag-cloud">

<?php	
	wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', 
 
		array( 
			'taxonomy' =>$current_taxonomy
		)
		 ) );
?>

		</div>
    </div>
<?php

        echo apply_filters( 'Tag_after',  $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;
	}

	public function form( $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
	<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','rentify') ?></label>
	<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>"><?php esc_html_e('Taxonomy:','rentify') ?></label>
	<select class="widefat" id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
	<?php foreach ( get_taxonomies() as $taxonomy ) :
				$tax = get_taxonomy($taxonomy);
				if ( !$tax->show_tagcloud || empty($tax->labels->name) )
					continue;
	?>
		<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo esc_attr($tax->labels->name); ?></option>
	<?php endforeach; ?>
	</select></p><?php
	}

	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}


add_action('widgets_init', 'rentify_tag');

function rentify_tag(){
    register_widget('Rentify_Widget_Tag_Cloud');
}