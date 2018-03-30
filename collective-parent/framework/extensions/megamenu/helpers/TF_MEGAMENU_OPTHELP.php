<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');

class TF_MEGAMENU_OPTHELP {

    private static $mm_class_name = 'MEGAMENU';
    private static $mm_config = null;
    private static $nav_id_holder = null;
    private static $mm_meta_key = 'tf_megamenu_options';

    /*
     * test function for megamenu v1.1
     */
    public static function get_needed_template($nav_id) {
        $mm_config = self::get_megamenu_config();
        $db_options = self::get_nav_item_db_options($nav_id);

        if (isset($db_options['tf_megamenu_menu_template'])) {
            return $db_options['tf_megamenu_menu_template'];
        }

        if (!empty($mm_config['active_templates'])) {
            $all_templates = array_keys($mm_config['active_templates']);
            $first_template = $all_templates[0];
            return $first_template;
        }

        return '';
    }

    /**
     * Generates and returns the html of some template options
     *
     * @param string $template A template name from the confg file
     * @param int $nav_id The id of the navigation element
     * @return string The html of the template's options
     */
    public static function generate_template_options_html($template, $nav_id) {
        if (!self::template_options_exist($template))
            return '';

        self::$nav_id_holder = $nav_id;

        $template_options = self::get_template_options_ready($template);

        $out = '<div class="tf_megamenu_template_options">';
        $out .= self::options_to_html($template_options);
        $out .= '<div class="clear"></div>';
        $out .= '</div>';
        return $out;
    }

    private static function template_options_exist($template) {
        $config = self::get_megamenu_config();
        return isset($config['all_templates'][$template]);
    }

    private static function get_template_options_ready($template) {
        $config = self::get_megamenu_config();
        $db_options = self::get_nav_item_db_options(self::$nav_id_holder);

        return self::set_options_value_and_title($config['all_templates'][$template], $db_options);
    }

    private static function get_nav_item_db_options($nav_id) {
        return get_post_meta($nav_id, self::$mm_meta_key, true) == ''
        ? array()
        : get_post_meta($nav_id, self::$mm_meta_key, true);
    }

    private static function set_options_value_and_title($options, $options_db_values) {
        foreach ($options as &$o) {
            if (array_key_exists($o['id'], $options_db_values)) {
                $o['value'] = $options_db_values[ $o['id'] ];
            }
            $o['id'] = 'tf_megamenu_options[' . self::$nav_id_holder . '][' .$o['id'] . ']';
        }

        return $options;
    }

    private static function options_to_html($options) {
        global $TFUSE;

        $out = '';
        foreach ($options as $o) {
            $out .= "<p class='description'><label>" . $o['name'] . "<br/>";
            $out .= $TFUSE->optigen->{$o['type']}($o);
            $out .= "</label></p>";
        }

        return $out;
    }

    /**
     * Generates and returns the html of the population method options
     *
     * @param mixed $cat_id The id of the category from which to populate. Could be custom if none
     * @param int $nav_id The id of the nav element
     * @return string The html generated
     */
    public static function generate_population_options_html($cat_id, $nav_id) {
        if ($cat_id == 'custom')
            return '';

        self::$nav_id_holder = $nav_id;

        $config = self::get_megamenu_config();
        $db_options = self::get_nav_item_db_options($nav_id);
        $population_options = self::set_options_value_and_title($config['population_options'], $db_options);

        $out = '<div class="tf_megamenu_population_options">';
        $out .= self::options_to_html($population_options);
        $out .= '<div class="clear"></div>';
        $out .= '</div>';

        return $out;
    }

    public static function generate_commun_options_html($depth, $nav_id) {
        self::$nav_id_holder = $nav_id;

        $config = self::get_megamenu_config();
        $db_options = self::get_nav_item_db_options($nav_id);
        $commun_options =  self::set_options_value_and_title($config['commun_options'][$depth], $db_options);

        return self::options_to_html($commun_options);
    }

    /**
     * Gets the configs from the megamenu's config file
     *
     * @return array The array of megamenu configs
     */
    private static function get_megamenu_config() {
        global $TFUSE;

        if (self::$mm_config == null) {
            self::$mm_config = $TFUSE->get->ext_config(self::$mm_class_name, 'base');
        }

        return self::$mm_config;
    }

    /**
     * Generates and returns the default html for the
     * tf_megamenu_optcontainer div needed after dynamic
     * modification of the admin menu builder nav elemets
     *
     * @return array The array containing the necessary html
     */
    public static function get_optcontainer_defaults() {
        $return_arr = array();
        $return_arr['depth_0'] = self::get_optcontainer_depth0_defaults();
        $return_arr['depth_1'] = self::get_optcontainer_depth1_defaults();

        return $return_arr;
    }

    /**
     * Generates the html for the depth 0 nav items
     *
     * @return string The generated html
     */
    private static function get_optcontainer_depth0_defaults() {
        $config = self::get_megamenu_config();

        $commun_options = $config['commun_options'][0];
        $commun_options = array_map(array(__CLASS__, 'give_defaults_correct_names'), $commun_options);

        $out = "<div class='tf_megamenu_commun_opts'>";
        $out .= self::options_to_html($commun_options);
        $out .= '<div class="clear"></div>';
        $out .= "</div>";

        $out .= "<div class='tf_megamenu_uncommun_opts'></div>";

        return $out;
    }

    /**
     * Generates the html for depth 1 nav items
     *
     * @return string The generated html
     */
    private static function get_optcontainer_depth1_defaults() {
        $config = self::get_megamenu_config();

        $commun_options = $config['commun_options'][1];
        $commun_options = array_map(array(__CLASS__, 'give_defaults_correct_names'), $commun_options);

        $first_template_id = key($config['active_templates']);
        $template_options = $first_template_id === ''
        ? array()
        : $config['all_templates'][$first_template_id];
        $template_options = array_map(array(__CLASS__, 'give_defaults_correct_names'), $template_options);

        $out = "<div class='tf_megamenu_commun_opts'>";
        $out .= self::options_to_html($commun_options);
        $out .= '<div class="clear"></div>';
        $out .= "</div>";


        $out .= "<div class='tf_megamenu_uncommun_opts'>";

        $out .= "<div class='tf_megamenu_template_options'>";
        $out .= self::options_to_html($template_options);
        $out .= '<div class="clear"></div>';
        $out .= "</div>";

        $out .= "<div class='tf_megamenu_population_options'>";
        $out .= "</div>";

        $out .= "</div>";

        return $out;
    }

    /**
     *
     * @param array $val
     * @return array The modified array
     */
    private static function give_defaults_correct_names($val) {
        $val['id'] = 'tf_megamenu_options[%%NAV_ID%%][' .$val['id'] . ']';
        return $val;
    }

    /**
     * return array
     */
    public static function get_megafied_parent_li_css_classes() {
        $config = self::get_megamenu_config();
        return $config['megafied_parent_li_css_classes'];
    }

    public static function get_megafied_parent_li_css_class_string() {
        $css_classes = self::get_megafied_parent_li_css_classes();
        return implode(" ", $css_classes);
    }

    public static function get_megafied_child_li_css_classes() {
        $config = self::get_megamenu_config();
        return $config['megafied_child_li_css_classes'];
    }

    public static function get_megafied_child_li_css_class_string() {
        $css_classes = self::get_megafied_child_li_css_classes();
        return implode(" ", $css_classes);
    }
}