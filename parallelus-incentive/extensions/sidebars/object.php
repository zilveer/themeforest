<?php


class Sidebar_Settings_Object extends Runway_Object {

	public $option_key, $sidebars_options;

	public function __construct($settings){
		$this->option_key = $settings['option_key'];
		// must have option "sidebars_list" = array("name" => "name", "alias" => "alias") - list of all registered sidebars
		$this->sidebars_options = get_option( $this->option_key );
		// add_action('init', array($this, 'add_button')); // add shortcode button
		// add_action('admin_print_footer_scripts', array(&$this,'include_shortcode_buttons')); // add shortcode button
		// add_action( 'wp_ajax_get_sidebars', array( $this, 'return_json_sidebars' ) ); // return all sidebars in json. ajax request
		add_action('init', array($this, 'add_shortcodes'));
		add_action('widgets_init', array($this, 'init_sidebars'));
	}

	public function add_shortcodes(){
		add_shortcode('sidebar', array($this, 'sidebar_shortcode'));		
	}
	
	function init_sidebars(){
		// Register each sidebar
	    $sidebars = $this->get_sidebars();

	    if(is_array($sidebars)){
			global $shortname;

			$sidebarName = get_option( $shortname. 'sidebarSettings'); // get name values

			foreach($sidebars as $key => $value){
				$id = $key;
				$name = $value['title'];
				$alias = $value['alias'];
				
				$sidebar_class = $this->name_to_class($alias);
				
				register_sidebar(array(
			    	'name'=>$name,
					'id'=> "generated_sidebar-$id",
			    	'before_widget' => '<div id="%1$s" class="widget scg_widget '.$sidebar_class.' %2$s">',
		   			'after_widget' => '</div>',
		   			'before_title' => '<h4 class="widgetTitle">',
					'after_title' => '</h4>',
		    	));				
			}
		}
	}

	public function update_sidebar($options = array()){
		if(!empty($options)){
			$this->sidebars_options['sidebars_list'][$options['alias']] = $options;
			update_option($this->option_key, $this->sidebars_options);
			return true;
		}
		return false;
	}

	public function delete_sidebar($alias){
		if($alias != ''){
			unset($this->sidebars_options['sidebars_list'][$alias]);
			update_option($this->option_key, $this->sidebars_options);
			return true;
		}
		return false;
	}

	function get_sidebar($alias){
		if($alias != ''){
			return $this->sidebars_options['sidebars_list'][$alias];			
		}
		return false;
	}

	// Called by the action get_sidebar. this is what places this into the theme
	//...............................................
	function get_sidebar_content($index){
		wp_reset_query();
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'customSidebar', true);

		if($selected_sidebar != '' && $selected_sidebar != "0"){
			echo "\n\n<!-- begin generated sidebar [$selected_sidebar] -->\n";
			//echo "<!-- selected: $selected_sidebar -->";
			dynamic_sidebar($selected_sidebar);
			echo "\n<!-- end generated sidebar -->\n\n";			
		}else{
			//dynamic_sidebar($index);			
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($index) ) :
			endif;
		}
	}
	
	// Gets the generated sidebars
	//...............................................
	function get_sidebars(){		
		return $this->sidebars_options['sidebars_list'];
	}
	
	function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}

	// sidebar shortcode callback
	function sidebar_shortcode( $atts, $content = null ) {
		global $wp_registered_sidebars, $wp_registered_widgets;
		extract(shortcode_atts(array(
			'alias' => false
	    ), $atts));	    
		
		if ( $alias ) {
			// find the sidebar ID by the alias
			$sidebars = $this->get_sidebars();
			foreach($sidebars as $key => $value){
				if (isset($value['alias']) && $value['alias'] == $alias) {
					$id = $key;
					break;
				}
			}
		
			if ($id) {
				// turn on output buffering to capture output
				ob_start();
				// generate sidebar
				dynamic_sidebar($id);
				// get output content
				$content = ob_get_clean();
				// return the content
				return $content;
			}
		}

	}

} ?>