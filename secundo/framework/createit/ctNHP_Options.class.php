<?php require_once CT_THEME_LIB_DIR.'/options/options.php';

/**
 * Options class
 * @author alex
 */
class ctNHP_Options extends NHP_Options {
	/**
	 * Main groups
	 * @var array
	 */
	protected $groups;

	/**
	 * @param array $sections
	 * @param array $args
	 * @param array $extra_tabs
	 */

	function __construct( $sections = array(), $args = array(), $extra_tabs = array() ) {
		$defaultGroup = esc_html__( 'General', 'ct_theme' );
		foreach ( $extra_tabs as $k => $t ) {
			if ( ! isset( $t['group'] ) ) {
				$extra_tabs[ $k ]['group'] = $defaultGroup;
			}
		}

		foreach ( $sections as $key => $section ) {
			if ( ! isset( $section['group'] ) ) {
				$section['group'] = 'General';
				$sections[ $key ] = $section;
			}

			$this->groups[ $section['group'] ] = true;
		}


		$this->groups = array_keys( $this->groups );

		$args['footer_credit'] = '';

		parent::__construct( $sections, $args, $extra_tabs );
	}

	/**
	 * Refresh options - adds defaults when option doesn't exist
	 */

	function refresh() {
		update_option( $this->args['opt_name'], $this->updateMissingValues() );

		//get the options for use later on
		$this->options = get_option( $this->args['opt_name'], array() );
	}

	/**
	 * Import data from string
	 *
	 * @param array $data
	 * @param array $parsedPosts
	 */

	public function import( $data, $parsedPosts = array() ) {
		$imported_options = unserialize( trim( $data, '###' ) );
		if ( $parsedPosts ) {
			//let's try to find a new page so we can substitute it
			foreach ( $imported_options as $name => $val ) {
				if ( strpos( $name, '_index_page' ) !== false || strpos( $name, 'pages_home_page' ) !== false ) {
					if ( isset( $parsedPosts[ $val ] ) && $parsedPosts[ $val ] ) {
						$imported_options[ $name ] = $parsedPosts[ $val ];
					}
				}
			}

			$imported_options = apply_filters('ct.options.import',$imported_options);

		}
		update_option( $this->args['opt_name'], $imported_options );
	}

	/**
	 * Export settings
	 * @return string
	 */

	public function export() {
		$backup_options = $this->options;

		return '###' . serialize( $backup_options ) . '###';
	}

	/**
	 * Updates missing values
	 * @return array
	 */

	protected function updateMissingValues() {
		$default        = $this->_default_values();
		$currentOptions = get_option( $this->args['opt_name'], array() );

		//find new options with defined values
		foreach ( $default as $name => $val ) {
			//here we only add new ones
			if ( ! isset( $currentOptions[ $name ] ) ) {
				$currentOptions[ $name ] = $val;
			}
		}

		return $currentOptions;
	}

	/**
	 * Remove specified keys
	 *
	 * @param $opt_name
	 */

	function remove( $opt_name ) {
		if ( array_key_exists( $opt_name, $this->options ) ) {
			unset( $this->options[ $opt_name ] );
			update_option( $this->args['opt_name'], $this->options );
		}
	}

	/**
	 * Returns setting
	 *
	 * @param $opt_name
	 * @param null $default
	 *
	 * @return null
	 */
	function get( $opt_name, $default = null ) {
		$value = ( $this->has( $opt_name ) ) ? $this->options[ $opt_name ] : $default;
		//generic call
		$value = apply_filters( 'ct.options.get', $value,$opt_name, $default, $this->options );

		return apply_filters( 'ct.options.get.' . $opt_name, $value, $default, $this->options );
	}

	/**
	 * Do we have this option?
	 *
	 * @param $opt_name
	 *
	 * @return bool
	 */

	function has( $opt_name ) {
		return $this->options && is_array( $this->options ) && array_key_exists( $opt_name, $this->options );
	}

