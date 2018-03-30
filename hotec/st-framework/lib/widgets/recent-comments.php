<?php 

class STRecentComments extends WP_Widget {

	public function __construct() {
		// widget actual processes
        parent::__construct(
	 		'strecentcomments', // Base ID
			'ST Recent Comments', // Name
			array( 'description' => __( 'Display Recent Comment with avatar', 'smooththemes' ), ) // Args
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
            $number = 5; // default  = 3;
        }
        
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','smooththemes' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        	<p>
    		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __('How many comments to show ? ' ,'smooththemes') ?></label> 
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
                $number = 5; // default  = 3;
            }
    
    		echo $before_widget;
    		if ( ! empty( $title ) )
    			echo $before_title . $title . $after_title;

             $args = array(
            	'number' => $number,
            	'orderby' => '',
                'status'=>'approve',
            	'order' => 'DESC',
            );
        
           $comments  =  get_comments( $args );
            
             $i = 0;

        	if($comments){ ?>
            <ul class="recent-comments num-<?php echo $number; ?>">
                <?php foreach($comments as $c){ 
                   // $user_info = get_userdata($c->user_id);
                    // echo get_author_posts_url($c->user_id); ;
                    ?>
                       
                        <li class="widget-post-wrapper<?php echo ($i%2==0) ?' event' : '';  $i++; ?>">
                        		<div class="widget-post-thumb">
                                    <?php echo get_avatar($c->user_id,$size='50',$default='' ); ?>
                                </div>
                        	<div class="widget-post-content">
                        		<a  href="<?php echo get_permalink($c->comment_post_ID); ?>#comment-<?php echo $c->comment_ID; ?>" ><?php echo  get_the_title($c->comment_post_ID); ?></a>
                                <div class="conment-sub-content"><?php echo  wp_trim_words(apply_filters( 'get_comment_text', $c->comment_content, $c ),10,'...'); ?></div>
                        		<span class="widget-post-meta"><?php echo get_comment_date('',$c->comment_ID); ?> - 
                                 <span>
                                    <?php // printf(__('<b class="author_name">%s</b>'), get_comment_author_link($c->comment_ID)) ?>
                                    <b class="author_name"><a rel="me" href="<?php echo 	get_author_posts_url( $c->user_id); ?>"><?php echo get_comment_author( $c->comment_ID ); ?></a></b>
                                 </span>
                                </span>
                        	</div>
                        </li>
                <?php } ?>
             </ul>
            <?php }	wp_reset_query() ;
            
        	echo $after_widget;
	}

}

register_widget( 'STRecentComments' );