<?php

class PeThemeMBox {

	protected $master;
	protected $metaboxes;
	protected $revision = false;
	protected $metas = false;
	protected $restored = false;

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

	public function wp_insert_post_data_filter($data,$postarr) {
		
		if (!empty($postarr['ID']) && !empty($postarr["page_template"]) && $postarr["page_template"] === "page_builder.php" && isset($postarr[PE_THEME_META]['builder'])) {

			try {
				$view = new PeThemeViewLayout();
				$conf = (object) 
					array(
						  "id" => $postarr['ID'],
						  "settings" => (object) $postarr[PE_THEME_META]['builder']
						  );

				ob_start();
				$view->output($conf);
				$content = ob_get_clean();
				$data["post_content"] = $content;
			} catch (Exception $e) {
			}			
		}

		return $data;
	}

	public function getPOSTvalues($id = null,$post = null) {

		if (!isset($_POST[PE_THEME_META])) {
			return null;
		}

		// this is needed to convert window-style line feeds to unix format, without doing so
		// all serialized values will breaks once exported into xml file
		array_walk_recursive($_POST[PE_THEME_META],array("PeThemeUtils","dos2unix"));

		$mboxes = array();
		$values = new stdClass(); 
		foreach ($_POST["pe_theme_meta"] as $mbox=>$data) {
			$mboxes[] = $mbox;
			$values->$mbox = new stdClass();
			foreach($data as $key=>$value) {
				$values->$mbox->$key = $value;
			}
		}
		
		if (!empty($id) && !empty($post)) {
			$values = apply_filters("pe_theme_update_metadata",$values,$id,$post);
		}

		if (!PE_THEME_PLUGIN) {
			$oldvalues = maybe_unserialize(get_post_meta($id,PE_THEME_META,true));
			if (is_object($oldvalues)) {
				// here's the thing: there are previously saved pe meta but since the plugin is not active
				// we can't just overwrite them with new values or else some content may be lost (for instance, content builder)
				// so instead of reaplcing the whole object, we just replace the mboxes found in $_POST
				foreach ($mboxes as $mbox) {
					$oldvalues->$mbox = $values->$mbox;
				}
				$values = $oldvalues;
			}
		}
		
		return $values;

	}


