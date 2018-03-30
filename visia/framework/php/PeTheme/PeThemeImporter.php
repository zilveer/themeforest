<?php

class PeThemeImporter extends WP_Import {
	public $aCount = 0;
	public $aImported = array();
	public $origUploadUrl;
	public $stats;

	public function process_attachment($postdata, $remote_url) {
		$this->updateStats();
		if (count($this->aImported) < 4) {
			if (!$this->origUploadUrl) {
				$tokens = pathinfo($postdata["guid"]);
				$this->origUploadUrl = preg_replace("#/\d+/\d+/?#","",$tokens["dirname"]);
			}
			$current = $this->aCount+1;
			$remote_url = PE_THEME_URL."/demo/img$current.jpg";
			$postdata["post_name"] = $postdata["post_title"];
			$id = parent::process_attachment($postdata,$remote_url);
			if ($id) {
				$this->aImported[] = $id;
				$this->aCount++;
			}
			return $id;
		}  
		return new WP_Error('broke', __("I've fallen and can't get up",'Pixelentity Theme/Plugin'));
	}

	public function import_start($file) {
		$this->updateStats(__("Parsing import file",'Pixelentity Theme/Plugin'));
		parent::import_start($file);
	}

	public function process_categories() {
		$this->updateStats(__("Importing categories",'Pixelentity Theme/Plugin'));
		parent::process_categories();
	}

	public function process_terms() {
		$this->updateStats(__("Importing terms",'Pixelentity Theme/Plugin'));
		parent::process_terms();
	}

	public function process_posts() {
		$this->updateStats(__("Importing posts",'Pixelentity Theme/Plugin'));
		parent::process_posts();
	}

	public function backfill_parents() {
		$this->updateStats(__("Fixing orphans",'Pixelentity Theme/Plugin'));
		parent::backfill_parents();
	}

	public function process_menu_item($item) {
		$this->updateStats();
		parent::process_menu_item($item);
	}

	public function backfill_attachment_urls() {
		$this->updateStats(__("Fixing urls",'Pixelentity Theme/Plugin'),true);
		$url = $this->origUploadUrl;
		
		global $wpdb;
		$pt = $wpdb->posts;
		$pm = $wpdb->postmeta;
		$op = $wpdb->options;

		// replace all img/links pointing to an attachment (not imported) with url of first imported attachment		
		$posts = $wpdb->get_results("SELECT ID,post_content FROM $pt WHERE $pt.post_content LIKE '%$url%'");
		if (is_array($posts)) {

			$url = addcslashes($url,"/");
			$replace = wp_get_attachment_url($wpdb->get_var("SELECT ID FROM $pt WHERE $pt.post_type = 'attachment' LIMIT 1"));
			foreach($posts as $post) {
				$newContent = preg_replace("/{$url}[^\"]+\.(jpg|jpeg|gif|png)/i",$replace,$post->post_content);
				if ($newContent != $post->post_content) {
					$wpdb->update($pt,array("post_content"=>$newContent),array("ID"=>$post->ID));
				}
			}
		}

		// replaces all img/links pointing to an attachment residing in theme folder.
		$origThemeAssetUrl = $this->getOrigThemeAssetUrl();		
		$newThemeAssetUrl = PE_THEME_URL;

		// fix post metas
		$metaKey = 'pe_theme_meta';
		$posts = $wpdb->get_results("SELECT post_id,meta_value FROM $pm WHERE $pm.meta_key = '$metaKey'");
		if (is_array($posts)) {
			foreach($posts as $post) {
				$value = $post->meta_value;
				if (strpos($value,$origThemeAssetUrl) !== false) { 
					$value = PeThemeUtils::fix_serialize(str_replace($origThemeAssetUrl,$newThemeAssetUrl,$value));
					update_post_meta($post->post_id,$metaKey,maybe_unserialize($value));					
				}
			}
		}
	}
	
	public function getOrigThemeAssetUrl() {
		return "{$this->base_url}/wp-content/themes/".strtolower(PE_THEME_NAME);
	}


	public function remap_featured_images() {
		$this->updateStats(__("Remapping images",'Pixelentity Theme/Plugin'),true);
		global $wpdb;
		$mt = $wpdb->postmeta;
		$pt = $wpdb->posts;

		// get attachments id
		$aIDS = $wpdb->get_col("SELECT ID FROM $pt WHERE $pt.post_type = 'attachment'");

		// get post ids which have a feat image
		$pIDS = $wpdb->get_col("SELECT post_id FROM $mt WHERE meta_key = '_thumbnail_id'");
		
		if (!is_array($pIDS) || !is_array($aIDS)) return;

		$count = 0;
		foreach ($pIDS as $id) {
			// remap feat image
			update_post_meta($id,'_thumbnail_id',$aIDS[$count % 4]);
			$count++;
		}

		// get all media tags
		$tags = get_terms(PE_MEDIA_TAG,array("hide_empty"=>false,"fields"=>"names"));

		// assign each attachment to all media tags
		foreach ($aIDS as $id) {
			wp_set_post_terms($id,$tags,PE_MEDIA_TAG,false);
		}
	}

	public function import_end() {
		$this->updateStats(__("Final cleanup",'Pixelentity Theme/Plugin'),true);
		parent::import_end();
	}

	public function &ids_mapping() {
		return $this->processed_posts;
	}


	public function updateStats($message = "",$done = false) {
		$stats =& $this->stats;

		if (!@$stats["total"]) {
			$stats["total"] = count($this->posts);
		}

		if ($message) {
			$stats["step"] = $message;
		}

		if ($done && @$stats["total"]) {
			$stats["progress"] = $stats["total"];
		} else if (!@$stats["progress"] || ($stats["progress"] < $stats["total"])) {
			$stats["progress"] = min((count($this->processed_posts)+count($this->processed_menu_items)),$stats["total"]);
		}

		//$stats["posts"] = count($this->processed_posts);
		//$stats["menus"] = count($this->processed_menu_items);

		set_transient("pe_theme_import_progress",$stats,60*5);
	}

}

?>
