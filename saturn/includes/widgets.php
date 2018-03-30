<?php
/**
 * Widgets
 */
if( !defined('ABSPATH') ) exit;

if( !function_exists( 'saturn_init_widgets' ) ){
	function saturn_init_widgets() {
		if( class_exists( 'Saturn_Featured_Posts' ) ){
			register_widget('Saturn_Featured_Posts');
		}
	}
	add_action( 'widgets_init' , 'saturn_init_widgets');
}

if( !class_exists( 'Saturn_Featured_Posts' ) ){
	class Saturn_Featured_Posts extends WP_Widget {
		function Saturn_Featured_Posts() {
			parent::__construct(
				'featured-posts', // Base ID
				__('Featured Posts', 'saturn'), // Name
				array( 'description' => __('Archive the Featured Posts', 'saturn')) // Args
			);						
		}
		function widget($args, $instance){
			// reset the query
			wp_reset_postdata();wp_reset_query();
			$title 			= !empty( $instance['title'] ) ? apply_filters('widget_title', esc_attr( $instance['title'] ) ) : null;
			$sticky 		= isset( $instance['sticky'] ) ? esc_attr( $instance['sticky'] ) : 'default';
			$category		= isset( $instance['category'] ) ? absint( $instance['category'] ) : null;
			$post_tag 		= isset( $instance['post_tag'] ) ? esc_attr( $instance['post_tag'] ) : null;
			$post__in 		= isset( $instance['post__in'] ) ? esc_attr( $instance['post__in'] ) : null;
			$post__not_in 	= isset( $instance['post__not_in'] ) ? esc_attr( $instance['post__not_in'] ) : null;
			$orderby 		= isset( $instance['orderby'] ) ? esc_attr( $instance['orderby'] ) : null;
			$order 			= isset( $instance['order'] ) ? esc_attr( $instance['order'] ) : null;
			$showposts 		= isset( $instance['showposts'] ) ? absint( $instance['showposts'] ) : 9;
			$rows 			= isset( $instance['rows'] ) ? absint( $instance['rows'] ) : 1;
			$columns 		= isset( $instance['columns'] ) ? absint( $instance['columns'] ) : 3;
			$class_columns 	= ( 12 % $columns == 0 ) ? 12/$columns : 3;
			// reset the query
			
			$post_data = array(
				'post_type'			=>		'post',
				'post_status'		=>		'publish',
				'posts_per_page'	=>		$showposts,
				'orderby'			=>		( $orderby == 'view' ) ? 'meta_value_num' : $orderby,
				'order'				=>		$order
			);
			// order by views
			if( $orderby == 'view' ){
				$post_data['meta_key']	=	SATURN_POST_VIEWS;
			}
			// $category
			if( !empty( $category ) ){
				$post_data['cat']	=	$category;
			}
			// $post_tag
			if( !empty( $post_tag ) ){
				$post_tag = explode( "," , $post_tag);
				if( is_array( $post_tag ) ){
					$post_data['tag_slug__in']	=	$post_tag;
				}
			}
			// $post__in
			if( !empty( $post__in ) ){
				$post__in = explode( "," , $post__in);
				if( is_array( $post__in ) ){
					$post_data['post__in']	=	$post__in;
				}
			}			
			// $post__not_in
			if( !empty( $post__not_in ) ){
				$post__not_in = explode( "," , $post__not_in);
				if( is_array( $post__not_in ) ){
					$post_data['post__not_in']	=	$post__not_in;
				}
			}
			// $sticky
			if( $sticky == 'ignore_sticky_posts' ){
				$post_data['ignore_sticky_posts']	=	true;
			}
			elseif( $sticky == 'sticky_posts_only' ){
				$sticky_posts = get_option('sticky_posts');
				if( !empty( $sticky_posts ) ){
					// re-sort the id
					rsort($sticky_posts);
					if( isset( $post_data['post__in'] ) ){
						unset( $post_data['post__in'] );
					}
					$post_data['post__in'] = $sticky_posts;
				}
			}
			// $post_format_not_in
			$post_format_not_in = apply_filters( 'saturn_featured_posts_args/post_format_not_in' , array( 'post-format-quote' ));
			if( !empty( $post_format_not_in ) && is_array( $post_format_not_in )){
				$post_data['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $post_format_not_in,
					'operator'	=>	'NOT IN'
				);
			}			

			$post_data = apply_filters( 'saturn_featured_posts_args' , $post_data, $this->id);
			
			if( false === ( $output = get_transient( $this->id ) ) ){
				ob_start();
				$post_query = new WP_Query( $post_data );
				if( $post_query->have_posts() ) :
					?>
						<div id="<?php print esc_attr( $this->id );?>" class="featured-posts carousel slide" data-ride="carousel">
							<div class="container">
								<?php if( !empty( $title ) ):?>
						        <div class="section-header">
						            <h3 class="block-title"><?php print $title;?></h3>
						        </div>
						        <?php endif;?>
					           	<div class="row">
				                    <div class="carousel-inner">
				                    	<?php
				                    		$i=0;
				                    		while ( $post_query->have_posts() ) : $post_query->the_post();
				                    		$i++;
				                    	?>
				                    	<?php if( $i ==1 ):?>
					                        <div class="item active">
					                    <?php endif;?>
					                            <div class="col-sm-<?php print esc_attr( $class_columns );?>">
													<?php function_exists( 'saturn_post_format_content' ) ? saturn_post_format_content() : '';?>
													<?php 
														if( !has_post_thumbnail() && get_post_format() == '' ){
															add_filter( 'excerpt_length', 'saturn_excerpt_length', 999 );
															print '<div class="post-content">';
																the_excerpt();
															print '</div>';
															remove_filter( 'excerpt_length', 'saturn_excerpt_length', 999 );
														}
													?>
					                                <div class="featured-item">
					                                    <div class="featured-item-content">
					                                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					                                        <div class="post-meta">
																<span class="post-date">
																	<time class="entry-date" datetime="<?php the_time('c');?>"><?php print get_the_date();?></time>
																</span>                                           
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                    <?php
					                    if ( $i % ($columns*$rows) == 0 && $i < $showposts ){
					                    	?></div><div class="item"><?php 
					                    } 
				                       	endwhile;
				                      ?></div>
				                   </div>
					            </div>
					            <?php if( $showposts >= $post_query->post_count && $showposts > $columns*$rows ):?>
						            <div class="featured-posts-navigator">
							            <ol class="carousel-indicators section-nav">
							                <li data-target="#<?php print $this->id; ?>" data-slide-to="0" class="bullet active"></li>
							                <?php 
							                	$c = 0;
							                	for ($j = 1; $j < $post_query->found_posts; $j++) {
							                		if ( $j % ($columns*$rows) == 0 && $j < $showposts ){
								                    	$c++;
								                    	print '<li data-target="#'.$this->id.'" data-slide-to="'.$c.'" class="bullet"></li> ';
								                    }	
							                	}
							                ?>
							            </ol>	            
						            </div>
					            <?php endif;?>			            
				            </div>
						</div><!-- end featured posts -->			
					<?php 
				else:
					print '<div class="featured-posts not-found">';
						print '<h3>'.esc_attr( __('Nothing found!','saturn') ).'</h3>';
					print '</div>';
				endif;
				$output = ob_get_clean();
				set_transient( $this->id , $output ,  apply_filters( 'featured-widget/expiration' , '300') );
			}
			print $output;
			wp_reset_postdata();wp_reset_query();
		}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] 			= $new_instance['title'];
			$instance['sticky']			=	esc_attr( $new_instance['sticky'] );
			$instance['category']		=	absint( $new_instance['category'] );
			$instance['post_tag']		=	esc_attr( $new_instance['post_tag'] );
			$instance['post__in']		=	esc_attr( $new_instance['post__in'] );
			$instance['post__not_in']	=	esc_attr( $new_instance['post__not_in'] );
			$instance['orderby']		=	esc_attr( $new_instance['orderby'] );
			$instance['order']			=	esc_attr( $new_instance['order'] );
			$instance['showposts']		=	absint( $new_instance['showposts'] );
			$instance['rows']			=	absint( $new_instance['rows'] );
			$instance['columns']		=	absint( $new_instance['columns'] );
			return $instance;
		}
		function form( $instance ){
			$defaults = array(
				'title' 			=> __('Featured Posts', 'saturn'),
				'sticky'			=>	'default',
				'category'			=>	'',
				'post_tag'			=>	'',
				'post__in'			=>	'',
				'post__not_in'		=>	'',
				'orderby'			=>	'ID',
				'order'				=>	'DESC',
				'showposts'			=>	9,
				'rows'				=>	1,
				'columns'			=>	3
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id( 'title' ));?>"><?php _e('Title:', 'saturn');?></label>
					<input id="<?php echo esc_attr( $this->get_field_id( 'title' ));?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) );?>" value="<?php echo esc_attr( $instance['title'] );?>" style="width:100%;" />
				</p>
				<?php if( function_exists( 'saturn_option_sticky' ) ):?>
					<p>  
					    <label for="<?php echo esc_attr( $this->get_field_id( 'sticky' ) ); ?>"><?php _e('Sticky Posts Query:', 'saturn'); ?></label>
					    <select style="width:100%;" id="<?php echo esc_attr( $this->get_field_id( 'sticky' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sticky' ) ); ?>">
					    	<?php 
					    		foreach ( saturn_option_sticky() as $key=>$value ){
					    			?>
					    				<option <?php selected( esc_attr( $instance['sticky'] ) , esc_attr( $key ), true);?> value="<?php print esc_attr( $key );?>"><?php print esc_attr( $value );?></option>
					    			<?php 
					    		}
					    	?>
					    </select>  
					</p>
				<?php endif;?>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php _e('Category:', 'saturn'); ?></label>
			    	<?php 
						wp_dropdown_categories($args = array(
								'show_option_all'    => 'All',
								'orderby'            => 'ID', 
								'order'              => 'ASC',
								'show_count'         => 1,
								'hide_empty'         => 1, 
								'child_of'           => 0,
								'echo'               => 1,
								'selected'           => isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : null,
								'hierarchical'       => 0, 
								'name'               => esc_attr( $this->get_field_name( 'category' ) ),
								'id'                 => esc_attr( $this->get_field_id( 'category' ) ),
								'taxonomy'           => 'category',
								'hide_if_empty'      => true,
								'class'              => 'postform saturn-dropdown',
				    		)
			    		);
			    	?>
				</p>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'post_tag' ) ); ?>"><?php _e('Tags:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'post_tag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_tag' ) ); ?>" value="<?php echo esc_attr( $instance['post_tag'] ); ?>" style="width:100%;" />
				    <small><?php _e('Put the tag slug, example tag1,tag2,tag3','saturn');?></small>
				</p>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'post__in' ) ); ?>"><?php _e('Specify post to retrieve:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'post__in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post__in' ) ); ?>" value="<?php echo $instance['post__in']; ?>" style="width:100%;" />
				    <small><?php _e('Put the Post ID, separated by a comma(,). Example: 3,5,7,9,10','saturn');?></small>
				</p>
				<p> 
				    <label for="<?php echo esc_attr( $this->get_field_id( 'post__not_in' ) ); ?>"><?php _e('Specify post NOT to retrieve:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'post__not_in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post__not_in' ) ); ?>" value="<?php echo esc_attr( $instance['post__not_in'] ); ?>" style="width:100%;" />
				    <small><?php _e('Put the Post ID, separated by a comma(,). Example: 3,5,7,9,10','saturn');?></small>
				</p>
				<?php if( function_exists( 'saturn_post_orderby' ) ):?>
					<p>  
					    <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php _e('Order by:', 'saturn'); ?></label>
					    <select style="width:100%;" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
					    	<?php 
					    		foreach ( saturn_post_orderby() as $key=>$value ){
					    			?>
					    				<option <?php selected( esc_attr( $instance['orderby'] ) , esc_attr( $key ), true);?> value="<?php print esc_attr( $key );?>"><?php print esc_attr( $value );?></option>
					    			<?php 
					    		}
					    	?>
					    </select>  
					</p>
				<?php endif;?>
				<?php if( function_exists( 'saturn_post_order' ) ):?>
					<p>  
					    <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e('Order:', 'saturn'); ?></label>
					    <select style="width:100%;" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
					    	<?php 
					    		foreach ( saturn_post_order() as $key=>$value ){
					    			?>
					    				<option <?php selected( esc_attr( $instance['order'] ) , esc_attr( $key ), true);?> value="<?php print esc_attr( $key );?>"><?php print esc_attr( $value );?></option>
					    			<?php 
					    		}
					    	?>
					    </select>  
					</p>
				<?php endif;?>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'showposts' ) ); ?>"><?php _e('Show posts:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'showposts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showposts' ) ); ?>" value="<?php echo esc_attr( $instance['showposts'] ); ?>" style="width:100%;" />
				</p>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'rows' ) ); ?>"><?php _e('Rows:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'rows' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rows' ) ); ?>" value="<?php echo esc_attr( $instance['rows'] ); ?>" style="width:100%;" />
				</p>
				<p>  
				    <label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php _e('Columns:', 'saturn'); ?></label>
				    <input id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" value="<?php echo esc_attr( $instance['columns'] ); ?>" style="width:100%;" />
				</p>
				<style>.saturn-dropdown{width:100%;}</style>
			<?php 
		}
	}
}

