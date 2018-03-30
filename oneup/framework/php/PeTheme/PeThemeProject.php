<?php

class PeThemeProject {

	protected $master;
	protected $portfolioLoop;

	public $custom = "project";
	public $taxonomy = "prj-category";
	public $emtpyMsg;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->emptyMsg = __("No project defined, please create one",'Pixelentity Theme/Plugin');
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>$this->custom,
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
			$options = array($this->emptyMsg=>-1);
		}
		return $options;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Projects",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Project",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Project",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Projects','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Projects','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Projects','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Project','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Project:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Project','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Project','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Project','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Project Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor","thumbnail","post-formats"),
				  "taxonomies" => array("post_format")
				  );

		$tax = 
			array(
				  'project',
				  array(
						'label' => __('Project Tags','Pixelentity Theme/Plugin'),
						'sort' => true,
						'args' => array('orderby' => 'term_order' ),
						'show_in_nav_menus' => false,
						'rewrite' => array('slug' => 'projects' )
						)
				  );

		PeGlobal::$config["post_types"]["project"] =& $cpt;
		PeGlobal::$config["taxonomies"]["prj-category"] =& $tax;
		add_action('pe_theme_metabox_config_project',array(&$this,'pe_theme_metabox_config_project'));
	}

	public function pe_theme_metabox_config_project() {
		$opts = array_combine(range(1,10),range(1,10));

		$mbox = 
			array(
				  "title" => __("Portfolio",'Pixelentity Theme/Plugin'),
				  "type" => "Conditional",
				  "context" => "side",
				  "priority" => "core",
				  "options" => 
				  array(
						"lightbox" =>
						array(
							  "yes" => 
							  array(
									"show" => "title,description"
									),
							  "no" => 
							  array(
									"hide" => "title,description"
									)
							  )
						),
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"image" => 
						array(
							  "label"=>__("Thumbnail",'Pixelentity Theme/Plugin'),
							  "type"=>"Upload",
							  "description" => __("Custom image to be used as thumbnail when project is shown inside a portfolio view. If not set, featured image will be used.",'Pixelentity Theme/Plugin'),
							  "default"=>""
							  ),
						"layout" => 
						array(
							  "label"=>__("Layout",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Cell layout when shown in portoflio grid. Format is WxH where W = columns and H = rows.",'Pixelentity Theme/Plugin'),
							  "default"=> "1x1"
							  ),
						"ptitle" => 
						array(
							  "label"=>__("Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Used as project title when shown inside a portfolio section, leave empty to use project title.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"pdescription" => 
						array(
							  "label"=>__("Description",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "height" => 100,
							  "description" => __("Used as project description when shown inside a portfolio section, leave empty to hide.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"lightbox" => 
						array(
							  "label"=>__("Lightbox",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __("If set to \"yes\", opens a lightbox when the image is clicked in portoflio grid. Use \"no\" to load the project page.",'Pixelentity Theme/Plugin'),
							  "options" => Array(__("Yes",'Pixelentity Theme/Plugin')=>"yes",__("No",'Pixelentity Theme/Plugin')=>"no"),
							  "default"=> "yes"
							  ),
						"title" => 
						array(
							  "label"=>__("LB Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "description" => __("Lightbox caption title. Ignored for gallery/video project types.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"description" => 
						array(
							  "label"=>__("LB Description",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "height" => 100,
							  "description" => __("Lightbox caption description. Ignored for gallery/video project types.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						)
				  );

		$mboxInfo = 
			array(
				  "title" => __("Project Info",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"props" => 
						array(
							  "label"=>__("Properties",'Pixelentity Theme/Plugin'),
							  "type"=>"Items",
							  "section"=>__("Header",'Pixelentity Theme/Plugin'),
							  "description" => __("Add one or more property to the project data section.",'Pixelentity Theme/Plugin'),
							  "button_label" => __("Add Property",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "auto" => __("Date",'Pixelentity Theme/Plugin'),
							  "unique" => false,
							  "editable" => false,
							  "legend" => true,
							  "fields" => 
							  array(
									array(
										  "label" => __("Name",'Pixelentity Theme/Plugin'),
										  "name" => "name",
										  "type" => "text",
										  "width" => 185,
										  "default" => __("Date",'Pixelentity Theme/Plugin')
										  ),
									array(
										  "label" => __("Value",'Pixelentity Theme/Plugin'),
										  "name" => "value",
										  "type" => "text",
										  "width" => 300, 
										  "default" => __("Jun 2013",'Pixelentity Theme/Plugin')
										  )
									),
							  "default" => ""
							  )
						)
				  );

		PeGlobal::$config["metaboxes-project"]["portfolio"] =& $mbox;
		PeGlobal::$config["metaboxes-project"]["info"] =& $mboxInfo;
	}


	public function &get($id) {
		if (isset($this->cache[$id])) return $this->cache[$id];
		$post =& get_post($id);
		if (!$post) return false;
		$meta =& $this->master->meta->get($id,$post->post_type);
		$post->meta = $meta;
		return $post;
	}

	public function exists($id) {
		return $this->get($id) !== false;
		
	}

	public function filter($sep = "",$aclass="label") {
		return $this->master->content->filter($this->taxonomy,$sep,$aclass);
	}

	public function filterClasses() {
		return $this->master->content->filterClasses($this->taxonomy);
	}

	public function tags($sep=", ") {
		echo get_the_term_list(null, $this->taxonomy, "", $sep,"");
	}


	public function filterNames() {
		global $post;
		$names = wp_get_post_terms($post->ID,$this->taxonomy,array("fields" => "names"));
		if (is_array($names) && ($count = count($names)) > 0) {
			echo join(", ",$names);
		}
	}

	public function customLoop($count,$tags,$paged) {
		$custom = null;
		if (is_array($tags) && count($tags) > 0) {
			$custom[$this->taxonomy] = join(",",$tags);
		}
		return $this->master->content->customLoop($this->custom,$count,null,$custom,$paged);
	}

}

?>
