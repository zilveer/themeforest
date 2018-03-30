<?php 

class STRelatedPortfolio extends WP_Widget {

	public function __construct() {
		// widget actual processes
        parent::__construct(
	 		'strelatedportfolio', // Base ID
			__('ST Related Portfolio','smooththemes'), // Name
			array( 'description' => __( 'Display Related Portfolio', 'smooththemes' ), ) // Args
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
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'smooththemes'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        	<p>
    		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __('How many post to show ? ' ,'smooththemes') ?></label> 
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
            global $post, $wpdb;
            
            extract( $args );
    		$title = apply_filters( 'widget_title', $instance['title'] );
            $number = intval($instance['number'] );
            if($number<=0){
                $number = 3; // default  = 3;
            }
    
	
        	$backup = $post;
        	$tags = wp_get_post_tags($post->ID);
        	$tagIDs = array();
        	if ($tags) {
            	  $tagcount = count($tags);
            	  for ($i = 0; $i < $tagcount; $i++) {
            	     $tagIDs[$i] = $tags[$i]->term_id;
            	  }
              
              
        	  $args=array(
        	    'tag__in' => $tagIDs,
        	    'post__not_in' => array($post->ID),
        	    'numpost'=>$number,
        	    'post_type'=>'post'
        	  );
              
        	  $query_posts = get_posts($args);
              
          
          
            
        	if( $query_posts){ 
        	     // display title of widget
           	echo $before_widget;
    		if ( ! empty( $title ) )
    			echo $before_title . $title . $after_title;
               
            ?>
            
            
            <ul class="related-posts">
                <?php  foreach($query_posts as $post) {
                     setup_postdata($post);
                     ?>
                        
                        <li class="widget-post-wrapper">
                        	<div class="widget-post-thumb">
                              <?php 
                                  echo st_post_thumbnail($post->ID);
                              ?>
                              </div>
                        	<div class="widget-post-content">
                        		<h3 class="widget-post-title"><a <?php echo $title; ?> href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                        		<span class="widget-post-meta"><?php the_time('M j, Y'); ?> - <span><?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') )?></span></span>
                        	</div>
                        </li>
                <?php } ?>
             </ul>
            <?php 
            
            	echo $after_widget;
            } // end if have posts
                
            }// end is Tags
           	wp_reset_query() ; 
	}

}

register_widget( 'STRelatedPortfolio' );