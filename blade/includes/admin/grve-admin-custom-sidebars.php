<?php
/*
*	Admin Custom Sidebars
*
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

	function blade_grve_add_sidebar_settings() {
	
		if ( isset( $_POST['grve_sidebar_nonce'] ) && wp_verify_nonce( $_POST['grve_sidebar_nonce'], 'save_sidebars' ) ) {

			$sidebars_items = array();
			if( isset( $_POST['grve_custom_sidebar_item_id'] ) ) {
				$num_of_sidebars = sizeof( $_POST['grve_custom_sidebar_item_id'] );
				for ( $i=0; $i < $num_of_sidebars; $i++ ) {
					$this_sidebar = array (
						'id' => $_POST['grve_custom_sidebar_item_id'][ $i ],
						'name' => $_POST['grve_custom_sidebar_item_name'][ $i ],
					);
					array_push( $sidebars_items, $this_sidebar );
				}
			}
			if ( empty( $sidebars_items ) ) {
				delete_option( 'grve-blade-custom-sidebars' );
			} else {
				update_option( 'grve-blade-custom-sidebars', $sidebars_items );
			}
			//Update Sidebar list
			wp_get_sidebars_widgets();
			wp_safe_redirect( 'themes.php?page=blade-grve-custom-sidebar-settings&sidebar-settings=saved' );
			
		}
					
		add_theme_page(
			esc_html__( 'Sidebars', 'blade' ),
			esc_html__( 'Sidebars', 'blade' ),
			'manage_options',
			'blade-grve-custom-sidebar-settings',
			'blade_grve_show_sidebar_settings'
		);

	}

	add_action( 'admin_menu', 'blade_grve_add_sidebar_settings' );

	function blade_grve_show_sidebar_settings() {
		$grve_custom_sidebars = get_option( 'grve-blade-custom-sidebars' );
?>
	<div id="grve-sidebar-wrap" class="wrap">
		<h2><?php esc_html_e( "Sidebars", 'blade' ); ?></h2>
		
		<?php if( isset( $_GET['sidebar-settings'] ) ) { ?>
		<div class="grve-sidebar-saved grve-notice-green">
			<strong><?php esc_html_e('Settings Saved!', 'blade' ); ?></strong>
		</div>
		<?php } ?>		
		<input type="text" id="grve_custom_sidebar_item_name_new" value=""/>
		<input type="button" id="grve-add-custom-sidebar-item" class="button button-primary" value="<?php esc_html_e('Add New', 'blade' ); ?>"/>
		<span class="grve-sidebar-spinner"></span>
		<div class="grve-sidebar-notice grve-notice-red" style="display:none;">
			<strong><?php esc_html_e('Field must not be empty!', 'blade' ); ?></strong>
		</div>
		<div class="grve-sidebar-notice-exists grve-notice-red" style="display:none;">
			<strong><?php esc_html_e('Sidebar with this name already exists!', 'blade' ); ?></strong>
		</div>		
		<form method="post" action="themes.php?page=blade-grve-custom-sidebar-settings">
			<?php wp_nonce_field( 'save_sidebars', 'grve_sidebar_nonce' ); ?>
			<div id="grve-custom-sidebar-container">
				<?php blade_grve_print_admin_custom_sidebars( $grve_custom_sidebars ); ?>
			</div>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
	}
	
	function  blade_grve_print_admin_custom_sidebars( $grve_custom_sidebars ) {

		
		if ( ! empty( $grve_custom_sidebars ) ) {
			foreach ( $grve_custom_sidebars as $grve_custom_sidebar ) {
				blade_grve_print_admin_single_custom_sidebar( $grve_custom_sidebar );
			}
		}
	}

	function  blade_grve_print_admin_single_custom_sidebar( $sidebar_item, $mode = '' ) {

		$grve_button_class = "grve-custom-sidebar-item-delete-button";
		$sidebar_item_id = uniqid('grve_sidebar_');
		
		if( $mode = "new" ) {
			$grve_button_class = "grve-custom-sidebar-item-delete-button grve-item-new";			
		}	
?>
	
	
	<div class="grve-custom-sidebar-item">
		<input class="<?php echo esc_attr( $grve_button_class ); ?> button" type="button" value="<?php esc_attr_e('Delete', 'blade' ); ?>">
		<h3 class="grve-custom-sidebar-title">
			<span><?php esc_html_e('Custom Sidebar', 'blade' ); ?>: <?php echo blade_grve_array_value( $sidebar_item, 'name' ); ?></span>
		</h3>
		<div class="grve-custom-sidebar-settings">
			<input type="hidden" name="grve_custom_sidebar_item_id[]" value="<?php echo blade_grve_array_value( $sidebar_item, 'id', $sidebar_item_id ); ?>">
			<input type="hidden" class="grve-custom-sidebar-item-name" name="grve_custom_sidebar_item_name[]" value="<?php echo blade_grve_array_value( $sidebar_item, 'name' ); ?>"/>
		</div>
	</div>
	
<?php

	}

	add_action( 'wp_ajax_blade_grve_get_custom_sidebar', 'blade_grve_get_custom_sidebar' );

	function blade_grve_get_custom_sidebar() {
	
		if( isset( $_POST['grve_sidebar_name'] ) ) {
		
			$sidebar_item_name = $_POST['grve_sidebar_name'];
			$sidebar_item_id = uniqid('grve_sidebar_');
			if( empty( $sidebar_item_name ) ) {
				$sidebar_item_name = $sidebar_item_id;
			}
			
			$this_sidebar = array (
				'id' => $sidebar_item_id,
				'name' => $sidebar_item_name,
			);

			blade_grve_print_admin_single_custom_sidebar( $this_sidebar, 'new' );
		}
		die();

	}

//Omit closing PHP tag to avoid accidental whitespace output errors.
