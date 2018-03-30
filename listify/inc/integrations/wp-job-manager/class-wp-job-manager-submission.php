<?php

class Listify_WP_Job_Manager_Submission extends Listify_Integration {

	public function __construct() {
		$this->includes = array();
		$this->integration = 'wp-job-manager';

		parent::__construct();
	}

	public function setup_actions() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		if ( 1 != get_theme_mod( 'custom-submission', true ) ) {
			return;
		}

		global $listify_job_manager;

		$listify_job_manager->business_hours = new Listify_WP_Job_Manager_Business_Hours;

		add_filter( 'submit_job_form_fields', array( $this, 'default_field_changes' ) );

		add_filter( 'submit_job_form_fields', array( $this, 'remove_company' ) );
		add_filter( 'submit_job_form_fields', array( $this, 'contact' ) );

		add_filter( 'submit_job_form_fields', array( $this, 'company_avatar' ) );
		add_filter( 'submit_job_form_fields', array( $this, 'featured_image' ) );
		add_filter( 'submit_job_form_fields', array( $this, 'gallery_images' ) );

		if ( 'listing' == listify_theme_mod( 'social-association', 'user' ) ) {
			add_filter( 'submit_job_form_fields', array( $this, 'social_profiles' ) );
			add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_social_profiles' ), 99 );
		}

		add_filter( 'submit_job_form_fields', array( $this, 'phone' ) );

		add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_phone' ) );
		add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_remove_company' ) );
		add_filter( 'job_manager_job_listing_data_fields', array( $this, 'admin_company_avatar' ) );

		add_filter( 'submit_job_form_fields_get_job_data', array( $this, 'get_featured_image' ), 10, 2 );

		add_action( 'job_manager_update_job_data', array( $this, 'save_featured_image' ), 12, 2 );
		add_action( 'job_manager_update_job_data', array( $this, 'save_gallery_images' ), 12, 2 );

