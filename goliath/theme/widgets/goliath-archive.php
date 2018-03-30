<?php 
class GoliathArchive extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_archive';
		$this->widget_description = __( 'List of months with posts and the corresponding number of posts', 'goliath' );
		$this->widget_idbase = 'goliath_archive';
		$this->widget_name = __( 'Goliath Monthly Archive', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_archive', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		$cache = wp_cache_get('goliath_archive', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Goliath Monthly Archive', 'goliath') : $instance['title'], $instance, $this->id_base);
?>
		<?php echo $before_widget; ?>
        
            <!-- Archive -->
            <div class="widget-tabs">
                <div class="title-default">
                    <span class="active"><?php echo esc_html($title); ?></span>
                </div>
                <div class="items archives">
                    <ul>
                    <?php 
                        $params = array(
                            'type'            => 'monthly',
                            'limit'           => '',
                            'format'          => 'html', 
                            'before'          => '',
                            'after'           => '',
                            'show_post_count' => true,
                            'echo'            => true,
                            'order'           => 'DESC'
                        );
                        wp_get_archives( $params ); 
                    ?>
                    </ul>
                </div>
            </div>

		</div> <!-- After widget close div -->
        
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_archive', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_archive']) )
			delete_option('goliath_archive');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_archive', 'widget');
	}

	function form( $instance ) 
    {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        
        ?>
            <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'goliath' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <?php
	}
}