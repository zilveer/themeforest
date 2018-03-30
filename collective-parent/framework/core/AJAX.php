<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Detect and execute ajax requests that uses this class API
 */
class TF_AJAX extends TF_TFUSE
{
    public $_the_class_name = 'AJAX';

    /**
     * All classes registered on their unique ids are stored here, waiting for execution
     * @var array
     */
    protected $_ajax_actions = array();

    /**
     * Current ajax that matched the request and executed
     * @var null|array
     */
    protected $current_ajax_cache = NULL;

    /**
     * This will be json_encoded and sent as ajax response to browser
     * To fill it with data, access it directly in your class via $this->ajax->out_json['some_key'] = 'someData';
     * It has a special key recognized by most backend javaScripts: out_json['reload_page'] = true , to reload page after ajax
     * @var array
     */
    public $out_json = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function __init()
    {
        add_action('init',       array($this, 'init_action'), 99);
        add_action('admin_init', array($this, 'shutdown_action'), 9999);
    }

    public function init_action()
    {
        $this->ajax_do();

        $this->include->js_enq('ajaxurl', admin_url('admin-ajax.php'));
    }

    public function ajax_do()
    {
        $current_ajax = $this->get_current_ajax();

        if ($current_ajax['error'])
            die($current_ajax['error']);

        if ($current_ajax['type'] === null) {
            // nothing to do, there is not ajax
        } elseif ($current_ajax['type'] == 'tfuse_ajax') {
            $this->buffer->stop();

            $current_ajax['callback'][0]->{$current_ajax['callback'][1]}();
        } elseif ($current_ajax['type'] == 'tf_action') {
            $this->buffer->stop();

            $current_ajax['callback']();
        }
    }

    /**
     * Output out_json and exit
     */
    public function ajax_finish()
    {
        if (!empty($this->out_json))
            echo json_encode($this->out_json);

        die();
    }

    function _verify_nonce($nonce)
    {
        if (!check_ajax_referer($nonce, '_ajax_nonce', FALSE))
            die(json_encode(array('status' => -1, 'message' => __('Troll detected.', 'tfuse'))));
    }

    /**
     * Register class under some id to listen ajax calls
     */
    function _add_action($action_name, &$instance)
    {
        $this->_ajax_actions[$action_name] = $instance;

        $this->current_ajax_cache = NULL;
    }

    public function shutdown_action()
    {
        $current_ajax = $this->get_current_ajax();

        if ($current_ajax['type'] !== NULL)
            $this->ajax_finish();
    }

