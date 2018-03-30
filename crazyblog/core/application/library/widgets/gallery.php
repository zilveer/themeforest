<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_gallery_Widget extends WP_Widget {

	static $counter = 0;

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-gallery', /* Name */ esc_html__( 'CrazyBlog Gallery', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show gallery posts.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl', 'df-poptrox' ) );
		$args = array(
			'post_type' => 'crazyblog_gallery',
			'post_status' => 'publish',
			'p' => crazyblog_set( $instance, 'newgal_post' ),
		);

		$query = new WP_Query( $args );
		$counter = 0;
		?>

		<div class="photos-carousel photos-carousel-<?php echo self::$counter ?>">
			<div class="gallery-slide lightbox">
				<?php
				if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
						$post_meta = get_post_meta( get_the_ID(), 'crazyblog_crazyblog_gallery_meta', true );
						$gallery = crazyblog_set( crazyblog_set( $post_meta, 'galleries_setting' ), '0' );
						$gallery = explode( ",", crazyblog_set( $gallery, 'gallery_opt' ) );

						if ( !empty( $gallery ) ) :
							foreach ( $gallery as $g ) :
								if ( $counter == crazyblog_set( $instance, 'number' ) )
									break;
								if ( $counter % 6 == 0 && $counter != 0 )
									echo '</div><div class="gallery-slide lightbox">';
								?>
								<div class="col-md-4">
									<a href="<?php echo esc_url( crazyblog_set( wp_get_attachment_image_src( $g, 'full' ), '0' ) ); ?>" title="">
										<img src="<?php echo esc_url( crazyblog_set( wp_get_attachment_image_src( $g, 'thumbnail' ), '0' ) ); ?>" alt="" /><i class="fa fa-search"></i>
									</a>
								</div>
								<?php
								$counter++;
							endforeach;
						endif;
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div><!-- Gallery Slide -->
		</div><!-- Gallery Carousel -->
		<?php if ( crazyblog_set( $instance, 'link' ) != '' ): ?>
			<a class="viewmore" href="<?php echo esc_url( crazyblog_set( $instance, 'link' ) ); ?>" title=""><?php echo esc_html( crazyblog_set( $instance, 'viewmore' ) ) ?><i class="fa fa-angle-double-right"></i></a>
		<?php endif; ?>
		<?php
		$custom_script = 'jQuery(document).ready(function () {
		        var foo = jQuery(".gallery-slide");
		        foo.poptrox({
		            usePopupNav: true,
		        });
		        jQuery(".photos-carousel-' . esc_js( self::$counter ) . '").owlCarousel({
		            autoplay: true,
		            autoplayTimeout: 2500,
		            smartSpeed: 2000,
		            autoplayHoverPause: true,
		            loop: false,
		            dots: false,
		            nav: true,
		            margin: 0,
		            mouseDrag: true,
		            singleItem: true,
		            autoHeight: true,
		            items: 1
		        });
		    });';
		wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['number'] = crazyblog_set( $new_instance, 'number' );
		$instance['link'] = crazyblog_set( $new_instance, 'link' );
		$instance['viewmore'] = crazyblog_set( $new_instance, 'viewmore' );
		$instance['newgal_post'] = crazyblog_set( $new_instance, 'newgal_post' );

		return $instance;
	}

	function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : esc_html__( "Our Gallery", 'crazyblog' );
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : 3;
		$link = ($instance) ? esc_attr( crazyblog_set( $instance, 'link' ) ) : '';
		$newgal_post = ($instance) ? esc_attr( crazyblog_set( $instance, 'newgal_post' ) ) : '';
		$viewmore = ($instance) ? esc_attr( crazyblog_set( $instance, 'viewmore' ) ) : esc_html__( "Our Gallery", 'crazyblog' );
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
			<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" /> 
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'viewmore' ) ); ?>"><?php esc_html_e( 'View More:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'viewmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'viewmore' ) ); ?>" type="text" value="<?php echo esc_attr( $viewmore ); ?>" /> 
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'newgal_post' ) ); ?>"><?php esc_html_e( 'Select Post:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newgal_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newgal_post' ) ); ?>">
				<?php
				$post_list = array_flip( crazyblog_get_posts_array( 'crazyblog_gallery', true ) );
				$selected = '';
				if ( !empty( $post_list ) )
					foreach ( $post_list as $slug => $name ) {
						if ( $newgal_post == $slug ) {
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
