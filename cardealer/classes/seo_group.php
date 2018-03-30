<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_SEO_Group {

    public static function get_categories_select($selected = '', $name = '', $id = '', $class = '') {
        $args = array(
            'show_option_none' => __('No categories', 'cardealer'),
            'hide_empty' => 0,
            'echo' => 0,
            'selected' => $selected,
            'hierarchical' => 0,
            'name' => $name,
            'id' => false,
            'class' => 'postform ' . $class,
            'depth' => 0,
            'tab_index' => 0,
            'taxonomy' => 'category',
            'hide_if_empty' => false
        );

        return wp_dropdown_categories($args);
    }

    public static function draw_seo_groups_panel() {
        $data = array();
        $data['seo_groups'] = TMM::get_option("seo_groups");
        $data['entity_seo_group'] = new TMM_SEO_Group();
        return TMM::draw_html('seo_groups/draw_groups', $data);
    }

    //ajax
    //add_sidebar
    public static function add_seo_group() {
        $data = array();
		$seo_group = array(
			'seo_group_id' => $_REQUEST['seo_group_id'],
			'name' => $_REQUEST['group_name'],
			'title' => "",
			'keywords' => "",
			'description' => "",
			'cat' => array()
		);
		//***
		$responce = array();
		$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/tab_seo/custom_html/';
		$responce['html'] = TMM::draw_free_page($pagepath . 'seo_group.php', array('seo_group' => $seo_group, 'seo_group_id' => $seo_group['seo_group_id']));
		echo json_encode($responce);
		exit;
    }

    public static function add_seo_group_category() {
        $group_id = $_REQUEST['group_id'];
        $cat_id = $_REQUEST['cat_id'];
        $data = array();
        $data['select'] = self::get_categories_select('', "seo_group[" . $group_id . "][cat][" . $cat_id . "]", "seo_group_page_" . $group_id);

        echo TMM::draw_html('seo_groups/add_group_category', $data);
        exit;
    }

    public static function get_cat_head_seo_data($cat) {
        $data = array();
        $data['meta_title'] = "";
        $data['meta_keywords'] = "";
        $data['meta_description'] = "";
        if (!$cat) {
            return $data;
        }

        $seo_groups = TMM::get_option("seo_groups");
        if (!empty($seo_groups)) {
            foreach ($seo_groups as $key => $group) {
                if (!empty($group['cat'])) {
                    foreach ($group['cat'] as $category) {
                        if ($category == $cat) {
                            $data['meta_title'] = $group['title'];
                            $data['meta_keywords'] = $group['keywords'];
                            $data['meta_description'] = $group['description'];
                            return $data;
                        }
                    }
                }
            }
        }

        return $data;
    }

}
