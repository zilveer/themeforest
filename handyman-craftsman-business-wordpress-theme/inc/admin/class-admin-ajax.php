<?php
namespace Handyman\Admin;
use Handyman\Core\Assets;
if (!class_exists('Handyman\Admin\Admin_Ajax')) {
    /**
     * Class Ajax
     * @package Handyman\Admin
     */
    class Admin_Ajax
    {

        CONST NONCE = 'tl-admin-ajax-nonce';



        public static $single;

        /**
         * @var null
         */
        protected $_sanitized_data = null;


        /**
         * @var null
         */
        protected $_response_data = null;



        public function __construct()
        {
            self::$single =& $this;

            // Load required scripts & data
            add_action('admin_init', array($this, 'enqueue'));

            // Register handlers
            $this->_init();
        }


        /**
         * Register ajax handlers
         */
        protected function _init()
        {
            add_action('wp_ajax_default-admin-ajax-handler', array($this, 'handle'));
        }


        /**
         *
         */
        public function enqueue()
        {
            wp_enqueue_script(TL_THEME_SLUG . '-admin-ajax' , Assets::assetPath('js/admin-ajax.js'), array('jquery'), TL_THEME_VER);
            wp_localize_script(TL_THEME_SLUG . '-admin-ajax', 'TL_ADMIN', $this->_adminData());
        }


        /**
         * @return array
         */
        protected function _adminData()
        {
            $data = array(
                'ajax_default_action' => 'default-admin-ajax-handler',
                'ajax_nonce' => wp_create_nonce(self::NONCE),
                'ajax_url' => admin_url('admin-ajax.php'),
            );
            return $data;
        }


        /**
         * Default Ajax handler. This handler expects subaction defined
         */
        public function handle()
        {
            if(!check_ajax_referer(self::NONCE)){
                wp_send_json_error(array('msg' => 'Invalid nonce' ));
            }

            // Sanitize Input
            $this->_sanitized_data = $data = apply_filters('tl/sanitize_input', $_POST);

            // Required data
            if(!isset($data['sub_action']) || $data['sub_action'] == ''){
                wp_send_json_error(array('msg' => 'Sub action is missing'));
            }

            // Convert to method name
            $method = str_replace(array('-','_'), ' ', $data['sub_action']);
            $method = ucwords($method);
            $method = '___' . str_replace(' ', '', $method);

            if(method_exists($this, $method)){
                $this->$method();
            }else{
                wp_send_json_error(array('msg' => 'Invalid sub action'));
            }
            $this->doResponse();
        }


        /**
         * Send Response
         */
        public function doResponse()
        {
            wp_send_json_success($this->_response_data);
        }


        /* -------------------------------------------- SUBACTION AHNDLERS ---------------------------------------- */

        /**
         * Sub action handlers from this point!!!
         * Input: attachment_id, thumbsize(default: thumbnail)
         *
         */
        public function ___loadThumbnailImage()
        {
            // Apply Filters
            $data = apply_filters('tl/filter_input', array('size', 'id'), $this->_sanitized_data);

            // Apply defaults
            $data = wp_parse_args($data, array('size' => 'thumbnail'));

            // Check required data
            $id   = (int) $data['id'];
            $size = $data['size'];

            if($id == 0){
                wp_send_json_error(array('msg' => 'Invalid input'));
            }

            $attachment = wp_get_attachment_image_src($id, $size);
            $this->_response_data = array(
                'url' => $attachment[0],
                'w' => $attachment[1],
                'h' => $attachment[2],
                'id' => $id,
            );
        }
    }
}