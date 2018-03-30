<?php
/**
 * Creates the options array for the Redux Framework
 *
 * @author Alessandro Tesoro
 * @copyright Copyright (c) 2014, ThemesDepot
 * @link  https://themesdepot.org
*/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
}

if ( !class_exists( "TDP_Redux_Framework_Config" ) ) {

	class TDP_Redux_Framework_Config {

		/**
		 *	Public Vars
		 */
		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		/**
			Constructor
		**/
		public function __construct( ) {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// Initiate the settings
			$this->initSettings();

		} // End Construct

		/**
		Initiate Settings
		**/
		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		/**
		* Return Sections
		*/
		public function getReduxSections() {
			return $this->sections;
		}

		/**
		 *	Set Sections
		 */
		public function setSections() {

			/**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'smartfood'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'smartfood'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'smartfood'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'smartfood'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'smartfood'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'smartfood') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'smartfood') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'smartfood'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

           $this->sections[] = array(
                'icon'      => 'el-icon-cogs',
                'title'     => __('General Settings', 'smartfood'),
                'customizer' => false,
                'fields'    => array(
                    array(
                        'id'        => 'logo',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Custom Logo', 'smartfood'),
                        'desc'      => __('Upload Your Custom Logo Here. If No Logo Is Defined, The Default Theme Logo Will Be Used.', 'smartfood'),
                        'default'   => array('url' => get_template_directory_uri() . '/images/logo.png' ),
                    ),
                    array(
                        'id'        => 'logo_alt',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Custom Logo Alternative', 'smartfood'),
                        'desc'      => __('Upload Your Custom Logo Here. If No Logo Is Defined, The Default Theme Logo Will Be Used. This logo will be displayed on non transparent headers, those headers in pages that do not have a transparent or background image.', 'smartfood'),
                        'default'   => array('url' => get_template_directory_uri() . '/images/logo_alt.png' ),
                    ),
                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Custom Favicon', 'smartfood'),
                        'desc'      => __('Upload Your Custom Favicon Here.', 'smartfood'),
                        'default'   => array('url' => '' ),
                    ),

                    array(
                        'id'=>'iphone_icon',
                        'url'=> true,
                        'type' => 'media', 
                        'title' => __('Apple iPhone Icon ', 'smartfood'),
                        'default' => array( 'url' => '' ),
                        'subtitle' => __('Upload your custom iPhone icon (57px by 57px).', 'smartfood'),
                    ),
                    
                    array(
                        'id'=>'iphone_icon_retina',
                        'url'=> true,
                        'type' => 'media', 
                        'title' => __('Apple iPhone Retina Icon ', 'smartfood'),
                        'default' => array( 'url' => '' ),
                        'subtitle' => __('Upload your custom iPhone retina icon (114px by 114px).', 'smartfood'),
                    ),
                    
                    array(
                        'id'=>'ipad_icon',
                        'url'=> true,
                        'type' => 'media', 
                        'title' => __('Apple iPad Icon ', 'smartfood'),
                        'default' => array( 'url' => '' ),
                        'subtitle' => __('Upload your custom iPad icon (72px by 72px).', 'smartfood'),
                    ),
                    
                    array(
                        'id'=>'ipad_icon_retina',
                        'url'=> true,
                        'type' => 'media', 
                        'title' => __('Apple iPad Retina Icon ', 'smartfood'),
                        'default' => array( 'url' => '' ),
                        'subtitle' => __('Upload your custom iPad retina icon (144px by 144px).', 'smartfood'),
                    ),

                    array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => __('Back To Top Button', 'smartfood'),
                        'subtitle'  => __('Enable The Back To Top Button That Appears In The Bottom Right Corner Of The Screen.', 'smartfood'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => __('Enable Sticky Header', 'smartfood'),
                        'subtitle'  => __('Enable This Option If You Wish To Display A Sticky Header.', 'smartfood'),
                        'default'   => true,
                    ),
                    array(
                        'id'=>'facebook',
                        'type' => 'text',
                        'title' => __('Facebook Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'=>'twitter',
                        'type' => 'text',
                        'title' => __('Twitter Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'=>'google',
                        'type' => 'text',
                        'title' => __('Google Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'=>'youtube',
                        'type' => 'text',
                        'title' => __('Youtube Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'=>'vimeo',
                        'type' => 'text',
                        'title' => __('Vimeo Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'=>'pinterest',
                        'type' => 'text',
                        'title' => __('Pinterest Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'       =>'linkedin',
                        'type'     => 'text',
                        'title'    => __('LinkedIn Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'       =>'instagram',
                        'type'     => 'text',
                        'title'    => __('Instagram Profile url', 'smartfood'),
                        'subtitle' => __('Enter the url of your profile.', 'smartfood'),
                    ),
                    array(
                        'id'       =>'email',
                        'type'     => 'text',
                        'title'    => __('Email Address', 'smartfood'),
                        'subtitle' => __('Enter your email address.', 'smartfood'),
                        'default'  => 'demo@demo.com'
                    ),
                    array(
                        'id'        => 'restaurant_address',
                        'type'      => 'text',
                        'title'     => __('Restaurant Address', 'smartfood'),
                        'subtitle'  => __('Enter the address of the restaurant, this will be displayed into the footer in specific layouts only and in other places where required.', 'smartfood'),
                        'default'   => '709 5th Ave, New York, NY 10019, United States',
                    ), 
                    array(
                        'id'       =>'phone',
                        'type'     => 'text',
                        'title'    => __('Phone Number', 'smartfood'),
                        'subtitle' => __('Enter the restaurant phone number. This will be displayed in the footer and in other places where required.', 'smartfood'),
                        'default'  => '123 456789'
                    ),
                    array(
                        'id'        => 'disable_comments',
                        'type'      => 'checkbox',
                        'title'     => __('Disable comments on pages.', 'smartfood'),
                        'subtitle'      => __('Enable this option to globally disable comments on every page.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_page_loader',
                        'type'      => 'checkbox',
                        'title'     => __('Display Page Loader.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display a page loader on your site.', 'smartfood'),
                        'default'   => '1'
                    ),
                ),
            );
            $this->sections[] = array(
                'title'     => __('Typography', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-fontsize',
                'customizer' => true,
                'fields'    => array(
                    
                    array(
                        'id'        => 'google_fonts',
                        'type'      => 'switch',
                        'title'     => __('Enable Google Fonts', 'smartfood'),
                        'subtitle'  => __('Enable this option to use google fonts. You can then select the google font url from the settings below.', 'smartfood'),
                        'default'   => true
                    ),

                    array(
                        'id'        => 'main_google_font',
                        'type'      => 'text',
                        'title'     => __('Google Font Url', 'smartfood'),
                        'subtitle'  => __('Enter The Url Of The Google Font That You Wish To Use.', 'smartfood'),
                        'default'   => 'fonts.googleapis.com/css?family=Merriweather:400,700',
                        'customizer' => true
                    ),

                    array(
                        'id'        => 'main_google_font_name',
                        'type'      => 'text',
                        'title'     => __('Set Font Name', 'smartfood'),
                        'subtitle'  => __('Use The Following Field To Enter The Font Name Used By The Font Provider Service You\'re Using. Please Read The Instruction Into The Documentation For More Information.', 'smartfood'),
                        'default'   => 'Merriweather',
                        'customizer' => true
                    ),

                    array(
                        'id'        => 'headings_google_font',
                        'type'      => 'text',
                        'title'     => __('Headings Google Font Url', 'smartfood'),
                        'subtitle'  => __('Enter The Url Of The Google Font That You Wish To Use.', 'smartfood'),
                        'default'   => 'fonts.googleapis.com/css?family=Raleway:400,600,700',
                        'customizer' => true
                    ),

                    array(
                        'id'        => 'headings_google_font_name',
                        'type'      => 'text',
                        'title'     => __('Set Alternative Font Name', 'smartfood'),
                        'subtitle'  => __('Use The Following Field To Enter The Font Name Used By The Font Provider Service You\'re Using. Please Read The Instruction Into The Documentation For More Information.', 'smartfood'),
                        'default'   => 'Raleway',
                        'customizer' => true
                    ),

                ),
            );
            $this->sections[] = array(
                'title'     => __('Blog', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-edit',
                'customizer' => false,
                'fields'    => array(
                    
                    array(
                        'id'        => 'display_posts_adjacent_links',
                        'type'      => 'checkbox',
                        'title'     => __('Display adjacent posts link.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display adjacent posts links into single posts pages.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_author_box',
                        'type'      => 'checkbox',
                        'title'     => __('Display author box.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the author box.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_date',
                        'type'      => 'checkbox',
                        'title'     => __('Display post date.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the post date into the post meta area.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_author',
                        'type'      => 'checkbox',
                        'title'     => __('Display post author.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the post author into the post meta area.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_comments',
                        'type'      => 'checkbox',
                        'title'     => __('Display post comments.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the post comment count into the post meta area.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'display_categories',
                        'type'      => 'checkbox',
                        'title'     => __('Display post categories.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the post categories list into the post meta area.', 'smartfood'),
                        'default'   => '1'
                    ),
                ),
            );
    
            $this->sections[] = array(
                'title'     => __('Food Menu', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-adjust-alt',
                'customizer' => false,
                'fields'    => array(

                    array(
                        'id'       => 'food_menu_page_layout',
                        'type'     => 'select',
                        'title'    => __('Food Menu Pages Layout', 'smartfood'), 
                        'subtitle' => __('Select the layout for all the food related pages such as the food menu archive page, the single food menu page and food menu categories pages.', 'smartfood'),
                        'options'  => array(
                            'fullwidth' => __('Fullwidth', 'smartfood'),
                            'sidebar_right' => __('Sidebar Right', 'smartfood'),
                            'sidebar_left' => __('Sidebar Left', 'smartfood')
                        ),
                        'default'  => 'sidebar_right'
                    ),
                    array(
                        'id'        => 'food_menu_archive_title',
                        'type'      => 'text',
                        'title'     => __('Food Menu Archive Title', 'smartfood'),
                        'subtitle'  => __('Enter the title you\'d like to display on the food menu archive page.', 'smartfood'),
                        'default'   => 'Our Food Menu Range',
                    ),

                ),
            );

            $this->sections[] = array(
                'title'     => __('Homepage', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-adjust-alt',
                'customizer' => false,
                'fields'    => array(

                    array(
                        'id'        => 'homepage_transparent_header',
                        'type'      => 'checkbox',
                        'title'     => __('Transparent Header', 'smartfood'),
                        'subtitle'      => __('Enable this option to set the header of this page as transparent.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'       => 'homepage_content',
                        'type'     => 'select',
                        'title'    => __('Homepage content', 'smartfood'), 
                        'subtitle' => __('Select the content to display in the homepage.', 'smartfood'),
                        'options'  => array(
                            'slider' => __('Slider', 'smartfood'),
                            'animated_title' => __('Animated Title', 'smartfood'),
                        ),
                        'default'  => 'animated_title'
                    ),
                    array(
                        'id'        => 'animated_title_1',
                        'type'      => 'text',
                        'title'     => __('Animated Title 1', 'smartfood'),
                        'subtitle'  => __('Enter the title content', 'smartfood'),
                        'default'   => 'One',
                        'required' => array('homepage_content','equals','animated_title'),
                    ),
                    array(
                        'id'        => 'animated_title_2',
                        'type'      => 'text',
                        'title'     => __('Animated Title 2', 'smartfood'),
                        'subtitle'  => __('Enter the title content', 'smartfood'),
                        'default'   => 'Place',
                        'required' => array('homepage_content','equals','animated_title'),
                    ),
                    array(
                        'id'        => 'animated_title_3',
                        'type'      => 'text',
                        'title'     => __('Animated Title 3', 'smartfood'),
                        'subtitle'  => __('Enter the title content', 'smartfood'),
                        'default'   => 'Seriously',
                        'required' => array('homepage_content','equals','animated_title'),
                    ),
                    array(
                        'id'        => 'animated_title_4',
                        'type'      => 'text',
                        'title'     => __('Animated Title 4', 'smartfood'),
                        'subtitle'  => __('Enter the title content', 'smartfood'),
                        'default'   => 'Good Food',
                        'required' => array('homepage_content','equals','animated_title'),
                    ),
                    array(
                        'id'        => 'animated_title_image',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Custom Background Image', 'smartfood'),
                        'desc'      => __('Upload the image that will be used for the header background on the homepage.', 'smartfood'),
                        'default'   => array('url' => '' ),
                        'required' => array('homepage_content','equals','animated_title'),
                    ),
                    array(
                        'id'        => 'homepage_slider_position',
                        'type'      => 'text',
                        'title'     => __('Slider Position Adjustment', 'smartfood'),
                        'subtitle'  => __('If your logo or header is bigger than the theme default size, use the following option to adjust the positioning of the slider.', 'smartfood'),
                        'default'   => '-122px',
                        'required' => array('homepage_transparent_header','equals','1'),
                    ),
                    array(
                        'id'          => 'homepage_slides',
                        'type'        => 'slides',
                        'title'       => __('Homepage Slider', 'smartfood'),
                        'desc' =>   __('If you wish to add a call to action button and customize the label, simply enter the link followed by a comma and then type the label of the button. Example <pre>http://example.com,My custom button</pre> This will create a custom button with the label "My Custom Button"', 'smartfood'),
                        'subtitle'    => __('Setup your slider here, upload an image and use the description field for the caption if needed.', 'smartfood'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'smartfood'),
                            'description'     => __('Description Here', 'smartfood'),
                            'url'             => __('Give us a link!', 'smartfood'),
                        ),
                        'required' => array('homepage_content','equals','slider'),
                    ),
                    array(
                        'id' => 'slider_height',
                        'type' => 'slider',
                        'title' => __('Slider Height', 'smartfood'),
                        'subtitle' => __('Adjust the height of the slider. The measure is in Px (pixels)', 'smartfood'),
                        "default" => 700,
                        "min" => 200,
                        "step" => 1,
                        "max" => 1500,
                        'display_value' => 'text',
                        'required' => array('homepage_content','equals','slider'),
                    ),
                    array(
                        'id' => 'slider_caption',
                        'type' => 'slider',
                        'title' => __('Slider Caption', 'smartfood'),
                        'subtitle' => __('Adjust the position of the slider captions. The measure is in Px (pixels)', 'smartfood'),
                        "default" => 300,
                        "min" => 1,
                        "step" => 1,
                        "max" => 1500,
                        'display_value' => 'text',
                        'required' => array('homepage_content','equals','slider'),
                    ),

                ),
            );

            $this->sections[] = array(
                'title'     => __('Events', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-adjust-alt',
                'customizer' => false,
                'fields'    => array(

                    array(
                        'id'       => 'events_single_page_layout',
                        'type'     => 'select',
                        'title'    => __('Events Single Pages Layout', 'smartfood'), 
                        'subtitle' => __('Select the layout the single event page.', 'smartfood'),
                        'options'  => array(
                            'sidebar_right' => __('Sidebar Right', 'smartfood'),
                            'sidebar_left' => __('Sidebar Left', 'smartfood')
                        ),
                        'default'  => 'sidebar_right'
                    ),
                    array(
                        'id'        => 'events_archive_page_title',
                        'type'      => 'text',
                        'title'     => __('Events Archive Title', 'smartfood'),
                        'subtitle'  => __('Enter the title you\'d like to display on the events archive page.', 'smartfood'),
                        'default'   => 'Come and join us',
                    ),
                    array(
                        'id'        => 'events_archive_page_subtitle',
                        'type'      => 'text',
                        'title'     => __('Events Archive SubTitle', 'smartfood'),
                        'subtitle'  => __('Enter the subtitle you\'d like to display on the events archive page.', 'smartfood'),
                        'default'   => 'A big range of fun events',
                    ),
                    array(
                        'id'        => 'event_header_bg_image',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Custom Header Background Image', 'smartfood'),
                        'desc'      => __('Upload the image that will be used for the header background on events pages.', 'smartfood'),
                        'default'   => array('url' => '' ),
                    ),
                    
                ),
            );

            $this->sections[] = array(
                'title'     => __('Footer', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-website',
                'customizer' => false,
                'fields'    => array(
                    
                    array(
                        'id'       => 'footer_layout',
                        'type'     => 'select',
                        'title'    => __('Footer Layout', 'smartfood'), 
                        'subtitle' => __('Select the default footer layout. This option can be overridden on individual pages. <br/><br/> The booking form footer layout requires the WP Restaurant Manager Plugin to work.', 'smartfood'),
                        'options'  => array(
                            'minimal' => __('Minimal Footer', 'smartfood'),
                            'minimal_widgets' => __('Minimal Footer With Widgets', 'smartfood'),
                            //'booking' => __('Booking Form Footer')
                        ),
                        'default'  => 'minimal'
                    ),

                    array(
                        'id'        => 'copyright_notice',
                        'type'      => 'editor',
                        'title'     => __('Footer Copyright Notice', 'smartfood'),
                        'subtitle'  => __('Enter the footer copyright notice here.', 'smartfood'),
                        'args'   => array(
                            'teeny'         => true,
                            'media_buttons' => false,
                            'textarea_rows' => 10
                        ),
                        'default'   => sprintf(
                            __( 'Copyright &#169; %s. Powered by %s and %s.', 'smartfood' ), 
                            date_i18n( 'Y' ), 'SmartFood WordPress Theme',"<a href='https://themesdepot.org'>ThemesDepot</a>"
                        )
                    ),

                    array(
                        'id'        => 'display_logo_in_footer',
                        'type'      => 'checkbox',
                        'title'     => __('Display Logo in Footer.', 'smartfood'),
                        'subtitle'      => __('Enable this option to display the logo in your footer.', 'smartfood'),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'footer_about_title',
                        'type'      => 'text',
                        'title'     => __('Restaurant Description Title', 'smartfood'),
                        'subtitle'  => __('Use the following field to enter a title that will be displayed below the logo and above the restaurant description.', 'smartfood'),
                        'default'   => 'About Us',
                        'customizer' => true
                    ),
                    array(
                        'id'        => 'footer_about',
                        'type'      => 'editor',
                        'title'     => __('Restaurant Description', 'smartfood'),
                        'subtitle'  => __('Enter the description that will be displayed into the booking form and widget type footer layout.', 'smartfood'),
                        'args'   => array(
                            'teeny'         => true,
                            'media_buttons' => false,
                            'textarea_rows' => 10
                        ),
                        'default'   => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>'
                    ),
                    array(
                        'id'        => 'footer_booking_bg',
                        'type'      => 'media',
                        'preview'   => false,
                        'title'     => __('Booking Footer Background Image', 'smartfood'),
                        'desc'      => __('Upload a custom background image for the footer. This image will be used only when the footer layout is set to "booking"', 'smartfood'),
                        'default'   => array('url' => '' ),
                    ),
                ),
            );
            $this->sections[] = array(
                'title'     => __('Skin Settings', 'smartfood'),
                'submenu'   => true,
                'icon'      => 'el-icon-tint',
                'customizer' => true,
                'fields'    => array(
                    array(
                        'id'        => 'custom_skin',
                        'type'      => 'checkbox',
                        'title'     => __('Enable Custom Skin', 'smartfood'),
                        'subtitle'      => __('Enable this option to enable custom skin colors from the options below here', 'smartfood'),
                        'default'   => 0
                    ),
                    array(
                        'id'       => 'accent_color_1',
                        'type'     => 'color',
                        'title'    => __('Accent Color 1', 'smartfood'), 
                        'desc' => __('Pick the main accent color. This is used as background for many sections of the site.', 'smartfood'),
                        'default'  => '#21201e',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'accent_color_2',
                        'type'     => 'color',
                        'title'    => __('Accent Color 2', 'smartfood'), 
                        'desc' => __('Pick the 2nd accent color. This is used for many sections of the text and titles and other typography elements.', 'smartfood'),
                        'default'  => '#b39964',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'subheader_bg',
                        'type'     => 'color',
                        'title'    => __('Subheader Background', 'smartfood'), 
                        'desc' => __('This is the background of regular pages subheaders.', 'smartfood'),
                        'default'  => '#fafafa',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'widget_color',
                        'type'     => 'color',
                        'title'    => __('Widget Colors', 'smartfood'), 
                        'desc' => __('This is the color used for widgets and certain other elements.', 'smartfood'),
                        'default'  => '#808080',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'sub_text',
                        'type'     => 'color',
                        'title'    => __('Sub Text', 'smartfood'), 
                        'desc' => __('This is the color used for less important typography elements.', 'smartfood'),
                        'default'  => '#9d9d9d',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'section_c1',
                        'type'     => 'color',
                        'title'    => __('Section Highlight Color 1', 'smartfood'), 
                        'desc' => __('This is the background color used for sections types "Section Highlight BG Color 1"', 'smartfood'),
                        'default'  => '#2e2d2a',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'section_c2',
                        'type'     => 'color',
                        'title'    => __('Section Highlight Color 2', 'smartfood'), 
                        'desc' => __('This is the background color used for sections types "Section Highlight BG Color 2"', 'smartfood'),
                        'default'  => '#50463F',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'forms_border',
                        'type'     => 'color',
                        'title'    => __('Forms Border Color', 'smartfood'), 
                        'desc' => __('This is the border color of forms elements', 'smartfood'),
                        'default'  => '#CACACA',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'forms_color',
                        'type'     => 'color',
                        'title'    => __('Forms Color', 'smartfood'), 
                        'desc' => __('This is the content color of forms elements', 'smartfood'),
                        'default'  => '#999999',
                        'validate' => 'color',
                    ),
                ),
            );
            $this->sections[] = array(
                'title'     => __('Import / Export', 'smartfood'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'smartfood'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections = apply_filters( 'tdp_redux_sections', $this->sections );

		}

		public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Customers Support', 'smartfood'),
                'content'   => __('<p>Support is available to verified customers only, and only at http://support.themesdepot.org</a>', 'smartfood')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('&nbsp;', 'smartfood');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'tdp_theme_opt',
                'page_slug' => 'tdp_theme_options',
                'page_title' => __('Theme Options Panel','smartfood'),
                'intro_text' => '',
                'footer_text' => '',
                'menu_type' => 'menu',
                'display_name' => __('Theme Options Panel','smartfood'),
                'menu_title' => __('Theme Options','smartfood'),
                'footer_credit' => sprintf(__('Thank you for choosing %s - A ', 'smartfood' ), $theme->get("Name")) . __('<a href="https://themesdepot.org" target="_blank">ThemesDepot Theme</a>.','smartfood') . sprintf(__(' Visit our <a href="%s" target="_blank">website</a> for freebies, themes, plugins and more.', 'smartfood'), 'https://themesdepot.org'),
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_mark' => '*',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
                'dev_mode' => false
              );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/ThemesDepot',
                'title' => __('Like us on Facebook','smartfood'),
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/themesdepot',
                'title' => __('Follow us on Twitter', 'smartfood'),
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.dribbble.com/alessandro_tesoro',
                'title' => __('Find us on Dribbble', 'smartfood'),
                'icon'  => 'el-icon-dribbble'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://themesdepot.org',
                'title' => __('Visit ThemesDepot.org', 'smartfood'),
                'icon'  => 'el-icon-link'
            );

            $this->args = apply_filters( 'wpex_redux_args', $this->args );

        }

	}

	// Start our class
	$tdp_redux_framework_class = new TDP_Redux_Framework_Config();

}