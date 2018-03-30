<?php

class PeThemeStaff {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Staff Members",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Staff Member",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Staff Member",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Staff Members','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Staff Members','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Staff Members','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Staff Member','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Staff Member:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Staff Member','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Staff Member','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Staff Member','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Staff Member Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor","thumbnail"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["staff"] = $cpt;
		add_action('pe_theme_metabox_config_staff',array(&$this,'pe_theme_metabox_config_staff'));
	}

	public function pe_theme_metabox_config_staff() {

		$mbox = 
			array(
				  "title" => __("Personal Info",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"staff" => "all"
						),
				  "content" =>
				  array(
						"position" => 	
						array(
							  "label"=>__("Position",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>__("Founder/Partner",'Pixelentity Theme/Plugin')
							  ),
						"social" => 
						array(
							  "label"=>__("Social Links",'Pixelentity Theme/Plugin'),
							  "type"=>"Items",
							  "description" => __("Add one or more links to social networks.",'Pixelentity Theme/Plugin'),
							  "button_label" => __("Add Social Link",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "auto" => __("Layer",'Pixelentity Theme/Plugin'),
							  "unique" => false,
							  "editable" => false,
							  "legend" => false,
							  "fields" => 
							  array(
									array(
										  "label" => __("Social Network",'Pixelentity Theme/Plugin'),
										  "name" => "icon",
										  "type" => "select",
										  "options" => apply_filters('pe_theme_social_icons',array()),
										  "width" => 185,
										  "default" => ""
										  ),
									array(
										  "name" => "url",
										  "type" => "text",
										  "width" => 300, 
										  "default" => "#"
										  )
									),
							  "default" => ""
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-staff"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"staff",
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
			$options = array(__("No staff member defined.",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

}

?>