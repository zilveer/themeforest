<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Page {

    public static $post_pod_types = array();
    public static $sidebar_position = '';

    public static function register() {

        self::$post_pod_types = array(
            'default' => __("Default", 'cardealer'),
            'video' => __("Video", 'cardealer'),
            'audio' => __("Audio", 'cardealer'),
            //'link' => __("Link", 'cardealer'),
            'quote' => __("Quote", 'cardealer'),
            'gallery' => __("Gallery", 'cardealer'),
        );
    }

    public static function save($post_id) {
        update_post_meta($post_id, "meta_title", @$_POST["meta_title"]);
        update_post_meta($post_id, "meta_keywords", @$_POST["meta_keywords"]);
        update_post_meta($post_id, "meta_description", @$_POST["meta_description"]);
        //*****
        update_post_meta($post_id, "post_pod_type", @$_POST["post_pod_type"]);
        update_post_meta($post_id, "post_type_values", @$_POST["post_type_values"]);
        //***
        update_post_meta($post_id, "header_type", @$_POST["header_type"]);
        update_post_meta($post_id, "show_title_bar", @$_POST["show_title_bar"]);
        update_post_meta($post_id, "alt_page_title", @$_POST["alt_page_title"]);
        update_post_meta($post_id, "page_subtitle", @$_POST["page_subtitle"]);
        update_post_meta($post_id, "title_bar_bg_type", @$_POST["title_bar_bg_type"]);
        update_post_meta($post_id, "title_bar_bg_color", @$_POST["title_bar_bg_color"]);
        update_post_meta($post_id, "title_bar_bg_image", @$_POST["title_bar_bg_image"]);
        update_post_meta($post_id, "title_bar_bg_image_option", @$_POST["title_bar_bg_image_option"]);
        update_post_meta($post_id, "pagebg_type", @$_POST["pagebg_type"]);
        update_post_meta($post_id, "pagebg_color", @$_POST["pagebg_color"]);
        update_post_meta($post_id, "pagebg_image", @$_POST["pagebg_image"]);
        update_post_meta($post_id, "pagebg_type_image_option", @$_POST["pagebg_type_image_option"]);
        update_post_meta($post_id, "page_sidebar_position", @$_POST["page_sidebar_position"]);

        update_post_meta($post_id, "hide_single_page_title", @$_POST["hide_single_page_title"]);
    }

    public static function init_meta_boxes() {
        add_meta_box("seo_options", __("Seo options", 'cardealer'), array(__CLASS__, 'page_seo_options'), "page", "normal", "low");
        add_meta_box("seo_options", __("Seo options", 'cardealer'), array(__CLASS__, 'page_seo_options'), "post", "normal", "low");
        add_meta_box("seo_options", __("Seo options", 'cardealer'), array(__CLASS__, 'page_seo_options'), TMM_Ext_PostType_Car::$slug, "normal", "low");
        //*****
        add_meta_box("post_types", __("Post type", 'cardealer'), array(__CLASS__, 'post_type_meta_box'), "post", "side", "low");
        add_meta_box("post_types_data", __("Post type data", 'cardealer'), array(__CLASS__, 'post_type_meta_panel'), "post", "normal");
        //*****
        add_meta_box("tmm_page_bg", __("Custom Page Options", 'cardealer'), array(__CLASS__, 'page_background_options'), "post", "side", "low");
        add_meta_box("tmm_page_bg", __("Custom Page Options", 'cardealer'), array(__CLASS__, 'page_background_options'), "page", "side", "low");
    }

    public static function page_background_options() {
        global $post;
        echo TMM::draw_html('page/background_options', self::get_page_settings($post->ID));
    }

    public static function get_page_settings($post_id) {
        $custom = get_post_custom($post_id);
        $data = array();
        $data['header_type'] = (isset($custom["header_type"][0])) ? $custom["header_type"][0] : 'classic';
        $data['show_title_bar'] = (isset($custom["show_title_bar"][0])) ? $custom["show_title_bar"][0] : 0;
        $data['alt_page_title'] = (isset($custom["alt_page_title"][0])) ? $custom["alt_page_title"][0] : '';
        $data['page_subtitle'] = (isset($custom["page_subtitle"][0])) ? $custom["page_subtitle"][0] : '';
        $data['title_bar_bg_type'] = (isset($custom["title_bar_bg_type"][0])) ? $custom["title_bar_bg_type"][0] : 'color';
        $data['title_bar_bg_color'] = (isset($custom["title_bar_bg_color"][0])) ? $custom["title_bar_bg_color"][0] : '';
        $data['title_bar_bg_image'] = (isset($custom["title_bar_bg_image"][0])) ? $custom["title_bar_bg_image"][0] : '';
        $data['title_bar_bg_image_option'] = (isset($custom["title_bar_bg_image_option"][0])) ? $custom["title_bar_bg_image_option"][0] : 'repeat';
        $data['pagebg_type'] = isset($custom["pagebg_type"][0]) ? $custom["pagebg_type"][0] : '';
        $data['pagebg_color'] = isset($custom["pagebg_color"][0]) ? $custom["pagebg_color"][0] : '';
        $data['pagebg_image'] = isset($custom["pagebg_image"][0]) ? $custom["pagebg_image"][0] : '';
        $data['pagebg_type_image_option'] = isset($custom["pagebg_type_image_option"][0]) ? $custom["pagebg_type_image_option"][0] : '';
        $data['page_sidebar_position'] = isset($custom["page_sidebar_position"][0]) ? $custom["page_sidebar_position"][0] : '';

        $data['hide_single_page_title'] = '';
        if (isset($custom["hide_single_page_title"])) {
            $data['hide_single_page_title'] = $custom["hide_single_page_title"][0];
        }

        return $data;
    }

    //***

    public static function page_seo_options() {
        global $post;
        $data = array();
        $custom = get_post_custom($post->ID);
        $data['meta_title'] = @$custom["meta_title"][0];
        $data['meta_keywords'] = @$custom["meta_keywords"][0];
        $data['meta_description'] = @$custom["meta_description"][0];
        echo TMM::draw_html('page/seo_options', $data);
    }

    public static function post_type_meta_box() {
        global $post;
        $data = array();
        $custom = get_post_custom($post->ID);
        $data['post_pod_types'] = self::$post_pod_types;
        $data['current_post_pod_type'] = @$custom["post_pod_type"][0];
        if (!$data['current_post_pod_type']) {
            $data['current_post_pod_type'] = 'default';
        }
        echo TMM::draw_html('page/post_pod_type_box', $data);
    }

    public static function post_type_meta_panel() {
        global $post;
        $data = array();
        $custom = get_post_custom($post->ID);
        $data['post_pod_types'] = self::$post_pod_types;
        $data['current_post_pod_type'] = @$custom["post_pod_type"][0];
        if (!$data['current_post_pod_type']) {
            $data['current_post_pod_type'] = 'default';
        }
        $data['post_type_values'] = unserialize(@$custom["post_type_values"][0]);

        echo TMM::draw_html('page/post_pod_type_panel', $data);
    }

    //ajax
    public static function add_post_podtype_gallery_image() {
        $data = array();
        $data['imgurl'] = $_REQUEST['imgurl'];
        echo TMM::draw_html('page/draw_post_podtype_gallery_image', $data);
        exit;
    }

	public static function set_sidebar_position() {
		$sidebar_position = "sbr";
		$page_sidebar_position = "default";

		if ( ! is_404() ) {

			if (is_single() || is_page()) {
				$page_sidebar_position = get_post_meta(get_the_ID(), 'page_sidebar_position', true);
			}

			if (!empty($page_sidebar_position) && $page_sidebar_position != 'default') {
				$sidebar_position = $page_sidebar_position;
			} else {
				$sidebar_position = TMM::get_option("sidebar_position");
			}

			if ( is_singular( array( TMM_Ext_PostType_Car::$slug ) ) ) {
				$sidebar_position = TMM::get_option( "single_car_sidebar_position", TMM_APP_CARDEALER_PREFIX );
			}

			//if is shop
			if (class_exists('woocommerce') && is_woocommerce()) {

				if (is_shop()) {

					$sidebar_position = get_post_meta(wc_get_page_id('shop'), 'page_sidebar_position', true);

					if(!$sidebar_position){
						$sidebar_position = TMM::get_option("product_sidebar_position");
					}
				}

				if (is_product()) {
					$sidebar_position = TMM::get_option("product_sidebar_position");
				}

			}

			if ( ! $sidebar_position ) {
				$sidebar_position = "sbr";
			}

		} else {
			$sidebar_position = 'no_sidebar';
		}

		self::$sidebar_position = $sidebar_position;
	}

}
