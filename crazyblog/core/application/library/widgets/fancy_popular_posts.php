<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_fancy_popular_posts_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-fancy-popular-posts', /* Name */ esc_html__( 'CrazyBlog Fancy Popular Posts', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show blog popular posts in fancy style.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'showposts' => crazyblog_set( $instance, 'number' ),
			'meta_key' => 'crazyblog_post_views',
			'order' => 'DESC',
			'orderby' => 'meta_value_num'
		);
		if ( (crazyblog_set( $instance, 'pop_cat' ) != 'all' ) )
			$args['category_name'] = crazyblog_set( $instance, 'pop_cat' );
		$query = new WP_Query( $args );
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		?>

		<div class="latest-post-widget">
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
					<div class="sidebar-post">
						<div class="post-thumb">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_370x197' ); ?></a>
						</div>
						<h3><a title="" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
						<ul class="meta">
							<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
							<li><i class="fa fa-comments"></i><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></li>
						</ul>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div><!-- Latest Widget  -->


		<?php
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['number'] = crazyblog_set( $new_instance, 'number' );
		$instance['pop_cat'] = crazyblog_set( $new_instance, 'pop_cat' );
		return $instance;
	}

	function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : esc_html__( 'Fancy Popular Posts', 'crazyblog' );
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : 3;
		$pop_category = ($instance) ? esc_attr( crazyblog_set( $instance, 'pop_cat' ) ) : "";
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 
		</p>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /> 
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pop_cat' ) ); ?>"><?php esc_html_e( 'Category:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pop_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pop_cat' ) ); ?>">
				<?php
				$categories = crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => false, 'show_all' => true ), true );
				$selected = '';
				if ( !empty( $categories ) )
					foreach ( $categories as $slug => $name ) {
						if ( $pop_category == $slug ) {
							$selected = 'selected=selected';
						} else {
							$selected = '';
						}
						echo '<option ' . esc_attr( $selected ) . ' value="' . esc_attr( $slug ) . '">' . esc_html( $name ) . '</option>';
					}
				?>

			</select>
		</p>

		<?php
	}

}
