<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

namespace Warp\Wordpress\Helper;

use Warp\Warp;
use Warp\Helper\AbstractHelper;
use Warp\Wordpress\MenuWalker\MenuWalker;

/*
 * Wordpress system helper class, provides Wordpress integration (http://wordpress.org).
 */
class SystemHelper extends AbstractHelper
{
    /*
     * System root path.
     *
     * @var string
     */
    public $path;

    /*
     * System root url.
     *
     * @var string
     */
    public $url;

    /*
     * Cache path.
     *
     * @var string
     */
    public $cache_path;

    /*
     * Cache time.
     *
     * @var int
     */
    public $cache_time;

    /*
     * Theme XML.
     *
     * @var Document
     */
    public $xml;

    /*
     * Query information.
     *
     * @var string[]
     */
    public $query;

    /**
     * Dynamic style GET variable.
     *
     * @var string
     */
    protected $style = 'style';

    /**
     * Constructor.
     *
     * @param Warp $warp
     */
    public function __construct(Warp $warp)
    {
        parent::__construct($warp);

        // init vars
        $this->path       = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', ABSPATH), '/');
        $this->url        = rtrim(site_url(), '/');
        $this->cache_path = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', get_template_directory()), '/').'/cache';
        $this->cache_time = 86400;

        // set config or load defaults
        if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE) {
            if ($settings = $this['option']->get('warp_theme_options', false) and is_array($settings)) {
                $this['config']->setValues($settings);
            } else {
                $this['config']->load($this['path']->path('theme:config.default.json'));
            }
        } else {
            $this['config']->load($this['path']->path('theme:config.json') ?: $this['path']->path('theme:config.default.json'));
        }

