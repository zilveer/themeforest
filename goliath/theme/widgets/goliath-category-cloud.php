<?php 
class GoliathCategoryCloud extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_category_cloud';
		$this->widget_description = __( 'Custom category cloud for Goliath', 'goliath' );
		$this->widget_idbase = 'goliath_category_cloud';
		$this->widget_name = __( 'Goliath Category Cloud', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_category_cloud', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		$cache = wp_cache_get('goliath_category_cloud', 'widget');

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

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Goliath Category Cloud', 'goliath') : $instance['title'], $instance, $this->id_base);
        $count = isset( $instance['count'] ) ? $instance['count'] : 20;
        
        $term_args = array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => intval($count),
        );
        $post_categories = get_terms('category', $term_args);
?>
        <?php echo $before_widget; ?>

			<div class="widget-tabs page-map">
				<div class="title-default">
					<span class="active"><?php echo esc_html($title); ?></span>
				</div>
				<div class="items archives">
					<table class="table">
                        <?php
                        if(!empty($post_categories))
                        {
                            $cats = array_chunk($post_categories, 2);
                            foreach($cats as $pc)
                            {                                
                                if(!empty($pc[0])) { $cat_one = get_category_by_slug($pc[0]->slug);}
                                if(!empty($pc[1])) { $cat_two = get_category_by_slug($pc[1]->slug);}
                                
                                echo '<tr>';
                                    echo '<td>';
                                    if(!empty($pc[0])) { echo '<a href="' . get_category_link($cat_one->cat_ID)  .'">' . $pc[0]->name . '</a>' . '<span>' . $pc[0]->count . '</span>'; }
                                    echo '</td>';
                                    
                                    echo '<td>';
                                    if(!empty($pc[1])) { echo '<td>' . '<a href="' . get_category_link($cat_two->cat_ID)  .'">' . $pc[1]->name . '</a>' .  '<span>' . $pc[1]->count . '</span>' . '</td>'; }
                                    echo '</td>';
                                echo '</tr>';
                            }
                        }
                            
                        
                        ?>
					</table>
				</div>
			</div>

        </div> <!-- After widget close div -->

        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_category_cloud', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_category_cloud']) )
			delete_option('goliath_category_cloud');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_category_cloud', 'widget');
	}

	function form( $instance ) 
    {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $count = isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : 20;
                
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'goliath' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e( 'Max count:' , 'goliath'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
        </p>
        <?php
	}
}