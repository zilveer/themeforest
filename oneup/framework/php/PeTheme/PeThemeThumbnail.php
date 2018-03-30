<?php

class PeThemeThumbnail {

	public $master;
	protected $thumbs;
	protected $id;
	protected $orig;
	protected $width;
	protected $index;
	protected $key;
	protected $baseurl;
	protected $basedir;

	public function __construct($master) {
		$this->master =& $master;
		$upd = wp_upload_dir();
		$this->baseurl = $upd['baseurl'];
		$this->basedir = $upd['basedir'];
	}

	public function config($id = null) {
		if (!$id) {
			global $post;
			$id = $post->ID;
		}
		
		$url = wp_get_attachment_url($id);
		$key = str_replace($this->baseurl, '', $url);
		$this->index =& $this->master->image->generated;

		$thumbs = empty($this->index["index"][$key]) ? false : $this->index["index"][$key];

		if ($thumbs) {
			$this->thumbs = $thumbs;
			$this->orig = $url;
			$this->id = $id;
			$this->key = $key;
			$meta = wp_get_attachment_metadata($id);
			$this->width = $meta["width"];
		}

		return $thumbs;

	}


	public function admin() {
		$this->config();

		if ($this->thumbs) {
			add_action('pe_theme_metabox_config_attachment',array(&$this,'pe_theme_metabox_config_attachment'));
		}

	}

	public function ajax_image_crop() {
		$res = false;
		
		if (
			!current_user_can('edit_posts') || 
			empty($_REQUEST["nonce"]) || 
			!wp_verify_nonce($_REQUEST["nonce"],'pe_theme_image_crop')) {
			
			wp_send_json_error();
			wp_die(0);
		}
		$id = $_REQUEST["id"];
		$idx = $_REQUEST["idx"];
		$size = $_REQUEST["size"];
		list($w,$h) = explode("x",$size);
		$crop = $_REQUEST["crop"];
		$orig = $_REQUEST["orig"];


		$res = $this->master->image->crop($orig,$crop,$w,$h);

		if (!empty($res["cburl"])) {
			$res["idx"] = absint($idx);
			$meta = get_post_meta($id,PE_THEME_META,true);
			if (empty($meta)) {
				$meta = new StdClass();
				$meta->thumbnails = new StdClass();
			}
			$meta->thumbnails->thumbs[$size] = $crop;
			update_post_meta($id,PE_THEME_META,$this->update_attachment_metadata($meta,$id,null));
		}
		wp_send_json_success($res);
		wp_die(0);
	}

	public function save_crop_cache($thumbs) {
		foreach ($thumbs as $size => $crop) {
			if ($crop) {
				$thumb = str_replace($this->baseurl,"",preg_replace("/(\.\w+)$/","-$size\\1",$this->orig));
				$this->index["crop"][$thumb] = $crop;
			}			
		}
	}


	public function update_attachment_metadata($values,$id,$post) {

		if (empty($values->thumbnails->thumbs)) return $values;
		$thumbs =& $values->thumbnails->thumbs;

		$this->config($id);
		$this->save_crop_cache($thumbs);

		$this->master->image->stats();
		return $values;
	}


	public function pe_theme_metabox_config_attachment() {

		$thumbs = $this->thumbs;
		$options = array();

		foreach (array_keys($thumbs) as $size) {
			$thumb = preg_replace("/(\.\w+)$/","-$size\\1",$this->orig);
			$params = explode("x",$size);
			if (($file = $this->master->image->file($thumb)) === false || !is_readable($file)) continue;
			$params[] = filemtime($file);
			$options[$thumb] = $params;
		}

		$mbox = 
			array(
				  "title" => __("Thumbnails",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"thumbs" => 
						array(
							  "type" => "Thumbnails",
							  "orig" => $this->orig,
							  "width" => $this->width,
							  "id" => $this->id,
							  "thumbs" => $options,
							  "nonce" => wp_create_nonce("pe_theme_image_crop"),
							  "default"=>""
							  )
						)
				  );

		PeGlobal::$config["metaboxes-attachment"]["thumbnails"] = $mbox;
	}

	public function clean($delete = false) {
		$image =& $this->master->image;

		if (empty($image->generated["index"])) {
			return false;
		}

		if ($delete) {
			$upd = wp_upload_dir();
			$basedir = $upd['basedir'];

			foreach ($image->generated["index"] as $file => $thumbs) {

				foreach (array_keys($thumbs) as $size) {
					$thumb = $basedir.preg_replace("/(\.\w+)$/","-$size\\1",$file);
					if (is_writable($thumb)) {
						unlink($thumb);
					}
				}
			}
		}

		$image->generated["index"] = array();
		$image->stats();
	}

	public function media_row_actions_filter($actions,$post) {
		if (!empty($post->ID) && ($thumbs = $this->config($post->ID))) {
			$actions["thumbnails"] = 
				sprintf(
						'<a href="%s#pe_theme_meta_thumbnails">%s</a>',
						get_edit_post_link($post->ID),
						sprintf(__("Edit Thumbnails (%d)",'Pixelentity Theme/Plugin'),count($thumbs))
						);
		} 		
		return $actions;
	}

}

?>