<?php
/**
 * VideoTube Post Right Widget
 * Add Video Post in Right Sidebar.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_Posts_Widget_Siderbar') ){
	function Mars_Posts_Widget_Siderbar() {
		register_widget('Mars_Posts_Widget_Siderbar_Class');
	}
	add_action('widgets_init', 'Mars_Posts_Widget_Siderbar');
}
class Mars_Posts_Widget_Siderbar_Class extends WP_Widget{
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-posts-sidebar-widget', 'description' => __('VT Right Post Widgets', 'mars') );
	
		parent::__construct( 'mars-posts-sidebar-widget' , __('VT Right Post Widgets', 'mars') , $widget_ops);
	}	
	
	function widget($args, $instance){
		$WidgetHTML = null;
		extract( $args );
		wp_reset_postdata();wp_reset_query();
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$post_category = isset( $instance['post_category'] ) ? $instance['post_category'] : null;
		$post_tag = isset( $instance['post_tag'] ) ? $instance['post_tag'] : null;
		$post_date = isset( $instance['date'] ) ? $instance['date'] : null;
		$today = isset( $instance['today'] ) ? $instance['today'] : null;
		$thisweek = isset( $instance['thisweek'] ) ? $instance['thisweek'] : null;		
		$post_orderby = isset( $instance['post_orderby'] ) ? $instance['post_orderby'] : 'ID';
		$post_order = isset( $instance['post_order'] ) ? $instance['post_order'] : 'DESC';
		$widget_column = isset( $instance['widget_column'] ) ? $instance['widget_column'] : 2;
		$post_shows = isset( $instance['post_shows'] ) ? (int)$instance['post_shows'] : 4;  
		print  $before_widget;
		
		if( ! empty( $title ) ){
			if( ! empty( $instance['view_more'] ) ){
				$title = '<a href="'. esc_url( $instance['view_more'] ) .'">'. $title .'</a>';
			}
			print $before_title . $title . $after_title;
		}
		
		$posts_query = array(
			'post_type'	=>	'post',
			'showposts'	=>	$post_shows,
			'ignore_sticky_posts'	=>	true,
			'no_found_rows'	=>	true				
		);
                       	
		if( $post_category ){
			$posts_query['tax_query'] = array(
				array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $post_category
				)		                       		
			);
		}
		if( $post_tag ){
			$posts_query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => explode(",", $post_tag)
			);
		}
		
		if( $post_orderby ){
			$posts_query['orderby'] = $post_orderby;	
		}
		if( $post_order ){
			$posts_query['order']	=	$post_order;
		}	
		if( isset( $post->ID ) ){
			$posts_query['post__not_in'] = array( $post->ID  );
		}
		
		if( !empty( $post_date ) ){
			$dateime = explode("-", $post_date);
			$posts_query['date_query'] = array(
				array(
					'year'  => isset( $dateime[0] ) ? $dateime[0] : null,
					'month' => isset( $dateime[1] ) ? $dateime[1] : null,
					'day'   => isset( $dateime[2] ) ? $dateime[2] : null,
				)
			);
		}
		
		if( !empty( $today ) ){
			$is_today = getdate();
			$posts_query['date_query'][]	= array(
				'year'  => $is_today['year'],
				'month' => $is_today['mon'],
				'day'   => $is_today['mday']
			);
		}
		if( !empty( $thisweek ) ){
			$posts_query['date_query'][]	= 	array(
				'year' => date( 'Y' ),
				'week' => date( 'W' )
			);
		}
		
		$posts_query	=	apply_filters( 'mars_side_widget_args' , $posts_query, $this->id);		
		
		$wp_query = new WP_Query( $posts_query );
		?>
			<?php if( $widget_column == 2 ):?>
	        <div class="row">
	        	<?php if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ): $wp_query->the_post();?>
	        	<?php
	        	$postdata = mars_get_post_data( get_the_ID() );
	        	?>
	            <div id="post-right-<?php print $this->id; ?>-<?php the_ID();?>" <?php post_class('col-xs-6 item responsive-height'); ?>>
	            	<?php 
	            		if( has_post_thumbnail() ){
	            			print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'most-video-2col', array('class'=>'img-responsive')) .'</a>';
	            		}
	            	?>
                    <div class="post-header">              	         	
	                	<h3><a title="<?php the_title()?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<span class="post-meta">
							<i class="fa fa-clock-o"></i> <?php print get_the_date();?>
						</span>	                	
	                </div>
	       		</div>
	       		<?php endwhile;endif;?>
	        </div>
	        <?php else:?>
	        	<?php if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ): $wp_query->the_post();?>
	        	<?php
	        	$postdata = mars_get_post_data( get_the_ID() );
	        	?>	        	
			        <div id="post-right-<?php print $this->id; ?>-<?php the_ID();?>" <?php post_class('item'); ?>>
		            	<?php 
		            		if( has_post_thumbnail() ){
		            			print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'video-featured', array('class'=>'img-responsive')) .'</a>';
		            		}
		            	?>	            	
	                    <div class="post-header">              	         	
		                	<h3><a title="<?php the_title()?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<span class="post-meta">
								<i class="fa fa-clock-o"></i> <?php print get_the_date();?>
							</span>	                	
		                </div>
			        </div>	
		        <?php endwhile;endif;?>        
	        <?php endif;?>
	    <?php 		
	    wp_reset_postdata();wp_reset_query();
		print $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_category'] = strip_tags( $new_instance['post_category'] );
		$instance['post_tag'] = strip_tags( $new_instance['post_tag'] );
		$instance['date'] = strip_tags( $new_instance['date'] );
		$instance['today']	=	esc_attr( $new_instance['today'] );
		$instance['thisweek']	=	esc_attr( $new_instance['thisweek'] );		
		$instance['post_orderby'] = strip_tags( $new_instance['post_orderby'] );
		$instance['post_order'] = strip_tags( $new_instance['post_order'] );
		$instance['widget_column'] = strip_tags( $new_instance['widget_column'] );
		$instance['post_shows'] = strip_tags( $new_instance['post_shows'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Right Sidebar Posts', 'mars'),
			'date'	=>	'',
			'today'	=>	'',
			'thisweek'	=>	'',
			'view_more'	=>	''
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
							'selected'           => isset( $instance['post_category'] ) ? $instance['post_category'] : null,
							'hierarchical'       => 0, 
							'name'               => $this->get_field_name( 'post_category' ),
							'id'                 => $this->get_field_id( 'post_category' ),
							'taxonomy'           => 'category',
							'hide_if_empty'      => true,
							'class'              => 'postform mars-dropdown',
			    		)
		    		);
		    	?>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'post_tag' ); ?>"><?php _e('Post Tag:', 'mars'); ?></label>
		    <input placeholder="<?php _e('Eg: tag1,tag2,tag3','mars');?>" id="<?php echo $this->get_field_id( 'post_tag' ); ?>" name="<?php echo $this->get_field_name( 'post_tag' ); ?>" value="<?php echo ( isset( $instance['post_tag'] ) ? $instance['post_tag'] : null ); ?>" style="width:100%;" />
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
		    <label for="<?php echo $this->get_field_id( 'post_orderby' ); ?>"><?php _e('Orderby:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'post_orderby' ); ?>" name="<?php echo $this->get_field_name( 'post_orderby' ); ?>">
		    	<?php 
		    		foreach ( post_orderby_options() as $key=>$value ){
		    			$selected = ( $instance['post_orderby'] == $key ) ? 'selected' : null;
		    			?>
		    				<option <?php print $selected; ?> value="<?php print $key;?>"><?php print $value;?></option>
		    			<?php 
		    		}
		    	?>
		    </select>
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php _e('Order:', 'mars'); ?></label>
		    <select style="width:100%;" id="<?php echo $this->get_field_id( 'post_order' ); ?>" name="<?php echo $this->get_field_name( 'post_order' ); ?>">
		    	<?php 
		    		foreach ( $this->widget_video_order() as $key=>$value ){
		    			$selected = ( $instance['post_order'] == $key ) ? 'selected' : null;
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
		    <label for="<?php echo $this->get_field_id( 'post_shows' ); ?>"><?php _e('Shows:', 'mars'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'post_shows' ); ?>" name="<?php echo $this->get_field_name( 'post_shows' ); ?>" value="<?php echo isset( $instance['post_shows'] ) ? (int)$instance['post_shows'] : 4; ?>" style="width:100%;" />
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

