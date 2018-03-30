<?php

/**
 * Theme Activation Tour
 *
 * This class handles the pointers used in the introduction tour.
 * @package Popup Demo
 *
 */
class Listable_Theme_Tour {

	private $pointers = null;

	/**
	 * Class constructor.
	 *
	 * If user is on a pre pointer version bounce out.
	 */
	function __construct() {

		$this->pointers = array();
		$this->pointers['add_listing'] = array(
			'id'       => 'job_listing', // this is the id of the page where the pointers should appear
			'pointers' => array(
				'listing_title'      => array(
					'content' => sprintf(
						'<p>%s <strong>%s</strong>: "%s"</p>',
						esc_html__( 'Let\'s add your first listing! To better familiarize with the process, start by adding a good', 'listable' ),
						esc_html__( 'title', 'listable' ),
						esc_html__( 'Coffee Heaven', 'listable' )
					),

					'position'     => array(
						'edge'  => 'top', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#title',
					'next_pointer' => 'listing_categories'
				),
				'listing_categories' => array(
					'content' => sprintf(
						'<p>%s <strong>%s</strong>- %s</p><p>%s<strong>%s</strong> %s.</p>',
						esc_html__( 'Visitors can filter their search result by ', 'listable' ),
						esc_html__( 'categories', 'listable' ),
						esc_html__( 'so make sure you choose them wisely and include all the relevant ones.', 'listable' ),
						esc_html__( 'Let\'s add two categories: "Food" and "Coffee Shops" &#8212; later on we will ', 'listable' ),
						esc_html__( 'add icons', 'listable' ),
						esc_html__( 'to them', 'listable' )
					),

					'position'     => array(
						'edge'  => 'right', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#taxonomy-job_listing_category',
					'next_pointer' => 'company_tagline',
					'prev_pointer' => 'listing_categories'
				),
				'company_tagline'    => array(
					'content'      => sprintf(
						'<p>%s <strong>%s</strong> %s.</p>',
						esc_html__( 'Add a short and descriptive', 'listable' ),
						esc_html__( 'Tagline', 'listable' ),
						esc_html__( 'like "Speciality Coffee Shop"', 'listable' )
					),
					'position'     => array(
						'edge'  => 'left', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#_company_tagline',
					'next_pointer' => 'job_location',
					'prev_pointer' => 'listing_title'
				),

				'job_location'    => array(
					'content'      => sprintf(
						'<p>%s <strong>%s</strong> %s.</p>',
						esc_html__( 'Now you can add the', 'listable' ),
						esc_html__( 'address', 'listable' ),
						esc_html__( 'of the listing. Let\'s use "34 Wigmore Street, London"', 'listable' )
					),
					'position'     => array(
						'edge'  => 'right', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#_job_location',
					'next_pointer' => 'add_images',
					'prev_pointer' => 'listing_categories'
				),
				'add_images'      => array(
					'content' => sprintf(
						'<p>%s <strong>%s</strong> - %s.</p>',
						esc_html__( 'Add 4 or 5', 'listable' ),
						esc_html__( 'images', 'listable' ),
						esc_html__( 'users love them. *Note that the first one appears on the listing card from the archive page', 'listable' )
					),

					'position'     => array(
						'edge'  => 'right', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#listing_aside',
					'next_pointer' => 'contact_zone',
					'prev_pointer' => 'job_location'
				),
				'contact_zone'    => array(
					'content'      => sprintf(
						'<p>%s <strong>%s</strong>, %s <strong>%s</strong> %s <strong>%s</strong> %s.</p><p>%s.</p>',
						esc_html__( 'Contact information is always useful. If you have a', 'listable' ),
						esc_html__( 'phone number', 'listable' ),
						esc_html__( 'a', 'listable' ),
						esc_html__( 'website', 'listable' ),
						esc_html__( 'or a', 'listable' ),
						esc_html__( 'Twitter username', 'listable' ),
						esc_html__( 'at hand -- fill them below', 'listable' ),
						esc_html__( 'Even if they are optional, they are very important so visitors can get find you', 'listable' )
					),
					'position'     => array(
						'edge'  => 'bottom', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#_company_phone',
					'next_pointer' => 'publish_listing',
					'prev_pointer' => 'add_images'
				),
				'publish_listing' => array(
					'content'      => sprintf(
						'<p><strong>%s</strong > %s.</p><p>%s <strong>%s</strong>. %s</p>',
						esc_html__( 'We\'re ready to launch!', 'listable' ),
						esc_html__( 'Even if there are other fields that you can play with, there\'s plenty of time afterwards', 'listable' ),
						esc_html__( 'Fasten your seatbelt and hit the', 'listable' ),
						esc_html__( 'Publish button', 'listable' ),
						esc_html__( 'Congratulations for your first listing!', 'listable' )
					),
					'position'     => array(
						'edge'  => 'right', //Arrow position; change depending on where the element is located
						'align' => 'center' //Alignment of Pointer
					),
					'target'       => '#major-publishing-actions',
					'prev_pointer' => 'contact_zone'
				)
			),
		);

		$has_demodata = get_option( 'listable_demo_data_imported' );

		if ( ! $has_demodata ){
			$this->pointers['edit-job_listing_category'] = array(
				'id'       => 'edit-job_listing_category',
				'pointers' => array(
						'listing_title'      => array(
								'content' => sprintf(
										'<input type="hidden" name="wpGrade-nonce-import-listing-categories" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_listing_categories' ) . '" />
					<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />
					<p>%s <strong>%s</strong> %s</p> <button class="import_category_listings button button-primary" style="margin: 0 15px;">%s</button>

					<div class="wpGrade-loading-wrap hidden">
						<p><span class="wpGrade-loading wpGrade-import-loading"></span></p>
						<div class="wpGrade-import-wait">
							<p> %s <strong>%s </strong >. %s. </p>
						</div>
					</div>

					<div class="wpGrade-import-results hidden" style="padding: 0 15px;"></div>
					<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>',
										esc_html__( 'Let me give you a leaner start by loading some ', 'listable' ),
										esc_html__( 'sample categories and icons', 'listable' ),
										esc_html__( 'that you can use (or delete) later on', 'listable' ),
										esc_html__( 'Load Sample Categories & Icons', 'listable' ),
										esc_html__( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and', 'listable' ),
										esc_html__( 'don\'t reload the page', 'listable' ),
										esc_html__( 'You will be notified as soon as the import has finished!', 'listable' )
								),
								'position'     => array(
										'edge'  => 'left', //Arrow position; change depending on where the element is located
										'align' => 'center' //Alignment of Pointer
								),
								'target'       => '#tag-name'
						),
				),
				'finish_button_label' => esc_html( 'Dismiss', 'listable' )
			);

			$this->pointers['edit-job_listing_tag'] = array(
				'id'       => 'edit-job_listing_tag',
				'pointers' => array(
						'listing_title'      => array(
								'content' => sprintf(
										'<input type="hidden" name="wpGrade-nonce-import-listing-tags" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_listing_tags' ) . '" />
					<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />
					<p>%s <strong>%s</strong> %s</p> <button class="import_tag_listings button button-primary" style="margin: 0 15px;">%s</button>

					<div class="wpGrade-loading-wrap hidden">
						<span class="wpGrade-loading wpGrade-import-loading"></span>
						<div class="wpGrade-import-wait">
							%s <strong>%s </strong >. %s.
						</div>
					</div>

					<div class="wpGrade-import-results hidden" style="padding: 0 15px;"></div>
					<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>',
										esc_html__( 'Let me give you a leaner start by loading some ', 'listable' ),
										esc_html__( 'sample tags and icons', 'listable' ),
										esc_html__( 'that you can use (or delete) later on', 'listable' ),
										esc_html__( 'Load Sample Tags & Icons', 'listable' ),
										esc_html__( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and', 'listable' ),
										esc_html__( 'don\'t reload the page', 'listable' ),
										esc_html__( 'You will be notified as soon as the import has finished!', 'listable' )
								),
								'position'     => array(
										'edge'  => 'left', //Arrow position; change depending on where the element is located
										'align' => 'center' //Alignment of Pointer
								),
								'target'       => '#tag-name'
						),
				),
				'finish_button_label' => esc_html( 'Dismiss', 'listable' )
			);
		}

		//version is updated ::claps:: proceed
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Enqueue styles and scripts needed for the pointers.
	 */
	function enqueue() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Add footer scripts using callback function
		add_action( 'admin_print_scripts', array( $this, 'theme_tour' ) );
	}


	/**
	 * Load the introduction tour
	 */
	function theme_tour() {

		//delete_user_meta( get_current_user_id(), 'dismissed_wp_pointers' );

		$page   = '';
		$screen = get_current_screen();
		//Check which page the user is on
		if ( isset( $_GET['page'] ) ) {
			$page = $_GET['page'];
		}

		if ( empty( $page ) ) {
			$page = $screen->id;
		}

		// Get array list of dismissed pointers for current user and convert it to array
		$dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
		// Check if our pointer is not among dismissed ones
		if ( in_array( $page, $dismissed_pointers ) ) {
			return;
		}

		foreach ( $this->pointers as $id => $pointer ) {
			if ( $page === $pointer['id'] ) {
				$pointer = $this->ensure_page_pointer_defaults( $pointer );

				wp_enqueue_style( 'wp-pointer' );
				wp_enqueue_script( 'wp-pointer' );

				$custom_css = "#dismiss-pointer {position: absolute;top: 4px;right: 5px;display: inline-block;}
#dismiss-pointer .notice-dismiss:before {color: #fff;font-size: 20px;}
#pointer-counter  {color: #00A0D2; font-size: 13px; margin-top: 5px; display: inline-block;line-height: 18px;}
#dismiss-pointer:hover .notice-dismiss:before {color: #c00;}";

				wp_add_inline_style( 'wp-pointer', $custom_css );
				wp_localize_script( 'listable-admin-general-scripts', 'listing_page_pointers', $pointer );
				break;
			}
		}
	}

	function ensure_page_pointer_defaults( $pointer ) {

		if ( ! isset( $pointer['pointers'] ) ) {
			return false;
		}

		if ( ! isset( $pointer['next_button_label'] ) ) {
			$pointer['next_button_label'] = esc_html__( 'Next &rarr;', 'listable' );
		}

		if ( ! isset( $pointer['counter'] ) ) {
			$pointer['counter'] = true;
		}

		if ( ! isset( $pointer['prev_button_label'] ) ) {
			$pointer['prev_button_label'] = esc_html__( '&larr; Prev', 'listable' );
		}

		if ( ! isset( $pointer['finish_button_label'] ) ) {
			$pointer['finish_button_label'] = esc_html__( 'Finish!', 'listable' );
		}

		if ( ! isset( $pointer['step_label'] ) ) {
			$pointer['step_label'] = esc_html__( 'Step', 'listable' );
		}

		if ( ! isset( $pointer['dismiss_label'] ) ) {
			$pointer['dismiss_label'] = '<span class="notice-dismiss"></span>';
		}

		foreach ( $pointer['pointers'] as $key => $point ) {

			if ( ! isset( $pointer['pointers'][ $key ]['title'] ) ) {
				$pointer['pointers'][ $key ]['title'] = esc_html__( 'PixCare&reg; Assistant', 'listable' );
			}

			if ( ! isset( $pointer['pointers'][ $key ]['content'] ) ) {
				$pointer['pointers'][ $key ]['content'] = esc_html__( 'PixCare&reg; Assistant', 'listable' );
			}
		}

		return $pointer;
	}

	function var_dump( $content ) {
		echo '<pre style="margin-left:180px;">';
		var_dump( $content );
		echo '</pre>';
	}
}

$wordimpress_theme_tour = new Listable_Theme_Tour();

/**
 * Ajax callback to import the category listings
 */
if ( ! function_exists( 'wpGrade_ajax_import_listing_categories' ) ) {
	function wpGrade_ajax_import_listing_categories() {
		// initialize the step importing
		$stepNumber    = 1;
		$numberOfSteps = 1;

		// get the data sent by the ajax call regarding the current step
		// and total number of steps
		if ( ! empty( $_REQUEST['step_number'] ) ) {
			$stepNumber = $_REQUEST['step_number'];
		}

		if ( ! empty( $_REQUEST['number_of_steps'] ) ) {
			$numberOfSteps = $_REQUEST['number_of_steps'];
		}

		$response = array(
			'what'         => 'import_listing_categories',
			'action'       => 'import_submit',
			'id'           => 'true',
			'supplemental' => array(
				'stepNumber'    => $stepNumber,
				'numberOfSteps' => $numberOfSteps,
			)
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'wpGrade_nonce_import_demo_listing_categories' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-listing-categories.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_wpGrade_ajax_import_listing_categories', 'wpGrade_ajax_import_listing_categories' );
}

/**
 *  Ajax callback to import the listings tags
 */
if ( ! function_exists( 'wpGrade_ajax_import_listing_tags' ) ) {
	function wpGrade_ajax_import_listing_tags() {
		// initialize the step importing
		$stepNumber    = 1;
		$numberOfSteps = 1;

		// get the data sent by the ajax call regarding the current step
		// and total number of steps
		if ( ! empty( $_REQUEST['step_number'] ) ) {
			$stepNumber = $_REQUEST['step_number'];
		}

		if ( ! empty( $_REQUEST['number_of_steps'] ) ) {
			$numberOfSteps = $_REQUEST['number_of_steps'];
		}

		$response = array(
			'what'         => 'import_listing_tags',
			'action'       => 'import_submit',
			'id'           => 'true',
			'supplemental' => array(
				'stepNumber'    => $stepNumber,
				'numberOfSteps' => $numberOfSteps,
			)
		);

		// check if user is allowed to save and if its his intention with
		// a nonce check
		if ( function_exists( 'check_ajax_referer' ) ) {
			check_ajax_referer( 'wpGrade_nonce_import_demo_listing_tags' );
		}

		require_once( get_template_directory() . '/inc/import/import-demo-listing-tags.php' );

		$response = new WP_Ajax_Response( $response );
		$response->send();
	}

	// hook into wordpress admin.php
	add_action( 'wp_ajax_wpGrade_ajax_import_listing_tags', 'wpGrade_ajax_import_listing_tags' );
}