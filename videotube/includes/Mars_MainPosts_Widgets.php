<?php
/**
 * VideoTube Main Posts Widget
 * Add Main Videos Posts in Home Page, 2-3 column a other options is supported.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !function_exists('Mars_MainPosts_Widgets') ){
	function Mars_MainPosts_Widgets() {
		register_widget('Mars_MainPosts_Widgets_Class');
	}
	add_action('widgets_init', 'Mars_MainPosts_Widgets');
}
class Mars_MainPosts_Widgets_Class extends WP_Widget{
	var $title_length = 31;
	
	function __construct(){
		$widget_ops = array( 'classname' => 'mars-mainpost-widgets', 'description' => __('VT Main Posts Widget', 'mars') );
	
		parent::__construct( 'mars-mainpost-widgets' , __('VT Main Posts Widget', 'mars') , $widget_ops);
	}	
	
	function widget($args, $instance){
		extract( $args );
		wp_reset_postdata();wp_reset_query();
		$title = apply_filters('widget_title', $instance['title'] );
		$post_category = isset( $instance['post_category'] ) ? $instance['post_category'] : null;
		$post_tag = isset( $instance['post_tag'] ) ? $instance['post_tag'] : null;
		$post_date = isset( $instance['date'] ) ? $instance['date'] : null;
		$today = isset( $instance['today'] ) ? $instance['today'] : null;
		$thisweek = isset( $instance['thisweek'] ) ? $instance['thisweek'] : null;		
		$post_orderby = isset( $instance['post_orderby'] ) ? $instance['post_orderby'] : 'ID';
		$post_order = isset( $instance['post_order'] ) ? $instance['post_order'] : 'DESC';
		$widget_column = isset( $instance['widget_column'] ) ? $instance['widget_column'] : 3;
		$class_columns = ( 12%$widget_column == 0 ) ? 12/$widget_column : 4;
		$post_shows = isset( $instance['post_shows'] ) ? (int)$instance['post_shows'] : 16;  
		$post_rows = isset( $instance['rows'] ) ? (int)$instance['rows'] : 1;
		$autoplay = isset( $instance['auto'] ) ? $instance['auto'] : null;
		$i=0;
		$posts_query = array(
			'post_type'	=>	'post',
			'posts_per_page'	=>	$post_shows,
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
		if( $post_date ){
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
		
		$posts_query	=	apply_filters( 'mars_main_widget_args' , $posts_query, $this->id);
		
		$wp_query = new WP_Query( $posts_query );	
		$colum = $widget_column;
		?>
			<?php if( $widget_column == 3 ):?>
          		<div id="carousel-latest-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id?> slide video-section" data-ride="carousel">
          	<?php elseif ( $widget_column ==2 ):?>
          		<div class="row video-section meta-maxwidth-360">
          	<?php else:?>
          		<div id="carousel-latest-<?php print $this->id; ?>" class="carousel carousel-<?php print $this->id?> slide video-section" <?php if($post_shows>3):?> data-ride="carousel"<?php endif;?>>
          	<?php endif;?>
          		<?php if( $widget_column == 3 ):?>
                    <div class="section-header">
                <?php elseif ( $widget_column ==2 ):?>
                	<div class="col-sm-12 section-header">
	          	<?php else:?>
	          		<div class="section-header">
	          	<?php endif;?>
	          			<?php if( ! empty( $title ) ):?>
	          				
	          				<?php if( ! empty( $instance['view_more'] ) ):?>
	          					<h3><i class="fa fa-pencil"></i> <a href="<?php print esc_url( $instance['view_more'] );?>"><?php print $title;?></h3>
	          				<?php else:?>
	          					<h3><i class="fa fa-pencil"></i> <?php print $title;?></h3>
	          				<?php endif;?>
	          				
                        <?php endif;?>
                        <?php if( $widget_column != 2 ):?>
				            <?php if( $post_shows >= $wp_query->post_count && $post_shows > $colum*$post_rows):?>
					            <ol class="carousel-indicators section-nav">
					            	<li data-target="#carousel-latest-<?php print $this->id; ?>" data-slide-to="0" class="bullet active"></li>
					                <?php 
					                	$c = 0;
					                	for ($j = 1; $j < $wp_query->post_count; $j++) {
					                		if ( $j % ($colum*$post_rows) == 0 && $j < $post_shows ){
						                    	$c++;
						                    	print '<li data-target="#carousel-latest-'.$this->id.'" data-slide-to="'.$c.'" class="bullet"></li> '; 
						                    }	
					                	}
					                ?>
					            </ol>
				            <?php endif;?>
	                    <?php else:?>
	                    	<?php if( ! empty( $instance['view_more'] ) ):?>
								<div class="section-nav">
									<a href="<?php print esc_url( $instance['view_more'] );?>" class="viewmore"><?php _e('View More','mars');?> <i class="fa fa-angle-double-right"></i></a>
								</div>
							<?php endif;?>
	                    <?php endif;?>
                    </div>
                    
                   	<?php if( $widget_column == 2 ):?>
                   		<?php if( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();?>               	
						<div id="post-main-<?php print $this->id; ?>-<?php the_ID();?>" <?php post_class('col-sm-'.$class_columns.' responsive-height item');?>>
							<?php 
								if(has_post_thumbnail()){
									print '<a href="'.get_permalink().'" title="'.get_the_title().'">'. get_the_post_thumbnail(null,'video-featured', array('class'=>'img-responsive')) . '</a>';
								}
                                ?>
                            <div class="post-header">
								<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<span class="post-meta">
									<i class="fa fa-clock-o"></i> <?php print get_the_date();?>
								</span>
							</div>
						</div>
						<?php endwhile;endif;?>
												
                    <?php elseif( $widget_column ==2) :?>
					<!-- 1 colum -->

                    <div class="gaming-wrapper">
                       	<div class="carousel-inner">
	                       	<?php
	                       	if( $wp_query->have_posts() ) : 
		                       	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		                       	$i++;
		                       	?>
		                       	<?php if( $i ==1 ):?>
		                       		<div class="item active">
		                       	<?php endif;?>
                                    <div class="row">
                                        <div class="col-sm-5 item list">
                                        	<?php 
                                        		if( has_post_thumbnail() ){
                                        			print '<a href="'.get_permalink().'" title="'.get_the_title().'">'. get_the_post_thumbnail(null,'video-category-featured', array('class'=>'img-responsive')) . '</a>';
                                        		}
                                        	?>                                    	
                                        </div>
                                        <div class="col-sm-7 item list post <?php print $this->id; ?>-<?php print get_the_ID();?>">
                                        	<div class="post-header">
                                            	<h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
												<span class="post-meta">
													<i class="fa fa-clock-o"></i> <?php print get_the_date();?>
												</span>                                            	
                                            </div>
                                            <?php the_excerpt();?> 
                                            <p><a href="<?php the_permalink();?>"><i class="fa"></i><?php _e('Read More','mars')?></a></p>
                                        </div>
                                    </div>
				                    <?php
				                    //if ( $i % 3 == 0 && $i < 18 ){
				                    if ( $i % $post_rows == 0 && $i < $post_shows ){
				                    	?></div><div class="item"><?php 
				                    } 
			                       	endwhile;
				                      ?></div>
				             <?php endif;?>
				             </div>
			         </div>
					<!-- end 1 colum -->
					
                    <?php else:?>
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
				                       		<div id="post-main-<?php print $this->id; ?>-<?php the_ID();?>" <?php post_class('col-sm-'.$class_columns.' col-xs-6');?>>
												<?php 
													if(has_post_thumbnail()){
														print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,'video-lastest', array('class'=>'img-responsive')) .'</a>';
													}
												?>
												<div class="post-header">
		                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		                                            <span class="post-meta">
		                                            	<i class="fa fa-clock-o"></i> <?php print get_the_date();?>
		                                            </span>
	                                            </div>
		                                     </div> 
					                    <?php
					                    if ( $i % ($widget_column*$post_rows) == 0 && $i < $post_shows ){
					                    	?></div><div class="item"><?php 
					                    } 	             
				                       	endwhile;
				                      ?></div><?php 
			                       	endif;
			                       	?> 
			                        </div>
	                            </div>
	                    </div>					
					
                    <?php endif;?>
                </div><!-- /#carousel-->
				<?php if( $autoplay == 'on' ):?>
				<script>
					(function($) {
					  "use strict";
					  	jQuery(document).ready(function() {
						  try {
							  jQuery('#carousel-latest-<?php print $this->id; ?>').carousel({
									 pause: false
								});
							  }
							  catch (e) {
								 console.log('Main Post carousel is not working');
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
		$instance['post_category'] = strip_tags( $new_instance['post_category'] );
		$instance['post_tag'] = strip_tags( $new_instance['post_tag'] );
		$instance['date'] = strip_tags( $new_instance['date'] );
		$instance['today']	=	esc_attr( $new_instance['today'] );
		$instance['thisweek']	=	esc_attr( $new_instance['thisweek'] );		
		$instance['post_orderby'] = strip_tags( $new_instance['post_orderby'] );
		$instance['post_order'] = strip_tags( $new_instance['post_order'] );
		$instance['widget_column'] = strip_tags( $new_instance['widget_column'] );
		$instance['post_shows'] = strip_tags( $new_instance['post_shows'] );
		$instance['rows'] = strip_tags( $new_instance['rows'] );
		$instance['auto'] = strip_tags( $new_instance['auto'] );
		$instance['view_more'] = strip_tags( $new_instance['view_more'] );
		return $instance;		
		
	}
	function form( $instance ){
		$defaults = array( 
			'title' => __('Latest Posts', 'mars'),
			'view_more'	=>	'',
			'widget_column'	=>	3,
			'today'		=>	'',
			'thisweek'	=>	''				
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mars'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'post_category' ); ?>"><?php _e('Category:', 'mars'); ?></label>
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
		    		foreach ( $this->widget_post_column() as $key=>$value ){
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
		    <input id="<?php echo $this->get_field_id( 'post_shows' ); ?>" name="<?php echo $this->get_field_name( 'post_shows' ); ?>" value="<?php echo (isset( $instance['post_shows'] )) ? (int)$instance['post_shows'] : 16; ?>" style="width:100%;" />
		</p>
		<p>  
		    <label for="<?php echo $this->get_field_id( 'rows' ); ?>"><?php _e('Rows (Available with 3 or 1 Column):', 'mars'); ?></label>
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
	function widget_post_column(){
		return array(
			'6'	=>	__('6 Columns - Carousel','mars'),
			'4'	=>	__('4 Columns - Carousel','mars'),
			'3'	=>	__('3 Columns - Carousel','mars'),
			'2'	=>	__('2 Columns','mars'),
			'1'	=>	__('1 Column - Carousel','mars'),
		);
	}
	function widget_video_order(){
		return array(
			'DESC'	=>	__('DESC','mars'),
			'ASC'	=>	__('ASC','mars')
		);
	}	
}