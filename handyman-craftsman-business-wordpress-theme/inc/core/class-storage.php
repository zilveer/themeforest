<?php
namespace Handyman\Core;

/**
 * Class Storage
 * @package Handyman\Core
 */
class Storage
{

    protected static $_instance;


    /**
     * Options loaded from a DB Storage
     *
     * @var array
     */
    protected $_options = array();


    /**
     * Default options filtered from Default class
     *
     * @var array
     */
    protected $_def_options = array();


    /**
     * Data combined DB + defaults
     *
     * @var array
     */
    protected $_combined = array();



    protected function __construct()
    {
        $this->_loadDefaults()
             ->_setData();
    }


    /**
     * Singleton
     *
     * @return Storage
     */
    public function single()
    {
        if (self::$_instance === null) {
            self::$_instance = new Storage();
        }
        return self::$_instance;
    }


    /**
     * Get data saved with customizer and combine it with default values.
     *
     * @param string $key
     * @return array
     */
    protected function _setData($key = TL_DBKEY)
    {
        $this->_options  = get_option($key);
        if(!is_array($this->_options)){
            $this->_options = array();
        }
        $this->_combined = array_merge($this->_def_options, $this->_options);
        $this->isLoaded  = true;
        return $this;
    }


    /**
     * Load defaults from Defaults class
     *
     * @return $this
     */
    protected function _loadDefaults()
    {
        $this->_def_options = Defaults::single()->getDef('all');
        return $this;
    }


    /**
     * Return data from combined array
     *
     * @param string $option
     * @param mixed $default
     * @return array
     */
    public function get($option = 'all', $default = null)
    {
        $fresh  =  ( \Handyman\Init::$instance->isCustomizing() || is_admin() ) ? true: false;
        if($fresh){
            $this->_setData();
        }
        if ($option == 'all') {
            $return = $this->_combined;
        } else {
            $return = isset($this->_combined[$option]) ? $this->_combined[$option] : $default;
        }
        return $return;
    }


    /**
     * Reset all loaded data
     */
    public function reset()
    {
        $this->_options = array();
        $this->_def_options = array();
        $this->_combined = array();
        return $this;
    }
}