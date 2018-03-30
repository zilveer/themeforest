<?php
class widget_submit extends WP_Widget {

	function widget_submit() {
        /*Constructor*/
		$widget_ops = array( 'classname' => 'widget_submit' , 'description' => __( 'Logged users can submit content' , 'cosmotheme' ) );
		$this->__construct( 'widget_cosmo_submit' , _TN_ . ' : ' . __( 'Submit Content' , 'cosmotheme' ) , $widget_ops );
	}

	function widget( $args , $instance ) {
        /* prints the widget*/
		extract($args, EXTR_SKIP);

        if( isset( $instance['title'] ) ){
            $title = $instance['title'];
        }else{
            $title = '';
        }

        echo $before_widget;
		if(is_numeric(options::get_value( 'upload' , 'post_item_page' )) && options::get_value( 'upload' , 'post_item_page' ) > 0){
			 
			if( options::logic( 'general' , 'user_register' ) ){
				if( is_user_logged_in () ){
					?><p><a href="<?php  echo get_page_link(options::get_value( 'upload' , 'post_item_page' ));  ?>"><i class="icon-add"></i><span><?php echo $title ?></span></a></p><?php
				}else{
					?><p><a href="javascript:void(0)" onclick="get_login_box('')"><i class="icon-add"></i><span><?php echo $title ?></span></a></p><?php
				}
			}else{
				?><p><?php _e( 'User register option is disabled' , 'cosmotheme' ); ?></p><?php
			}
        }else{
			echo '<p>'._e('Please select submition page from theme settings','cosmotheme').'</p>'; 
		}
        echo $after_widget;
	}

	function update( $new_instance , $old_instance ) {
        /* save the widget */
		$instance = $old_instance;
        $instance['title']              = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
        /* widgetform in backend */
        if( isset( $instance['title'] ) ){
            $title  = strip_tags( $instance['title'] );
        }else{
            $title = '';
        }

        ?>
		    <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','cosmotheme') ?>:
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
			
        <?php
		if(is_numeric(options::get_value( 'upload' , 'post_item_page' )) && options::get_value( 'upload' , 'post_item_page' ) > 0){
			 echo '<p>'._e('Please select submition page from theme settings','cosmotheme').'</p>'; 
		}	
        if( !options::logic( 'general' , 'user_register' ) ){
            ?><p><?php _e( 'User register option is disabled' , 'cosmotheme' ); ?></p><?php
        }
	}
}
?>