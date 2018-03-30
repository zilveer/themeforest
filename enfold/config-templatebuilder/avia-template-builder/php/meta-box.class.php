<?php
/**
* Central Metabox builder class with a twist: allows creation of fullscreen meta boxes
*/

// Don't load directly
if ( !defined('ABSPATH') ) { die('-1'); }

if ( !class_exists( 'MetaBoxBuilder' ) ) {

	class MetaBoxBuilder 
	{
		var $configPath;
	
		function __construct($configPath)
		{	
			$this->configPath = $configPath;
			
			add_action('load-post.php', array(&$this, 'setUp'));
			add_action('load-post-new.php', array(&$this, 'setUp'));
			
		}
	 
	 	function setUp()
	 	{
	 		$this->add_actions();
	 		$this->get_params();
	 		$this->init_boxes();	
	 	}
	 	
	 	function add_actions()
	 	{
	 		add_action('admin_menu', array(&$this, 'init_boxes'));
			add_action('save_post', array(&$this, 'save_post'),10,2);
			add_action('wp_print_scripts',array(&$this, 'add_js_info'));
	 	}
	 	
	 	function get_params()
	 	{
	 		require($this->configPath.'meta.php');
	 	
	 		if(isset($boxes)) 	 $this->default_boxes = apply_filters('avia_builder_metabox_filter',$boxes);
			if(isset($elements)) $this->box_elements  = apply_filters('avia_builder_metabox_element_filter',$elements);
	 	}
	 	
	 	function add_js_info()
	 	{
	 		$theme = wp_get_theme();
	 		
	 		global $post_ID;
			echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
			echo "var avia_globals = avia_globals || {};\n";
			echo "    avia_globals.post_id = '".$post_ID."';\n";
			echo "    avia_globals.themename = '".$theme->get('Name')."';\n";
			echo "    avia_globals.themeversion = '".$theme->get('Version')."';\n";
			echo "    avia_globals.builderversion = '".AviaBuilder::VERSION."';\n";
			echo "    avia_globals.builderMode = '".AviaBuilder::$mode."';\n";
			echo "/* ]]> */ \n";
			echo "</script>\n \n ";
	 	}
	
	
		/**
		 * Meta Box initialization
		 */
		function init_boxes()
		{	
			//load the options array
			if(!empty($this->default_boxes) && !empty($this->box_elements))
			{ 
				//loop over the box array
				foreach($this->default_boxes as $key => $box)
				{				
					foreach ($box['page'] as $area)
					{	
						//class filter for expanded items
						if(!empty($box['expandable']))
						{
							if(!empty($_GET['avia-expanded']) && $_GET['avia-expanded'] === $box['id'])
							{
								add_filter( "postbox_classes_{$area}_{$box['id']}" , array($this, 'add_meta_box_class')); //postbox class filter
							}
						}
						
						global $post_ID;
			
						//class filter for hiden items
						if(('avia_builder' === $box['id'] && isset($_GET['post']) && AviaHelper::builder_status($_GET['post']) != 'active') || ('avia_builder' === $box['id'] && empty($_GET['post'])))
						{
							add_filter( "postbox_classes_{$area}_{$box['id']}" , array($this, 'add_meta_box_hidden')); //postbox class filter
						}
						
						//meta box creation
						$box['iteration'] = $key;	
									
						add_meta_box( 	
							$box['id'], 							// HTML 'id' attribute of the edit screen section 
							$box['title'],							// Title of the edit screen section, visible to user 
							array(&$this, 'create_meta_box'),		// Function that prints out the HTML for the edit screen section. 
							$area, 									// The type of Write screen on which to show the edit screen section ('post', 'page', etc) 
							$box['context'], 						// The part were box is shown: ('normal', 'advanced', or 'side').				
							$box['priority'],						// The priority within the context where the boxes should show ('high' or 'low')
							array('avia_current_box'=>$box) 		// callback arguments so we know which box we are in
						); 
					}
				}
			}
		}
		
		
		function create_meta_box($currentPost, $metabox)
		{
			global $post;
			$output = "";
			$box = $metabox['args']['avia_current_box'];
		
			if(!is_object($post)) return;			
			
			if(!empty($box['expandable']))
			{
				$title = __('Expand','avia_framework' )." ".$box['title'];
				$close = __('Close','avia_framework' );
				$output .= "<a href='#' class='avia-expand-button avia-attach-expand' title='".$title."'>".$close."</a>";
			}
			
			//calls the helping function based on value of 'type'
			foreach ($this->box_elements as $element)
			{	
				$content = "";
				$element['current_post'] = $currentPost->ID;
			
				if($element['slug'] == $box['id'])
				{
					if(is_array($element['type']) && method_exists($element['type'][0], $element['type'][1]))
					{
						$content = call_user_func($element['type'], $element);
					} 
					else if (method_exists('AviaHtmlHelper', $element['type']))
					{	
						$content = AviaHtmlHelper::render_metabox($element);
					}
				}
				
				if(!empty($content))
				{	
					if(!empty($element['nodescription']))
					{
						$output .= $content;
					}
					else
					{
						$type = is_array($element['type']) ? $element['type'][1] : $element['type'];
						
						$output .= '<div class="avia_scope avia_meta_box avia_meta_box_'.$type.' meta_box_'.$box['context'].'">';
						$output .= $content;
						$output .= '</div>';
					}
				}
				
			}

			
			$nonce	= 			wp_create_nonce ('avia_nonce_save');
			$output .= '		<input type="hidden" name="avia-save-nonce" id="avia-save-nonce" value="'.$nonce.'" />';
			
			echo $output;		
		} 
		// end create
		
		
		
		
		function save_post($id, $post_object)
		{
			// dont run if the post array is no set
			if(empty($_POST) || empty($_POST['post_ID'])) 
				return;
			
			// don't run the saving if this is an auto save
		    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		        return;
		
		    // don't run the saving if the function is called for saving revision.
		    if ( $post_object->post_type == 'revision' )
		        return;
		        
		    // don't run the saving if no meta box was attached to this post type
			foreach($this->default_boxes as $default_box)
			{
				if(in_array( $_POST['post_type'] ,$default_box['page'])) $must_check = true;
			}
	
			if(empty($must_check)) return;
			
			
			// don't run the saving if the nonce field was not submitted
			check_ajax_referer('avia_nonce_save','avia-save-nonce');
			
			
			// provide a hook for some additional data manipulation were userers can modify the $_POST array or save additional information
			do_action('avia_save_post_meta_box');
			
			// all checks passed. now save all item values that were passed
			
			foreach($this->box_elements as $box)
			{
				if(isset($box['type']) && ($box['type'] == 'fake' || $box['type'] == 'checkbox'))
				{
					if(empty($_POST[$box['id']])) $_POST[$box['id']] = 0;
				}
				
				foreach($_POST as $key=>$value)
				{
					if($key === $box['id'])
					{		
						update_post_meta($id , $key, $_POST[$key]);					
					}
				}
			}
			

			//filter the redirect url in case we got a metabox that is expanded. in that case append some POST paramas
			if(!empty($_POST['avia-expanded-hidden']))
			{
				add_filter('redirect_post_location', array($this, 'add_expanded_param'),10,2);
			}
		}
		// end save
		
		
		function add_meta_box_class($class)
		{
			$class[] = "avia-expanded";
			return $class;
		}
		
		function add_meta_box_hidden($class)
		{
			$class[] = "avia-hidden";
			return $class;
		}
		
		function add_expanded_param($location, $id)
		{
			$location .= "&avia-expanded=".$_POST['avia-expanded-hidden'];
			return $location;
		}
	
	} // end class
	

} // end if !class_exists













