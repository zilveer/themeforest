<?php

/**
	ReduxFramework Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Redux_Framework_config" ) ) {
	class Redux_Framework_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
			

			// If Redux is running as a plugin, this will remove the demo notice and links
			//add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			
			// Change the default value of a field after it's been set, but before it's been used
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

			// Dynamically add a section. Can be also used to modify sections/fields
			add_filter('redux/options/'.$this->args['opt_name'].'/sections', array( $this, 'dynamic_section' ) );

		}


		/**

			This is a test function that will let you see when the compiler hook occurs. 
			It only runs if a field	set with compiler=>true is changed.

		**/

		function compiler_action($options, $css) {
			//echo "<h1>The compiler hook has run!";
			//print_r($options); //Option values
			
			//print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

			/*
			// Demo of how to use the dynamic CSS and write your own static CSS file
		    $filename = dirname(__FILE__) . '/style' . '.css';
		    global $wp_filesystem;
		    if( empty( $wp_filesystem ) ) {
		        require_once( ABSPATH .'/wp-admin/includes/file.php' );
		        WP_Filesystem();
		    }

		    if( $wp_filesystem ) {
		        $wp_filesystem->put_contents(
		            $filename,
		            $css,
		            FS_CHMOD_FILE // predefined mode settings for WP files
		        );
		    }
			*/
		}



		/**
		 
		 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 	Simply include this function in the child themes functions.php file.
		 
		 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 	so you must use get_template_directory_uri() if you want to use any of the built in icons
		 
		 **/

		function dynamic_section($sections){
		    /*//$sections = array();
		    $sections[] = array(
		        'title' => __('Section via hook', 'redux-framework-demo'),
		        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				    // Leave this as a blank section, no options just some intro text set above.
		        'fields' => array()
		    );*/

		    return $sections;
		}
		
		
		/**

			Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		**/
		
		function change_arguments($args){
		    //$args['dev_mode'] = true;
		    
		    return $args;
		}
			
		
		/**

			Filter hook for filtering the default value of any given field. Very useful in development mode.

		**/

		function change_defaults($defaults){
		    $defaults['str_replace'] = "Testing filter hook!";
		    
		    return $defaults;
		}


		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {
			
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

		}


		public function setSections() {

			/**
			 	Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 **/


			// Background Patterns Reader
			$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :
				
			  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
			  	$sample_patterns = array();

			    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

			      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
			      	$name = explode(".", $sample_patterns_file);
			      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
			      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			      }
			    }
			  endif;
			endif;

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name'); 
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','bkninja' ), $this->theme->display('Name') );

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
					<?php echo $this->theme->display('Name'); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','bkninja'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','bkninja'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'bkninja').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','bkninja' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>
					
				</div>

			</div>

			<?php
			$item_info = ob_get_contents();
			    
			ob_end_clean();

			$sampleHTML = '';
			if( file_exists( dirname(__FILE__).'/info-html.html' )) {
				/** @global WP_Filesystem_Direct $wp_filesystem  */
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once(ABSPATH .'/wp-admin/includes/file.php');
					WP_Filesystem();
				}  		
				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
			}




			// ACTUAL DECLARATION OF SECTIONS
            
                $this->sections[] = array(
    				'icon' => 'el-icon-wrench',
    				'title' => __('General Settings', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-favicon',
    						'type' => 'media', 
    						'url'=> true,
    						'title' => __('Site favicon', 'bkninja'),
    						'subtitle' => __('Upload site Favicon (16x16 px)', 'bkninja'),
                            'placeholder' => __('No media selected','bkninja')
						),
    					array(
    						'id'=>'bk-primary-color',
    						'type' => 'color',
    						'title' => __('Primary color', 'bkninja'), 
    						'subtitle' => __('Pick a primary color for the theme.', 'bkninja'),
    						'default' => '#F1284E',
    						'validate' => 'color',
						),
                        array(
    						'id'=>'bk-dark-color',
    						'type' => 'color',
    						'title' => __('Dark color', 'bkninja'), 
    						'subtitle' => __('Pick dark color for the theme.', 'bkninja'),
    						'default' => '#333946',
    						'validate' => 'color',
						),	
    				)
    			);
                $this->sections[] = array(
    				'icon' => 'el-icon-tasks',
    				'title' => __('Site Layout', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-site-layout',
    						'type' => 'button_set',
    						'title' => __('Site layout', 'bkninja'),
    						'subtitle'=> __('Choose between wide and boxed layout', 'bkninja'),
    						'options' => array('1' => __('Wide', 'bkninja'),'2' => __('Boxed', 'bkninja')),
    						'default' => '1'
						),
                        array(
    						'id'=>'bk-body-bg',
    						'type' => 'background',
                            'required' => array('bk-site-layout','=','2'),
    						'output' => array('body'),
    						'title' => __('Site background', 'bkninja'), 
    						'subtitle' => __('Choose background image or background color for boxed layout', 'bkninja'),
						),
                        array(
    						'id'=>'bk-sidebar-location',
    						'type' => 'select',
    						'title' => __('Sidebar location', 'bkninja'), 
    						'subtitle' => __('Choose sidebar location', 'bkninja'),
    						'options' => array('right' => __('Right', 'bkninja'), 'left' => __('Left', 'bkninja')),
    						'default' => 'right'
						),
                        array(
    						'id'=>'bk-sidebar-style',
    						'type' => 'select',
    						'title' => __('Sidebar style option', 'bkninja'), 
    						'subtitle' => __('Choose style for sidebar', 'bkninja'),
    						'options' => array('bordered' => __('Bordered', 'bkninja'), 'no-border' => __('No border', 'bkninja'), 'grey' => __('Grey background', 'bkninja')),
    						'default' => 'grey'
						),
                        array(
    						'id'=>'bk-responsive-switch',
    						'type' => 'switch', 
    						'title' => __('Enable responsive', 'bkninja'),
    						'subtitle'=> __('Enable responsive layout', 'bkninja'),
    						'default' 		=> 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'bk-sb-responsive-sw',
    						'type' => 'switch', 
    						'title' => __('Enable sidebar in responsive layout', 'bkninja'),
    						'subtitle' => __('Choose to display or hide sidebar in responsive layout', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
            				'id'=>'bk-module-header-layout',
            				'type' => 'select',
                            'title' => __('Module header alignment', 'bkninja'), 
                            'subtitle' => __('Choose between left and center aligned for the header of modules', 'bkninja'),
    						'options' => array('left' => __('Left', 'bkninja'),'center'=>__('Center', 'bkninja')),
    						'default' => 'left',
        				),
                        array(
    						'id'=>'bk-rtl-sw',
    						'type' => 'switch', 
    						'title' => __('Enable RTL', 'bkninja'),
    						'subtitle'=> __('Enable Right To Left layout', 'bkninja'),
    						'default' 		=> 0,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),	
    				)
    			);
                $this->sections[] = array(
    				'icon' => 'el-icon-credit-card',
    				'title' => __('Header Settings', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-logo',
    						'type' => 'media', 
    						'url'=> true,
    						'title' => __('Site logo', 'bkninja'),
    						'subtitle' => __('Upload logo of your site that is displayed in header', 'bkninja'),
                            'placeholder' => __('No media selected','bkninja')
						),
                        array(
    						'id'=>'bk-header-social-switch',
    						'type' => 'switch', 
    						'title' => __('Enable top-bar social', 'bkninja'),
    						'subtitle' => __('Enable social icons in top-bar', 'bkninja'),
    						"default" => 0,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),	
                        array(
    						'id'=>'bk-social-header',
    						'type' => 'text',
                            'required' => array('bk-header-social-switch','=','1'),
    						'title' => __('Social media', 'bkninja'),
    						'subtitle' => __('Set up social links for site', 'bkninja'),
    						'options' => array('fb'=>'Facebook Url', 'twitter'=>'Twitter Url', 'gplus'=>'GPlus Url', 'linkedin'=>'Linkedin Url',
                                               'pinterest'=>'Pinterest Url', 'instagram'=>'Instagram Url', 'dribbble'=>'Dribbble Url', 
                                               'youtube'=>'Youtube Url', 'vimeo'=>'Vimeo Url', 'vk'=>'VK Url', 'rss'=>'RSS Url'),
    						'default' => array('fb'=>'', 'twitter'=>'', 'gplus'=>'', 'linkedin'=>'', 'pinterest'=>'', 'instagram'=>'', 'dribbble'=>'', 
                                                'youtube'=>'', 'vimeo'=>'', 'vk'=>'', 'rss'=>'')
						),
                        array(
    						'id'=>'bk-header-bg',
    						'type' => 'background',
    						'output' => array('.header-wrap'),
    						'title' => __('Header background', 'bkninja'), 
    						'subtitle' => __('Choose background image or background color for site header', 'bkninja'),
						),
                        array(
            				'id'=>'bk-header-layout',
            				'type' => 'select',
                            'title' => __('Header layout', 'bkninja'), 
                            'subtitle' => __('Choose site header layout', 'bkninja'),
                            'options' => array('left' => __('Left', 'bkninja'),'center'=>__('Center', 'bkninja')),                            
    						'default' => 'left',
        				),
                        array(
            				'id'=>'bk-header-scheme',
            				'type' => 'select',
                            'title' => __('Header color scheme', 'bkninja'), 
                            'subtitle' => __('Choose site header color scheme', 'bkninja'),
    						'options' => array('dark' => __('Dark', 'bkninja'), 'light' => __('Light', 'bkninja'), 'custom' => __('Primary color', 'bkninja')),
    						'default' => 'dark',
        				),
                        array(
    						'id'=>'bk-fixed-nav-switch',
    						'type' => 'button_set', 
    						'title' => __('Enable fixed header menu', 'bkninja'),
    						'subtitle'=> __('Choose between fixed and static header navigation', 'bkninja'),
                            'options' => array('1' => __('Static', 'bkninja'),'2' => __('Fixed', 'bkninja')),
    						'default' => '1',
						),
                        array(
    						'id'=>'bk-header-banner-switch',
    						'type' => 'switch', 
    						'title' => __('Enable header banner', 'bkninja'),
    						'subtitle' => __('Enable banner in header', 'bkninja'),
    						"default" => 0,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'bk-header-banner',
    						'type' => 'text',
                            'required' => array('bk-header-banner-switch','=','1'),
    						'title' => __('Header banner', 'bkninja'),
    						'subtitle' => __('Set up banner displays in header', 'bkninja'),
    						'options' => array('imgurl'=> __('Image URL', 'bkninja'), 'linkurl'=> __('Link URL', 'bkninja')),
    						'default' => array('imgurl'=>'http://', 'linkurl'=>'http://')
						),
                        array(
                            'id'=>'bk-banner-script',
                            'type' => 'textarea',
                            'title' => __('Google Adsense Code', 'bkninja'),
                            'required' => array('bk-header-banner-switch','=','1'),
                            'default' => '',
                        ),
    				)
    			);
                $this->sections[] = array(
    				'icon' => 'el-icon-credit-card',
    				'title' => __('Footer Settings', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-backtop-switch',
    						'type' => 'switch', 
    						'title' => __('Scroll top button', 'bkninja'),
    						'subtitle'=> __('Show scroll to top button in right lower corner of window', 'bkninja'),
    						'default' 		=> 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'cr-text',
    						'type' => 'textarea',
    						'title' => __('Copyright text - HTML Validated', 'bkninja'), 
    						'subtitle' => __('HTML Allowed (wp_kses)', 'bkninja'),
    						'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
    						'default' => __('&#169; Copyright <a href="htttp://your-site-url">Your Site Name</a>. All rights reserved.', 'bkninja')
						),
    				)
    			);
                $this->sections[] = array(
            		'icon'    => ' el-icon-font',
            		'title'   => __('Typography', 'bkninja'),
            		'fields'  => array(
                        array(
            				'id'=>'bk-header-font',
            				'type' => 'typography', 
                            'output' => array('.reviewscore, .score, .bk-final-score, .bk-criteria, .bk-criteria-score, .post-meta, h3.ticker-header, .top-nav .menu li > a, .main-nav ul > li > a, .widget-tabs-title-container li h3, .widget-tabs-title-container li h4, .cat-header h3,
                             .post-cat, .add-comment-btn, .cat-btn, .tag-btn, .block-title, .bk-header h3, #comments h3, #comments h4, #respond h3, #respond h4, #comment-submit,
                             .widget_flickr h4, .widget-facebook h4, .widget_rss h4, .widget_calendar h4, .widget_youtube_subscribe .widget-title , .widget_recent_comments h4, .widget_links h4, .widget_search h4, .widget_tag_cloud h4, .widget_categories h4, .widget_recent h4, .widget_archive h4, .widget_meta h4, .widget_pages h4, .widget_recent_entries h4, .widget_nav_menu h4, .widget_text h4, .widget_nav_menu li a,
                             .load-more-text'),
            				'title' => __('Navigation font', 'bkninja'),
            				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
            				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
            				//'subsets'=>false, // Only appears if google is true and subsets not set to false
            				'font-size'=>false,
            				'line-height'=>false,
            				//'word-spacing'=>true, // Defaults to false
            				//'letter-spacing'=>true, // Defaults to false
            				'color'=>false,
            				//'preview'=>false, // Disable the previewer
            				'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            				'units'=>'px', // Defaults to px
                            'text-align' => false,
            				'subtitle'=> __('Font options for menu, category title and module title', 'bkninja'),
            				'default'=> array( 
            					'font-weight'=>'400', 
            					'font-family'=>'PT Sans', 
            					'google' => true,
            				    ),
                        ),
                        array(
            				'id'=>'bk-title-font',
            				'type' => 'typography', 
                            'output' => array('h1, h2, h3, h4, h5, h5, h6, .post-title , .post-title-card , .grid-container .post-info .post-title , .post-title.post-title-masonry, .post-nav-link-title h3,
                            .recentcomments a:last-child, ul.ticker li h2 a, .header .logo.logo-text h1, .widget_recent_entries a'),
            				'title' => __('Post title font', 'bkninja'),
            				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
            				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
            				//'subsets'=>false, // Only appears if google is true and subsets not set to false
            				'font-size'=>false,
            				'line-height'=>false,
            				//'word-spacing'=>true, // Defaults to false
            				//'letter-spacing'=>true, // Defaults to false
            				'color'=>false,
            				//'preview'=>false, // Disable the previewer
            				'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            				'units'=>'px', // Defaults to px
                            'text-align' => false,
            				'subtitle'=> __('Font options for title of posts', 'bkninja'),
            				'default'=> array( 
            					'font-weight'=>'700', 
            					'font-family'=>'Roboto Slab', 
            					'google' => true,
            				    ),
                        ),
                        array(
            				'id'=>'bk-body-font',
            				'type' => 'typography',
                            'output' => array('body, textarea, input, p, 
                            .entry-excerpt, .comment-text, .comment-author, .article-content,
                            .comments-area, .tag-list, .bk-author-meta h3 '), 
            				'title' => __('Text font', 'bkninja'),
            				//'compiler'=>true, // Use if you want to hook in your own CSS compiler
            				'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
            				//'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
            				//'subsets'=>false, // Only appears if google is true and subsets not set to false
            				'font-size'=>false,
            				'line-height'=>false,
            				//'word-spacing'=>true, // Defaults to false
            				//'letter-spacing'=>true, // Defaults to false
            				'color'=>false,
            				//'preview'=>false, // Disable the previewer
            				'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            				'units'=>'px', // Defaults to px
                            'text-align' => false,
            				'subtitle'=> __('Font options for text body', 'bkninja'),
            				'default'=> array(
            					'font-weight'=>'400', 
            					'font-family'=>'Droid Sans', 
            					'google' => true,
                            ),
            			),
                    ),
                );
                $this->sections[] = array(
    				'icon' => 'el-icon-file-edit',
    				'title' => __('Post Settings', 'bkninja'),
    				'fields' => array(
                        array(
                            'id'       => 'feat-tag',
                            'type'     => 'text',
                            'title'    => __('Featured tag name', 'bkninja'),
                            'subtitle' => __('Tag name to feature your post, if no posts match the tag, sticky post will be displayed instead.', 'bkninja'),
                            'default'  => ''
                        ),
                        array(
                            'id' => 'section-postmeta-start',
                            'title' => __('Post meta', 'bkninja'),
                            'subtitle' => __('Options for displaying post meta in modules and widgets','bkninja'),
                            'type' => 'section',                             
                            'indent' => true // Indent all options below until the next 'section' option is set.
                        ),
                        array(
                            'id'=>'bk-meta-review-sw',
                            'type' => 'switch',
                            'title' => __('Enable post meta review score', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-meta-author-sw',
                            'type' => 'switch',
                            'title' => __('Enable post meta author', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-meta-date-sw',
                            'type' => 'switch',
                            'title' => __('Enable post meta date', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-meta-views-sw',
                            'type' => 'switch',
                            'title' => __('Enable post meta views', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-meta-comments-sw',
                            'type' => 'switch',
                            'title' => __('Enable post meta comments', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-meta-readmore-sw',
                            'type' => 'switch',
                            'title' => __('Enable post readmore button', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id' => 'section-postmeta-end',
                            'type' => 'section',                             
                            'indent' => false // Indent all options below until the next 'section' option is set.
                        ),
                        
    				)
    			);
                $this->sections[] = array(
            		'icon'    => 'el-icon-book',
            		'title'   => __('Pages Setting', 'bkninja'),
            		'heading' => __('Pages Setting','bkninja'),
            		'desc'    => __('<p class="description">Setting layout for pages</p>', 'bkninja'),
            		'fields'  => array(
                        array(
            				'id'=>'bk-blog-layout',
            				'type' => 'select',
                            'title' => __('Blog page layout', 'bkninja'), 
    						'options' => array('grid-2' => __('Grid 2 columns','bkninja'), 'grid-3' => __('Grid 3 columns','bkninja'), 'card' => __('Cards', 'bkninja'),'masonry-2'=>__('Masonry 2 columns', 'bkninja'), 'masonry-3'=>__('Masonry 3 columns', 'bkninja'), 'classic-big'=>__('Classic big thumbnail', 'bkninja'), 'classic-small'=>__('Classic small thumbnail', 'bkninja')),
    						'default' => 'masonry-2',
            			),
                        array(
            				'id'=>'bk-author-layout',
            				'type' => 'select',
                            'title' => __('Author page layout', 'bkninja'), 
    						'options' => array('grid-2' => __('Grid 2 columns','bkninja'), 'grid-3' => __('Grid 3 columns','bkninja'), 'card' => __('Cards', 'bkninja'),'masonry-2'=>__('Masonry 2 columns', 'bkninja'), 'masonry-3'=>__('Masonry 3 columns', 'bkninja'), 'classic-big'=>__('Classic big thumbnail', 'bkninja'), 'classic-small'=>__('Classic small thumbnail', 'bkninja')),
    						'default' => 'card',
            			),
                        array(
            				'id'=>'bk-category-layout',
            				'type' => 'select',
                            'title' => __('Category page layout', 'bkninja'),
                            'subtitle' => __('Global setting for layout of category archive page, will be overridden by layout option in category edit page.', 'bkninja'), 
    						'options' => array('grid-2' => __('Grid 2 columns','bkninja'), 'grid-3' => __('Grid 3 columns','bkninja'), 'card' => __('Cards', 'bkninja'),'masonry-2'=>__('Masonry 2 columns', 'bkninja'), 'masonry-3'=>__('Masonry 3 columns', 'bkninja'), 'classic-big'=>__('Classic big thumbnail', 'bkninja'), 'classic-small'=>__('Classic small thumbnail', 'bkninja')),
    						'default' => 'grid-2',
            			),
                        array(
            				'id'=>'bk-archive-layout',
            				'type' => 'select',
                            'title' => __('Archive page layout', 'bkninja'), 
                            'subtitle' => __('Layout for Archive page, Search result and Tag archive.', 'bkninja'),
    						'options' => array('grid-2' => __('Grid 2 columns','bkninja'), 'grid-3' => __('Grid 3 columns','bkninja'), 'card' => __('Cards', 'bkninja'),'masonry-2'=>__('Masonry 2 columns', 'bkninja'), 'masonry-3'=>__('Masonry 3 columns', 'bkninja'), 'classic-big'=>__('Classic big thumbnail', 'bkninja'), 'classic-small'=>__('Classic small thumbnail', 'bkninja')),
    						'default' => 'classic-small',
            			),
                        array(
            				'id'=>'bk-video-thumb',
            				'type' => 'select',
                            'title' => __('Archive video thumbnail option:', 'bkninja'), 
                            'subtitle' => __('Choose between image thumbnail or video thumbnail for video post format', 'bkninja'),
    						'options' => array('video' => __('Video', 'bkninja'),'thumbnail'=> __('Featured image', 'bkninja')),
                            'default' => 'thumbnail',
            			),
                    ),
                );
                $this->sections[] = array(
    				'icon' => 'el-icon-list-alt',
    				'title' => __('Single Settings', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-single-feat',
    						'type' => 'switch', 
    						'title' => __('Enable featured posts', 'bkninja'),
    						'subtitle' => __('Display featured posts at top of single page', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'bk-single-featimg',
    						'type' => 'switch', 
    						'title' => __('Enable featured image', 'bkninja'),
    						'subtitle' => __('Enable featured image in single post', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
            				'id'=>'bk-single-title',
            				'type' => 'select',
                            'title' => __('Single post title position', 'bkninja'), 
                            'subtitle' => __('Choose to display the post title above or below featured image', 'bkninja'),
    						'options' => array('below'=>__('Below', 'bkninja'), 'above'=> __('Above', 'bkninja')),
    						'default' => 'below',
            			),
                        array(
    						'id'=>'bk-sharebox-sw',
    						'type' => 'switch', 
    						'title' => __('Enable share box', 'bkninja'),
    						'subtitle' => __('Enable share links below single post', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                            'indent' => true
						),
                        array(
                            'id'=>'section-sharebox-start',
                            'type' => 'section',                             
                            'indent' => true // Indent all options below until the next 'section' option is set.
                        ),
                        array(
                            'id'=>'bk-fb-sw',
                            'type' => 'switch',
                            'title' => __('Enable Facebook share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-tw-sw',
                            'type' => 'switch',
                            'title' => __('Enable Twitter share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-gp-sw',
                            'type' => 'switch',
                            'title' => __('Enable Google+ share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-pi-sw',
                            'type' => 'switch',
                            'title' => __('Enable Pinterest share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-tbl-sw',
                            'type' => 'switch',
                            'title' => __('Enable Tumblr share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-li-sw',
                            'type' => 'switch',
                            'title' => __('Enable Linkedin share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-su-sw',
                            'type' => 'switch',
                            'title' => __('Enable Stumbleupon share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'bk-vk-sw',
                            'type' => 'switch',
                            'title' => __('Enable VK share link', 'bkninja'),
                            "default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
                        ),
                        array(
                            'id'=>'section-sharebox-end',
                            'type' => 'section', 
                            'indent' => false // Indent all options below until the next 'section' option is set.
                        ), 
                        array(
    						'id'=>'bk-authorbox-sw',
    						'type' => 'switch', 
    						'title' => __('Enable author box', 'bkninja'),
    						'subtitle' => __('Enable author information below single post', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'bk-postnav-sw',
    						'type' => 'switch', 
    						'title' => __('Enable post navigation', 'bkninja'),
    						'subtitle' => __('Enable post navigation below single post', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),
                        array(
    						'id'=>'bk-related-sw',
    						'type' => 'switch', 
    						'title' => __('Enable related posts', 'bkninja'),
    						'subtitle' => __('Enable related posts below single post', 'bkninja'),
    						"default" => 1,
    						'on' => __('Enabled', 'bkninja'),
    						'off' => __('Disabled', 'bkninja'),
						),      	
    				)
    			);
                $this->sections[] = array(
    				'icon' => 'el-icon-css',
    				'title' => __('Custom CSS/JS', 'bkninja'),
    				'fields' => array(
                        array(
    						'id'=>'bk-css-code',
    						'type' => 'ace_editor',
    						'title' => __('CSS Code', 'bkninja'), 
    						'subtitle' => __('Paste your CSS code here.', 'bkninja'),
    						'mode' => 'css',
    			            'theme' => 'chrome',
    						'desc' => __('Possible modes can be found at <a href="http://ace.c9.io" target="_blank">').'http://ace.c9.io/</a>.',
    			            'default' => "",
    					),
    			        array(
    						'id'=>'bk-js-code',
    						'type' => 'ace_editor',
    						'title' => __('JS Code', 'bkninja'), 
    						'subtitle' => __('Paste your JS code here.', 'bkninja'),
    						'mode' => 'javascript',
    			            'theme' => 'chrome',
    						'desc' => __('Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.', 'bkninja'),
    			            'default' => "",
    					),                                                	
    				)
    			);				
					

			$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'bkninja').'<a href="'.$this->theme->get('ThemeURI').'" target="_blank">'.$this->theme->get('ThemeURI').'</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'bkninja').$this->theme->get('Author').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'bkninja').$this->theme->get('Version').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$this->theme->get('Description').'</p>';
			$tabs = $this->theme->get('Tags');
			if ( !empty( $tabs ) ) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'bkninja').implode(', ', $tabs ).'</p>';	
			}
			$theme_info .= '</div>';

			/*if(file_exists(dirname(__FILE__).'/README.md')){
			$this->sections['theme_docs'] = array(
						'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'redux-framework-demo'),
						'fields' => array(
							array(
								'id'=>'17',
								'type' => 'raw',
								'content' => file_get_contents(dirname(__FILE__).'/README.md')
								),				
						),
						
						);
			}//if*/
   

			$this->sections[] = array(
				'type' => 'divide',
			);

			$this->sections[] = array(
				'icon' => 'el-icon-info-sign',
				'title' => __('Theme Information', 'bkninja'),
				'fields' => array(
					array(
						'id'=>'raw_new_info',
						'type' => 'raw',
						'content' => $item_info,
						)
					),   
				);

			/*if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
			    $tabs['docs'] = array(
					'icon' => 'el-icon-book',
					    'title' => __('Documentation', 'redux-framework-demo'),
			        'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
			    );
			}*/

		}	

		public function setHelpTabs() {

			/*// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-1',
			    'title' => __('Theme Information 1', 'redux-framework-demo'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-2',
			    'title' => __('Theme Information 2', 'redux-framework-demo'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');*/

		}


		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'bk_option', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Theme Options', 'bkninja' ),
	            'page'		 	 		=> __( 'Theme Options', 'bkninja' ),
	            'google_api_key'   	 	=> 'AIzaSyBdxbxgVuwQcnN5xCZhFDSpouweO-yJtxw', // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> true, // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tag'            	=> true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> false, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
			$this->args['share_icons'][] = array(
			    'url' => 'https://github.com/ReduxFramework/ReduxFramework',
			    'title' => 'Visit us on GitHub', 
			    'icon' => 'el-icon-github'
			    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);		
			$this->args['share_icons'][] = array(
			    'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
			    'title' => 'Like us on Facebook', 
			    'icon' => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
			    'url' => 'http://twitter.com/reduxframework',
			    'title' => 'Follow us on Twitter', 
			    'icon' => 'el-icon-twitter'
			);
			$this->args['share_icons'][] = array(
			    'url' => 'http://www.linkedin.com/company/redux-framework',
			    'title' => 'Find us on LinkedIn', 
			    'icon' => 'el-icon-linkedin'
			);

			
	 
			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false ) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace("-", "_", $this->args['opt_name']);
				}
				$this->args['intro_text'] = '';
			} else {
				$this->args['intro_text'] = '';
			}

			// Add content after the form.
			$this->args['footer_text'] = '' ;

		}
	}
	new Redux_Framework_config();

}


/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;
