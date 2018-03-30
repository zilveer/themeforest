<?php

/* -----------------------------------------------------------------------------

    SIDEBAR SETTINGS

----------------------------------------------------------------------------- */

add_action( 'add_meta_boxes', 'lsvr_sidebar_settings_meta_add' );
function lsvr_sidebar_settings_meta_add( $post ) {

	add_meta_box(
		'sidebar_settings',
		'Sidebar Settings',
		'lsvr_sidebar_settings_meta_content',
		'page',
		'normal',
		'high'
	);

}

function lsvr_sidebar_settings_meta_content( $post ) {

	$lsvr_sidebar_settings_meta = get_post_meta( $post->ID, '_lsvr_sidebar_settings_meta', true );

	echo '<p>' . __( 'You can assign a sidebar to this page (it will be displayed only if the selected template supports sidebars). Custom sidebars can be managed under <strong>"Theme Options / Sidebars"</strong>.', 'beautyspot' ). '</p>';

    /* -------------------------------------------------------------------------
        SIDEBAR NAME
    ------------------------------------------------------------------------- */

	$active_id = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'id', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['id'] : '';

	echo '<p><label for="lsvr_sidebar_settings_meta_id"><strong>' . __( 'Select Sidebar', 'beautyspot' ) . '</strong></label></p>';
	echo '<select id="lsvr_sidebar_settings_meta_id" name="lsvr_sidebar_settings_meta_id">';
	// add primary
	if ( is_active_sidebar( 'primary-sidebar' ) ) {
		echo '<option value="primary-sidebar">' . __( 'Default Sidebar', 'beautyspot' ) . '</option>';
	}
	// add custom
	for ( $i = 1; $i <= 10; $i++ ) {
		if ( is_active_sidebar( 'custom-sidebar-' . $i ) ) {
			if ( $active_id === 'custom-sidebar-' . $i ) {
				echo '<option value="custom-sidebar-' . $i . '" selected="selected">';
			}
			else {
				echo '<option value="custom-sidebar-' . $i . '">';
			}
			echo lsvr_get_field( 'sidebar_' . $i . '_name', 'Custom Sidebar ' . $i ) . '</option>';
		}
	}
	echo '</select>';

    /* -------------------------------------------------------------------------
        SIDEBAR POSITION
    ------------------------------------------------------------------------- */

	$active_pos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'pos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['pos'] : '';

	echo '<p><label for="lsvr_sidebar_settings_meta_pos"><strong>' . __( 'Sidebar Position', 'beautyspot' ) . '</strong></label></p>';
	echo '<select id="lsvr_sidebar_settings_meta_pos" name="lsvr_sidebar_settings_meta_pos">';
	if ( $active_pos === 'right' ) {
		echo '<option value="right" selected="selected">';
	}
	else {
		echo '<option value="right">';
	}
	_e( 'Right', 'beautyspot' ) . '</option>';
	if ( $active_pos === 'left' ) {
		echo '<option value="left" selected="selected">';
	}
	else {
		echo '<option value="left">';
	}
	_e( 'Left', 'beautyspot' ) . '</option>';
	echo '</select>';

    /* -------------------------------------------------------------------------
        SIDEBAR MOBILE POSITION
    ------------------------------------------------------------------------- */

	$active_mobilepos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'mobilepos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['mobilepos'] : '';

	echo '<p><label for="lsvr_sidebar_settings_meta_mobilepos"><strong>' . __( 'Sidebar Position on Mobile Devices', 'beautyspot' ) . '</strong></label></p>';
	echo '<select id="lsvr_sidebar_settings_meta_mobilepos" name="lsvr_sidebar_settings_meta_mobilepos">';
	if ( $active_mobilepos === 'bottom' ) {
		echo '<option value="bottom" selected="selected">';
	}
	else {
		echo '<option value="bottom">';
	}
	_e( 'Bottom', 'beautyspot' ) . '</option>';
	if ( $active_mobilepos === 'top' ) {
		echo '<option value="top" selected="selected">';
	}
	else {
		echo '<option value="top">';
	}
	_e( 'Top', 'beautyspot' ) . '</option>';
	echo '</select>';

}

add_action( 'save_post', 'lsvr_sidebar_settings_meta_save' );
function lsvr_sidebar_settings_meta_save(){

	global $post;
	if( $_POST && isset( $post->ID ) ) {
		$lsvr_sidebar_settings_meta = array();
		if ( array_key_exists( 'lsvr_sidebar_settings_meta_id', $_POST ) ) {
			$lsvr_sidebar_settings_meta[ 'id' ] = esc_attr( $_POST['lsvr_sidebar_settings_meta_id'] );
		}
		if ( array_key_exists( 'lsvr_sidebar_settings_meta_pos', $_POST ) ) {
			$lsvr_sidebar_settings_meta[ 'pos' ] = esc_attr( $_POST['lsvr_sidebar_settings_meta_pos'] );
		}
		if ( array_key_exists( 'lsvr_sidebar_settings_meta_mobilepos', $_POST ) ) {
			$lsvr_sidebar_settings_meta[ 'mobilepos' ] = esc_attr( $_POST['lsvr_sidebar_settings_meta_mobilepos'] );
		}
		update_post_meta( $post->ID, '_lsvr_sidebar_settings_meta', $lsvr_sidebar_settings_meta );
	}

}



?>