<?php
/**
* Central Template builder class
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

if ( !class_exists( 'AviaBuilder' ) ) {

	class AviaBuilder
	{
		const VERSION = '0.9.1';
		public static $mode = "";
		public static $path = array();
		public static $resources_to_load = array();
		public static $default_iconfont = "";
		public static $full_el = array();
		public static $full_el_no_section = array();
		
		
		public $paths;
		public $shortcode_class;
		public $tabs;
		public $builderTemplate;
		public $disable_drag_drop = false;

		/**
		 * Initializes plugin variables and sets up WordPress hooks/actions.
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->paths['pluginPath'] 	= trailingslashit( dirname( dirname(__FILE__) ) );
			$this->paths['pluginDir'] 	= trailingslashit( basename( $this->paths['pluginPath'] ) );
			$this->paths['pluginUrl'] 	= apply_filters('avia_builder_plugins_url',  plugins_url().'/'.$this->paths['pluginDir']);
			$this->paths['assetsURL']	= trailingslashit( $this->paths['pluginUrl'] ) . 'assets/';
			$this->paths['assetsPath']	= trailingslashit( $this->paths['pluginPath'] ) . 'assets/';
			$this->paths['imagesURL']	= trailingslashit( $this->paths['pluginUrl'] ) . 'images/';
			$this->paths['configPath']	= apply_filters('avia_builder_config_path', $this->paths['pluginPath'] .'config/');
						
			AviaBuilder::$path = $this->paths;
			AviaBuilder::$default_iconfont = apply_filters('avf_default_iconfont', array( 'entypo-fontello' => 
																						array(
																						'append'	=> '?v=3',
																						'include' 	=> $this->paths['assetsPath'].'fonts',
																						'folder'  	=> $this->paths['assetsURL'].'fonts',
																						'config'	=> 'charmap.php',
																						'compat'	=> 'charmap-compat.php', //needed to make the theme compatible with the old version of the font
																						'full_path'	=> 'true' //tells the script to not prepend the wp_upload dir path to these urls
																						)
																					));
		
			add_action('load-post.php', array(&$this, 'admin_init') , 5 );
			add_action('load-post-new.php', array(&$this, 'admin_init') , 5 );
			
			add_action('init', array(&$this, 'loadLibraries') , 5 ); 
			add_action('init', array(&$this, 'init') , 10 );
			
			//restore meta information if user restores a revision
	                add_action('wp_restore_post_revision', array(&$this, 'avia_builder_restore_revision'), 10, 2);
		}
		
		/**
		 *Load all functions that are needed for both front and backend
		 **/
		public function init()
	 	{
	 		if(isset($_GET['avia_mode']))
			{
				AviaBuilder::$mode = esc_attr($_GET['avia_mode']);
			}
	 	
			$this->createShortcode();
			$this->addActions();
            AviaStoragePost::generate_post_type();           
			
			//hook into the media uploader. we always need to call this for several hooks to be active
			new AviaMedia();
			
			//on ajax call load the functions that are usually only loaded on new post and edit post screen
			if(AviaHelper::is_ajax()) 
			{
				if(empty( $_POST['avia_request'] )) return;
                $this->admin_init();
	 	    } 
	 	}
		
		
		/**
		 *Load functions that are only needed on add/edit post screen
		 **/
		public function admin_init()
	 	{
			$this->addAdminFilters();
			$this->addAdminActions();
			$this->loadTextDomain();
			$this->call_classes();
			$this->apply_editor_wrap();
	 	}
	 	
		/**
		 *Load all the required library files.
		 **/
		public function loadLibraries() 
		{			
			require_once( $this->paths['pluginPath'].'php/pointer.class.php' );
			require_once( $this->paths['pluginPath'].'php/shortcode-helper.class.php' ); 
			require_once( $this->paths['pluginPath'].'php/generic-helper.class.php' );
			require_once( $this->paths['pluginPath'].'php/html-helper.class.php' );
			require_once( $this->paths['pluginPath'].'php/meta-box.class.php' );
			require_once( $this->paths['pluginPath'].'php/shortcode-template.class.php' );
			require_once( $this->paths['pluginPath'].'php/media.class.php' );
			require_once( $this->paths['pluginPath'].'php/tiny-button.class.php' );
			require_once( $this->paths['pluginPath'].'php/save-buildertemplate.class.php' );
			require_once( $this->paths['pluginPath'].'php/storage-post.class.php' );
			require_once( $this->paths['pluginPath'].'php/font-manager.class.php' );
			
			
			//autoload files in shortcodes folder and any other folders that were added by filter
			$folders = apply_filters('avia_load_shortcodes', array($this->paths['pluginPath'].'php/shortcodes/'));
			$this->autoloadLibraries($folders);
		}
		
		/**
		 * PHP include all files from a number of folders which are passed as an array
		 * This auoloads all the shortcodes located in php/shortcodes and any other folders that were added by filter
		 **/
		protected function autoloadLibraries($paths)
		{
			foreach ($paths as $path)
			{
				foreach(glob($path.'*.php') as $file)
				{
					require_once( $file ); 
				}
			}
		}
		
		
		/**
		 *Add filters to various wordpress filter hooks
		 **/
		protected function addAdminFilters() 
		{
			//lock drag and drop?
			$this->disable_drag_drop = apply_filters('avf_allow_drag_drop', false);
			
			// add_filter('tiny_mce_before_init', array($this, 'tiny_mce_helper')); // remove span tags from tinymce - currently disabled, doesnt seem to be necessary
			add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
		}
		
		/**
		 *Add Admin Actions to some wordpress action hooks
		 **/
		protected function addAdminActions() {
		
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_styles' ) );
			add_action( 'admin_print_scripts', array($this,'load_shortcode_assets'), 2000);
		    add_action( 'print_media_templates', array($this, 'js_template_editor_elements' )); //create js templates for AviaBuilder Canvas Elements
		    add_action( 'avia_save_post_meta_box', array($this, 'meta_box_save' )); //hook into meta box saving and store the status of the template builder and the shortcodes that are used

		    			
			//custom ajax actions
			add_action('wp_ajax_avia_ajax_text_to_interface', array($this,'text_to_interface'));
		}

		
		/**
		 *Add Actions for the frontend
		 **/
		protected function addActions() {
		
			// Enable shortcodes in widget areas
			add_filter('widget_text', 'do_shortcode');
			
			//default wordpress hooking
			add_action('wp_head', array($this,'load_shortcode_assets'), 2000);
			add_filter( 'template_include' , array($this, 'template_include'), 2000); 
		}
		
		/**
		 *Automatically load assests like fonts into your frontend
		 **/
		public function load_shortcode_assets()
		{
			$output = "";
			$output .= avia_font_manager::load_font();
			
			/* if the builder is decoupled from the theme then make sure to only load iconfonts if they are actually necessary. in enfolds case it is
				
			foreach(AviaBuilder::$resources_to_load as $element)
			{
				if($element['type'] == 'iconfont')
				{
					$output .= avia_font_manager::load_font();
				}
			}
			*/
			
			echo $output;
		}
		
	
		/**
		 *load css and js files when in editable mode
		 **/
		public function admin_scripts_styles()
		{
			$ver = AviaBuilder::VERSION;
			
			#js
			wp_enqueue_script('avia_builder_js', $this->paths['assetsURL'].'js/avia-builder.js', array('jquery','jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-droppable','jquery-ui-datepicker','wp-color-picker','media-editor','post'), $ver, TRUE );
			wp_enqueue_script('avia_element_js' , $this->paths['assetsURL'].'js/avia-element-behavior.js' , array('avia_builder_js'), $ver, TRUE );
			wp_enqueue_script('avia_modal_js' , $this->paths['assetsURL'].'js/avia-modal.js' , array('jquery', 'avia_element_js', 'wp-color-picker'), $ver, TRUE );
			wp_enqueue_script('avia_history_js' , $this->paths['assetsURL'].'js/avia-history.js' , array('avia_element_js'), $ver, TRUE );
			wp_enqueue_script('avia_tooltip_js' , $this->paths['assetsURL'].'js/avia-tooltip.js' , array('avia_element_js'), $ver, TRUE );

			
			#css
			wp_enqueue_style( 'avia-modal-style' , $this->paths['assetsURL'].'css/avia-modal.css');
			wp_enqueue_style( 'avia-builder-style' , $this->paths['assetsURL'].'css/avia-builder.css');
			wp_enqueue_style( 'wp-color-picker' );
			
			#localize strings for javascript
			include_once($this->paths['configPath']."javascript_strings.php");

			if(!empty($strings))
			{
				foreach($strings as $key => $string)
				{
					wp_localize_script( $key, str_replace('_js', '_L10n', $key), $string );
				}
			}
		}
		

		/**
		 *mulilanguage activation
		 **/
		public function loadTextDomain() 
		{
			load_plugin_textdomain( 'avia_framework', false, $this->paths['pluginDir'] . 'lang/');
		}
		
		/**
		 *safe mode or debugging
		 **/
		public function setMode($status = "")
	 	{
			AviaBuilder::$mode = apply_filters('avia_builder_mode', $status);
		}
		
		
		/**
		 *set fullwidth elements that need to interact with section shortcode
		 **/
		public function setFullwidthElements($elements = array())
	 	{
		 	$elements = apply_filters('avf_fwd_elements', $elements);
		 	
			AviaBuilder::$full_el_no_section = $elements;
			AviaBuilder::$full_el = array_merge(array('av_section'), $elements);
		}
		
		
		
		/**
		 *calls external classes that are needed for the script to operate
		 **/
		public function call_classes()
		{
			//create the meta boxes
			new MetaBoxBuilder($this->paths['configPath']);

			// save button
			$this->builderTemplate = new AviaSaveBuilderTemplate($this);
			
			//activate helper function hooks
			AviaHelper::backend();
			
			//create tiny mce button
			$tiny = array(
				'id'			 => 'avia_builder_button',
				'title'			 => __('Insert Theme Shortcode','avia_framework' ),
				'image'			 => $this->paths['imagesURL'].'tiny-button.png',
				'js_plugin_file' => $this->paths['assetsURL'].'js/avia-tinymce-buttons.js',
				'shortcodes'	 => array_map(array($this, 'fetch_configs'), $this->shortcode_class)
			);
			
			//if we are using tinymce 4 or higher change the javascript file
			global $tinymce_version;
			
			if(version_compare($tinymce_version[0], 4, ">="))
			{
				$tiny['js_plugin_file'] = $this->paths['assetsURL'].'js/avia-tinymce-buttons-4.js';
			}

			new avia_tinyMCE_button($tiny);
			
			//activate iconfont manager
			new avia_font_manager();
			
		
		    //fetch all Wordpress pointers that help the user to use the builder
			include($this->paths['configPath']."pointers.php");
			$myPointers = new AviaPointer($pointers);
		}
		
		/**
		 *array mapping helper that returns the config arrays of a shortcode
		 **/
		 
		public function fetch_configs($array)
		{
			return $array->config;
		}
        
        /**
		 *class that adds an extra class to the body if the builder is active	
		 **/
        public function admin_body_class($classes)
        {
	        global $post_ID;
	        
	        if(!empty($post_ID) && AviaHelper::builder_status($post_ID))
	        {
	        	$classes .= ' avia-advanced-editor-enabled ';
	        }
	        
	        if($this->disable_drag_drop == true)
	        {
		        $classes .= ' av-no-drag-drop ';
	        }
	        
	        return $classes;
        }
        

	 	
	 	/**
		 *automatically load all child classes of the aviaShortcodeTemplate class and create an instance
		 **/
	 	public function createShortcode()
	 	{
	 		$children  = array();
			foreach(get_declared_classes() as $class)
			{
			    if(is_subclass_of($class, 'aviaShortcodeTemplate'))
			    {
			    	 $allow = false;
			    	 $children[] = $class;
			    	 $this->shortcode_class[$class] = new $class($this);
			    	 $shortcode = $this->shortcode_class[$class]->config['shortcode'];
			    	 
			    	 //check if the shortcode is allowed. if so init the shortcode, otherwise unset the item
			    	 if( empty(ShortcodeHelper::$manually_allowed_shortcodes) && empty(ShortcodeHelper::$manually_disallowed_shortcodes) ) $allow = true;
			    	 if( !$allow && !empty(ShortcodeHelper::$manually_allowed_shortcodes) && in_array($shortcode, ShortcodeHelper::$manually_allowed_shortcodes)) $allow = true;
			    	 if( !$allow && !empty(ShortcodeHelper::$manually_disallowed_shortcodes) && !in_array($shortcode, ShortcodeHelper::$manually_disallowed_shortcodes)) $allow = true;
			    	 
			    	 
			    	 if($allow)
			    	 {
			    	 	$this->shortcode_class[$class]->init();
			    	 	$this->shortcode[$this->shortcode_class[$class]->config['shortcode']] = $class;
			    	 	
			    	 	//save shortcode as allowed by default. if we only want to display the shortcode in tinymce remove it from the list but keep the class instance alive
			    	 	if(empty($this->shortcode_class[$class]->config['tinyMCE']['tiny_only']))
			    	 	{
			    			ShortcodeHelper::$allowed_shortcodes[] = $this->shortcode_class[$class]->config['shortcode'];
			    		}
			    		
			    		//save nested shortcodes if they exist
			    		if(isset($this->shortcode_class[$class]->config['shortcode_nested'])) 
			    		{
			    			ShortcodeHelper::$nested_shortcodes = array_merge(ShortcodeHelper::$nested_shortcodes, $this->shortcode_class[$class]->config['shortcode_nested']);
			    	 	}
			    	 }
			    	 else
			    	 {
			    	 	unset($this->shortcode_class[$class]);
			    	 }
			    }
			}
	 	}

		
		/**
		 *create JS templates
		 **/
		public function js_template_editor_elements()
		{
			foreach($this->shortcode_class as $shortcode)
			{
				$class 	= $shortcode->config['php_class'];
				$template = $this->shortcode_class[$class]->prepare_editor_element();
				
				if(is_array($template)) continue;
				
				echo "\n<script type='text/html' id='avia-tmpl-{$class}'>\n";
				echo $template;
				echo "\n</script>\n\n";
			}

		}
		
		
		/**
		 *set status of builder (open/closed) and save the shortcodes that are used in the post
		 **/
		public function meta_box_save()
		{

            if(isset($_POST['post_ID']))
            {
                //save if the editor is active
                if(isset($_POST['aviaLayoutBuilder_active'])) 
                {
                    update_post_meta((int) $_POST['post_ID'], '_aviaLayoutBuilder_active', $_POST['aviaLayoutBuilder_active']);
                    $_POST['content'] = ShortcodeHelper::clean_up_shortcode($_POST['content']);
                }
                
                //save the hidden container with unmodified shortcode
                if(isset($_POST['_aviaLayoutBuilderCleanData'])) 
                {
                	update_post_meta((int) $_POST['post_ID'], '_aviaLayoutBuilderCleanData', $_POST['_aviaLayoutBuilderCleanData']);
                }
                

                //extract all shortcodes from the post array and store them so we know what we are dealing with when the user opens a page. 
                //usesfull for special elements that we might need to render outside of the default loop like fullscreen slideshows
			    preg_match_all("/".ShortcodeHelper::get_fake_pattern()."/s", $_POST['content'], $matches);
	
			    if(is_array($matches) && !empty($matches[0]))
			    {
                    $matches = ShortcodeHelper::build_shortcode_tree($matches);
                    update_post_meta((int) $_POST['post_ID'], '_avia_builder_shortcode_tree', $matches);
			    }
            }
		}
		
		
		
		/**
		 *function that checks if a dynamic template exists and uses that template instead of the default page template
		 **/
    	public function template_include( $original_template )
    	{	
    		global $avia_config;
    	
    	   	$post_id = @get_the_ID();
    	   	
    	   	if(is_feed()) return;
    	   	
    	   	if(($post_id && is_singular()) || isset($avia_config['builder_redirect_id']))
    	   	{
			   if(!empty($avia_config['builder_redirect_id'])) $post_id = $avia_config['builder_redirect_id'];
    	   	
    	   	   ShortcodeHelper::$tree = get_post_meta($post_id, '_avia_builder_shortcode_tree', true);
				
    	   	   if('active' == AviaHelper::builder_status($post_id) && $template = locate_template('template-builder.php', false))
    	   	   {
    	   	   		$avia_config['conditionals']['is_builder'] = true;
    	   	   
    	   	   		//only redirect if no custom template is set
    	   	   		$template_file = get_post_meta($post_id, '_wp_page_template', true);
    	   	   		
    	   	   		if("default" == $template_file || empty($template_file))
    	   	   		{
    	   	   			$avia_config['conditionals']['is_builder_template'] = true;
    	   	   			return $template;
    	   	   		}
    	   	   }
    	   	   
    	   	   //if a custom page was passed and the template builder is not active redirect to the default page template
    	   	   if(isset($avia_config['builder_redirect_id']))
    	   	   {
    	   	   		if($template = locate_template('page.php', false))
    	   	   		{
    	   	   			return $template;
    	   	   		}
    	   	   }
    	   	}
    	   	
    	   	return $original_template;
    	}
    	
    	public function apply_editor_wrap()
    	{
    		//fetch the config array
    		include($this->paths['configPath']."meta.php");
    		
    		$slug = "";
    		$pages = array();
    		//check to which pages the avia builder is applied
    		foreach($elements as $element)
    		{
    			if(is_array($element['type']) && $element['type'][1] == 'visual_editor')
    			{
    				$slug = $element['slug']; break;
    			}
    		}
    		
    		foreach($boxes as $box)
    		{
    			if($box['id'] == $slug)
    			{
    				$pages = $box['page'];
    			}
    		}
    		global $typenow;
    		
    		if(!empty($pages) && in_array($typenow, $pages))
    		{	    
		    	//html modification of the admin area: wrap
		    	add_action( 'edit_form_after_title', array($this, 'wrap_default_editor' ), 100000); 
		    	add_action( 'edit_form_after_editor', array($this, 'close_default_editor_wrap' ), 1); 
		    }
    	}
    	
				
		public function wrap_default_editor()
		{
            global $post_ID;
			
            $status         = AviaHelper::builder_status($post_ID);
            $params 		= apply_filters('avf_builder_button_params', 
            			    	array(	'disabled'		=>false, 
           				    			'note' 			=> "", 
           				    			'noteclass'		=> "",
               			    			'button_class'	=>'',
               			    			'visual_label'  => __( 'Advanced Layout Editor', 'avia_framework' ),
               			    			'default_label' => __( 'Default Editor', 'avia_framework' )
               						)
               					);
               					 
            
            if($params['disabled']) { $status = false; }
            $active_builder = $status == "active" ? $params['default_label'] : $params['visual_label'];		
            $editor_class   = $status == "active" ? "class='avia-hidden-editor'" : "";
            $button_class   = $status == "active" ? "avia-builder-active" : "";
                
            
            
            echo "<div id='postdivrich_wrap' {$editor_class}>";
            
            if($this->disable_drag_drop == false)
			{
            echo '<a id="avia-builder-button" href="#" class="avia-builder-button button-primary '.$button_class.' '.$params['button_class'].'" data-active-button="'.$params['default_label'].'" data-inactive-button="'.$params['visual_label'].'">'.$active_builder.'</a>';
            }
            if($params['note']) echo "<div class='av-builder-note ".$params['noteclass']."'>".$params['note']."</div>";
            
		}
		
		public function close_default_editor_wrap()
		{
           echo "</div>";
		}
		
		
		/**
		 * function called by the metabox class that creates the interface in your wordpress backend
		 **/
		public function visual_editor($element)
		{
			$output = "";
			$title  = "";
			$i = 0;
			
			$this->shortcode_buttons = apply_filters('avia_show_shortcode_button', array());	
			
			
			if(!empty($this->shortcode_buttons) && $this->disable_drag_drop == false)
			{
				$this->tabs = isset($element['tab_order']) ? array_flip($element['tab_order']) : array();
				foreach($this->tabs as &$empty_tabs) $empty_tabs = array();
				
				
				foreach ($this->shortcode_buttons as $shortcode)
				{
					if(empty($shortcode['tinyMCE']['tiny_only']))
					{
						if(!isset($shortcode['tab'])) $shortcode['tab'] = __("Custom Elements",'avia_framework' );
						
						$this->tabs[$shortcode['tab']][] = $shortcode;
					}
				}

				foreach($this->tabs as $key => $tab)
				{
					if(empty($tab)) continue;
					
					usort($tab,array($this, 'sortByOrder'));
				
					$i ++;
					$title .= "<a href='#avia-tab-$i'>".$key."</a>";
					
					$output .= "<div class='avia-tab avia-tab-$i'>";
					
					foreach ($tab as $shortcode)
					{
						if(empty($shortcode['invisible']))
						{
							$output .= $this->create_shortcode_button($shortcode);
						}
					}
					
					$output .= "</div>";
				}
			}
			
			global $post_ID;
			$active_builder  = AviaHelper::builder_status($post_ID);
			
			
			$extra = AviaBuilder::$mode != true ? "" : "avia_mode_".AviaBuilder::$mode;
			$hotekey_info = htmlentities($element['desc'], ENT_QUOTES, get_bloginfo( 'charset' ));
			
			$output  = '<div class="shortcode_button_wrap avia-tab-container"><div class="avia-tab-title-container">'.$title.'</div>'.$output.'</div>';
			$output .= '<input type="hidden" value="'.$active_builder.'" name="aviaLayoutBuilder_active" id="aviaLayoutBuilder_active" />';
			
			if($this->disable_drag_drop == false)
			{
			$output .= '<a href="#info" class="avia-hotkey-info" data-avia-help-tooltip="'.$hotekey_info.'">'.__('Information', 'avia_framework' ).'</a>';
			$output .= $this->builderTemplate->create_save_button();
			}
			
			$output .= "<div class='layout-builder-wrap {$extra}'>";
			
			if($this->disable_drag_drop == false)
			{
				$output .= "	<div class='avia-controll-bar'></div>";
			}
			
			$output .= "	<div id='aviaLayoutBuilder' class='avia-style avia_layout_builder avia_connect_sort preloading av_drop' data-dragdrop-level='0'>";
			$output .= "	</div>";
			
			
			$clean_data = get_post_meta($post_ID, '_aviaLayoutBuilderCleanData', true);
			// $clean_data = htmlentities($clean_data, ENT_QUOTES, get_bloginfo( 'charset' )); //entity-test: added htmlentities
			
			$output .= "	<textarea id='_aviaLayoutBuilderCleanData' name='_aviaLayoutBuilderCleanData'>".$clean_data."</textarea>"; 
			$output .= "</div>";
			
			return $output;
		}	
		
		
        
		
	   
	   
	    /*create a shortcode button*/
		protected function create_shortcode_button($shortcode)
		{
			$class  = "";
			
			if(!empty($shortcode['posttype']) && $shortcode['posttype'][0] != AviaHelper::backend_post_type())
			{
				$shortcode['tooltip'] = $shortcode['posttype'][1];
				$class .= "av-shortcode-disabled ";
			}
			
			
			$icon   = isset($shortcode['icon']) ? '<img src="'.$shortcode['icon'].'" alt="'.$shortcode['name'].'" />' : "";
			$data   = !empty($shortcode['tooltip']) ? " data-avia-tooltip='".$shortcode['tooltip']."' " : "";
			$data  .= !empty($shortcode['drag-level']) ? " data-dragdrop-level='".$shortcode['drag-level']."' " : "";
			$class .= isset($shortcode['class']) ? $shortcode['class'] : "";
            $class .= !empty($shortcode['target']) ? " ".$shortcode['target'] : "";

			
			
			
			
			$link   = "";
			$link  .= "<a {$data} href='#".$shortcode['php_class']."' class='shortcode_insert_button ".$class."' >".$icon.'<span>'.$shortcode['name']."</span></a>";
			
			return $link;
		}
		
		
		/*helper function to sort the shortcode buttons*/
		protected function sortByOrder($a, $b) 
		{
			if(empty($a['order'])) $a['order'] = 10;
			if(empty($b['order'])) $b['order'] = 10;
			
   			return $b['order'] >= $a['order'];
		}

		
		
		
		public function text_to_interface($text = NULL)
		{
			global $shortcode_tags;
			
			$allowed = false;
			
			if(isset($_POST['text'])) $text = $_POST['text']; //isset when avia_ajax_text_to_interface is executed (avia_builder.js)
			if(isset($_POST['params']) && isset($_POST['params']['allowed'])) $allowed = explode(',',$_POST['params']['allowed']); //only build pattern with a subset of shortcodes
			
			
			
			//build the shortcode pattern to check if the text that we want to check uses any of the builder shortcodes
			ShortcodeHelper::build_pattern($allowed);
			$text_nodes = preg_split("/".ShortcodeHelper::$pattern."/s", $text);
			
			
			foreach($text_nodes as $node ) 
			{			
	            if( strlen( trim( $node ) ) == 0 || strlen( trim( strip_tags($node) ) ) == 0) 
	            {
	               //$text = preg_replace("/(".preg_quote($node, '/')."(?!\[\/))/", '', $text);
	            }
	            else
	            {
	               $text = preg_replace("/(".preg_quote($node, '/')."(?!\[\/))/", '[av_textblock]$1[/av_textblock]', $text);
	            }
	        }
	        
			$text = $this->do_shortcode_backend($text);
			
			if(isset($_POST['text']))
			{
				echo $text;
				exit();
			}
			else
			{
				return $text;
			}
		}
		
		
		public function do_shortcode_backend($text)
		{
			return preg_replace_callback( "/".ShortcodeHelper::$pattern."/s", array($this, 'do_shortcode_tag'), $text );
		}

		
		public function do_shortcode_tag( $m ) 
		{
	        global $shortcode_tags;
			
	        // allow [[foo]] syntax for escaping a tag
	        if ( $m[1] == '[' && $m[6] == ']' ) {
	                return substr($m[0], 1, -1);
	        }
			
			//check for enclosing tag or self closing
			$values['closing'] 	= strpos($m[0], '[/'.$m[2].']');
			$values['content'] 	= $values['closing'] !== false ? $m[5] : NULL;
	        $values['tag']		= $m[2];
	        $values['attr']		= shortcode_parse_atts( stripslashes($m[3]) );
	        
	        if(is_array($values['attr']))
	        {
		        $charset = get_bloginfo( 'charset' );
		        foreach($values['attr'] as &$attr)
		        {
		        	$attr =	htmlentities($attr, ENT_QUOTES, $charset);
		        }
			}
			
	        if(isset($_POST['params']['extract']))
	        {
	        	//if we open a modal window also check for nested shortcodes
	        	if($values['content']) $values['content'] = $this->do_shortcode_backend($values['content']);
	        	
	        	$_POST['extracted_shortcode'][] = $values;
	        	return $m[0];
	        }
			
			if(in_array($values['tag'], ShortcodeHelper::$allowed_shortcodes))
			{
				return $this->shortcode_class[$this->shortcode[$values['tag']]]->prepare_editor_element( $values['content'], $values['attr'] );
			}
			else
			{
				return $m[0];
			}
		}
		
		
		
		/**
		 * this helper function tells the tiny_mce_editor to remove any span tags that dont have a classname (list insert on ajax tinymce tend do add them)
		 * see more: http://martinsikora.com/how-to-make-tinymce-to-output-clean-html
		 */
		 
		public function tiny_mce_helper($mceInit)
		{
			$mceInit['extended_valid_elements'] = empty($mceInit['extended_valid_elements']) ? "" : $mceInit['extended_valid_elements'] .","; 
			$mceInit['extended_valid_elements'] = "span[!class]";
			return $mceInit;
		}
		
		
		
		/**
	         * Helper function that restores the post meta if user restores a revision
	         * see: https://lud.icro.us/post-meta-revisions-wordpress
	         */
	        function avia_builder_restore_revision( $post_id, $revision_id )
	        {
	            //$post     = get_post($post_id);
	            $revision = get_post($revision_id);
	            $meta_fields = array('_aviaLayoutBuilderCleanData', '_avia_builder_shortcode_tree');
	
	            foreach($meta_fields as $meta_field)
	            {
	                $builder_meta_data  = get_metadata( 'post', $revision->ID, $meta_field, true );
	
	                if (!empty($builder_meta_data))
	                {
	                    update_post_meta($post_id, $meta_field, $builder_meta_data);
	                }
	                else
	                {
	                    delete_post_meta($post_id, $meta_field);
	                }
	            }
	        }
		


	} // end class

} // end if !class_exists
