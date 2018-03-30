<?php

class PeThemeGallery {

	protected $master;
	protected $options;
	protected $cache;

	public function __construct(&$master) {
		$this->master =& $master;
		add_action("pe_theme_metabox_config_gallery",array(&$this,"pe_theme_metabox_config_gallery"));
	}

	public function is_mediatags_active() {
		return ($this->master->is_plugin_active("media-tags/media_tags.php"));
	}

	public function cpt() {
		if (!$this->is_mediatags_active()) {
			define('PE_MEDIA_TAG',"media-tags");


			PeGlobal::$config["taxonomies"] = 
				array(
					  PE_MEDIA_TAG =>
					  array(
							'attachment',
							array(
								  //'label' => __('Media Tag','Pixelentity Theme/Plugin'),
								  "labels" => 
								  array(
										'name' 				=> __('Media Tags','Pixelentity Theme/Plugin'),
										'singular_name' 	=> __('Media Tag','Pixelentity Theme/Plugin'),
										'search_items' 		=> __('Search Media Tags','Pixelentity Theme/Plugin'),
										'popular_items' 	=> __('Popular Media Tags','Pixelentity Theme/Plugin'),		
										'all_items' 		=> __('All Media Tags','Pixelentity Theme/Plugin'),
										'parent_item' 		=> __('Parent Media Tag','Pixelentity Theme/Plugin'),
										'parent_item_colon' => __('Parent Media Tag:','Pixelentity Theme/Plugin'),
										'edit_item' 		=> __('Edit Media Tag','Pixelentity Theme/Plugin'), 
										'update_item' 		=> __('Update Media Tag','Pixelentity Theme/Plugin'),
										'add_new_item' 		=> __('Add New Media Tag','Pixelentity Theme/Plugin'),
										'new_item_name' 	=> __('New Media Tag Name','Pixelentity Theme/Plugin')
										),
								  'hierarchical' => false,
								  'sort' => true,
								  'show_ui' => true,
								  'show_in_nav_menus' => false,
								  "update_count_callback" => "_update_generic_term_count",
								  'args' => array('orderby' => 'term_order' ),
								  'rewrite' => array('slug' => PE_MEDIA_TAG )
								  )
							)
					  );
		}

		$cpt =
			array(
				  'labels' => 
				  array(
						'name'              => __("Galleries",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Gallery",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Gallery",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Galleries','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Galleries','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Galleries','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Gallery','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Gallery:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Gallery','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Gallery','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Gallery','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Gallery Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["gallery"] =& $cpt;

	}

	public function pe_theme_metabox_config_gallery() {

		$mtags = peTheme()->data->getTaxOptions(PE_MEDIA_TAG);
		$mtags = is_array($mtags) && count($mtags) ? true : false;
		
		$galleryTypes[__("Direct Upload",'Pixelentity Theme/Plugin')] = "upload";
		$mtagsDecription = "";

		if ($mtags) {
			$galleryTypes[__("Media Tag (any)",'Pixelentity Theme/Plugin')] = "any";
			$galleryTypes[__("Media Tag (all)",'Pixelentity Theme/Plugin')] = "all";
			$mtagsDecription = __("<strong>Media Tag</strong> includes all the already uploaded images that match the selected media tags. See the help documentation for an explanation of Media Tags",'Pixelentity Theme/Plugin');
		}		

		$mbox = 
			array(
				  "title" => __("Gallery",'Pixelentity Theme/Plugin'),
				  "type" => "Gallery",
				  "priority" => "core",
				  "where" =>
				  array(
						"gallery" => "all"
						),
				  "content" =>
				  array(
						"type" => 
						array(
							  "label" => __("Images",'Pixelentity Theme/Plugin'),
							  "type" => "Select",
							  "description" => __("<strong>Direct upload</strong> lets you add images by dragging and dropping them directly from your computer.<br/>",'Pixelentity Theme/Plugin').$mtagsDecription,
							  "options" => $galleryTypes,
							  "default" => "upload"
							  ),
						"sort" =>
						array(
							  "label" => __("Sorting",'Pixelentity Theme/Plugin'),
							  "description" => __("<strong>Newest First</strong> display recent uploaded images first.<br/><strong>Manual</strong> drag and drop sort.",'Pixelentity Theme/Plugin'),
							  "type" => "RadioUI",
							  "options" => Array(__("Newest First",'Pixelentity Theme/Plugin')=>"auto",__("Manual",'Pixelentity Theme/Plugin')=>"custom"),
							  "default" => "auto"
							  ),
						"tags" =>
						array(
							  "label" => __("Media Tags",'Pixelentity Theme/Plugin'),
							  "type" => "Tags",
							  "taxonomy" => PE_MEDIA_TAG,
							  "description" => __("The list on the left shows all existing media tags. These tags are automatically added to uploaded content to allow for easy reuse and organisation of all media content. Select the tags from which you would like to include their related media, in this gallery. Once you have made your selection, click the \"Refresh\" button in the \"Gallery Content\" section below. See the help documentation for a detailed explanation of Media Tags",'Pixelentity Theme/Plugin'),
							  "default" => ""
							  ),
						"images" =>
						array(
							  "label" => __("Upload Gallery Images",'Pixelentity Theme/Plugin'),
							  "description" => __("Add one or more media tags",'Pixelentity Theme/Plugin'),
							  "type" => "DropUpload",
							  "default" => ""
							  )
						)
				  
				  );

		if (!$mtags) {
			unset($mbox["content"]["tags"]);
		}

		PeGlobal::$config["metaboxes-gallery"] = 
			array(
				  "gallery" => $mbox
				  );

	}

	public function instantiate() {
		if (is_admin() && defined('PE_MEDIA_TAG')) {
			$this->registerAssets();
			
			add_action("restrict_manage_posts",array(&$this,"restrict_manage_posts"));
			add_filter("parse_query",array(&$this,"parse_query_filter"));
			add_filter("parent_file",array(&$this,"parent_file_filter"));
			add_filter("manage_media_columns",array(&$this,"manage_media_columns_filter"));
			add_filter("media-tags_row_actions",array(&$this,"media_tags_row_actions_filter"));
			add_filter("manage_edit-media-tags_columns",array(&$this,"manage_edit_media_tags_columns_filter"));
			add_filter("manage_edit-media-tags_sortable_columns",array(&$this,"manage_edit_media_tags_columns_filter"));		
			add_filter("manage_media-tags_custom_column",array(&$this,"manage_media_tags_custom_column_filter"),10,3);
			add_action("manage_media_custom_column",array(&$this,"media_tag_content"),"media_tag", 10, 2 );
			//add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));
			add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));
			add_action("load-upload.php",array(&$this,"load_upload"));

			add_action('wp_ajax_query-attachments',array(&$this,"wp_ajax_query_attachments"),1);
									
			add_action('wp_ajax_pe_theme_gallery_fetch',array(&$this,'ajax_gallery_fetch'));
			add_action('wp_ajax_pe_theme_gallery_add',array(&$this,'ajax_gallery_add'));
			add_action('wp_ajax_pe_theme_multi_upload',array(&$this,'ajax_multi_upload'));
			add_filter('pe_theme_update_metadata',array(&$this,'pe_theme_update_metadata_filter'),10,3);

			add_action('add_meta_boxes_gallery',array(&$this,'add_meta_boxes_gallery'));

			if (!function_exists("wp_enqueue_media") && $this->master->options->mediaQuick === "yes") {
				add_filter('media_upload_tabs',array(&$this,'media_upload_tabs_filter'));
				add_action('media_upload_pe_quick_media',array(&$this,'pe_quick_media'));
				if ($this->master->options->mediaQuickDefault === "yes") {
					add_filter('media_upload_default_tab',array(&$this,'media_upload_default_tab_filter'));
				}
			}

		}
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.mediaTags.js",array('jquery','jquery-ui-core','pe_theme_utils'),"pe_theme_mediaTags");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.media.filter.js",array('jquery','pe_theme_utils'),"pe_theme_media_filter");
		//PeThemeAsset::addScript("framework/js/admin/jquery.theme.quickImage.js",array('utils','jquery','jquery-ui-core','pe_theme_utils'),"pe_theme_quickImage");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.gallery.js",array("pe_theme_utils","json2"),"pe_theme_gallery");
	}