    /**
     * Detect if there is an ajax
     **
     * (do not remove this docComment)
     */
    function get_current_ajax()
    {
        if ($this->current_ajax_cache !== NULL)
            return $this->current_ajax_cache;

        // Detect if it is tf_action or tfuse_ajax
        $current_ajax = array(
            'action'    => $this->request->isset_POST('action') ? $this->request->POST('action') : NULL,
            'type'      => NULL, // tf_action/tfuse_ajax/NULL
            'callback'  => NULL, // function-name/[class,method]
            'error'     => null,
        );

        do {
            if (!$this->input->is_ajax_request())
                break;

            if (!$this->request->isset_POST('action'))
                break;

            if (stripos($this->request->POST('action'), 'tfuse_ajax') !== FALSE) {
                if ($this->request->isset_POST('tf_action')) {
                    if (substr($this->request->POST('tf_action'), 0, 1) == '_') {
                        $current_ajax['error'] = __('Cannot access this action', 'tfuse');
                        break;
                    }
                    $tf_ajax_action = strtolower($this->request->POST('tf_action'));
                } else
                    break;

                if (method_exists($this, $tf_ajax_action)) {
                    $current_ajax['type']       = 'tfuse_ajax';
                    $current_ajax['callback']   = array($this, $tf_ajax_action);
                    break;
                } else {
                    if (array_key_exists($this->request->POST('action'), $this->_ajax_actions)) {
                        if (method_exists($this->_ajax_actions[$this->request->POST('action')], $tf_ajax_action)) {
                            $method = new ReflectionMethod($this->_ajax_actions[$this->request->POST('action')], $tf_ajax_action);
                            $doc    = $method->getDocComment();

                            if ($doc !== false) {
                                // ReflectionMethod works
                                if (strpos($doc, '* @ajax') === false) {
                                    $current_ajax['error'] = __('Access denied (not ajax method)', 'tfuse');
                                    break;
                                }
                            } else {
                                $currentMethod = new ReflectionMethod($this, 'get_current_ajax');
                                if ($currentMethod->getDocComment() !== false) {
                                    // reflection works
                                    // so ajax method does not have comment
                                    $current_ajax['error'] = __('Access denied (not ajax method)', 'tfuse');
                                    break;
                                }
                                unset($currentMethod);

                                // Maybe is used some php accelerator that removes comments from code
                                // read file directly and search for method and it's comment
                                $dclass   = $method->getDeclaringClass();
                                $fileName = $dclass->getFileName();
                                $file     = @fopen($fileName, "r");

                                $commentStarted = false;
                                $ajaxComment    = false;

                                $searchMethod = 'function '.$tf_ajax_action;
                                $resetPending = false;
                                while (!feof($file)) {
                                    $currentLine = fgets($file);

                                    if (strpos($currentLine, '/**') !== false) {
                                        $commentStarted = true;
                                    } elseif ($commentStarted && !$ajaxComment) {
                                        if (strpos($currentLine, '* @ajax') !== false) {
                                            $ajaxComment = true;
                                        }
                                    }

                                    if (strpos($currentLine, $searchMethod) !== false) {
                                        if ($commentStarted && $ajaxComment) {
                                            // ok
                                            break;
                                        } else {
                                            $current_ajax['error'] = __('Access denied (not ajax method)', 'tfuse');
                                            break;
                                        }
                                    } elseif (strpos($currentLine, '*/') !== false) {
                                        $resetPending = true;
                                    } elseif ($resetPending) {
                                        $commentStarted = $ajaxComment = false;
                                        $resetPending   = false;
                                    }
                                }
                                fclose($file);

                                if ($current_ajax['error'])
                                    break;
                            }

                            $current_ajax['type']       = 'tfuse_ajax';
                            $current_ajax['callback']   = array($this->_ajax_actions[$this->request->POST('action')], $tf_ajax_action);
                            break;
                        } else {
                            $current_ajax['error'] = __('There is no such ajax method', 'tfuse');
                            break;
                        }
                    }
                }
            } else if ($this->request->isset_POST('tf_action')) {
                if (substr($this->request->POST('action'), 0, 9) == 'tf_action') {
                    if (function_exists($this->request->POST('tf_action'))) {
                        $current_ajax['type']     = 'tf_action';
                        $current_ajax['callback'] = $this->request->POST('tf_action');
                    } else {
                        $current_ajax['error'] = __('Invalid ajax action', 'tfuse');
                        break;
                    }
                } else {
                    $current_ajax['error'] = __('Invalid ajax action', 'tfuse');
                    break;
                }
            }
        } while (false);

        $this->current_ajax_cache = $current_ajax;

        return $current_ajax;
    }

