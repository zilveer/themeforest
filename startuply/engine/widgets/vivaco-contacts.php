<?php

/** Vivaco Contacts widget **/


class VSC_Widget_Contacts extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$widget_ops = array('classname' => 'widget_contacts', 'description' => __( 'Your site&#8217;s contacts info.' , 'vivaco' ) );

		parent::__construct(
			'contacts_sply_widget', // Base ID
			__('Contacts' , 'vivaco'),
			$widget_ops // Args
		);

		$this->alt_option_name = 'widget_contacts';
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
		$our_email = $instance['our_email'];
		$our_address = $instance['our_address'];
		$our_telephone = $instance['our_telephone'];

		# Output
		//WMPL
		/**
		 * retreive translations
		 */
		if (function_exists ( 'icl_translate' )){
			$title = icl_translate('Widgets', 'Startuply Contacts Widget - Title', $instance['title']);
			$our_email = icl_translate('Widgets', 'Startuply Contacts Widget - Email', $instance['our_email']);
			$our_address = icl_translate('Widgets', 'Startuply Contacts Widget - Address', $instance['our_address']);
			$our_telephone = icl_translate('Widgets', 'Startuply Contacts Widget - Telephone', $instance['our_telephone']);
		}
		//\WMPL
		$title = apply_filters( 'widget_title', $title );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo '<div class="footer-title">'.$before_title . $title . $after_title.'</div>';
		?>
		<ul class="list-unstyled">
			<?php if ($our_email && strlen(trim($our_email)) > 0 ) { ?>
			<li>
				<span class="icon icon-chat-messages-14"></span>
				<a href="mailto:<?php echo $our_email; ?>"><?php echo $our_email; ?></a>
			</li>
			<?php } ?>
			<?php if ($our_address && strlen(trim($our_address)) > 0 ) { ?>
			<li>
				<span class="icon icon-seo-icons-34"></span>
				<?php echo $our_address; ?>
			</li>
			<?php } ?>
			<?php if ($our_telephone && strlen(trim($our_telephone)) > 0 ) { ?>
			<li>
				<span class="icon icon-seo-icons-17"></span>
				<?php echo $our_telephone; ?>
			</li>
			<?php } ?>
		</ul>
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

		$instance['our_email'] = strip_tags( $new_instance['our_email'] );
		if ( current_user_can('unfiltered_html') ) {
			$instance['our_address'] = $new_instance['our_address'];
		}
		else {
			$instance['our_address'] = strip_tags($new_instance['our_address']);
		}

		$instance['our_telephone'] = strip_tags( $new_instance['our_telephone'] );


		//WMPL
		/**
		 * register strings for translation
		 */
		if (function_exists ( 'icl_register_string' )){
			icl_register_string('Widgets', 'Startuply Contacts Widget - Title', $instance['title']);
			icl_register_string('Widgets', 'Startuply Contacts Widget - Email', $instance['our_email']);
			icl_register_string('Widgets', 'Startuply Contacts Widget - Address', $instance['our_address']);
			icl_register_string('Widgets', 'Startuply Contacts Widget - Telephone', $instance['our_telephone']);
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
				'title' => __( 'Our Contacts', 'vivaco' ),
				'our_email' => 'office@vivaco.com',
				'our_address' => '2901 Marmora road, Glassgow,<br> Seattle, WA 98122-1090',
				'our_telephone' => '+9 500 750',
			)
		);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'our_email' ); ?>"><?php _e( 'Email:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'our_email' ); ?>" name="<?php echo $this->get_field_name( 'our_email' ); ?>" type="text" value="<?php echo esc_attr( $instance['our_email'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'our_address' ); ?>"><?php _e( 'Address:', 'vivaco' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'our_address' ); ?>" name="<?php echo $this->get_field_name( 'our_address' ); ?>"><?php echo esc_textarea( $instance['our_address'] ); ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'our_telephone' ); ?>"><?php _e( 'Telephone:', 'vivaco' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'our_telephone' ); ?>" name="<?php echo $this->get_field_name( 'our_telephone' ); ?>" type="text" value="<?php echo esc_attr( $instance['our_telephone'] ); ?>" />
		</p>

		<?php
	}

} // class VSC_Widget_Contacts