	/**
	 * Set text
	 *
	 * @param string $opt_name
	 * @param string $value
	 */
	/*function set($opt_name = '', $value = '') {
		$value = apply_filters('ct.options.set.'.$opt_name,$value,$this->options);
		if ($opt_name != '') {
			$this->options[$opt_name] = $value;
			if(apply_filters('ct.options.set.should_save.'.$opt_name,true,$value,$this->options)){
				update_option($this->args['opt_name'], $this->options);
			}
		}
	}*/

	/**
	 * Returns options page name
	 * @return mixed
	 */

	function getOptionsPageName() {
		return $this->args['opt_name'];
	}

	/**
	 * Return sections
	 * @return array|mixed|void
	 */

	public function getSections() {
		return $this->sections;
	}

	/**
	 * Sets sections
	 *
	 * @param $sections
	 */

	public function setSections( $sections ) {
		$this->sections = $sections;
	}

	/**
	 * Add section at index
	 *
	 * @param $section
	 * @param $index
	 *
	 * @return array
	 */

	public static function insertSectionAtIndex( $sections, $section, $index ) {
		/*** get the start of the array ***/
		$start = array_slice( $sections, 0, $index );
		/*** get the end of the array ***/
		$end = array_slice( $sections, $index );
		/*** add the new element to the array ***/
		$start[] = $section;

		/*** glue them back together and return ***/

		return array_merge( $start, $end );
	}

	/**
	 * HTML OUTPUT.
	 *
	 * @since NHP_Options 1.0
	 */
	function _options_page_html() {
		$groups = $this->groups;

		echo '<div class="wrap">';
		echo '<div id="' . esc_attr($this->args['page_icon']) . '" class="icon32"><br/></div>';
		echo '<h2 id="nhp-opts-heading">' . esc_html(get_admin_page_title()) . '</h2>';
		//allow custom intro text. No escaping needed because it's not dynamic, but defined in theme PHP config
		echo ( isset( $this->args['intro_text'] ) ) ? $this->args['intro_text'] : '';

		do_action( 'nhp-opts-page-before-form-' . $this->args['opt_name'], $this );

		echo '<form method="post" action="options.php" enctype="multipart/form-data" id="nhp-opts-form-wrapper">';
		settings_fields( $this->args['opt_name'] . '_group' );

		$this->options['last_tab'] = ( isset( $_GET['tab'] ) && ! get_transient( 'nhp-opts-saved' ) ) ? $_GET['tab'] : $this->options['last_tab'];

		echo '<input type="hidden" id="last_tab" name="' . esc_attr($this->args['opt_name']) . '[last_tab]" value="' . esc_attr($this->options['last_tab']) . '" />';

		echo '<div id="nhp-opts-header">';
		submit_button( '', 'primary', '', false );
		submit_button( esc_html__( 'Reset to Defaults', 'ct_theme' ),
			'secondary',
			$this->args['opt_name'] . '[defaults]',
			false );
		echo '<div class="clear"></div><!--clearfix-->';
		echo '</div>';

		echo '<div id="nhp-main-tabs"><ul>';
		foreach ( $groups as $key => $main ) {
			echo '<li><a data-rel="wrapper_' . esc_attr($key) . '" href="#">' . esc_html($main) . '</a></li>';
		}
		echo '</ul><div class="clear"></div></div>';

		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' && get_transient( 'nhp-opts-saved' ) == '1' ) {
			if ( isset( $this->options['imported'] ) && $this->options['imported'] == 1 ) {
				echo '<div id="nhp-opts-imported">' . apply_filters( 'nhp-opts-imported-text-' . $this->args['opt_name'],
						wp_kses(__( '<strong>Settings Imported!</strong>', 'ct_theme' ),array('strong'=>array())) ) . '</div>';
			} else {
				echo '<div id="nhp-opts-save">' . apply_filters( 'nhp-opts-saved-text-' . $this->args['opt_name'],
						wp_kses( '<strong>Settings Saved!</strong>', 'ct_theme' ), array('strong'=>array()) ) . '</div>';
			}
			delete_transient( 'nhp-opts-saved' );
		}
		echo '<div id="nhp-opts-field-errors">' . wp_kses(__( '<strong><span></span> error(s) were found!</strong>',
				'ct_theme' ),array('strong'=>array(), 'span'=>array())) . '</div>';

