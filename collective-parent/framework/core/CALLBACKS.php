<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Class callback containing common functions for callbacks in theme child folder
 */
class TF_CALLBACKS extends TF_TFUSE
{
    public $_the_class_name = 'CALLBACKS';

    function __construct()
    {
        parent::__construct();
    }

    public function execute($callback)
    {
        $opts     = $callback;
        $callback = $opts['callback'];

        if (is_array($callback)) {
            if (is_object($callback[0]) && method_exists($callback[0], $callback[1]))
                return $callback[0]->$callback[1]($opts);
            else
                die('The provided object does not contain callback: ' . $callback[1]);
        } else {
            if (method_exists($this, $callback))
                return $this->$callback($opts);
            elseif (function_exists($callback))
                return $callback($opts);
        }

        if (!$this->callback_exists($callback)) {
            locate_template('theme_config/custom/custom_callbacks.php', TRUE);

            if (function_exists('tf_callback_' . $callback)) {
                $func_name = 'tf_callback_' . $callback;
                return $func_name($opts);
            } else {
                die('Callback function not found: ' . $callback);
            }
        }

        trigger_error('Cannot execute callback', E_USER_WARNING);

        return false;
    }

    final function callback_exists($callback)
    {
        if (is_array($callback)) {
            if (is_object($callback[0]) && method_exists($callback[0], $callback[1]))
                return TRUE;
            else
                return FALSE;
        }
        else {
            if (method_exists($this, $callback))
                return TRUE;
            else if (function_exists($callback))
                return TRUE;
            else
                return FALSE;
        }
    }

    function framebox()
    {
        return $this->ext->slider->load->ext_view('SLIDER', 'framebox', NULL, TRUE);
    }
}