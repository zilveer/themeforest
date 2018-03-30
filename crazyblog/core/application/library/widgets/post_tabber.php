<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_post_tabber_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-post-tabs', /* Name */ esc_html__( 'CrazyBlog Post Tabs', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show blog recent posts and popular posts with tabs.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-min' ) );
		?>

		<div class="tabs-widget">
			<ul class="nav nav-tabs"> 
				<li class="active"><a data-toggle="tab" href="#popular2"><?php esc_html_e( 'Popular', 'crazyblog' ); ?></a></li> 
				<li><a data-toggle="tab" href="#recent2"><?php esc_html_e( 'Recent', 'crazyblog' ); ?></a></li> 
			</ul>
			<div class="tab-content"> 
				<div id="popular2" class="tab-pane fade in active"> 
					<div class="tabs-posts">
						<?php
						$args = array(
							'post_type' => 'post',
							'post_status' => 'public',
							'showposts' => crazyblog_set( $instance, 'number' ),
							'meta_key' => 'crazyblog_post_views',
							'order' => 'DESC',
							'orderby' => 'meta_value_num'
						);

						if ( (crazyblog_set( $instance, 'pop_cat' ) != 'all' ) )
							$args['category_name'] = crazyblog_set( $instance, 'pop_cat' );
						$query = new WP_Query( $args );
						?>
						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="tab-post">
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_200x200' ); ?></a>
									</div>
									<h5><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h5>
									<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
								</div><!-- Tab Post -->
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div><!-- Tabs Post -->
				</div> 
				<div id="recent2" class="tab-pane fade"> 
					<div class="tabs-posts">
						<?php
						$args = array(
							'post_type' => 'post',
							'post_status' => 'public',
							'showposts' => crazyblog_set( $instance, 'number' ),
						);
						if ( (crazyblog_set( $instance, 'recent_cat' ) != 'all' ) )
							$args['category_name'] = crazyblog_set( $instance, 'recent_cat' );
						$query = new WP_Query( $args );
						?>
						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="tab-post">
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_200x200' ); ?></a>
									</div>
									<h5><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h5>
									<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
								</div><!-- Tab Post -->
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div><!-- Tabs Post -->
				</div>
			</div>
		</div><!-- Tabs Widget -->

		<?php
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['number'] = crazyblog_set( $new_instance, 'number' );
		$instance['recent_cat'] = crazyblog_set( $new_instance, 'recent_cat' );
		$instance['pop_cat'] = crazyblog_set( $new_instance, 'pop_cat' );
		return $instance;
	}

	function form( $instance ) {
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : 3;
		$recent_category = ($instance) ? esc_attr( crazyblog_set( $instance, 'recent_cat' ) ) : "";
		$pop_category = ($instance) ? esc_attr( crazyblog_set( $instance, 'pop_cat' ) ) : "";
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /> 
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'recent_cat' ) ); ?>"><?php esc_html_e( 'Category For Recent Post:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'recent_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'recent_cat' ) ); ?>">
				<?php
				$categories = crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => false, 'show_all' => true ), true );
				$selected = '';
				if ( !empty( $categories ) )
					foreach ( $categories as $slug => $name ) {
						if ( $recent_category == $slug ) {
							$selected = 'selected=selected';
						} else {
							$selected = '';
						}
						echo '<option ' . esc_attr( $selected ) . ' value="' . esc_attr( $slug ) . '">' . esc_html( $name ) . '</option>';
					}
				?>

			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pop_cat' ) ); ?>"><?php esc_html_e( 'Category For Popular Post:', 'crazyblog' ); ?></label>
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