		echo '<div id="nhp-opts-field-warnings">' . wp_kses(__( '<strong><span></span> warning(s) were found!</strong>',
				'ct_theme' ),array('strong'=>array(), 'span'=>array())) . '</div>';

		echo '<div class="clear"></div><!--clearfix-->';
		foreach ( $groups as $key => $main ) {
			echo '<div class="nhp-main-wrapper">';
			echo '<div id="wrapper_' . esc_attr($key) . '" class="nhp-main-wrapper-items">';

			echo '<div class="nhp-opts-sidebar">';
			echo '<ul class="nhp-opts-group-menu">';
			foreach ( $this->sections as $k => $section ) {
				if ( $section['group'] == $main ) {
					if ( ! isset( $section['type'] ) || $section['type'] != 'divider' ) {

						$icon = ( ! isset( $section['icon'] ) ) ? '<img src="' . $this->url . 'img/glyphicons/glyphicons_019_cogwheel.png" /> ' : '<img src="' . $section['icon'] . '" /> ';
						echo '<li id="' . esc_attr($k) . '_section_group_li" class="nhp-opts-group-tab-link-li">';
						echo '<a href="javascript:void(0);" id="' . esc_attr($k) . '_section_group_li_a" class="nhp-opts-group-tab-link-a" data-rel="' . esc_attr($k) . '">' . $icon . '<span>' . esc_html($section['title']) . '</span></a>';
						echo '</li>';
					} else {
						echo '<li class="divide">&nbsp;</li>';
					}
				}
			}

			echo '<li class="divide">&nbsp;</li>';

			do_action( 'nhp-opts-after-section-menu-items-' . $this->args['opt_name'], $this );

			//only for general tab
			if ( true === $this->args['show_import_export'] && $main == 'General' ) {
				echo '<li id="import_export_default_section_group_li" class="nhp-opts-group-tab-link-li">';
				echo '<a href="javascript:void(0);" id="import_export_default_section_group_li_a" class="nhp-opts-group-tab-link-a" data-rel="import_export_default"><img src="' . esc_url($this->url . 'img/glyphicons/glyphicons_082_roundabout.png"').'" /> <span>' . esc_html__( 'Import / Export',
						'ct_theme' ) . '</span></a>';
				echo '</li>';
				echo '<li class="divide">&nbsp;</li>';
			}
			//if


			foreach ( $this->extra_tabs as $k => $tab ) {
				if ( $tab['group'] == $main ) {
					$icon = ( ! isset( $tab['icon'] ) ) ? '<img src="' . $this->url . 'img/glyphicons/glyphicons_019_cogwheel.png" /> ' : '<img src="' . $tab['icon'] . '" /> ';
					echo '<li id="' . esc_attr($k) . '_section_group_li" class="nhp-opts-group-tab-link-li">';
					echo '<a href="javascript:void(0);" id="' . esc_attr($k) . '_section_group_li_a" class="nhp-opts-group-tab-link-a custom-tab" data-rel="' . esc_attr($k) . '">' . $icon . '<span>' . esc_attr($tab['title']) . '</span></a>';
					echo '</li>';
				}
			}


			if ( true === $this->args['dev_mode'] && $main == 'General' ) {
				echo '<li id="dev_mode_default_section_group_li" class="nhp-opts-group-tab-link-li">';
				echo '<a href="javascript:void(0);" id="dev_mode_default_section_group_li_a" class="nhp-opts-group-tab-link-a custom-tab" data-rel="dev_mode_default"><img src="' . esc_url($this->url . 'img/glyphicons/glyphicons_195_circle_info.png"').' /> <span>' . esc_html__( 'Dev Mode Info',
						'ct_theme' ) . '</span></a>';
				echo '</li>';
			}
			//if

			echo '</ul>';
			echo '</div>';

			echo '<div class="nhp-opts-main">';

			foreach ( $this->sections as $k => $section ) {
				if ( $section['group'] == $main ) {
					echo '<div id="' . esc_attr($k) . '_section_group' . '" class="nhp-opts-group-tab">';
					do_settings_sections( $k . '_section_group' );
					echo '</div>';
				}
			}


			if ( true === $this->args['show_import_export'] && $main == 'General' ) {
				echo '<div id="import_export_default_section_group' . '" class="nhp-opts-group-tab">';
				echo '<h3>' . esc_html__( 'Import / Export Options', 'ct_theme' ) . '</h3>';

				echo '<h4>' . esc_html__( 'Import Options', 'ct_theme' ) . '</h4>';

				echo '<p><a href="javascript:void(0);" id="nhp-opts-import-code-button" class="button-secondary">'.esc_html__('Import from file','ct_theme').'</a> <a href="javascript:void(0);" id="nhp-opts-import-link-button" class="button-secondary">Import from URL</a></p>';

				echo '<div id="nhp-opts-import-code-wrapper">';

				echo '<div class="nhp-opts-section-desc">';

				echo '<p class="description" id="import-code-description">' . apply_filters( 'nhp-opts-import-file-description',
						esc_html__( 'Input your backup file below and hit Import to restore your sites options from a backup.',
							'ct_theme' ) ) . '</p>';

				echo '</div>';

				echo '<textarea id="import-code-value" name="' . esc_attr($this->args['opt_name']) . '[import_code]" class="large-text" rows="8"></textarea>';

				echo '</div>';


				echo '<div id="nhp-opts-import-link-wrapper">';

				echo '<div class="nhp-opts-section-desc">';

				echo '<p class="description" id="import-link-description">' . apply_filters( 'nhp-opts-import-link-description',
						esc_html__( 'Input the URL to another sites options set and hit Import to load the options from that site.',
							'ct_theme' ) ) . '</p>';

				echo '</div>';

				echo '<input type="text" id="import-link-value" name="' . esc_attr($this->args['opt_name']) . '[import_link]" class="large-text" value="" />';

				echo '</div>';


				echo '<p id="nhp-opts-import-action"><input type="submit" id="nhp-opts-import" name="' . esc_attr($this->args['opt_name']) . '[import]" class="button-primary" value="' . esc_html__( 'Import',
						'ct_theme' ) . '"> <span>' . apply_filters( 'nhp-opts-import-warning',
						esc_html__( 'WARNING! This will overwrite any existing options, please proceed with caution!',
							'ct_theme' ) ) . '</span></p>';
				echo '<div id="import_divide"></div>';

				echo '<h4>' . esc_html__( 'Export Options', 'ct_theme' ) . '</h4>';
				echo '<div class="nhp-opts-section-desc">';
				echo '<p class="description">' . apply_filters( 'nhp-opts-backup-description',
						esc_html__( 'Here you can copy/download your themes current option settings. Keep this safe as you can use it as a backup should anything go wrong. Or you can use it to restore your settings on this site (or any other site). You also have the handy option to copy the link to yours sites settings. Which you can then use to duplicate on another site',
							'ct_theme' ) ) . '</p>';
				echo '</div>';

				echo '<p><a href="javascript:void(0);" id="nhp-opts-export-code-copy" class="button-secondary">Copy</a> <a href="' . esc_url(add_query_arg( array(
							'feed'   => 'nhpopts-' . $this->args['opt_name'],
							'action' => 'download_options',
							'secret' => md5( AUTH_KEY . SECURE_AUTH_KEY )
						),
						site_url() )) . '" id="nhp-opts-export-code-dl" class="button-primary">Download</a> <a href="javascript:void(0);" id="nhp-opts-export-link" class="button-secondary">Copy Link</a></p>';
				$backup_options                    = $this->options;
				$backup_options['nhp-opts-backup'] = '1';
				$encoded_options                   = '###' . serialize( $backup_options ) . '###';
				echo '<textarea class="large-text" id="nhp-opts-export-code" rows="8">';
				print_r( $encoded_options );
				echo '</textarea>';
				echo '<input type="text" class="large-text" id="nhp-opts-export-link-value" value="' . esc_attr(add_query_arg( array(
							'feed'   => 'nhpopts-' . $this->args['opt_name'],
							'secret' => md5( AUTH_KEY . SECURE_AUTH_KEY )
						)),
						site_url() ) . '" />';

				echo '</div>';
			}


			foreach ( $this->extra_tabs as $k => $tab ) {
				echo '<div class="nhp-main-wrapper">';
				echo '<div id="wrapper_' . esc_attr($key) . '" class="nhp-main-wrapper-items">';
				echo '<div id="' . esc_attr($k) . '_section_group' . '" class="nhp-opts-group-tab">';
				//no escaping needed. Sets via PHP theme options by dev
				echo '<h3>' . $tab['title'] . '</h3>';
				echo $tab['content'];
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}


			if ( true === $this->args['dev_mode'] ) {
				echo '<div id="dev_mode_default_section_group' . '" class="nhp-opts-group-tab">';
				echo '<h3>' . esc_html__( 'Dev Mode Info', 'ct_theme' ) . '</h3>';
				echo '<div class="nhp-opts-section-desc">';
				echo '<textarea class="large-text" rows="24">' . print_r( $this, true ) . '</textarea>';
				echo '</div>';
				echo '</div>';
			}


			do_action( 'nhp-opts-after-section-items-' . $this->args['opt_name'], $this );

			echo '<div class="clear"></div><!--clearfix-->';
			echo '</div>';
			echo '<div class="clear"></div><!--clearfix-->';
			echo '</div>';
			echo '</div>';
		}
		echo '<div id="nhp-opts-footer">';

