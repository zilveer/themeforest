<?php
/**
 * This class is responsible for checking all stats and jupiter needs such as
 * directory permission and notify user about warnings and errors
 *
 *
 * @author       Unknown , Reza Marandi <reza@marandi.ir>
 * @copyright    Artbees LTD (c)
 * @link         http://artbees.net
 * @version      1.0
 * @package      jupiter
 */

class MkContentImporter
{
    private $template            = null;
    private $theme_content_path  = "";
    private $widget_content_path = "";
    public function __construct($atts)
    {
        parse_str($atts, $options);
        $this->include_appropriate_importer();
        $this->template   = $options['template'];
        $this->is_options = $options['options'];
        $this->is_widgets = $options['widgets'];
        $this->is_content = $options['contents'];
    }
    /**
     * we need to make assets addresses dynamic and fully proccess
     * in one method for future development
     * it will get the type of address and will return full address in string
     * example :
     * for (options_url) type , it will return something like this
     * (http://localhost/jupiter/wp-content/uploads/mk_templates/dia/options.txt)
     *
     * for (options_path) type , it will return something like this
     * (/usr/apache/www/wp-content/uploads/mk_templates/dia/options.txt)
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @param string $which_one send which kind of address
     *                          do you want and get it on response
     *
     * @return string will return the complete address (URL , PATH) of file that u demand.
     */
    private function getAssetsAddress($which_one)
    {
        $wordpress_upload_dir    = wp_upload_dir();
        $base_path               = $wordpress_upload_dir['basedir'] . '/mk_templates/';
        $base_url                = $wordpress_upload_dir['baseurl'] . '/mk_templates/';
        $theme_content_file_name = 'theme_content.xml';
        $widget_file_name        = 'widget_data.wie';
        $options_file_name       = 'options.txt';
        switch ($which_one)
        {
            case 'theme_content_url':
                return $base_url . $this->template . '/' . $theme_content_file_name;
                break;
            case 'theme_content_path':
                return $base_path . $this->template . '/' . $theme_content_file_name;
                break;

            case 'widget_url':
                return $base_url . $this->template . '/' . $widget_file_name;
                break;
            case 'widget_path':
                return $base_path . $this->template . '/' . $widget_file_name;
                break;

            case 'options_url':
                return $base_url . $this->template . '/' . $options_file_name;
                break;
            case 'options_path':

                return $base_path . $this->template . '/' . $options_file_name;
                break;
        }
    }
    /**
     * Safely and securely get file from server.
     * It attempts to read file using Wordpress native file read functions
     * If it fails, we use wp_remote_get. if the site is ssl enabled, we try to convert it http as some servers may fail to get file
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     * @param $file_url         string    its directory URL
     * @param $file_dir         string    its directory Path
     *
     * @return $wp_file_body    string
     */
    public function get_file_body($file_url, $file_dir)
    {
        // throw new Exception("Error Sample");

        global $wp_filesystem;
        if (empty($wp_filesystem))
        {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }
        $wp_get_file_body = $wp_filesystem->get_contents($file_dir);
        if ($wp_get_file_body == false)
        {
            $wp_remote_get_file = wp_remote_get($file_uri);

            if (is_array($wp_remote_get_file) and array_key_exists('body', $wp_remote_get_file))
            {
                $wp_remote_get_file_body = $wp_remote_get_file['body'];

            }
            else if (is_numeric(strpos($file_uri, "https://")))
            {

                $file_uri           = str_replace("https://", "http://", $file_uri);
                $wp_remote_get_file = wp_remote_get($file_uri);

                if (!is_array($wp_remote_get_file) or !array_key_exists('body', $wp_remote_get_file))
                {
                    throw new Exception('SSL connection error. Code: template-get');
                }

                $wp_remote_get_file_body = $wp_remote_get_file['body'];
            }

            $wp_file_body = $wp_remote_get_file_body;

        }
        else
        {
            $wp_file_body = $wp_get_file_body;
        }
        return $wp_file_body;
    }
    private function import_menus_locations()
    {
        if ($this->is_content == 'true')
        {
            $locations = get_theme_mod('nav_menu_locations');
            $menus     = wp_get_nav_menus();
            if ($menus)
            {
                foreach ($menus as $menu)
                {
                    if ($menu->name == 'Main Navigation' || $menu->name == 'Main' || $menu->name == 'Main Menu' || $menu->name == 'main')
                    {
                        $locations['primary-menu'] = $menu->term_id;
                        $response                  = __('Navigation locations is configured.', 'mk_framework');
                    }
                }
            }
            set_theme_mod('nav_menu_locations', $locations);
            return $response;
        }
    }
    private function set_up_pages()
    {
        if ($this->is_content == 'true')
        {
            $homepage = get_page_by_title('Homepage 1');
            if (empty($homepage->ID))
            {
                $homepage = get_page_by_title('Homepage');
                if (empty($homepage->ID))
                {
                    $homepage = get_page_by_title('Home');
                }
            }

            if (!empty($homepage->ID))
            {
                update_option('page_on_front', $homepage->ID);
                update_option('show_on_front', 'page');
                $response[] = 'Default homepage is configured.';
            }

            $shop_page = get_page_by_title('Shop');
            if (!empty($shop_page->ID))
            {
                update_option('woocommerce_shop_page_id', $shop_page->ID);
                $response[] = 'Shop Page is configured.';
            }
        }
    }
    private function include_appropriate_importer()
    {
        global $wpdb;

        if (!defined('WP_LOAD_IMPORTERS'))
        {
            define('WP_LOAD_IMPORTERS', true);
        }

        if (!class_exists('WP_Importer'))
        {
            $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            include $wp_importer;
        }
        if (!class_exists('WP_Import'))
        {
            $wp_import = THEME_CONTROL_PANEL . '/logic/wordpress-importer.php';
            include $wp_import;
        }
    }
    private function import_theme_content()
    {

        if ($this->is_content == 'true')
        {
            set_time_limit(0);
            $importer                    = new WP_Import();
            $importer->fetch_attachments = false;
            ob_start();
            $importer->import($this->getAssetsAddress('theme_content_path'));
            ob_end_clean();
            return __('Template contents were imported.', 'mk_framework');
        }
        else
        {
            return false;
        }
    }
    private function process_theme_options_import()
    {
        if ($this->is_options == 'true')
        {
            $import_data = $this->get_file_body(
                $this->getAssetsAddress('options_url'),
                $this->getAssetsAddress('options_path')
            );
            $data = unserialize(base64_decode($import_data));

            if (!empty($data))
            {
                unset($data['custom_js'], $data['twitter_consumer_key'], $data['google_maps_api_key'], $data['twitter_consumer_secret'], $data['twitter_access_token'], $data['twitter_access_token_secret'], $data['typekit_id'], $data['analytics']);
                update_option(THEME_OPTIONS, $data);
                update_option(THEME_OPTIONS . '_imported', 'true');
                return __('Theme options are imported.', 'mk_framework');
            }
        }
    }

