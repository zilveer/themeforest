<?php
    class widget_tags extends WP_Widget {

        function widget_tags() {
            $widget_ops = array( 'classname' => 'widget_tabber' , 'description' => __( 'Tags' , 'cosmotheme' ) );
            $this -> __construct( 'widget_cosmo_tags' , _TN_ . ' : ' . __( 'Tags' , 'cosmotheme' ) , $widget_ops );
        }

        function widget( $args , $instance ) {

            /* prints the widget*/
            extract($args, EXTR_SKIP);

            if( isset( $instance['title'] ) ){
                $title = $instance['title'];
            }else{
                $title = '';
            }

			if( isset( $instance['nr_tags'] ) ){
                $nr_tags = $instance['nr_tags'];
            }else{
                $nr_tags = 0;
            }
            echo $before_widget;

            if( !empty( $title ) ){
                echo $before_title . $title . $after_title;
            }

        ?>
            
            <div class="tab_menu_content tabs-container">
                <?php
					if($nr_tags != 0){
						$args = array('number' => $nr_tags, 'orderby' => 'count', 'order' => 'DESC');
						$tags = get_tags($args);
					}else{
						$tags = get_tags();
					}	  
                    if( !empty( $tags ) && is_array( $tags ) ){
                        foreach( $tags as $tag ){
                            $tag_link = get_tag_link( $tag -> term_id );
                            ?><a class="tag" href="<?php echo $tag_link ?>"> <?php echo $tag -> name; ?></a><?php
                        }
                    }else{
                        echo '<p>' . __( 'There are no tags.' , 'cosmotheme' ) . '</p>';
                    }
                ?>
            </div>
        <?php
            echo $after_widget;
        }

        function update( $new_instance, $old_instance) {

            /*save the widget*/
            $instance = $old_instance;
            $instance['title']              = strip_tags( $new_instance['title'] );
			$instance['nr_tags']        	= strip_tags( $new_instance['nr_tags'] );

            return $instance;
        }

        function form($instance) {

            /* widget form in backend */
            $instance       = wp_parse_args( (array) $instance, array( 'title' => '' , 'nr_tags' => '') );
            $title          = strip_tags( $instance['title'] );
			$nr_tags    	= strip_tags( $instance['nr_tags'] );
    ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','cosmotheme') ?>:
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
			<p>
                <label for="<?php echo $this->get_field_id('nr_tags'); ?>"><?php _e( 'Number of tags' , 'cosmotheme' ) ?>:
                    <input class="widefat digit" id="<?php echo $this->get_field_id('nr_tags'); ?>" name="<?php echo $this->get_field_name('nr_tags'); ?>" type="text" value="<?php echo esc_attr( $nr_tags ); ?>" />
					<span class="hint"><?php _e('Leave blank to show all tags','cosmotheme' ) ?></span>
                </label>
            </p>
    <?php
        }
    }
?>