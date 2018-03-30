<?php

class PeThemeService {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Services",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Service",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Service",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Services','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Services','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Services','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Service','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Service:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Service','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Service','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Service','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Service Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["service"] = $cpt;
		add_action('pe_theme_metabox_config_service',array(&$this,'pe_theme_metabox_config_service'));
	}

	public function pe_theme_metabox_config_service() {

		$mbox = 
			array(
				  "title" => __("Service Info",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"service" => "all"
						),
				  "content" =>
				  array(
						"icon" => 	
						array(
							  "label"=>__("Icon",'Pixelentity Theme/Plugin'),
							  "type"=>"Icon",
							  "default"=>"icon-user"
							  ),
						"features" => 
						array(
							  "label"=>__("Features",'Pixelentity Theme/Plugin'),
							  "type"=>"Links",
							  "description" => __("Add one or more service features.",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "default"=>""
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-service"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"service",
								 "suppress_filters"=>false,
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No service defined.",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

}

?>