	public function mediaTagsDropdown($selected) {
		wp_dropdown_categories(
							   array(
									 "show_option_all" => __("All",'Pixelentity Theme/Plugin'),
									 "show_option_none" => __("Not Tagged",'Pixelentity Theme/Plugin'),
									 "taxonomy"=>PE_MEDIA_TAG,
									 "name"=>PE_MEDIA_TAG,
									 "show_count"=>1,
									 "selected"=>$selected
									 )
							   );
	}


	public function restrict_manage_posts() {
		global $wp_query;
		$screenID = get_current_screen()->id;
		switch ($screenID) {
		case "upload":
			$selected = isset($wp_query->query[PE_MEDIA_TAG]) ? $wp_query->query[PE_MEDIA_TAG] : '';
			$this->mediaTagsDropdown($selected);
			break;
		}
	}

	public function conf($id = null,$view ="GalleryGrid") {
		if (!$id) {
			global $post;
			$id = $post->ID;
		}

		$conf = (object)
			array(
				  "id" => $id,
				  "type" => "gallery",
				  "view" => "$view",
				  "data" => (object) array("id" => $id),
				  "settings" => new StdClass,
				  "caption" => (object) array("title" => "ititle", "description" => "caption")
				  );
		return $conf;
	}

	public function output($id = null,$view ="GalleryGrid") {
		$this->master->view->output($this->conf($id,$view));
	}

