<?php 
class GoliathPostTabs extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_sidebar_post_tabs';
		$this->widget_description = __( 'Post tabs - latest, popular and recently commented posts ', 'goliath' );
		$this->widget_idbase = 'goliath_sidebar_post_tabs';
		$this->widget_name = __( 'Goliath Post Tabs', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_sidebar_post_tabs', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		$cache = wp_cache_get('goliath_sidebar_post_tabs', 'widget');

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

        $count = isset( $instance['count'] ) ? $instance['count'] : 5;
        
        $popular = plsh_get_popular_posts('weekly', $count);
        $commented = plsh_get_posts_with_latest_comments($count);
        $latest = plsh_get_post_collection(array(), $count);
        ?>

		<?php echo $before_widget; ?>
        
            <!-- Tabs -->
            <div class="widget-tabs switchable-tabs mobile">

                <div class="title-default">
                    <?php if(!empty($popular) && $popular !== false) { ?>
                    <a href="#" class="active"><?php _e('Popular', 'goliath' ); ?></a>
                    <?php } ?>

                    <?php if(!empty($latest)) { ?>
                    <a href="#"<?php if(!$popular) { echo ' class="active"'; } ?>><?php _e('Recent', 'goliath' ); ?></a>
                    <?php } ?>

                    <?php if(!empty($commented)) { ?>
                    <a href="#"><?php _e('Comments', 'goliath' ); ?></a>
                    <?php } ?>
                </div>

                <div class="tabs-content">
                    <?php
                    if(!empty($popular) && $popular !== false)
                    {
                        ?>
                            <div class="items">
                                <?php
                                foreach($popular as $item)
                                {
                                    $post = get_post($item->postid);
                                    if($post)
                                    {
                                        setup_postdata($post);
                                        get_template_part( 'theme/templates/post-list-2-item-regular');
                                    }
                                }
                                ?>
                            </div>
                        <?php
                    }
                    ?>

                    <?php
                    if(!empty($latest))
                    {
                        ?>
                            <div class="items">
                                <?php
                                foreach($latest as $post)
                                {
                                    setup_postdata($post);
                                    get_template_part( 'theme/templates/post-list-2-item-regular');
                                }
                                ?>
                            </div>
                        <?php
                    }
                    ?>

                    <?php
                    if(!empty($commented))
                    {
                        ?>
                            <div class="items">
                                <?php
                                foreach($commented as $post)
                                {
                                    setup_postdata($post);
                                    get_template_part( 'theme/templates/post-list-2-item-regular');
                                }
                                ?>
                            </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            
        </div> <!-- After widget close div -->
            
        <?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('goliath_sidebar_post_tabs', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;
		$instance['count'] = strip_tags($new_instance['count']);
        $instance['popular_range'] = strip_tags($new_instance['popular_range']);

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_sidebar_post_tabs']) )
			delete_option('goliath_sidebar_post_tabs');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_sidebar_post_tabs', 'widget');
	}

	function form( $instance ) 
    {
		$count = isset( $instance['count'] ) ? esc_attr( $instance['count'] ) : 6;
        $popular_range = isset( $instance['popular_range'] ) ? esc_attr( $instance['popular_range'] ) : 3;
        
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e( 'Post count:', 'goliath' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
            </p>
        
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'popular_range' )); ?>"><?php _e( 'Date range for popular items:', 'goliath' ); ?></label><br/>
                <select name="<?php echo esc_attr($this->get_field_name( 'popular_range' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'popular_range' )); ?>" class="widefat">
                    <option value="daily" <?php if($popular_range == 'daily') echo ' selected="selected"'; ?>>Today</option>
                    <option value="weekly" <?php if($popular_range == 'weekly') echo ' selected="selected"'; ?>>Last week</option>
                    <option value="monthly" <?php if($popular_range == 'monthly') echo ' selected="selected"'; ?>>Last month</option>
                    <option value="all" <?php if($popular_range == 'all') echo ' selected="selected"'; ?>>Since records began</option>
                </select>
            </p>
        
        <?php
	}
}