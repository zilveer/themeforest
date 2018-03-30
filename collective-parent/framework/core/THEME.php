<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_THEME extends TF_TFUSE {

    public $_the_class_name = 'THEME';
    public
            $mods_version,
            $theme_version,
            $theme_name,
            $prefix,
            $author_name,
            $theme_author,
            $forum_url,
            $manual_url,
            $action,
            $page,
            $taxonomy,
            $disabled_extensions = array();

    function __construct() {
        parent::__construct();
        $this->theme_info = $this->theme_cfg();
        $this->prefix = $this->theme_info['prefix'];
        define('TF_THEME_PREFIX', $this->prefix);

        $this->load_developer_settings();

        $this->mods_version = $this->theme_info['mods_version'];
        $this->theme_version = $this->theme_info['theme_version'];

        $custom_theme_name = get_option($this->prefix . '_theme_display_name');

        //$this->disabled_extensions = $this->theme_info['disabled_extensions'];
        $this->theme_name = $custom_theme_name != '' ? $custom_theme_name : $this->theme_info['theme_name'];
        $this->author_name = $this->theme_info['author_name'];
        $this->theme_author = $this->theme_info['theme_author'];
        $this->forum_url = $this->theme_info['forum_url'];
        $this->manual_url = $this->theme_info['manual_url'];
        $this->action = !empty($_REQUEST['action']) ? strtolower(trim(strip_tags($_REQUEST['action']))) : '';
        $this->page = !empty($_REQUEST['page']) ? strtolower(trim(strip_tags($_REQUEST['page']))) : '';
        $this->taxonomy = !empty($_REQUEST['taxonomy']) ? strtolower(trim(strip_tags($_REQUEST['taxonomy']))) : '';
        $this->redirect_after_activation();
        #do some actions when theme is loaded
        do_action($this->prefix . "_preinit");
        do_action("themefuse_preinit");
        $this->add_js_constants();
    }

    function __init() {
        add_filter('tfuse_get_disabled_extensions', array($this, 'get_disabled_extensions'));
    }
        
    function get_disabled_extensions() {
        return $this->disabled_extensions;
    }

    # Loads the DEVELOPER_SETTINGS file and sets the options

    function load_developer_settings() {
        if (file_exists(get_template_directory() . '/DEVELOPER_SETTINGS.php')) {
            include_once(get_template_directory() . '/DEVELOPER_SETTINGS.php');
            // Do not edit anything below this line, or you shall burn in hell
            if (isset($theme_display_name))
                update_option(TF_THEME_PREFIX . '_theme_display_name', $theme_display_name);
            if (isset($disable_news_and_promo))
                update_option(TF_THEME_PREFIX . '_disable_news_and_promo', $disable_news_and_promo);
            if (isset($disable_support))
                update_option(TF_THEME_PREFIX . '_disable_support', $disable_support);
            if (isset($disable_export))
                update_option(TF_THEME_PREFIX . '_disable_export', $disable_export);
            if (isset($disable_import))
                update_option(TF_THEME_PREFIX . '_disable_import', $disable_import);
            if (isset($disable_updates))
                update_option(TF_THEME_PREFIX . '_disable_updates', $disable_updates);
            if (isset($disable_megamenu) && $disable_megamenu)
                $this->disabled_extensions[] = 'megamenu';
            if (isset($disable_minify) && $disable_minify)
                $this->disabled_extensions[] = 'minify';
        }
    }

    # Loads theme configuration file. This contains theme info

    function theme_cfg($specific = '') {
        static $_cfg = '';
        if ($_cfg == '') {
            require_once(TFUSE_CONFIG_FILE);
            $_cfg = $cfg;
            unset($cfg);
        }
        if ($specific != '')
            return $_cfg[$specific];
        else
            return $_cfg;
    }

    # Redirect after theme is activated

    function redirect_after_activation() {
        global $pagenow;

        if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
            $this->set_screen_options();
            if (get_option(TF_THEME_PREFIX . '_tfuse_framework_options'))
                header('Location: ' . admin_url() . 'admin.php?page=themefuse');
            else
                header('Location: ' . admin_url() . 'admin.php?page=tf_import');
        }
    }

    protected function set_screen_options() {
        $cfg = $this->theme_info;

        if (isset($cfg['screen_options'])) {
            $user = wp_get_current_user();
            foreach ($cfg['screen_options'] as $page => $hidden) {
                update_user_option($user->ID, "metaboxhidden_$page", $hidden, true);
            }
        }
    }

    # Load ThemeFuse functions

    public function functions() {
        if (TFUSE_CHILD_FUNCTIONS != TFUSE_THEME_FUNCTIONS) {
            foreach (glob(TFUSE_CHILD_FUNCTIONS . '/*.php') as $filename) {
                require( $filename );
            }
        }

        foreach (glob(TFUSE_THEME_FUNCTIONS . '/*.php') as $filename) {
            require( $filename );
        }
    }

    # Load admin functions

    public function admin() {
        if (!is_admin())
            return;

        if (TFUSE_CHILD_ADMIN != TFUSE_THEME_ADMIN) {
            foreach (glob(TFUSE_CHILD_ADMIN . '/*.php') as $filename) {
                require( $filename );
            }
        }

        foreach (glob(TFUSE_THEME_ADMIN . '/*.php') as $filename) {
            require( $filename );
        }
    }

    function add_js_constants() {
        $this->include->js_enq('TF_THEME_PREFIX', TF_THEME_PREFIX);
    }

}