	public function type($id = null) {
		if (!$id) return;
		if (!($post = get_post($id))) return;
		$meta =& $this->master->meta->get($id,$post->post_type);
		return empty($meta->settings->type) ? "" : $meta->settings->type;
	}


	public function parse_query_filter($query) {
		$qv = &$query->query_vars;
		//$qv["post_parent"] = 871;
		//print_r($qv);
		//	if (isset($qv[PE_MEDIA_TAG]) && is_numeric($qv[PE_MEDIA_TAG])) {
		if (isset($qv[PE_MEDIA_TAG])) {
			if ($qv[PE_MEDIA_TAG] == -1) {
				global $wpdb;

				$tr = $wpdb->term_relationships;
				$tt = $wpdb->term_taxonomy;

				$untagged = $wpdb->get_col($wpdb->prepare("SELECT $tr.object_id FROM $tt INNER JOIN $tr ON ($tt.term_taxonomy_id = $tr.term_taxonomy_id) WHERE taxonomy=\"%s\"",PE_MEDIA_TAG));
				
				$qv[PE_MEDIA_TAG] = "";
				$qv["post__not_in"] = $untagged;
			} else {
				$search = $qv[PE_MEDIA_TAG];
				$delim = false;
				if (strpos($search,"+") !== false) {
					$delim = "+";
				} else if (strpos($search,",") !== false) {
					$delim = ",";
				} 
				$terms = $delim ? explode($delim,$search) : array($search);
				$search = "";
				foreach($terms as $term) {
					if (is_numeric($term)) {
						$term = get_term_by('id',$term,PE_MEDIA_TAG);
						$term = $term ? $term->slug : '';
					}
					$search .= $search ? "$delim$term" : $term;
				}
				$qv[PE_MEDIA_TAG] = $search;
			}
		}
		
		return $query;
	}