    private function process_widget_import()
    {

        if ($this->is_widgets == 'true')
        {
            $widgets_json = $this->widget_content_path;
            $data         = $this->get_file_body(
                $this->getAssetsAddress('widget_url'),
                $this->getAssetsAddress('widget_path')
            );
            $data = json_decode($data);
            return $this->import_data($data);
        }

    }
    public function available_widgets()
    {
        global $wp_registered_widget_controls;
        $widget_controls   = $wp_registered_widget_controls;
        $available_widgets = array();
        foreach ($widget_controls as $widget)
        {
            if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']]))
            {
                $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
                $available_widgets[$widget['id_base']]['name']    = $widget['name'];
            }
        }
        return apply_filters('available_widgets', $available_widgets);
    }
    private function import_data($data)
    {
        global $wp_registered_sidebars;
        $available_widgets = $this->available_widgets();
        $widget_instances  = array();
        foreach ($available_widgets as $widget_data)
        {
            $widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
        }
        if (empty($data) || !is_object($data))
        {
            wp_die(__('Widget data could not be read. Please try a different file.', 'mk_framework'), '', array(
                'back_link' => true,
            ));
        }
        $results = array();
        foreach ($data as $sidebar_id => $widgets)
        {
            if ('wp_inactive_widgets' == $sidebar_id)
            {
                continue;
            }
            if (isset($wp_registered_sidebars[$sidebar_id]))
            {
                $sidebar_available    = true;
                $use_sidebar_id       = $sidebar_id;
                $sidebar_message_type = 'success';
                $sidebar_message      = '';
            }
            else
            {
                $sidebar_available    = false;
                $use_sidebar_id       = 'wp_inactive_widgets';
                $sidebar_message_type = 'error';
                $sidebar_message      = __('Sidebar does not exist in theme (using Inactive)', 'mk_framework');
            }
            $results[$sidebar_id]['name']         = !empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id;
            $results[$sidebar_id]['message_type'] = $sidebar_message_type;
            $results[$sidebar_id]['message']      = $sidebar_message;
            $results[$sidebar_id]['widgets']      = array();
            foreach ($widgets as $widget_instance_id => $widget)
            {
                $fail               = false;
                $id_base            = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
                $instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);
                if (!$fail && !isset($available_widgets[$id_base]))
                {
                    $fail                = true;
                    $widget_message_type = 'error';
                    $widget_message      = __('Site does not support widget', 'mk_framework');
                }
                $widget = apply_filters('mk_widget_settings', $widget);
                if (!$fail && isset($widget_instances[$id_base]))
                {
                    $sidebars_widgets        = get_option('sidebars_widgets');
                    $sidebar_widgets         = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array();
                    $single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
                    foreach ($single_widget_instances as $check_id => $check_widget)
                    {
                        if (in_array("$id_base-$check_id", $sidebar_widgets) && (array) $widget == $check_widget)
                        {
                            $fail                = true;
                            $widget_message_type = 'warning';
                            $widget_message      = __('Widget already exists', 'mk_framework');
                            break;
                        }
                    }
                }
                if (!$fail)
                {
                    $single_widget_instances = get_option('widget_' . $id_base);
                    $single_widget_instances = !empty($single_widget_instances) ? $single_widget_instances : array(
                        '_multiwidget' => 1,
                    );
                    $single_widget_instances[] = (array) $widget;
                    end($single_widget_instances);
                    $new_instance_id_number = key($single_widget_instances);
                    if ('0' === strval($new_instance_id_number))
                    {
                        $new_instance_id_number                           = 1;
                        $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                        unset($single_widget_instances[0]);
                    }
                    if (isset($single_widget_instances['_multiwidget']))
                    {
                        $multiwidget = $single_widget_instances['_multiwidget'];
                        unset($single_widget_instances['_multiwidget']);
                        $single_widget_instances['_multiwidget'] = $multiwidget;
                    }
                    update_option('widget_' . $id_base, $single_widget_instances);
                    $sidebars_widgets                    = get_option('sidebars_widgets');
                    $new_instance_id                     = $id_base . '-' . $new_instance_id_number;
                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id;
                    update_option('sidebars_widgets', $sidebars_widgets);
                    if ($sidebar_available)
                    {
                        $widget_message_type = 'success';
                        $widget_message      = __('Imported', 'mk_framework');
                    }
                    else
                    {
                        $widget_message_type = 'warning';
                        $widget_message      = __('Imported to Inactive', 'mk_framework');
                    }
                }
                $results[$sidebar_id]['widgets'][$widget_instance_id]['name']         = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['title']        = $widget->title ? $widget->title : __('No Title', 'mk_framework');
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
                $results[$sidebar_id]['widgets'][$widget_instance_id]['message']      = $widget_message;
            }
        }
        return __('Widgets are imported.', 'mk_framework');
    }
    /**
     *  it will handle of importing template assets and catch every errors.
     *
     * @author Reza Marandi <reza@marandi.ir>
     *
     *
     * @return $json    string
     */
    public function import()
    {
        try {
            if (class_exists('WP_Importer') && class_exists('WP_Import'))
            {

                $response[] = $this->import_theme_content();
                $response[] = $this->import_menus_locations();
                $response[] = $this->set_up_pages();
                $response[] = $this->process_theme_options_import();
                $response[] = $this->process_widget_import();
                update_option('jupiter_template_installed', $this->template);
                $response = array(
                    'message' => array_filter($response),
                    'status'  => 'success',
                );
                echo json_encode($response);
            }
            else
            {
                throw new Exception("WP_Importer && WP_Import class don't exist.");
            }
        }
        catch (Exception $e)
        {
            $response = array(
                'message' => __($e->getMessage(), 'mk_framework'),
                'status'  => 'error',
            );
            echo json_encode($response);
        }
    }
}
