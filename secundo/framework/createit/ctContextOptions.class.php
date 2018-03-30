<?php
if (!class_exists('ctContextOptions')) {
    /**
     * ver 1.1
     * Class ctGetOptionHelper
     */
    define('CUSTOMIZER_NAMESPACE', 'ct_option');

    /**
     * Class ctContextOptions
     */
    class ctContextOptions
    {
        /**
         * @var array
         */
        public static $keysToDebug = array();
        /**
         * @var array
         */
        public static $currentOptionKey = array();

        /**
         * @var bool
         */
        public $currentContext = false;

        /**
         * @var
         */
        protected static $uniqueId;

        /**
         * @var string
         */


        protected $settings = array(
            'priority' => array('shortcode', 'meta', 'customizer', 'global'),
            'without_namespace' => array('shortcode', 'meta', 'global', 'customizer'),
            'context' => 'auto',
            'global_detection' => true,//per field
            'global_detection_id' => 'global',//per field
            'global_option_source' => 'customizer',
            'force_empty_value' => 'ct_none'
        );


        /**
         *
         */
        public function __construct()
        {
            $this->setupConstants();
        }

        /**
         *
         */
        protected function setupConstants()
        {

            if (!defined('CTCO_DEBUG_FORCE_GLOBAL'))
                define('CTCO_DEBUG_FORCE_GLOBAL', 'force global');
            if (!defined('CTCO_DEBUG_FORCE_EMPTY'))
                define('CTCO_DEBUG_FORCE_EMPTY', 'force empty');
            if (!defined('CTCO_DEBUG_SUCCESS'))
                define('CTCO_DEBUG_SUCCESS', '<b>Success!</b> value was found');
            if (!defined('CTCO_DEBUG_NOT_EXIST'))
                define('CTCO_DEBUG_NOT_EXIST', 'value <b>not exist</b> or empty');
            if (!defined('CTCO_DEBUG_NEXT_SOURCE'))
                define('CTCO_DEBUG_NEXT_SOURCE', 'go to next source');


        }


        /**
         * @return string
         * todo: detect woocommerce shop index page - needs verification
         */
        public function getContext()
        {

            //todo: support these:
            /*//is search?
            if (is_search()) {
                return 'search';
            }

            //is tag?
            if (is_tag()) {
                return 'tag';
            }
            //is category?
            if (is_category()) {
                return 'category';
            }
            //is author?
            if (is_author()) {
                return 'author';
            }*/


            //is blog?
            if (get_option('page_for_posts') == get_queried_object_id() && !is_single()) {
                if (!function_exists('is_woocommerce') || !is_woocommerce()) {
                    $this->currentContext = 'posts_index_';
                    return $this->currentContext;
                }
            }

            //is page?
            if (is_page()) {
                $this->currentContext = 'pages_';
                return $this->currentContext;
            }

            //is 404?
            if (is_404()) {
                $this->currentContext = 'pages_';
                return $this->currentContext;
            }

            //is single blog?
            if (is_single() && get_post_type() == 'post') {
                $this->currentContext = 'posts_single_';
                return $this->currentContext;
            }

            //is single?
            if (is_single()) {
                $this->currentContext = get_post_type() . '_single_';
                return $this->currentContext;
            }

            // portfolio etc
            if (is_post_type_archive()) {


                $queriedObject = get_queried_object();
                if (isset($queriedObject->rewrite)) {

                    $tmp = $queriedObject->rewrite;
                    if (isset($tmp['slug'])) {

                        $this->currentContext = $tmp['slug'] . '_index_';
                        return $this->currentContext;
                    }
                }

                //detect woocommerce shop index page - needs verification
                if (function_exists('is_shop')) {
                    if (is_shop()) {
                        $this->currentContext = 'product_index_';
                        return $this->currentContext;
                    }
                }

            }


            //Unrecognized.
            return apply_filters('ct_context_options.custom_context', '');//Another context?
        }


        /**
         * @param $key
         *
         * @return string
         */
        protected function getShortcodeValue($key, $shortcodeAtts = array())
        {
            if (!is_array($shortcodeAtts) || !array_key_exists($key, $shortcodeAtts)) {
                return self::$uniqueId;
            }
            $value = $shortcodeAtts[$key];
            self::$currentOptionKey = $key;
            return $value;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getMetaValue($key)
        {
            if (is_post_type_archive()) {
                return self::$uniqueId;
            }


            //w META dla opcji indeksu bloga , używaj ID indeksu bloga
            if (self::getContext() == 'posts_index_') {
                $id = get_option('page_for_posts');
            } else {
                $id = get_the_id();
            }

            /*
            if ($key =='posts_index_header_show_title_box'){
                var_dump(self::getContext());exit();
            }
            */

            $custom = get_post_custom($id);
            self::$currentOptionKey = $key;
            return isset($custom[$key][0]) ? $custom[$key][0] : self::$uniqueId;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getGlobalValue($key)
        {
            if (!ct_has_option($key)) {
                return self::$uniqueId;
            }
            $value = ct_get_option($key, '');
            self::$currentOptionKey = $key;
            return $value;
        }

        /**
         * @param $key
         *
         * @return string
         */
        protected function getCustomizerValue($key)
        {

            $name = CUSTOMIZER_NAMESPACE . '_' . $key;
            $mods = get_theme_mods();
            //var_dump($mods);exit();
            if (isset($mods[$name])) {
                /* if ($name ==CUSTOMIZER_NAMESPACE . '_posts_index_header_title_box_padding_top'){
                     var_dump($mods[$name]);exit();
                 }*/
                self::$currentOptionKey = $key;
                return apply_filters("theme_mod_{$name}", $mods[$name]);
            } else {
                //$uniqueId zwracaj jeżeli opcja nie istnieje!
                //var_dump($key);
                self::$currentOptionKey = $key;
                return self::$uniqueId;
            }

        }

        /**
         * @param $key
         * @param $value
         * @param $method
         * @param $msg
         */
        protected function getDebug($key, $value, $method, $msg)
        {
            if (in_array($key, self::$keysToDebug)) {

                $output = '<pre>';
                $output .= '<b>Context:</b> ' . esc_html($this->currentContext) . ' <b>|</b> ';
                $output .= '<b>Key:</b> ' . esc_html($key) . ' <b>|</b> ';
                $output .= '<b>Value:</b> ' . esc_html($value) . ' <b>|</b><br>';
                $output .= '<b>Method:</b> ' . esc_html($method) . ' <b>|</b> ';
                $output .= '<b>Full Key name with namespace: </b>' . esc_html(self::$currentOptionKey) . ' <b>|</b> ';
                $output .= $msg;
                $output .= '</pre>';
                $allowedtags = array('pre' => array(), 'b' => array());
                echo wp_kses($output, $allowedtags);
            }
            return;
        }


        /**
         * @param $option_id
         * @param $shortcodeAtts
         * @param array $args
         * @param string $default
         *
         * @return mixed|string
         */
        public function ctGetOption($option_id, $default = '', $shortcodeAtts = array(), $args = array())
        {
            self::$uniqueId = uniqid();

            //filtruj default settings
            $this->settings = apply_filters('ct_context_options.default_settings', $this->settings);

            if (is_array($args)) {
                $args = array_merge($this->settings, $args);
                $this->settings = $args;
            }

            if (!isset($option_id) || !is_string($option_id)) {
                return '';
            }

            //set namespace (context)
            if ($args['context'] == 'auto' || $args['context'] == true) {
                $currentContext = $this->getContext();
                $namespace = $currentContext;
            } else {
                $namespace = strval($args['context'] . '_');
                $currentContext = '';
            }

            $globalId = $args['global_detection_id'];
            $globalSource = $args['global_option_source'];

            $value = '';
            //loop in priority array (data sources)
            foreach ($args['priority'] as $key) {
                $method = 'get' . ucfirst($key) . 'Value';//prepare method name by options type

                //if option method exist try to get option
                if (method_exists($this, $method)) {

                    //create namespace if necessary
                    if (is_array(($args['without_namespace'])) && in_array($key, $args['without_namespace'])) {

                        $value = call_user_func(array(
                            $this,
                            'get' . ucfirst($key) . 'Value'
                        ), $option_id, $shortcodeAtts);

                    } else {

                        //! korzystaj z namespace "pages" dla opcji w meta na indeksie bloga!
                        $namespaceCache = $namespace;
                        if ($currentContext == 'posts_index_' && $key == 'meta') {
                            $namespace = 'pages_';
                        }

                        /*
                         * filtr: ct_options_force_global_namespace - umpożliwia odczyt opcji lokalnej z auto-kontekstu a globalnej z wymuszonego
                         */
                        $value = call_user_func(array(
                            $this,
                            'get' . ucfirst($key) . 'Value'
                        ), ($key === $globalSource ? apply_filters('ct_options_force_global_namespace', $namespace, $option_id) : $namespace) . $option_id, $shortcodeAtts);//pozwól wymusić kontekst dla opcji globalnej
                        $namespace = $namespaceCache;
                    }


                    /*
                     * $value jest dostępne.
                     * Sprawdź czy value przekierowuje do opcji gloablnych
                     */
                    if (($args['global_detection'] && $value == $args['global_detection_id'])

                    ) {
                        /*
                         * Wykryte rządanie pobrania opcji globalnej
                         * Pobierz opcje z namespace lub bez
                         * filtr: ct_options_force_global_namespace - umpożliwia odczyt opcji lokalnej z auto-kontekstu a globalnej z wymuszonego
                         */
                        if (is_array(($args['without_namespace'])) && in_array($globalId, $args['without_namespace'])) {
                            $value = call_user_func(array(
                                $this,
                                'get' . ucfirst($globalSource) . 'Value'
                            ), $option_id, $shortcodeAtts);
                        } else {
                            $value = call_user_func(array(
                                $this,
                                'get' . ucfirst($globalSource) . 'Value'
                            ), (apply_filters('ct_options_force_global_namespace', $namespace, $option_id) ) . $option_id, $shortcodeAtts);//pozwól wymusić kontekst dla opcji globalnej
                        }


                        /*
                         * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
                         */
                        if ($value === $args['force_empty_value']) {
                            $value = '';
                            $this->getDebug($option_id, $value, $key, CTCO_DEBUG_FORCE_GLOBAL . '->' . CTCO_DEBUG_FORCE_EMPTY);
                            return $value;
                        }
                        /*
                         * $value != self::$uniqueId && $value != ''
                         * Zwróć value jeżeli opcja istnieje (!&uniqueId) oraz nie jest pusta
                         *
                         */
                        if ($value != self::$uniqueId && $value != '') {
                            $this->getDebug($option_id, $value, $key, CTCO_DEBUG_FORCE_GLOBAL . '->' . CTCO_DEBUG_SUCCESS);
                            return $value;
                        }

                        /*
                         * Globalne ustawnienie nie istnieje albo jest puste,
                         * zwróć default
                         */
                        $this->getDebug($option_id, $value, $key, CTCO_DEBUG_FORCE_GLOBAL . '->' . CTCO_DEBUG_NOT_EXIST);
                        return $default;
                        /*
                         * else - nie wykryto global force
                         */
                    } else {
                        /*
                        * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
                        */
                        if ($value === $args['force_empty_value']) {
                            $value = '';
                            $this->getDebug($option_id, $value, $key, CTCO_DEBUG_FORCE_EMPTY);
                            return $value;
                        }
                        /*
                         * $value != self::$uniqueId && $value != ''
                         * Zwróć value jeżeli opcja istnieje (!&uniqueId) oraz nie jest pusta
                         * W przeciwnym wypadku nowy obrót pętli (opcja z kolejnego źródła)
                         */
                        if ($value != self::$uniqueId && $value != '') {
                            $this->getDebug($option_id, $value, $key, CTCO_DEBUG_SUCCESS);
                            return $value;
                        }
                    }

                }
                $this->getDebug($option_id, $value, $key, CTCO_DEBUG_NOT_EXIST . '->' . CTCO_DEBUG_NEXT_SOURCE);
                continue;
            }

            /*
            * $value === $args['force_empty_value'] - wartość ma być pustym stringiem, nie sprawdzaj dalej tylko zwróć pustego stringa
            */
            // uniqueID = option does not exist
            if ($value == self::$uniqueId) {
                return $default;
            }

            return $value;
        }
    }
}
/**
 * Get option from context
 *
 * @param $field
 * @param string $default
 * @param array $atts
 * @param array $args
 */
if (!function_exists('ct_get_context_option')) {
    /**
     * @param $field
     * @param string $default
     * @param array $atts
     * @param array $args
     * @return mixed|string
     */
    function ct_get_context_option($field, $default = '', $atts = array(), $args = array())
    {
        //@todo nowa klasa etc.
        $obj = new ctContextOptions();

        return $obj->ctGetOption($field, $default, $atts, $args);
    }
}


if (!function_exists('_e_ct_get_context_option')) {
    /**
     * @param $field
     * @param string $default
     * @param array $atts
     * @param array $args
     */
    function _e_ct_get_context_option($field, $default = '', $atts = array(), $args = array())
    {
        //@todo nowa klasa etc.
        $obj = new ctContextOptions();

        echo $obj->ctGetOption($field, $default, $atts, $args);
    }
}


if (!function_exists('ct_get_context_option_if')) {
    /**
     * @param $field
     * @param string $default
     * @param null $wrapper
     * @param array $atts
     * @param array $args
     * @return mixed|string
     */
    function ct_get_context_option_if($field, $default = '', $wrapper = null, $atts = array(), $args = array())
    {
        $obj = new ctContextOptions();
        $value = $obj->ctGetOption($field, $default, $atts, $args);
        if ('' !== $value) {
            return str_replace(array('%value%'), array($value), $wrapper);
        }
        return '';
    }
}


if (!function_exists('ct_get_current_page_setting')) {
    /**
     * @param $field
     * @param string $default
     * @param array $atts
     * @param array $args
     * @return mixed|string
     */
    function ct_get_current_page_setting($field, $default = '', $atts = array(), $args = array('without_namespace' => array('shortcode'), 'context' => true))
    {
        $obj = new ctContextOptions();
        return $obj->ctGetOption($field, $default, $atts, $args);
    }
}


if (!function_exists('ct_get_current_page_setting_if')) {

    /**
     * @param $field
     * @param string $default
     * @param null $wrapper
     * @param array $atts
     * @param array $args
     * @return mixed|string
     */
    function ct_get_current_page_setting_if($field, $default = '', $wrapper = null, $atts = array(), $args = array('without_namespace' => array('shortcode'), 'context' => true))
    {
        $obj = new ctContextOptions();
        $value = $obj->ctGetOption($field, $default, $atts, $args);
        if ('' !== $value) {
            return str_replace(array('%value%'), array($value), $wrapper);
        }
        return '';
    }
}


if (!function_exists('ct_co_debug_add_key')) {
    /**
     * @param $keyToDebug
     * @param bool|true $merge
     */
    function ct_co_debug_add_key($keyToDebug, $merge = true)
    {
        if (isset($keyToDebug)) {
            if ($merge) {
                ctContextOptions::$keysToDebug[] = $keyToDebug;
            } else {
                ctContextOptions::$keysToDebug = array($keyToDebug);
            }
        }

    }
}

if (!function_exists('ct_co_debug_reset')) {
    /**
     *
     */
    function ct_co_debug_reset()
    {
        ctContextOptions::$keysToDebug = array();
    }
}