	public function manage_media_columns_filter($cols) {
		$cols["pe_media_tags"] = PeGlobal::$config["taxonomies"][PE_MEDIA_TAG][1]["labels"]["name"];
		return $cols;
	}

	public function media_tag_content($column_name,$id) {

		if ($column_name === "pe_media_tags") {
			$tags = wp_get_post_terms($id,PE_MEDIA_TAG);
			if ( !empty( $tags ) ) {
				$out = array();
				foreach ( $tags as $c ) {
					$out[] = sprintf( '<a href="%s">%s</a>',
									  esc_url(add_query_arg(array(PE_MEDIA_TAG => $c->term_id), 'upload.php' ) ),
									  esc_html(sanitize_term_field( 'name', $c->name, $c->term_id, 'tag', 'display' ) )
									  );
				}
				echo join( ', ', $out );
			} else {
				echo __("No Tags",'Pixelentity Theme/Plugin');
			}
		}
	}

	public function admin_enqueue_scripts() {
		//wp_enqueue_script('plupload-handlers');
		$screenID = get_current_screen()->id;
		switch ($screenID) {
		case "upload":
			wp_enqueue_script("pe_theme_mediaTags");
			break;
		case "media-upload":
			wp_enqueue_style("pe_theme_admin");			
			break;
		case "gallery":
			// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
			// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
			wp_deregister_script("prototype");
			break;
		}
		if (wp_script_is("media-editor")) {
			if (function_exists("wp_enqueue_media")) {
				$mtags = $this->master->data->getTaxOptions(PE_MEDIA_TAG);
				wp_localize_script("pe_theme_media_filter","pe_theme_media_filters",
								   array(
										 "all" => __("All media tags",'Pixelentity Theme/Plugin'),
										 "names" => array_keys($mtags), 
										 "slugs" => array_values($mtags)
										 )
								   );
				wp_enqueue_script("pe_theme_media_filter");			
			}
		}

	}

