<?php

class PeThemeMeta {

	protected $master;
	protected $cache;
	protected $defaults = array();
	protected $keys = array();
    public $empty;

	public function __construct(&$master) {
		$this->master =& $master;
		$this->empty = new StdClass();
	}

	public function getDefaultMboxValues($mbox) {
		$def = new stdClass();
		foreach ($mbox as $name=>$content) {
			$def->$name = new stdClass();
			foreach ($content["content"] as $option=>$data) {
				$def->$name->$option = isset($data["default"]) ? $data["default"] : null;
			}
		}
		return $def;
	}

	public function getDefaultValues($type) {
		$mbox = $this->master->getMetaboxConfig($type);
		$this->keys[$type] = array_keys($mbox);
		$this->defaults[$type] = $this->getDefaultMboxValues($mbox);
	}

	public function the_preview_filter($post) {
		if (is_object($post) && !empty($post->post_title)) {
			$title = $post->post_title;
			$fixed = preg_replace('/ _pe_rev:\d+/','',$title);
			if ($fixed != $title) {
				$post->post_title = $fixed;
				$this->preview = $post->ID;
			}
		}
		return $post;
	}


	public function &get($postID = false,$type = "post") {
		if (!$postID) {
			global $post;
			if ($post) {
				$postID = $post->ID;
				$type = $post->post_type;
			} else {
				return $this->empty;
			}
		}
	
		if (isset($this->cache[$postID])) {
			return $this->cache[$postID];
		}

		$db = false;
		if ($postID) {
			$metaID = $postID;
			if (!empty($this->preview) && $postID == $this->preview) {
				// preview mode so we use meta stored in the autosave
				$preview = wp_get_post_autosave($postID);
				if (!empty($preview->ID)) {
					$metaID = $preview->ID;
				}
			}
			$db = maybe_unserialize(get_post_meta($metaID,PE_THEME_META,true));
		} 
			
		if (!isset($this->defaults[$type])) {
			$this->getDefaultValues($type);
		}
		if ($db) {
			$cache = new stdClass();
			$empty = array();
			foreach ($this->keys[$type] as $key) {
				if (!isset($db->$key)) {
					$db->$key = array();
				}
				$cache->{$key} = (object) array_merge( (array) $this->defaults[$type]->$key, (array) $db->$key);

			}
		} else {
			$cache =& $this->defaults[$type];
		}

		if ($postID) {
			$this->cache[$postID] =& $cache;
		}
		return $cache;
	}

}

?>
