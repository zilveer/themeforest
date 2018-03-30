<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_recent_posts_carousel_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-recent-posts-carousel', /* Name */ esc_html__( 'CrazyBlog Recent Posts Carousel', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show blog recent posts with carousel.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$args = array(
			'post_type' => 'post',
			'post_status' => 'public',
			'showposts' => crazyblog_set( $instance, 'number' ),
			'category_name' => crazyblog_set( $instance, 'pop_cat' ),
		);
		$query = new WP_Query( $args );
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		?>

		<div class="latest-articles">
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>    
					<div class="article">
						<?php the_post_thumbnail( '310x234' ); ?>
						<div class="article-detail">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 110 ); ?>
							<span><?php the_author() ?></span>
							<h5><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h5>
							<p><?php echo wp_trim_words( get_the_content(), crazyblog_set( $instance, 'limit' ), Null ); ?></p>
							<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
							<a href="<?php the_permalink(); ?>" title=""><?php esc_html_e( 'Read More', 'crazyblog' ); ?></a>
						</div>
					</div><!-- Article -->
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div><!-- Latest Articles -->

		<?php
                    $custom_script = 'jQuery(document).ready(function ($) {
				jQuery(".latest-articles").owlCarousel({
					autoplay: true,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: false,
					dots: false,
					nav: true,
					margin: 0,
					mouseDrag: true,
					items: 1,
					singleItem: true,
					autoHeight: true
				});
			});';
                    wp_add_inline_script('crazyblog_df-owl', $custom_script);   
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['number'] = crazyblog_set( $new_instance, 'number' );
		$instance['limit'] = crazyblog_set( $new_instance, 'limit' );
		$instance['pop_cat'] = crazyblog_set( $new_instance, 'pop_cat' );
		return $instance;
	}

	function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : "Recent Post Carousel";
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : 3;
		$limit = ($instance) ? esc_attr( crazyblog_set( $instance, 'limit' ) ) : 3;
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Content limit:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" /> 
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pop_cat' ) ); ?>"><?php esc_html_e( 'Category:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pop_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pop_cat' ) ); ?>">
				<?php
				$categories = crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => false ), true );
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
