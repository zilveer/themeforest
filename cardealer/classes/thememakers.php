<?php

class TMM {

    public static $options, $app_options;

    public static function register() {
	    if (empty(self::$options)) {
            self::$options = get_option(TMM_THEME_PREFIX . 'theme_options');
	    }

	    if (empty(self::$app_options)) {
            self::$app_options = get_option(TMM_THEME_PREFIX . 'theme_app_options');
	    }

    }

    public static function get_option($option, $prefix = TMM_THEME_PREFIX) {
        if ($prefix == TMM_THEME_PREFIX) {
            if (isset(self::$options[$option])) {
                return self::$options[$option];
            }
        } else {
            if (isset(self::$app_options[$prefix][$option])) {
                return self::$app_options[$prefix][$option];
            }
        }

	    return '';
    }

    public static function update_option($option, $data, $prefix = TMM_THEME_PREFIX) {
        if ($prefix == TMM_THEME_PREFIX) {
            self::$options[$option] = $data;
            update_option($prefix . 'theme_options', self::$options);
        } else {
            self::$app_options[$prefix][$option] = $data;
            update_option(TMM_THEME_PREFIX . 'theme_app_options', self::$app_options);
        }
    }

    //ajax
    public static function change_options() {

        $action_type = $_REQUEST['type'];
        $data = array();
	    parse_str($_REQUEST['values'], $data);
	    //test sending options using base64
//	    $t_values = base64_decode($_REQUEST['values']);
//      parse_str($t_values, $data);
        $data = TMM_Helper::db_quotes_shield($data);

        switch ($action_type) {
            case 'save':
                if (!empty($data)) {

                    foreach ($data as $option => $newvalue) {

                        if ($option == "sidebars") {
                            unset($newvalue[0]);
                            TMM::update_option('sidebars', $newvalue);
                            continue;
                        }
                        if ($option == "seo_group") {
                            unset($newvalue[0]);
                            TMM::update_option('seo_groups', $newvalue);
                            continue;
                        }
                        if ($option == "contact_form") {
                            if (!empty($newvalue)) {
                                foreach ($newvalue as $key => $form) {
                                    if (!isset($newvalue[$key]['title'])) {
                                        unset($newvalue[$key]);
                                    }

                                    if (empty($newvalue[$key]['title'])) {
                                        unset($newvalue[$key]);
                                    }
                                }
                            }
                            TMM_Contact_Form::save($newvalue);
                            continue;
                        }

                        if (is_array($newvalue)) {
                            self::update_option($option, $newvalue);
                        } else {
                            $newvalue = stripcslashes($newvalue);
                            $newvalue = str_replace('\"', '"', $newvalue);
                            $newvalue = str_replace("\'", "'", $newvalue);
                            self::update_option($option, $newvalue);
                        }
                    }
                }
                _e('Options have been updated.', 'cardealer');
                break;


            case 'reset':
                if (!empty($data)) {
                    foreach ($data as $option => $newvalue) {
                        if ($option == "sidebars") {
                            continue;
                        }
                        if ($option == "contact_form") {
                            continue;
                        }

                        self::update_option($option, $newvalue);
                    }
                }
                _e('Options have been reset.', 'cardealer');
                break;


            default:
                break;
        }


        //**** CSS REGENERATION
        $custom_css1 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css1.php');
        $custom_css2 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css2.php');
        $handle = fopen(TMM_THEME_PATH . '/css/custom1.css', 'w');
        fwrite($handle, $custom_css1);
        fclose($handle);
        $handle = fopen(TMM_THEME_PATH . '/css/custom2.css', 'w');
        fwrite($handle, $custom_css2);
        fclose($handle);
        exit;
    }

    public static function draw_free_page($pagepath, $data = array()) {
        @extract($data);
        ob_start();
        include($pagepath);
        return ob_get_clean();
    }

    public static function draw_html($view, $data = array()) {
        @extract($data);
        ob_start();
        include(TMM_THEME_PATH . '/admin/views/' . $view . '.php' );
        return ob_get_clean();
    }
      

}
