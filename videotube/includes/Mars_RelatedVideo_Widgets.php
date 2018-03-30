<?php
/**
 * VideoTube Related Videos Widget
 * Display the related videos widget below the Main video content, located in single-video.php
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_RelatedVideos_Widgets') ){
	function Mars_RelatedVideos_Widgets() {
		register_widget('Mars_RelatedVideos_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_RelatedVideos_Widgets');
}
class Mars_RelatedVideos_Widgets_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-relatedvideo-widgets', 'description' => __('VT Related Videos Widget', 'mars') );
		
		parent::__construct( 'mars-relatedvideo-widgets' , __('VT Related Videos Widget', 'mars') , $widget_ops);
	}	

	function widget($args, $instance){
		global $post;	
		extract( $args );
		wp_reset_postdata();wp_reset_query();
		$title = apply_filters('widget_title', $instance['title'] );
		$video_orderby = isset( $instance['video_orderby'] ) ? $instance['video_orderby'] : 'ID';
		$video_order = isset( $instance['video_order'] ) ? $instance['video_order'] : 'DESC';
		$video_filter_condition = isset( $instance['video_filter_condition'] ) ? $instance['video_filter_condition'] : 'both';
		$video_rows = isset( $instance['rows'] ) ? (int)$instance['rows'] : 1;
		$columns = isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 3;
		$class_columns = ( 12%$columns == 0 ) ? 12/$columns : 3;		
		$autoplay = isset( $instance['auto'] ) ? $instance['auto'] : null;		
		$video_shows = isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 16;  
		$current_videoID = get_the_ID();
		
		$video_category = mars_get_current_postterm($current_videoID,'categories');
		$video_tag = mars_get_current_postterm($current_videoID,'video_tag');

		$i=0;
		$videos_query = array(
			'post_type'	=>	'video',
			'showposts'	=>	$video_shows,
			'posts_per_page'	=>	$video_shows,
			'post__not_in'	=>	array($current_videoID),
			'no_found_rows'	=>	true
		);
        if( $video_filter_condition == 'both' ){

        	if( !empty( $video_category ) ){
				$videos_query['tax_query'] = array(
					array(
						'taxonomy' => 'categories',
						'field' => 'id',
						'terms' => $video_category
					)
				);
			}
			if( !empty( $video_tag ) ){
				$videos_query['tax_query'] = array(
					array(
						'taxonomy' => 'video_tag',
						'field' => 'id',
						'terms' => $video_tag
					)
				);
			}
        }
         if( $video_filter_condition == 'categories' ){
            if( !empty( $video_category ) ){
				$videos_query['tax_query'] = array(
					array(
						'taxonomy' => 'categories',
						'field' => 'id',
						'terms' => $video_category
					)
				);
			}         	
         }
        
	    if( $video_filter_condition == 'video_tag' ){
	    	if( !empty( $video_tag ) ){
				$videos_query['tax_query'] = array(
					array(
						'taxonomy' => 'video_tag',
						'field' => 'id',
						'terms' => $video_tag
					)
				);
			}         	
         }        
        
		if( isset( $video_orderby ) ){
			if( $video_orderby == 'views' ){
				$videos_query['meta_key'] = 'count_viewed';
				$videos_query['orderby']	=	'meta_value_num';
			}
			elseif( $video_orderby == 'likes' ){
				$videos_query['meta_key'] = 'like_key';
				$videos_query['orderby']	=	'meta_value_num';				
			}
			else{
				$videos_query['orderby'] = $video_orderby;	
			}
		}
		if( isset( $video_order ) ){
			$videos_query['order']	=	$video_order;
		}
		if( isset( $post->ID ) ){
			$videos_query['post__not_in'] = array( $post->ID  );
		}		
		
		$videos_query	=	apply_filters( 'mars_related_widget_args' , $videos_query, $this->id);
		
		$wp_query = new WP_Query( $videos_query );
		if( $wp_query->have_posts() ):
		?>
			<div id="carousel-latest-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id; ?> slide video-section" <?php if($video_shows>3):?> data-ride="carousel"<?php endif;?>>
				<?php if( $video_shows >= $wp_query->post_count && $video_shows > $columns*$video_rows ):?>
	          		<div class="section-header">
          				<?php if( $title ):?>
                        	<h3><?php print $title;?></h3>
                        <?php endif;?>
			            <ol class="carousel-indicators section-nav">
			            	<li data-target="#carousel-latest-<?php print $this->id; ?>" data-slide-to="0" class="bullet active"></li>
			                <?php 
			                	$c = 0;
			                	for ($j = 1; $j < $wp_query->post_count; $j++) {
			                		if ( $j % ($columns*$video_rows) == 0 && $j < $video_shows ){
				                    	$c++;
				                    	print '<li data-target="#carousel-latest-'.$this->id.'" data-slide-to="'.$c.'" class="bullet"></li> '; 
				                    }	
			                	}
			                ?>
			            </ol>
			            
                    </div><!-- end section header -->
                   <?php endif;?>
                    <div class="latest-wrapper">
                    	<div class="row">
		                     <div class="carousel-inner">
		                       	<?php
		                       	if( $wp_query->have_posts() ) : 
		                       		$i =0;
			                       	while ( $wp_query->have_posts() ) : $wp_query->the_post();
			                       	$i++;
			                       	?>
			                       	<?php if( $i == 1 ):?>
			                       		<div class="item active">
			                       	<?php endif;?>	
			                       		<div class="col-sm-<?php print $class_columns;?> col-xs-6 item responsive-height <?php print $this->id; ?>-<?php print get_the_ID();?>">
			                       			<div class="item-img">
			                                <?php 
			                                	if(has_post_thumbnail()){
			                                		if( $columns ==2 ){
			                                			print '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,apply_filters( 'related_video/thumbnail_size' , 'video-featured'), array('class'=>'img-responsive')).'</a>';
			                                		}
			                                		else{
			                                			print '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,apply_filters( 'related_video/thumbnail_size' , 'video-lastest'), array('class'=>'img-responsive')).'</a>';
			                                		}
			                                	}
			                                ?>
												<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
											</div>				                                
                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
											<?php do_action( 'mars_video_meta' );?>
	                                     </div> 
				                    <?php
				                    if ( $i % ($video_rows*$columns) == 0 && $i < $video_shows ){	
				                    	?></div><div class="item"><?php 
				                    } 	             
			                       	endwhile;
			                      ?></div><?php 
		                       	endif;
		                       	?> 
		                        </div>
                            </div>
                    </div>
                </div><!-- /#carousel-->
				<?php if( $autoplay == 'on' ):?>
				<script>
					(function($) {
					  "use strict";
					  	jQuery(document).ready(function() {
						  try {
							  jQuery('.carousel-<?php print $this->id; ?>').carousel({
									 pause: false
								});
							  }
							  catch (e) {
								 console.log('Main Video carousel is not working');
							 }
						 })
					})(jQuery);
				</script>				
				<?php endif;?>
		<?php 
		endif;
		wp_reset_query();wp_reset_postdata();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_orderby'] = strip_tags( $new_instance['video_orderby'] );
		$instance['video_order'] = strip_tags( $new_instance['video_order'] );
		$instance['video_filter_condition'] = strip_tags( $new_instance['video_filter_condition'] );
		$instance['video_shows'] = strip_tags( $new_instance['video_shows'] );
		$instance['rows'] = absint( $new_instance['rows'] );
		$instance['columns']	=	absint( $new_instance['columns'] );
		$instance['auto'] = strip_tags( $new_instance['auto'] );		
		return $instance;
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Related Videos', 'mars'),
			'columns'	=>	3
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo ( isset( $instance['title'] ) ? $instance['title'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_orderby' ); ?>"><?php _e('Orderby:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'video_orderby' ); ?>" name="<?php echo $this->get_field_name( 'video_orderby' ); ?>">
		    	<?php 
		    		foreach ( post_orderby_options('video') as $key=>$value ){
		    			$selected = ( $instance['video_orderby'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_order' ); ?>"><?php _e('Order:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'video_order' ); ?>" name="<?php echo $this->get_field_name( 'video_order' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_order() as $key=>$value ){
		    			$selected = ( $instance['video_order'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_filter_condition' ); ?>"><?php _e('Filter Condition:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'video_filter_condition' ); ?>" name="<?php echo $this->get_field_name( 'video_filter_condition' ); ?>">
		    	<?php 
		    		foreach ( $this->condition() as $key=>$value ){
		    			$selected = ( $instance['video_filter_condition'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_shows' ); ?>"><?php _e('Shows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'video_shows' ); ?>" name="<?php echo $this->get_field_name( 'video_shows' ); ?>" value="<?php echo isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 16; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e('Columns:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" value="<?php echo $instance['columns']; ?>" style="width:100%;" />
		    <small><?php _e('You can set the columns for displaying the Videos, example: 3,4 or 6.','mars');?></small>
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'rows' ); ?>"><?php _e('Rows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'rows' ); ?>" name="<?php echo $this->get_field_name( 'rows' ); ?>" value="<?php echo (isset( $instance['rows'] )) ? (int)$instance['rows'] : 1; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'auto' ); ?>"><?php _e('Auto Carousel', 'mars'); ?></label>
		    <input type="checkbox" id="<?php echo $this->get_field_id( 'auto' ); ?>" name="<?php echo $this->get_field_name( 'auto' ); ?>" <?php  print isset( $instance['auto'] ) && $instance['auto'] =='on' ? 'checked' : null;?> />
		</p>
	<?php
	}
	function widget_video_order(){
		return array(
			'ASC'	=>	__('ASC','mars'),
			'DESC'	=>	__('DESC','mars')
		);
	}
	function condition(){
		return array(
			'both'			=>	__('Video Category and Video Tag','mars'),
			'categories'	=>	__('Video Category','mars'),
			'video_tag'		=>	__('Video Tag','mars')
		);
	}
}