	public function load_upload() {
		$actions = array("bulk_pe_mediaTag_edit","bulk_pe_mediaTag_add","bulk_pe_mediaTag_clear");
		$action = isset($_REQUEST["action"]) && $_REQUEST["action"] != -1 ? $_REQUEST["action"] : (isset($_REQUEST["action2"]) ? $_REQUEST["action2"] : false);
		if (!in_array($action,$actions)) return;

		$media =& $_REQUEST["media"];

		if (!isset($media) || !is_array($media) || count($media) == 0) return;

		check_admin_referer("bulk-media");

		$tags = array();

		switch ($action) {
		case "bulk_pe_mediaTag_add":
		case "bulk_pe_mediaTag_edit":
			$tags =& $_REQUEST["edit-media-tags"];
		if (!isset($tags)) return;
		break;
		}

		$tags = explode(",",$tags);

		foreach ($media as $id) {
			$res = wp_set_post_terms($id,$tags,PE_MEDIA_TAG,($action == "bulk_pe_mediaTag_add"));
		}
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"gallery",
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No galleries defined, please create one",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

	public function &getAttachmentsByTags($tags) {
		if ($tags !== false) {
			$wpq = new WP_Query();
			$posts = $wpq->query(
								  array(
										"post_type"=>"attachment",
										"post_status" => "inherit",
										//"post_mime_type"=>"image",
										'orderby' => 'post_date',
										'order' => 'DESC',
										"media-tags"=>"$tags",
										'no_found_rows' => true,
										"posts_per_page"=>-1,
										"suppress_filters" => true
										)
								  );
		} else {
			$posts = array();
		}

		return $posts;
	}

	public function &get($id) {
		if (isset($this->cache[$id])) return $this->cache[$id];
		$post = get_post($id);
		if (!$post ) return $post;
		$null = null;
		if ($post->post_type != "gallery") return $null;

		$meta =& $this->master->meta->get($id,$post->post_type);
		$post->meta = $meta;

		$gallery = $meta->gallery;

		$tags = $gallery->tags;

		switch ($gallery->type) {
		case "any":
		case "all":
			$tags = (isset($tags) && is_array($tags)) ?  join($gallery->type == "any" ? "," : "+",$tags) : false;
		break;
		case "upload":
			$tags = "gallery-$id";
		}

		//$tags = $tags ? join($gallery->type == "any" ? "," : "+",$tags) : "gallery-$id";

		$order = ($gallery->sort === "custom") && (isset($gallery->order) && is_array($gallery->order)) ? $gallery->order : false;

		//$data = @$gallery->data ? $gallery->data : false;
		$data = isset($gallery->data) ? $gallery->data : false;

		$post->images = $this->getAttachments($tags,$order,$data);

		$i = count($post->images);
		$upd = wp_upload_dir();
		$baseDir = $upd["basedir"]."/";
		$baseUrl = $upd["baseurl"]."/";

		while($i--) {
			$image =& $post->images[$i]->meta;
			$file = $image["file"];
			$image["absfile"] = $baseDir.$file;
			$image["absurl"] = $baseUrl.$file;
		}
		
		$this->cache[$id] =& $post;
		return $post;
	}

	public function count($id) {
		$post =& $this->get($id);
		$count = 0;
		if ($post && @is_array($post->images)) {
			$count = count($post->images);
		}
		return $count;
	}

	public function getSliderData($id,$title = "",$description = "",$forceLink = false) {
		$post =& $this->get($id);
		if (!$post) return null;
		$slider = new StdClass();
		//$slider->count = count($post->images);
		$slider->id = $id;
		foreach($post->images as $image) {
			$slide = new stdClass();
			$slider->loop[] = $slide;
			$slide->id = $image->ID;
			$slide->title = $image->post_title;
			$slide->excerpt = $image->post_excerpt;
			$slide->content = $image->post_content;
			$slide->alt = $image->meta["alt"];
			$slide->img = $image->meta["absurl"];
			if (isset($image->data) ) {
				// compatibily with old implementation
				if (is_array($image->data)) {
					foreach ($image->data as $key => $val) {
						//$slide->{$key} = $image->data[$key];
						$slide->{$key} = $val;
					}
				} else {
					$data =& $image->data;

					if (!empty($data->video)) {
						$data->video = $this->master->video->getInfo($data->video);
					} else {
						$data->video = false;
					}

					foreach (get_object_vars($data) as $key => $val) {
						$slide->{$key} = $val;
					}
				}
			}
			$slide->caption_title = !$title || empty($slide->{$title}) ? "" : $slide->{$title};
			$slide->caption_description = !$description || empty($slide->{$description}) ? "" : $slide->{$description};
			$slide->caption = $this->master->view->buildCaption($slide->caption_title,$slide->caption_description);

			if ($forceLink) {
				$slide->link = $slide->img;
			}
			
		};
		return $slider;
	}

	public function getSliderLoop($id,$title = "",$description = "",$forceLink = false) {
		$loop = $this->getSliderData($id,$title,$description,$forceLink);
		return $this->master->data->create($loop);
	}

	public function getSliderConf($conf = null) {
		$plugin = isset($conf->plugin) ? $conf->plugin : "peVolo";
		//$options[] = sprintf('data-plugin="%s"',$plugin);
		$options["plugin"] = $plugin;
		if (isset($conf)) {
			$conf = (array) $conf;
			foreach ($conf as $key => $val) {
				if ($key === "plugin" || $key === "delay" && absint($val) == 0) continue;
				if ($key !== "delay" && strpos($key,"slider_{$plugin}_") !== 0) continue;
				//$options[] = sprintf('data-%s="%s"',str_replace("slider_{$plugin}_","",$key),$val);
				$options[sprintf('%s',str_replace("slider_{$plugin}_","",$key))] = $val;
			}
		}
		return $options;
	}


	public function image($id,$idx = 0) {
		if (($max = $this->count($id)) > 0 && ($idx < $max)) {
			$post =& $this->get($id);
			return $post->images[$idx]->meta["absurl"];
		}
		return "";
	}

	public function images($id) {
		$post =& $this->get($id);
		if (!$post) return false;
		foreach ($post->images as $image) {
			$images[] = $image->meta["absurl"];
		}
		return $images;
		
	}


	public function title($id) {
		$post =& $this->get($id);
		return $post && @$post->post_title ? $post->post_title : "";
	}

	public function cover($id) {
		$img = wp_get_attachment_url(get_post_thumbnail_id($id));
		if (!$img) {
			$img = $this->image($id);
		}
		return $img;
	}


	public function getAttachments($tags,$order = false,$data = null) {
		$posts =& $this->getAttachmentsByTags($tags);

		$max = count($posts);
		$upd = wp_upload_dir();
		$baseUrl = $upd["baseurl"]."/";

		while ($max--) {
			$current =& $posts[$max];
			$current->meta = wp_get_attachment_metadata($current->ID);

			$current->meta["absurl"] = $baseUrl.$current->meta["file"];
			$current->meta["alt"] = get_post_meta($current->ID, '_wp_attachment_image_alt', true);

			// set custom data
			if ($data && isset($data[$current->ID])) {
				$current->data = $data[$current->ID];
			}

			if ($order !== false) {
				$hash[$current->ID] =& $current;
			}
		}

		if (isset($hash)) {
			$ordered = array();
			
			// add elements following supplied order array
			foreach ($order as $key) {
				if (isset($hash[$key])) {
					$ordered[] =& $hash[$key];
					unset($hash[$key]);
				}
			}

			// check if we have extra items not present in custom order
			if (count($hash) > 0) {
				// shit, we have ....
				$max = count($posts);
				$search = count($hash);
				
				// scan all items and add only the missing ones in the correct order
				while ($search && ($max--)) {
					if (isset($hash[$posts[$max]->ID])) {
						array_unshift($ordered,$posts[$max]);
						$search--;
					}
				}
			} 
			$posts =& $ordered;
		}
		
		return $posts;
	}

	public function createPreviewThumbs($images) {
		$i = count($images);
		$upd = wp_upload_dir();
		$baseUrl = $upd["baseurl"]."/";

		// create thumbs for preview
		while($i--) {
			$image =& $images[$i]->meta;
			$file = $image["file"];
			$image["preview"] = $this->master->image->resize($baseUrl.$file,120,90);
		}
	}

	public function ajax_gallery_fetch() {
		$tags = $_REQUEST["tags"];
		$galleryID = @$_REQUEST["galleryID"];
		$sort = @$_REQUEST["sort"];
		$order = false;
		$data = null;

		//$meta = $this->master->meta->get($galleryID,"gallery");
		$meta = get_post_meta($galleryID,PE_THEME_META,true);

		if (isset($meta->gallery->data)) {
			$data =& $meta->gallery->data;
		}

		if ($sort == "custom" && $galleryID) {
			if (!empty($meta->gallery->order)) {
				$order =& $meta->gallery->order;
			}
		}

		$images = $this->getAttachments($tags,$order,$data);
		$this->createPreviewThumbs($images);

		header("Content-Type: application/json");
		echo json_encode(array("images" => $images,"upload"=>wp_upload_dir()));
		die();
	}

	public function ajax_multi_upload() {
		$postID = isset($_REQUEST["postID"]) ? intval($_REQUEST["postID"]) : 0;

		check_ajax_referer('pe_theme_multi_upload');
		
		$status = wp_handle_upload($_FILES['async-upload'], array('test_form'=>true, 'action' => 'pe_theme_multi_upload'));

		$filename = $status["file"];
		$type = $status["type"];

		//$wp_filetype = wp_check_filetype(basename($filename), null );
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
							'guid' => $wp_upload_dir['baseurl']."/"._wp_relative_upload_path($filename), 
							'post_mime_type' => $type,
							'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
							'post_content' => '',
							'post_status' => 'inherit'
							);
		$attach_id = wp_insert_attachment($attachment,$filename,$postID);
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		//$post = wp_get_single_post($attach_id);
		$post = get_post($attach_id);
		$post->meta = $attach_data;
		
		$tags = "Gallery $postID";
		wp_set_post_terms($attach_id,$tags,PE_MEDIA_TAG,false);

		$images = array($post);
		$this->createPreviewThumbs($images);

		header("Content-Type: application/json");
		echo json_encode(array("images" => $images,"upload"=>wp_upload_dir()));

		die();
	}