		if ( isset( $this->args['share_icons'] ) ) {
			echo '<div id="nhp-opts-share">';
			foreach ( $this->args['share_icons'] as $link ) {
				$c = isset( $link['img'] ) && $link['img'] ? '<img src="' . esc_url($link['img']) . '"/>' : esc_html($link['title']);
				echo '<a' . ( isset( $link['style'] ) ? ' style="' . esc_attr($link['style']) . '"' : '' ) . ' href="' . esc_url($link['link']) . '" title="' . esc_html($link['title']) . '" target="_blank">' . $c . '</a>';
			}
			echo '</div>';
		}

		submit_button( '', 'primary', '', false );
		submit_button( esc_html__( 'Reset to Defaults', 'ct_theme' ),
			'secondary',
			$this->args['opt_name'] . '[defaults]',
			false );
		echo '<div class="clear"></div><!--clearfix-->';
		echo '</div>';

		echo '</form>';

		do_action( 'nhp-opts-page-after-form-' . $this->args['opt_name'] );

		echo '<div class="clear"></div><!--clearfix-->';
		echo '</div><!--wrap-->';
	}

	/**
	 * Section HTML OUTPUT.
	 *
	 * @since NHP_Options 1.0
	 */
	function _section_desc( $section ) {

		$id = rtrim( $section['id'], '_section' );

		if ( isset( $this->sections[ $id ]['desc'] ) && ! empty( $this->sections[ $id ]['desc'] ) ) {
			echo '<div class="nhp-opts-section-desc"><p class="description">' . $this->sections[ $id ]['desc'] . '</p></div>';//no escape required, used by dev onlys, html needed
		}
	}
	//function
}
