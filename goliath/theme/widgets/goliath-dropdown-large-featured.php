<?php 
class GoliathDropdownLargeFeatured extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_dropdown_large_featured';
		$this->widget_description = __( 'Display 3 featured posts with large thumbnails', 'goliath' );
		$this->widget_idbase = 'goliath_dropdown_large_featured';
		$this->widget_name = __( 'Goliath dropdown featured posts', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_dropdown_large_featured', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
        global $post;

        $cache = wp_cache_get('goliath_dropdown_large_featured', 'widget');

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

        $category = isset( $instance['cat'] ) ? $instance['cat'] : false;
        $tag = isset( $instance['tag'] ) ? $instance['tag'] : false;
        
        $params = array(
            'category_name' => $category,
            'tag' => $tag
        );
    
        $items = plsh_get_post_collection($params, 3, 1);
?>
		<?php echo $before_widget; ?>
        
        <?php if(!empty($items)) { ?>

            <div class="items">
                <?php
                    foreach($items as $key => $post)
                    {
                        setup_postdata($post);
                        if($key == 0) { $post->_is_large = true; }
                        else { $post->_is_large = false; }
                        
                        get_template_part( 'theme/templates/dropdown-featured-posts-item');
                    }
                ?>
            </div>

        <?php } ?>

		</div>
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_dropdown_large_featured', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
        $instance['cat'] = strip_tags($new_instance['cat']);
        $instance['tag'] = strip_tags($new_instance['tag']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_dropdown_large_featured']) )
			delete_option('goliath_dropdown_large_featured');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_dropdown_large_featured', 'widget');
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
        
        $current_cat = isset( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
        $current_tag = isset( $instance['tag'] ) ? esc_attr( $instance['tag'] ) : '';
        
        ?>
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
        <?php
	}
}