	public function ajax_gallery_add() {
		$tags = $_REQUEST["tags"];
		$galleryID = @$_REQUEST["galleryID"];

		$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : false;

		if ($data && $tags) {
			foreach ($data as $item) {
				wp_set_post_terms($item["id"],$tags,PE_MEDIA_TAG,true);
			}
		}

		$this->ajax_gallery_fetch();
	}

	public function pe_theme_update_metadata_filter($meta,$postID,$post) {
		if ($post->post_type != "gallery") return $meta;

		if (isset($meta->gallery->data) && is_array($meta->gallery->data)) {
			$data =& $meta->gallery->data;
			// unpack gallery image data;
			foreach ($data as $id=>$value) {
				$data[$id] = json_decode(stripslashes($value));
			}
		}

		if ($meta->gallery->type != "upload") return $meta;

		$term = get_term_by("slug","gallery-$postID",PE_MEDIA_TAG);

		if (@$meta->gallery->delete) {
			$delete =& $meta->gallery->delete;
			unset($meta->gallery->delete);
			foreach ($delete as $id) {
				$terms = wp_get_post_terms($id,PE_MEDIA_TAG,array("fields" => "ids"));
				// check if the term is still included 
				if (($pos = array_search($term->term_id,$terms)) !== false) {
					unset($terms[$pos]);
					// update terms
					$terms = array_map("absint",$terms);
					wp_set_object_terms($id,$terms,PE_MEDIA_TAG);
				};
			}
		}

		$term = get_term_by("slug","gallery-$postID",PE_MEDIA_TAG);
		if ($term) {
			wp_update_term($term->term_id,PE_MEDIA_TAG,array("name" => $post->post_title));
		}

		return $meta;
		
	}

