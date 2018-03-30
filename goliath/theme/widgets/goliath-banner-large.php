<?php 
class GoliathBannerLarge extends WP_Widget {

    var $widget_cssclass;
	var $widget_description;
	var $widget_idbase;
	var $widget_name;
    
	function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'goliath_sidebar_banner';
		$this->widget_description = __( '300x250px banner', 'goliath' );
		$this->widget_idbase = 'goliath_sidebar_banner';
		$this->widget_name = __( 'Goliath Large Banner', 'goliath' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		/* Create the widget. */
		parent::__construct('goliath_sidebar_banner', $this->widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	function widget($args, $instance) 
    {
		$cache = wp_cache_get('goliath_sidebar_banner', 'widget');

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

        $banner_string = isset( $instance['banner'] ) ? esc_attr( $instance['banner'] ) : '';
        $current_banners = explode('#', $banner_string);
        
        if(!empty($current_banners))
        {
            $rand = rand(0, sizeof($current_banners)-1);    //banner rotation
            $banner = $current_banners[$rand];
            $banner_data = plsh_get_banner_by_size_and_slug($banner, '300x250');

            if($banner_data)
            {
                ?>
                <?php echo $before_widget; ?>

                <div class="banner-300x250">
                    <?php if($banner_data['ad_type'] == 'banner') { ?>
                        <a href="<?php echo esc_url($banner_data['ad_link']); ?>" target="_blank"><img src="<?php echo esc_url($banner_data['ad_file']); ?>" alt="<?php echo esc_attr($banner_data['ad_title']); ?>"></a>
                    <?php } elseif($banner_data['ad_type'] == 'iframe') { ?>
                        <iframe class="iframe-300x250" scrolling="no" src="<?php echo $banner_data['ad_iframe_src']; ?>"></iframe>
                    <?php } else {
                        echo stripslashes($banner_data['googlead_content']);
                    } ?>    
                </div>

                </div> <!-- After widget close div -->
                <?php
            }
        }
        
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('goliath_sidebar_banner', $cache, 'widget');

	}

	function update( $new_instance, $old_instance ) 
    {
		$instance = $old_instance;        
        $instance['banner'] = implode('#', array_keys($new_instance));

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['goliath_sidebar_banner']) )
			delete_option('goliath_sidebar_banner');

		return $instance;
	}

	function flush_widget_cache() 
    {
		wp_cache_delete('goliath_sidebar_banner', 'widget');
	}

	function form( $instance ) 
    {
		$banner_string = isset( $instance['banner'] ) ? esc_attr( $instance['banner'] ) : '';
        $current_banners = explode('#', $banner_string);
        
        $banners = plsh_get_active_banners('300x250');
        $ad_url = admin_url( 'admin.php?page=' . plsh_gs('theme_slug') . '-admin&view=ads_manager' );
        
        if(!empty($banners))
        {
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'banner' )); ?>"><?php _e( 'Banners:', 'goliath' ); ?></label><br/>
                
                <?php foreach($banners as $banner): ?>
                    <?php $checked = (in_array($banner['ad_slug'], $current_banners) ? 'checked' : ''); ?>
                    <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( $banner['ad_slug'] )); ?>" name="<?php echo esc_attr($this->get_field_name( $banner['ad_slug'] )); ?>" <?php echo $checked; ?> /><label for="<?php echo esc_attr($this->get_field_id( $banner['ad_slug'] )); ?>"><?php echo ucfirst($banner['ad_title']); ?></label><br/>
                <?php endforeach; ?>

            </p>
            <?php
        }
        else
        {            
            echo '<p>'
                . __('There are no active ads for this location. ', 'goliath')
                . __('Supports: ', 'goliath') .'300x250px ads. '
                . '<strong><a href="' . $ad_url . '">' . __('Create a new Ad!', 'goliath')  . '</a></strong>'
            .'</p>';
        }
	}
}