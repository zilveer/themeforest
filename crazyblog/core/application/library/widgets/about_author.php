<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_about_author_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-about-author', /* Name */ esc_html__( 'CrazyBlog About Author', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show author profile ', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', crazyblog_set( $instance, 'title' ) );
		echo wp_kses( $before_widget, true );
		if ( $title )
			echo wp_kses( $before_title, true ) . html_entity_decode( $title ) . wp_kses( $after_title, true );
		?>

		<div class="about-author">
			<?php echo get_avatar( crazyblog_set( $instance, 'user' ), 311 ) ?>
			<h3><a title="" href="<?php echo esc_url( get_author_posts_url( crazyblog_set( $instance, 'user' ) ) ); ?>"><?php echo ucwords( get_the_author_meta( 'display_name', crazyblog_set( $instance, 'user' ) ) ); ?></a></h3>     
			<?php echo wp_kses_post( (crazyblog_set( get_the_author_meta( 'roles', crazyblog_set( $instance, 'user' ) ), '0' )) ? "<span>" . crazyblog_set( get_the_author_meta( 'roles', crazyblog_set( $instance, 'user' ) ), '0' ) . "</span>" : ""  ); ?>
			<?php echo wp_kses_post( (get_the_author_meta( 'description', crazyblog_set( $instance, 'user' ) )) ? "<p>" . get_the_author_meta( 'description', crazyblog_set( $instance, 'user' ) ) . "</p>" : '' ); ?>
			<div class="author-social">
				<?php if ( crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_fb' ), '0' ) != "" ) : ?>
					<a title="" href="<?php echo crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_fb' ), '0' ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
				<?php endif; ?>

				<?php if ( crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_tw' ), '0' ) != "" ) : ?>
					<a title="" href="<?php echo crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_tw' ), '0' ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>

				<?php if ( crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_gp' ), '0' ) != "" ) : ?>
					<a title="" href="<?php echo crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_gp' ), '0' ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
				<?php endif; ?>

				<?php if ( crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_dr' ), '0' ) != "" ) : ?>
					<a title="" href="<?php echo crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_dr' ), '0' ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
				<?php endif; ?>

				<?php if ( crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_pint' ), '0' ) != "" ) : ?>
					<a title="" href="<?php echo crazyblog_set( crazyblog_set( get_user_meta( crazyblog_set( $instance, 'user' ) ), 'crazyblog_pint' ), '0' ); ?>" class="pinterest"><i class="fa fa-pinterest"></i></a>
				<?php endif; ?>
			</div>
		</div>


		<?php
		echo wp_kses( $after_widget, true );
	}

	/* Store */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = crazyblog_set( $new_instance, 'title' );
		$instance['user'] = crazyblog_set( $new_instance, 'user' );
		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		$title = ($instance) ? esc_attr( crazyblog_set( $instance, 'title' ) ) : "Author Profile";
		$user = ($instance) ? esc_attr( crazyblog_set( $instance, 'user' ) ) : "";
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'user' ) ); ?>"><?php esc_html_e( 'Select Admin:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'user' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'user' ) ); ?>">
				<?php
				$super_admins = crazyblog_get_registered_authors();
				$selected = '';
				if ( !empty( $super_admins ) )
					foreach ( $super_admins as $id => $name ) {
						if ( $user == $id ) {
							$selected = 'selected="selected"';
						} else {
							$selected = "";
						}
						echo '<option ' . esc_attr( $selected ) . ' value="' . esc_attr( $id ) . '">' . esc_html( $name ) . '</option>';
					}
				?>

			</select>
		</p>


		<?php
	}

}
