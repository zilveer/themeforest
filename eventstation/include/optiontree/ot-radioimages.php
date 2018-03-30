<?php
function eventstation_radio_images( $array, $field_id ) {

	/*----- GENERAL SIDEBAR POSITION START -----*/
	if ( $field_id == 'sidebar_position' or $field_id == 'single_sidebar_position' or $field_id == 'woocommerce_sidebar_position' or $field_id == 'woocommerce_product_sidebar_position' or $field_id == 'attachment_sidebar_position' or $field_id == 'category_sidebar_position' or $field_id == 'search_sidebar_position' or $field_id == 'archive_sidebar_position' or $field_id == 'author_sidebar_position' or $field_id == 'tag_sidebar_position' ) {
		$array = array(
			array(
				'value' => 'nosidebar',
				'label' => esc_html__( 'None Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/none-sidebar.jpg'
			),
			array(
				'value' => 'left',
				'label' => esc_html__( 'Left Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/left-sidebar.jpg'
			),
			array(
				'value' => 'right',
				'label' => esc_html__( 'Right Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/right-sidebar.jpg'
			)
		);
	}
	/*----- GENERAL SIDEBAR POSITION END -----*/
	
	/*----- SINGLE / PAGE SIDEBAR POSITION START -----*/
	if ( $field_id == 'layout_select_meta_box_text' ) {
		$array = array(
			array(
				'value' => 'fullwidth',
				'label' => esc_html__( 'None Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/none-sidebar.jpg'
			),
			array(
				'value' => 'leftsidebar',
				'label' => esc_html__( 'Left Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/left-sidebar.jpg'
			),
			array(
				'value' => 'rightsidebar',
				'label' => esc_html__( 'Right Sidebar', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/right-sidebar.jpg'
			)
		);
	}
	/*----- SINGLE / PAGE SIDEBAR POSITION END -----*/
	
	/*----- HEADER LAYOUT START -----*/
	if ( $field_id == 'header_layout_select_meta_box_text'  or $field_id == 'default_header_layout' ) {
		$array = array(
			array(
				'value' => 'default',
				'label' => esc_html__( 'Header - Default Style', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/header-1.jpg'
			),
			array(
				'value' => 'alternativestylev1',
				'label' => esc_html__( 'Header - Alternative Style v1', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/header-2.jpg'
			),
			array(
				'value' => 'alternativestylev2',
				'label' => esc_html__( 'Header - Alternative Style v2', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/header-3.jpg'
			)
		);
	}
	/*----- HEADER LAYOUT END -----*/
	
	/*----- FOOTER LAYOUT START -----*/
	if ( $field_id == 'footer_layout_select_meta_box_text' or $field_id == 'default_footer_layout'  ) {
		$array = array(
			array(
				'value' => 'default',
				'label' => esc_html__( 'Footer - Default Style', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/footer-1.jpg'
			),
			array(
				'value' => 'alternativestyle',
				'label' => esc_html__( 'Footer - Alternative Style', 'eventstation' ),
				'src' => get_template_directory_uri() . '/admin/assets/images/admin/footer-2.jpg'
			)
		);
	}
	/*----- FOOTER LAYOUT START -----*/
	
	return $array;
}
add_filter( 'ot_radio_images', 'eventstation_radio_images', 10, 2 );