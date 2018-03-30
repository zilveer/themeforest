<?php
if( ! defined( 'CI_PANEL_TABS_DIR' ) ) define( 'CI_PANEL_TABS_DIR', 'functions/tabs' );

// Load our default options.
load_ci_defaults();

add_action( 'init', 'ci_register_theme_default_scripts', 10 );
function ci_register_theme_default_scripts() {
	wp_register_script( 'jquery-cycle-all', get_child_or_parent_file_uri( '/panel/scripts/jquery.cycle.all-3.0.2.js' ), array( 'jquery' ), '3.0.2', true );
	wp_register_script( 'jquery-flexslider', get_child_or_parent_file_uri( '/panel/scripts/jquery.flexslider-2.1-min.js' ), array( 'jquery' ), false, true );
	wp_register_script( 'jquery-hoverIntent', get_child_or_parent_file_uri( '/panel/scripts/jquery.hoverIntent.r7.min.js' ), array( 'jquery' ), 'r7', true );
	wp_register_script( 'jquery-superfish', get_child_or_parent_file_uri( '/panel/scripts/superfish-1.7.4.min.js' ), array(
		'jquery',
		'jquery-hoverIntent'
	), '1.7.4', true );
	wp_register_script( 'jquery-fitVids', get_child_or_parent_file_uri( '/panel/scripts/jquery.fitvids.js' ), array( 'jquery' ), '1.1', true );
	wp_register_script( 'jquery-ui-datepicker-localize', get_child_or_parent_file_uri( '/panel/scripts/jquery.ui.datepicker.localize.js' ), array( 'jquery' ), '1.0', true );

	// Bower-updated components
	wp_register_script( 'retinajs', get_child_or_parent_file_uri( '/panel/components/retinajs/dist/retina.js' ), array(), '1.3.0', true );
	wp_register_style( 'font-awesome', get_child_or_parent_file_uri( '/panel/components/fontawesome/css/font-awesome.min.css' ), array(), '4.6.3' );

}

add_action( 'admin_init', 'ci_register_admin_scripts' );
function ci_register_admin_scripts() {
	//
	// Register all scripts and style here, unconditionally. Conditionals are used further down this file for enqueueing.
	//
	wp_register_script( 'ci-panel', get_child_or_parent_file_uri( '/panel/scripts/panelscripts.js' ), array( 'jquery' ) );
	wp_register_style( 'ci-panel-css', get_child_or_parent_file_uri( '/panel/panel.css' ) );

	wp_register_script( 'ci-post-formats', get_child_or_parent_file_uri( '/panel/scripts/ci-post-formats.js' ), array( 'jquery' ) );
	wp_register_style( 'ci-post-formats', get_child_or_parent_file_uri( '/panel/styles/ci-post-formats.css' ) );

	// Can be enqueued properly by ci_enqueue_media_manager_scripts() defined in panel/generic.php
	wp_register_script( 'ci-media-manager-3-5', get_child_or_parent_file_uri( '/panel/scripts/media-manager-3.5.js' ), array( 'media-editor' ) );

	wp_register_script( 'ci-panel-post-edit-screens', get_child_or_parent_file_uri( '/panel/scripts/post-edit-screens.js' ), array( 'jquery' ) );
	wp_register_style( 'ci-panel-post-edit-screens', get_child_or_parent_file_uri( '/panel/styles/post-edit-screens.css' ) );

}

add_action( 'wp_enqueue_scripts', 'ci_enqueue_panel_scripts' );
function ci_enqueue_panel_scripts() {
	if ( apply_filters( 'ci_retina_logo', true ) ) {
		wp_enqueue_script( 'retinajs' );
	}
}

add_action( 'admin_enqueue_scripts', 'ci_enqueue_admin_scripts' );
function ci_enqueue_admin_scripts() {
	global $pagenow;

	//
	// Enqueue here scripts and styles that are to be loaded on all admin pages.
	//

	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {
		//
		// Enqueue here scripts and styles that are to be loaded only on post edit screens.
		//
		if ( current_theme_supports( 'post-formats' ) ) {
			wp_enqueue_script( 'ci-post-formats' );
			wp_enqueue_style( 'ci-post-formats' );
		}

		wp_enqueue_script( 'ci-panel-post-edit-screens' );
		wp_enqueue_style( 'ci-panel-post-edit-screens' );
	}

	if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] == 'ci_panel.php' ) {
		//
		// Enqueue here scripts and styles that are to be loaded only on CSSIgniter Settings panel.
		//
		global $wp_version;

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_media();
		ci_enqueue_media_manager_scripts();

		wp_enqueue_script( 'ci-panel' );
		wp_enqueue_style( 'ci-panel-css' );

	}

}

