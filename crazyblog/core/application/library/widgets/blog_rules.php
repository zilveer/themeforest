<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_blog_rules_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-blog-rules', /* Name */ esc_html__( 'CrazyBlog Blog Rules', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show your blog rules on site.', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {

		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		$settings = crazyblog_opt();
		$rules = crazyblog_set( crazyblog_set( $settings, 'crazyblog_blog_rules' ), 'crazyblog_blog_rules' );
		$counter = 0;
		?>
		<?php if ( !empty( $rules ) ): ?>
			<div class="toggle">
				<?php
				foreach ( $rules as $r ) :
					if ( crazyblog_set( $r, 'tocopy' ) )
						continue;
					if ( crazyblog_set( $instance, 'number' ) == $counter )
						break;
					?>
					<div class="toggle-item">
						<?php echo wp_kses_post( (crazyblog_set( $r, 'title' )) ? "<h3>" . esc_html( crazyblog_set( $r, 'title' ) ) . "</h3>" : ""  ); ?>
						<div class="content">
							<div class="row">
								<div class="col-md-12">
									<?php echo wp_kses_post( (crazyblog_set( $r, 'desc' )) ? "<p>" . esc_html( crazyblog_set( $r, 'desc' ) ) . "</p>" : ""  ); ?>
								</div>
							</div>
						</div><!-- Content -->
					</div><!-- Toggle Item -->
					<?php
					$counter++;
				endforeach;
				?>
			</div>
		<?php endif; ?>

		<?php
		echo wp_kses( $after_widget, true );
	}

	/* Store */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['number'] = crazyblog_set( $new_instance, 'number' );

		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : "Blog Rules";
		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : "5";
		?>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Show Number of Rules:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /> 
		</p>

		<?php
	}

}
