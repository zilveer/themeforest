<?php

class PeThemeTestimonial {

	public $master;
	public $slug = "testimonial";

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Testimonials",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Testimonial",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Testimonial",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Testimonials','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Testimonials','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Testimonials','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Testimonial','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Testimonial:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Testimonial','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Testimonial','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Testimonial','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Testimonial Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"][$this->slug] = $cpt;
		add_action('pe_theme_metabox_config_testimonial',array(&$this,'pe_theme_metabox_config_testimonial'));
	}

	public function pe_theme_metabox_config_testimonial() {

		$mbox = 
			array(
				  "title" => __("Info",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"staff" => "all"
						),
				  "content" =>
				  array(
						"type" => 	
						array(
							  "label"=>__("Type",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>__("Web Client",'Pixelentity Theme/Plugin')
							  )
						)
				  );

		PeGlobal::$config["metaboxes-".$this->slug] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function customLoop($id) {
		return $this->master->content->customLoop($this->slug,-1,null,array("post__in" => $id,"orderby" => "post__in"),false);
	}


	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>$this->slug,
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No testimonial defined.",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

}

?>