add_action( 'admin_bar_menu', 'ci_create_bar_menu', 100 );
function ci_create_bar_menu( $wp_admin_bar ) {
	if ( ! is_admin() && current_user_can( 'edit_theme_options' ) ) {
		if ( ! CI_WHITELABEL ) {
			$menu_title = __( 'CSSIgniter Settings', 'ci_theme' );
		} else {
			$menu_title = __( 'Theme Settings', 'ci_theme' );
		}

		$menu_title = apply_filters( 'ci_panel_menu_title', $menu_title, CI_WHITELABEL );

		$args = array(
			'id'     => 'ci_theme_settings',
			'title'  => $menu_title,
			'href'   => admin_url( 'themes.php?page=ci_panel.php' ),
			'parent' => 'appearance'
		);

		$wp_admin_bar->add_node( $args );
	}
}

add_action( 'admin_menu', 'ci_create_menu' );
function ci_create_menu() {
	add_action( 'admin_init', 'ci_register_settings' );

	// Handle reset before anything is outputed in the browser.
	// This is here because it needs the settings to be registered, but because it
	// redirects, it should be called before the ci_settings_page.
	global $pagenow;
	if ( is_admin() && isset( $_POST['reset'] ) && ( $pagenow == "themes.php" ) ) {
		delete_option( THEME_OPTIONS );
		global $ci;
		$ci = array();
		ci_default_options( true );
		wp_redirect( 'themes.php?page=ci_panel.php' );
	}

	if ( ! CI_WHITELABEL ) {
		$menu_title = __( 'CSSIgniter Settings', 'ci_theme' );
	} else {
		$menu_title = __( 'Theme Settings', 'ci_theme' );
	}

	$menu_title = apply_filters( 'ci_panel_menu_title', $menu_title, CI_WHITELABEL );
	add_theme_page( $menu_title, $menu_title, 'edit_theme_options', basename( __FILE__ ), 'ci_settings_page' );

}

function ci_register_settings() {
	register_setting( 'ci-settings-group', THEME_OPTIONS, 'ci_options_validate' );
	//register_setting( 'ci-settings-group', THEME_OPTIONS);
}

function ci_options_validate( $set ) {
	global $ci_defaults;
	$set = (array) $set;

	foreach ( $ci_defaults as $key => $value ) {
		if ( ! isset( $set[ $key ] ) ) {
			$set[ $key ] = '';
		}
	}

	return $set;
}