    /**
     * By 'default' all options of an form generated by optigen are saved in one place together even there are options appended from other filters.
     * With this method, you can catch specific array of "child options" to be detected and saved into another custom "location"
     * This is useful when appending/injecting options via filters into some optigen form and cannot change manually the code from
     *   the main form that saves that options, and do not know exactly where it is.
     * This method checks every ajax submit and if options are within the submitted options,
     *   it triggers save process for that options
     */
    public function catch_options_submit($arguments)
    {
        // $arguments Structure
        array(
            'options' => array(),
                /* required / options for tf_only_options()
                 */

            'skip_tf_action' => array('or string'),
                /* optional / skip (do not trigger save) on this "tf_action_..."s
                 */
            'only_tf_action' => array('or string'),
                /* optional / trigger save procedure only on this "tf_action_..."s
                 * example: array('tf_action_custom_function_for_ajax_save', 'tf_action_another_function')
                 */

            'skip_tfuse_ajax' => array('or string'),
                /* optional / skip (do not trigger save) on this "($this->_ajax_actions[tfuse_ajax_...] or ClassName)->some_method"s
                 */
            'only_tfuse_ajax' => array('or string'),
                /* optional / trigger save procedure only on this "($this->_ajax_actions[tfuse_ajax_...] or ClassName)->some_method"s
                 * example: array('tfuse_ajax_custom_registered_class', array('tfuse_ajax_custom_class', 'method_name') )
                 * here are two types of options you can give in array:
                 *  (string)'registered_class_key' from $this->_ajax_actions, that applies to all its methods
                 *  (array)['registered_class_key', 'method_name'], specify exactly only what method of this class
                 */

            'callback' => 'callable',
                /* optional / call this with specific arguments / as alternative you can use the actions that are inside this function
                 */
            'callback_arguments' => array(),
                /* optional / extra arguments/data for callback
                 */
            'wp_option' => 'option_name'
                /* optional / save options here (update_option(...))
                 */
        );

        // Check required options
        if (!isset($arguments['options']))
            die('Undefined required argument "options" in '.__METHOD__.'()');

        $current_ajax = $this->get_current_ajax();

        do {
            if ($current_ajax['type'] === null)
                return;

            // if is some valid ajax, verify if pass the filters
            if ($current_ajax['type'] == 'tf_action') {
                if (isset($arguments['skip_tf_action'])) {
                    $arguments['skip_tf_action'] = (array)$arguments['skip_tf_action'];

                    if (in_array($current_ajax['callback'], $arguments['skip_tf_action']))
                        return;
                }

                if (isset($arguments['only_tf_action'])) {
                    $arguments['only_tf_action'] = (array)$arguments['only_tf_action'];

                    if (!in_array($current_ajax['callback'], $arguments['only_tf_action']))
                        return;
                }
            } elseif ($current_ajax['type'] == 'tfuse_ajax') {
                $class = explode('\\', get_class( $current_ajax['callback'][0] ) );
                $class = end($class);

                if (isset($arguments['skip_tfuse_ajax'])) {
                    $arguments['skip_tfuse_ajax'] = (array)$arguments['skip_tfuse_ajax'];

                    foreach ($arguments['skip_tfuse_ajax'] as $skipClass) {
                        if (is_array($skipClass)) {
                            if ( ($class == $skipClass[0] || $current_ajax['action'] == $skipClass[0])  && $current_ajax['callback'][1] == $skipClass[1] )
                                return;
                        } else {
                            if ( ($class == $skipClass || $current_ajax['action'] == $skipClass) )
                                return;
                        }
                    }
                }

                if (isset($arguments['only_tfuse_ajax'])) {
                    $arguments['only_tfuse_ajax'] = (array)$arguments['only_tfuse_ajax'];

                    foreach ($arguments['only_tfuse_ajax'] as $onlyClass) {
                        if (is_array($onlyClass)) {
                            if (($class == $onlyClass[0] || $current_ajax['action'] == $onlyClass[0]) && $current_ajax['callback'][1] == $onlyClass[1])
                                break 2;
                        } else {
                            if ($class == $onlyClass || $current_ajax['action'] == $onlyClass)
                                break 2;
                        }
                    }

                    // Current tfuse_ajax class not found in 'only' filters, but the filters are set, so the class is not allowed
                    return;
                }
            }
        } while(false);

        $options = tf_only_options($arguments['options'],
            array('raw') // leave only types that sure create _POST values
        );
        if (!count($options)) {
            echo sprintf(__('Invalid options given in %s(). Only options that sure creates _POST values are allowed (and be sure they are unique enough, a few options in id containing "general"/"not unique" names its not a good idea)'."\n", 'tfuse'), __METHOD__);
            print_r($arguments['options']);
            die();
        }

        // check if _POST contains options
        if (!$this->request->isset_POST('options'))
            return;

        $post_options = json_decode($this->request->POST('options'));

        if(!is_object($post_options))
            return;

        $post_options_clean_keys = array();
        foreach($post_options as $key=>$val) {
            $post_options_clean_keys[ rtrim($key, '[]') ] = $val;
        }
        // If at least one option is not in _POST, that means the whole array does not match
        if (count($options) > count(array_intersect_key($options, $post_options_clean_keys)))
            return;

        $values = get_object_vars($post_options);

        $data_options = array();
        foreach ($options as $option_id => $option) {
            if ($this->optisave->has_method("admin_{$option['type']}")) {
                $this->optisave->{"admin_{$option['type']}"}($option, $values, $data_options);
            } else {
                $this->optisave->admin_text($option, $values, $data_options);
            }
        }

        array_walk_recursive(
            $data_options,
            create_function('&$i', 'if (strtolower($i) === "true") $i = true; elseif (strtolower($i) === "false") $i = false;')
        );

        if (isset($arguments['wp_option'])) {
            if (empty($arguments['wp_option']))
                die(sprintf(__('Argument "wp_option" cannot be empty, in %s ()'. 'tfuse'), __METHOD__));

            update_option($arguments['wp_option'], $data_options);
        }

        $action_arguments = array(
            'current_ajax'      => $current_ajax,
            'raw_options'       => $arguments['options'],
            'data_options'      => $data_options, // Options with data from _POST (key=>value)
            'wp_option'         => ( isset($arguments['wp_option']) ? $arguments['wp_option'] : NULL ),
            'callback_arguments'=> @$arguments['callback_arguments']
        );

        if (isset($arguments['callback'])) {
            if (empty($arguments['callback']))
                die(sprintf(__('Argument "callback" cannot be empty, in %s ()', 'tfuse'), __METHOD__));

            if (is_array($arguments['callback'])) {
                // Object method
                $arguments['callback'][0]->{$arguments['callback'][1]}($action_arguments);
            } else {
                // Function
                $arguments['callback']($action_arguments);
            }
        }

        do_action('tf_ajax_catch_options_submit', $action_arguments);

        return $action_arguments;
    }
}
