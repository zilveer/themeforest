<?php

class PeThemeExport {

	protected $master;
	protected $importer;
	protected $dummyImg = 0;
	public $demo;
	public $success;
	public $messages;

	protected $rCount = 0;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->demo = PE_THEME_PATH."/demo/demo.xml";	
	}

	public function getWidgetsConf() {
		$sb_widgets = get_option('sidebars_widgets');
		$options = array();
		foreach($sb_widgets as $sidebar => $widgets){
			if(is_array($widgets)){
				foreach($widgets as $name){
					$name = preg_replace('/-\d+$/','',$name);
					$options[$name] = get_option("widget_$name");
				}
			}
		}
		$conf["sidebar"] = $sb_widgets;
		$conf["options"] =& $options;
		return $conf;
	}

	public function getWPConf() {
		$names = array(
					   "show_on_front",
					   "page_on_front",
					   "page_for_posts",
					   "posts_per_page"
					   );
		foreach ($names as $name) {
			$o[$name] = get_option($name);
			if ($name == "page_on_front" || $name == "page_for_posts") {
				$page = get_post($o[$name]);
				if ($page) {
					$o[$name] = $page->post_name;
				}
			}
		}
		return $o;
	}


	public function importOptions($custom) {
		if (@$custom) {

			$options = $this->master->options->all();
			foreach ($custom as $key => $value) {
				if (!is_string($value) || strpos($value,"http://") !== 0) {
					$options->{$key} = $value;
				}
			}
			$this->master->options->save($options);
		}
	}

	public function importWidgets($custom) {
		if (!@$custom || !@is_array($custom["sidebar"]) || !@is_array($custom["options"])) return; 
		update_option("sidebars_widgets",$custom["sidebar"]);

		// when importing widget conf, rewrite any absolute url pointing to original theme folder 
		$origThemeAssetUrl = $this->importer->getOrigThemeAssetUrl();
		$newThemeAssetUrl = PE_THEME_URL;

		foreach ($custom["options"] as $name => $value) {
			$value = serialize($value);
			if (strpos($value,$origThemeAssetUrl) !== false) { 
				$value = PeThemeUtils::fix_serialize(str_replace($origThemeAssetUrl,$newThemeAssetUrl,$value));
			}
			$value = maybe_unserialize($value);
			update_option("widget_$name",$value);
		}
	}

	public function importConf($custom) {
		if (!is_array($custom)) return;
		foreach ($custom as $key => $value) {
			if ($key == "page_on_front" || $key == "page_for_posts") {
				$page = get_page_by_path($value);
				if ($page) {
					$value = $page->ID;
				}
			}
			update_option($key,$value);
		}
	}


	public function rss2_head() {
		if (defined("PE_EXPORT_DEMO_CONTENT")) {
			$custom["options"] = $this->master->options->all();
			$custom["widgets"] = $this->getWidgetsConf();
			$custom["conf"] = $this->getWPConf();
			printf('%s<pe_theme_export><![CDATA[%s]]></pe_theme_export>',"\t",base64_encode(serialize($custom)));
			
			global $wpdb;
			$pt = $wpdb->posts;
			$wpdb->query("UPDATE $pt SET $pt.post_status = 'inherit' WHERE $pt.post_type = 'attachment';");
		}
	}


	public function export_wp() {
		// the following is just for development, do not set this constant
		if (defined("PE_EXPORT_DEMO_CONTENT")) {
			global $wpdb;
			$pt = $wpdb->posts;
			$wpdb->query("UPDATE $pt SET $pt.post_status = 'auto-draft' WHERE $pt.post_type = 'attachment';");
			$wpdb->query("UPDATE $pt SET $pt.post_status = 'inherit' WHERE $pt.post_type = 'attachment' order by $pt.ID DESC LIMIT 4;");
			// rewrites attachment url
			add_filter("wp_get_attachment_url",array(&$this,"wp_get_attachment_url_filter"),10,2);
		}
	}

	public function wp_get_attachment_url_filter($url,$id) {
		$img = "img".(($this->dummyImg % 4)+1) .".jpg";
		$this->dummyImg++;
		$url = str_replace(home_url(),"",PE_THEME_URL)."/demo/$img";
		return $url;
	}

	public function createImporter() {
		$current_plugins = get_option( 'active_plugins' );
		if (!class_exists("WP_Import")) {
			if (!defined("WP_LOAD_IMPORTERS")) define("WP_LOAD_IMPORTERS",true);
			require_once(PE_FRAMEWORK."/php/lib/importer/wordpress-importer.php");
		}

		$this->importer = new PeThemeImporter();
		$this->importer->fetch_attachments = true;
	}

	public function importDemo() {
		$this->success = false;
		$this->messages = "";
		$this->createImporter();
		set_time_limit(0);
		ob_start();
		add_action("import_end",array(&$this,"import_end"));
		add_action("wp_insert_post",array(&$this,"update_progress"));
		$this->importer->import($this->demo);

		// debug
		//$this->importer->import_start($this->demo);
		//$this->import_end();

		return $this->success;
	}

	// called by wp importer on successful import
	public function import_end() {
		$this->messages = ob_get_contents();
		$this->success = true;
		ob_end_clean();
		if (defined("PE_THEME_IMPORT_DEBUG") && PE_THEME_IMPORT_DEBUG) {
			print $this->messages;
		}

		// sets menu
		$locations = PeGlobal::$config["nav-menus"];
		$menus = get_terms('nav_menu');
		$update = array();
		foreach($menus as $menu){
			$slug = str_replace("-menu","",$menu->slug);
			if (@$locations[$slug]) {
				$update[$slug] = $menu->term_id;
			}
		}
		if (count($update) > 0) {
			set_theme_mod("nav_menu_locations",$update);
		}

		// fix menu page parent
		$menus = get_terms('nav_menu');
		foreach ($menus as $menu) {
			$id = $menu->term_id;
			$items = wp_get_nav_menu_items($id, array( 'post_status' => 'publish,draft' ) );
			foreach ($items as $item) {
				if ($item->object == "page") {
					$item->post_parent = get_post_field('post_parent',$item->object_id);
					wp_update_post($item);
				}
			}
		}

		$raw = file_get_contents($this->demo);
		// extact our custom data
		// doesn't seem to work on windows server ..... 
		//preg_match("/<pe_theme_export><!\[CDATA\[(.+)\]\]><\/pe_theme_export>/s",$raw,$matches);

		// safer method for fetching the data
		$openTag = "<pe_theme_export><![CDATA[";
		$closeTag = "]]></pe_theme_export>";

		$start = strpos($raw,$openTag);
		if ($start !== false) {
			$start += strlen($openTag);
			$end = strpos($raw,$closeTag,$start);
			if ($end !== false) {
				$raw = substr($raw,$start,$end-$start);
				if ($raw) {
					$custom = @unserialize(base64_decode($raw));
					if (@$custom["options"]) $this->importOptions($custom["options"]);
					if (@is_array($custom["widgets"])) $this->importWidgets($custom["widgets"]);
					if (@is_array($custom["conf"])) $this->importConf($custom["conf"]);
				}
			}
		}

		// fix ids
		$this->fixIDS();

		// for debugging
		//$this->importer->remap_featured_images();
		//$this->importer->backfill_attachment_urls();
	}

	public function progress() {
		return get_transient("pe_theme_import_progress");
	}

	public function fixIDS() {
		$map = $this->importer->ids_mapping();

		global $wpdb;
		$pt = $wpdb->posts;
		$pm = $wpdb->postmeta;
		$op = $wpdb->options;

		// fix shortcodes
		$posts = $wpdb->get_results("SELECT ID,post_content FROM $pt WHERE $pt.post_content LIKE '%id=%'");
		if (is_array($posts)) {

			foreach($posts as $post) {
				$content = $post->post_content;
				$replace = array();
				if (preg_match_all('/(id)="(\d+)"/',$content,$matches,PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$id = $match[2];
						$newID = isset($map[$id]) ? $map[$id] : false;
						if ($newID && $id != $newID ) {
							$key = $match[1];
							$replace[sprintf('%s="%s"',$key,$id)] = sprintf('%s="%s"',$key,$newID);
						}
					}
					if (count($replace) > 0) {
						$wpdb->update($pt,array("post_content"=>strtr($content,$replace)),array("ID"=>$post->ID));
					}
				}
			}
		}

		/*
		// fix post metas
		$metaKey = "pe_theme_meta";
		$posts = $wpdb->get_results("SELECT post_id,meta_value FROM $pm WHERE $pm.meta_key = '$metaKey'");
		if (is_array($posts)) {
			foreach($posts as $post) {
				$value = $post->meta_value;
				$replace = array();
				if (preg_match_all('/("id")/',$value,$matches,PREG_SET_ORDER)) {
				}
			}
		}
		*/

	}


	public function update_progress() {
		if ($this->importer) {
			$this->importer->updateStats();
		}
	}




}

?>
