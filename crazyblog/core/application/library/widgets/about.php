<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_About_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-about-us', /* Name */ esc_html__( 'CrazyBlog About Us', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show about company introduction in footer.', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {

		extract( $args );
		//$title = apply_filters( 'widget_title', crazyblog_set($instance, 'title'));
		echo wp_kses( $before_widget, true );
		//if($title) echo wp_kses($before_title, true).html_entity_decode($title).wp_kses($after_title, true);
		$settings = crazyblog_opt();
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		?>
		<div class="about-widget">
			<div class="about-logo">
				<img alt="" src="<?php echo esc_url( crazyblog_set( $instance, 'logo' ) ); ?>">
			</div>
			<?php echo wp_kses_post( (crazyblog_set( $instance, 'desc' )) ? "<p>" . crazyblog_set( $instance, 'desc' ) . "</p>" : ""  ); ?>
			<?php if ( crazyblog_set( $instance, 'address' ) != '' || crazyblog_set( $instance, 'email' ) != '' || crazyblog_set( $instance, 'phone' ) != '' ): ?>
				<ul>
					<?php echo wp_kses_post( (crazyblog_set( $instance, 'address' )) ? "<li><i class='fa fa-home'></i>" . crazyblog_set( $instance, 'address' ) . "</li>" : ""  ); ?>	
					<?php echo wp_kses_post( (crazyblog_set( $instance, 'email' )) ? "<li><i class='fa fa-envelope'></i>" . crazyblog_set( $instance, 'email' ) . "</li>" : ""  ); ?>	
					<?php echo wp_kses_post( (crazyblog_set( $instance, 'phone' )) ? "<li><i class='fa fa-phone'></i>" . crazyblog_set( $instance, 'phone' ) . "</li>" : ""  ); ?>	
				</ul>
			<?php endif; ?>
			<?php if ( !empty( $social ) && crazyblog_set( $instance, 'social' ) == "yes" ) : ?>
				<div class="simple-social">
					<?php
					array_pop( $social );
					foreach ( $social as $s ) :
						$bg = crazyblog_set( $s, 'icon_color' );
						?>
						<a <?php echo (!empty( $bg )) ? 'style=background:' . $bg . ';' : '' ?> href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title=""><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
		echo wp_kses( $after_widget, true );
	}

	/* Store */

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['logo'] = $new_instance['logo'];
		$instance['social'] = $new_instance['social'];

		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		$description = ($instance) ? crazyblog_set( $instance, 'desc' ) : '';
		$address = ($instance) ? crazyblog_set( $instance, 'address' ) : '';
		$phone = ($instance) ? crazyblog_set( $instance, 'phone' ) : '';
		$email = ($instance) ? crazyblog_set( $instance, 'email' ) : '';
		$social = ($instance) ? crazyblog_set( $instance, 'social' ) : '';
		$logo = ($instance) ? crazyblog_set( $instance, 'logo' ) : '';
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'crazyblog' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" type="text"><?php echo esc_attr( $description ); ?> </textarea>
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" /> 
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone Number:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" /> 
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php esc_html_e( 'Email:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" /> 
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>"><?php esc_html_e( 'Show Social:', 'crazyblog' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>">
				<?php
				$selected = '';
				$options = array( 'yes' => 'Enable', 'no' => 'Disable' );
				foreach ( $options as $key => $val ) {
					$selected = ( $social == $key ) ? 'selected="selected"' : '';
					echo '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
				}
				?>

			</select>
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>"><?php esc_html_e( 'Logo Link:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo' ) ); ?>" type="text" value="<?php echo esc_attr( $logo ); ?>" />
		</p>

		<?php
	}

}
