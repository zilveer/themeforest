<?php

/**
 * Archives widget class
 *
 * @since 2.8.0
 */
class Rentify_Widget_Archives extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_archive', 'description' => esc_html__( 'A monthly archive of your site&#8217;s Posts.','rentify') );
		parent::__construct('sb_archives', esc_html__('Rentify Archives','rentify'), $widget_ops);
	}

	public function widget( $args, $instance ) {
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Archives','rentify' ) : $instance['title'], $instance, $this->id_base );

		echo apply_filters( 'Tag_before',  $args['before_widget'] );
		
		if ( $title ) {
            echo apply_filters('Archives_before_title',$args['before_title']). esc_attr($title) . apply_filters('Archives_after_title',$args['after_title']);  
		}

		if ( $d ) {
			$dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
?>
		<label class="screen-reader-text" for="<?php echo esc_attr( $dropdown_id ); ?>"><?php echo esc_attr($title); ?></label>
		<select id="<?php echo esc_attr( $dropdown_id ); ?>" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			<?php
			/**
			 * Filter the arguments for the Archives widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_get_archives()
			 *
			 * @param array $args An array of Archives widget drop-down arguments.
			 */
			$dropdown_args = apply_filters( 'widget_archives_dropdown_args', array(
				'type'            => 'monthly',
				'format'          => 'option',
				'show_post_count' => $c
			) );

			switch ( $dropdown_args['type'] ) {
				case 'yearly':
					$label = esc_html__( 'Select Year','rentify' );
					break;
				case 'monthly':
					$label = esc_html__( 'Select Month','rentify' );
					break;
				case 'daily':
					$label = esc_html__( 'Select Day','rentify' );
					break;
				case 'weekly':
					$label = esc_html__( 'Select Week','rentify' );
					break;
				default:
					$label = esc_html__( 'Select Post','rentify' );
					break;
			}
			?>

			<option value=""><?php echo esc_attr( $label ); ?></option>
			<?php wp_get_archives( $dropdown_args ); ?>

		</select>
<?php
		} else {
?>
	<div class="list-widget">
		<ul>
<?php
		/**
		 * Filter the arguments for the Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_get_archives()
		 *
		 * @param array $args An array of Archives option arguments.
		 */
		wp_get_archives( apply_filters( 'widget_archives_args', array(
			'type'            => 'monthly',
			'show_post_count' => $c
		) ) );
?>
		</ul>
	</div>
<?php
		}

        echo apply_filters( 'Archhives_after',  $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','rentify'); ?></label> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo esc_attr($dropdown); ?> id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>" /> <label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php esc_html_e('Display as dropdown','rentify'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo esc_attr($count); ?> id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" /> <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Show post counts','rentify'); ?></label>
		</p>
<?php
	}
}

add_action('widgets_init', 'rentify_archives');

function rentify_archives(){
    register_widget('Rentify_Widget_Archives');
}

