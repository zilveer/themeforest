<?php if (!defined('TFUSE')) exit('Direct access forbidden.');

/**
 * Collect all output in ob_start() --- ob_get_clean()
 * and inject scripts and styles
 *
 * Advantages:
 * * Include scripts and styles in head from footer (after head already generated)
 * * Redirects works after output started (because output physically not yet started, it is collected in ob_start())
 *
 * Disadvantages:
 * * Memory consumption
 * * Need to take care to stop buffer if want to output big data (or big binary file via readfile())
 */
class TF_BUFFER extends TF_TFUSE
{
    public $_the_class_name = 'BUFFER';

    /** callbacks added by others to process collected output */
    protected $_filters = array();

    /** all output is accessible here at the end when filters execution started */
    protected $_buffer = '';

    protected $_is_end = FALSE;

    /** if buffer collection was stopped before end */
    protected $_is_stopped = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function __init()
    {
        add_action('init', array($this, 'start_ob'));
        add_action('shutdown', array($this, 'end_ob'), 0);
    }

    public function start_ob()
    {
        ob_start();
    }

    /**
     * Stops buffer collection
     * (use this when buffer sure not needed: binary file output, etc.)
     */
    public function stop()
    {
        ob_end_clean();

        $this->_is_stopped = true;
    }

    public function add_filter($callback)
    {
        if (!in_array($callback, $this->_filters))
            $this->_filters[] = $callback;
    }

    public function apply_filters()
    {
        foreach ($this->_filters as $filter) {
            if (is_array($filter)) {
                if (is_object($filter[0]) && method_exists($filter[0], $filter[1])) {
                    $this->_buffer = $filter[0]->{$filter[1]}($this->_buffer);
                }
            } else {
                if (function_exists($filter)) {
                    $this->_buffer = $filter($this->_buffer);
                }
            }
        }
    }

    public function set_buffer($buffer = '', $flag = 'replace')
    {
        static $_flag = '', $_buffer = '';

        if ($this->_is_stopped)
            return false;

        if ($this->_is_end !== TRUE) {
            $this->add_filter(array($this, 'set_buffer'));
            if (!in_array($flag, array('prepend', 'replace', 'append')))
                return FALSE;
            $_flag = $flag;
            $_buffer = $buffer;
        } else {
            if ($_flag === 'replace') {
                return $_buffer;
            }
            if ($_flag === 'prepend') {
                return $_buffer . $this->_buffer;
            }
            if ($_flag === 'append') {
                return ($this->_buffer . $_buffer);
            }
        }

        return true;
    }

    /**
     * Get all collected output
     * Modify
     * Output
     */
    public function end_ob()
    {
        if ($this->_is_stopped)
            return;

        $this->_is_end = TRUE;
        $this->_buffer = ob_get_clean();
        $this->apply_filters();

        echo $this->_buffer;

        $this->_buffer = '';
    }
}