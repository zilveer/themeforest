<?php
/**
 * VideoTube Featured Widget
 * Add Video Featured Widget
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_FeaturedVideos_Widgets') ){
	function Mars_FeaturedVideos_Widgets() {
		register_widget('Mars_FeaturedVideos_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_FeaturedVideos_Widgets');
}
class Mars_FeaturedVideos_Widgets_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-featuredvideo-widgets', 'description' => __('VT Featured Videos Widget', 'mars') );
	
		parent::__construct( 'mars-featuredvideo-widgets' , __('VT Featured Videos Widget', 'mars') , $widget_ops);
	}	
	
	function widget($args, $instance){
		extract( $args );
		wp_reset_postdata();wp_reset_query();
		$title = apply_filters('widget_title', $instance['title'] );
		$video_category = isset( $instance['video_category'] ) ? $instance['video_category'] : null;
		$video_tag = isset( $instance['video_tag'] ) ? $instance['video_tag'] : null;
		$video_date = isset( $instance['date'] ) ? $instance['date'] : null;
		$today = isset( $instance['today'] ) ? $instance['today'] : null;
		$thisweek = isset( $instance['thisweek'] ) ? $instance['thisweek'] : null;
		$video_orderby = isset( $instance['video_orderby'] ) ? $instance['video_orderby'] : 'ID';
		$video_order = isset($instance['video_order']) ? $instance['video_order'] : 'DESC';
		$video_ids = isset( $instance['ids'] ) ? $instance['ids'] : null;
		$video_shows = isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 9;  
		$video_rows = isset( $instance['rows'] ) ? (int)$instance['rows'] : 1;
		$columns = isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 3;
		$class_columns = ( 12%$columns == 0 ) ? 12/$columns : 3;
		$autoplay = isset( $instance['auto'] ) ? $instance['auto'] : null;
		$i=0;
		$videos_query = array(
			'post_type'	=>	'video',
			'showposts'	=>	$video_shows,
			'no_found_rows'	=>	true				
		);
                       	
		if( !empty( $video_category ) ){
			$videos_query['tax_query'][] = array(
				'taxonomy' => 'categories',
				'field' => 'id',
				'terms' => array((int)$video_category)	                       		
			);
		}
		if( !empty( $video_tag ) ){
			$videos_query['tax_query'][] = array(
				'taxonomy' => 'video_tag',
				'field' => 'slug',
				'terms' => explode(",", $video_tag)
			);
		}
		if( !empty( $video_orderby ) ){
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
		if( !empty( $video_order ) ){
			$videos_query['order']	=	$video_order;
		}
		if( !empty( $video_ids ) ){
			$videos_query['post__in']	=	explode(",", $video_ids);
		}
		if( !empty( $video_date ) ){
			$dateime = explode("-", $video_date);
			$videos_query['date_query'] = array(
				array(
					'year'  => isset( $dateime[0] ) ? $dateime[0] : null,
					'month' => isset( $dateime[1] ) ? $dateime[1] : null,
					'day'   => isset( $dateime[2] ) ? $dateime[2] : null,
				)
			);
		}
		
		if( !empty( $today ) ){
			$is_today = getdate();
			$videos_query['date_query'][]	= array(
				'year'  => $is_today['year'],
				'month' => $is_today['mon'],
				'day'   => $is_today['mday']
			);
		}
		if( !empty( $thisweek ) ){
			$videos_query['date_query'][]	= 	array(
				'year' => date( 'Y' ),
				'week' => date( 'W' )
			);
		}
		$videos_query	=	apply_filters( 'mars_featured_widget_args' , $videos_query, $this->id);
		$wp_query = new WP_Query( $videos_query );
		?>
		    <div id="carousel-featured-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id; ?> slide" data-ride="carousel">
		        <div class="container section-header">
		        	<?php if( ! empty( $title ) ): ?>
		        	
		        		<?php 
		        			if( ! empty( $instance['view_more'] ) ){
		        				?><h3><i class="fa fa-star"></i> <a href="<?php print esc_url( $instance['view_more'] );?>"><?php print $title;?></a></h3><?php 
		        			}
		        			else{
		        				?><h3><i class="fa fa-star"></i> <?php print $title;?></h3><?php 
		        			}
		        		?>
		            <?php endif;?>
		            <?php if( $video_shows >= $wp_query->post_count && $video_shows > $columns*$video_rows ):?>
			            <ol class="carousel-indicators section-nav">
			            	<li data-target="#carousel-featured-<?php print $this->id; ?>" data-slide-to="0" class="bullet active"></li>
			                <?php 
			                	$c = 0;
			                	for ($j = 1; $j < $wp_query->post_count; $j++) {
			                		if ( $j % ($columns*$video_rows) == 0 && $j < $video_shows ){
				                    	$c++;
				                    	print '<li data-target="#carousel-featured-'.$this->id.'" data-slide-to="'.$c.'" class="bullet"></li> '; 
				                    }	
			                	}
			                ?>
			            </ol>
		            <?php endif;?>
		        </div>
		        <div class="featured-wrapper">
		            <div class="container">
		            	<div class="row">
		                     <div class="carousel-inner">
		                       	<?php
		                       	$i=0;
		                       	$wp_query = new WP_Query( $videos_query );
		                       	if( $wp_query->have_posts() ) : 
			                       	while ( $wp_query->have_posts() ) : $wp_query->the_post();
			                       	$i++;
			                       	?>
			                       	<?php if( $i == 1 ):?>
			                       		<div class="item active <?php print $i;?>">
			                       	<?php endif;?>	
			                                <div id="video-featured-<?php the_ID()?>" class="col-sm-<?php print $class_columns;?> <?php print $this->id; ?>-<?php print get_the_ID();?>">
			                                <div class="item-img">
				                                <?php 
				                                	if(has_post_thumbnail()){
				                                		print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'video-featured', array('class'=>'img-responsive')) .'</a>';
				                                	}
				                                ?>
                                        		<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
                                        	</div> 				                                
			                                    <div class="feat-item">
			                                        <div class="feat-info video-info-<?php print get_the_ID();?>">
			                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
														<?php do_action( 'mars_video_meta' );?>
			                                        </div>
													
			                                    </div>
												
			                                </div> 
				                    <?php
				                    if ( $i % ($columns*$video_rows) == 0 && $i < $video_shows ){
				                    	?></div><div class="item <?php print $i;?>"><?php 
				                    }
			                       	endwhile;
			                      ?></div><?php 
		                       	endif;
		                       	?> 
		                        </div>
		                  </div>
		            </div>
		        </div>
			</div><!-- /#carousel-featured -->
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
								 console.log('Featured Video carousel is not working');
							 }
						 })
					})(jQuery);
				</script>
			<?php endif;?>
		<?php 
		wp_reset_postdata();wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_category'] = strip_tags( $new_instance['video_category'] );
		$instance['video_tag'] = strip_tags( $new_instance['video_tag'] );
		$instance['date'] = strip_tags( $new_instance['date'] );
		$instance['today']	=	esc_attr( $new_instance['today'] );
		$instance['thisweek']	=	esc_attr( $new_instance['thisweek'] );
		$instance['video_orderby'] = strip_tags( $new_instance['video_orderby'] );
		$instance['video_order'] = strip_tags( $new_instance['video_order'] );
		$instance['video_shows'] = strip_tags( $new_instance['video_shows'] );
		$instance['ids'] = strip_tags( $new_instance['ids'] );
		$instance['columns']	=	absint( $new_instance['columns'] );
		$instance['rows'] = absint( $new_instance['rows'] );
		$instance['auto'] = esc_attr( $new_instance['auto'] );
		$instance['view_more']	=	strip_tags( $new_instance['view_more'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Featured Videos', 'mars'),
			'columns'	=>	3,
			'today'		=>	'',
			'thisweek'	=>	'',
			'view_more'	=>	''
		);
		$instance['video_category'] = isset( $instance['video_category'] ) ? $instance['video_category'] : null;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo ( isset( $instance['title'] ) ? $instance['title']: null ); ?>" style="width:100%;" />
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_category' ); ?>"><?php _e('Video Category:', 'mars'); ?></label>
		    	<?php 
					wp_dropdown_categories($args = array(
							'show_option_all'    => 'All',
							'orderby'            => 'ID', 
							'order'              => 'ASC',
							'show_count'         => 1,
							'hide_empty'         => 1, 
							'child_of'           => 0,
							'echo'               => 1,
							'selected'           => isset( $instance['video_category'] ) ? $instance['video_category'] : null,
							'hierarchical'       => 0, 
							'name'               => $this->get_field_name( 'video_category' ),
							'id'                 => $this->get_field_id( 'video_category' ),
							'taxonomy'           => 'categories',
							'hide_if_empty'      => true,
							'class'              => 'regular-text mars-dropdown',
			    		)
		    		);
		    	?>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_tag' ); ?>"><?php _e('Video Tag:', 'mars'); ?></label>
		    <input placeholder="<?php _e('Eg: tag1,tag2,tag3','mars');?>" id="<?php echo $this->get_field_id( 'video_tag' ); ?>" name="<?php echo $this->get_field_name( 'video_tag' ); ?>" value="<?php echo ( isset( $instance['video_tag'] ) ? $instance['video_tag'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e('Date (Show posts associated with a certain time, (yyyy-mm-dd)):', 'mars'); ?></label>
		    <input class="vt-datetime" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" value="<?php echo ( isset( $instance['date'] ) ? $instance['date'] : null ); ?>" style="width:100%;" />
		</p>
		<p>  
			<label><?php _e('Display the post today','mars')?></label>
			<input <?php checked( 'on', $instance['today'], true );?> type="checkbox" id="<?php echo $this->get_field_id( 'today' ); ?>" name="<?php echo $this->get_field_name( 'today' ); ?>"/>
			<label><?php _e('Or this week','mars')?></label>
			<input <?php checked( 'on', $instance['thisweek'], true );?> type="checkbox" id="<?php echo $this->get_field_id( 'thisweek' ); ?>" name="<?php echo $this->get_field_name( 'thisweek' ); ?>"/>
			<br/>
			<small><?php _e('Do not choose two options.','mars')?></small>
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
		    <label for="<?php echo $this->get_field_id( 'ids' ); ?>"><?php _e('Video IDs:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'ids' ); ?>" name="<?php echo $this->get_field_name( 'ids' ); ?>" value="<?php echo ( isset( $instance['ids'] ) ) ? $instance['ids'] : null; ?>" style="width:100%;" />
		</p>										 
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_shows' ); ?>"><?php _e('Shows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'video_shows' ); ?>" name="<?php echo $this->get_field_name( 'video_shows' ); ?>" value="<?php echo (isset( $instance['video_shows'] )) ? (int)$instance['video_shows'] : 16; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e('Columns:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" value="<?php echo (isset( $instance['columns'] )) ? (int)$instance['columns'] : 1; ?>" style="width:100%;" />
		    <small><?php _e('You can set the columns for displaying the Videos, example: 3,4 or 6.','mars');?></small>
		</p>		
		<p>  
		    <label for="<?php echo $this->get_field_id( 'rows' ); ?>"><?php _e('Rows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'rows' ); ?>" name="<?php echo $this->get_field_name( 'rows' ); ?>" value="<?php echo (isset( $instance['rows'] )) ? (int)$instance['rows'] : 1; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'auto' ); ?>"><?php _e('Auto Carousel:', 'mars'); ?></label>
		    <input type="checkbox" id="<?php echo $this->get_field_id( 'auto' ); ?>" name="<?php echo $this->get_field_name( 'auto' ); ?>" <?php  print isset( $instance['auto'] ) && $instance['auto'] =='on' ? 'checked' : null;?> />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'view_more' ); ?>"><?php _e('View more link', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'view_more' ); ?>" name="<?php echo $this->get_field_name( 'view_more' ); ?>" value="<?php echo ( isset( $instance['view_more'] ) ? $instance['view_more'] : null ); ?>" style="width:100%;" />
		</p>		
	<?php		
	}
	function widget_video_order(){
		return array(
			'ASC'	=>	__('ASC','mars'),
			'DESC'	=>	__('DESC','mars')
		);
	}		
}