		add_filter( 'submit_job_form_save_job_data', array( $this, 'enable_comments' ), 10, 5 );
	}

	/**
	 * Default field label/placeholder/etc tweaks.
	 *
	 * @since 1.4.2
	 * @param array $fields
	 * @return array $fields
	 */
	public function default_field_changes( $fields ) {
		global $listify_strings;

		$fields[ 'job' ][ 'job_title' ][ 'placeholder' ] = sprintf( __( 'Your %s name', 'listify' ), $listify_strings->label( 'singular' ) );

		if ( isset( $fields[ 'job' ][ 'job_tags' ] ) ) {
			$fields[ 'job' ][ 'job_tags' ][ 'placeholder' ] = __( 'Add tags', 'listify' );
		}

		if ( isset( $fields[ 'job' ][ 'job_category' ] ) ) {
			$fields[ 'job' ][ 'job_category' ][ 'placeholder' ] = __( 'Select one or more categories', 'listify' );
		}
		
		if ( isset( $fields[ 'company' ][ 'company_video' ] ) ) {
			$fields[ 'company' ][ 'company_video' ][ 'placeholder' ] = __( 'URL to video', 'listify' );
			$fields[ 'company' ][ 'company_video' ][ 'description' ] = sprintf( __( 'Display a video on your %s', 'listify' ), $listify_strings->label( 'singular' ) );
		}

		return $fields;
	}

	public function remove_company( $fields ) {
		unset( $fields[ 'company' ][ 'company_name' ] );
		unset( $fields[ 'company' ][ 'company_tagline' ] );
		unset( $fields[ 'company' ][ 'company_twitter' ] );
		unset( $fields[ 'company' ][ 'company_logo' ] );

		return $fields;
	}

	public function admin_remove_company( $fields ) {
		unset( $fields[ '_company_name' ] );
		unset( $fields[ '_company_tagline' ] );
		unset( $fields[ '_company_twitter' ] );
		unset( $fields[ '_filled' ] );

		return $fields;
	}

	public function contact( $fields ) {
		$fields[ 'job' ][ 'application' ][ 'priority' ] = 2.5;

		return $fields;
	}

	public function phone( $fields ) {
		$fields[ 'company' ][ 'phone' ] = array(
			'label' => __( 'Phone Number', 'listify' ),
			'type' => 'text',
			'placeholder' => '',
			'required' => false,
			'priority' => 2.5,
		);

		return $fields;
	}

	public function admin_phone( $fields ) {
		$field = array(
			'_phone' => array(
				'label' => __( 'Company phone', 'listify' ),
				'placeholder' => '',
				'priority' => 89
			)
		);

		return array_slice( $fields, 0, 4, true ) + $field + array_slice( $fields, 4, null, true );
	}

	public function featured_image( $fields ) {
		$fields[ 'job' ][ 'featured_image' ] = array(
			'label'       => __( 'Cover Image', 'listify' ),
			'type'        => 'file',
			'required'    => false,
			'placeholder' => '',
			'priority'    => 4.99,
			'ajax'        => true,
			'allowed_mime_types' => array(
				'jpg'  => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'gif'  => 'image/gif',
				'png'  => 'image/png'
			)
		);

		return $fields;
	}

	/**
	 * We don't want the company logo in the `company` group, so we need to add our own.
	 *
	 * Use a slightly different key to avoid WP Job Manager from tampering.
	 *
	 * @since 1.4.0
	 *
	 * @param array $fields
	 * @return array $fields
	 */
	public function company_avatar( $fields ) {
		if ( 'logo' != get_theme_mod( 'listing-archive-card-avatar', 'none' ) ) {
			return $fields;
		}

		$fields[ 'job' ][ 'company_avatar' ] = array(
			'label'       => __( 'Company Logo', 'listify' ),
			'type'        => 'file',
			'required'    => false,
			'placeholder' => '',
			'priority'    => 4.98,
			'ajax'        => true,
			'allowed_mime_types' => array(
				'jpg'  => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'gif'  => 'image/gif',
				'png'  => 'image/png'
			)
		);

		return $fields;
	}

	/**
	 * Output the company logo field in the admin Listing Data box
	 *
	 * Use a slightly different key to avoid WP Job Manager from tampering.
	 *
	 * @since 1.4.0
	 *
	 * @param array $fields
	 * @return array $fields
	 */
	public function admin_company_avatar( $fields ) {
		$fields[ '_company_avatar' ] = array(
			'label'       => __( 'Company Logo/Avatar', 'listify' ),
			'placeholder' => __( 'URL to the company logo or avatar', 'listify' ),
			'type'        => 'file',
			'priority'    => 7,
		);

		return $fields;
	}

	public function gallery_images( $fields ) {
		$fields[ 'job' ][ 'gallery_images' ] = array(
			'label'       => __( 'Gallery Images', 'listify' ),
			'type'        => 'file',
			'multiple'    => true,
			'required'    => false,
			'placeholder' => '',
			'priority'    => 4.999,
			'ajax'        => true,
			'allowed_mime_types' => array(
				'jpg'  => 'image/jpeg',
				'jpeg' => 'image/jpeg',
				'gif'  => 'image/gif',
				'png'  => 'image/png'
			)
		);

		return $fields;
	}

	public function social_profiles( $fields ) {
		$methods = wp_get_user_contact_methods( get_current_user_id() );

		if ( empty( $methods ) ) {
			return $fields;
		}

		$user = wp_get_current_user();

		foreach ( $methods as $key => $label ) {
			$fields[ 'company' ][ 'company_' . $key ] = array(
				'label' => $label,
				'type' => 'text',
				'priority' => 5.01,
				'placeholder' => 'http://',
				'required' => false
			);
		}

		return $fields;
	}

	public function admin_social_profiles( $fields ) {
		$methods = wp_get_user_contact_methods( get_current_user_id() );

		if ( empty( $methods ) ) {
			return $fields;
		}

		$user = wp_get_current_user();

		foreach ( $methods as $key => $label ) {
			$fields[ '_company_' . $key ] = array(
				'label' => $label,
				'type' => 'text',
				'priority' => 99,
				'placeholder' => 'http://',
				'required' => false
			);
		}

		return $fields;
	}

	/**
	 * Get the URL of the featured image and use that as the value.
	 *
	 * WP Job Manager expects a URL in the file upload field current values
	 * but since we store as the actual Featured Image in WordPress we need to convert it back.
	 *
	 * @param array $fields
	 * @param object $job
	 * @return array $fields
	 */
	public function get_featured_image( $fields, $job ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $job->ID ), 'full' );

		if ( isset( $image[0] ) ) {
			$fields[ 'job' ][ 'featured_image' ][ 'value' ] = esc_url( $image[0] );
		}

		return $fields;
	}

	/**
	 * Set the `featured_image` file upload field as the Featured Image for the listing.
	 *
	 * The attachment has already been created by WP Job Manager, so we have a URL.
	 * We need to get an ID for that URL and set it as the post thumbnail.
	 *
	 * The reverse is done above.
	 *
	 * @param int $job_id
	 * @param array $values
	 * @return void
	 */
	public function save_featured_image( $job_id, $values ) {
		if ( ! isset( $values[ 'job' ][ 'featured_image' ] ) ) {
			return;
		}

		$attachment_url = $values[ 'job' ][ 'featured_image' ];
		$attach_id = attachment_url_to_postid( $attachment_url );

		if ( '' == $attachment_url ) {
			return delete_post_thumbnail( $job_id );
		}

		if ( $attach_id != get_post_thumbnail_id( $job_id ) ) {
			set_post_thumbnail( $job_id, $attach_id );
		}
	}

	/**
	 * Save the gallery of images. 
	 *
	 * WP Job Manager already saves these in a `_gallery_images` key however
	 * that is a list of URLs. This method saves those converted URLs in to a
	 * standard WordPress [gallery ids=123] shortcode format.
	 *
	 * @param int $job_id
	 * @param array $values
	 * @return void
	 */
	public function save_gallery_images( $job_id, $values ) {
		if ( ! isset( $values[ 'job' ][ 'gallery_images' ] ) ) {
			return;
		}

		$images = $values[ 'job' ][ 'gallery_images' ];

		if ( ! isset( $images ) || empty( $images ) ) {
			update_post_meta( $job_id, '_gallery', '[gallery ids=]' );

			return;
		}

		$gallery = array();

		foreach ( $images as $image ) {
			$gallery[] = attachment_url_to_postid( $image );
		}

		$gallery = implode( ',', $gallery );

		$shortcode = '[gallery ids=' . $gallery . ']';

		update_post_meta( $job_id, '_gallery', $shortcode );    
	}

	/**
	 * Turn comments on when saving a listing.
	 */
	public function enable_comments( $args, $post_title, $post_content, $status, $values ) {
		$args[ 'comment_status' ] = 'open';

		return $args;
	}
}
