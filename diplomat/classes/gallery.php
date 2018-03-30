<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Gallery {

	public static $slug = 'gall';

	public static function init() {
		//self::init_meta_boxes();
		add_filter("manage_gall_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_gall_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		//ajax
		add_action('wp_ajax_add_gallery_item', array(__CLASS__, 'add_gallery_item'));

		add_action('wp_ajax_gallery_get_more', array(__CLASS__, 'gallery_get_more'));
		add_action('wp_ajax_nopriv_gallery_get_more', array(__CLASS__, 'gallery_get_more'));
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function gallery_meta() {
		global $post;
		$data = array();
		$data['tmm_gallery'] = get_post_meta($post->ID, 'thememakers_gallery', true);
		$data['layout'] = get_post_meta($post->ID, 'layout', true);
		echo TMM::draw_html('gallery/metabox', $data);
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) AND !empty($_POST) AND $post->post_type == self::$slug) {
				update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
				update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
				update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
				//*****
				update_post_meta($post->ID, "thememakers_gallery", @$_POST["tmm_gallery"]);
				update_post_meta($post->ID, "layout", @$_POST["layout"]);
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("gallery_meta", __("Gallery images", 'diplomat'), array(__CLASS__, 'gallery_meta'), self::$slug, "normal", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'diplomat'), array('TMM_Page', 'page_background_options'), self::$slug, "side", "low");
		add_meta_box("seo_options", __("Seo options", 'diplomat'), array('TMM_Page', 'page_seo_options'), self::$slug, "normal", "low");
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<img width="200" alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '200*200') . '"/>';
				break;
			case "image_count":
				$custom = get_post_custom($post->ID);
				$tmm_gallery = unserialize(@$custom["thememakers_gallery"][0]);
				if (empty($tmm_gallery)) {
					$tmm_gallery = array();
				}
				echo count($tmm_gallery);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'diplomat'),
			"image" => __("Cover", 'diplomat'),
			"image_count" => __("Image count", 'diplomat'),
			"date" => __("Date", 'diplomat')
		);

		return $columns;
	}
	public static function get_gallery_image_alias($gallery_type){
		$alias  = ($gallery_type=='albums') ? '340*260' : '550*430';
		return $alias;
	}

	//for ajax
	public static function add_gallery_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['title'] = "";
		$data['description'] = "";
		$data['layout'] = 2;
		$data['category'] = "";
		echo TMM::draw_html('gallery/render_gallery_item', $data);
		exit;
	}

	public static function render_gallery_item($data) {
		echo TMM::draw_html('gallery/render_gallery_item', $data);
	}

	public static function get_galleries_images($display){
		$query = new WP_Query(array(
			'post_type' => TMM_Gallery::$slug,
			'showposts' => '-1'
		));
		$posts_array = $query->posts;

		$galleries = array();
		$id = 0;
		foreach($posts_array as $post){
			$post_gall = get_post_meta($post->ID,'thememakers_gallery', true);
			$tags = wp_get_post_terms($post->ID, 'gallery-category');
			$slug = '';
			foreach ($tags as $key => $tag) {
				if ($key > 0) {
					$slug .= " ";
				}
				$slug .= $tag->slug;
			}

			switch($display){
				case 'cover':
					$gall_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false);

					if (!empty($gall_image)){
						$galleries[$id]['id'] = $post->ID;
						$galleries[$id]['imgurl'] = $gall_image[0];
						$galleries[$id]['title'] = $post->post_title;
						$galleries[$id]['slug'] = $slug;
						$galleries[$id]['post_slug'] = $post->post_name;
						$id++;
					}

					break;
				case 'inside':

					if (!empty($post_gall)) {
						foreach ($post_gall as $gall) {
							$galleries[$id]['id'] = $post->ID;
							$galleries[$id]['imgurl'] = $gall['imgurl'];
							$galleries[$id]['title'] = $post->post_title;
							$galleries[$id]['slug'] = $slug;
							$galleries[$id]['post_slug'] = $post->post_name;
							$id++;
						}
					}
					break;
			}

		}
		return $galleries;
	}

	public static function get_gallery_tags(){
		$folio_tags = array();
		$query = new WP_Query(array(
			'post_type' => TMM_Gallery::$slug,
			'showposts' => '-1'
		));
		$posts_array = $query->posts;

		foreach ($posts_array as $p) {
			$tmp = wp_get_post_terms($p->ID, 'gallery-category');
			foreach ($tmp as $tag_object) {
				$folio_tags[$tag_object->term_id] = $tag_object;

			}
		}
		return $folio_tags;
	}

	public static function gallery_get_more(){
		$data = array(
			'show_categories' => intval($_POST['show_categories']),
		);
		$responce = array(
			'post_key' => array(),
			'next_post' => true,
			'images_to_load_count' => 0,
			'article' => '',
		);
		$loaded = explode(',', $_POST['loaded']);
		$active_category = $_POST['active_category'] !== 'all' ? $_POST['active_category'] : 0;
		$categories = $_POST['category'] !== 'all' ? explode(',', $_POST['category']) : 0;
		$posts_perload = intval($_POST['posts_perload']);
		$display = $_POST['display'];
		$galleries = TMM_Gallery::get_galleries_images($display);
		$images_to_load = 0;


		foreach ($galleries as $key => $value) {
			$cat_slugs = explode(' ', $value['slug']);

			/* Get images to load */
			if (!in_array($key, $loaded)) {

				$display = false;

				if (!empty($categories) || !empty($active_category)) {

					if ($active_category) {

						if (in_array($active_category, $cat_slugs)) {

							if (count($responce['post_key']) < $posts_perload) {
								$display = true;
							}

							$images_to_load++;
						}

					} else {

						foreach ($categories as $cat) {
							if ( in_array($cat, $cat_slugs) ) {

								if (count($responce['post_key']) < $posts_perload) {
									$display = true;
								}

								$images_to_load++;
								break;

							}
						}

					}

				} else {

					if (count($responce['post_key']) < $posts_perload) {
						$display = true;
					}

					$images_to_load++;
				}

				if ($display) {
					$data['post_key'] = $key;
					$data['display_images'] = $_POST['display'];
					$responce['article'] .= TMM::draw_html('gallery/shortcodes/gallery_article', $data);
					$responce['post_key'][] = $key;
				}
			}

		}

		if ( $images_to_load <= $posts_perload ) {
			$responce['next_post'] = false;
		}

		$responce['images_to_load_count'] = $images_to_load;

		$responce['post_key'] = implode(',', $responce['post_key']);
		echo json_encode($responce);
		exit;
	}


}

