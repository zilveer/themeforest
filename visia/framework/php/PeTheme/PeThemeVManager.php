<?php

class PeThemeVManager {

	protected $master;
	protected $_views;
	protected $_post_types;
	protected $_taxonomies;
	public $resized = false;

	public function __construct(&$master) {
		$this->master =& $master;
		add_action("pe_theme_admin_quicknav_options_view",array($this,"pe_theme_admin_quicknav_options_view"));
		if (PE_THEME_PLUGIN_MODE) {
			add_filter("the_content",array($this,"the_content_filter"));
		}
	}

	public function the_content_filter($html) {
		if ($this->active) return $html;
		$this->active = true;
		if (is_page()) {
			$content =& $this->master->content;
			$meta =& $content->meta();
			if (!empty($meta->builder)) {
				ob_start();
				$content->builder();
				$builder = ob_get_clean();
				$html .= $builder;
			}
		}
		$this->active = false;
		return $html;
	}


	public function pe_theme_admin_quicknav_options_view($options) {
		return $this->option(false);
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.view.js",array("jquery","pe_theme_utils"),"pe_theme_view");
	}

	public function post_types() {
		if (!isset($this->_post_types)) {
			foreach (get_post_types('','objects') as $name=>$pt) {
				if (in_array($name,array("revision","nav_menu_item","view","gallery"))) continue;
				$this->_post_types[$name] = $pt;

				foreach (get_object_taxonomies($name,'objects') as $taxslug => $tax) {
					$this->_taxonomies[$name][$taxslug] = $tax;
				}
			}
		}

		return $this->_post_types;
	}

	public function taxonomies($post_type = null) {
		$this->post_types();
		return empty($post_type) ? $this->_taxonomies : (isset($this->_taxonomies[$post_type]) ? $this->_taxonomies[$post_type] : array());
	}

	public function taxonomiesOptions() {
		$options = array(__("None",'Pixelentity Theme/Plugin') => "");
		foreach ($this->_taxonomies as $name => $taxonomy) {
			foreach ($taxonomy as $slug => $tax) {
				$options[$tax->label] = $slug;
			}
		}
		return $options;
	}

	public function views() {
		
		if (!isset($this->_views)) {
			foreach (PeGlobal::$config["views"] as $name) {
				$class = "PeThemeView$name";
				$this->_views[$name] = new $class;
			}
		}

		return $this->_views;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Views",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("View",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New View",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Views','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Views','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Views','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent View','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent View:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit View','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update View','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New View','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New View Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title"),
				  "taxonomies" => array()
				  );

		PeGlobal::$config["post_types"]["view"] =& $cpt;

