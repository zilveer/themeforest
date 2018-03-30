<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_about_with_newsletter_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( /* Base ID */'crazyblog-about-with-newsletter', /* Name */ esc_html__( 'CrazyBlog About with Newsletter', 'crazyblog' ), array( 'description' => esc_html__( 'This widget is used to show company introduction with newsletter.', 'crazyblog' ) ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		echo wp_kses( $before_widget, true );
		$settings = crazyblog_opt();
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		array_pop( $social );
		?>
		<div class="about-widget">
			<div class="about-logo"><img alt="" src="<?php echo esc_url( crazyblog_set( $instance, 'logo' ) ); ?>"></div>
			<?php echo wp_kses_post( (crazyblog_set( $instance, 'desc' )) ? "<p>" . crazyblog_set( $instance, 'desc' ) . "</p>" : ""  ); ?>
			<div class="notifications"></div>
			<form class="subscribtion footer-newsletter">
				<input type="text" class="subscribe-email" placeholder="<?php esc_html_e( 'Subscribe Your Email', 'crazyblog' ); ?>">
				<button type="submit" class="subscribe-submit"><?php esc_html_e( 'Done', 'crazyblog' ); ?><i class="fa fa-cog"></i></button>
				<div class="subs-loader"></div>
			</form>
			<?php if ( count( $social ) > 0 && crazyblog_set( $instance, 'social' ) == "yes" ) : ?>
				<div class="simple-social">
					<?php
					foreach ( $social as $s ) :
						$bg = crazyblog_set( $s, 'icon_color' );
						?>
						<a <?php echo (!empty( $bg )) ? 'style=background:' . $bg . ';' : '' ?> href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title="">
							<i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i>
						</a>
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
		$instance['logo'] = $new_instance['logo'];
		$instance['social'] = $new_instance['social'];


		return $instance;
	}

	/* Settings */

	public function form( $instance ) {
		$description = ($instance) ? crazyblog_set( $instance, 'desc' ) : '';
		$logo = ($instance) ? crazyblog_set( $instance, 'logo' ) : '';
		$social = ($instance) ? crazyblog_set( $instance, 'social' ) : '';

		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		?>
		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Description:', 'crazyblog' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" type="text"><?php echo esc_attr( $description ); ?> </textarea>
		</p>

		<p>    
			<label for="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>"><?php esc_html_e( 'Logo Link:', 'crazyblog' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logo' ) ); ?>" type="text" value="<?php echo esc_attr( $logo ); ?>" />
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


		<?php
	}

}
