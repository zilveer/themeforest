<?php 

/** Vivaco About widget **/

class VSC_Widget_About extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_about', 'description' => __( 'Your site&#8217;s about info.' , 'vivaco' ) );

		parent::__construct(
			'about_sply_widget', // Base ID
			__('About' , 'vivaco'),
			$widget_ops // Args
		);

		$this->alt_option_name = 'widget_about';

		add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
		add_action('admin_enqueue_styles', array($this, 'upload_styles'));
	}

	/**
	 * Upload the Javascripts for the media uploader
	 */
	public function upload_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('upload_media_widget', get_template_directory_uri().'/js/upload-media.js', array('jquery'));
	}

	/**
	 * Add the styles for the upload media box
	 */
	public function upload_styles() {
		wp_enqueue_style('thickbox');
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$title = $instance['title'];
		$description = $instance['description'];
		$author = $instance['author'];

		# Output
		//WMPL
		/**
		 * retreive translations
		 */
		if (function_exists ( 'icl_translate' )){
			$title = icl_translate('Widgets', 'Startuply About Widget - Title', $instance['title']);
			$description = icl_translate('Widgets', 'Startuply About Widget - Description', $instance['description']);
			$author = icl_translate('Widgets', 'Startuply About Widget - Author', $instance['author']);
		}

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( !empty( $title ) ) {
			echo '<div class="footer-title">'.$before_title . $title . $after_title.'</div>';
		}

		$logo_img = $logo_retina_img = '';
		$options = startuply_get_all_option();

		if ( !empty( $instance['bg_image'] ) ) {
			$logo_img = '<img src="' . $instance['bg_image'] . '" alt="">';

			if ( !empty( $instance['retina_bg_image'] ) ) {
				$logo_retina_img = '<img class="retina" src="' . $instance['retina_bg_image'] . '" alt="">';
			} else {
				$logo_retina_img = '<img class="retina" src="' . $instance['bg_image'] . '" alt="">';
			}
		} else if (!empty($options['site_logo'])) {
			$logo_img = '<img src="' . $options['site_logo'] . '" alt="">';

			// Startuply retina logo
			if (!empty($options['retina_site_logo'])) {
				$logo_retina_img = '<img class="retina" src="' . $options['retina_site_logo'] . '" alt="">';
			} else {
				$logo_retina_img = '<img class="retina" src="' . $options['site_logo'] . '" alt="">';
			}

		} else {
			$logo_img = '<img src="' . get_template_directory_uri() . '/images/logo-white.png" alt="">';
			$logo_retina_img = '<img class="retina" src="' . get_template_directory_uri() . '/images/logo-white-retina.png" alt="">';

		}

		?>

			<div class="logo-wrapper">
				<div class="brand-logo">
					<a href="/" class="logo">
						<?php echo $logo_img; ?>
						<?php echo $logo_retina_img; ?>
					</a>
				</div>
			</div>
			<p>
				<?php echo $description; ?>
			<br>
				<strong><?php echo $author; ?></strong>
			</p>

		<?php
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can('unfiltered_html') ) {
			$instance['description'] = $new_instance['description'];
		} else {
			$instance['description'] = strip_tags( $new_instance['description'] );
		}

		$instance['author'] = strip_tags( $new_instance['author'] );
		$instance['bg_image'] = strip_tags( $new_instance['bg_image'] );
		$instance['retina_bg_image'] = strip_tags( $new_instance['retina_bg_image'] );

        //WMPL
        /**
         * retreive translations
         */
        if (function_exists ( 'icl_translate' )){
			icl_register_string('Widgets', 'Startuply About Widget - Title', $instance['title']);
			icl_register_string('Widgets', 'Startuply About Widget - Description', $instance['description']);
			icl_register_string('Widgets', 'Startuply About Widget - Author', $instance['author']);
        }
        //\WMPL

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'title' => '',
				'description' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco. Qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
				'author' => 'John Doeson, Founder.',
				'bg_image' => '',
				'retina_bg_image' => ''
			)
		);

		$title = $instance[ 'title' ];
		$description = $instance[ 'description' ];
		$author = $instance[ 'author' ];
		$bg_image = $instance[ 'bg_image' ];
		$retina_bg_image = $instance[ 'retina_bg_image' ];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'bg_image' ); ?>"><?php _e( 'Footer logo:', 'vivaco' ); ?></label>
			<input name="<?php echo $this->get_field_name( 'bg_image' ); ?>" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $bg_image ); ?>" />
			<input class="upload_image_button" type="button" value="Upload Image" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'retina_bg_image' ); ?>"><?php _e( 'Retina @2x footer logo:', 'vivaco' ); ?></label>
			<input name="<?php echo $this->get_field_name( 'retina_bg_image' ); ?>" id="<?php echo $this->get_field_id( 'retina_bg_image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $retina_bg_image ); ?>" />
			<input class="upload_image_button" type="button" value="Upload Image" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'vivaco' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_textarea( $description ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'Author:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" type="text" value="<?php echo esc_attr( $author ); ?>" />
		</p>
		<?php
	}

} // class VSC_Widget_About