		add_action('add_meta_boxes_view',array(&$this,'add_meta_boxes_view'));
		add_action('pe_theme_metabox_config_view',array(&$this,'pe_theme_metabox_config_view'));
	}

	public function pe_theme_metabox_config_view() {

		$cpto = array();

		$types =
			array(
				  __("Gallery",'Pixelentity Theme/Plugin') => "gallery",
				  __("Layout",'Pixelentity Theme/Plugin') => "layout"
				  );

		$typesOption[__("General",'Pixelentity Theme/Plugin')] = $types;

		$template = 
			array(
				  "title" => "",
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" => 
				  array() 
				  );

		$mboxes = array();

		foreach ($this->post_types() as $name=>$pt) {
			$mbox = array_merge(array(),$template);

			$types[$pt->label] = "post-$name";
			$typesOption[__("Post based",'Pixelentity Theme/Plugin')][$pt->label] = "post-$name";

			$mbox["title"] = $pt->label;

			$content =& $mbox["content"];
			$cpto[$pt->label] = $name;

			if ($name != 'slide') {
				$content["count"] = 
					array(
						  "label" => __("Max",'Pixelentity Theme/Plugin'),
						  "type" => "Number",
						  "description" => __("Maximum number of items to show, leave empty for unlimited.",'Pixelentity Theme/Plugin'),
						  "default" => "",
						  );
			}

			$options = array();
			$posts = get_posts(
							   array(
									 "post_type"=>$name,
									 "suppress_filters"=>false,
									 "posts_per_page"=>-1
									 )
							   );


			if (count($posts) > 0) {
				$options = array();
				foreach($posts as $post) {
					$options[$post->post_title] = $post->ID;
				}

				$content["id"] = 
					array(
						  "label"=>__("Selection",'Pixelentity Theme/Plugin'),
						  "type"=>"Links",
						  "description" => __("Using this control, you can manually pick individual item to be included in the view",'Pixelentity Theme/Plugin'),
						  "sortable" => true,
						  "options"=> $options
						  );
				

			} else {
				unset($typesOption[__("Post based",'Pixelentity Theme/Plugin')][$pt->label]);
				continue;
			}
			
			if ($name != 'slide') {
				foreach ($this->taxonomies($name) as $taxslug => $tax) {
					if ($taxslug == "post_format") {
						$options = isset(PeGlobal::$config["post-formats-$name"]) ? PeGlobal::$config["post-formats-$name"] : PeGlobal::$config["post-formats"];
						$options = array_combine($options,$options);
					} else {
						$options = $this->master->data->getTaxOptions($taxslug);
					}
					if (count($options) == 0) continue;
					$content["tax-$taxslug"] =
						array(
							  "label" => $tax->label,
							  "type" => "Links",
							  "sortable" => true,
							  "options" => $options,
							  "description" => __("Only include items assinged to the selected ",'Pixelentity Theme/Plugin').$tax->label
							  );
				}
			}
			
			$mboxes[$name] = $mbox;
		}
		
		
		$mboxFormat = 
			array(
				  "title" => __("Data Type",'Pixelentity Theme/Plugin'),
				  "context" => "side",
				  "type" => "Plain",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"type" => 
						array(
							  "label"=>"",
							  "type"=>"SelectPlain",
							  "options"=> $typesOption,
							  "groups" => true,
							  "default"=>"gallery"
							  )
					
						)
				  );

		$mboxGallery =
			array(
				  "title" => __("Gallery",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"id" =>				
						array(
							  "label"=>__("Use Gallery",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "description"=>__('Gallery to pull images from.','Pixelentity Theme/Plugin'),
							  "options" => $this->master->gallery->option(),
							  "editable" => admin_url('post.php?post=%0&action=edit'),
							  "default"=>""
							  ),
						"link" =>				
						array(
							  "label"=>__("Link",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description"=>__('"Custom" means that the link on the image will be that link set in the "Gallery Image Settings", accessible via the edit gallery page. (edit image icon on each gallery thumbnail). "Attachement" will overwrite any link set via the "Gallery Image Settings" page and instead the image will automatically receive a link to the original version of itself, prior to resizing. This way you may display large versions of images in a lightbox. Note that image links are ignored in gallery-type components (like grid/cover) but are used in sliders.','Pixelentity Theme/Plugin'),
							  "options" => array(__("Custom",'Pixelentity Theme/Plugin') => "",__("Attachment",'Pixelentity Theme/Plugin') => "original"),
							  "default"=>""
							  )
						)
				  );


		PeGlobal::$config["metaboxes-view"]["data"] = $mboxFormat;
		PeGlobal::$config["metaboxes-view"]["gallery"] = $mboxGallery;

		$views = $this->views();

		foreach ($types as $name => $type) {
			$viewo = array();
			$def = "";

			foreach ($views as $class => $view) {
				if ($view->supports($type)) {
					$viewo[$view->name()] = $class;
					if (!$def) $def = $class;
				}
			}

			if (count($viewo) == 0) {
				$viewo[__("Default",'Pixelentity Theme/Plugin')] = "";
			}

			PeGlobal::$config["metaboxes-view"]["view-$type"] = 
				array(
					  "title" => sprintf(__("Display %s as",'Pixelentity Theme/Plugin'),$name),
					  "type" => "Plain",
					  "context" => "side",
					  "priority" => "core",
					  "where" =>
					  array(
							"post" => "all"
							),
					  "content" =>
					  array(
							"type" => 
							array(
								  "label"=>"",
								  "type"=>"Radio",
								  "options"=> $viewo,
								  "default"=> $def
								  ),
							)
					  );

		}

		foreach($mboxes as $name => $mbox) {
			PeGlobal::$config["metaboxes-view"]['post-'.$name] = $mbox;
		}
		
		foreach ($views as $class => $view) {
			if (is_subclass_of($view, "PeThemeViewLayoutModule")) continue;
			PeGlobal::$config["metaboxes-view"]['settings-'.$class] = apply_filters("pe_theme_view_{$class}_options",$view->mbox());
		}

		PeGlobal::$config["metaboxes-view"]["link"] = 
			array(
				  "title" => __("Slider Link Settings",'Pixelentity Theme/Plugin'),
				  "type" => "Link",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"type" =>
						array(
							  "label"=>__("Type",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "description" => __('<b>Auto</b>: will set slide link automatically, for instance, if "Data Type" is set to posts, clicking on a slide will lead to the post page.<br/><b>Fixed</b>: set a custom link for all slides.<br/><b>None</b>: disable slide links.','Pixelentity Theme/Plugin'),
							  "options" => 
							  array(
									__("Auto",'Pixelentity Theme/Plugin')=>"",
									__("Fixed",'Pixelentity Theme/Plugin') => "fixed",
									__("None",'Pixelentity Theme/Plugin')=>"none"
									),
							  "default"=>""
							  ),
						"fixed" =>
						array(
							  "label"=>__("Fixed Link",'Pixelentity Theme/Plugin'),
							  "description" => __("Set your custom link here",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "default"=>""
							  )
						)
				  );

		PeGlobal::$config["metaboxes-view"]["caption-gallery"] = 
			array(
				  "title" => __("Caption Settings",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"title" =>
						array(
							  "label"=>__("Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "description" => __('<b>None</b>: no caption title.<br><b>Custom</b>: use title set in gallery image settings (by clicking the edit icon on the image thumbnail).<br><b>Attachment</b>: use attachment title (as shown in media library).','Pixelentity Theme/Plugin'),
							  "options" => 
							  array(
									__("None",'Pixelentity Theme/Plugin')=>"",
									__("Custom",'Pixelentity Theme/Plugin') => "ititle",
									__("Attachment",'Pixelentity Theme/Plugin')=>"title"
									),
							  "default"=>""
							  ),
						"description" =>
						array(
							  "label"=>__("Description",'Pixelentity Theme/Plugin'),
							  "description" => __('<b>None</b>: no caption description.<br><b>Custom</b>: use description set in gallery image settings (by clicking the edit icon on the image thumbnail).<br><b>Attachment Caption</b>: use attachment "caption" field.<br><b>Attachment Description</b>: use attachment "description" field.<br><b>Attachment Alt Text</b>: use attachment "alt text" field.','Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "options" => 
							  array(
									__("None",'Pixelentity Theme/Plugin')=>"",
									__("Custom",'Pixelentity Theme/Plugin') => "caption",
									__("Attachment Caption",'Pixelentity Theme/Plugin')=>"excerpt",
									__("Attachment Description",'Pixelentity Theme/Plugin')=>"content",
									__("Attachment Alt Text",'Pixelentity Theme/Plugin')=>"alt"
									),
							  "default"=>""
							  )
						)
				  );

		PeGlobal::$config["metaboxes-view"]["caption-post"] = 
			array(
				  "title" => __("Caption Settings",'Pixelentity Theme/Plugin'),
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"title" =>
						array(
							  "label"=>__("Title",'Pixelentity Theme/Plugin'),
							  "description" => __('<b>None</b>: no caption title.<br><b>Post Title</b>: use post title (without linking to post).<br><b>Post Title with Link</b>: use post title (linking to the post).','Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "options" => array(__("None",'Pixelentity Theme/Plugin')=>"",__("Post Title",'Pixelentity Theme/Plugin') => "title",__("Post Title with Link",'Pixelentity Theme/Plugin') => "link"),
							  "default"=>""
							  ),
						"description" =>
						array(
							  "label"=>__("Description",'Pixelentity Theme/Plugin'),
							  "description" => __('<b>None</b>: no caption description.<br><b>Post Excerpt</b>: use the post excerpt.<br><b>Post Content</b>: use the post content.','Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "options" => array(__("None",'Pixelentity Theme/Plugin')=>"",__("Post Excerpt",'Pixelentity Theme/Plugin')=>"excerpt",__("Post Content",'Pixelentity Theme/Plugin') => "content"),
							  "default"=>""
							  )
						)
				  );

		PeGlobal::$config["metaboxes-view"]["layout"] = $this->master->layout->mbox;

	}

	public function add_meta_boxes_view() {
		$this->registerAssets();

		$taxmap = array();

		foreach ($this->taxonomies() as $name => $taxonomy) {
			$taxmap[$name] = array_keys($taxonomy);
		}

		foreach ($this->views() as $name => $view) {
			$captions[$name] = $view->capability("captions");
			$links[$name] = $view->capability("links");
		}

		wp_localize_script('pe_theme_view','pe_theme_view',
						   array(
								 "captions" => $captions,
								 "links" => $links,
								 "taxonomies" => $taxmap
								 )
						   );
		wp_enqueue_script("pe_theme_view");

	}

	public function getViewLoop($conf) {
		if (empty($conf->caption)) {
			$conf->caption = (object) array("title"=>"","description"=>"");
		}

		if (empty($conf->link)) {
			$conf->link = (object) array("type"=>"","fixed"=>"");
		}

		if ($conf->type == "gallery") {
			$loop = $this->master->gallery->getSliderLoop($conf->data->id,$conf->caption->title,$conf->caption->description,!empty($conf->data->link));
		} else {
			$loop = false;
			if ($this->master->data->customLoop($conf->data)) {
				global $post;
				$data = new StdClass();
				$content =& $this->master->content;
				$video =& $this->master->video;

				while ($this->master->content->looping()) {
					$slide = new StdClass();
					$data->loop[] = $slide;

					$slide->img = $this->master->content->get_origImage();

					if (empty($conf->settings->cover)) {
						$conf->settings->cover = $slide->img;
					}

					$slide->id = $post->ID;
					
					$slide->title = get_the_title();
					$slide->link = get_permalink();

					$title = "";
					
					if (!empty($conf->caption->title)) {
						$title = $slide->title;
						if ($conf->caption->title === "link") {
							$title = sprintf('<a href="%s">%s</a>',$slide->link,$title);
						}
					}

					$slide->caption_title = $title;

					$description = "";
					switch ($conf->caption->description) {
					case "excerpt":
						$description = get_the_excerpt();
						break;
					case "content":
						$description = get_the_content();
						break;
					}

					$slide->caption_description = $description;

					if ($post->post_type === "slide") {
						$slide->caption = $this->master->slide->caption($post->id);
					} else {
						$slide->caption = $this->buildCaption($title,$description);
					}

					$slide->video = false;
					$type = $content->type();
					$format = $content->format();

					if ($type === "video") {
						$slide->video = $video->getInfo($post->ID);
					} else if ($format === "video") {
						$meta =& $this->master->meta->get($post->ID,$post->post_type);
						if ($id = empty($meta->video->id) ? false : $meta->video->id) {
							$slide->video = $video->getInfo($id);							
						}
					}

				}
				$this->master->content->resetLoop();
				$loop = $this->master->data->create($data);
			}
		}
		
		// override link = "auto" for layered slides
		if (!empty($conf->data->post_type) && $conf->data->post_type === "slide" && $conf->link->type != "fixed") {
			$conf->link->type = "none";
		}

		if ($loop && ($type = $conf->link->type)) {
			$fixed = $conf->link->fixed;
			while ($item =& $loop->next()) {
				$item->link = $type === "fixed" ? $fixed : "";
			}
			$loop->rewind();
		}

		return $loop;
		
	}

	public function buildCaption($title = "",$description) {
		$caption = "";
		
		if ($title) {
			$caption .= sprintf('<h3>%s</h3>',$title);
		}

		if ($description) {
			$caption .= sprintf('<p>%s</p>',$description);
		}

		return $caption;
	}

	public function supporting($type) {
		foreach ($this->views() as $cl => $view) {
			if ($view->supports($type)) {
				$options[$view->name()] = $cl;
			}
		}
		return $options;
	}

	public function option($skipcurrent = true,$types = false) {

		$currentID = false;

		if ($skipcurrent && !empty($GLOBALS["post"]) && $GLOBALS["post"]->post_type == "view") {
			$currentID = intval($GLOBALS["post"]->ID);
		}

		$views = $this->views();

		$posts = get_posts(
						   array(
								 "post_type"=>"view",
								 "posts_per_page"=>-1
								 )
						   );

		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				if (intval($post->ID) === $currentID) continue;
				$meta = $this->master->meta->get($post->ID,$post->post_type);
				$meta = maybe_unserialize(get_post_meta($post->ID,PE_THEME_META,true));
				if (empty($meta) || empty($views[$meta->{"view-".$meta->data->type}->type])) continue;
				$type = $views[$meta->{"view-".$meta->data->type}->type]->type();
				if ($types && !in_array($type,$types)) continue; 
				$options[$type][$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No view defined, please create one",'Pixelentity Theme/Plugin')=>-1);
		}

		return $options;
	}

	public function create($view,$type,$data,$width = null,$height = null) {

		$conf = new StdClass;
		$conf->view = $view;
		$conf->type = $type;

		if (is_numeric($width)) {
			$conf->width = $width;
		}

		if (is_numeric($height)) {
			$conf->height = $height;
		}

		$conf->data = (object) $data;
		//$conf->caption = new StdClass;
		//$conf->link = new StdClass;

		return $conf;
	}


	public function resize($view,$w = null,$h = null) {
		$t =& $this->master;

		$w = isset($w) ? $w : (isset($view->width) ? $view->width : false);
		$w = is_numeric($w) ? intval($w) : false;
		$w = $w > 0 ? $w : false;

		$h = isset($h) ? $h : (isset($view->height) ? $view->height : false);
		$h = is_numeric($h) ? intval($h) : false;

		if ($w !== false) {
			$this->resized = true;
			$w = $t->media->w($w);
		}

		if ($h !== false) {
			$this->resized = true;
			$h = $t->media->h($h);
		}
		
		if (empty($view->data)) {
			$t->view->output($view->id);
		} else {
			$t->view->output($view);
		}

		$this->resized = false;

		if ($w !== false) {
			$w->restore();
		}

		if ($h !== false) {
			$h->restore();
		}
	}

	// view module (builder) output
	public function outputModule($item) {
		$class = "PeThemeViewLayoutModule{$item['type']}";
		$vlm = new $class;
		$vlm->output($item);
	}

	public function conf($id = null) {


		if (is_object($id)) {
			$conf = $id;
		} else {

			if (!$id) {
				global $post;
				$id = $post->ID;
				$meta =& $this->master->content->meta();
			} else {
				$post = get_post($id);
				$meta =& $this->master->meta->get($id,$post->post_type);
			}

			if ($post->post_type != "view") {
				return;
			}
			
			$conf = new StdClass;
			$conf->id = $id;
			$conf->type = $type = $meta->data->type;
			$conf->view = $meta->{"view-$type"}->type;
			$conf->settings = $meta->{"settings-{$conf->view}"};

			switch ($type) {
			case "layout":
				break;
			case "gallery":
				$conf->data = $meta->gallery;
				$conf->caption = $meta->{"caption-gallery"};
				break;
			default:
				$ptype = str_replace("post-","",$meta->data->type);
				$conf->data = $meta->{"post-$ptype"};
				$conf->data->post_type = $ptype;
				$conf->caption = $meta->{"caption-post"};
			}
			$conf->link =& $meta->link;
		}
		return $conf;
	}

	public function pe_theme_page_layout_filter($layout) {
		
		$conf = $this->conf();

		// if layout, do not override page layout mbox settings
		if ($conf->type === "layout") {
			return $layout;
		}

		$view = $conf->view;
		$class = "PeThemeView$view";
		$view = new $class;

		// set layout default
		$layout = $this->master->layout->def;

		// override content layout
		$layout->content = empty($conf->settings->layout) ? "boxed" : $conf->settings->layout;

		// override sidebar
		if (!$view->capability("sidebar")) {
			$layout->sidebar = "";
		}

		return $layout;
	}

	// view output
	public function output($id = null) {

		$conf = $this->conf($id);

		if (!$conf) {
			return;
		}

		$view = $conf->view;
		$class = "PeThemeView$view";
		$view = new $class;

		if (!$view->capability("links")) {
			$conf->link = (object) array("type" => "");
		}

		$view->output($conf);

	}

	public function caption($caption) {

		$size = false;

		if (is_object($caption)) {
			if (empty($caption->caption)) {
				return "";
			}
			$size = empty($caption->size) ? false : explode("x",$caption->size);
			$caption = $caption->caption;
		}

		if ($html = do_shortcode(apply_filters("the_content",$caption))) {
			printf(
					'<div class="peCaption"%s>',
					$size ? sprintf(' data-orig-width="%s" data-orig-height="%s"',$size[0],$size[1]) : ""
					);
			echo $html; 
			echo '</div>';
		}
		
	}


}

?>
