<?php

class PeThemeLogo {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Logos",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Logo",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Logo",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Logos','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Logos','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Logos','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Logo','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Logo:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Logo','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Logo','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Logo','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Logo Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["logo"] = $cpt;
		add_action('pe_theme_metabox_config_logo',array(&$this,'pe_theme_metabox_config_logo'));
	}

	public function pe_theme_metabox_config_logo() {

		$mbox = 
			array(
				  "title" => __("Link",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"logo" => "all"
						),
				  "content" =>
				  array(
						"url" => 	
						array(
							  "label"=>__("Url",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>"#"
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-logo"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"logo",
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
			$options = array(__("No logo defined.",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

}

?>