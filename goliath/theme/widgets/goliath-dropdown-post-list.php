<?php 
class GoliathDropdownPostList extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_dropdown_post_list';
		$this->widget_description = __( 'Display list of posts with thumbnails', 'goliath' );
		$this->widget_idbase = 'goliath_dropdown_post_list';
		$this->widget_name = __( 'Goliath dropdown post list', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_dropdown_post_list', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		global $post;
        
        $cache = wp_cache_get('goliath_dropdown_post_list', 'widget');

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
        		
		$count = isset( $instance['count'] ) ? $instance['count'] : false;
        $category = isset( $instance['cat'] ) ? $instance['cat'] : false;
        $tag = isset( $instance['tag'] ) ? $instance['tag'] : false;
        $more = isset( $instance['more'] ) ? $instance['more'] : '';
        
        $params = array(
            'category_name' => $category,
            'tag' => $tag
        );
            
        $items = plsh_get_post_collection($params, $count, 1);        
        
?>
		<?php echo $before_widget; ?>
        
            <?php if(!empty($items)) { ?>

            <div class="post-block-1 dropdown-post-list">
				<!-- Widget items START -->
                <div class="items">
                    <?php
                    $counter = 1;
                    $closed = true;
                    foreach($items as $post)
                    {
                        setup_postdata($post);
                        if($counter%2 == 1) //odd
                        {
                            echo '<div class="dropdown-row-wrapper">';
                            get_template_part( 'theme/templates/dropdown-post-list-item');
                            $closed = false;
                        }
                        else    //odd
                        {
                            get_template_part( 'theme/templates/dropdown-post-list-item');
                            echo '</div>';
                            $closed = true;
                        }
                        
                        $counter++;
                    }
                    
                    if(!$closed)
                    {
                        echo '</div>';
                    }
                    ?>
                </div>
                <!-- Widget items END -->
            </div>

            <?php if($more != '') { ?>
                <button type="button" class="btn btn-default center-block" onclick="window.location='<?php echo esc_url($more); ?>';"><span><?php _e('see more stories', 'goliath'); ?></span></button>
            <?php } ?>

            <?php } ?>
            
		</div>
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_dropdown_post_list', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['count'] = strip_tags($new_instance['count']);
        $instance['cat'] = strip_tags($new_instance['cat']);
        $instance['tag'] = strip_tags($new_instance['tag']);
        $instance['more'] = strip_tags($new_instance['more']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_dropdown_post_list']) )
			delete_option('goliath_dropdown_post_list');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_dropdown_post_list', 'widget');
	}

	function form( $instance ) 
    {
		
        //get post categories
        $post_categories = get_terms('category');
        $post_cats = array('' => '');    //blank entry
        foreach($post_categories as $pc)
        {
            $post_cats[$pc->slug] = $pc->slug;
        }

        //get post tags
        $post_tax_tags = get_terms('post_tag');
        $post_tags = array('' => ''); //blank entry
        foreach($post_tax_tags as $pt)
        {
            $post_tags[$pt->slug] = $pt->slug;
        }
        
        $count = isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : 6;
        $current_cat = isset( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
        $current_tag = isset( $instance['tag'] ) ? esc_attr( $instance['tag'] ) : '';
        $more = isset( $instance['more'] ) ? esc_attr( $instance['more'] ) : '';
        
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e( 'Items par page:', 'goliath' ); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" class="widefat">
                    <option value="2"<?php if($count == 2) echo ' selected="selected"'; ?>>2 items</option>
                    <option value="4"<?php if($count == 4) echo ' selected="selected"'; ?>>4 items</option>
                    <option value="6"<?php if($count == 6) echo ' selected="selected"'; ?>>6 items</option>
                    <option value="8"<?php if($count == 8) echo ' selected="selected"'; ?>>8 items</option>
                    <option value="10"<?php if($count == 10) echo ' selected="selected"'; ?>>10 items</option>
                    <option value="12"<?php if($count == 12) echo ' selected="selected"'; ?>>12 items</option>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'cat' )); ?>"><?php _e( 'Category:', 'goliath' ); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name( 'cat' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'cat' )); ?>" class="widefat">
                    <?php foreach($post_cats as $cat): ?>
                        <option value="<?php echo esc_attr($cat); ?>"<?php if($cat == $current_cat) echo ' selected="selected"'; ?>><?php echo ucfirst($cat); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'tag' )); ?>"><?php _e( 'Tag:', 'goliath' ); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name( 'tag' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'tag' )); ?>" class="widefat">
                    <?php foreach($post_tags as $tag): ?>
                    <option value="<?php echo esc_attr($tag); ?>"<?php if($tag == $current_tag) echo ' selected="selected"'; ?>><?php echo ucfirst($tag); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'more' )); ?>"><?php _e( 'More posts link:', 'goliath' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'more' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'more' )); ?>" type="text" value="<?php echo esc_url($more); ?>" />
            </p>
        
        <?php
	}
}