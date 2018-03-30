<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_REQUEST extends TF_TFUSE
{
    public $_the_class_name = 'REQUEST';

    protected $magic_quotes_gpc = false;

    public function __construct()
    {
        parent::__construct();

        $this->magic_quotes_gpc = get_magic_quotes_gpc();
    }

    protected function prepare_key($key)
    {
        return( $this->magic_quotes_gpc && is_string($key) ? addslashes($key) : $key );
    }

    protected function get_set($key = null, $set_value = null, &$value)
    {
        $key = $this->prepare_key($key);

        if ($set_value === null) { // get
            return tf_stripslashes_deep_keys($key === null ? $value : tf_akg($key, $value));
        } else { // set
            tf_aks($key, tf_addslashes_deep_keys($set_value), $value);
        }
    }

    public function SERVER($key = null)
    {
        # it seems that $_SERVER is not affected by magic quotes
        if (isset($key)) {
            return @$_SERVER[$key];
        }
        return $_SERVER;
    }
    public function isset_SERVER($key)
    {
        return isset($_SERVER[$key]);
    }

    public function GET($key = null, $set_value = null)
    {
        return $this->get_set($key, $set_value, $_GET);
    }
    public function isset_GET($key)
    {
        return ($this->GET($key) === null ? false : true);
    }
    public function empty_GET($key)
    {
        $result = $this->GET($key);
        return empty($result);
    }

    public function POST($key = null, $set_value = null)
    {
        return $this->get_set($key, $set_value, $_POST);
    }
    public function isset_POST($key)
    {
        return ($this->POST($key) === null ? false : true);
    }
    public function empty_POST($key)
    {
        $result = $this->POST($key);
        return empty($result);
    }

    public function COOKIE($key = null, $set_value = null, $expire = 0, $path = null)
    {
        if ($set_value !== null) {

            // transforms a string ( key1.key2.key3 => key1][key2][key3] )
            $key = str_replace('.', '][', $key) . ']';

            // removes the first closed square bracket ( key1][key2][key3] => key1[key2][key3] )
            $key = preg_replace('/\]/', '', $key, 1);

            setcookie($key, $set_value, $expire, $path);
        } else {
            return $this->get_set($key, $set_value, $_COOKIE);
        }
    }

    public function isset_COOKIE($key)
    {
        return ($this->COOKIE($key) === null ? false : true);
    }
    public function empty_COOKIE($key)
    {
        $result = $this->COOKIE($key);
        return empty($result);
    }

    public function REQUEST($key = null, $set_value = null)
    {
        return $this->get_set($key, $set_value, $_REQUEST);
    }
    public function isset_REQUEST($key)
    {
        return ($this->REQUEST($key) === null ? false : true);
    }
    public function empty_REQUEST($key)
    {
        $result = $this->REQUEST($key);
        return empty($result);
    }
}