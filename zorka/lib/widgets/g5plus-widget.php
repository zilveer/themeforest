<?php
/**
 * Abstract G5Plus Widget Class
 *
 * @author      G5PlusThemes
 * @category    Widgets
 * @package     G5PlusThemes/Abstracts
 * @version     2.1.0
 * @extends     WP_Widget
 */
abstract class G5Plus_Widget extends WP_Widget {
	public $widget_cssclass;
	public $widget_description;
	public $widget_id;
	public $widget_name;
	public $settings;
	public $has_custom_class = true;

	/**
	 * Constructor
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => $this->widget_cssclass,
			'description' => $this->widget_description
		);
		if ($this->has_custom_class) {
			if (!isset($this->settings)) {
				$this->settings = array();
			}
			$this->settings['class_custom'] = array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__('Custom class','zorka')
			);
		}


		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	}

	/**
	 * get_cached_widget function.
	 */
	function get_cached_widget( $args ) {

		$cache = wp_cache_get( apply_filters( 'g5plus_cached_widget_id', $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo esc_html($cache[ $args['widget_id'] ]);
			return true;
		}

		return false;
	}

	/**
	 * Cache the widget
	 * @param string $content
	 */
	public function cache_widget( $args, $content ) {
		$cache[ $args['widget_id'] ] = $content;

		wp_cache_set( apply_filters( 'g5plus_cached_widget_id', $this->widget_id ), $cache, 'widget' );
	}

	/**
	 * Flush the cache
	 *
	 * @return void
	 */
	public function flush_widget_cache() {
		wp_cache_delete( apply_filters( 'g5plus_cached_widget_id', $this->widget_id ), 'widget' );
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( ! $this->settings ) {
			return $instance;
		}

		foreach ( $this->settings as $key => $setting ) {

			if ( isset( $new_instance[ $key ] ) ) {
				if ( current_user_can('unfiltered_html') ) {
					$instance[$key] =  $new_instance[$key];
				}
				else {
					$instance[$key] = stripslashes( wp_filter_post_kses( addslashes($new_instance[$key]) ) );
				}
			} elseif ( 'checkbox' === $setting['type'] ) {
				$instance[ $key ] = 0;
			}
		}
		$this->flush_widget_cache();

		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	public function form( $instance ) {

		if ( ! $this->settings ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {

			$value   = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			switch ( $setting['type'] ) {
				case "text" :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
					break;

				case "number" :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
					break;

				case "select" :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
					break;

				case "checkbox" :
					?>
					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
					</p>
					<?php
					break;

				case "icon":
					?>
					<div style="margin: 13px 0">
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?> </label>
						<div>
							<input style="width: 145px" type="text" class="input-icon" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr($value); ?>">
							<input style="float: right"  title="<?php esc_html_e('Click to browse icon','zorka') ?>" class="browse-icon button-secondary" type="button" value="<?php esc_html_e('Browse...','zorka') ?>" />
							<span style="vertical-align: top;width: 30px; height: 30px" class="icon-preview"><i class="fa <?php echo esc_attr( $value );  ?>"></i></span>
						</div>
					</div>
					<?php
					break;
				case "image":
					?>
					<div style="margin: 13px 0">
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?> </label>
						<div class="widget-image-field">
							<input type="text" class="input-icon" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" value="<?php echo esc_attr($value); ?>">
							<button style="float: right" title="<?php esc_html_e('Click to browse image','zorka') ?>" class="browse-images button-secondary" type="button"><?php esc_html_e('Browse...','zorka') ?></button>
						</div>
						<script type="text/javascript">
							//<![CDATA[
							jQuery(document).ready(function() {
								g5plus_media_init("#<?php echo esc_attr( $this->get_field_id( $key ) ); ?>",'.browse-images');
							});
							//]]>
						</script>
					</div>
					<?php
					break;
				case "text-area":
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<textarea class="widefat" rows="8" cols="40" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>"><?php echo esc_textarea($value); ?></textarea>
					</p>
					<?php
					break;
				case "thumbnail-size":
					global $_wp_additional_image_sizes;
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<select id="<?php echo esc_attr($this->get_field_id( $key )); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" class="widefat">
							<?php
							foreach ($_wp_additional_image_sizes as $size_name => $size_attr) { ?>
								<option value="<?php echo esc_attr($size_name); ?>" <?php selected($value,$size_name); ?>><?php echo ($size_name); ?></option>
							<?php	}
							?>
						</select>
					</p>
					<?php
					break;
			}
		}
	}
}