function ci_settings_page() {
	?>
	<div class="wrap">
		<h2>
			<?php
				if ( ! CI_WHITELABEL ) {
					/* translators: %1$s is the theme name. %2$s is the theme's version number prepended by a 'v', e.g. v1.2 */
					echo sprintf( _x( '%1$s Settings v%2$s', 'theme name settings version', 'ci_theme' ),
						CI_THEME_NICENAME,
						CI_THEME_VERSION
					);
				} else {
					echo sprintf( _x( '%s Settings', 'theme name settings', 'ci_theme' ),
						CI_THEME_NICENAME
					);
				}
			?>
		</h2>

		<?php if ( ! CI_WHITELABEL ): ?>
			<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fcssigniter&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
		<?php endif; ?>

		<?php $latest_version = ci_theme_update_check(); ?>
		<?php if ( ( $latest_version !== false ) && version_compare( $latest_version, CI_THEME_VERSION, '>' ) ): ?>
			<div id="theme-update">
				<?php echo sprintf( __( 'A theme update is available. The latest version is <b>%1$s</b> and you are running <b>%2$s</b>', 'ci_theme' ), $latest_version, CI_THEME_VERSION ); ?>
			</div>
		<?php endif; ?>
	
		<?php
			$panel_classes = ci_theme_classes();
			unset( $panel_classes['theme_color_scheme'] );
		?>
		<div id="ci_panel" class="<?php echo implode( ' ', $panel_classes ); ?>">
			<form method="post" action="options.php" id="theform" enctype="multipart/form-data">
				<?php
					settings_fields( 'ci-settings-group' );
					$theme_options = get_option( THEME_OPTIONS );
				?>
				<div id="ci_header">
					<?php if ( ! CI_WHITELABEL ): ?>
						<img src="<?php echo esc_url( apply_filters( 'ci_panel_logo_url', get_child_or_parent_file_uri( '/panel/img/logo.png' ), '/panel/img/logo.png' ) ); ?>"/>
					<?php endif; ?>
				</div>

				<?php if ( isset( $_POST['reset'] ) ): ?>
					<div class="resetbox"><?php _e( 'Settings reset!', 'ci_theme' ); ?></div>
				<?php endif; ?>

				<div class="success"></div>

				<div class="ci_save ci_save_top group">
					<p>
						<?php
							$docs_links = array();
							if( CI_DOCS != '' ) {
								$docs_links[] = sprintf( '<a href="%s">%s</a>',
									esc_url( CI_DOCS ),
									__( 'Documentation', 'ci_theme' )
								);
							}
							if ( CI_FORUM != '' ) {
								$docs_links[] = sprintf( '<a href="%s">%s</a>',
									esc_url( CI_FORUM ),
									__( 'Support forum', 'ci_theme' )
								);
							}
							echo implode( ' | ', $docs_links );
						?>
					</p>
					<input type="submit" class="button-primary save" value="<?php esc_attr_e( 'Save Changes', 'ci_theme' ); ?>"/>
				</div>

				<div id="ci_main" class="group">
	
					<?php 
						// Each tab is responsible for adding itself to the list of the panel tabs.
						// The priority on add_filter() affects the order of the tabs.
						// Tab files are automatically loaded for initialization by the function load_ci_defaults().
						// Child themes have a chance to load their tabs (or unload the parent theme's tabs) only after
						// the parent theme has initialized its tabs.
						$paneltabs = apply_filters( 'ci_panel_tabs', array() ); 
					?>
	
					<div id="ci_sidebar_back"></div>
					<div id="ci_sidebar">
						<ul>
							<?php
								$tabNum = 1;
								foreach($paneltabs as $name => $title) {
									$firstclass = $tabNum == 1 ? 'active' : '';
									echo sprintf( '<li id="%1$s"><a href="#tab%2$s" rel="tab%2$s" class="%3$s"><span>%4$s</span></a></li>',
										esc_attr( $name ),
										esc_attr( $tabNum ),
										esc_attr( $firstclass ),
										$title
									);
									$tabNum ++;
								}
							?>
						</ul>
					</div><!-- /sidebar -->
	
					<div id="ci_options">
						<div id="ci_options_inner">
							<?php
								$tabNum = 1;
								foreach($paneltabs as $name => $title) {
									$firstclass = $tabNum == 1 ? 'one' : '';
									?><div id="tab<?php echo esc_attr( $tabNum ); ?>" class="tab <?php echo esc_attr( $firstclass ); ?>"><?php get_template_part( CI_PANEL_TABS_DIR . '/' . $name ); ?></div><?php
									$tabNum ++;
								}
							?>
						</div>
					</div><!-- #ci_options -->
	
				</div><!-- #ci_main -->
				<div class="ci_save group">
					<input type="submit" class="button-primary save" value="<?php esc_attr_e( 'Save Changes', 'ci_theme' ); ?>"/>
				</div>
			</form>
		</div><!-- #ci_panel -->
	
		<div id="ci-reset-box">
			<form method="post" action="">
				<input type="hidden" name="reset" value="reset" />
				<input type="submit" class="button" value="<?php esc_attr_e( 'Reset Settings', 'ci_theme' ); ?>" onclick="return confirm('<?php esc_attr_e( 'Are you sure? All settings will be lost!', 'ci_theme' ); ?>'); "/>
			</form>
		</div>
	</div><!-- wrap -->
	<?php 
}


function load_ci_defaults() {
	global $load_defaults, $ci, $ci_defaults;
	$load_defaults = TRUE;

	// All php files in CI_PANEL_TABS_DIR are loaded by default.
	// Those files (tabs) are responsible for adding themselves on the actual tabs that will be show,
	// by hooking on the 'ci_panel_tabs' filter.
	$paths   = array();
	$paths[] = get_template_directory();
	if ( is_child_theme() ) {
		$paths[] = get_stylesheet_directory();
	}

	foreach ( $paths as $path ) {
		$path .= '/' . CI_PANEL_TABS_DIR;

		if ( file_exists( $path ) and $handle = opendir( $path ) ) {
			while ( false !== ( $file = readdir( $handle ) ) ) {
				if ( $file != "." && $file != ".." ) {
					$file_info = pathinfo( $path . '/' . $file );
					if ( isset( $file_info['extension'] ) and $file_info['extension'] == 'php' ) {
						get_template_part( CI_PANEL_TABS_DIR . '/' . basename( $file, '.php' ) );
					}
				}
			}
			closedir( $handle );
		}
	}

	$load_defaults = false;
	$ci_defaults   = apply_filters( 'ci_defaults', $ci_defaults );
}