	public function save_post($id,$post) {
		if (!isset($_POST) || (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) || !isset($_POST["pe_theme_meta_nonce"]) ) {
			return;
		}

		if (is_object($post) && !empty($post->post_type) && $post->post_type == "nav_menu_item") {
			// do not set meta when a nav post item is autocreated for the page (which happens when menu -> auto add pages is active)
			return;
		}

		if (!wp_verify_nonce($_POST['pe_theme_meta_nonce'],PE_THEME_META) || wp_is_post_revision($id)) {
			return;
		}

		$values = $this->getPOSTvalues($id,$post);

		update_post_meta($id,PE_THEME_META,$values);
		$this->metas = $values;

		do_action("pe_theme_post_update_metadata",$values,$id,$post);

		if (!empty($this->revision)) {
			$this->revision_metadata($id,$values);
		}
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

	public function admin_action_editpost() {
		if (!empty($_POST) && !empty($_POST["wp-preview"]) && $_POST["wp-preview"] === "dopreview" && !empty($_POST['post_ID'])) {
			$post_id = $_POST['post_ID'];
			$revisions = wp_get_post_revisions($post_id);
			$revision = false;
			$autosave = false;
			$key = time();

			if (!empty($revisions)) {
				reset($revisions);
				list($key,$revision) = each($revisions);
			}
			
			if (!$this->revision_is_equal($revision)) {
				$autosave = true;
				if ($revision && !empty($revision->post_name)) {
					$name = $revision->post_name;
					if (strpos($name,"autosave") !== false) {
						wp_update_post(
									   array(
											 'ID' => $revision->ID,
											 'post_name' => str_replace("autosave","revision",$name),
											 'post_title' => preg_replace('/ _pe_rev:\d+/','',$revision->post_title)
											 )
									   );
					}
				}
			} elseif (!empty($revision->post_name) && strpos($revision->post_name,"autosave") !== false) {
				// ok, builder content hasn't changed but we still need to hack post title 
				// or else the autosave will be deleted
				$autosave = true;
			}

			if ($autosave) {
				// we force creation of new autosave
				$_POST['post_title'] .= sprintf(" _pe_rev:%d",$key);
			}

		}
	}

	public function save_post_revision($id,$revision) {
		if (strpos($revision->post_name,"autosave") !== false) {
			// if autosave, just gets meta from post values
			$this->metas = $this->getPOSTvalues($revision);
			if (!empty($this->metas)) {
				update_metadata('post', $id, PE_THEME_META, $this->metas);
			}
		} else if (!isset($this->revision[$id])) {
			$this->revision[$id] = $revision;

			if (!empty($revision->post_title)) {
				// fix title if needed
				$title = $revision->post_title;
				$fixed = preg_replace('/ _pe_rev:\d+/','',$title);
				if ($fixed != $title) {
					wp_update_post(
								   array(
										 'ID' => $id,
										 'post_title' => $fixed
										 )
								   );
				}
			}
		}
	}

	public function revision_metadata($id,$values) {
		if (!empty($this->revision)) {
			foreach ($this->revision as $rid => $revision) {
				if ($revision->post_parent == $id) {
					$remove[] = $id;
					update_metadata('post',$rid, PE_THEME_META, $values);
				}
			}
			if (!empty($remove)) {
				foreach ($remove as $rid) {
					unset($this->revision[$rid]);
				}
			}
		}
	}

	public function wp_restore_post_revision($id,$rid) {
		if (empty($id) || empty($rid)) {
			return;
		}
		
		$this->restored = true;

		$post = get_post($id);
		if (!empty($post->post_title) ) {
			$title = $post->post_title;
			$fixed = preg_replace('/ _pe_rev:\d+/','',$title);
			if ($fixed != $title) {
				wp_update_post(
							   array(
									 'ID' => $id,
									 'post_title' => $fixed
									 )
							   );
			}
		}

		$rmeta = maybe_unserialize(get_post_meta($rid,PE_THEME_META,true));

		if (!empty($rmeta) && (is_array($rmeta) || is_object($rmeta))) {
			// restore meta from revision
			update_post_meta($id,PE_THEME_META,$rmeta);

			if (!empty($this->revision)) {
				// save restored metadata in newly created revisions as well
				$this->revision_metadata($id,$rmeta);
			}

		}
	}

	public function revision_is_equal($rev) {
		// get meta saved in revision
		$rev = empty($rev->ID) ? $rev : $rev->ID;
		$rmeta = empty($rev) ? false : maybe_unserialize(get_post_meta($rev,PE_THEME_META,true));

		$values = $this->getPOSTvalues();
		
		// get prev/current builder content
		$oldbuilder = isset($rmeta->builder) ? serialize($rmeta->builder) : false;
		$newbuilder = isset($values->builder) ? $values->builder : false;

		if ($newbuilder) {
			if (function_exists('wp_unslash')) {
				$newbuilder = wp_unslash($newbuilder);
			}
			$newbuilder = serialize($newbuilder);
		}

		return (($oldbuilder || $newbuilder) && ($newbuilder != $oldbuilder)) ? false : true;
	}


	public function wp_save_post_revision_check_for_changes($value,$rev,$post) {
		$screen = get_current_screen();
		if (!empty($screen) && $screen->base === "revision" && !empty($_REQUEST['action'] ) && $_REQUEST['action'] === "restore") {
			// if not yet restored, force revision creation
			return $this->restored;
		}

		if (empty($rev->ID) || empty($_POST[PE_THEME_META])) {
			return $value;
		}

		// get meta saved in last revision
		$rmeta = maybe_unserialize(get_post_meta($rev->ID,PE_THEME_META,true));

		$values = $this->getPOSTvalues();
	
		// get prev/current builder content
		$oldbuilder = isset($rmeta->builder) ? serialize($rmeta->builder) : false;
		$newbuilder = isset($values->builder) ? $values->builder : false;

		if ($newbuilder) {
			if (function_exists('wp_unslash')) {
				$newbuilder = wp_unslash($newbuilder);
			}
			$newbuilder = serialize($newbuilder);
		}

		if (($oldbuilder || $newbuilder) && ($newbuilder != $oldbuilder)) {
			// force new revision
			return false;
		}

		return $value;
	}

	public function builderLayout($items,$level = 1) {
		static $cache;

		empty ( $layout ) && $layout = '';

		if (is_array($items)) {
			foreach ($items as $item) {
				if (!empty($item["type"])) {
					$type = $item["type"];
					$text = $type === 'Text';
					if (isset($cache[$type])) {
						$type = $cache[$type];
					} else {
						$mclass = "PeThemeViewLayoutModule$type";
						if (class_exists($mclass)) {
							$type = new $mclass();
							$type = $type->name();
							$cache[$type] = $type;
						} 
					}
					$layout .= sprintf('%s [%s]',str_repeat('-',$level),$type);
					
					if ($text) {
						$layout .= "\n" . $item["data"]["content"];
					}

					if (!empty($item["data"]["title"])) {
						$layout .= sprintf(' %s',$item["data"]["title"]);
					} elseif ($item["type"] === 'View' && !empty($item["data"]["id"])) {
						$view = get_post($item["data"]["id"]);
						if (!empty($view->post_title)) {
							$layout .= sprintf(' %s',$view->post_title);
						}
					}					
				}
				$layout .= "\n";
				if (!empty($item["items"])) {
					$layout .= $this->builderLayout($item["items"],$level+1);
				}
			}
		}

		return $layout;
	}

	public function _wp_post_revision_field_post_content($value, $field, $compare_to,$direction) {
		if (is_object($compare_to) && !empty($compare_to->ID)) {
			$meta = maybe_unserialize(get_post_meta($compare_to->ID,PE_THEME_META,true));
			$bvalue = "";
			if (!empty($meta->builder->builder["items"])) {
				$layout = $this->builderLayout($meta->builder->builder["items"]);
				$bvalue = sprintf("%s\n%s",__('Page Builder Content','Pixelentity Theme/Plugin'),$layout);
			} else if ( ! empty( $meta->{'settings-Layout'}->builder["items"] ) ) { // Append view builder layout to revisions browsing screen

				$layout = $this->builderLayout( $meta->{'settings-Layout'}->builder["items"] );
				$bvalue = sprintf("%s\n%s", __( 'Layout Builder Content' ,'Pixelentity Theme/Plugin'), $layout );

			}
			if ($bvalue) {
				$value = sprintf("%s\n\nEditor\n%s",$bvalue,$value);
			}
		}

		return $value;
	}

	public function _wp_post_revision_field_post_title($value, $field, $compare_to,$direction) {
		if (!empty($compare_to->post_name) && strpos($compare_to->post_name,"autosave")) {
			if (!empty($compare_to->post_title)) {
				$compare_to->post_title = preg_replace('/ _pe_rev:\d+/','',$compare_to->post_title);
			}
			return preg_replace('/ _pe_rev:\d+/','',$value);
		}
		return $value;
	}

	


}

?>