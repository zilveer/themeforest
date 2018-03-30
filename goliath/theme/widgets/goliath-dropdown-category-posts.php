<?php 
class GoliathDropdownCategoryPosts extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_dropdown_category_posts';
		$this->widget_description = __( 'Display dynamically switchabe post categories', 'goliath' );
		$this->widget_idbase = 'goliath_dropdown_category_posts';
		$this->widget_name = __( 'Goliath dropdown post categories', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_dropdown_category_posts', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
        global $post;
        
		$cache = wp_cache_get('goliath_dropdown_category_posts', 'widget');

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

        $categories = !empty( $instance['cats'] ) ? $instance['cats'] : array();
        $unique_id = uniqid();

        ?>

		<?php echo $before_widget; ?>
        
        <div class="dropdown-category-posts">
            
            <div class="sorting">
                <div class="label">
                    <?php _e('Showing', 'goliath'); ?>
                </div>
                <div class="tags">
                    <a href="#<?php echo esc_attr($unique_id); ?>_all" class="tag-1 active"><span><?php _e('All recent articles', 'goliath'); ?></span></a>
                    <?php if(!empty($categories)) {
                        foreach($categories as $cat)
                        {
                            $category = get_category_by_slug($cat);
                            echo '<a href="#' . esc_attr($unique_id) . '_' . esc_attr($category->slug) . '" class="tag-1"><span>' . $category->name . '</span></a>';
                        }
                    } ?>
                </div>
            </div>
            
            <?php
                
                array_unshift($categories, 'all');
                
                foreach($categories as $key => $category)
                {
                    $params = array();
                    if($category != 'all')
                    {
                        $params['category_name'] = $category;
                    }
                    
                    $items = plsh_get_post_collection($params, 4, 1);
                    
                    if(!empty($items))
                    {
                        echo '<div class="items" id="'  . esc_attr($unique_id) . '_' . esc_attr($category) . '">';
                        
                        foreach($items as $key => $post)
                        {
                            setup_postdata($post);
                            if($key == 0) { $post->_is_large = true; }
                            else { $post->_is_large = false; }

                            get_template_part( 'theme/templates/dropdown-featured-posts-item');
                        }
                        
                        echo '</div>';
                    }
                }
                
            ?>
            
        </div>
            
		</div>
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_dropdown_category_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
        $instance['cats'] = esc_sql($new_instance['cats']);
        
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_dropdown_category_posts']) )
			delete_option('goliath_dropdown_category_posts');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_dropdown_category_posts', 'widget');
	}

	function form( $instance ) 
    {
        //get post categories
        $post_categories = get_terms('category');
        foreach($post_categories as $pc)
        {
            $post_cats[$pc->slug] = $pc->slug;
        }

        $current_cats = (!empty( $instance['cats'] ) ? esc_sql( $instance['cats'] ) : array());
        
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'cats' )); ?>"><?php _e( 'Categories:', 'goliath' ); ?></label><br/>
                <select multiple="multiple" name="<?php echo esc_attr($this->get_field_name( 'cats' )); ?>[]" id="<?php echo esc_attr($this->get_field_id( 'cats' )); ?>" class="widefat">
                    <?php foreach($post_cats as $cat): ?>
                    <option value="<?php echo esc_attr($cat); ?>"<?php if(in_array($cat, $current_cats)) { echo ' selected="selected"'; } ?>><?php echo ucfirst($cat); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        <?php
	}
}