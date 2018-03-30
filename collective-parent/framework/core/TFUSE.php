<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * This is the main class. Super Class :D
 *
 * (for IDE auto complete)
 * @property TF_AJAX        $ajax
 * @property TF_BUFFER      $buffer
 * @property TF_CALLBACKS   $callbacks
 * @property TF_EXT         $ext
 * @property TF_GET         $get
 * @property TF_INCLUDE     $include
 * @property TF_INPUT       $input
 * @property TF_INTERFACE   $interface
 * @property TF_LOAD        $load
 * @property TF_OPTIGEN     $optigen
 * @property TF_OPTISAVE    $optisave
 * @property TF_REQUEST     $request
 * @property TF_SESSION     $session
 */
class TF_TFUSE
{
    private static $instance = NULL;
    public $framework_version = '2.6.1';
    public static $_core_instances = array();
    static $_restricted_names;
    public $__parent;

    public function __construct()
    {
        if (self::$instance === NULL) {
            self::$instance = & $this;
            self::$_restricted_names = get_config('restricted_names');
        }

        foreach (self::$_restricted_names as $property_name)
            if (property_exists($this, $property_name))
                die(__('Property ', 'tfuse') . $property_name . ' ' . __('not allowed in class:', 'tfuse') . ' ' . $this->_the_class_name);
        if (property_exists($this, '_the_class_name')) {
            $this->__autoload();
            if (method_exists($this, '__init')) {
                collect_init($this->_the_class_name);
            }
        }
    }

    public static function &get_instance()
    {
        return self::$instance;
    }

    function __load_massive()
    {
        if (!(property_exists($this, '_standalone') && $this->_standalone)) {
            //__load_instance_in_massive($this->_the_class_name, $this);
            if (!array_key_exists(strtolower($this->_the_class_name), self::$_core_instances))
                self::$_core_instances[strtolower($this->_the_class_name)] =& $this;
        }
    }

    function __autoload()
    {
        $this->__load_massive();
    }

    public static function &magic_get($name)
    {
        if (array_key_exists($name, self::$_core_instances))
            return self::$_core_instances[$name];
        else
            return NULL;
    }

    function __get($name)
    {
        return self::$_core_instances[$name];
    }
}
