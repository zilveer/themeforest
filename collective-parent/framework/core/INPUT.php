<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

class TF_INPUT extends TF_TFUSE
{
    public $_the_class_name = 'INPUT';

    public function __construct()
    {
        parent::__construct();
    }

    public function is_ajax_request()
    {
        static $cache_is_ajax = null;

        if ($cache_is_ajax === null) {
            /*$ajax_actions = array('tfuse_get_suggest');
            if ($this->request->isset_REQUEST('action') && isset($ajax_actions[$this->request->REQUEST('action')]))
                return TRUE;*/
            $cache_is_ajax = (bool)(
                (
                    isset($_SERVER['HTTP_X_REQUESTED_WITH'])
                    && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'
                )
                || $_SERVER['REQUEST_URI'] === '/wp-admin/admin-ajax.php'
            );
        }

        return $cache_is_ajax;
    }
}