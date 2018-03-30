<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Class UPDATER. Check for new versions of the theme, framework, or modules. Installs if found.
 */
class TF_UPDATER extends TF_TFUSE {

    public $_the_class_name = 'UPDATER';
    public $themefuse_update = false;
    public $check_url; #http://themefuse.com/update-themes/

    public function __construct() {
        parent::__construct();
        //$this->check_url = 'http://' . $_SERVER['HTTP_HOST'] . '/wp-updater/';
        $this->check_url = 'http://themefuse.com/update-themes/';
    }

    public function __init() {
        $this->themefuse_update = $this->themefuse_update_check();
        if (get_option(TF_THEME_PREFIX . '_disable_updates') != 1) {
            add_action('admin_menu', array($this, 'updates_item_menu_page'), 20);
            if ($this->themefuse_update) {
                add_action('admin_notices', array($this, 'themefuse_update_nag'));
            }
        }
    }

    function updates_item_menu_page() {
        if (!empty($this->themefuse_update->response[TF_THEME_PREFIX]))
            $count = count($this->themefuse_update->response[TF_THEME_PREFIX]);
        $title = !empty($count) ? __('Updates', 'tfuse') . '<span class="update-plugins count-' . $count . '"><span class="update-count">' . number_format_i18n($count) . '</span></span>' : __('Updates', 'tfuse');
        add_submenu_page('themefuse', __('Updates', 'tfuse'), $title, 'manage_options', 'tfupdates', array($this, 'themefuse_update_page'));
    }

    /**
     * This function pings an http://themefuse.com/ asking if a new
     * version of this theme is available. If not, it returns FALSE.
     * If so, the external server passes serialized data back to this
     * function, which gets unserialized and returned for use.
     *
     * @since 2.0
     */
    function themefuse_update_check() {
        if (!current_user_can('update_themes'))
            return false;

        if (!$this->request->empty_GET('action') && $this->request->GET('action') == 'checkagain') {
            delete_site_transient('themefuse-update');
            wp_redirect(self_admin_url('admin.php?page=tfupdates'));
        }

        $themefuse_update = get_site_transient('themefuse-update');
        if (!$themefuse_update) {
            $url = $this->check_url;
            $options = array(
                'body' => $this->update_params()
            );

            $request = wp_remote_post($url, $options);
            $response = wp_remote_retrieve_body($request);

            $themefuse_update = new stdClass();
            $themefuse_update->last_checked = time();

            // If an error occurred, return FALSE, store for 1 hour
            if ($response == 'error' || is_wp_error($response) || !is_serialized($response)) {
                $themefuse_update->response[TF_THEME_PREFIX]['Framework']['new_version'] = $this->theme->framework_version;
                $themefuse_update->response[TF_THEME_PREFIX]['ThemeMods']['new_version'] = $this->theme->mods_version;
                $themefuse_update->response[TF_THEME_PREFIX]['Templates']['new_version'] = $this->theme->theme_version;

                set_site_transient('themefuse-update', $themefuse_update, 60 * 60); // store for 1 hour
                return false;
            }

            // Else, unserialize
            $themefuse_update->response[TF_THEME_PREFIX] = maybe_unserialize($response);

            // And store in transient
            set_site_transient('themefuse-update', $themefuse_update, 60 * 60 * 24); // store for 24 hours
        }

        if (!(@$themefuse_update->response[TF_THEME_PREFIX]))
        { // If response is empty
            return false;
        }
        else if (!empty($themefuse_update->response[TF_THEME_PREFIX]['suspended']))
        { // Verify if updates for this theme are not suspended from themefuse
            return false;
        } else if (
            version_compare(
                $this->theme->framework_version,
                (!empty($themefuse_update->response[TF_THEME_PREFIX]['Framework'])
                    ? @$themefuse_update->response[TF_THEME_PREFIX]['Framework']['new_version']
                    : '0'
                ),
                '>='
            )
            &&
            version_compare(
                $this->theme->mods_version,
                (!empty($themefuse_update->response[TF_THEME_PREFIX]['ThemeMods'])
                    ? @$themefuse_update->response[TF_THEME_PREFIX]['ThemeMods']['new_version']
                    : '0'
                ),
                '>='
            )
            &&
            version_compare(
                $this->theme->theme_version,
                (!empty($themefuse_update->response[TF_THEME_PREFIX]['Templates'])
                    ? @$themefuse_update->response[TF_THEME_PREFIX]['Templates']['new_version']
                    : '0'
                ),
                '>='
            )
        )
        { // If we're already using the latest version, return FALSE
            return false;
        }

        return $themefuse_update;
    }

    function update_params()
    {
        global $wp_version, $wpdb;
        $params = array(
            'theme_name' => $this->theme->theme_name,
            'prefix' => $this->theme->prefix,
            'framework_version' => $this->theme->framework_version,
            'mods_version' => $this->theme->mods_version,
            'theme_version' => $this->theme->theme_version,
            'wp_version' => $wp_version,
            'php_version' => phpversion(),
            'mysql_version' => $wpdb->db_version(),
            'uri' => home_url(),
            'locale' => get_locale(),
            'is_multi' => is_multisite(),
            'is_child' => is_child_theme()
        );
        return apply_filters('tf_update_param', $params);
    }

    /**
     * This function displays the update nag at the top of the
     * dashboard if there is an ThemeFuse update available.
     *
     * @since 2.0
     */
    function themefuse_update_nag() {
        global $upgrading;
        if (!$this->request->empty_GET('page') && $this->request->GET('page') == 'tfupdates')
            return;
        echo apply_filters('tf_update_nag_notice', $this->load->view('updater/update_nag', NULL, true) );
    }

    function themefuse_update_page() {
        if ('tf-do-upgrade' == $this->theme->action || 'tf-do-reinstall' == $this->theme->action || ($this->request->isset_POST('upgrade') && $this->request->POST('upgrade') == __('Proceed', 'tfuse'))) {
            check_admin_referer('themefuse-bulk-update');
            $updates = !empty($this->themefuse_update->response[TF_THEME_PREFIX]) ? array_keys($this->themefuse_update->response[TF_THEME_PREFIX]) : array();
            $updates = array_map('urldecode', $updates);
            $this->load->view('updater/update_page');
            if ($this->request->isset_POST('connection_type') && $this->request->POST('connection_type') == 'ftp') {
                $filesystem = WP_Filesystem($this->request->POST());
            }
            $this->do_core_upgrade($updates);
        } else {
            $this->themefuse_upgrade_preamble();
        }
    }

    function themefuse_upgrade_preamble() {
        $updates = get_site_transient('themefuse-update');
        $data = array(
            'updates' => $updates
        );
        if (isset($this->themefuse_update->response))
            $data['response'] = $this->themefuse_update->response;
        $this->load->view('updater/upgrade_preamble', $data);
    }

    public function do_core_upgrade($updates) {
        $this->load->helper('UPGRADER');
        $updates = array_map('urldecode', $updates);

        $url = 'admin.php?page=tfupdates&amp;updates=' . urlencode(implode(',', $updates));
        $nonce = 'themefuse-bulk-update';

        //wp_enqueue_script('jquery');
        //iframe_header();

        $upgrader = new TF_Theme_Upgrader(new TF_Bulk_Theme_Upgrader_Skin(compact('nonce', 'url')));
        $upgrader->bulk_upgrade($updates);

        //iframe_footer();
    }

}