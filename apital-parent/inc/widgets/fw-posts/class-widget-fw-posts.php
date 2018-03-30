<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_FW_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Popular/Recent/Most Commented Posts.", "fw" ) );

		parent::__construct( false, __( 'Apital Posts', 'fw' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$title = '<div class="tittle-line tittle-sml-mg">
                    <h5>' . $params['title'] . '</h5>
                    <div class="divider-1 small">
                      <div class="divider-small"></div>
                    </div>
                  </div>';
		unset($params['title']);

		$filepath = dirname( __FILE__ ) . '/views/widget.php';

		$data = array(
			'instance'      => $params,
			'title'         => $title,
			'before_widget' => '<div class="space x2">',
			'after_widget'  => '</div>',
		);

		echo fw_render_view( $filepath, $data );
	}

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
        $instance['title'] = $new_instance['title'];
        $instance['posts_number'] = $new_instance['posts_number'];

		return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'posts_number' => 5, 'type' => 'recent', 'category' => 'all_categories') );
		$args = array(
			'type'    => 'post',
			'orderby' => 'name',
			'order'   => 'ASC',
		);
		$categories = get_categories( $args );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:' ,'fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_number')); ?>"><?php _e( 'Number of posts to show:' ,'fw'); ?></label>
            <input size="3" style="width: 45px;" class="widefat" id="<?php echo esc_attr($this->get_field_id('posts_number')); ?>" name="<?php echo esc_attr($this->get_field_name('posts_number')); ?>" type="text" value="<?php echo esc_attr($instance['posts_number']); ?>" />
        </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('type')); ?>"><?php _e( 'Select Type:','fw' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('type')); ?>" id="<?php echo esc_attr($this->get_field_id('type')); ?>" class="widefat">
				<option value="recent" <?php selected( $instance['type'], 'recent' ); ?>><?php _e('Recent Posts','fw'); ?></option>
				<option value="popular" <?php selected( $instance['type'], 'popular' ); ?>><?php _e('Popular Posts','fw'); ?></option>
				<option value="commented" <?php selected( $instance['type'], 'commented' ); ?>><?php _e('Most Commented Posts','fw'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e( 'Select Category:','fw' ); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('category')); ?>" id="<?php echo esc_attr($this->get_field_id('type')); ?>" class="widefat">
				<option value="" <?php selected( $instance['category'], '' ); ?>><?php _e('All Categories','fw'); ?></option>
				<?php foreach($categories as $category){ ?>
					<option value="<?php echo esc_attr($category->term_id); ?>" <?php selected( $instance['category'], $category->term_id ); ?>><?php echo esc_attr($category->name); ?></option>
				<?php } ?>
			</select>
		</p>
<?php
	}
}