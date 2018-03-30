<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Backup page class.
 *
 * This class is entitled to manage the system backup page.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if( !class_exists('THB_BackupPage') ) {
	class THB_BackupPage extends THB_AdminPage {

	}
}

/**
 * Create the backup page.
 *
 * @return void
 */
if( !function_exists('thb_backup_page') ) {
	function thb_backup_page() {
		$thb_theme = thb_theme();

		$thb_page = new THB_BackupPage( __('Framework settings', 'thb_text_domain'), 'thb-framework_settings' );

			// General ---------------------------------------------------------

			$thb_tab = new THB_StaticTab( __('General', 'thb_text_domain'), 'general' );
			$thb_tab->setAction('thb_save_super_users');
			$thb_tab->setSubmitLabel( __('Save changes', 'thb_text_domain') );

				$thb_container = $thb_tab->createContainer( '', 'framework_settings_container' );

					$thb_field = new THB_TextField('thb_super_users');
						$thb_field->setStaticOption('thb_super_users');
						$thb_field->setLabel( __('Super users', 'thb_text_domain') );
						$thb_field->setHelp( sprintf( __('Enter a list of comma separated usernames to hide this page from other users. Can be reset from the <a href="%s">WP options page</a> under <code>thb_super_users</code>.', 'thb_text_domain'), admin_url('options.php') ) );
					$thb_container->addField($thb_field);

			$thb_page->addTab($thb_tab);

			// Admin customizations --------------------------------------------

			$thb_tab = new THB_Tab( __('Admin customizations', 'thb_text_domain'), 'thb_admin_customizations' );

				$thb_container = $thb_tab->createContainer( '', 'admin_customizations' );

					$thb_field = new THB_UploadField('login_logo');
						$thb_field->setLabel( __('Login logo', 'thb_text_domain') );
						$thb_field->setValue( thb_get_option('login_logo') );
						$thb_field->setHelp( __('Upload an image to be used as a logo in the login screen of your site. Please remember to load a properly dimensioned logo.', 'thb_text_domain') );
					$thb_container->addField($thb_field);

					$thb_field = new THB_TextareaField('admin_css');
						$thb_field->setAllowCode();
						$thb_field->setValue( thb_get_option('admin_css') );
						$thb_field->setLabel( __('Custom admin CSS', 'thb_text_domain') );
					$thb_container->addField($thb_field);

			$thb_page->addTab($thb_tab);

			// Export options --------------------------------------------------

			$thb_tab = new THB_StaticTab( __('Export', 'thb_text_domain'), 'export' );
			$thb_tab->setAction('thb_export');
			$thb_tab->setSubmitLabel( __('Export', 'thb_text_domain') );

				$thb_container = $thb_tab->createContainer( '', 'export_container' );
				$thb_container->setIntroText( __('Backup your duplicable content (slides, meta fields, etc.), options and customizations to the theme\'s appearance. Upon clicking on the Export button, the browser will prompt you to save a file with a <code>.thb-backup</code> extension which will contain your settings, encrypted.', 'thb_text_domain') );

					$thb_export_duplicable = new THB_CheckboxField( 'export_duplicable' );
					$thb_export_duplicable->setLabel( __('Export duplicable content', 'thb_text_domain') );
					$thb_export_duplicable->setValue('1');
					$thb_container->addField($thb_export_duplicable);

					$thb_export_options = new THB_CheckboxField( 'export_options' );
					$thb_export_options->setLabel( __('Export options', 'thb_text_domain') );
					$thb_export_options->setValue('1');
					$thb_container->addField($thb_export_options);

					$thb_export_skin = new THB_CheckboxField( 'export_mods' );
					$thb_export_skin->setLabel( __('Export skin', 'thb_text_domain') );
					$thb_export_skin->setValue('1');
					$thb_container->addField($thb_export_skin);

			$thb_page->addTab($thb_tab);

			// Import options --------------------------------------------------

			$thb_tab = new THB_StaticTab( __('Import', 'thb_text_domain'), 'import' );
			$thb_tab->setAction('thb_import');
			$thb_tab->setSubmitLabel( __('Import', 'thb_text_domain') );

				$thb_container = $thb_tab->createContainer( '', 'import_container' );
				$thb_container->setIntroText( __('Import a previously saved <code>.thb-backup</code> file. Please note that this will completely overwrite your options or skin settings.', 'thb_text_domain') );

					$thb_upload = new THB_ClassicUploadField( 'import_data' );
					$thb_upload->setLabel( __('Upload backup file', 'thb_text_domain') );
					$thb_container->addField($thb_upload);

			$thb_page->addTab($thb_tab);

		$thb_theme->getAdmin()->addPage($thb_page);
	}
}

