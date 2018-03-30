<?php
/**
 * Plugin Name: Greatives Contact Info
 * Description: A widget that displays Contact Info e.g: Address, Phone number.etc.
 * @author		Greatives Team
 * @URI			http://greatives.eu
 */

add_action( 'widgets_init', 'blade_grve_widget_contact_info' );

function blade_grve_widget_contact_info() {
	register_widget( 'Blade_GRVE_Widget_Contact_Info' );
}

class Blade_GRVE_Widget_Contact_Info extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname' => 'grve-contact-info',
			'description' => esc_html__( 'A widget that displays contact info', 'blade' ),
		);
		$control_ops = array(
			'width' => 300,
			'height' => 400,
			'id_base' => 'grve-widget-contact-info',
		);
		parent::__construct( 'grve-widget-contact-info', '(Greatives) ' . esc_html__( 'Contact Info', 'blade' ), $widget_ops, $control_ops );
	}

	function Blade_GRVE_Widget_Contact_Info() {
		$this->__construct();
	}

	function widget( $args, $instance ) {

		$grve_microdata_allowed_html = blade_grve_get_microdata_allowed_html();

		//Our variables from the widget settings.
		extract( $args );

		//Our variables from the widget settings.
		$contact_info_name = apply_filters('wpml_translate_single_string', $instance['name'], 'Widgets', '(Greatives) Contact Info Widget - Name' );
		$contact_info_address = apply_filters('wpml_translate_single_string', $instance['address'], 'Widgets', '(Greatives) Contact Info Widget - Address' );
		$contact_info_phone = apply_filters('wpml_translate_single_string', $instance['phone'], 'Widgets', '(Greatives) Contact Info Widget - Phone' );
		$contact_info_mobile = apply_filters('wpml_translate_single_string', $instance['mobile'], 'Widgets', '(Greatives) Contact Info Widget - Mobile Phone' );
		$contact_info_fax = apply_filters('wpml_translate_single_string', $instance['fax'], 'Widgets', '(Greatives) Contact Info Widget - Fax' );
		$contact_info_mail = apply_filters('wpml_translate_single_string', $instance['mail'], 'Widgets', '(Greatives) Contact Info Widget - Mail' );
		$contact_info_web = apply_filters('wpml_translate_single_string', $instance['web'], 'Widgets', '(Greatives) Contact Info Widget - Website' );
		$microdata = blade_grve_array_value( $instance, 'microdata' );


		echo $before_widget; // XSS OK

		// Display the widget title
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title; // XSS OK
		}

		if ( !empty( $microdata ) ) {
			echo '<div itemscope itemtype="http://schema.org/' . esc_attr( $microdata ) . '">';
		}
		?>

		<ul>

			<?php if ( ! empty( $contact_info_name ) ) { ?>
			<li>
				<i class="fa fa-user"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="name">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_name ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_address ) ) { ?>
			<li>
				<i class="fa fa-home"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<?php echo wp_kses( $contact_info_address, $grve_microdata_allowed_html ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_phone ) ) { ?>
			<li>
				<i class="fa fa-phone"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="telephone">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_phone ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_mobile ) ) { ?>
			<li>
				<i class="fa fa-mobile"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="telephone">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_mobile ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_fax ) ) { ?>
			<li>
				<i class="fa fa-fax"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="faxNumber">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<?php echo esc_html( $contact_info_fax ); ?>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_mail ) ) { ?>
			<li>
				<i class="fa fa-envelope"></i>
				<?php if ( !empty( $microdata ) ) { ?>
				<div class="grve-info-content" itemprop="email">
				<?php } else { ?>
				<div class="grve-info-content">
				<?php } ?>
					<a href="mailto:<?php echo antispambot( $contact_info_mail ); ?>"><?php echo antispambot( $contact_info_mail ); ?></a>
				</div>
			</li>
			<?php } ?>

			<?php if ( ! empty( $contact_info_web ) ) { ?>
			<li>
				<i class="fa fa-link"></i>
				<div class="grve-info-content">
					<a href="<?php echo esc_url( $contact_info_web ); ?>" target="_blank"><?php echo esc_html( $contact_info_web ); ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>


		<?php

		if ( !empty( $microdata ) ) {
			echo '</div>';
		}
		echo $after_widget; // XSS OK
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['mobile'] = strip_tags( $new_instance['mobile'] );
		$instance['fax'] = strip_tags( $new_instance['fax'] );
		$instance['mail'] = strip_tags( $new_instance['mail'] );
		$instance['web'] = strip_tags( $new_instance['web'] );
		$instance['microdata'] = strip_tags( $new_instance['microdata'] );

		//WMPL
		/**
		 * register strings for translation
		 */
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Name', $instance['name'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Address', $instance['address'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Phone', $instance['phone'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Mobile Phone', $instance['mobile'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Fax', $instance['fax'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Mail', $instance['mail'] );
		do_action( 'wpml_register_single_string', 'Widgets', '(Greatives) Contact Info Widget - Website', $instance['web'] );

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array(
			'title' => '',
			'name' => '',
			'address' => '',
			'phone' => '',
			'mobile' => '',
			'fax' => '',
			'mail' => '',
			'web' => '',
			'microdata' => '',
		);

		$grve_microdata_allowed_html = blade_grve_get_microdata_allowed_html();

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" value="<?php echo esc_attr( $instance['name'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php esc_html_e( 'Address:', 'blade' ); ?> <?php esc_html_e( '( Allowed tags: span, br )', 'blade' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" style="width:100%;"><?php echo wp_kses( $instance['address'] , $grve_microdata_allowed_html ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php esc_html_e( 'Phone:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>"><?php esc_html_e( 'Mobile Phone:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mobile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mobile' ) ); ?>" value="<?php echo esc_attr( $instance['mobile'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>"><?php esc_html_e( 'Fax:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fax' ) ); ?>" value="<?php echo esc_attr( $instance['fax'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>"><?php esc_html_e( 'Mail:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'mail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mail' ) ); ?>" value="<?php echo esc_attr( $instance['mail'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>"><?php esc_html_e( 'Website:', 'blade' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'web' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'web' ) ); ?>" value="<?php echo esc_attr( $instance['web'] ); ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'microdata' ) ); ?>"><?php echo esc_html__( 'Microdata ( Schema.org ):', 'blade' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id('microdata') ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'microdata' ) ); ?>" style="width:100%;">
				<?php $microdata = $instance['microdata']; ?>
				<option value="" <?php selected( '', $microdata ); ?>><?php echo esc_html__( 'None', 'blade' ); ?></option>
				<option value="Person" <?php selected( 'Person', $microdata ); ?>><?php esc_html_e( 'Person', 'blade' ); ?></option>
				<option value="Organization" <?php selected( 'Organization', $microdata ); ?>><?php esc_html_e( 'Organization', 'blade' ); ?></option>
				<option value="Corporation" <?php selected( 'Corporation', $microdata ); ?>><?php esc_html_e( 'Corporation', 'blade' ); ?></option>
				<option value="EducationalOrganization" <?php selected( 'EducationalOrganization', $microdata ); ?>><?php esc_html_e( 'School', 'blade' ); ?></option>
				<option value="GovernmentOrganization" <?php selected( 'GovernmentOrganization', $microdata ); ?>><?php esc_html_e( 'Government', 'blade' ); ?></option>
				<option value="LocalBusiness" <?php selected( 'LocalBusiness', $microdata ); ?>><?php esc_html_e( 'Local Business', 'blade' ); ?></option>
				<option value="NGO" <?php selected( 'NGO', $microdata ); ?>><?php esc_html_e( 'NGO', 'blade' ); ?></option>
				<option value="PerformingGroup" <?php selected( 'PerformingGroup', $microdata ); ?>><?php esc_html_e( 'Performing Group', 'blade' ); ?></option>
				<option value="SportsTeam" <?php selected( 'SportsTeam', $microdata ); ?>><?php esc_html_e( 'Sports Team', 'blade' ); ?></option>
			</select>
		</p>

	<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