	public function media_upload_tabs_filter($tabs) {
		$tabs["pe_quick_media"] = __("Quick Browse",'Pixelentity Theme/Plugin');
		return $tabs;
	}

	public function parent_file_filter($parent) {
		$screenID = get_current_screen()->id;

		if ($screenID == "edit-media-tags") {
			$parent = "upload.php";
		}
		return $parent;
	}

	public function manage_edit_media_tags_columns_filter($columns) {
		if (isset($columns["posts"])) {
			unset($columns["posts"]);
			$columns["images"] = __("Images",'Pixelentity Theme/Plugin');
		}
		return $columns;
	}

	public function manage_edit_media_tags_sortable_columns_filter($columns) {
		if (isset($columns["posts"])) {
			unset($columns["posts"]);
			$columns["images"] = "count";
		}
		return $columns;
	}

	public function manage_media_tags_custom_column_filter($ignored,$name,$id) {
		if ($name === "images") {
			$term = get_term_by('id',$id,PE_MEDIA_TAG);
			printf('<a href="%s">%s</a>',esc_url(add_query_arg(array("media-tags"=>$id),'upload.php')),$term->count);
		}
	}

	public function media_tags_row_actions_filter($actions) {
		if (isset($actions["view"])) {
			unset($actions["view"]);
		}
		return $actions;
	}


