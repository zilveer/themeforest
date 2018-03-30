<?php 

class STRecentPosts extends WP_Widget {

	public function __construct() {
		// widget actual processes
        parent::__construct(
	 		'strecentposts', // Base ID
			__('ST Recent Posts','smooththemes'), // Name
			array( 'description' => __( 'Display Recent Posts', 'smooththemes' ), ) // Args
		);
	}

 	public function form( $instance ) {
		// outputs the options form on admin
        
        if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '';
		}
        
        $number = intval($instance[ 'number' ]);
        
        if($number<=0){
            $number = 3; // default  = 3;
        }
        
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','smooththemes'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        	<p>
    		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __('How many posts to show ? ' ,'smooththemes') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
    		</p>
        
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
        $instance[ 'number' ] = intval($new_instance[ 'number' ]);
		return $instance;
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
            global $wpdb,$post;
            
            $date_format = get_option('date_format','M j, Y');
            
            extract( $args );
    		$title = apply_filters( 'widget_title', $instance['title'] );
            $number = intval($instance['number'] );
            if($number<=0){
                $number = 3; // default  = 3;
            }
    
    		echo $before_widget;
    		if ( ! empty( $title ) )
    			echo $before_title . $title . $after_title;
                
                
                 /**
             * New in ver 1.3
             */ 
               $args = array( 'posts_per_page' => $number );
                if(isset($cats) && $cats>0){
                    $args['category__in'] =  array($cats);
                }
                $args['post__not_in'] = array($post->ID);
                $args['orderby'] = 'post_date';
                $args['order'] = 'DESC';
                 $args['post_status'] = 'publish';
                 $args['post_type'] ='post';
                
                 if(st_is_wpml()){
                     $args['sippress_filters'] = true;
                    $args['language'] = get_bloginfo('language');
                 }
                 $new_query = new WP_Query($args);
                 $posts =  $new_query->posts;
                
      

        	if($posts){ ?>
            <ul class="st-recent-posts">
                <?php 
                $i = 0;
                foreach($posts as $post){
                     $class= '';
                     if($i %2 ==0){
                        $class =' event';
                     }
                    setup_postdata($post); ?>
                        <li class="widget-post-wrapper<?php echo $class; ?>">
                                <?php  echo st_post_small_thumbnail($post->ID); ?>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <span class="recent-date"><?php the_time($date_format); ?></span>
                                <div class="clear"></div>
                        </li>
                    <?php 
                     $i ++ ;
                    } ?>
             </ul>
            <?php }	wp_reset_query() ;
            
        	echo $after_widget;
	}

}

register_widget( 'STRecentPosts' );