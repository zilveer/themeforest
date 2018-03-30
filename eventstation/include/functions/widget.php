<?php
/*------------- LATEST POST WIDGET START -------------*/
function eventstation_latest_posts_register_widgets() {
	register_widget( 'eventstation_latest_Latest_Posts_Widget' );
}
add_action( 'widgets_init', 'eventstation_latest_posts_register_widgets' );

class eventstation_latest_Latest_Posts_Widget extends WP_Widget {
	function eventstation_latest_Latest_Posts_Widget() {
		parent::__construct(
	            'eventstation_latest_Latest_Posts_Widget',
        	    esc_html__( 'Event Station Theme: Latest Posts', 'eventstation' ),
 	           array( 'description' => esc_html__( 'Latest posts widget.', 'eventstation' ), )
		);
	}
	
	function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		$latest_posts_widget_title_control = esc_attr( $instance['latest_posts_widget_title'] );
		if ( !empty( $instance['latest_posts_widget_title'] ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $latest_posts_widget_title_control ) .'</h4></div>';
		}
		
		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( $instance['postfeaturedimage'] ) );
			$postinfo = strip_tags( esc_attr( $instance['postinfo'] ) );
			$postreadmore = strip_tags( esc_attr( $instance['postreadmore'] ) );
			$categorylist = strip_tags( esc_attr( $instance['categorylist'] ) );
			$exclude = strip_tags( esc_attr( $instance['exclude'] ) );
			$offset = strip_tags( esc_attr( $instance['offset'] ) );
		}
		
		/*------------- Exclude Start -------------*/
		if( !empty( $exclude ) ) :
			$exclude = $exclude;
			$exclude = explode( ',', $exclude );
		else:
			$exclude = "";
		endif;
		/*------------- Exclude End -------------*/
		?>
		<?php eventstation_widget_content_before(); ?>
			<div class="eventstation-latest-posts-widget">
				<ul>
					<?php
						$args_latest_posts = array(
							'posts_per_page' => $postcount,
							'post_status' => 'publish',
							'post__not_in' => $exclude,
							'offset' => $offset,
							'ignore_sticky_posts'    => true,
							'post_type' => 'post',
							'cat' => $categorylist
						); 
						$wp_query = new WP_Query($args_latest_posts);
						while ( $wp_query->have_posts() ) :
						$wp_query->the_post();
					?>
					<li>
						<?php if( !empty( $postfeaturedimage ) ): ?>
							<div class="image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'eventstation-latest-posts-widget' );
									}
									?>
								</a>
							</div>
						<?php endif; ?>
						<div class="desc">
							<?php if( !empty( $postinfo ) ): ?>
								<ul class="post-information">
									<li class="date"><i class="fa fa-calendar-check-o"></i> <?php echo esc_html__( 'Date:', 'eventstation' ); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
								</ul>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php if( !empty( $postreadmore ) ): ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><?php echo esc_html__( 'Read More', 'eventstation' ); ?> <i class="fa fa-angle-right"></i></a>
							<?php endif; ?>
						</div>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		<?php eventstation_widget_content_after(); ?>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latest_posts_widget_title'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_title'] ) );
		$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
		$instance['postfeaturedimage'] = strip_tags( esc_attr( $new_instance['postfeaturedimage'] ) );
		$instance['postinfo'] = strip_tags( esc_attr( $new_instance['postinfo'] ) );
		$instance['categorylist'] = strip_tags( esc_attr( $new_instance['categorylist'] ) );
		$instance['postreadmore'] = strip_tags( esc_attr( $new_instance['postreadmore'] ) );
		$instance['exclude'] = strip_tags( esc_attr( $new_instance['exclude'] ) );
		$instance['offset'] = strip_tags( esc_attr( $new_instance['offset'] ) );
		return $instance;
	}

	function form($instance) {
	 	$latest_posts_widget_title = '';
	 	$postcount = '';
		$postfeaturedimage = '';
		$postinfo = '';
		$postreadmore = '';
		$categorylist = '';
	 	$offset = '';
		$exclude = '';

		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( esc_textarea( $instance['postfeaturedimage'] ) ) );
			$postinfo = strip_tags( esc_attr( esc_attr( $instance['postinfo'] ) ) );
			$postreadmore = strip_tags( esc_attr( esc_attr( $instance['postreadmore'] ) ) );
			$categorylist = strip_tags( esc_attr( esc_attr( $instance['categorylist'] ) ) );
			$offset = strip_tags( esc_attr( $instance['offset'] ) );
			$exclude = strip_tags( esc_attr( esc_attr( $instance['exclude'] ) ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'eventstation' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_title ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php esc_html_e( 'Post Count:', 'eventstation' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'categorylist' ) ); ?>"><?php esc_html_e( 'Category:', 'eventstation' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('categorylist') ); ?>" id="<?php echo esc_attr( $this->get_field_id('categorylist') ); ?>" class="widefat"> 
				<option value=""><?php echo esc_html__( 'All Categories', 'eventstation' ); ?></option>
				<?php
				 $categories =  get_categories('child_of=0'); 
				 foreach ($categories as $category) {
					$category_select_control = '';
					if ( $categorylist == $category->cat_ID )
					{
						$category_select_control = "selected";
					}
					$option = '<option value="' . esc_attr( $category->cat_ID ) . '"' . $category_select_control . '>';
					$option .= $category->cat_name;
					$option .= '</option>';
					echo balanceTags( $option );
				 }
				?>
			</select>
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'eventstation' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="text" value="<?php echo esc_attr( $offset ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Posts:', 'eventstation' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $exclude ); ?>" />
		</p>
		 
		<p>
			<input type="checkbox" class="widefat" <?php checked($postfeaturedimage, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postfeaturedimage' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>"><?php esc_html_e( 'Post Image', 'eventstation' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($postinfo, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postinfo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postinfo' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postinfo' ) ); ?>"><?php esc_html_e( 'Post Information', 'eventstation' ); ?></label>
		</p>
		 
		<p>
			<input type="checkbox" class="checkbox" <?php checked($postreadmore, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postreadmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postreadmore' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'postreadmore' ) ); ?>"><?php esc_html_e( 'Read More', 'eventstation' ); ?></label>
		</p>
		
	<?php }
	
}
/*------------- LATEST POST WIDGET END -------------*/