	public function media_upload_default_tab_filter($default) {
		return "pe_quick_media";
	}

	public function pe_quick_media() {
		return wp_iframe(array(&$this,'mediaQuickView'));
	}

	public function mediaQuickViewTemplate($nonce,$multi = false) {
		$multi = $multi ? 'data-multi="yes"' : '';
?>
<div class="pe_theme quickImage">
	<div class="pe_wrap">
        <div class="contents clearfix">
			<?php if ($multi): ?>
			<input type="button" class="ob_button" id="pe_add" value="Add" style="margin-right: 35px" />
			<input type="button" class="ob_button" id="pe_all" value="Select All" style="margin-right: 5px" />
			<?php endif; ?>
			<?php $this->mediaTagsDropdown(""); ?>
			<div class="pe_gallery">
				<div class="pe_output" id="thumbs" data-nonce="<?php echo $nonce ?>" <?php echo $multi ?>>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}


	public function mediaQuickView() {
		$nonce = "";
		$featured = "";
		if (!isset($_GET["pe_hide"])) {	
			if (isset($_GET['type']) && $_GET['type'] === "image") {
				// featured image
				$featured = "yes";
				if (isset($_GET['post_id'])) {
					$postID = absint($_GET['post_id']);
					$nonce = wp_create_nonce("set_post_thumbnail-$postID");
				}
			}			
			media_upload_header();
		}

		$this->mediaQuickViewTemplate($nonce,isset($_GET['pe_multi']));
	}

	public function add_meta_boxes_gallery() {

		wp_enqueue_script("pe_theme_gallery");

		$fields = array(
						"ititle" => 
						array(
							  "label"=>__("Title",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "section"=>"main",
							  "description" => __("Optional image title.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"caption" => 
						array(
							  "label"=>__("Description",'Pixelentity Theme/Plugin'),
							  "type"=>"Editor",
							  "section"=>"main",
							  "description" => __("Optional image description.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"link" =>
						array(
							  "label"=>__("Link",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "section"=>"main",
							  "description" => __("Optional image link.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  ),
						"video" => 
						array(
							  "label"=>__("Use video",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "section"=>"main",
							  "description" => "Optional video",
							  "options" => array_merge(array(__("None",'Pixelentity Theme/Plugin')=>""),peTheme()->video->option()),
							  "default"=>""
							  ),
						"save" => 
						array(
							  "label"=>__("Accept changes and close the dialog",'Pixelentity Theme/Plugin'),
							  "type"=>"Button",
							  "section"=>"main",
							  "description" => __("Remember to publish -> update the Gallery post for changes to be saved.",'Pixelentity Theme/Plugin'),
							  "default"=> ""
							  )
						);

		$fields = apply_filters("pe_theme_gallery_image_fields",$fields);
		$this->form = new PeThemePlainForm($this,"peCaptionManager",$fields,$null);
		$this->form->build();

		add_action('admin_footer', array(&$this,'admin_footer'));

	}

	public function wp_ajax_query_attachments() {
		add_filter('pre_get_posts',array(&$this,"pre_get_posts_filter"));
	}


	public function pre_get_posts_filter($query) {
		$mtag = empty($_REQUEST['query']['tag']) ? false : $_REQUEST['query']['tag'];
		if ($mtag) {
			$query->query_vars[PE_MEDIA_TAG] = $mtag;
		}
		return $query;
	}

	public function admin_footer() {

		echo $this->pre();
		$this->form->render();
		echo $this->post();
	}

	protected function pre() {
		$html = <<<HTML
<div class="pe_theme" style="display: none" id="pe_captions_manager">
	<div class="pe_theme_wrap">
		<!--info bar top-->
		<div class="contents clearfix">
			<div id="options_tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all clearfix">
HTML;

return $html;
  }

	protected function post() {
				$html = <<<EOT
							   </div>
		</div>				
	</div>
</div>
EOT;

return $html;
}


}

?>