        // set cache directory
        if (!file_exists($this->cache_path)) {
            mkdir($this->cache_path, 0755);
        }
    }

    /**
     * Initialize system configuration.
     */
    public function init()
    {
        // set paths
        $this['path']->register($this->path, 'site');
        $this['path']->register($this->path.'/wp-admin', 'admin');
        $this['path']->register($this->cache_path, 'cache');

        // set theme support
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');

        // set translations
        load_theme_textdomain('warp', $this['path']->path('theme:languages'));

        // get theme xml
        $this->xml = $this['dom']->create($this['path']->path('theme:theme.xml'), 'xml');

        // get widget positions
        foreach ($this->xml->find('positions > position') as $position) {
            $this['widgets']->register($position->text());
        }

        // add actions
        add_action('wp_ajax_warp_search', array($this, 'ajaxSearch'));
        add_action('wp_ajax_nopriv_warp_search', array($this, 'ajaxSearch'));

        // register main menu
        register_nav_menus(array('main_menu' => 'Main Navigation Menu'));

        // init site/admin
        if (!is_admin()) $this->initSite();
        if (is_admin()) $this->initAdmin();

        // load widgets
        include_once(__DIR__.'/../Widgets/Breadcrumbs.php');
        include_once(__DIR__.'/../Widgets/Sidebar.php');
    }

    /**
     * Initialize site.
     */
    public function initSite()
    {
        // add action
        add_action('wp', array($this, '_wp'));
        add_action('get_sidebar', array($this, '_getSidebar'));

        add_filter('get_avatar', function($avatar){


            if(strpos($avatar, 'Avatar')!==false) {
                $avatar = str_replace('class=\'avatar', 'class=\'uk-comment-avatar', $avatar);
            }

            return $avatar;
        });

        // remove auto-linebreaks ?
        if (!$this['config']->get('wpautop', 0)) {
            remove_filter('the_content', 'wpautop');
        }

        // set custom menu walker
        add_filter('wp_nav_menu_args', function($args) {

            if (empty($args['walker'])) {
                $args['walker'] = new MenuWalker;
            }

            return $args; }
        );

        // filter widgets that should not be displayed
        $warp = $this->warp;
        add_filter('widget_display_callback', function($instance, $widget) use ($warp) {
            return $warp['widgets']->get($widget->id)->display ? $instance : false;
        }, 10, 3);

        // disable the admin bar for mobiles
        if ($this['config']->get('mobile') && $this['browser']->isMobile()) {
            add_theme_support('admin-bar', array('callback' => '__return_false'));
        }
    }

    /**
     * Initialize administration area.
     */
    public function initAdmin()
    {
        // add actions
        add_action('admin_init', array($this, '_adminInit'));
        add_action('admin_menu', array($this, '_adminMenu'));
        add_action('wp_ajax_warp_save', array($this, 'ajaxSave'));
        add_action('wp_ajax_warp_save_files', array($this, 'ajaxSaveFiles'));
        add_action('wp_ajax_warp_get_styles', array($this, 'ajaxGetStyles'));

        // add notices
        if (isset($_GET['page']) && $_GET['page'] == 'warp') {

            // get warp xml
            $xml = $this['dom']->create($this['path']->path('warp:warp.xml'), 'xml');

            // cache writable ?
            if (!file_exists($this->cache_path) || !is_writable($this->cache_path)) {
                $messages[] = "Cache not writable, please check directory permissions ({$this->cache_path})";
            }

            // update check
            if ($url = $xml->first('updateUrl')->text()) {

                // create check urls
                $urls['tmpl'] = sprintf('%s?application=%s&version=%s&format=raw', $url, get_template(), $this->xml->first('version')->text());
                $urls['warp'] = sprintf('%s?application=%s&version=%s&format=raw', $url, 'warp', $xml->first('version')->text());

                foreach ($urls as $type => $url) {

                    // only check once a day
                    $hash = md5($url.date('Y-m-d'));
                    if ($this['option']->get("{$type}_check") != $hash) {
                        if ($request = $this['http']->get($url)) {
                            $this['option']->set("{$type}_check", $hash);
                            $this['option']->set("{$type}_data", $request['body']);
                        }
                    }

                    // decode response and set message
                    if (($data = json_decode($this['option']->get("{$type}_data"))) && $data->status == 'update-available') {
                        $messages[] = $data->message;
                    }

                }
            }

            // set messages
            if (isset($messages)) {
                $this['template']->set('messages', $messages);
            }
        }
    }

    /**
     * Get current query information.
     *
     * @global \WP_Query $wp_query
     *
     * @return string[]
     */
    public function getQuery()
    {
        global $wp_query;

        // create, if not set
        if (empty($this->query)) {

            // init vars
            $obj   = $wp_query->get_queried_object();
            $query = array();

            // find current page type
            foreach (array('home', 'front_page', 'archive', 'search', 'single', 'page', 'category') as $type) {
                if (call_user_func('is_'.$type)) {
                    $query[] = $type;

                    if ($type == 'page') {
                        $query[] = 'page-'.$obj->ID;
                    }

                    if ($type == 'single') {
                        $query[] = $obj->post_type;
                        $query[] = $obj->post_type.'-'.$obj->ID;
                    }

                    if ($type == 'category') {
                        $query[] = 'cat-'.$obj->cat_ID;
                    }

                    if ($type == 'archive') {
                        $query[] = 'cat-'.$obj->term_id;
                    }

                    // WPML support
                    if (defined('ICL_LANGUAGE_CODE') && function_exists('icl_get_default_language') && ICL_LANGUAGE_CODE != ($lang = icl_get_default_language())) {

                        if ($type == 'page') {
                            $query[] = 'page-'.icl_object_id($obj->ID, $type, true, $lang);
                        }

                        if ($type == 'category') {

                            $query[] = 'cat-'.icl_object_id($obj->term_id, $type, true, $lang);
                        }
                    }
                }
            }

            $this->query = $query;
        }

        return $this->query;
    }

    /**
     * Retrieve current post count.
     *
     * @global \WP_Query $wp_query
     *
     * @return int
     */
    public function getPostCount()
    {
        global $wp_query;

        return $wp_query->post_count;
    }

    /**
     * Is current view a blog?
     *
     * @return boolean
     */
    public function isBlog()
    {
        return true;
    }

    /**
     * Checks for default widgets in theme preview.
     *
     * @param string $position
     * @return boolean
     */
    public function isPreview($position)
    {
        // preview postions
        $positions = array('logo', 'right');

        return is_preview() && in_array($position, $positions);
    }

    /*
     * Search ajax callback.
     */
    public function ajaxSearch()
    {
        global $wp_query;

        $result = array('results' => array());
        $query  = isset($_REQUEST['s']) ? $_REQUEST['s'] : '';

        if (strlen($query) >= 3) {

            $wp_query->query_vars['posts_per_page'] = $this['config']->get('search_results', 5);
            $wp_query->query_vars['post_status'] = 'publish';
            $wp_query->query_vars['s'] = $query;
            $wp_query->is_search = true;

            foreach ($wp_query->get_posts() as $post) {

                $content = !empty($post->post_excerpt) ? strip_tags(do_shortcode($post->post_excerpt)) : strip_tags(do_shortcode($post->post_content));

                if (strlen($content) > 180) {
                    $content = substr($content, 0, 179).'...';
                }

                $result['results'][] = array(
                    'title' => $post->post_title,
                    'text'  => $content,
                    'url'   => get_permalink($post->ID)
                );
            }
        }

        die(json_encode($result));
    }

    /**
     * WP action callback.
     */
    public function _wp()
    {

        // set config
        $this['config']->set('language', get_bloginfo("language"));
        $this['config']->set('direction', $GLOBALS['wp_locale']->is_rtl() ? 'rtl' : 'ltr');
        $this['config']->set('site_url', rtrim(get_bloginfo('url'), '/'));
        $this['config']->set('site_name', get_option('blogname'));
        $this['config']->set('datetime', date('Y-m-d'));
        $this['config']->set('actual_date', date_i18n($this['config']->get('date_format', 'l, j F Y')));
        $this['config']->set('page_class', implode(' ', array_map(function($element) { return "wp-{$element}"; }, $this->getQuery())));

        // branding ?
        if ($this['config']->get('warp_branding', true)) {
            $this['template']->set('warp_branding', $this['config']['branding']);
        }

        // set layouts
        if ($layouts = $this['config']['layouts']) {

            $layout = 'default';
            $query  = $this->getQuery();

            // set query layout ?
            foreach ($layouts as $key => $data) {
                if (isset($data['assignment']) && array_intersect($data['assignment'], $query)) {
                    $layout = $key;
                    break;
                }
            }

            $this['config']->setValues($layouts[$layout]);
        }

        // add dynamic style
        if ($this['config']['dynamic_style']) {

            if (!session_id()) session_start();

            if (isset($_GET[$this->style])) {
                $_SESSION['_style'] = preg_replace('/[^A-Z0-9-]/i', '', $_GET[$this->style]);
            }

            if (isset($_SESSION['_style']) && $this['path']->path(sprintf('theme:styles/%s', $_SESSION['_style']))) {
                $this['config']['style'] = $_SESSION['_style'];
            }
        }

        // set theme style paths
        if ($style = $this['config']->get('style')) {
            foreach (array('css' => 'theme:styles/%s/css', 'js' => 'theme:styles/%s/js', 'layouts' => 'theme:styles/%s/layouts') as $name => $resource) {
                if ($p = $this['path']->path(sprintf($resource, $style))) {
                    $this['path']->register($p, $name);
                }
            }
        }
    }

    /*
     * Catches default sidebar content and makes it available for the sidebar widget.
     */
    public function _getSidebar($name = null)
    {
        $templates = isset($name) ? array("sidebar-{$name}.php", 'sidebar.php') : array('sidebar.php');

        ob_start();

        if (locate_template($templates, true, true) == '') {
            load_template(ABSPATH.WPINC.'/theme-compat/sidebar.php', true);
            $clear = true;
        }

        $output = ob_get_clean();

        if (isset($clear)) {
            $output = '';
        }

        $this['template']->set('sidebar.output', $output);
    }

    /*
     * Admin save ajax callback.
     */
    public function ajaxSave()
    {
        // init vars
        $post = function_exists('wp_magic_quotes') ? array_map('stripslashes_deep', $_POST) : $_POST;
        $config = isset($post['config']) ? $post['config'] : '{}';

        $message = 'failed';

        if ($config and null !== $json = json_decode($config, true)) {
            if (defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE) {
                if ($this['option']->set('warp_theme_options', $json)) {
                    $message = 'success';
                }
            } else {
                if (file_put_contents($this['path']->path('theme:').'/config.json', $config)) {
                    $message = 'success';
                }
            }
        }

        die(json_encode(compact('message')));
    }

    /*
     * Admin save files ajax callback.
     */
    public function ajaxSaveFiles()
    {
        global $wp_filesystem;

        // init vars
        $upload = isset($_FILES['files']) ? $_FILES['files'] : false;

        if (!$upload) {
            die(json_encode(array('message' => 'No file was uploaded.')));
        }

        if ($upload['error']) {
            $message = 'failed';
            switch ($upload['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = 'No file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = 'Missing a temporary folder.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $message = 'Failed to write file to disk.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $message = 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.';
                    break;
            }
            die(json_encode(compact('message')));
        }

        if (false === $contents = file_get_contents($upload['tmp_name'])) {
            die(json_encode(array('message' => 'Unable to read contents from temporary file.')));
        }

        if (false === $contents = base64_decode($contents)) {
            die(json_encode(array('message' => 'Base64 Decode failed.')));
        }

        if (null === $files = json_decode($contents, true)) {
            die(json_encode(array('message' => 'Unable to decode JSON from temporary file.')));
        }
        $path  = $this['path']->path('theme:');

        $message = 'success';

        foreach ($files as $file => $data) {

            @mkdir(dirname($path.$file), 0777, true);

            if (file_put_contents($path.$file, (string) $data) === false) {
                $message = sprintf('Unable to write file (%s).', $path.$file);
                break;
            }
        }

        // delete obsolete styles
        if ($message == 'success' && $path = $this['path']->path('theme:styles')) {
            foreach (glob("$path/*/style.less") as $dir) {

                $dir = dirname($dir);

                if (!isset($files['/styles/'.basename($dir).'/style.less']) && $wp_filesystem) {
                    $wp_filesystem->delete($dir, true);
                }
            }
        }

        die(json_encode(compact('message')));
    }

    /*
     * Admin get styles ajax callback.
     */
    public function ajaxGetStyles()
    {
        // render styles config
        die($this['template']->render('config:layouts/styles'));
    }

    /*
     * Admin init action callback.
     */
    public function _adminInit()
    {
        // add css/js
        $siteurl = sprintf('/%s/i', preg_quote(parse_url(site_url(), PHP_URL_PATH), '/'));

        if (isset($_GET['page']) && $_GET['page'] == 'warp') {
            wp_enqueue_script('warp-js-jquery-mustache', preg_replace($siteurl, '', $this['path']->url('warp:vendor/jquery/jquery-mustache.js'), 1));
            wp_enqueue_script('warp-js-jquery-cookie', preg_replace($siteurl, '', $this['path']->url('warp:vendor/jquery/jquery-cookie.js'), 1));
            wp_enqueue_script('warp-js-jquery-less', preg_replace($siteurl, '', $this['path']->url('warp:vendor/jquery/jquery-less.js'), 1));
            wp_enqueue_script('warp-js-jquery-rtl', preg_replace($siteurl, '', $this['path']->url('warp:vendor/jquery/jquery-rtl.js'), 1));
            wp_enqueue_script('warp-js-spectrum', preg_replace($siteurl, '', $this['path']->url('warp:vendor/spectrum/spectrum.js'), 1));
            wp_enqueue_script('warp-js-uikit', preg_replace($siteurl, '', $this['path']->url('warp:vendor/uikit/js/uikit.js'), 1));
            wp_enqueue_script('warp-js-less', preg_replace($siteurl, '', $this['path']->url('warp:vendor/less/less.js'), 1));
            wp_enqueue_script('warp-js-config', preg_replace($siteurl, '', $this['path']->url('config:js/config.js'), 1));
            wp_enqueue_script('warp-js-admin', preg_replace($siteurl, '', $this['path']->url('config:js/admin.js'), 1));
            wp_enqueue_style('warp-css-spectrum', preg_replace($siteurl, '', $this['path']->url('warp:vendor/spectrum/spectrum.css'), 1));
            wp_enqueue_style('warp-css-uikit', preg_replace($siteurl, '', $this['path']->url('warp:vendor/uikit/css/uikit.warp.min.css'), 1));
            wp_enqueue_style('warp-css-config', preg_replace($siteurl, '', $this['path']->url('config:css/config.css'), 1));
        }

        wp_enqueue_style('warp-css-admin', preg_replace($siteurl, '', $this['path']->url('config:css/admin.css'), 1));
    }

    /*
     * Admin menu action callback.
     */
    public function _adminMenu()
    {
        // init vars
        $name = $this->xml->first('name')->text();
        $icon = $this['path']->url('config:images/yoo_icon_16.png');
        $self = $this;

        add_object_page('', $name, apply_filters('warp_edit_theme_options', 'edit_theme_options'), 'warp', function() use ($self) {
            echo $self['template']->render('config:layouts/theme_options', array('xml' => $self->xml));
        }, $icon);
    }
}

/** mb_strpos function for servers not using the multibyte string extension */
if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack, $needle, $offset = 0)
    {
        return strpos($haystack, $needle, $offset);
    }
}
