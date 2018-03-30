<?php

class PeThemeAdmin {

	protected $master;
	protected $options;
	protected $form;
	protected $screen;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->options =& $this->master->options->all();
		add_action("current_screen",array(&$this,"current_screen"));

		add_action( 'admin_print_styles', array( $this, 'fix_posts_table_column_width' ) );
		
		if (apply_filters("pe_theme_menu_custom_fields",false) !== false) {
			$this->master->menu->admin();
		}
		
	}

	public function fix_posts_table_column_width() {

		if ( ! function_exists( 'get_current_screen' ) ) {

			return;

		}

		$current_screen = get_current_screen();

		if ( 'edit' !== $current_screen->base ) {

			return;

		}

		?>

		<style type="text/css">.fixed tr .column-icon { width: 80px; }</style>

		<?php

	}

	public function admin_menu() {
		if (PE_THEME_MODE) {
			$options_page = add_theme_page(
										   __('Theme Options','Pixelentity Theme/Plugin'),   
										   __('Theme Options','Pixelentity Theme/Plugin'),
										   'edit_theme_options',
										   'pe_theme_options',
										   array(&$this,"theme_options")
										   );
		} else {
			$options_page = false;
		}

		$this->registerAssets();
		wp_enqueue_style("pe_theme_admin_icons");

        if ($options_page) {
			add_action("load-$options_page",array(&$this,"page"));
		}

		if ( ! empty( $this->options->updateCheck ) && $this->options->updateCheck == "yes" && ($username = $this->master->options->updateUsername) && ($key = $this->master->options->updateAPIKey) ) {
			require_once(PE_FRAMEWORK."/php/lib/pixelentity-theme-update/class-pixelentity-theme-update.php");
			PixelentityThemeUpdate::init($username,$key,apply_filters("pe_theme_author","Pixelentity"));
		}
		
	}

	public function update_check($data) {
		return $this->master->update->update_check($data);
	}


	public function theme_update() {
		$this->master->update->theme_update();
	}


	public function add_non_menu_page($slug,$callback) {
		global $_registered_pages;
		$hookname = get_plugin_page_hookname($slug, '');
		if (!empty($hookname)) {
			add_action($hookname, $callback);
		}
		$_registered_pages[$hookname] = true;
		return $hookname;
	}

	public function admin_init() {
		add_action('wp_ajax_pe_theme_options_save', array(&$this, 'options_save'));
		add_action('wp_ajax_pe_theme_builder_save_revision', array(&$this, 'builder_save_revision'));
		add_filter("pe_theme_options_save",array(&$this,"pe_theme_options_save_filter"));
		add_action('wp_ajax_pe_theme_import_demo', array(&$this, 'import_demo'));
		add_action('wp_ajax_pe_theme_import_progress', array(&$this, 'import_progress'));
		add_action('wp_ajax_pe_theme_image_resize',array(&$this,'ajax_image_resize'));
		add_action('wp_ajax_pe_theme_featured_image',array(&$this,'ajax_featured_image'));
		add_action('wp_ajax_pe_theme_image_crop',array(&$this,'ajax_image_crop'));
		add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'),1);
		add_action('edit_attachment',array(&$this, 'edit_attachment'),1);
		add_filter("media_row_actions",array(&$this,"media_row_actions_filter"),10,2);

		add_editor_style(apply_filters("pe_theme_editor_style","framework/css/editor.css"));


		if ($this->options->adminThumbs === "yes") {
			// extra thumbs columns
			$types = array("post","page");

			if (!empty(PeGlobal::$config["post_types"])) {
				$types = array_merge($types,array_keys(PeGlobal::$config["post_types"]));
			}

			foreach ($types as $type) {
				add_filter("manage_edit-{$type}_columns",array(&$this,"manage_edit_post_columns_filter"));
			}
			add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));
		}

		// project extra columns
		add_filter("manage_edit-project_columns",array(&$this,"manage_edit_project_columns_filter"));
		add_action("manage_posts_custom_column", array(&$this,"manage_posts_custom_column"),10,2);

		// WPML strings
		add_action("load-wpml-string-translation/menu/string-translation.php",array(&$this,"wpml_register_strings"));

		// add gallery managment
		$this->master->gallery->instantiate();

		if (isset(PeGlobal::$config["additional-media-thumbs"])) {
			add_filter("image_size_names_choose",array(&$this,"image_sizes_names_choose"));
		}

		add_action("edit_form_after_title",array(&$this,"edit_form_after_title"));
	}

	public function edit_attachment() {
		add_filter("pe_theme_update_attachment_metadata",array(&$this,"pe_theme_update_attachment_metadata_filter"),10,3);
	}
	
	public function pe_theme_update_attachment_metadata_filter($values,$id,$post) {
		return $this->master->thumbnail->update_attachment_metadata($values,$id,$post);
	}

	public function media_row_actions_filter($actions,$post) {
		return $this->master->thumbnail->media_row_actions_filter($actions,$post);
	}



	public function admin_enqueue_scripts() {

		$screen = get_current_screen();

		/*
		$field = new PeThemeFormElementIcon("","",$null);
		$field->registerAssets();
		*/

		if ($screen->base === "edit") {
			if (function_exists("wp_enqueue_media")) {
				wp_enqueue_media();
				wp_enqueue_script("pe_theme_edit");
			}
		}
	}

	public function edit_form_after_title() {
		$screen =& $this->screen;
		$type = $screen->post_type;

		if (($options = apply_filters("pe_theme_admin_quicknav_options_$type",array())) === false) return;

		if (empty($options)) {
		
			$params = 
				array(
					  "post_type"=>$type,
					  "suppress_filters"=>false,
					  "posts_per_page"=>-1
					  );

			if (true || $type === "page") {
				$params["orderby"] = "title";
				$params["order"] = "ASC";
			}

			$posts = get_posts($params);

			if (count($posts) > 0) {
				foreach($posts as $post) {
					$key = $post->post_title;
					if (isset($options[$key])) {
						$key = sprintf("%s id:%s",$post->post_title,$post->ID);
					}
					$options[$key] = $post->ID;
				}

				//$options = array_merge(array(__("Quick Navigation",'Pixelentity Theme/Plugin') => ""),$options);
			} 
		}

		if ($options) {
			$id = $GLOBALS['post']->ID;

			$params =
				array(
					  "noscript" => true,
					  "options" => $options,
					  "groups" => is_array(reset($options)),
					  "default" => $id
					  );

			$item = new PeThemeFormElementSelectPlain("","pe_admin_quick_nav",$params);
			$item->render();
			printf('<script>(function($){$("#pe_admin_quick_nav").appendTo("#wpbody-content h2:first").change(function(){if(v=$(this).val()) location.href=("%s".format(v))});}(jQuery))</script>',str_replace($id,"%0",get_edit_post_link($id,"&")));
		}
	}


	public function wpml_register_strings() {
		$this->master->wpml->register_strings();
	}

	public function ajax_image_resize() {
		$img = $_REQUEST["img"];
		$w = $_REQUEST["w"];
		$h = $_REQUEST["h"];
		if (!empty($_REQUEST["isID"])) {
			$img = wp_get_attachment_url($img);
		}

		header("Content-Type: application/json");
		echo json_encode(array("orig" => $img,"resized" => $this->master->image->resize($img,$w,$h)));

		die();
	}

	public function ajax_image_crop() {
		$this->master->thumbnail->ajax_image_crop();
	}

	public function ajax_featured_image() {

		$res = null;
		$postID = empty($_REQUEST["postID"]) ? false : $_REQUEST["postID"];
		$featID = empty($_REQUEST["ID"]) ? false : $_REQUEST["ID"];
  
		if ($postID && $featID) {
			set_post_thumbnail($postID,$featID);
			$res["img"] = get_the_post_thumbnail($postID,array(80,80));
		}

		wp_send_json_success($res);
		wp_die(0);

	}

	public function listTags($id,$tax,$custom,$page) {

		$tags = wp_get_post_terms($id,$tax);
		if ( !empty( $tags ) ) {
			$out = array();
			foreach ( $tags as $c ) {
				$out[] = sprintf( '<a href="%s">%s</a>',
								  esc_url(add_query_arg(array($tax => $c->name,"post_type"=>$custom),$page)),
								  esc_html(sanitize_term_field( 'name', $c->name, $c->term_id, 'tag', 'display' ) )
								  );
			}
			echo join( ', ', $out );
		} else {
			echo __("No Tags",'Pixelentity Theme/Plugin');
		}
	}

	public function manage_edit_post_columns_filter($cols) {
		$cb = $cols["cb"];
		unset($cols["cb"]);
		$cols = array_merge(
							array(
								  "cb" => $cb,
								  "icon" => ""
								  ),
							$cols
							);
		return $cols;
	}

	public function manage_edit_project_columns_filter($cols) {
		$date = $cols["date"];
		unset($cols["date"]);
		$cols["pe_project_tags"] = __("Tags",'Pixelentity Theme/Plugin');
		$cols["date"] = $date;
		return $cols;
	}

	public function manage_posts_custom_column($column_name,$id) {
		switch ($column_name) {
		case "icon":
			$fid = get_post_thumbnail_id();
			if ($fid) {
				printf('<a class="pe-set-featured" href="#" data-post-id="%s" data-feat-id="%s">',$id,$fid);

				echo get_the_post_thumbnail($id,array(80,80));
				echo '</a>';
			}
			break;
		case "pe_project_tags":
			$this->listTags($id,"prj-category","project","edit.php");
			break;
		}
	}
	
	public function image_sizes_names_choose($image_sizes) {
		return array_merge($image_sizes,PeGlobal::$config["additional-media-thumbs"]);
	}

	public function page() {
		wp_enqueue_script("pe_theme_admin");
		do_action("pe_theme_admin_options");
		
		$this->form = new PeThemeAdminForm($this,"pe_theme_options",PeGlobal::$config["options"],$this->options);
		$this->form->build();
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.utils.js",array(),"pe_theme_utils");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.tooltip.js",array('jquery','jquery-ui-tooltip','pe_theme_utils'),"pe_theme_tooltip");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.admin.js",array('jquery','jquery-ui-core','jquery-ui-tabs', 'jquery-ui-sortable','pe_theme_tooltip','pe_theme_utils'),"pe_theme_admin");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.edit.js",array(),"pe_theme_edit");
		PeThemeAsset::addStyle("framework/css/ui/jquery-ui-1.8.17.custom.css",NULL,"pe_theme_admin_ui");
	    PeThemeAsset::addStyle("framework/css/customadminicons.css",array(),"pe_theme_admin_icons");
		PeThemeAsset::addStyle("framework/css/admin.css",array("pe_theme_admin_ui","pe_theme_admin_icons"),"pe_theme_admin");
		//PeThemeAsset::addStyle("framework/css/admin.css",array("pe_theme_admin_icons"),"pe_theme_admin");
	
	}
	
	public function options_save() {
		if (!$_POST || !wp_verify_nonce($_POST['pe_theme_form_nonce'],'pe_theme_form')) {
			$result = json_encode( array("options" => Array(),"ok"=>false));
		} else {

			// this is needed to convert window-style line feeds to unix format, without doing so
			// all serialized values will breaks once exported into xml file
			array_walk_recursive($_POST["pe_theme_options"],array("PeThemeUtils","dos2unix"));

			$options = array_map('stripslashes_deep',$_POST["pe_theme_options"]);
			$this->master->options->save($options);
			$this->options =& $options;
			$result = json_encode( array("options" => $options,"ok"=>true));
		}
		header("Content-Type: application/json");
		echo $result;
		die();
	}

	public function builder_save_revision() {
		$this->master->metabox->ajax_builder_save_revision();
	}

	public function pe_theme_options_save_filter($options) {
		if (!empty($options->thumbscache)) {
			$options->thumbscache = "";
			$this->master->thumbnail->clean($options->thumbscache === "files");
		}
		return $options;
	}


	// sets post formats according to custom post type
	public function current_screen($screen) {
		if (!$screen) return;
		if (!@$screen->post_type) return;
		$this->screen =& $screen;
		$config =& PeGlobal::$config;
		if (isset($config["post-formats-".$screen->post_type]) ) {
			add_theme_support("post-formats",$config["post-formats-".$screen->post_type]);
		}

	}

	public function add_meta_boxes() {
		$screen = $this->screen;
		if ($screen->base === "post" && $screen->id === "attachment") {
			$this->master->thumbnail->admin();
		}
	}
	
	public function theme_options() {
		echo '<div class="wrap"><div id="icon-themes" class="icon32"><br /></div><h2>'.__("Theme Options",'Pixelentity Theme/Plugin').'</h2>';
		$this->form->render();
		echo "</div>";
		do_action("pe_theme_admin_options_render");
	}

	public function import_demo() {
		if (!$_POST || !@$_POST['nonce'] || !wp_verify_nonce($_POST['nonce'],"pe_theme_import_demo")) {
			$result = json_encode(array("ok"=>false,"message" => __("You don't have sufficient permissions",'Pixelentity Theme/Plugin')));
		} else {
			$result = $this->master->export->importDemo();
			$result = json_encode(array("ok"=>$result));
		}
		header("Content-Type: application/json");
		echo $result;
		die();
	}

	public function import_progress() {
		$progress = $this->master->export->progress();
		$result = json_encode($progress);
		header("Content-Type: application/json");
		echo $result;
		die();
	}

}

?>
