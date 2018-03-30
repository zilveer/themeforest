<?php
/**
 * VideoTube Video Right Widget
 * Add Video Widget in Right Sidebar.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_Videos_Widget_Siderbar') ){
	function Mars_Videos_Widget_Siderbar() {
		register_widget('Mars_Videos_Widget_Siderbar_Class');
	}
	add_action('widgets_init', 'Mars_Videos_Widget_Siderbar');
}
class Mars_Videos_Widget_Siderbar_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-videos-sidebar-widget', 'description' => __('VT Right Video Widgets', 'mars') );
		parent::__construct('mars-videos-sidebar-widget', __('VT Right Video Widgets', 'mars') , $widget_ops);
	}

	function widget($args, $instance){
		$WidgetHTML = null;
		extract( $args );
		wp_reset_postdata(); wp_reset_query();
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$video_category = isset( $instance['video_category'] ) ? $instance['video_category'] : null;
		$video_tag = isset( $instance['video_tag'] ) ? $instance['video_tag'] : null;
		$video_date = isset( $instance['date'] ) ? $instance['date'] : null;
		$today = isset( $instance['today'] ) ? $instance['today'] : null;
		$thisweek = isset( $instance['thisweek'] ) ? $instance['thisweek'] : null;		
		$video_orderby = isset( $instance['video_orderby'] ) ? $instance['video_orderby'] : 'ID';
		$video_order = isset( $instance['video_order'] ) ? $instance['video_order'] : 'DESC';
		$widget_column = isset( $instance['widget_column'] ) ? $instance['widget_column'] : 2;
		$video_shows = isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 4;  
		print  $before_widget;
		if( ! empty( $title ) ){
			if( ! empty( $instance['view_more'] ) ){
				$title = '<a href="'. esc_url( $instance['view_more'] ) .'">'. $title .'</a>';
			}
			print $before_title . $title . $after_title;
		}
		
		$videos_query = array(
			'post_type'	=>	'video',
			'showposts'	=>	$video_shows,
			'no_found_rows'	=>	true
		);
  
		if( $video_category ){
			$videos_query['tax_query'][] = 	array(
				'taxonomy' => 'categories',
				'field' => 'id',
				'terms' => $video_category,
				'operator'	=>	'IN'
			);
		}
		if( $video_tag ){
			$videos_query['tax_query'][] = array(
				'taxonomy' => 'video_tag',
				'field' => 'slug',
				'terms' => explode(",", $video_tag)
			);
		}
		
		if( $video_orderby ){
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
		if( $video_order ){
			$videos_query['order']	=	$video_order;
		}	
		if( isset( $post->ID ) && is_singular( 'video' ) ){
			$videos_query['post__not_in'] = array( $post->ID  );
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
		
		$videos_query	=	apply_filters( 'mars_side_widget_args' , $videos_query, $this->id);
		
		$wp_query = new WP_Query( $videos_query );
		?>
			<?php if( $widget_column == 2 ):?>
	        <div class="row">
	        	<?php if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ): $wp_query->the_post();?>
	        	<?php
	        	$postdata = mars_get_post_data( get_the_ID() );
	        	?>
	            <div class="col-xs-6 item responsive-height <?php print $this->id; ?>-<?php print get_the_ID();?>">
	            	<div class="item-img">
	            	<?php 
	            		if( has_post_thumbnail() ){
	            			print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'most-video-2col', array('class'=>'img-responsive')) .'</a>';
	            		}
	            	?>
						<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
					</div>	            	
	                <h3><a title="<?php the_title()?>" href="<?php the_permalink();?>"><?php the_title()?></a></h3>
					<?php do_action( 'mars_video_meta' );?>
	       		</div>
	       		<?php endwhile;endif;?>
	        </div>
	        <?php else:?>
	        	<?php if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ): $wp_query->the_post();?>
	        	<?php
	        	$postdata = mars_get_post_data( get_the_ID() );
	        	?>	        	
			        <div class="item <?php print $this->id; ?>-<?php print get_the_ID();?>">
			        	<div class="item-img">
		            	<?php 
		            		if( has_post_thumbnail() ){
		            			print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'video-featured', array('class'=>'img-responsive')) .'</a>';
		            		}
		            	?>
							<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
						</div>		            	
		                <h3><a title="<?php the_title()?>" href="<?php the_permalink();?>"><?php the_title()?></a></h3>
						<?php do_action( 'mars_video_meta' );?>
			        </div>	
		        <?php endwhile;endif;?>        
	        <?php endif;?>
	    <?php 		
		print $after_widget;
		wp_reset_postdata();wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		$instance['video_category'] = strip_tags( $new_instance['video_category'] );
		$instance['video_tag'] = strip_tags( $new_instance['video_tag'] );
		$instance['date'] = strip_tags( $new_instance['date'] );
		$instance['today']	=	esc_attr( $new_instance['today'] );
		$instance['thisweek']	=	esc_attr( $new_instance['thisweek'] );		
		$instance['video_orderby'] = strip_tags( $new_instance['video_orderby'] );
		$instance['video_order'] = strip_tags( $new_instance['video_order'] );
		$instance['widget_column'] = strip_tags( $new_instance['widget_column'] );
		$instance['video_shows'] = strip_tags( $new_instance['video_shows'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Right Sidebar Videos', 'mars'),
			'view_more'	=>	'',
			'date'	=>	'',
			'today'	=>	'',
			'thisweek'	=>	''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo ( isset( $instance['title'] ) ? $instance['title'] : null ); ?>" style="width:100%;" />
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
							'class'              => 'postform mars-dropdown',
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
		    <label for="<?php echo $this->get_field_id( 'widget_column' ); ?>"><?php _e('Widget Column:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'widget_column' ); ?>" name="<?php echo $this->get_field_name( 'widget_column' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_column() as $key=>$value ){
		    			$selected = ( $instance['widget_column'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>  
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'video_shows' ); ?>"><?php _e('Shows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'video_shows' ); ?>" name="<?php echo $this->get_field_name( 'video_shows' ); ?>" value="<?php echo isset( $instance['video_shows'] ) ? (int)$instance['video_shows'] : 4; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'view_more' ); ?>"><?php _e('View more link', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'view_more' ); ?>" name="<?php echo $this->get_field_name( 'view_more' ); ?>" value="<?php echo ( isset( $instance['view_more'] ) ? $instance['view_more'] : null ); ?>" style="width:100%;" />
		</p>			
	<?php		
	}
	function widget_video_column(){
		return array(
			'2'	=>	__('2 Columns','mars'),
			'1'	=>	__('1 Column','mars')
		);
	}
	function widget_video_order(){
		return array(
			'DESC'	=>	__('DESC','mars'),
			'ASC'	=>	__('ASC','mars')
		);
	}		
}