function load_panel_snippet( $slug, $name = null ) {
	$slug = 'panel/snippets/' . $slug;

	do_action( "get_template_part_{$slug}", $slug, $name );

	$templates = array();
	if ( isset( $name ) ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	locate_template( $templates, true, false );
}

//
//
// CSSIgniter panel control generators
//
//
function ci_panel_textarea( $fieldname, $label ) {
	global $ci;
	?>
	<label for="<?php echo esc_attr( $fieldname ); ?>"><?php echo $label; ?></label>
	<textarea id="<?php echo esc_attr( $fieldname ); ?>" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>" rows="5"><?php echo esc_textarea( $ci[ $fieldname ] ); ?></textarea>
	<?php
}

function ci_panel_input( $fieldname, $label, $params = array() ) {
	global $ci;

	$defaults = array(
		'label_class' => '',
		'input_class' => '',
		'input_type'  => 'text'
	);
	$params = wp_parse_args( $params, $defaults );

	if ( ! empty( $label ) ) {
		?><label for="<?php echo esc_attr( $fieldname ); ?>" class="<?php echo esc_attr( $params['label_class'] ); ?>"><?php echo $label; ?></label><?php
	}
	?><input id="<?php echo esc_attr( $fieldname ); ?>" type="<?php echo esc_attr( $params['input_type'] ); ?>" size="60" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>" value="<?php echo esc_attr( $ci[ $fieldname ] ); ?>" class="<?php echo esc_attr( $params['input_class'] ); ?>" /><?php
}

// $fieldname is the actual name="" attribute common to all radios in the group.
// $optionname is the id of the radio, so that the label can be associated with it.
function ci_panel_radio( $fieldname, $optionname, $optionval, $label ) {
	global $ci;
	?>
	<label for="<?php echo esc_attr( $optionname ); ?>" class="radio">
		<input type="radio" class="radio" id="<?php echo esc_attr( $optionname ); ?>" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>" value="<?php echo esc_attr( $optionval ); ?>" <?php checked( $ci[ $fieldname ], $optionval ); ?> />
		<?php echo $label; ?>
	</label>
	<?php
}

function ci_panel_checkbox( $fieldname, $value, $label, $params = array() ) {
	global $ci;

	$params = wp_parse_args( $params, array(
		'input_class' => 'check',
	) );

	?>
	<label for="<?php echo esc_attr( $fieldname ); ?>">
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="<?php echo esc_attr( $params['input_class'] ); ?>" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( $ci[ $fieldname ], $value ); ?> />
		<?php echo $label; ?>
	</label>
	<?php
}

function ci_panel_upload_image( $fieldname, $label, $params = array() ) {
	global $ci;

	$defaults = array(
		'input_class'   => 'uploaded',
		'input_type'    => 'text',
		'esc_func'      => 'esc_url',
		'preview_field' => $fieldname
	);
	$params = wp_parse_args( $params, $defaults );

	$value = $ci[ $fieldname ];
	$value = call_user_func( $params['esc_func'], $value );

	$preview_url = $ci[ $params['preview_field'] ];
	?>
	<label for="<?php echo esc_attr( $fieldname ); ?>"><?php echo $label; ?></label>
	<input id="<?php echo esc_attr( $fieldname ); ?>" type="<?php echo esc_attr( $params['input_type'] ); ?>" size="60" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>" value="<?php echo esc_attr( $value ); ?>" class="<?php echo esc_attr( $params['input_class'] ); ?>"/>
	<input type="submit" class="ci-upload button" value="<?php esc_attr_e( 'Upload image', 'ci_theme' ); ?>"/>
	<div class="up-preview"><?php echo( ! empty( $preview_url ) ? '<img src="' . esc_url( $preview_url ) . '" />' : '' ); ?></div>
	<?php if ( ! empty( $preview_url ) ): ?>
		<div class="up-preview-bg group">
			<span class="swatch white" title="<?php echo esc_attr( sprintf( _x( 'Preview in %s background', 'preview in color background', 'ci_theme' ), _x( 'White', 'color', 'ci_theme' ) ) ); ?>"></span>
			<span class="swatch grey" title="<?php echo esc_attr( sprintf( _x( 'Preview in %s background', 'preview in color background', 'ci_theme' ), _x( 'Grey', 'color', 'ci_theme' ) ) ); ?>"></span>
			<span class="swatch black" title="<?php echo esc_attr( sprintf( _x( 'Preview in %s background', 'preview in color background', 'ci_theme' ), _x( 'Black', 'color', 'ci_theme' ) ) ); ?>"></span>
			<span class="swatch transparent" title="<?php echo esc_attr( sprintf( _x( 'Preview in %s background', 'preview in color background', 'ci_theme' ), _x( 'Transparent', 'color', 'ci_theme' ) ) ); ?>"></span>
		</div>
	<?php endif; ?>
<?php
}

function ci_panel_dropdown( $fieldname, $options, $label ) {
	global $ci;
	$options = (array) $options;
	?>
	<label for="<?php echo esc_attr( $fieldname ); ?>"><?php echo $label; ?></label>
	<select id="<?php echo esc_attr( $fieldname ); ?>" name="<?php echo esc_attr( THEME_OPTIONS . '[' . $fieldname . ']' ); ?>">
		<?php foreach ( $options as $opt_val => $opt_label ): ?>
			<option value="<?php echo esc_attr( $opt_val ); ?>" <?php selected( $ci[ $fieldname ], $opt_val ); ?>><?php echo $opt_label; ?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

function ci_panel_terms_checklist( $fieldname, $taxonomy, $label ) {
	global $ci;
	?>
	<label for="ul-<?php echo esc_attr( $fieldname ); ?>"><?php echo $label; ?></label>
	<ul id="ul-<?php echo esc_attr( $fieldname ); ?>" class="terms_checklist">
		<?php
			$cats = $ci[ $fieldname ];

			// Compatibility for old style category input boxes, where categories
			// where inputed by their IDs, separated by comma.
			if ( ! is_array( $cats ) and is_string( $cats ) and ! empty( $cats ) ) {
				$cats = explode( $cats, ',' );
			}

			wp_terms_checklist( 0, array(
				'selected_cats' => $cats,
				'checked_ontop' => false,
				'taxonomy'      => $taxonomy,
				'walker'        => new CI_Panel_Walker_Category_Checklist( THEME_OPTIONS . '[' . $fieldname . ']' ),
			) );
		?>
	</ul>
	<?php
}


//
// Walkers
//
/**
 * Walker to output an unordered list of category checkbox input elements.
 * This is almost identical to Walker_Category_Checklist, however it allows
 * the name to be configured for the checkboxes.
 *
 * @since 2.5.1
 *
 * @see Walker
 * @see wp_category_checklist()
 * @see wp_terms_checklist()
 */
class CI_Panel_Walker_Category_Checklist extends Walker {

	public $field_name = ''; // This will be used as base for the HTML name="" attributes.
	public $tree_type = 'category';
	public $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' ); //TODO: decouple this

	function __construct( $field_name = 'selected_categories' ) {
		$this->field_name = $field_name;
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker:start_lvl()
	 *
	 * @since 2.5.1
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of category. Used for tab indentation.
	 * @param array  $args   An array of arguments. @see wp_terms_checklist()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 2.5.1
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of category. Used for tab indentation.
	 * @param array  $args   An array of arguments. @see wp_terms_checklist()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 2.5.1
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category The current term object.
	 * @param int    $depth    Depth of the term in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_terms_checklist()
	 * @param int    $id       ID of the current term.
	 */
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		if ( empty( $args['taxonomy'] ) ) {
			$taxonomy = 'category';
		} else {
			$taxonomy = $args['taxonomy'];
		}

		$name   = $this->field_name;
		$prefix = sanitize_html_class( $name );

		$args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats'];
		$class = in_array( $category->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : '';

		$args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats'];

		/** This filter is documented in wp-includes/category-template.php */
		$output .= "\n<li id='{$prefix}-{$taxonomy}-{$category->term_id}'$class>" .
			'<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="'.$name.'[]" id="in-'.$prefix.'-'.$taxonomy.'-' . $category->term_id . '"' .
			checked( in_array( $category->term_id, $args['selected_cats'] ), true, false ) .
			disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
			esc_html( apply_filters( 'the_category', $category->name ) ) . '</label>';
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 2.5.1
	 *
	 * @param string $output   Passed by reference. Used to append additional content.
	 * @param object $category The current term object.
	 * @param int    $depth    Depth of the term in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_terms_checklist()
	 */
	public function end_el( &$output, $category, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}
