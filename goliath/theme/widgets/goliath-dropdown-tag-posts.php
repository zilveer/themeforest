<?php 
class GoliathDropdownTagPosts extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_dropdown_tag_posts';
		$this->widget_description = __( 'Display dynamically switchabe post tags', 'goliath' );
		$this->widget_idbase = 'goliath_dropdown_tag_posts';
		$this->widget_name = __( 'Goliath dropdown post tags', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_dropdown_tag_posts', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
        global $post;
        
		$cache = wp_cache_get('goliath_dropdown_tag_posts', 'widget');

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

        $tags = isset( $instance['tags'] ) ? $instance['tags'] : array();

        ?>

		<?php echo $before_widget; ?>
        
            <div class="sorting">
                <div class="label">
                    <?php _e('Showing', 'goliath'); ?>
                </div>
                <div class="tags">
                    <a href="#all" class="tag-1 active"><span><?php _e('All recent articles', 'goliath'); ?></span></a>
                    <?php if(!empty($tags)) {
                        foreach($tags as $tag)
                        {
							$tag_obj = get_term_by('slug', $tag, 'post_tag');
                            echo '<a href="#' . esc_attr($tag_obj->slug) . '" class="tag-1"><span>' . ucfirst($tag_obj->name) . '</span></a>';
                        }
                    } ?>
                </div>
            </div>
            
            <?php
                array_unshift($tags, 'all');
                
                foreach($tags as $key => $tag)
                {
                    $params = array();
                    if($tag != 'all')
                    {
                        $params['tag'] = $tag;
                    }
                    
                    $items = plsh_get_post_collection($params, 4, 1);
                    
                    if(!empty($items))
                    {
                        $display = '';
                        if($key > 0)
                        {
                            $display = 'style="display: none;"';
                        }

                        echo '<div class="items" id="' . $tag . '" ' . $display . '>';
                        
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
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_dropdown_tag_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
        $instance['tags'] = esc_sql($new_instance['tags']);
        
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_dropdown_tag_posts']) )
			delete_option('goliath_dropdown_tag_posts');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_dropdown_tag_posts', 'widget');
	}

	function form( $instance ) 
    {
        //get post tags
        $post_tax_tags = get_terms('post_tag');

        foreach($post_tax_tags as $pc)
        {
            $post_tags[$pc->slug] = $pc->slug;
        }

        $current_tags = !empty( $instance['tags'] ) ? $instance['tags'] : array();
        
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>"><?php _e( 'Tags:', 'goliath' ); ?></label><br/>
                <select multiple="multiple" name="<?php echo esc_attr($this->get_field_name( 'tags' )); ?>[]" id="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>" class="widefat">
                    <?php foreach($post_tags as $tag): ?>
                    <option value="<?php echo esc_attr($tag); ?>"<?php if(in_array($tag, $current_tags)) echo ' selected="selected"'; ?>><?php echo ucfirst($tag); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        <?php
	}
}