<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Backup page class.
 *
 * This class is entitled to manage the system backup page.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_FrameworkSettings') ) {
	class THB_FrameworkSettings extends THB_AdminPage {

	}
}

if( !function_exists('thb_frameworksettings_page') ) {
	/**
	 * Create the framework settings page.
	 */
	function thb_frameworksettings_page() {
		$thb_theme = thb_theme();

		$thb_page = new THB_FrameworkSettings( __('Framework settings', 'thb_text_domain'), 'thb-framework_settings' );

			$users = array();
			foreach ( get_users( 'role=administrator' ) as $user ) {
				$users[$user->data->user_login] = $user->data->display_name;
			}

			// General ---------------------------------------------------------

			if ( count( $users ) > 1 ) {
				$thb_tab = new THB_StaticTab( __( 'General', 'thb_text_domain' ), 'general' );
				$thb_tab->setAction( 'thb_save_super_users' );
				$thb_tab->setSubmitLabel( __('Save changes', 'thb_text_domain') );

					$thb_container = $thb_tab->createContainer( '', 'framework_settings_container' );

						$thb_field = new THB_MultipleSelectField( 'thb_super_users', THB_Field::WP_Option );
							$thb_field->setOptions( $users );
							$thb_field->setLabel( __('Super users', 'thb_text_domain') );
							$thb_field->setHelp( sprintf( __('Enter a list of usernames to hide this page from other users. Can be reset from the <a href="%s">WP options page</a> under <code>thb_super_users</code>.', 'thb_text_domain'), admin_url('options.php') ) );
						$thb_container->addField($thb_field);

				$thb_page->addTab($thb_tab);
			}

			// Advanced --------------------------------------------------------

			if ( ! defined( 'THB_PREVENT_COMPACT_FRONTEND_SCRIPTS' ) ) {
				$thb_tab = new THB_Tab( __('Advanced', 'thb_text_domain'), 'thb_advanced_settings' );

					$thb_container = $thb_tab->createContainer( '', 'advanced_settings' );

						$thb_field = new THB_CheckboxField( 'compress_frontend_scripts' );
							$thb_field->setLabel( __( 'Compact frontend scripts', 'thb_text_domain' ) );
							$thb_field->setHelp( __( "Checking this option will compact most of the theme scripts on frontend.", 'thb_text_domain' ) );
						$thb_container->addField( $thb_field );

				$thb_page->addTab($thb_tab);
			}

			// Admin customizations --------------------------------------------

			$thb_tab = new THB_Tab( __('Admin customizations', 'thb_text_domain'), 'thb_admin_customizations' );

				$thb_container = $thb_tab->createContainer( '', 'admin_customizations' );

					$thb_field = new THB_UploadField('login_logo');
						$thb_field->setLabel( __('Login logo', 'thb_text_domain') );
						$thb_field->setHelp( __('Upload an image to be used as a logo in the login screen of your site. Please remember to load a properly dimensioned logo.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextareaField('admin_css');
						$thb_field->setAllowCode();
						$thb_field->setLabel( __('Custom admin CSS', 'thb_text_domain') );
						$thb_field->setHelp( __('Here you can add some extra CSS that will be imported in the WordPress Administration area and in the WordPress Login page.<br /><br />
							You can easily find CSS elements by using your browser inspector or Firebug, or view a quick guide <a href="http://sixrevisions.com/tools/firebug-guide-web-designers/" target="_blank">here</a>.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

			$thb_page->addTab($thb_tab);

			// Export options --------------------------------------------------

			$thb_tab = new THB_StaticTab( __( 'Export', 'thb_text_domain' ), 'export' );
			$thb_tab->setAction( 'thb_export' );
			$thb_tab->setSubmitLabel( __( 'Export', 'thb_text_domain' ) );

				$thb_container = $thb_tab->createContainer( '', 'export_container' );
				$thb_container->setIntroText( __('Backup your duplicable content (slides, meta fields, etc.), options and customizations to the theme\'s appearance. Upon clicking on the Export button, the browser will prompt you to save a file with a <code>.thb-backup</code> extension which will contain your settings, encrypted.', 'thb_text_domain') );

					$thb_export_options = new THB_CheckboxField( 'export_options', THB_Field::Free );
					$thb_export_options->setLabel( __('Export options', 'thb_text_domain') );
					$thb_export_options->setValue( '1' );
					$thb_container->addField( $thb_export_options );

					$thb_export_skin = new THB_CheckboxField( 'export_mods', THB_Field::Free );
					$thb_export_skin->setLabel( __('Export skin', 'thb_text_domain') );
					$thb_export_skin->setValue( '1' );
					$thb_container->addField( $thb_export_skin );

			$thb_page->addTab( $thb_tab );

			// Import options --------------------------------------------------

			$thb_tab = new THB_StaticTab( __('Import', 'thb_text_domain'), 'import' );
			$thb_tab->setAction('thb_import');
			$thb_tab->setSubmitLabel( __('Import', 'thb_text_domain') );

				$thb_container = $thb_tab->createContainer( '', 'import_container' );
				$thb_container->setIntroText( __('Import a previously saved <code>.thb-backup</code> file. Please note that this will completely overwrite your options or skin settings.', 'thb_text_domain') );

					$thb_upload = new THB_ClassicUploadField( 'import_data', THB_Field::Free );
					$thb_upload->setLabel( __('Upload backup file', 'thb_text_domain') );
					$thb_container->addField($thb_upload);

			$thb_page->addTab($thb_tab);

			// Dummy content removal -------------------------------------------

			if ( thb_dummy_content_check() ) {
				$post_types = $thb_theme->getPublicPostTypes();

				if ( ! empty( $post_types ) ) {
					$thb_tab = new THB_StaticTab( __('Dummy content', 'thb_text_domain'), 'dummy' );
					$thb_tab->setAction('thb_dummy_content_remove');
					$thb_tab->setSubmitLabel( __('Remove', 'thb_text_domain') );

						$thb_container = $thb_tab->createContainer( __( 'Remove dummy content', 'thb_text_domain' ), 'dummy_container' );
						$thb_container->setIntroText( __( 'Select which imported contents you want to remove from this installation.', 'thb_text_domain' ) );

							foreach ( $post_types as $pt ) {
								$thb_field = new THB_CheckboxField( 'dummy_check_' . $pt->getType(), THB_Field::Free );
								$thb_field->setLabel( get_post_type_object( $pt->getType() )->labels->name );
								$thb_field->setHelp( sprintf( __( 'Remove contents from the %s section.', 'thb_text_domain' ), get_post_type_object( $pt->getType() )->labels->name ) );
								$thb_field->setValue( '0' );
								$thb_container->addField($thb_field);
							}

							$thb_field = new THB_CheckboxField( 'dummy_check_attachment', THB_Field::Free );
							$thb_field->setLabel( __( 'Media library items', 'thb_text_domain' ) );
							$thb_field->setHelp( __( 'Remove imported attachments.', 'thb_text_domain' ) );
							$thb_field->setValue( '0' );
							$thb_container->addField($thb_field);

					$thb_page->addTab($thb_tab);
				}
			}

		$thb_theme->getAdmin()->addPage($thb_page);
	}
}