if( !function_exists('thb_export_data') ) {
	/**
	 * Export the selected data to file.
	 *
	 * @param array $data The data array.
	 * @param string $filename The name of the file to export.
	 */
	function thb_export_data( $data, $filename ) {

		$exp = base64_encode( serialize( $data ) );
		$filename .= '.' . date('Y-m-d') . '.thb-backup';

		header('Content-disposition: attachment; filename=' . $filename);
		header('Content-type: text/css');

		ob_start();
		echo $exp;
		ob_end_flush();

		die();

	}
}

if( !function_exists('thb_export') ) {
	/**
	 * Export options and skin to file.
	 */
	function thb_export() {
		$exportOptions = isset($_POST['export_options']) && $_POST['export_options'] == 1;
		$exportMods = isset($_POST['export_mods']) && $_POST['export_mods'] == 1;
		$exportDuplicable = isset($_POST['export_duplicable']) && $_POST['export_duplicable'] == 1;

		$data = array();
		$filename = 'thb-export';

		if( $exportOptions ) {
			$thb_theme = thb_theme();
			$data['options'] = $thb_theme->getOptions();

			$filename .= '-options';
		}

		if( $exportMods ) {
			$data['mods'] = get_theme_mods();

			$filename .= '-skin';
		}

		if( $exportDuplicable ) {
			$data['duplicable'] = thb_duplicable_get_all();

			$filename .= '-duplicable';
		}

		thb_export_data($data, $filename);
	}
}

if( !function_exists('thb_import') ) {
	/**
	 * Import options and skin into the system.
	 *
	 * @param boolean $importOptions
	 * @param boolean $importMods
	 * @param boolean $importDuplicable
	 */
	function thb_import( $importOptions=true, $importMods=true, $importDuplicable=true ) {
		if( !empty($_FILES) ) {
			foreach( $_FILES as $uploaded_file ) {

				$file = thb_upload($uploaded_file);

				if( file_exists($file['file']['file']) ) {

					$fileinfo = pathinfo($file['file']['file']);

					if( $fileinfo['extension'] == 'thb-backup' ) {
						$backup = @file_get_contents($file['file']['file']);
						$data = unserialize( base64_decode( $backup ) );
						$success = false;

						if( $importOptions && isset($data['options']) ) {
							$thb_theme = thb_theme();
							$thb_theme->importOptions($data['options']);
							$success = true;
						}

						if( $importMods && isset($data['mods']) ) {
							$theme = get_option( 'stylesheet' );
							update_option( "theme_mods_$theme", $data['mods'] );
							$success = true;
						}

						if( $importDuplicable && isset($data['duplicable']) ) {
							thb_duplicable_remove_all();

							foreach( $data['duplicable'] as $itemKey => $datas ) {
								$datas = (array) $datas;

								foreach( $datas as $dat ) {
									thb_duplicable_add($itemKey, $dat);
								}
								// thb_duplicable_add($itemKey, $da)

								// $row['meta'] = serialize($row['meta']);
								// $row['value'] = serialize($row['value']);
								// thb_duplicable_add($row);
							}

							$success = true;
						}

						if( $success ) {
							$result = thb_system_raise_success( __('Data imported correctly', 'thb_text_domain') );
						}
						else {
							$result = thb_system_raise_error( __('No data imported', 'thb_text_domain') );
						}
					}
					else {
						$result = thb_system_raise_error( sprintf( __('Wrong file type. Only files with the following extensions are allowed: %s.', 'thb_text_domain'), '.thb-backup' ) );
					}

					unlink($file['file']['file']);

				}
				else {
					$result = thb_system_raise_error( __('Upload failed', 'thb_text_domain') );
				}

				thb_system_set_flashdata( $result );

			}
		}
	}
}

if( !function_exists('thb_save_super_users') ) {
	/**
	 * Save the framework settings access option.
	 */
	function thb_save_super_users() {
		$superUsers = isset($_POST['thb_super_users']) ? $_POST['thb_super_users'] : '';
		$usernames = explode(',', $superUsers);
		array_walk($usernames, 'trim');

		if( !empty($usernames) ) {
			update_option( 'thb_super_users', implode(',', $usernames) );
		}

		$result = thb_system_raise_success( __('All saved!', 'thb_text_domain') );
		thb_system_set_flashdata( $result );

		if( ! thb_is_super_user() ) {
			$thb_theme = thb_theme();
			$thb_theme->getAdmin()->redirectToThemePage();
		}
	}
}

add_filter('upload_mimes', 'custom_upload_mimes');
if( !function_exists('custom_upload_mimes') ) {
	function custom_upload_mimes ( $existing_mimes = array() ) {
		$existing_mimes['thb-backup'] = 'text/plain';
		return $existing_mimes;
	}
}