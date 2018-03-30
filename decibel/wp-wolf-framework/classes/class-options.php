<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Theme_Admin_Options' ) ) {
	/**
	 * Theme options class
	 *
	 * Create theme options easily from an array (includes/options.php)
	 *
	 * @since 1.4.2
	 * @package WolfFramework
	 * @author WolfThemes
	 */
	class Wolf_Theme_Admin_Options {

		/**
		 * @var array
		 */
		public $options = array();

		/**
		 * Wolf_Theme_Admin_Options Constructor
		 *
		 * @todo set a main key option
		 */
		public function __construct( $options = array() ) {
			$this->options = $options + $this->options;
			$this->save();
			$this->render();
			$this->import_options();
			$this->download_options_zip();
		}

		/**
		 * Get theme option from "wolf_theme_options_template" array
		 *
		 * @param string $o
		 * @param string $default
		 * @return string
		 */
		public function get_option( $o, $default = null ) {

			global $options;

			$wolf_framework_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );

			if ( isset( $wolf_framework_options[ $o ] ) ) {

				$option = $wolf_framework_options[ $o ];

				if ( function_exists( 'icl_t' ) ) {

					$option = icl_t( wolf_get_theme_slug(), $o, $option ); // WPML
				}

				return $option;

			} elseif ( $default ) {

				return $default;
			}
		}

		/**
		 * Save the theme options in array
		 */
		public function save() {

			global $options;

			/**
			 * Back from WpAdmin construct function redirection
			 */
			if ( isset( $_GET['message'] ) && 'save' == $_GET['message'] && isset( $_GET['page'] ) && $_GET['page'] == 'wolf-theme-options' ) {
				wolf_admin_notice( __( 'Your settings have been saved.', 'wolf' ), 'updated' );
			}

			if ( isset( $_GET['message'] ) && 'export' == $_GET['message'] && isset( $_GET['page'] ) && $_GET['page'] == 'wolf-theme-options' ) {
				wolf_admin_notice( __( 'Your download should start in a few seconds.', 'wolf' ), 'updated' );
				//wp_safe_redirect( WOLF_THEME_URi . '/includes/admin/options-export.zip' );
			}

			if ( isset( $_GET['page'] ) && $_GET['page'] == 'wolf-theme-options' ) {

				$errors = array();

				if ( isset( $_POST['action'] ) && $_POST['action'] == 'save'
				        && ( ! isset( $_FILES['wolf-options-import-file']['name'] ) || '' == $_FILES['wolf-options-import-file']['name'] )
					&& wp_verify_nonce( $_POST['wolf_save_theme_options_nonce'],'wolf_save_theme_options' ) ) {

					// 5 minutes time out
					set_time_limit( 900 );

					$new_options = array();
					$data = $_POST['wolf_theme_options'];

					foreach ( $this->options as $value ) {

						$type = isset( $value['type'] ) ? $value['type'] : null;
						$value_key = isset( $value['id'] ) ? $value['id'] : null;

						if ( 'int' == $type ) {

							$new_options[ $value_key ] = intval( $data[ $value_key ] );
						}

						elseif ( 'image' == $type ) {

							if ( is_numeric( $data[ $value_key ] ) ) {

								$new_options[ $value_key ] = absint( $data[ $value_key ] );
							} else {

								$new_options[ $value_key ] = esc_url( $data[ $value_key ] );
							}
						}

						elseif ( 'url' == $type || 'file' == $type ) {

							if ( ! empty( $data[ $value_key ] ) )
								$new_options[ $value_key ] = esc_url( $data[ $value_key ] );
						}

						elseif ( 'email' == $type ) {

							if ( ! empty( $data[ $value_key ] ) && ! is_email( $data[ $value_key ] ) ) {

								$errors[] = '<strong>' . $data[ $value_key ] . '</strong> '.__( 'is not a valid email', 'wolf' ).'.';

							} elseif ( ! empty( $data[ $value_key ] ) ) {

								$new_options[ $value_key ] = sanitize_email( $data[ $value_key ] );
							}
						}

						elseif ( 'editor' == $type ) {

							if ( ! empty( $_POST[ 'wolf_theme_options_editor_' . $value['id'] ] ) ) {

								$new_options[ $value_key ] = $_POST[ 'wolf_theme_options_editor_' . $value_key ];

								if ( function_exists( 'icl_register_string' ) ) {
									icl_register_string( wolf_get_theme_slug(), $value_key, $new_options[ $value_key ] );
								}
							}
						}

						elseif ( 'text' == $type || 'textarea' == $type || 'javascript' == $type ) {

							if ( ! empty( $data[ $value_key ] ) ) {

								$new_options[ $value_key ] = $data[ $value_key ];

								if ( 'text' == $type || 'text_html' == $type || 'textarea' == $type ) {
									if ( function_exists( 'icl_register_string' ) ) {
										icl_register_string( wolf_get_theme_slug(), $value_key, $new_options[ $value_key ] );
									}
								}
							}
						}

						elseif ( 'background' == $type ) {

							$bg_settings = array( 'color', 'img', 'position', 'repeat', 'attachment', 'size', 'parallax', 'font_color' );

							foreach ( $bg_settings as $s ) {

								$o = $value_key . '_' . $s;

								if ( isset( $o ) && ! empty( $data[ $o ] ) ) {

									$setting = $data[ $o ];

									if ( 'img' == $s ) {
										if ( is_numeric( $setting ) ) {
											$new_options[ $o ] = absint( $setting );
										} else {
											$new_options[ $o ] = esc_url( $setting );
										}
									} else {
										$new_options[ $o ] = sanitize_text_field( $setting );
										// $new_options[ $o ] = $setting;
									}
								}
							}

						} // end background

						elseif ( 'font' == $type ) {

							$font_settings = array( 'font_color', 'font_name', 'font_weight', 'font_transform', 'font_style', 'font_letter_spacing' );

							foreach ( $font_settings as $s ) {

								$o = $value_key . '_' . $s;

								if ( isset( $o ) && ! empty( $data[ $o ] ) ) {

									$new_options[ $o ] = $data[ $o ];
								}
							}
						} // end font

						elseif ( 'video' == $type ) {

							$video_settings = array( 'mp4', 'webm', 'ogv', 'opacity', 'img', 'type', 'youtube_url' );

							foreach ( $video_settings as $s ) {

								$o = $value_key . '_' . $s;

								if ( isset( $o ) && ! empty( $data[ $o ] ) ) {

									$new_options[ $o ] = $data[ $o ];
								}
							}

						} // end video


						elseif ( 'css' == $type ) {
							if ( isset( $value_key ) && ! empty( $data[ $value_key ] ) ) {
								$new_options[ $value_key ] = $data[ $value_key ];
							}

						} else {
							if ( isset( $value_key ) && ! empty( $data[ $value_key ] ) ) {
								$new_options[ $value_key ] = sanitize_text_field( strip_tags( $data[ $value_key ] ) ) ;
							}
						}
					}

					update_option( 'wolf_theme_options_' . wolf_get_theme_slug(), $new_options );

					do_action( 'wolf_after_options_save', $new_options );

					//wp_redirect( admin_url( 'admin.php?page=wolf-theme-options' ) );

				} else if ( ( isset( $_POST['action'] ) ) && ( $_POST['action'] == 'wolf-reset-all-options' ) ) {

					$old_options = get_option( 'wolf_theme_options' );

					delete_option( 'wolf_theme_options_' . wolf_get_theme_slug() );

					if ( function_exists( 'wolf_theme_default_options_init' ) )
						wolf_theme_default_options_init();
				}

				if ( isset( $_POST['action'] ) && $_POST['action'] == 'save' && ! isset( $_POST['wolf-options-import-file-submit'] ) ) {
					wolf_admin_notice( __( 'Your settings have been saved.', 'wolf' ), 'updated' );
				}

				if ( ( isset( $_POST['action'] ) ) && ( $_POST['action'] == 'wolf-reset-all-options' ) ) {
					wolf_admin_notice( __( 'Your settings have been reset.', 'wolf' ), 'updated' );
				}

				/* Display raw error message */
				if ( $errors != array() ) {
					$error_message = '<br><div class="error">';
					foreach ( $errors as $error) {
						$error_message .= '<p>'.$error.'</p>';
					}
					$error_message .= '</div>';
					echo wp_kses( $error_message, array(
						'p' => array(),
						'br' => array(),
						'strong' => array(),
						'div' => array(
							'class' => array(),
						),
					) );
				}
			}

		} // end save function

		/**
		 * Import options from zip file or txt file
		 */
		public function import_options() {
			if ( isset( $_POST['wolf-options-import-file-submit'] ) ) {

				if ( ! empty( $_FILES['wolf-options-import-file']['name'] ) ) {
					$txt_file     = null;
					$file_content = null;
					$tmp_dir      = WOLF_THEME_TMP_DIR;
					$file         = $_FILES['wolf-options-import-file'];
					$ext          = pathinfo( $file['name'], PATHINFO_EXTENSION );
					$folder_name  = str_replace( '.' . $ext, '', $file['name'] );

					if ( 'zip' != $ext && 'txt' != $ext ) {
						$message = __( 'Only .txt file or zip file containing a text file are allowed', 'wolf' );
						wolf_admin_notice( $message, 'error' );
					} else {
						// Go
						if ( 'zip' == $ext ) {
							// unzip file
							$zip = new ZipArchive;
							if ( $zip->open( $file['tmp_name'] ) === TRUE ) {
								$zip->extractTo( $tmp_dir );
								$zip->close();
								$tmp_folder = $tmp_dir;

								if ( is_dir( $tmp_dir . '/' . $folder_name ) ) {
									$tmp_folder = $tmp_dir . '/' . $folder_name;
								}

								// get text file
								foreach ( glob( $tmp_folder . '/*.txt' ) as $filename ) {
									$txt_file = $filename;
									break;
								}

								if ( $txt_file ) {
									$file_content =  file_get_contents( $txt_file );

								} else {
									$message = __( 'It seems that your archive is empty or does not contain a txt file', 'wolf' );
									wolf_admin_notice( $message, 'error' );
								}

							} else {
								$message = __( 'We could not import the theme options', 'wolf' );
								wolf_admin_notice( $message, 'error' );
							}

						} elseif ( 'txt' == $ext ) {
							$file_content =  file_get_contents( $file['tmp_name'] );
						}

						if ( '' != $file_content ) {
							// debug( $file_content );
							$data = @unserialize( base64_decode( $file_content ) );

							if ( $data && is_array( $data ) ) {
								update_option( 'wolf_theme_options_' . wolf_get_theme_slug(), $data );
								wolf_admin_notice( __( 'New options imported successfully', 'wolf' ), 'updated' );
							} else {
								wolf_admin_notice( __( 'The file doesn\'t seem to contain any options.', 'wolf' ), 'updated' );
							}

						} else {
							$message = __( 'Looks like your text file is empty', 'wolf' );
							wolf_admin_notice( $message, 'error' );
						}

						// clean tmp folder
						wolf_clean_folder( $tmp_dir );
					}

				} else {
					$message = __( 'Please Select a file to upload', 'wolf' );
					wolf_admin_notice( $message, 'error' );
				}
				return false;
			}
		}

		public function download_options_zip() {

			if ( isset( $_POST['wolf-options-import-file-submit'] ) ) {
				//echo "OK";
			}
		}

		/**
		 * Render Theme Options inputs
		 */
		public function render() {

			$theme_version = 'v.' . WOLF_THEME_VERSION;

			/* If a child theme is used and update notces are enabled, we show the parent theme version */
			if ( is_child_theme() && WOLF_UPDATE_NOTICE )
				$theme_version = sprintf( __( 'v.%1$s (Parent Theme v.%2$s)', 'wolf' ), wp_get_theme()->Version, WOLF_THEME_VERSION ) ;

		?>
		<div id="wolf-framework-messages">
			<?php
				// Check for theme update and set an admin notification if needed
				wolf_theme_update_notification_message();

				if ( WOLF_ENABLE_OPTIONS_EXPORTER ) {
					wolf_check_folder( WOLF_THEME_DIR . '/includes/admin/export' );
				}
			?>
		</div>

	<div class="wrap">
		<form id="wolf-theme-options-form" method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-options' ) ); ?>" enctype="multipart/form-data">
		<?php wp_nonce_field( 'wolf_save_theme_options', 'wolf_save_theme_options_nonce' ); ?>

			<h2 class="nav-tab-wrapper">

				<div class="tabs" id="tabs1">
					<?php foreach ( $this->options as $value ) { ?>
						<?php if ( $value['type'] == 'open' ) { ?>
						<a href="#<?php echo sanitize_title( $value['label'] ); ?>" class="nav-tab"><?php echo sanitize_text_field( $value['label'] ); ?></a>
					<?php } }?>
					<?php
					if ( class_exists( 'ZipArchive' ) && WOLF_ENABLE_OPTIONS_EXPORTER ) : ?>
						<a href="#import" class="nav-tab"><?php _e( 'Export/Import', 'wolf' ); ?></a>
					<?php endif; ?>
				</div>
			</h2>

		<div class="content">
	<?php foreach ( $this->options as $value ) {

		if ( ! isset( $value['def'] ) ) $value['def']   = '';
		if ( ! isset( $value['desc'] ) ) $value['desc'] = '';

		if ( $value['type'] == 'open' ) {
		?>
		<div id="<?php echo sanitize_title( $value['label'] ); ?>" class="wolf-options-panel">

			<p><?php echo sanitize_text_field( $value['desc'] ); ?></p>

		<?php
		} elseif ( $value['type'] == 'close' ) {
			// vertical-align:middle; margin-left:10px; display:none;
		?>
			<div class="wolf-options-actions">
				<span class="submit">
					<input name="wolf-theme-options-save" type="submit" class="wolf-theme-options-save button-primary menu-save" value="<?php _e( 'Save changes', 'wolf' ); ?>">
					<img class="options-loader" style="vertical-align:middle; margin-left:10px; display:none;" src="<?php echo esc_url( admin_url( 'images/loading.gif' ) ); ?>" alt="loader">
					<div style="float:none; clear:both"></div>
				</span>
				<div class="clear"></div>
			</div>

		</div><!-- panel -->

		<?php

		} elseif ( $value['type'] == 'subtitle' ) {
		?>

			<div class="wolf_title wolf_subtitle">
				<h3>
				<?php echo sanitize_text_field( $value['label'] ); ?>
				<br><small><?php echo sanitize_text_field( $value['desc'] ); ?></small>
				</h3>
				<div class="clear"></div>
			</div>

		<?php

		} elseif ( $value['type'] == 'section_open' ) {

			$title = isset( $value['label'] ) ? $value['label'] : '';
			$desc = isset( $value['desc'] ) ? $value['desc'] : '';
			$section_id = isset( $value['id'] ) ? $value['id'] : 'section';
			$dependency	= ( isset( $value['dependency'] ) ) ? $value['dependency'] : array();
			$class 		= "option-section-$section_id";
			$data 		= '';

			if ( array() != $dependency ) {
				$class .= ' has-dependency';

				$data .= ' data-dependency-element="' . $dependency['element'] . '"';

				$value_list = '';
				foreach ( $dependency['value'] as $value ) {
					$value_list .= '"' . $value . '",';
				}
				$value_list = rtrim( $value_list, ',' );

				$dependency_value = "[$value_list]";

				$data .= " data-dependency-values='$dependency_value'";
			}
		?>
		<div class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
			<div class="section-title">
				<?php if ( $title ) : ?>
					<h3><?php echo sanitize_text_field( $title ); ?></h3>
				<?php endif ?>

				<p class="description"><?php echo $desc; ?></p>
			</div>

			<table class="form-table">
				<tbody>
		<?php

		} elseif ( $value['type'] == 'section_close' ) {
		?>
				</tbody>
			</table>
		</div>
		<?php
		} else {

				$this->do_input( $value);

				}
		// foreach $options
		}
		?>
		<?php if ( class_exists( 'ZipArchive' ) && WOLF_ENABLE_OPTIONS_EXPORTER ) : ?>
				<div id="import" class="wolf-options-panel">
						<p><?php _e( 'Here you can export or import your theme options in zip file format', 'wolf' ); ?></p>
						<p>
							<input type="file" name="wolf-options-import-file">
							<input id="wolf-import-options" type="submit" name="wolf-options-import-file-submit" class="button" value="<?php _e( 'Import Options', 'wolf' ); ?>">
						</p>
						<p>
							<input id="wolf-export-options" type="submit" name="wolf-options-export-file-submit" class="button" value="<?php _e( 'Export Options', 'wolf' ); ?>">
						</p>
				</div>
		 <?php endif; ?>
		<input type="hidden" name="action" value="save">
		</form>

		</div> <!-- .content -->

		<?php
		$reset_options_confirm = __( 'Are you sure to want to reset all options ?', 'wolf' );
		?>
		<div id="wolf-options-footer">
			<form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=wolf-theme-options' ) ); ?>">
				<p id="reset">
					<input name="wolf-reset-all-options" type="submit" value="<?php _e( 'Reset all options', 'wolf' ); ?>" onclick="if (window.confirm( '<?php echo esc_js( $reset_options_confirm ); ?>' ) )
					{location.href='default.htm';return true;} else {return false;}">
					<input type="hidden" name="action" value="wolf-reset-all-options">
				</p>
			</form>

			<p id="theme-version"><?php echo sanitize_text_field( wp_get_theme()->Name ); ?> <small><?php echo sanitize_text_field( $theme_version ); ?></small></p>
		</div>
	</div><!-- .wrap -->

		<?php
			if ( WOLF_DEBUG ) {
				echo "<br><br>options";
				debug( get_option( 'wolf_theme_options_' . wolf_get_theme_slug() ) );

				echo "<br><br>posted";
				debug( $_POST );

			}
			//end wolf_options_admin
		}

		/**
		 * Generate theme option inputs
		 * @return string
		 */
		public function do_input( $item ) {
			wp_enqueue_media();

			$prefix = 'wolf_theme_options';
			$type = 'text';
			$size = '';
			$desc = '';
			$def = '';
			$pre = '';
			$app = '';
			$help = '';
			$parallax = false;
			$font_color = true;
			$do_attachment = false;

			$field_id = $item['id'];
			if ( isset( $item['type'] ) ) $type = $item['type'];
			if ( isset( $item['size'] ) ) $size = $item['size'];
			if ( isset( $item['def'] ) ) $def = $item['def'];
			if ( isset( $item['desc'] ) ) $desc= $item['desc'];
			if ( isset( $item['pre'] ) ) $pre= $item['pre'];
			if ( isset( $item['app'] ) ) $app= $item['app'];
			if ( isset( $item['parallax'] ) && $item['parallax'] == true && $type == 'background'  ) $parallax = true;
			if ( isset( $item['font_color'] ) && $item['font_color'] == false && $type == 'background'  ) $font_color = false;
			if ( isset( $item['bg_attachment'] ) && $item['bg_attachment'] == true && $type == 'background'  ) $do_attachment = true;
			if ( isset( $item['help'] ) ) {

				$help = '<span class="hastip" title="' . __( 'Click to view the screenshot helper', 'wolf' ) . '"><a class="wolf-help-img" href="' . esc_url( WOLF_THEME_URI . '/images/admin/help/' . $item['help']  .'.jpg' )  . '"><img src="' . esc_url( WOLF_FRAMEWORK_URI . '/assets/img/help.png' ) . '" alt="help"></a></span>';

				if ( $type != 'checkbox' )
				$desc .= $help;
			}

			$dependency	= ( isset( $item['dependency'] ) ) ? $item['dependency'] : array();
			$class 		= "option-section-$field_id";
			$data 		= '';

			if ( array() != $dependency ) {
				$class .= ' has-dependency';

				$data .= ' data-dependency-element="' . $dependency['element'] . '"';

				$value_list = '';
				foreach ( $dependency['value'] as $value ) {
					$value_list .= '"' . $value . '",';
				}
				$value_list = rtrim( $value_list, ',' );

				$dependency_value = "[$value_list]";

				$data .= " data-dependency-values='$dependency_value'";
			}


		if ( $type == 'text' || $type == 'text_html' || $type == 'int' || $type == 'email' || $type == 'url' ) : ?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?>
						<br>
						<small class="description"><?php echo $desc; ?></small>
					</label>
				</th>

				<td class="forminp">
					<div class="<?php if ( $pre != '' ) : echo "input-prepend"; elseif ( $app !='' ) : echo "input-append"; endif; ?>">
					<?php if ( $pre != '' ) : ?>
						<span class="add-on"><?php echo sanitize_text_field( $pre ); ?></span>
					<?php endif; ?>
						<input<?php echo ( 'long' == $size ) ? ' style="max-width:900px;"' : ''; ?> class="option-input" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" type="text" value="<?php echo ( $this->get_option( $field_id ) ) ? htmlentities( stripslashes($this->get_option( $field_id ) ) ) : $def; ?>">
					<?php if ( $app != '' ) : ?>
						<span class="add-on"><?php echo sanitize_text_field( $app ); ?></span>
					<?php endif; ?>
					</div>
				</td>
			</tr>


		<?php
		// to do
		elseif ( $type == 'css' ) : ?>
		<style type="text/css">
		#editor {
			position: absolute;
			width: 500px;
			height: 400px;
		}
		</style>
		<tr valign="top">
	    		<th scope="row" class="titledesc">
				<label for="<?php echo sanitize_text_field( $item['label'] ); ?>"><?php echo sanitize_text_field( $item['label'] ); ?>
				<br><small class="description"><?php echo $desc; ?></small></label>
			</th>

			<td class="forminp">
				<div id="editor"><?php echo sanitize_text_field( $this->get_option( $field_id ) ); ?></div>
				<textarea name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="css" style="visibility:hidden;"></textarea>
			</td>
		</tr>
		<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/ace.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/theme-twilight.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo WOLF_FRAMEWORK_URI; ?>/assets/ace/mode-css.js" type="text/javascript" charset="utf-8"></script>
		<script>
			var editor = ace.edit("editor");
			var CssMode = require("ace/mode/css").Mode;
			var textArea = document.getElementById('css');
			document.getElementById('editor').style.fontSize='14px';
			editor.setTheme("ace/theme/twilight");
    			editor.getSession().setMode(new CssMode());
    			editor.getSession().on('change', function( e ) {
				textArea.innerHTML = editor.getValue();
			});
		</script>

		<?php elseif ( $type == 'editor' ) : ?>
		<?php
			$content =  ( $this->get_option( $field_id ) ) ? stripslashes( $this->get_option( $field_id ) ) : $def;
			$editor_id = $prefix . '_editor_' . $field_id;
		?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $editor_id ); ?>"><?php echo sanitize_text_field( $item['label'] ); ?>
					<br><small class="description"><?php echo $desc; ?></small></label>
				</th>

				<td class="forminp">
					<div class="wolf-editor-container">
						<?php wp_editor( $content, $editor_id, $settings = array() ); ?>
					</div>
				</td>
			</tr>

	    	<?php elseif ( $type == 'textarea' || $type == 'javascript' ) : ?>

		    	<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?><br>
					<small class="description"><?php echo $desc; ?></small></label>
				</th>

				<td class="forminp">
					<div class="option-textarea">
						<textarea name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo ( $this->get_option( $field_id ) ) ? stripslashes( $this->get_option( $field_id ) ) : $def; ?></textarea>
					</div>
				</td>
			</tr>

	    	<?php elseif ( $type == 'select' ) : ?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?><br>
						<small class="description"><?php echo $desc; ?></small>
					</label>
				</th>

				<td class="forminp">

					<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>">

					<?php if ( is_int( key( $item['options'] ) ) ) : // is not associative ?>
						<?php foreach ( $item['options'] as $v) : ?>
							<option value="<?php echo esc_attr( $v ); ?>" <?php selected( stripslashes($this->get_option( $field_id ) ), $v  ); ?>><?php echo sanitize_text_field( $v ); ?></option>
						<?php endforeach; ?>

					<?php else : ?>
						<?php foreach ( $item['options'] as $v => $o) : ?>
							<option value="<?php echo esc_attr( $v ); ?>" <?php selected( stripslashes( $this->get_option( $field_id ) ), $v  ); ?>><?php echo sanitize_text_field( $o ); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
					</select>

				</td>
			</tr>

		<?php elseif ( $type == 'checkbox' ) : ?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?></label>
					<?php echo sanitize_text_field( $help ); ?>
				</th>

				<td class="forminp">
					<input type="checkbox" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" value="true" <?php checked( $this->get_option( $field_id ), 'true' ); ?>>
					<small class="description"><?php echo $desc; ?></small>
				</td>
			</tr>

		<?php elseif ( $type == 'radio' ) : ?>

			<div class="wolf_input wolf_checkbox" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
				<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?></label>
				<input type="radio" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" value="true" <?php checked( $def, true ); ?>>
				<small><?php echo $desc; ?></small>
			 </div>

		<?php elseif ( $type == 'image' ) :
			$img = $this->get_option( $field_id );

			if ( is_numeric( $img ) ) {
				$img_url = wolf_get_url_from_attachment_id( $img, 'logo' );
			} else {
				$img_url = esc_url( $img );
			}
		?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?>
						<br>
						<small class="description"><?php echo $desc; ?></small>
					</label>
				</th>

				<td class="forminp">

					<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( $img ); ?>">
					<img <?php if ( ! $this->get_option( $field_id ) ) echo 'style="display:none;"'; ?> class="wolf-options-img-preview" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $field_id ); ?>">
					<br>
					<a href="#" class="button wolf-options-reset-img"><?php _e( 'Clear', 'wolf' ); ?></a>
					<a href="#" class="button wolf-options-set-img"><?php _e( 'Choose an image', 'wolf' ); ?></a>

				</td>
			</tr>

		<?php elseif ( $type == 'file' ) : ?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?><br>
					<small class="description"><?php echo $desc; ?></small></label>
				</th>

				<td class="forminp">
					<input type="text" class="option-input" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_url( $this->get_option( $field_id ) ); ?>">
					<br><br>
					<a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
					<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
				</td>
			</tr>

		<?php elseif ( $type == 'background' ) : ?>

		<div class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
			<div class="section-title">
				<h3><?php echo sanitize_text_field( $item['label'] ); ?></h3>
				<p class="description"><?php echo sanitize_text_field( $item['desc'] ); ?></p>
			</div>

			<table class="form-table">
				<tbody>

		<?php
		/* Font Color
		---------------*/
		?>
		<?php
		if ( $font_color ) :
			$options = array(
				'dark' => __( 'Dark', 'wolf' ),
				'light' => __( 'Light', 'wolf' )
			);
			 ?>
			 	<tr valign="top">
			    		<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_font_color]"><?php _e( 'Font Color', 'wolf' ); ?></label>
					</th>

					<td class="forminp">
						<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_font_color]" id="<?php echo esc_attr( $field_id ); ?>_font_color">
						<?php foreach ( $options as $o => $v) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php if ( stripslashes($this->get_option( $field_id.'_font_color' ) ) == $o  ) echo 'selected="selected"'; ?>><?php echo sanitize_text_field( $v ); ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>

			<?php
		endif;
			/* Color
			---------------*/
			?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_color]"><?php _e( 'Background Color', 'wolf' ); ?><br></label>
				</th>

				<td class="forminp">
					<input class="wolf-options-colorpicker" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_color]" id="<?php echo esc_attr( $field_id ); ?>_color" style="width:75px" type="text" value="<?php if ( $this->get_option( $field_id.'_color' ) ) echo htmlentities( stripslashes($this->get_option( $field_id.'_color' ) ) ); ?>">
				</td>
			</tr>

		<?php
		/* Image
		---------------*/
		$img = $this->get_option( $field_id . '_img' );
		if ( is_numeric( $img ) ) {
			$img_url = wolf_get_url_from_attachment_id( $img, 'logo' );
		} else {
			$img_url = esc_url( $img );
		}
		?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_img]"><?php _e( 'Background Image', 'wolf' ); ?>
				</label>
				</th>

				<td class="forminp">
					<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_img]" id="<?php echo esc_attr( $field_id ); ?>_img" value="<?php echo esc_attr( $img ); ?>">
					<img <?php if ( ! $this->get_option( $field_id .'_img' ) ) echo 'style="display:none;"'; ?> class="wolf-options-img-preview" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $field_id ); ?>">
					<br><a href="#" class="button wolf-options-reset-bg"><?php _e( 'Clear', 'wolf' ); ?></a>
					<a href="#" class="button wolf-options-set-bg"><?php _e( 'Choose an image', 'wolf' ); ?></a>
				</td>
			</tr>

		<?php
		/* Repeat
		---------------*/
		?>
		<?php
		$options = array( 'no-repeat', 'repeat', 'repeat-x', 'repeat-y' );
		 ?>
		 	<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_repeat]"><?php _e( 'Repeat', 'wolf' ); ?></label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_repeat]" id="<?php echo esc_attr( $field_id ); ?>_repeat">
					<?php foreach ( $options as $o) : ?>
						<option value="<?php echo esc_attr( $o ); ?>" <?php if ( stripslashes($this->get_option( $field_id.'_repeat' ) ) == $o  ) echo 'selected="selected"'; ?>><?php echo sanitize_text_field( $o ); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>

		<?php
		/* Position
		---------------*/

		$options = array(
			'center center',
			'center top',
			'left top' ,
			'right top' ,
			'center bottom',
			'left bottom' ,
			'right bottom' ,
			'left center' ,
			'right center'
		);
		 ?>
	 		<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_position]"><?php _e( 'Position', 'wolf' ); ?></label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_position]" id="<?php echo esc_attr( $field_id ); ?>_position">
					<?php foreach ( $options as $o) : ?>
						<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $this->get_option( $field_id.'_position' ), $o  ); ?>><?php echo sanitize_text_field( $o ); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>
		<?php
		if ( $do_attachment ) :

			/* Attachment
			---------------*/
			$options = array(
				'scroll',
				'fixed',
			);
			 ?>
		 		<tr valign="top">
			    		<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_attachment]"><?php _e( 'Attachment', 'wolf' ); ?></label>
					</th>

					<td class="forminp">
						<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_attachment]" id="<?php echo esc_attr( $field_id ); ?>_attachment">
						<?php foreach ( $options as $o) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $this->get_option( $field_id.'_attachment' ), $o  ); ?>><?php echo sanitize_text_field( $o ); ?></option>
						<?php endforeach; ?>
						</select>
					</td>
				</tr>
			<?php
		endif; // endif attachment

		/* Size
		---------------*/
		$options = array(
			'cover' => __( 'cover (resize)', 'wolf' ),
			'normal' => __( 'normal', 'wolf' ),
			'resize' => __( 'responsive (hard resize)', 'wolf' ),
		);

		?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_size]"><?php _e( 'Size', 'wolf' ); ?></label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_size]" id="<?php echo esc_attr( $field_id ); ?>_size">
					<?php foreach ( $options as $o => $v) : ?>
						<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $this->get_option( $field_id.'_size' ), $o ); ?>><?php echo sanitize_text_field( $v ); ?></option>
					<?php endforeach; ?>
					</select>
				</td>
			</tr>

				<?php if ( $parallax ): ?>
					<tr valign="top">
				    		<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_parallax]"><?php _e( 'Parallax', 'wolf' ); ?></label>
							</label>
						</th>

						<td class="forminp">
							<input type="checkbox" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_parallax]" id="<?php echo esc_attr( $field_id ); ?>_parallax" value="true" <?php checked( $this->get_option( $field_id . '_parallax' ), 'true' ); ?>>
						</td>
					</tr>

				<?php endif ?>
			</tbody>
		</table>

		</div><!-- end option section -->
		<?php
		/* Font
		---------------*/
		elseif ( $type == 'font' ) :
			$field_id = $field_id;
			$color = $this->get_option( $field_id . '_font_color' );
			$name = $this->get_option( $field_id . '_font_name' );
			$weight = $this->get_option( $field_id . '_font_weight' );
			$transform = $this->get_option( $field_id . '_font_transform' );
			$letter_spacing = $this->get_option( $field_id . '_font_letter_spacing' );
			$style = $this->get_option( $field_id . '_font_style' );
			$exclude_params = isset( $item['exclude_params'] ) ? $item['exclude_params'] : array();
		?>
		<div class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
			<div class="section-title">
				<h3><?php echo sanitize_text_field( $item['label'] ); ?></h3>
				<p class="description"><?php echo sanitize_text_field( $item['desc'] ); ?></p>
			</div>

			<table class="form-table">
				<tbody>

			<?php

			if ( ! in_array( 'name', $exclude_params ) ) :

				global $wolf_fonts;
				// debug( $wolf_fonts );
			?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_name]'; ?>"><?php _e( 'Font family', 'wolf' ); ?><br>
					</label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_name]'; ?>" id="<?php echo esc_attr( $field_id ); ?>">
						<?php foreach ( $wolf_fonts as $k => $v ) : ?>
							<option value="<?php echo esc_attr( $k ); ?>" <?php selected( $k, $name ); ?>><?php echo sanitize_text_field( $k ); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<?php endif;

			if ( ! in_array( 'color', $exclude_params ) ) :
			?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_color]'; ?>"><?php _e( 'Font color', 'wolf' ); ?><br>
					</label>
				</th>

				<td class="forminp">
					<input class="wolf-options-colorpicker" value="<?php echo esc_attr( $color ); ?>" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_color]'; ?>" id="<?php echo esc_attr( $field_id ); ?>">
				</td>
			</tr>
			<?php endif;

			if ( ! in_array( 'weight', $exclude_params ) ) :
			?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_weight]'; ?>"><?php _e( 'Font weight', 'wolf' ); ?><br>
					<small class="description"><?php _e( 'For example: 400 is normal, 700 is bold.The available font weights depend on the font. Leave empty to use the theme default style', 'wolf' ); ?></small>
					</label>
				</th>

				<td class="forminp">
					<input value="<?php echo esc_attr( $weight ); ?>" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_weight]'; ?>" id="<?php echo esc_attr( $field_id ); ?>">
				</td>
			</tr>
			<?php endif;

			if ( ! in_array( 'transform', $exclude_params ) ) :

				$options = array( 'none', 'uppercase' );
			?>
			<tr valign="top">
		    		<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_transform]'; ?>"><?php _e( 'Font transform', 'wolf' ); ?><br>
					</label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_transform]'; ?>" id="<?php echo esc_attr( $field_id ); ?>">
						<?php foreach ( $options as $o ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php if ( $o == $transform ) echo 'selected="selected"'; ?>><?php echo sanitize_text_field( $o ); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<?php endif;

			if ( ! in_array( 'style', $exclude_params ) ) :

				$options = array( 'normal', 'italic' );
			?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_style]'; ?>"><?php _e( 'Font style', 'wolf' ); ?><br>
					</label>
				</th>

				<td class="forminp">
					<select name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_style]'; ?>" id="<?php echo esc_attr( $field_id ); ?>">
						<?php foreach ( $options as $o ) : ?>
							<option value="<?php echo esc_attr( $o ); ?>" <?php selected( $o, $style ); ?>><?php echo sanitize_text_field( $o ); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<?php endif;

			if ( ! in_array( 'letter_spacing', $exclude_params ) ) : ?>
			<tr valign="top">
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_font_letter_spacing]'; ?>"><?php _e( 'Letter Spacing (omit px)', 'wolf' ); ?><br>
					</label>
				</th>

				<td class="forminp">
					<input value="<?php echo esc_attr( $letter_spacing ); ?>" name="<?php echo esc_attr( $prefix . '[' .  $field_id .'_font_letter_spacing]' ); ?>" id="<?php echo esc_attr( $field_id ); ?>">
				</td>
			</tr>
			<?php endif; ?>
			</tbody>
		</table>
		</div><!-- end option section -->
		<?php
		/* video
		---------------*/
		elseif ( $type == 'video' ) :

			$type = $this->get_option( $field_id . '_type' );
			$youtube_url = $this->get_option( $field_id . '_youtube_url' );
			$mp4 = $this->get_option( $field_id . '_mp4' );
			$webm = $this->get_option( $field_id . '_webm' );
			$ogv = $this->get_option( $field_id . '_ogg' );
			$opacity = $this->get_option( $field_id . '_opacity' ) ? intval( $this->get_option( $field_id . '_opacity' ) ) : 100;
			$img = $this->get_option( $field_id . '_img' );
			$exclude_params = isset( $item['exclude_params'] ) ? $item['exclude_params'] : array();
		?>
		<div class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
			<div class="section-title">
				<h3><?php echo sanitize_text_field( $item['label'] ); ?></h3>
				<p class="description"><?php echo sanitize_text_field( $item['desc'] ); ?></p>
			</div>

			<table class="form-table">
				<tbody>

				<?php if ( ! in_array( 'type', $exclude_params ) ) : ?>
					<tr valign="top" class="option-section-<?php echo esc_attr( $field_id .'_type' ); ?>">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_type]'; ?>"><?php _e( 'Video Background type', 'wolf' ); ?><br>
						</th>

						<td class="forminp">
							<select name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_type]'; ?>">
								<option value="youtube" <?php selected( $type, 'youtube' ); ?>>Youtube</option>
								<option value="selfhosted" <?php selected( $type, 'selfhosted' ); ?>><?php _e( 'Self hosted', 'wolf' ); ?></option>
							</select>
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( ! in_array( 'youtube_url', $exclude_params ) ) : ?>
					<tr valign="top" class="has-dependency" data-dependency-element="<?php echo esc_attr( $field_id . '_type' ); ?>" data-dependency-values='["youtube"]'>
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_youtube_url]'; ?>"><?php _e( 'Video Background Youtube URL', 'wolf' ); ?><br>
						</th>

						<td class="forminp">
							<input class="option-input" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>_youtube_url]" type="text" value="<?php echo esc_url( $youtube_url ); ?>">
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( ! in_array( 'mp4', $exclude_params ) ) : ?>
					<tr valign="top" class="has-dependency" data-dependency-element="<?php echo esc_attr( $field_id . '_type' ); ?>" data-dependency-values='["selfhosted"]'>
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_mp4]'; ?>"><?php _e( 'mp4 URL', 'wolf' ); ?><br>
						</th>

						<td class="forminp">
							<input type="text" class="option-input" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_mp4]'; ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_url( $mp4 ); ?>">
							<br><br>
							<a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( ! in_array( 'webm', $exclude_params ) ) : ?>
					<tr valign="top" class="has-dependency" data-dependency-element="<?php echo esc_attr( $field_id . '_type' ); ?>" data-dependency-values='["selfhosted"]'>
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_webm]'; ?>"><?php _e( 'webm URL', 'wolf' ); ?><br>
						</th>

						<td class="forminp">
							<input type="text" class="option-input" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_webm]'; ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_url( $webm ); ?>">
							<br><br>
							<a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( ! in_array( 'ogv', $exclude_params ) ) : ?>
					<tr valign="top" class="has-dependency" data-dependency-element="<?php echo esc_attr( $field_id . '_type' ); ?>" data-dependency-values='["selfhosted"]'>
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_ogv]'; ?>"><?php _e( 'ogv URL', 'wolf' ); ?><br>
						</th>

						<td class="forminp">
							<input type="text" class="option-input" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_ogv]'; ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_url( $ogv ); ?>">
							<br><br>
							<a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
						</td>
					</tr>
				<?php endif; ?>

				<?php if ( ! in_array( 'image', $exclude_params ) ) : ?>
					<tr valign="top">
						<th scope="row" class="titledesc">
							<label for="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_img]'; ?>"><?php _e( 'Image URL', 'wolf' ); ?><br>
							<small class="description"><?php _e( 'Image fallback', 'wolf' ); ?></small></label>
						</th>

						<td class="forminp">
							<input type="text" class="option-input" name="<?php echo esc_attr( $prefix ) . '[' .  $field_id .'_img]'; ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_url( $img ); ?>">
							<br><br>
							<a href="#" class="button wolf-options-reset-file"><?php _e( 'Clear', 'wolf' ); ?></a>
							<a href="#" class="button wolf-options-set-file"><?php _e( 'Choose a file', 'wolf' ); ?></a>
						</td>
					</tr>
				<?php endif; ?>

			</tbody>
		</table>

		</div><!-- end option section -->
		<?php elseif ( $type == 'colorpicker' ) : ?>

			<tr valign="top" class="<?php echo esc_attr( $class ); ?>"<?php echo $data; ?>>
				<th scope="row" class="titledesc">
					<label for="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]"><?php echo sanitize_text_field( $item['label'] ); ?><br>
						<small class="description"><?php echo $desc; ?></small>
					</label>
				</th>

				<td class="forminp">
					<input class="wolf-options-colorpicker" name="<?php echo esc_attr( $prefix ); ?>[<?php echo esc_attr( $field_id ); ?>]" id="<?php echo esc_attr( $field_id ); ?>" type="text" value="<?php echo ( $this->get_option( $field_id ) ) ? htmlentities( stripslashes( $this->get_option( $field_id ) ) ) : $def; ?>">
				</td>
			</tr>


		<?php
		endif;

		} // end wolf_do_input function

	} // end class

} // end class exists check