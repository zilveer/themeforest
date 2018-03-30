<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_SESSION extends TF_TFUSE
{
    public $_the_class_name = 'SESSION';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($key, $default_value = null)
    {
        $this->start_session();
        return tf_akg($key, $_SESSION, $default_value);
    }

    private function start_session()
    {
        if (!session_id()) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        $this->start_session();
        tf_aks($key, $value, $_SESSION);
    }
}
