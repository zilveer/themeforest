<?php 
class GoliathRecentPosts extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'recent-posts';
		$this->widget_description = __( 'Display a list of Recent posts', 'goliath' );
		$this->widget_idbase = 'goliath_recent_posts';
		$this->widget_name = __( 'Goliath Recent Posts', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_recent_posts', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		$cache = wp_cache_get('goliath_recent_entries', 'widget');

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
        global $post;

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'goliath') : $instance['title'], $instance, $this->id_base);
        $url = isset( $instance['url'] ) ? $instance['url'] : false;
        $count = isset( $instance['count'] ) ? $instance['count'] : false;
        $category = isset( $instance['cat'] ) ? $instance['cat'] : false;
        $tag = isset( $instance['tag'] ) ? $instance['tag'] : false;
        
        
        $params = array(
            'category_name' => $category,
            'tag' => $tag
        );
    
        $items = plsh_get_post_collection($params, $count, 1);
?>
        <?php echo $before_widget; ?>
        
            <!-- Latest reviews -->
            <div class="widget-tabs mobile">

                <div class="title-default">
                    <a href="<?php echo esc_url($url); ?>" class="active"><?php echo esc_html($title); ?></a>
                    <a href="<?php echo esc_url($url); ?>" class="view-all"><?php _e('View all', 'goliath'); ?></a>
                </div>

                <?php if(!empty($items)) { ?>

                <div class="items">
                    <?php
                        foreach($items as $post)
                        {
                            setup_postdata($post);
                            get_template_part( 'theme/templates/post-list-2-item-regular');
                        }
                    ?>
                </div>

                <?php } ?>

            </div>
        
        </div> <!-- After widget close div -->

        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);        
        $instance['count'] = strip_tags($new_instance['count']);
        $instance['cat'] = strip_tags($new_instance['cat']);
        $instance['tag'] = strip_tags($new_instance['tag']);
        $instance['url'] = strip_tags($new_instance['url']);
               
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_recent_posts']) )
			delete_option('goliath_recent_posts');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_recent_posts', 'widget');
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
        
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $count = isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : 6;
        $current_cat = isset( $instance['cat'] ) ? esc_attr( $instance['cat'] ) : '';
        $current_tag = isset( $instance['tag'] ) ? esc_attr( $instance['tag'] ) : '';
        $url = isset( $instance['url'] ) ? esc_attr( $instance['url'] ) : '#';
        
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:' , 'goliath'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>    
        
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e( 'Post count:' , 'goliath'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
            </p>
            
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'url' )); ?>"><?php _e( 'View more link:' , 'goliath'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_url($url); ?>" />
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
            	
<?php
	}
}