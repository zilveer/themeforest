<?php
/**
 * This file is part of the array_column library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2013 Ben Ramsey <http://benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

if (!function_exists('array_column')) {

    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error('array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
            return null;
        }

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }

        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }

        $resultArray = array();

        foreach ($paramsInput as $row) {

            $key = $value = null;
            $keySet = $valueSet = false;

            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }

            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }

            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }

        }

        return $resultArray;
    }

}
/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', 'astro'),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'astro'),
		'icon' => 'paper-clip',
		'icon_class' => 'icon-large',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
add_filter('redux-opts-sections-redux-sample', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-redux-sample-file', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options(){
    $args = array();


    // For use with a tab below
		$tabs = array();

		ob_start();

		$ct = wp_get_theme();
        $theme_data = $ct;
        $item_name = $theme_data->get('Name'); 
		$tags = $ct->Tags;
		$screenshot = $ct->get_screenshot();
		$class = $screenshot ? 'has-screenshot' : '';

		$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','astro' ), $ct->display('Name') );

		?>
		<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
			<?php if ( $screenshot ) : ?>
				<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
				<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
					<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				</a>
				<?php endif; ?>
				<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
			<?php endif; ?>

			<h4>
				<?php echo $ct->display('Name'); ?>
			</h4>

			<div>
				<ul class="theme-info">
					<li><?php printf( __('By %s','astro'), $ct->display('Author') ); ?></li>
					<li><?php printf( __('Version %s','astro'), $ct->display('Version') ); ?></li>
					<li><?php echo '<strong>'.__('Tags', 'astro').':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
				</ul>
				<p class="theme-description"><?php echo $ct->display('Description'); ?></p>
				<?php if ( $ct->parent() ) {
					printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','astro' ) . '</p>',
						__( 'http://codex.wordpress.org/Child_Themes','astro' ),
						$ct->parent()->display( 'Name' ) );
				} ?>
				
			</div>

		</div>

		<?php
		$item_info = ob_get_contents();
		    
		ob_end_clean();


	if( file_exists( dirname(__FILE__).'/info-html.html' )) {
		global $wp_filesystem;
		if (empty($wp_filesystem)) {
			require_once(ABSPATH .'/wp-admin/includes/file.php');
			WP_Filesystem();
		}  		
		$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
	}


    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
    $args['dev_mode_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'prk_astro_options';

    // Setting system info to true allows you to view info useful for debugging.
    // Default: false
    //$args['system_info'] = true;

    
	// Set the icon for the system info tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['system_info_icon'] = 'info-sign';

	// Set the class for the system info tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['system_info_icon_class'] = 'icon-large';

	$theme = wp_get_theme();

	$args['display_name'] = $theme->get('Name').__(" Control Panel","astro_lang");
	//$args['database'] = "theme_mods_expanded";
	$args['display_version'] = $theme->get('Version');

    // If you want to use Google Webfonts, you MUST define the api key.
    $args['google_api_key'] = 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Setup custom links in the footer for share icons
    /*$args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/ghost1227',
        'title' => 'Follow me on Twitter', 
        'img' => ReduxFramework::$_url . 'assets/img/social/Twitter.png'
    );
    $args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
        'title' => 'Find me on LinkedIn', 
        'img' => ReduxFramework::$_url . 'assets/img/social/LinkedIn.png'
    );*/

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom menu icon.
    if ( get_bloginfo('version')>='3.8' ) 
    {
        $args['menu_icon'] = '';
    }

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = $theme->get('Name').__(' Options', 'astro');

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Options', 'astro');

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    $args['default_show'] = true;
    $args['default_mark'] = '*';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options_general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', 'astro'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'astro')
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', 'astro'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'astro')
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'astro');


    // Add HTML before the form.
    if (!isset($args['global_variable']) || $args['global_variable'] !== false ) {
    	if (!empty($args['global_variable'])) {
    		$v = $args['global_variable'];
    	} else {
    		$v = str_replace("-", "_", $args['opt_name']);
    	}
    	//$args['intro_text'] = __('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$'.$v.'</strong></p>', 'astro');
    } else {
    	$args['intro_text'] = __('', 'astro');
    }

    // Add content after the form.
    $args['footer_text'] = __('', 'astro');


    $sections = array();              
    //Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir  . '../../../images/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url  . '../../../images/patterns/';
    $sample_patterns      = array();
    if ( is_dir( $sample_patterns_path ) ) :
      if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
      	$sample_patterns = array();
      	$sample_patterns[] = array( 'alt'=>'none','img' => $sample_patterns_url .'empty/prk_no_pattern.jpg' );

        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

          if( (stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false) &&  stristr( $sample_patterns_file, '_@2X')===false) {
          	$name = explode(".", $sample_patterns_file);
          	$name = str_replace('.'.end($name), '', $sample_patterns_file);
          	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
          }
        }
      endif;
    endif;

    global $select_font_options;
    $a = array_column($select_font_options, 'value');
    $b = array_column($select_font_options, 'label');
    $fonts_array=array_combine($a, $b);
    $prk_font_options = get_option('prk_font_plugin_option');
    if (is_array($prk_font_options)) {
    	foreach ($prk_font_options as $font) 
    	{
    		if ($font['erased']=="false" && !array_key_exists($font['value'],$fonts_array)) 
    		{
    			$fonts_array[$font['value']] = $font['label'];
            }
    	}
    }
    $sections[] = array(
		'icon' => 'el-icon-cogs',
		'icon_class' => 'icon-large',
        'title' => __('General', 'astro'),
		'fields' => array(
			array(
				'id'=>'prk_responsive',
				'type' => 'switch', 
				'title' => __('Make the theme layout responsive?', 'astro'),
				'subtitle'=> __('Make theme adjust to smaller screens.', 'astro'),
				"default" 		=> 1,
			),
            array(
                'id'=>'prk_detect_retina',
                'type' => 'switch', 
                'title' => __('Detect and serve better images on retina screens?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
			array(
				'id'=>'custom_width',
				'type' => 'text',
				'title' => __('Maximum content width', 'astro'),
				'subtitle' => __('Numeric values only.', 'astro'),
				'desc' => __('How much the center content will stretch. Not applicable on some pages.', 'astro'),
				'validate' => 'numeric',
				'default' => '1280',
				'class' => 'small-text'
			),
			array(
				'id'=>'ajax_calls',
				'type' => 'switch', 
				'title' => __('Use Ajax calls to load content?', 'astro'),
				'subtitle'=> __('', 'astro'),
				'desc' => __('If on the theme will attempt to load all content using Ajax calls. This will speed up the website page loading process and allow some elements to have smoother transitions.', 'astro'),
				"default" 		=> 1,
				),
            array(
                'id'=>'prk_css_anims',
                'type' => 'switch', 
                'title' => __('Animate some page elements when they are displayed?', 'astro'),
                'subtitle'=> __('Will apply to carousel tslider elements and also single posts blocks of information.', 'astro'),
                'desc' => __('', 'astro'),
                "default"       => 1,
                ),
			array(
				'id'=>'backend_fonts',
				'type' => 'info',
				'desc' => __('Fonts', 'astro')
            ),
            array(
				'id'=>'header_font',
				'type' => 'select',
                'class' => 'prk_hide_default',
				'title' => __('Headings font', 'astro'), 
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'options' => $fonts_array,//Must provide key => value pairs for select options
				'default' => "Exo:400,500,600,700,400italic&subset=latin,latin-ext"
			),
			array(
				'id'=>'body_font',
				'type' => 'select',
				'title' => __('Body font', 'astro'), 
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'options' => $fonts_array,//Must provide key => value pairs for select options
				'default' => "Open+Sans:400italic,600italic,700italic,400,600,700"
			),
			array(
				'id'=>'backend_gn_colors',
				'type' => 'info',
				'desc' => __('Colors: General', 'astro')
            ),
            array(
				'id'=>'pattern',
				'type' => 'image_select', 
				'tiles' => true,
				'title' => __('Background pattern', 'astro'),
				'subtitle'=> __('Select a background pattern.', 'astro'),
                'desc'=> __('To add more place them inside wp-content/themes/astro/images/patterns/', 'fount_lang'),
				'default' 		=> '',
				'options' => $sample_patterns,
			),
            array( 'id'=>'site_background_color', 
            	'type' => 'color', 
            	'title' => __('Site Background Color', 'astro'), 
            	'subtitle' => __('', 'astro'), 
            	'default' => '#FFFFFF', 
            	'validate' => 'color', 
            	'transparent' => false, 
            ),
            array(
				'id'=>'active_color',
				'type' => 'color',
				'title' => __('Active color', 'astro'), 
				'subtitle' => __('Will be applied on mostly on hover effects.', 'astro'),
				'default' => '#e74c3c',
				'validate' => 'color',
				'transparent' => false,
				),
			array(
				'id'=>'bd_headings_color',
				'type' => 'color',
				'title' => __('Headings color', 'astro'), 
				'subtitle' => __('Pick a color for the headings.', 'astro'),
				'default' => '#000000',
				'validate' => 'color',
				'transparent' => false,
				),
			array(
				'id'=>'inactive_color',
				'type' => 'color',
				'title' => __('Text color', 'astro'), 
				'subtitle' => __('Pick a border color for the regular text.', 'astro'),
				'default' => '#666666',
				'validate' => 'color',
				'transparent' => false,
			),
			array( 'id'=>'background_color_btns_blog', 
				'type' => 'color', 
				'title' => __('Thumbnails rollover color - Blog (default value)', 'astro'), 
				'subtitle' => __('Posts with a featured color will override this option', 'astro'), 
				'default' => '#000000', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array(
				'id'=>'custom_opacity',
				'type' => 'slider', 
				'title' => __('Custom Background Opacity - Blog rollover effects', 'astro'),
				'desc'=> __('Min: 0, max: 100', 'astro'),
				"default" 		=> "80",
				"min" 		=> "0",
				"step"		=> "5",
				"max" 		=> "100",
			),
			array( 'id'=>'background_color_btns', 
				'type' => 'color', 
				'title' => __('Thumbnails rollover color - Portfolio (default value)', 'astro'), 
				'subtitle' => __('Posts with a featured color will override this option', 'astro'), 
				'default' => '#000000', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array(
				'id'=>'custom_opacity_folio',
				'type' => 'slider', 
				'title' => __('Custom Background Opacity - Portfolio rollover effects', 'astro'),
				'desc'=> __('Min: 0, max: 100', 'astro'),
				"default" 		=> "80",
				"min" 		=> "0",
				"step"		=> "5",
				"max" 		=> "100",
			),
			array(
				'id'=>'backend_lb_colors',
				'type' => 'info',
				'desc' => __('Colors: Lines and borders', 'astro')
            ),
			array( 
				'id'=>'lines_color', 'type' => 'color', 
				'title' => __('Lines color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#dedede', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array( 
				'id'=>'shadow_color', 'type' => 'color', 
				'title' => __('Shadow color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#000000', 
				'validate' => 'color',
				'transparent' => false, 
			),
			array(
				'id'=>'custom_shadow',
				'type' => 'slider', 
				'title' => __('Shadow Opacity', 'astro'),
				'desc'=> __('Min: 0, max: 100', 'astro'),
				"default" 		=> "20",
				"min" 		=> "0",
				"step"		=> "5",
				"max" 		=> "100",
			),
			array(
				'id'=>'background_color',
				'type' => 'color',
				'title' => __('Textfields background color', 'astro'), 
				'subtitle' => __('', 'astro'),
				'default' => '#f5f5f5',
				'validate' => 'color',
				'transparent' => false,
			),
			array(
				'id'=>'inputs_bordercolor',
				'type' => 'color',
				'title' => __('Textfields border color', 'astro'), 
				'subtitle' => __('', 'astro'),
				'default' => '#e8e8e8',
				'validate' => 'color',
				'transparent' => false,
			),
			array(
				'id'=>'backend_btn_colors',
				'type' => 'info',
				'desc' => __('Colors: Buttons', 'astro')
            ),
            array( 'id'=>'theme_buttons_color', 
            	'type' => 'color', 
            	'title' => __('Buttons background color', 'astro'), 
            	'subtitle' => __('The alternative background color will be the theme current active color', 'astro'), 
            	'default' => '#111111', 
            	'validate' => 'color', 
            	'transparent' => false, 
            ),
            array( 'id'=>'buttons_color', 
            	'type' => 'color', 
            	'title' => __('Slider and navigation buttons background color', 'astro'), 
            	'subtitle' => __('The arrows color will be the current active color', 'astro'), 
            	'default' => '#111111', '
            	validate' => 'color', 
            	'transparent' => false, 
            ),
			array(
				'id'=>'backend_gn_colors_car',
				'type' => 'info',
				'desc' => __('Colors - carousel', 'astro')
            ),
            array(
				'id'=>'carousel_text_color',
				'type' => 'color',
				'title' => __('Carousel text color', 'astro'), 
				'subtitle' => __('', 'astro'),
				'default' => '#ffffff',
				'validate' => 'color',
				'transparent' => false,
				),
            array(
				'id'=>'carousel_background_color',
				'type' => 'color',
				'title' => __('Carousel text blocks background color', 'astro'), 
				'subtitle' => __('', 'astro'),
				'default' => '#000000',
				'validate' => 'color',
				'transparent' => false,
				),
            array(
				'id'=>'carousel_background_opacity',
				'type' => 'slider', 
				'title' => __('Carousel text blocks background opacity', 'astro'),
				'desc'=> __('Min: 0, max: 100', 'astro'),
				"default" 		=> "90",
				"min" 		=> "0",
				"step"		=> "5",
				"max" 		=> "100",
				),
			array(
				'id'=>'carousel_nav_color',
				'type' => 'color',
				'title' => __('Carousel navigation bullets color', 'astro'), 
				'subtitle' => __('', 'astro'),
				'default' => '#000000',
				'validate' => 'color',
				'transparent' => false,
				),
			array(
				'id'=>'backend_gn_colors_oth',
				'type' => 'info',
				'desc' => __('Colors - other', 'astro')
            ),
            array(
                'id'=>'preloader_color',
                'type' => 'color',
                'title' => __('Preloader color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'default' => '#000000',
                'validate' => 'color',
                'transparent' => false,
                ),
            array(
                'id'=>'tips_text_color',
                'type' => 'color',
                'title' => __('Tooltips text color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'default' => '#ffffff',
                'validate' => 'color',
                'transparent' => false,
                ),
            array(
                'id'=>'tips_background_color',
                'type' => 'color',
                'title' => __('Tooltips background color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'default' => '#000000',
                'validate' => 'color',
                'transparent' => false,
                ),
            array(
                'id'=>'tips_background_opacity',
                'type' => 'slider', 
                'title' => __('Tooltips background opacity', 'astro'),
                'desc'=> __('Min: 0, max: 100', 'astro'),
                "default"       => "100",
                "min"       => "0",
                "step"      => "5",
                "max"       => "100",
                ),
            array(
				'id'=>'backend_sdb_carousel',
				'type' => 'info',
				'desc' => __('Sidebars', 'astro')
            ),
            array(
                'id'=>'bottom_sidebar',
                'type' => 'switch', 
                'title' => __('Display menu sidebar?', 'astro'),
                'subtitle'=> __('Will be shown under the menu when the bar is opened', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'right_sidebar',
                'type' => 'switch', 
                'title' => __('Display right sidebar by default?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
		)
	);

	$sections[] = array(
		'icon' => 'el-icon-star',
		'icon_class' => 'icon-large',
        'title' => __('Logo Bar', 'astro'),
		'fields' => array(
            array(
                'id'=>'logo_bar_position',
                'type' => 'select',
                'title' => __('Logo bar and navigation position?', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'options' => array('astro_nav_left' => 'Left','astro_nav_right' => 'Right'),
                'default' => 'astro_nav_left'
            ), 
            array(
                'id'=>'logo_bar_width',
                'type' => 'text',
                'title' => __('Logo Bar width', 'astro'), 
                'subtitle' => __('In pixels.', 'astro'),
                'desc' => __('Default value is 104.', 'astro'),
                'validate' => 'numeric',
                'default' => '104',
                'class' => 'small-text'
                ),
            array(
                'id'=>'show_on_hover',
                'type' => 'switch', 
                'title' => __('Open the menu when mouse is over?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 0,
            ),
            array(
                'id'=>'color_header',
                'type' => 'color',
                'title' => __('Logo Bar Text Color', 'astro'), 
                'subtitle' => __('Pick a color for the logo bar text.', 'astro'),
                'default' => '#FFFFFF',
                'validate' => 'color',
                'transparent' => false,
                ),
			array(
				'id'=>'background_color_header',
				'type' => 'color',
				'title' => __('Logo Bar Background Color', 'astro'), 
				'subtitle' => __('Pick a background color for the logo bar.', 'astro'),
				'default' => '#000000',
				'validate' => 'color',
				'transparent' => false,
				),
            array(
                'id'=>'menu_image',
                'type' => 'media', 
                'title' => __('Menu button image', 'astro'),
                'compiler' => 'true',
                'default'=> array(
                    'url'=>'', 
                    'id'=>'', 
                    'width'=>'', 
                    'height'=>'',
                ),  
                'desc'=> __('If blank three stripes will be shown.', 'astro'),
                'subtitle' => __('', 'astro'),
                ),
			array(
				'id'=>'footer_text',
				'type' => 'textarea',
				'title' => __('Tiny footer text', 'astro'), 
				'subtitle' => __('Space is limited so use very few text.', 'astro'),
				'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
				'default' => 'Astro for <br>Wordpress'
				),
            array( 
                'id'=>'custom_home', 
                'type' => 'text', 
                'title' => __('Custom logo link', 'astro'), 
                'subtitle' => __('Useful only if you are using a landing page.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => '', 
            ),
            array(
                'id'=>'backend_lb_colors_white',
                'type' => 'info',
                'desc' => __('Logo Bar: Images', 'astro')
            ),
			array(
				'id'=>'logo',
				'type' => 'media', 
				'title' => __('Logo', 'astro'),
				'compiler' => 'true',
				'default'=> array(
					'url'=>get_template_directory_uri().'/images/logo.png', 
					'id'=>'', 
					'width'=>'', 
					'height'=>'',
				),	
				'desc'=> __('', 'astro'),
				'subtitle' => __('Normal screens.', 'astro'),
				),
			array(
				'id'=>'logo_retina',
				'type' => 'media', 
				'title' => __('Logo', 'astro'),
				'compiler' => 'true',
				'default'=> array(
					'url'=>get_template_directory_uri().'/images/logo-retina.png', 
					'id'=>'', 
					'width'=>'', 
					'height'=>'',
				),	
				'desc'=> __('If used should be the double size of the original logo image.', 'astro'),
				'subtitle' => __('Retina screens.', 'astro'),
			),
            array(
                'id'=>'small_logo',
                'type' => 'media', 
                'title' => __('Logo image - collapsed top bar (optional)', 'astro'),
                'compiler' => 'true',
                'default'=> array(
                    'url'=>get_template_directory_uri().'/images/alt_logo.png', 
                    'id'=>'', 
                    'width'=>'', 
                    'height'=>'',
                ),  
                'desc'=> __('Smaller logo for collapsed top bar. The recommended height is 40px.', 'astro'),
                'subtitle' => __('Normal screens.', 'astro'),
                ),
            array(
                'id'=>'small_logo_retina',
                'type' => 'media', 
                'title' => __('Logo image - Collapsed top bar on retina displays (optional)', 'astro'),
                'compiler' => 'true',
                'default'=> array(
                    'url'=>get_template_directory_uri().'/images/alt_logo-retina.png', 
                    'id'=>'', 
                    'width'=>'', 
                    'height'=>'',
                ),  
                'desc'=> __('If used should be the double size of the original logo image.', 'astro'),
                'subtitle' => __('Retina screens.', 'astro'),
            ),
			array( 'id'=>'menu_vertical', 
				'type' => 'text', 
				'title' => __('Logo vertical margin (in pixels)', 'astro'), 
				'subtitle' => __('You can move the logo up or down by changing this value.', 'astro'), 
				'desc' => __('', 'astro'), 
				'validate' => 'numeric', 
				'default' => '20', 
				'class' => 'small-text' 
			),
            array(
                'id'=>'favicon',
                'type' => 'media', 
                'title' => __('Favicon image', 'astro'),
                'compiler' => 'true',
                'default'=> array(
                    'url'=>get_template_directory_uri().'/images/favicon.ico', 
                    'id'=>'', 
                    'width'=>'', 
                    'height'=>'',
                ),  
                'desc'=> __('Should have .ico as file extension.', 'astro'),
                'subtitle' => __('', 'astro'),
            ),
		)
	);

	$sections[] = array(
		'icon' => 'el-icon-list',
		'icon_class' => 'icon-large',
        'title' => __('Menu Bar', 'astro'),
		'fields' => array(
            array(
                'id'=>'always_menu',
                'type' => 'switch', 
                'title' => __('Keep menu opened on larger screens?', 'astro'),
                'subtitle'=> __('The menu will still be closed on single fullscreen portfolio pages.', 'astro'),
                "default"       => 0,
            ),
			array(
				'id'=>'menu_width',
				'type' => 'text',
				'title' => __('Menu width', 'astro'),
				'subtitle' => __('In pixels.', 'astro'),
				'desc' => __('', 'astro'),
				'validate' => 'numeric',
				'default' => '220',
				'class' => 'small-text'
				),
			array( 'id'=>'menu_up_color', 
				'type' => 'color', 
				'title' => __('Menu text color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#000000', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array( 'id'=>'menu_active_color', 
				'type' => 'color', 
				'title' => __('Menu active text color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#6d6d6d', 
				'validate' => 'color',
				'transparent' => false,
			),
            array(
                'id'=>'menu_active_bk_color',
                'type' => 'color',
                'title' => __('Menu active background color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'default' => '#efefef',
                'validate' => 'color',
                'transparent' => false,
                ),
			array(
				'id'=>'background_color_menu',
				'type' => 'color',
				'title' => __('Menu Background Color', 'astro'), 
				'subtitle' => __('Pick a background color for the menu bar.', 'astro'),
				'default' => '#FFFFFF',
				'validate' => 'color',
				'transparent' => false,
				),
			array(
				'id'=>'menu_lines_color',
				'type' => 'color',
				'title' => __('Menu Buttons Border Color', 'astro'), 
				'subtitle' => __('Pick a border color for the main menu.', 'astro'),
				'default' => '#f0f0f0',
				'validate' => 'color',
				'transparent' => false,
				),
			array( 'id'=>'submenu_back_button_color', 
				'type' => 'color', 
				'title' => __('Submenu back button text color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#000000', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array(
				'id'=>'background_color_back_button',
				'type' => 'color',
				'title' => __('Sub-menu back button background bolor', 'astro'), 
				'subtitle' => __('Pick a background color for the sub-menus.', 'astro'),
				'default' => '#f0f0f0',
				'validate' => 'color',
				'transparent' => false,
				),
		)
	);

	$sections[] = array(
		'icon' => 'el-icon-dashboard',
		'icon_class' => 'icon-large',
        'title' => __('Menu sidebar', 'astro'),
		'fields' => array(
			array( 'id'=>'titles_color_footer', 
				'type' => 'color', 
				'title' => __('Menu sidebar titles color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#111111', 
				'validate' => 'color', 
				'transparent' => false, 
			),
			array( 'id'=>'body_color_footer', 
				'type' => 'color', 
				'title' => __('Menu sidebar body color', 'astro'), 
				'subtitle' => __('', 'astro'), 
				'default' => '#8F8F8F', 
				'validate' => 'color', 
				'transparent' => false, 
			),
		)
	);

	$sections[] = array(
		'icon' => 'el-icon-calendar',
		'icon_class' => 'icon-large',
        'title' => __('Blog', 'astro'),
		'fields' => array(
            array(
                'id'=>'archives_type',
                'type' => 'select',
                'title' => __('Blog archives page template?', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'options' => array('grid' => 'Grid','classic' => 'Classic'),//Must provide key => value pairs for select options
                'default' => 'grid'
            ), 
            array(
                'id'=>'autoplay_blog',
                'type' => 'switch', 
                'title' => __('Play slideshow on single posts?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ), 
            array( 'id'=>'delay_blog', 
                'type' => 'text', 
                'title' => __('Slideshow delay in miliseconds', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'validate' => 'numeric', 
                'default' => '6500', 
                'class' => 'small-text' 
            ),
            array(
                'id'=>'postedby_blog',
                'type' => 'switch', 
                'title' => __('Show "Posted by" text on blog?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'categoriesby_blog',
                'type' => 'switch', 
                'title' => __('Show post categories text on blog?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'show_heart_blog',
                'type' => 'switch', 
                'title' => __('Show heart/like button on single pages?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
			array(
				'id'=>'related_blog',
				'type' => 'switch', 
				'title' => __('Show previous and next posts link?', 'astro'),
				'subtitle'=> __('Will be shown under the post content.', 'astro'),
				"default" 		=> 1,
			),
            array(
                'id'=>'related_author',
                'type' => 'switch', 
                'title' => __('Show author info under post?', 'astro'),
                'subtitle'=> __('Will be shown under the post content.', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'backend_bl_sharing',
                'type' => 'info',
                'desc' => __('Social Sharing', 'astro')
            ),
            array(
                'id'=>'share_blog',
                'type' => 'switch', 
                'title' => __('Show sharing buttons?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'share_blog_del',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('Delicious', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_blog_fb',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('Facebook', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
            array(
                'id'=>'share_blog_goo',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('Google +', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_blog_lnk',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('LinkedIn', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_blog_pin',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('Pinterest', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
            array(
                'id'=>'share_blog_stu',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('StumbleUpon', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_blog_twt',
                'type' => 'checkbox',
                'required' => array('share_blog','equals','1'), 
                'title' => __('Twitter', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
		)
	);

	$sections[] = array(
		'icon' => 'el-icon-camera',
		'icon_class' => 'icon-large',
        'title' => __('Portfolio', 'astro'),
		'fields' => array(
            array(
                'id'=>'archives_ptype',
                'type' => 'select',
                'title' => __('Portfolio archives page template?', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'options' => array('carousel' => 'Carousel','grid' => 'Grid','masonry' => 'Masonry'),//Must provide key => value pairs for select options
                'default' => 'grid'
            ), 
            array(
                'id'=>'portfolio_layout',
                'type' => 'select',
                'title' => __('Default single posts layout', 'astro'), 
                'subtitle' => __('Can be overriden individually for each post', 'astro'),
                'desc' => __('', 'astro'),
                'options' => array('fullscreen' => 'Fullscreen','no_cropping' => 'Fullscreen without image crop','classic' => 'Classic layout','half' => 'Half layout'),//Must provide key => value pairs for select options
                'default' => array('fullscreen' => 'Fullscreen')
                ),
            array(
                'id'=>'auto_panel_portfolio',
                'type' => 'switch', 
                'title' => __('Show info panel automatically?', 'astro'),
                'subtitle'=> __('Applicable only for posts with Fullscreen layout', 'astro'),
                "default"       => 0,
            ),
            array(
                'id'=>'autoplay_portfolio',
                'type' => 'switch', 
                'title' => __('Play slideshow on single posts?', 'astro'),
                'subtitle'=> __('Applicable only for posts with Classic layout', 'astro'),
                "default"       => 1,
            ), 
            array( 'id'=>'delay_portfolio', 
                'type' => 'text', 
                'title' => __('Slideshow delay in miliseconds', 'astro'), 
                'subtitle' => __('Applicable only for posts with Classic layout', 'astro'), 
                'desc' => __('', 'astro'), 
                'validate' => 'numeric', 
                'default' => '6500', 
                'class' => 'small-text' 
            ),
            array( 'id'=>'folio_arrows', 
                'type' => 'switch', 
                'title' => __('Add navigation arrows on single fullscreen posts?', 'astro'), 
                'subtitle' => __('Will also slide the main element so that the next image is displayed partially', 'astro'), 
                'desc' => __('', 'astro'), 
                "default"       => 0,
            ),
			array(
				'id'=>'dateby_port',
				'type' => 'switch', 
				'title' => __('Show date on single post entries?', 'astro'),
				'subtitle'=> __('', 'astro'),
				"default" 		=> 1,
			),
			array(
				'id'=>'categoriesby_port',
				'type' => 'switch', 
				'title' => __('Show skills on single post entries?', 'astro'),
				'subtitle'=> __('', 'astro'),
				"default" 		=> 1,
			),
			array(
				'id'=>'show_heart_folio',
				'type' => 'switch', 
				'title' => __('Show heart/like button?', 'astro'),
				'subtitle'=> __('', 'astro'),
				"default" 		=> 1,
			),
            array(
                'id'=>'backend_gn_colors_fldescs',
                'type' => 'info',
                'desc' => __('Portfolio: Image Descriptions', 'astro')
            ),
            array(
                'id'=>'show_folio_descs',
                'type' => 'switch', 
                'title' => __('Show portfolio image descriptions ons single post entries?', 'astro'),
                'subtitle'=> __('Applies only to Fullscreen layout posts', 'astro'),
                "default"       => 0,
            ),
            array(
                'id'=>'folio_descs_bk_color',
                'type' => 'color',
                'required' => array('show_folio_descs','equals','1'), 
                'title' => __('Image descriptions background color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '#000000',
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'=>'folio_descs_bk_opacity',
                'type' => 'slider', 
                'title' => __('Image descriptions background opacity', 'astro'),
                'desc'=> __('Min: 0, max: 100', 'astro'),
                "default"       => "70",
                "min"       => "0",
                "step"      => "1",
                "max"       => "100",
                'required' => array('show_folio_descs','equals','1'), 
            ),
            array(
                'id'=>'folio_descs_color',
                'type' => 'color',
                'required' => array('show_folio_descs','equals','1'), 
                'title' => __('Image descriptions text color', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '#ffffff',
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'=>'folio_descs_align',
                'type' => 'select',
                'title' => __('Image descriptions text alignment', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'options' => array(
                    'astro_left' => 'Left',
                    'astro_center' => 'Centered',
                    'astro_right' => 'Right'
                ),//Must provide key => value pairs for select options
                'default' => 'astro_right',
                'required' => array('show_folio_descs','equals','1'), 
            ),
            array(
                'id'=>'backend_gn_colors_flsh',
                'type' => 'info',
                'desc' => __('Portfolio: Sharing', 'astro')
            ),
            array(
                'id'=>'share_portfolio',
                'type' => 'switch', 
                'title' => __('Show sharing buttons?', 'astro'),
                'subtitle'=> __('', 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'share_portfolio_del',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('Delicious', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_portfolio_fb',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('Facebook', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
            array(
                'id'=>'share_portfolio_goo',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('Google +', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_portfolio_lnk',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('LinkedIn', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_portfolio_pin',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('Pinterest', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
            array(
                'id'=>'share_portfolio_stu',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('StumbleUpon', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '0'
            ),
            array(
                'id'=>'share_portfolio_twt',
                'type' => 'checkbox',
                'required' => array('share_portfolio','equals','1'), 
                'title' => __('Twitter', 'astro'), 
                'subtitle' => __('', 'astro'),
                'desc' => __('', 'astro'),
                'default' => '1'
            ),
		)
	);

    $sections[] = array(
        'icon' => 'el-icon-envelope',
        'icon_class' => 'icon-large',
        'title' => __('Contact Page', 'astro'),
        'fields' => array(
            array( 
                'id'=>'google_maps_key', 
                'type' => 'text', 
                'title' => __('Google API Key', 'astro'), 
                'subtitle' => __('More info here https://developers.google.com/maps/pricing-and-plans/standard-plan-2016-update', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => '', 
                'class' => '' 
            ),
        )
    );

	$sections[] = array(
		'icon' => 'el-icon-comment',
		'icon_class' => 'icon-large',
        'title' => __('Translations', 'astro'),
		'fields' => array(
            array(
                'id'=>'theme_translation',
                'type' => 'switch', 
                'title' => __('Translate using .mo/.po files?', 'astro'),
                'subtitle'=> __('If yes is selected the values below will be ignored. If WPML plugin is active the values below will be overriden too.', 'astro'),
                "default"       => 0,
            ),
			array(
				'id'=>'backend_tr_general',
				'type' => 'info',
				'desc' => __('General', 'astro')
            ),
            array( 
                'id'=>'menu_back_text', 
                'type' => 'text', 
                'title' => __('Menu back text', 'astro'), 
                'subtitle' => __('Will be used on the button that closes sub-menus.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'BACK', 
            ),
            array( 
                'id'=>'search_tip_text', 
                'type' => 'text', 
                'title' => __('Search field tip text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Search this website...', 
            ),
            array( 
                'id'=>'submit_search_res_title', 
                'type' => 'text', 
                'title' => __('Search results page title text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Search Results for', 
            ),
            array( 
                'id'=>'submit_search_no_results', 
                'type' => 'text', 
                'title' => __('Search results - no results found text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'No Results Found', 
            ),
            array( 
                'id'=>'load_more', 
                'type' => 'text', 
                'title' => __('Load more posts text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'LOAD MORE POSTS', 
            ),
            array( 
                'id'=>'no_more_text', 
                'type' => 'text', 
                'title' => __('No more entries to show text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'NO MORE POSTS TO SHOW', 
            ),
            array( 
                'id'=>'required_text', 
                'type' => 'text', 
                'title' => __('Required text', 'astro'), 
                'subtitle' => __('Used on mandatory fields.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => ' (required)', 
            ),
            array(
                'id'=>'profile_text',
                'type' => 'text',
                'title' => __('Members view profile link text', 'astro'),
                'subtitle' => __('Shown under each member image and description', 'astro'),
                'desc' => __('', 'astro'),
                'default' => 'VIEW PROFILE'
            ),
            array( 
                'id'=>'in_touch_text', 
                'type' => 'text', 
                'title' => __('Get in touch text', 'astro'), 
                'subtitle' => __('Used near team member social network buttons.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Get In touch', 
            ),
            array(
				'id'=>'likes_text',
				'type' => 'text',
				'title' => __('Likes text', 'astro'),
				'subtitle' => __('Shown near the heart icon', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'likes'
			),
            array(
				'id'=>'like_text',
				'type' => 'text',
				'title' => __('Like post text', 'astro'),
				'subtitle' => __('Shown on the heart tooltip', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'I like this!'
			),
			array(
				'id'=>'already_liked_text',
				'type' => 'text',
				'title' => __('Already liked post text', 'astro'),
				'subtitle' => __('Shown on the heart tooltip', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'You already liked this.'
			),
            array(
                'id'=>'backend_tr_error_page',
                'type' => 'info',
                'desc' => __('404 Error Page', 'astro')
            ),
            array( 
                'id'=>'404_title_text', 
                'type' => 'text', 
                'title' => __('Page title text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Page not found', 
                ),
            array(
                'id'=>'404_body_text',
                'type' => 'textarea',
                'title' => __('Page body text', 'astro'), 
                'subtitle' => __('', 'astro'),
                'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                'default' => 'We do not know how you ended up here, but please could you try again by selecting an option on the menu?'
            ),
            array(
                'id'=>'backend_tr_blog',
                'type' => 'info',
                'desc' => __('Blog', 'astro')
            ),
            array( 
                'id'=>'to_blog', 
                'type' => 'text', 
                'title' => __('Back to Blog button text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'To Blog', 
            ),
            array( 
                'id'=>'read_more', 
                'type' => 'text', 
                'title' => __('Read more button text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Read More', 
            ),
            array( 
                'id'=>'sticky_text', 
                'type' => 'text', 
                'title' => __('Sticky post text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Sticky Post', 
            ),
            array( 
                'id'=>'posted_by_text', 
                'type' => 'text', 
                'title' => __('Posted by text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'by', 
            ),
            array( 
                'id'=>'share_text_blog', 
                'type' => 'text', 
                'title' => __('Share text', 'astro'), 
                'subtitle' => __('Used near social network sharing buttons.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Share', 
            ),
            array( 
                'id'=>'about_author_text', 
                'type' => 'text', 
                'title' => __('About text', 'astro'), 
                'subtitle' => __('Displayed before post author name.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'About', 
            ),
            array( 
                'id'=>'older', 
                'type' => 'text', 
                'title' => __('Older posts text', 'astro'), 
                'subtitle' => __('Used for navigation on blog pages.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Older posts', 
            ),
            array( 
                'id'=>'newer', 
                'type' => 'text', 
                'title' => __('Newer posts text', 'astro'), 
                'subtitle' => __('Used for navigation on blog pages.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Newer posts', 
            ),
			array(
				'id'=>'backend_tr_portfolio',
				'type' => 'info',
				'desc' => __('Portfolio', 'astro')
            ),
			array(
				'id'=>'date_text',
				'type' => 'text',
				'title' => __('Date text', 'astro'),
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Date'
			),
			array(
				'id'=>'client_text',
				'type' => 'text',
				'title' => __('Client description text', 'astro'),
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Client'
			),
			array(
				'id'=>'skills_text',
				'type' => 'text',
				'title' => __('Category description text', 'astro'),
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Skills'
			),
			array(
				'id'=>'tags_text',
				'type' => 'text',
				'title' => __('Tag description text', 'astro'),
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Tags'
			),
			array(
				'id'=>'prj_desc_text',
				'type' => 'text',
				'title' => __('Project description text', 'astro'),
				'subtitle' => __('Will be displayed just above the project text.', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Project description'
			),
			array(
				'id'=>'launch_text',
				'type' => 'text',
				'title' => __('Project link button text', 'astro'),
				'subtitle' => __('', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'LAUNCH PROJECT'
			),
			array(
				'id'=>'to_portfolio',
				'type' => 'text',
				'title' => __('Back to Portfolio button text', 'astro'),
				'subtitle' => __('Will be used on tooltips.', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'To Portfolio'
			),
			array(
				'id'=>'prj_info_text',
				'type' => 'text',
				'title' => __('Project information text', 'astro'),
				'subtitle' => __('Will be used on tooltips.', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Project Info'
			),
            array(
                'id'=>'prj_close_info_text',
                'type' => 'text',
                'title' => __('Close project information text', 'astro'),
                'subtitle' => __('Will be used on tooltips.', 'astro'),
                'desc' => __('', 'astro'),
                'default' => 'Close'
            ),
			array(
				'id'=>'next_text',
				'type' => 'text',
				'title' => __('Next image text', 'astro'),
				'subtitle' => __('Will be used on tooltips.', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Next'
			),
			array(
				'id'=>'previous_text',
				'type' => 'text',
				'title' => __('Previous image text', 'astro'),
				'subtitle' => __('Will be used on tooltips.', 'astro'),
				'desc' => __('', 'astro'),
				'default' => 'Previous'
			),
			array(
				'id'=>'of_text',
				'type' => 'text',
				'title' => __('Of text', 'astro'),
				'subtitle' => __('Will be used on the lower navigation info.', 'astro'),
				'desc' => __('Example: 1 of 3', 'astro'),
				'default' => 'of'
			),
            array( 
                'id'=>'share_text_folio', 
                'type' => 'text', 
                'title' => __('Share text', 'astro'), 
                'subtitle' => __('Used near social network sharing buttons.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'SHARE', 
            ),
            array( 
                'id'=>'all_text', 
                'type' => 'text', 
                'title' => __('All text', 'astro'), 
                'subtitle' => __('Used on filters. Will show all posts on current page.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'All', 
            ),
            array(
                'id'=>'backend_tr_comments',
                'type' => 'info',
                'desc' => __('Comments Section', 'astro')
            ),
            array( 
                'id'=>'comments_label', 'type' => 'text', 
                'title' => __('Comments title text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Comments', 
            ),
            array( 
                'id'=>'comments_no_response', 
                'type' => 'text', 
                'title' => __('Zero comments text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'No comments', 
            ),
            array( 
                'id'=>'comments_one_response', 
                'type' => 'text', 
                'title' => __('One comment text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => '1 Comment', 
            ),
            array( 
                'id'=>'comments_oneplus_response', 
                'type' => 'text', 
                'title' => __('Multiple comments text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Comments', 
            ),
			array(
                'id'=>'backend_tr_respond',
                'type' => 'info',
                'desc' => __('Respond Section', 'astro')
            ),
            array( 
                'id'=>'reply_text', 
                'type' => 'text', 
                'title' => __('Reply text', 'astro'), 
                'subtitle' => __('Used on buttons.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Reply', 
            ),
            array( 
                'id'=>'comments_leave_reply', 
                'type' => 'text', 
                'title' => __('Text to ask the user to leave a reply', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Leave a Comment', 
            ),
            array( 
                'id'=>'comments_author_text', 
                'type' => 'text', 
                'title' => __('Name input field text', 'astro'), 
                'subtitle' => __('This text will be displayed inside the author input textfield.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Name', 
            ),
            array( 
                'id'=>'comments_email_text', 
                'type' => 'text', 
                'title' => __('Email input field text', 'astro'), 
                'subtitle' => __('This text will be displayed inside the email input textfield.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Email', 
            ),
            array( 
                'id'=>'comments_url_text', 
                'type' => 'text', 
                'title' => __('URL input field text', 'astro'), 
                'subtitle' => __('This text will be displayed inside the URL input textfield.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Website', 
            ),
            array( 
                'id'=>'comments_comment_text', 
                'type' => 'text', 
                'title' => __('Comment input textarea text', 'astro'), 
                'subtitle' => __('This text will be displayed inside the comment input textarea.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Your comment', 
            ),
            array( 
                'id'=>'comments_submit', 
                'type' => 'text', 
                'title' => __('Submit comment button text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Submit Comment', 
            ),
            array( 
                'id'=>'empty_text_error', 
                'type' => 'text', 
                'title' => __('Empty text error message', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Error! This field is required.', 
            ),
            array( 
                'id'=>'invalid_email_error', 
                'type' => 'text', 
                'title' => __('Invalid email error message', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Error! Invalid email.', 
            ),
            array( 'id'=>'comment_ok_message', 
                'type' => 'text', 
                'title' => __('Comment submitted text', 'astro'), 
                'subtitle' => __('This text is displayed after the comment is submitted.', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Thank you for your feedback!', 
            ),
            array(
                'id'=>'backend_tr_respond',
                'type' => 'info',
                'desc' => __('Contact Page', 'astro')
            ),
            array( 
                'id'=>'contact-info_tel_h', 
                'type' => 'text', 
                'title' => __('Telephone text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Telephone', 
            ),
            array( 
                'id'=>'contact-info_fax_h', 
                'type' => 'text', 
                'title' => __('Fax text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Fax', 
            ),
            array( 
                'id'=>'contact-info_email_h', 
                'type' => 'text', 
                'title' => __('Email text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Email', 
            ),
            array( 
                'id'=>'contact_subject_text', 
                'type' => 'text', 
                'title' => __('Subject help text', 'astro'), 
                'subtitle' => __('This text will be displayed inside of the subject input textfield. The name and email fields are the same as defined before for the comments section.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Subject', 
            ),
            array( 
                'id'=>'contact_message_text', 
                'type' => 'text', 'title' => __('Message help text', 'astro'), 
                'subtitle' => __('This text will be displayed inside of the message input textfield.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Your message', 
            ),
            array( 
                'id'=>'contact_submit', 
                'type' => 'text', 'title' => __('Submit button text', 'astro'), 
                'subtitle' => __('', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Send Message', 
            ),
            array( 
                'id'=>'contact_error_text', 
                'type' => 'text', 
                'title' => __('Error message for empty field', 'astro'), 
                'subtitle' => __('This text will be displayed when a mandatory input field is empty.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Error! This field is required.', 
            ),
            array( 
                'id'=>'contact_error_email_text', 
                'type' => 'text', 
                'title' => __('Error message for invalid email', 'astro'), 
                'subtitle' => __('This text will be displayed when the entered email is invalid.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Error! This email is not valid.', 
            ),
            array( 
                'id'=>'contact_wait_text', 
                'type' => 'text', 
                'title' => __('Form submission: Wait message', 'astro'), 
                'subtitle' => __('This text will be displayed right after the send message button is clicked and only until the email is sent.', 'astro'), 
                'desc' => __('', 'astro'), 
                'default' => 'Please wait...', 
            ),
            array( 
                'id'=>'contact_ok_text', 
                'type' => 'text', 
                'title' => __('Form submission: Ok message', 'astro'), 
                'subtitle' => __('This text will be displayed after sending the email.', 'astro'), 
                'desc' => __('', 'astro'),
                'default' => 'Thank you for contacting us. We will reply soon!', 
            ),
		)
	);
    if (PRK_WOO=="true") 
    {
        $sections[] = array(
        'icon' => 'el-icon-shopping-cart',
        'icon_class' => 'icon-large',
        'title' => __('Woocommerce', 'astro'),
        'fields' => array(
            array(
                'id'=>'woo_sidebar_display',
                'type' => 'switch', 
                'title' => __('Display right sidebar by default?', 'astro'),
                'subtitle'=> __("This option will apply only to WooCommerce Core Pages that aren't set up using shortcodes. If you want to display/hide a sidebar on a specific page add ?sidebar=y or ?sidebar=n to your link URL", 'astro'),
                "default"       => 1,
            ),
            array(
                'id'=>'woo_cart_display',
                'type' => 'select',
                'data' => 'pages',
                'title' => __('Add Shopping Cart info to the main menu?', 'astro'),
                'subtitle' => __('Select the menu page to append info.', 'astro'),
                'desc' => __('', 'astro'),
                ),
            array(
                'id'=>'woo_cart_info',
                'type' => 'select', 
                'title' => __('Cart information?', 'astro'),
                'subtitle'=> __("Will be appended to the shop or cart button", 'astro'),
                'options' => array('items' => 'Items only','price' => 'Price Only','both' => 'Items and Price'),
                'default' => array('price' => 'Price Only')
            ),
            array(
                'id'=>'woo_cart_always_display',
                'type' => 'switch', 
                'title' => __('Show Shopping Cart info even when it is empty?', 'astro'),
                'subtitle'=> __("", 'astro'),
                "default"       => 0,
            ),
        )
    );
    }
	$sections[] = array(
		'icon' => 'el-icon-wrench',
		'icon_class' => 'icon-large',
        'title' => __('Custom scripts', 'astro'),
		'fields' => array(
			array(
				'id'=>'ganalytics_text',
				'type' => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'monokai',
				'title' => __('Tracking Code', 'astro'), 
				'subtitle' => __('Paste your Google Analytics (or other) tracking code here. For security reasons the script tags will be removed, but they will be injected again together with the inner code.', 'astro'),
				'validate_callback' => 'analytics_validate_callback_function',
                'desc' => ''
			),
			array(
				'id'=>'css_text',
				'type' => 'ace_editor',
                'mode'     => 'css',
                'theme'    => 'monokai',
				'title' => __('Custom CSS', 'astro'), 
				'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'astro'),
				'desc' => __('', 'astro'),
				'validate' => 'css',
			),
			array(
				'id'=>'js_text',
				'type' => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'monokai',
				'title' => __('Custom Javascript', 'astro'), 
				'subtitle' => __('Add some js scripting here', 'astro'),
				'desc' => "For object targeting use 'jQuery' prefix instead of the default '$' notation.",
			),
		)
	);
    $sections[] = array(
        'icon' => 'el-icon-key',
        'icon_class' => 'icon-large',
        'title' => __('Advanced settings', 'astro'),
        'fields' => array(
            array(
                'id'=>'info_warning_slugs',
                'type'=>'info',
                'style'=>'warning',
                'header'=> __( 'This is a header.', 'astro' ),
                'desc' => __( "If changes don't apply immediately it is related to Wordpress permalinks. After making your changes here you need to go to Settings>Reading and change permalinks structure to default. Save changes and then revert it to previous state.", 'astro')
            ),
            array(
                'id'=>'portfolio_slug',
                'type' => 'text',
                'title' => __('Portfolios slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'portfolios'
                ),
            array(
                'id'=>'skills_slug',
                'type' => 'text',
                'title' => __('Skills slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('Portfolio hierarchical category', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'skills'
                ),
            array(
                'id'=>'folio_tags_slug',
                'type' => 'text',
                'title' => __('Portfolio tag slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('Portfolio non-hierarchical category', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'tagged'
                ),
            array(
                'id'=>'slides_slug',
                'type' => 'text',
                'title' => __('Slides slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'slides'
                ),
            array(
                'id'=>'groups_slug',
                'type' => 'text',
                'title' => __('Slides groups slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('Slides hierarchical category', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'group'
                ),
            array(
                'id'=>'members_slug',
                'type' => 'text',
                'title' => __('Members slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'member'
                ),
            array(
                'id'=>'team_slug',
                'type' => 'text',
                'title' => __('Team slug', 'astro'),
                'subtitle' => __('No special characters and must be unique.', 'astro'),
                'desc' => __('Members hierarchical category', 'astro'),
                'validate' => 'no_special_chars',
                'default' => 'team'
                ),
        )
    );




    $tabs['item_info'] = array(
		'icon' => 'info-sign',
		'icon_class' => 'icon-large',
        'title' => __('Theme Information', 'astro'),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
			'icon' => 'book',
			'icon_class' => 'icon-large',
            'title' => __('Documentation', 'astro'),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }

    global $ReduxFramework;
    $ReduxFramework = new ReduxFramework($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);


/*ANALYTICS WORKAROUND*/
if ( !function_exists( 'analytics_validate_callback_function' ) ):
    function analytics_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value =  str_replace("<script>", "", $value);
        $value =  str_replace('<script type="text/javascript">', "", $value);
        $value =  str_replace("<script type='text/javascript'>", "", $value);
        $value =  str_replace("</script>", "", $value);
        
        $return['value'] = $value;
        if($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;

/*
	This is a test function that will let you see when the compiler hook occurs. 
	It only runs if a field	set with compiler=>true is changed.
*/
function testCompiler() {
	//echo "Compiler hook!";
}
add_action('redux-compiler-redux-sample-file', 'testCompiler');



/**
	Use this function to hide the activation notice telling users about a sample panel.
**/
function removeReduxAdminNotice() {
	delete_option('REDUX_FRAMEWORK_PLUGIN_ACTIVATED_NOTICES');
}
add_action('redux_framework_plugin_admin_notice', 'removeReduxAdminNotice');
