<?php
/**
 * This file is part of the G1_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_UI_Widgets
 * @since G1_UI_Widgets 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * G1_UI_Widget_Manager
 *
 * Controls all UI widgets
 */
class G1_UI_Widget_Manager {
    private $widgets;

    public function __construct() {
        $this->widgets = array();

        $this->setup_hooks();
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        add_action( 'wp_loaded', array ($this, 'do_register' ) );
    }

    public function do_register() {
        do_action( 'g1_ui_widget_manager_register', $this );
    }

    public function add(G1_UI_Widget_Interface $widget) {
        $widget->register();

        $this->widgets[$widget->get_id()] = $widget;
    }

    /**
     * @param $id
     * @return G1_UI_Widget_Interface
     */
    public function get($id) {
        if (!isset($this->widgets[$id])) {
            return null;
        }

        return $this->widgets[$id];
    }
}

/**
 * @return G1_UI_Widget_Manager
 */
function G1_UI_Widget_Manager() {
    static $instance = null;

    if ($instance === null) {
        $instance = new G1_UI_Widget_Manager();
    }

    return $instance;
}

G1_UI_Widget_Manager();

/**
 * G1_UI_Widget_Interface
 */
interface G1_UI_Widget_Interface {
    public function get_id();
    public function register();
    public function render();
}

abstract class G1_UI_Widget implements G1_UI_Widget_Interface {
    private $id;
    private $config;
    private $js_config;

    /**
     * Override this method in subclass if you want to do some initialization
     */
    public function init() {}

    public function __construct($id, $config = array(), $js_config = array()) {
        $this->id = $id;
        $this->config = $config;
        $this->js_config = $js_config;
        $this->init();
    }

    public function get_id() {
        return $this->id;
    }

    public function get_config() {
        return $this->config;
    }

    public function get_js_config() {
        return $this->js_config;
    }
}

/**
 * G1_UI_Widget_Ajax_Image_Upload
 *
 * Handles upload image using ajax call
 */
class G1_UI_Widget_Ajax_Image_Upload extends G1_UI_Widget {
    private $js_config;

    public function init() {
        $this->js_config = $this->get_config();
    }

    public function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function enqueue_scripts() {
        wp_register_script( 'g1_ui_widget_ajax_image_upload', trailingslashit( G1_FRAMEWORK_URI ) . 'admin/js/g1-ui-widget-ajax-image-upload.js', array('jquery'));
        wp_enqueue_script( 'g1_ui_widget_ajax_image_upload' );
        wp_localize_script('g1_ui_widget_ajax_image_upload', $this->get_id(), json_encode($this->get_js_config()) );

        wp_register_style( 'g1_ui_widget_ajax_image_upload', trailingslashit( G1_FRAMEWORK_URI ) . 'admin/css/g1-ui-widget-ajax-image-upload.css');
        wp_enqueue_style( 'g1_ui_widget_ajax_image_upload' );

        wp_plupload_default_settings();
        wp_enqueue_script( 'wp-plupload' );
    }

    public function render() {
        ?>
    <div class="g1-async-upload-box" id="<?php echo $this->get_id(); ?>">
        <div class="upload-dropzone">
            <?php _e('Drop a file here or <a href="#" class="upload">select a file</a>.'); ?>
        </div>
    </div>
    <?php
    }
}
