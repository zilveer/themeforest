<?php
    class widget_testimonials extends WP_Widget{
        function widget_testimonials() {
            $options = array( 'classname' => 'testimonials-view', 'description' => __('Display latest Testimonials' , 'cosmotheme' ) );
            parent::__construct( 'widget_cosmo_testimonials' , _TN_ . ' : ' . __( 'Latest Testimonials' , 'cosmotheme' )  , $options );

        }

        function form($instance) {

            if( isset($instance['title']) ){
                $title = esc_attr($instance['title']);
            }else{
                $title = __( 'Testimonials' , 'cosmotheme' );
            }

            
            if( isset( $instance['testimonials_ids'] ) ){
                $testimonials_ids = $instance['testimonials_ids'];
            }else{
                $testimonials_ids = array();
            }
        ?>
        <p>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e( 'Title' , 'cosmotheme' ); ?>:</label>
          <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <!-- field for testimonials -->
        <p>
            <select name="<?php echo $this->get_field_name('testimonials_ids'); ?>[]" id="<?php echo $this -> get_field_id('testimonials_ids'); ?>" multiple="multiple" style="height:200px !important;">
                
                <?php
                    $args = array('post_type' => 'testimonial', 'posts_per_page' => -1);
                    $testimonials = new WP_Query($args);
                    if(is_array($testimonials->posts) && sizeof($testimonials->posts)){
                        foreach ($testimonials->posts as $testimonial) { //var_dump($testimonial);
                ?>
                        <option value="<?php echo $testimonial->ID; ?>" <?php if(in_array($testimonial->ID, $testimonials_ids)){echo 'selected="selected"';}  ?>><?php echo $testimonial->post_name?></option>
                <?php        
                        }
                    }
                ?>
                
            </select>
        </p>
       
        <?php
        }

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title']      = strip_tags($new_instance['title']);
            
            $instance['testimonials_ids'] = array(); /*reset old values*/
            foreach ($new_instance['testimonials_ids'] as $testimonials_id) {
                $instance['testimonials_ids'][] = $testimonials_id;
            }
            
            return $instance;
        }

        function widget($args, $instance) {

            extract( $args );

            /* widget title */
            if( !empty( $instance['title'] ) ){
               $title = apply_filters('widget_title', $instance['title']);
            }else{
               $title = '';
            }

            /*testimonials IDs*/           
            if( isset( $instance['testimonials_ids'] ) ){
                $testimonials_ids = $instance['testimonials_ids'];
            }else{
                $testimonials_ids = array();
            }

            echo $before_widget;

            if ( strlen( $title ) ) {
                    echo $before_title . $title . $after_title;
            }

            get_testimonials($testimonials_ids = $testimonials_ids, $use_skins = false);

            echo $after_widget;
        }
    }
?>