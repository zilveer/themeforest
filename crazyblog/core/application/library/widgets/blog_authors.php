<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_blog_authors_Widget extends WP_Widget {

	function __construct() {

		parent::__construct( /* Base ID */'crazyblog-blog-authors', /* Name */ esc_html__( 'CrazyBlog Authors', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show blog authors.', 'crazyblog' ) ) );
	}

	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );

		echo wp_kses( $before_widget, true );

		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		$counter = 0;
		?>



		<div class="cat-author">

			<?php echo wp_kses_post( (crazyblog_set( $instance, 'desc' )) ? "<p>" . esc_html( crazyblog_set( $instance, 'desc' ) ) . "</p>" : "" ); ?>

			<?php
			$authors = crazyblog_get_registered_authors();

			if ( !empty( $authors ) ) : foreach ( $authors as $id => $name ):

					if ( $counter == crazyblog_set( $instance, 'number' ) )
						break;
					?>

					<div class="author">

						<?php echo get_avatar( $id, 110 ); ?>

						<div class="author-name">

							<strong><a title="" href="<?php echo esc_url( get_author_posts_url( $id ) ); ?>"><?php echo get_the_author_meta( 'display_name', $id ); ?></a></strong>

							<span><?php echo crazyblog_set( get_the_author_meta( 'roles', $id ), '0' ); ?></span>

						</div>

					</div><!-- Author -->

					<?php
					$counter++;
				endforeach;
			endif;
			?>

		</div>

		<?php
		echo wp_kses( $after_widget, true );
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = crazyblog_set( $new_instance, 'title' );

		$instance['number'] = crazyblog_set( $new_instance, 'number' );
		$instance['desc'] = crazyblog_set( $new_instance, 'desc' );

		return $instance;
	}

	function form( $instance ) {

		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : "Blog Authors List";

		$number = ($instance) ? esc_attr( crazyblog_set( $instance, 'number' ) ) : "3";
		$desc = ($instance) ? esc_attr( crazyblog_set( $instance, 'desc' ) ) : "";
		?>

		<p>    

			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 

		</p>

		<p>    

			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Author:', 'crazyblog' ); ?></label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" /> 

		</p>


		<p>    

			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'crazyblog' ); ?></label>

			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" type="text"><?php echo esc_attr( $desc ); ?></textarea>

		</p>



		<?php
	}

}
