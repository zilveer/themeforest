<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'eventstation_custom_meta_boxes' );
/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function eventstation_custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
		$post_meta_box = array(
			'id' => 'post_settings',
			'title' => esc_html__( 'Post Settings', 'eventstation' ),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'eventstation' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide the header.', 'eventstation' ),
					),
					array(
						'id' => 'header_layout_select_meta_box_text',
						'label'	=> esc_html__( 'Header Style', 'eventstation' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select the post for header style.', 'eventstation' ),
					),
					array(
						'label' => esc_html__( 'Menu Location', 'eventstation' ),
						'id' => 'alternative_menu_slot_select',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select the post for menu location.', 'eventstation' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Default Location', 'eventstation' ),
								'value' => 'default'
							),
							array(
								'label' => esc_html__( 'Alternative Location 1', 'eventstation' ),
								'value' => 'menuslot1'
							),
							array(
								'label' => esc_html__( 'Alternative Location 2', 'eventstation' ),
								'value' => 'menuslot2'
							),
						),
					),
					
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'layout_select_meta_box_text',
						'label'	=> esc_html__( 'Sidebar Position', 'eventstation' ),
						'desc' => esc_html__( 'You can select the post for sidebar position.', 'eventstation' ),
						'type' => 'radio-image',
					),
					array(
						'label' => esc_html__( 'Single For Sidebar', 'eventstation' ),
						'desc' => esc_html__( 'You can select the post for sidebar.', 'eventstation' ),
						'id' => 'single_sidebar',
						'type' => 'sidebar-select'
					),
					array(
						'id' => 'excerpt_two_meta_box_text',
						'label'	=> esc_html__( 'Page Title Excerpt', 'eventstation' ),
						'desc' => esc_html__( 'You can enter the post for title excerpt.', 'eventstation' ),
						'type' => 'text',
					),
					
				array(
					'id' => 'tab2-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'eventstation' ),
						'desc' => esc_html__( 'You can hide the footer.', 'eventstation' ),
						'type' => 'on_off'
					),
					array(
						'id' => 'footer_layout_select_meta_box_text',
						'label'	=> esc_html__( 'Footer Style', 'eventstation' ),
						'desc' => esc_html__( 'You can select the post for footer style.', 'eventstation' ),
						'type' => 'radio-image',
					),
			)
		);
		ot_register_meta_box( $post_meta_box );
		
		$schedule_meta_box = array(
			'id' => 'schedule_settings',
			'title' => esc_html__( 'Schedule Settings', 'eventstation' ),
			'pages' => array( 'schedule' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'schedule_hour',
					'label' => esc_html__( 'Hour', 'eventstation' ),
					'desc' => esc_html__( 'You can enter the schedule for hour. Example: 10:00', 'eventstation' ),
					'type' => 'text'
				),
				array(
					'id' => 'schedule_speaker',
					'label' => esc_html__( 'Speaker Name', 'eventstation' ),
					'desc' => esc_html__( 'You can enter the schedule for speaker name.', 'eventstation' ),
					'type' => 'text'
				),
				array(
					'id' => 'schedule_topic',
					'label' => esc_html__( 'Topic', 'eventstation' ),
					'desc' => esc_html__( 'You can enter the schedule for topic title.', 'eventstation' ),
					'type' => 'text'
				),
				array(
					'id' => 'schedule_salon',
					'label' => esc_html__( 'Hall', 'eventstation' ),
					'desc' => esc_html__( 'You can enter the schedule for hall name.', 'eventstation' ),
					'type' => 'text'
				),
			)
		);
		ot_register_meta_box( $schedule_meta_box );
		
		$page_meta_box = array( 
			'id' => 'page_settings',
			'title' => esc_html__( 'Page Settings', 'eventstation' ),
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'id' => 'tab1-header-settings',
					'label' => esc_html__( 'Header Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'eventstation' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide the header.', 'eventstation' ),
					),
					array(
						'id' => 'header_layout_select_meta_box_text',
						'label'	=> esc_html__( 'Header Style', 'eventstation' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select the page for header style.', 'eventstation' ),
					),
					array(
						'label' => esc_html__( 'Menu Location', 'eventstation' ),
						'id' => 'alternative_menu_slot_select',
						'type' => 'radio',
						'desc' => esc_html__( 'You can select the page for menu location.', 'eventstation' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Default Location', 'eventstation' ),
								'value' => 'default'
							),
							array(
								'label' => esc_html__( 'Alternative Location 1', 'eventstation' ),
								'value' => 'menuslot1'
							),
							array(
								'label' => esc_html__( 'Alternative Location 2', 'eventstation' ),
								'value' => 'menuslot2'
							),
						),
					),
					array(
						'id' => 'page_title',
						'label' => esc_html__( 'Page Title', 'eventstation' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide the page title.', 'eventstation' ),
					),
					array(
						'id' => 'heading_navigation_hide',
						'label' => esc_html__( 'Heading Navigation', 'eventstation' ),
						'desc' => esc_html__( 'You can hide the heading navigation.', 'eventstation' ),
						'type' => 'on_off',
					),
					
				array(
					'id' => 'tab2-layout-settings',
					'label' => esc_html__( 'Layout Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'layout_select_meta_box_text',
						'label'	=> esc_html__( 'Sidebar Position', 'eventstation' ),
						'desc' => esc_html__( 'You can select the post for sidebar position.', 'eventstation' ),
						'type' => 'radio-image',
					),
					array(
						'id' => 'excerpt_two_meta_box_text',
						'label'	=> esc_html__( 'Page Title Excerpt', 'eventstation' ),
						'desc' => esc_html__( 'You can enter the page for title excerpt.', 'eventstation' ),
						'type' => 'text',
					),
					array(
						'id' => 'no_fluid_layout',
						'label' => esc_html__( 'Fluid Container', 'eventstation' ),
						'type' => 'on_off',
						'std' => 'off',
						'desc' => esc_html__( 'You can make the fluid container width.', 'eventstation' ),
					),
					
				array(
					'id' => 'tab2-footer-settings',
					'label' => esc_html__( 'Footer Settings', 'eventstation' ),
					'type' => 'tab'
				),
					array(
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'eventstation' ),
						'type' => 'on_off',
						'desc' => esc_html__( 'You can hide the footer.', 'eventstation' ),
					),
					array(
						'id' => 'footer_layout_select_meta_box_text',
						'label'	=> esc_html__( 'Footer Style', 'eventstation' ),
						'type' => 'radio-image',
						'desc' => esc_html__( 'You can select the page for footer style.', 'eventstation' ),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );
	/**
	* Register our meta boxes using the 
	* ot_register_meta_box() function.
	*/
}