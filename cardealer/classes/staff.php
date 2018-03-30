<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Staff {

    public static $slug = 'staff-page';

    public static function register() {
        add_filter("manage_" . self::$slug . "_posts_columns", array(__CLASS__, "show_edit_columns"));
        add_action("manage_" . self::$slug . "_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
    }

    public static function get_meta_data($post_id) {
        $data = array();
        $custom = get_post_custom($post_id);
        $data['office_phone'] = isset($custom["office_phone"][0]) ? $custom["office_phone"][0] : '';
        $data['mobile_phone'] = isset($custom["mobile_phone"][0]) ? $custom["mobile_phone"][0] : '';
        $data['fax'] = isset($custom["fax"][0]) ? $custom["fax"][0] : '';
        $data['staff_email'] = isset($custom["staff_email"][0]) ? $custom["staff_email"][0] : '';
        $data['facebook'] = isset($custom["facebook"][0]) ? $custom["facebook"][0] : '';
        $data['twitter'] = isset($custom["twitter"][0]) ? $custom["twitter"][0] : '';
        $data['gplus'] = isset($custom["gplus"][0]) ? $custom["gplus"][0] : '';
        $data['desc'] = isset($custom["desc"][0]) ? $custom["desc"][0] : '';
        return $data;
    }

    public static function credits_meta() {
        global $post;
        $data = self::get_meta_data($post->ID);
        echo TMM::draw_html('staff/credits_meta', $data);
    }

    public static function save($post_id) {
        if (isset($_POST)) {
            update_post_meta($post_id, "office_phone", @$_POST["office_phone"]);
            update_post_meta($post_id, "mobile_phone", @$_POST["mobile_phone"]);
            update_post_meta($post_id, "fax", @$_POST["fax"]);
            update_post_meta($post_id, "staff_email", @$_POST["staff_email"]);
            update_post_meta($post_id, "facebook", @$_POST["facebook"]);
            update_post_meta($post_id, "twitter", @$_POST["twitter"]);
            update_post_meta($post_id, "gplus", @$_POST["gplus"]);
            update_post_meta($post_id, "desc", @$_POST["desc"]);
        }
    }

    public static function init_meta_boxes() {
        add_meta_box("credits_meta", __("Staff attributes", 'cardealer'), array(__CLASS__, 'credits_meta'), self::$slug, "normal", "low");
    }

    public static function show_edit_columns_content($column) {
        global $post;

        switch ($column) {
            case "image":
                if (has_post_thumbnail($post->ID)) {
                    echo '<img alt="" src="' . TMM_Helper::get_post_featured_image($post->ID, '125*125') . '"/>';
                } else {
                    echo '<img alt="" src="' . TMM_THEME_URI . '/admin/images/avatar.png" />';
                }
                break;
            case "staff_email":
                echo '<a href="mailto:' . get_post_meta($post->ID, 'staff_email', true) . '">' . get_post_meta($post->ID, 'staff_email', true) . '</a>';
                break;
            case "office_phone":
                echo get_post_meta($post->ID, 'office_phone', true);
                break;
            case "mobile_phone":
                echo get_post_meta($post->ID, 'mobile_phone', true);
                break;
            case "fax":
                echo get_post_meta($post->ID, 'fax', true);
                break;
	        case "socials":
                echo '<a href="' . get_post_meta($post->ID, 'facebook', true) . '">' . get_post_meta($post->ID, 'facebook', true) . '</a><br>';
                echo '<a href="' . get_post_meta($post->ID, 'twitter', true) . '">' . get_post_meta($post->ID, 'twitter', true) . '</a><br>';
                echo '<a href="' . get_post_meta($post->ID, 'gplus', true) . '">' . get_post_meta($post->ID, 'gplus', true) . '</a><br>';
		        break;
            case "desc":
                echo get_post_meta($post->ID, 'desc', true);
                break;
        }
    }

    public static function show_edit_columns($columns) {
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __("Name", 'cardealer'),
            "image" => __("Photo", 'cardealer'),
            "staff_email" => __("Email", 'cardealer'),
            "office_phone" => __("Office Phone", 'cardealer'),
            "mobile_phone" => __("Mobile Phone", 'cardealer'),
            "fax" => __("Fax", 'cardealer'),
            "socials" => __("Socials", 'cardealer'),
            "desc" => __("Description", 'cardealer'),
        );

        return $columns;
    }

}
