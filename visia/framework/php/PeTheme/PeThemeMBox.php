<?php

class PeThemeMBox {

	protected $master;
	protected $metaboxes;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function add_meta_boxes($page,$object) {
		if (!isset($object->ID)) return;

		$values = get_post_meta($object->ID,PE_THEME_META,true);
		$metaboxes = $this->master->getMetaboxConfig($page);

		$count = 0;
		foreach ($metaboxes as $name => $data) {
			//if (in_array($page,explode(",",$data["where"]))) {
			if (isset($data["where"][$page])) {
				$type = isset($data["type"]) ? $data["type"] : "";
				$metaboxClass = "PeThemeMetaBox{$type}";
				if (isset($values) && isset($values->$name)) {
					$data["value"] = $values->$name;
				}

				$metabox = new $metaboxClass($this,$name,$data); 
				$this->metaboxes[] = $metabox;
				add_meta_box("pe_theme_meta_$name",$data['title'],array($metabox,"render"),$page,isset($data["context"]) ? $data["context"] : "normal",isset($data["priority"]) ? $data["priority"] : "default");
				$count++;
			}
		}
		if ($count > 0) {
			add_action("dbx_post_sidebar",array(&$this,"dbx_post_sidebar"));
		}

	}

	public function dbx_post_sidebar() {
		wp_nonce_field('pe_theme_meta','pe_theme_meta_nonce');
	}

	public function save_post($id,$post) {

		if (!isset($_POST) || (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) || !isset($_POST["pe_theme_meta_nonce"]) ) {
			return;
		}

		if (!wp_verify_nonce($_POST['pe_theme_meta_nonce'],'pe_theme_meta') || wp_is_post_revision($id)) {
			return;
		}

		// this is needed to convert window-style line feeds to unix format, without doing so
		// all serialized values will breaks once exported into xml file
		array_walk_recursive($_POST["pe_theme_meta"],array("PeThemeUtils","dos2unix"));

		$values = new stdClass(); 
		foreach ($_POST["pe_theme_meta"] as $box=>$data) {
			$values->$box = new stdClass();
			foreach($data as $key=>$value) {
				$values->$box->$key = $value;
			}
		}

		update_post_meta($id,PE_THEME_META,apply_filters("pe_theme_update_metadata",$values,$id,$post));
		do_action("pe_theme_post_update_metadata",$values,$id,$post);
	}

	public function edit_attachment($id) {

		if (!isset($_POST['pe_theme_meta']) || !isset($_POST['pe_theme_meta_nonce']) || !wp_verify_nonce($_POST['pe_theme_meta_nonce'],'pe_theme_meta')) {
			return;
		}

		// this is needed to convert window-style line feeds to unix format, without doing so
		// all serialized values will breaks once exported into xml file
		array_walk_recursive($_POST["pe_theme_meta"],array("PeThemeUtils","dos2unix"));

		$values = new stdClass(); 
		foreach ($_POST["pe_theme_meta"] as $box=>$data) {
			$values->$box = new stdClass();
			foreach($data as $key=>$value) {
				$values->$box->$key = $value;
			}
		}

		global $post;

		update_post_meta($id,PE_THEME_META,apply_filters("pe_theme_update_attachment_metadata",$values,$id,$post));
		do_action("pe_theme_post_update_attachment_metadata",$values,$id,$post);
	}

}

?>