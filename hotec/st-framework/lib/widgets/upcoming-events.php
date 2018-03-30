<?php 

class STUpcomingEvents extends WP_Widget {

	public function __construct() {
		// widget actual processes
        parent::__construct(
	 		'stupcommingevents', // Base ID
			'ST Upcoming Events', // Name
			array( 'description' => __( 'Display Upcoming Events', 'smooththemes' ), ) // Args
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
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','smooththemes' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
    	<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __('How many events to show ? ' ,'smooththemes') ?></label> 
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
            
            extract( $args );
    		$title = apply_filters( 'widget_title', $instance['title'] );
            $number = intval($instance['number'] );
            if($number<=0){
                $number = 3; // default  = 3;
            }
    
    		echo $before_widget;
    		if ( ! empty( $title ) )
    			echo $before_title . $title . $after_title;
                 
       $myposts  = st_get_upcomming_events($number);
     
       $e ='';
     
         foreach($myposts as $post){
             $start_date = get_post_meta($post->ID,'_st_event_start_date',true);
        
                if($start_date!=''){
                    $start_date = strtotime($start_date);
                }
                
                $end_date = get_post_meta($post->ID,'_st_event_end_date',true);
                if($end_date!=''){
                    $end_date = strtotime($end_date);
                }
                 
                $link = get_permalink($post->ID);
            
       
              $e .='<li>
                    <p class="small-event-data">
                        <strong>'.date_i18n('d',$start_date).'</strong><a href="'.$link.'"></a><span>'.date_i18n('M',$start_date).'</span>
                    </p>
                    <a class="event-title" href="'.$link.'">'.apply_filters('the_title',$post->post_title).'</a>
                    <span>'.__('at','smooththemes').' '.date_i18n('H:iA, l d F Y',$start_date).'</span>
                    <span><strong>'.get_post_meta($post->ID,'_st_event_meta_price',true).'</strong></span>
                </li>';
         }
     
      wp_reset_query();   
                
        	if($e){ ?>
            <ul class="upcoming-events">
                 <?php echo $e; ?>
             </ul>
            <?php }	wp_reset_query() ;
            
        	echo $after_widget;
	}

}

register_widget( 'STUpcomingEvents' );